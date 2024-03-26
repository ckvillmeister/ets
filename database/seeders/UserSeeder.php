<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'firstname' => 'Super',
            'lastname' => 'User',
            'username' => 'super.user',
            'password' => Hash::make('E9q3gnDr'),
            'role' => 1
        ]);

        $role = Role::where('id', $user->role)->first();
        $user->assignRole($role);
    }
}
