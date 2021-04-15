<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
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
                'name' => "SEBAGAI GURU AL QUR'AN METODE TILAWATI",
                'untuk' => "GURU",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SEBAGAI INSTRUKTUR LAGU DAN MUNAQISY METODE TILAWATI",
                'untuk' => "GURU",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SEBAGAI INSTRUKTUR LAGU DAN MUNAQISY SANTRI METODE TILAWATI",
                'untuk' => "GURU",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SEBAGAI INSTRUKTUR LAGU DAN STRATEGI MENGAJAR METODE TILAWATI",
                'untuk' => "GURU",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SEBAGAI INSTRUKTUR LAGU METODE TILAWATI",
                'untuk' => "GURU",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SEBAGAI INSTRUKTUR LAGU, STRATEGI MENGAJAR DAN MUNAQISY METODE TILAWATI",
                'untuk' => "GURU",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SEBAGAI INSTRUKTUR LAGU, STRATEGI MENGAJAR DAN MUNAQISY SANTRI METODE TILAWATI",
                'untuk' => "GURU",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SEBAGAI INSTRUKTUR STRATEGI MENGAJAR DAN MUNAQISY METODE TILAWATI",
                'untuk' => "GURU",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SEBAGAI INSTRUKTUR STRATEGI MENGAJAR METODE TILAWATI",
                'untuk' => "GURU",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "SEBAGAI SANTRI KHATAM 30 JUZ",
                'untuk' => "SANTRI",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];
        \DB::table('kriterias')->insert($krit);
    }
}
