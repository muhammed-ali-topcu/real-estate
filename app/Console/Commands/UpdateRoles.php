<?php

namespace App\Console\Commands;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->handleAdmin();
        $this->handleUser();
        $this->info('roles updated');
    }

    public function handleAdmin()
    {
        $adminRole = Role::updateOrCreate(['name' => RolesEnum::ADMIN]);
        foreach (PermissionsEnum::cases() as $permission) {
            Permission::updateOrCreate(['name' => $permission->value]);
            $adminRole->givePermissionTo($permission);
        }
    }

    public function handleUser(): void
    {
        $userRole = Role::updateOrCreate(['name' => RolesEnum::USER]);

    }
}
