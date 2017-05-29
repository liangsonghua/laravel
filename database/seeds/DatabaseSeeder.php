<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Seeder\RolesTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}
