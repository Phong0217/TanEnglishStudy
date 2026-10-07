<?php

namespace App\Http\Middleware;

use App\Models\Center;
use App\Support\Utf8;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Validation errors can contain a message produced by a database driver.
     * Normalize it before Inertia serializes the page as JSON. This also
     * protects the next redirect when an older failed import left an invalid
     * message in the session.
     */
    public function resolveValidationErrors(Request $request)
    {
        $errors = parent::resolveValidationErrors($request);

        return $this->normalizeValue($errors);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // Branding is also needed on the public login screen. Authenticated
        // users keep their own center while guests use the active primary
        // center configured for this installation.
        $center = $request->user()?->center
            ?? Center::query()->where('status', 'ACTIVE')->orderBy('id')->first();

        return [
            ...parent::share($request),
            'auth' => [
                'user' => fn () => $request->user()?->only(['id', 'name', 'email', 'avatar_path', 'status']),
                'role' => fn () => $request->user()?->getRoleNames()->first(),
                'permissions' => fn () => $request->user()?->getAllPermissions()->pluck('name')->values() ?? [],
            ],
            'center' => fn () => $center ? [
                'id' => $center->id,
                'name' => $center->name,
                'code' => $center->code,
                'logoUrl' => $center->logo_path ? route('center.logo', ['v' => $center->updated_at?->timestamp]) : null,
                'backgroundUrl' => data_get($center->settings_json, 'background_path') ? route('center.background', ['v' => $center->updated_at?->timestamp]) : null,
                'backgroundColor' => data_get($center->settings_json, 'background_color'),
            ] : null,
            'appName' => config('app.name'),
            'flash' => [
                'success' => fn () => Utf8::clean($request->session()->get('success')),
                'error' => fn () => Utf8::clean($request->session()->get('error')),
            ],
            'notifications' => fn () => $request->user() ? [
                'unreadCount' => $request->user()->unreadNotifications()->count(),
                'items' => $request->user()->notifications()->latest()->limit(5)->get()->map(fn ($notification) => [
                    'id' => $notification->id,
                    'data' => $notification->data,
                    'readAt' => $notification->read_at,
                    'createdAt' => $notification->created_at,
                ]),
            ] : ['unreadCount' => 0, 'items' => []],
        ];
    }

    private function normalizeValue(mixed $value): mixed
    {
        if (is_object($value)) {
            $normalized = new \stdClass();
            foreach (get_object_vars($value) as $key => $item) {
                $normalized->{$key} = $this->normalizeValue($item);
            }

            return $normalized;
        }

        if (is_array($value)) {
            return array_map(fn ($item) => $this->normalizeValue($item), $value);
        }

        return is_string($value) ? Utf8::clean($value) : $value;
    }
}
