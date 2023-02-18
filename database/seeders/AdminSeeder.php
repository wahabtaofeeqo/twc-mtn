<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate([
            'code' => '111111',
            'firstname' => 'Admin',
            'lastname' => 'Super',
            'email' => 'admin@yahoo.com'
        ]);
    }
}
