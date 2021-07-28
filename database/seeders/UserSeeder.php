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
                'username' => "tilawati_pusat",
                'email'=> "nurulfalah2017@gmail.com",
                'role' => "pusat",
                'password'   => bcrypt("pes_nf_tilawatipusat"),
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'username' => "bendahara_pusat",
                // 'name' => "CABANG1",
                'email'=> "bendahara_nf@gmail.com",
                'role' => "bendahara",
                'password'   => bcrypt("pes_nf_bendahara"),
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];
        \DB::table('users')->insert($usr);
    }
}
