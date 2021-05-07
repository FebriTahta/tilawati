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
                'name' => "TPQ",                
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "TK/RA",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SD/MI",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SMP/MTS",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SMU/SMA",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "KURSUS",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "UMUM",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "PESANTREN",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];
        \DB::table('jenjangs')->insert($krit);
    }
}
