<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pro = [
            [
                'name' => "training of trainer",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "munaqys",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "tahfidz",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "munaqosyah santri",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "standarisasi guru al qur'an",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];
        \DB::table('programs')->insert($pro);
    }
}
