<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $krit = [
            [
                'name' => "SD",                
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SMP",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SMA",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "PESANTREN",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "TK",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "TPQ",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "UMUM",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "PAUD",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];
        \DB::table('jenis')->insert($krit);
    }
}
