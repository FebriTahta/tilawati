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
                'username' => "admin",
                'email'=> "nurulfalah2017@gmail.com",
                'role' => "pusat",
                'password'   => bcrypt("tilawatipusat"),
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'username' => "bendahara",
                // 'name' => "CABANG1",
                'email'=> "bendahara_nf@gmail.com",
                'role' => "bendahara",
                'password'   => bcrypt("tilawatipusat"),
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];
        \DB::table('users')->insert($usr);
    }
}
