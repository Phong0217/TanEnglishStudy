<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Support\Logging\AppLogger;
use App\Enums\LogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request, AppLogger $logger): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $request->user()->forceFill(['last_login_at' => now()])->save();
        $logger->info(LogService::AUTH, 'Login successful', ['ip' => $request->ip()]);

        $route = match ($request->user()->getRoleNames()->first()) {
            RoleName::ADMIN->value => 'admin.dashboard',
            RoleName::TEACHER->value => 'teacher.dashboard',
            RoleName::STUDENT->value => 'student.dashboard',
            default => abort(403, 'No application role has been assigned.'),
        };

        return redirect()->intended(route($route, absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        app(AppLogger::class)->info(LogService::AUTH, 'Logout', ['ip' => $request->ip()]);
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
