<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'Admin', 'email' => 'tagkader@hotmail.fr', 'password' => bcrypt('kaderkader06'), 'is_admin' => 1]);

        //
    }
}
