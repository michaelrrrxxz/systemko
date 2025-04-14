<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create the admin user
        $super= User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@example.com',
            'password' => bcrypt('password'), // Secure this in real apps
        ]);
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Secure this in real apps
        ]);
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'), // Secure this in real apps
        ]);


        // Assign the admin role
        $super->assignRole('super-user'); // 👈 This line does the magic
        $admin->assignRole('admin'); // 👈 This line does the magic
        $user->assignRole('user'); // 👈 This line does the magic

        // Create additional users
        User::factory(10)->create();
    }
}

