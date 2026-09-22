<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Audit\AuditLogger;
use App\Enums\RoleName;
use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Models\StudentProfile;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(Request $request, string $role): Response
    {
        $role = strtoupper($role);
        abort_unless(in_array($role, ['TEACHER', 'STUDENT'], true), 404);
        $query = User::role($role)->where('center_id', $request->user()->center_id)->with($role === 'TEACHER' ? 'teacherProfile' : 'studentProfile');
        if ($search = $request->string('search')->trim()->toString()) {
            $query->where(fn ($q) => $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"));
        }if ($status = $request->string('status')->toString()) {
            $query->where('status', $status);
        }$sort = in_array($request->get('sort'), ['name', 'email', 'status', 'created_at'], true) ? $request->get('sort') : 'created_at';

        return Inertia::render('Admin/Users/Index', ['role' => $role, 'filters' => $request->only('search', 'status', 'sort'), 'users' => $query->orderBy($sort, $request->get('direction') === 'asc' ? 'asc' : 'desc')->paginate(15)->withQueryString()->through(fn ($u) => ['id' => $u->id, 'name' => $u->name, 'email' => $u->email, 'status' => $u->status->value, 'code' => $role === 'TEACHER' ? $u->teacherProfile?->teacher_code : $u->studentProfile?->student_code, 'createdAt' => $u->created_at])]);
    }

    public function store(StoreUserRequest $request, AuditLogger $audit): RedirectResponse
    {
        $data = $request->validated();
        $user = DB::transaction(function () use ($data, $request) {
            $user = User::create(['center_id' => $request->user()->center_id, 'name' => $data['name'], 'email' => mb_strtolower($data['email']), 'password' => $data['password'], 'status' => $data['status'] ?? UserStatus::ACTIVE]);
            $user->syncRoles([$data['role']]);
            if ($data['role'] === RoleName::TEACHER->value) {
                TeacherProfile::create(['user_id' => $user->id, 'teacher_code' => $data['code'], 'joined_at' => now()]);
            } else {
                StudentProfile::create(['user_id' => $user->id, 'student_code' => $data['code'], 'joined_at' => now()]);
            }

            return $user;
        });
        $audit->record('USER_CREATED', $user, null, ['name' => $user->name, 'email' => $user->email, 'role' => $data['role']]);

        return back()->with('success', ucfirst(strtolower($data['role'])).' created successfully.');
    }

    public function status(Request $request, User $user, AuditLogger $audit): RedirectResponse
    {
        abort_unless($user->center_id === $request->user()->center_id, 404);
        $data = $request->validate(['status' => ['required', 'in:ACTIVE,INACTIVE,SUSPENDED,ARCHIVED']]);
        if ($user->is($request->user()) && $data['status'] !== 'ACTIVE' && User::role('ADMIN')->where('center_id', $user->center_id)->where('status', 'ACTIVE')->count() === 1) {
            return back()->with('error', 'The only active administrator cannot be deactivated.');
        }$old = $user->status->value;
        $user->update(['status' => $data['status']]);
        $audit->record('USER_STATUS_CHANGED', $user, ['status' => $old], ['status' => $data['status']]);

        return back()->with('success', 'User status updated.');
    }
}
