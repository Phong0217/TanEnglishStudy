<?php

namespace App\Console\Commands;

use App\Enums\RoleName;
use App\Enums\UserStatus;
use App\Models\Center;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CreateAdmin extends Command
{
    protected $signature = 'app:create-admin {--center=}';

    protected $description = 'Safely create the first center administrator';

    public function handle(): int
    {
        $center = $this->option('center')
            ? Center::where('code', $this->option('center'))->first()
            : Center::first();

        if (! $center) {
            $this->error('Create or seed a center before creating an administrator.');

            return self::FAILURE;
        }

        $name = $this->ask('Name');
        $email = mb_strtolower((string) $this->ask('Email'));
        if (User::withTrashed()->where('email', $email)->exists()) {
            $this->error('A user with this email already exists.');

            return self::FAILURE;
        }

        $password = $this->secret('Password');
        $validator = validator(['password' => $password], ['password' => ['required', 'confirmed', Password::defaults()]]);
        $confirmation = $this->secret('Confirm password');
        $validator->setData(['password' => $password, 'password_confirmation' => $confirmation]);
        if ($validator->fails()) {
            $this->error($validator->errors()->first('password'));

            return self::FAILURE;
        }

        $user = User::create([
            'center_id' => $center->id,
            'name' => $name,
            'email' => $email,
            'password' => Hash::make((string) $password),
            'status' => UserStatus::ACTIVE,
            'email_verified_at' => now(),
        ]);
        $user->syncRoles([RoleName::ADMIN->value]);

        $this->info('Administrator created successfully.');

        return self::SUCCESS;
    }
}
