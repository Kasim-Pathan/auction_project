<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class adminEntry extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        'name' => 'admin',
        'email' => 'sp650911@gmail.com',
        'role' => 'admin',
        'password' => Hash::make('12345678'),
        ]);
    }
}
