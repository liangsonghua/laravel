<?php

use Illuminate\Database\Seeder;
use App\Repositories\RolesRepository;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = RolesRepository::create([
            'name' => '管理员',
            'section' => '行政部',
            'permissions' => [
                'create' => true,
                'store' => true,
                'edit' => true,
                'update' => true,
                'delete' => true,
            ]
        ]);
        $editor = RolesRepository::create([
            'name' => '梁松华',
            'section' => '流水生产线部',
            'permissions' => [
                'create' => false,
                'store' => false,
                'update' => false,
                'delete' => false,
            ]
        ]);
    }
}
