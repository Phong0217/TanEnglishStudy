<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Support\Permission as AppPermission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        $permissionNames = array_values(AppPermission::all());
        foreach ($permissionNames as $permission) {
            Permission::findOrCreate($permission);
        }
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        Role::findOrCreate(RoleName::ADMIN->value)->syncPermissions($permissionNames);
        Role::findOrCreate(RoleName::TEACHER->value)->syncPermissions([
            AppPermission::DASHBOARD_TEACHER, AppPermission::LESSONS_AUTHOR, AppPermission::LESSONS_PUBLISH,
            AppPermission::ASSIGNMENTS_AUTHOR, AppPermission::ASSIGNMENTS_DELIVER, AppPermission::SUBMISSIONS_GRADE,
            AppPermission::QUESTIONS_MANAGE, AppPermission::DOCUMENTS_MANAGE, AppPermission::AI_GENERATE, AppPermission::REPORTS_VIEW,
        ]);
        Role::findOrCreate(RoleName::STUDENT->value)->syncPermissions([
            AppPermission::DASHBOARD_STUDENT, AppPermission::SUBMISSIONS_OWN, AppPermission::GRADES_OWN,
        ]);
    }
}
