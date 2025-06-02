<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate([
            'name'              => 'Admin',
            'email'             => 'admin@example.com',
            'password'          => 'password',
            'is_active'         => true,
            'email_verified_at' => now(),
        ]);
        $admin->assignRole(RolesEnum::ADMIN);

        $users = User::factory(1000)->create();
        foreach ($users as $user) {
            $user->assignRole(RolesEnum::USER);
        }

    }
}
