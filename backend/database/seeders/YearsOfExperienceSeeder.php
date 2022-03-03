<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YearsOfExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $years_of_experiences = [
            ['id' => 1, 'name' => '0 〜 1'],
            ['id' => 2, 'name' => '2 〜 3'],
            ['id' => 3, 'name' => '3 〜 5'],
            ['id' => 4, 'name' => '5 〜 10'],
            ['id' => 5, 'name' => '10 〜 20'],
            ['id' => 6, 'name' => '20年以上'],
            ['id' => 7, 'name' => 'これから'],
        ];
        DB::table('years_of_experiences')->insert($years_of_experiences);
    }
}
