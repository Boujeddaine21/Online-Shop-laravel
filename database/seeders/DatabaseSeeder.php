<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void{
        // User::factory(10)->create();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        $admin = User::factory()->create([
            'firstname' => 'Hamza',
            'lastname' => 'Boujeddaine',
            'username' => '2hboujed',
            'email' => 'hamza@example.com',
            'password' => bcrypt('123'),
        ]);
        $admin->assignRole('admin');

        $user = User::factory()->create([
            'firstname' => 'Ibtihal',
            'lastname' => 'Boujeddaine',
            'username' => '2iboujed',
            'email' => 'ibtihal@example.com',
            'password' => bcrypt('123'),
        ]);
        $user->assignRole('user');

        $this->call(ProductSeeder::class);
    }
}
