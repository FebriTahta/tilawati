<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Http\Models\Kota;
use Http\Models\Propinsi;

class KotaProSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //provinsi
        $props = [
            [
                'name' => "Jawa Timur",                
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Jawa Tengah",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Jawa Barat",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Kalimantan Utara",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];
        //kota
        $kots = [
            [
                'name' => "Surabaya",
                'propinsi_id' => "1" ,               
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Sidoarjo",
                'propinsi_id' => "1",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Gresik",
                'propinsi_id' => "1",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Lamongan",
                'propinsi_id' => "1",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Ponorogo",
                'propinsi_id' => "1",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Semarang",
                'propinsi_id' => "2",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Yogyakarta",
                'propinsi_id' => "2",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Solo",
                'propinsi_id' => "2",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Jakarta",
                'propinsi_id' => "3",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'name' => "Banten",
                'propinsi_id' => "3",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

        ];

        \DB::table('propinsis')->insert($props);
        \DB::table('kotas')->insert($kots);
    }
}
