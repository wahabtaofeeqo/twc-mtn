<?php

namespace App\Imports;

use App\Models\Family;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class FamiliesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Family name
        $name = $row['first_name']  ?? null;
        if(!$name) return;

        $data = [
            'firstname' => $row['first_name'],
            'lastname' => $row['last_name'],
            'rooms' => $row['rooms'],
            'package_type' => $row['package_type'],
            'room_type' => $row['room_type'],
            'family_size' => $row['family_size'] ?? 0,
            'check_in' => Carbon::parse(Date::excelToDateTimeObject($row['check_in']))->format('m-d-Y'),
            'check_out' => Carbon::parse(Date::excelToDateTimeObject($row['check_out']))->format('m-d-Y'),
        ];

        //
        return new Family($data);
    }
}
