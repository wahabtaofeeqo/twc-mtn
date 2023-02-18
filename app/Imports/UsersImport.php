<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $email = $row['email'];
        $user = User::where('email', $email)->first();
        if($user) return;

        return new User([
            'email' => $email,
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'phone' => $row['phone'],
            'code' => $this->genCode(),
            'business' => $row['business'],
            'super' => true,
        ]);
    }

    function genCode() {
        while (true) {
            $code = random_int(100000, 999999);
            if (!User::where('code', $code)->exists()) break;
        }
        return $code;
    }
}
