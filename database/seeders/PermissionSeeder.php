<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    	$permissions = ['View Dashboard', 
    					'View Document Manager', 
    					'View File Uploader', 
    					'View Reports', 
    					'System Settings Menu', 
    					'View Document Categories', 
    					'View Permissions', 
    					'View Roles', 
    					'View User Accounts', 
    					'View Settings'];

    	foreach ($permissions as $key => $permission) {
    		Permission::create([
					'name' => $permission,
					'guard_name' => 'web',
					'created_at' => date('Y-m-d H:i:s')
					]);
    	}
		
    }
}
