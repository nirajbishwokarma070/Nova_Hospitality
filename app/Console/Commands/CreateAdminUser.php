<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Create an administrator account for the Nova homepage editor';

    public function handle(): int
    {
        $email = $this->ask('Admin email address');
        $emailValidator = Validator::make(['email' => $email], [
            'email' => ['required', 'email', 'max:254', 'unique:users,email'],
        ]);

        if ($emailValidator->fails()) {
            $this->error($emailValidator->errors()->first('email'));

            return self::FAILURE;
        }

        $name = $this->ask('Admin name');
        $nameValidator = Validator::make(['name' => $name], [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($nameValidator->fails()) {
            $this->error($nameValidator->errors()->first('name'));

            return self::FAILURE;
        }

        $password = (string) $this->secret('Password (at least 12 characters)');
        $confirmation = (string) $this->secret('Confirm password');

        if (mb_strlen($password) < 12 || ! hash_equals($password, $confirmation)) {
            $this->error('The password must be at least 12 characters and both entries must match.');

            return self::FAILURE;
        }

        User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'is_admin' => true,
        ]);

        $this->info('Administrator account created.');

        return self::SUCCESS;
    }
}
