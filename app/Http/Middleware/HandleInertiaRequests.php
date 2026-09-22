<?php

namespace App\Http\Middleware;

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
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => fn () => $request->user()?->only(['id', 'name', 'email', 'avatar_path', 'status']),
                'role' => fn () => $request->user()?->getRoleNames()->first(),
                'permissions' => fn () => $request->user()?->getAllPermissions()->pluck('name')->values() ?? [],
            ],
            'appName' => config('app.name'),
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
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
}
