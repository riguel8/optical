<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@delinoptical.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@delinoptical.com',
                'password' => Hash::make('delinadmin'), 
                'usertype' => 'admin',
                'email_verified_at' => null
            ]
        );
    }
}

