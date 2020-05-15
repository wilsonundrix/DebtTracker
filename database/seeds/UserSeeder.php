<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $superAdminRole = Role::where('name', 'super_admin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        $superAdmin = User::create([
            'name' => 'Super Admin User',
            'email' => 'super@test.com',
            'password' => Hash::make('password'),
        ]);
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
        ]);
        $user = User::create([
            'name' => 'User User',
            'email' => 'user@test.com',
            'password' => Hash::make('password'),
        ]);

        $superAdmin->roles()->attach($superAdminRole);
        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);

    }
}
