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
                'name' => "TAHSIN",                
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "TILAWATI",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "TRAINING OF TRAINER",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "TILAWAH",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];
        \DB::table('programs')->insert($pro);
    }
}
