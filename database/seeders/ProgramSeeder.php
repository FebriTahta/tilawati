<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
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
                $name = 'name' => "munaqosyah santri",
                'slug' => Str::slug("munaqosyah santri"),
                'status'=>1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                $name = 'name' => "standarisasi guru al qur'an level 1",
                'slug' => Str::slug("standarisasi guru al qur'an level 1"),
                'status'=>1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                $name = 'name' => "standarisasi guru al qur'an level 2",
                'slug' => Str::slug("standarisasi guru al qur'an level 2"),
                'status'=>1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                $name = 'name' => "tahfidz",
                'slug' => Str::slug("tahfidz"),
                'status'=>1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                $name = 'name' => "training of trainer",
                'slug' => Str::slug("training of trainer"),
                'status'=>1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                $name = 'name' => "munaqisy",
                'slug' => Str::slug("munaqisy"),
                'status'=>1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];
        \DB::table('programs')->insert($pro);
    }
}
