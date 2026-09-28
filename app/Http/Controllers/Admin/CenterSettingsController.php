<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LogService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateCenterSettingsRequest;
use App\Models\Center;
use App\Support\Logging\AppLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class CenterSettingsController extends Controller
{
    public function edit(Request $request): Response
    {
        $center = $request->user()->center;

        return Inertia::render('Admin/CenterSettings', [
            'center' => [
                'id' => $center->id,
                'name' => $center->name,
                'code' => $center->code,
                'timezone' => $center->timezone,
                'logoUrl' => $center->logo_path ? route('center.logo', ['v' => $center->updated_at?->timestamp]) : null,
                'backgroundUrl' => data_get($center->settings_json, 'background_path') ? route('center.background', ['v' => $center->updated_at?->timestamp]) : null,
                'backgroundColor' => data_get($center->settings_json, 'background_color'),
            ],
        ]);
    }

    public function update(UpdateCenterSettingsRequest $request, AppLogger $logger): RedirectResponse
    {
        $center = $request->user()->center;
        $data = $request->validated();
        $updates = ['name' => trim($data['name'])];
        $settings = $center->settings_json ?? [];

        if ((bool) ($data['remove_logo'] ?? false)) {
            $updates['logo_path'] = null;
            unset($settings['logo_mime']);
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $disk = config('filesystems.private_disk', 'private');
            $extension = strtolower($file->getClientOriginalExtension() ?: 'bin');
            $path = $file->storeAs('center-logos/'.$center->id, Str::uuid()->toString().'.'.$extension, $disk);
            $updates['logo_path'] = $path;
            $settings['logo_mime'] = $file->getMimeType();
        }

        if ((bool) ($data['remove_background'] ?? false)) {
            unset($settings['background_path'], $settings['background_mime']);
        }

        if (array_key_exists('background_color', $data)) {
            $color = trim((string) ($data['background_color'] ?? ''));
            if ($color !== '') {
                $settings['background_color'] = $color;
            } else {
                unset($settings['background_color']);
            }
        }

        if ($request->hasFile('background')) {
            $file = $request->file('background');
            $disk = config('filesystems.private_disk', 'private');
            $extension = strtolower($file->getClientOriginalExtension() ?: 'bin');
            $path = $file->storeAs('center-backgrounds/'.$center->id, Str::uuid()->toString().'.'.$extension, $disk);
            $settings['background_path'] = $path;
            $settings['background_mime'] = $file->getMimeType();
        }

        $updates['settings_json'] = $settings;
        $center->update($updates);
        $logger->info(LogService::USER, 'Center branding updated', [
            'center_id' => $center->id,
            'logo_updated' => $request->hasFile('logo'),
            'logo_removed' => (bool) ($data['remove_logo'] ?? false),
            'background_updated' => $request->hasFile('background'),
            'background_removed' => (bool) ($data['remove_background'] ?? false),
        ]);

        return back()->with('success', 'Đã cập nhật nhận diện trung tâm.');
    }

    public function background(Request $request)
    {
        $center = $this->brandingCenter($request);
        $path = data_get($center?->settings_json, 'background_path');
        abort_unless($path, 404);

        $disk = config('filesystems.private_disk', 'private');
        abort_unless(Storage::disk($disk)->exists($path), 404);
        $mime = data_get($center->settings_json, 'background_mime') ?: (Storage::disk($disk)->mimeType($path) ?: 'image/jpeg');

        return Storage::disk($disk)->response($path, basename($path), [
            'Content-Type' => $mime,
            'Cache-Control' => 'private, no-cache, must-revalidate',
        ]);
    }

    public function logo(Request $request)
    {
        $center = $this->brandingCenter($request);
        abort_unless($center?->logo_path, 404);

        $disk = config('filesystems.private_disk', 'private');
        abort_unless(Storage::disk($disk)->exists($center->logo_path), 404);
        $mime = data_get($center->settings_json, 'logo_mime') ?: (Storage::disk($disk)->mimeType($center->logo_path) ?: 'image/png');

        return Storage::disk($disk)->response($center->logo_path, basename($center->logo_path), [
            'Content-Type' => $mime,
            'Cache-Control' => 'private, no-cache, must-revalidate',
        ]);
    }

    /**
     * Resolve the center whose branding is public on the login screen.
     * Authenticated users remain scoped to their own center.
     */
    private function brandingCenter(Request $request): ?Center
    {
        return $request->user()?->center
            ?? Center::query()->where('status', 'ACTIVE')->orderBy('id')->first();
    }
}
