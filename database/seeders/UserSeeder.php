<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 

        User::firstOrCreate(
            ['email' => 'tahaYsh@gmail.com'], // Check if user with this email exists

            [
            'name' => 'devtaha',
            'password' => Hash::make('123'),
            'role' => 'admin',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
            ]
        );

        User::firstOrCreate(
            ['email' => 'taha2shorafata@gmail.com'], // Check if user with this email exists
            
            [
            'name' => 'mrtaha',
            'password' => Hash::make('123'),
            'role' => 'representative',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now()
            ]
        );
    }
}
