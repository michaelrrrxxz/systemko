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
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Secure this in real apps
        ]);

     
        // Assign the admin role
        $admin->assignRole('admin'); // 👈 This line does the magic

        // Create additional users
        User::factory(10)->create();
    }
}

