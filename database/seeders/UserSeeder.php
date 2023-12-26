<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
 
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'phone'=> '1234567890',
            'password' => bcrypt('S@urabh123456789'), 
        ]);

        $user->assignRole('Superadmin');
    }
}
