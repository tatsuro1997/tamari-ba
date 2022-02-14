<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BikeMakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $makers = [
            ['id' => 1, 'name' => 'HONDA'],
            ['id' => 2, 'name' => 'YAMAHA'],
            ['id' => 3, 'name' => 'SUZUKI'],
            ['id' => 4, 'name' => 'KAWASAKI'],
            ['id' => 5, 'name' => 'Harley-Davidson'],
            ['id' => 6, 'name' => 'DUCATI'],
            ['id' => 7, 'name' => 'BMW'],
            ['id' => 8, 'name' => 'APRILIA'],
            ['id' => 9, 'name' => 'BETA'],
            ['id' => 10, 'name' => 'BUELL'],
            ['id' => 11, 'name' => 'FANTIC'],
            ['id' => 12, 'name' => 'HUSQVARNA'],
            ['id' => 13, 'name' => 'ITALJET'],
            ['id' => 14, 'name' => 'KTM'],
            ['id' => 15, 'name' => 'MBK'],
            ['id' => 16, 'name' => 'PIAGGIO'],
            ['id' => 17, 'name' => 'TRIUMPH'],
            ['id' => 18, 'name' => 'その他'],
        ];
        DB::table('makers')->insert($makers);
    }
}
