<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class UsersImport implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $email = $row['email'];
        if(!$email) return;

        $user = User::where('email', $email)->first();
        if($user) return;

        $name = $row['name'];
        $nameArr = explode(' ', $name);

        $category = $row['category'];
        $location = $row['location'];
        $phone = isset($row['phone']) ? $row['phone'] : null;

        $code = "name=" . urlencode($name) . "&email=" . $email 
            . "&org=" . urlencode($category) . "&jobTitle=" . urlencode($location);

        //
        return new User([
            'code' => $code,
            'phone' => $phone,
            'email' => $email,
            'business' => $category,
            'firstname' => $name[0],
            'lastname' => isset($nameArr[1]) ? $nameArr[1] : '',
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
