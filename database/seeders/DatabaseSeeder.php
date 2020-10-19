<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(10)->create();

        $admin = [
            'name' => 'Admin',
            'email' => 'admin',
            'password' => bcrypt('administrator'),
            'command' => 'administrator',
            'activity_sphere' => 'administrator',
            'role' => 'admin',
        ];

        DB::table('users')->insert($admin);
    }
}
