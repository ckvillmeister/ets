<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
					'name' => 'Administrator',
					'guard_name' => 'web',
					'created_at' => date('Y-m-d H:i:s')
					]);

        $permissions = Permission::where('status', 1)->get();
        foreach ($permissions as $key => $permission) {
            $role->givePermissionTo($permission->name);
        }
    }
}
