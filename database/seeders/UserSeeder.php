<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usr = [
            [
                // 'name' => "PUSAT",
                'username' => "pusat",
                'email'=> "pusat@gmail.com",
                'role' => "pusat",
                'password'   => bcrypt("rahasia"),
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            // [
            //     'username' => "cabang",
            //     // 'name' => "CABANG1",
            //     'email'=> "cb1@gmail.com",
            //     'role' => "cabang",
            //     'password'   => bcrypt("rahasia"),
            //     'created_at' => new \DateTime,
            //     'updated_at' => null,
            // ],

        ];
        \DB::table('users')->insert($usr);
    }
}
