<?php

namespace App\Imports;

use App\Models\Road;
use Maatwebsite\Excel\Concerns\ToModel;

class RoadImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Road([
            'title' => $row[0],
            'latitude' => $row[1],
            'longitude' => $row[2],
            'description' => '',
            'prefecture_id' => $row[3],
            'user_id' => '1',
            'filename' => $row[4],
        ]);
    }

    public function chunkSize(): int
    {
        return 50;
    }
}
