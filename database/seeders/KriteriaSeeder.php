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
                'name' => "sebagai guru al-qur'an metode tilawati",
                'untuk' => "guru",
                'program_id' => "2",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "sebagai instruktur mengajar strategi tilawati",
                'untuk' => "instruktur",
                'program_id' => "4",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "sebagai santri khatam al-qur'an 30 juz",
                'untuk' => "santri",
                'program_id' => "1",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];
        \DB::table('kriterias')->insert($krit);
    }
}
