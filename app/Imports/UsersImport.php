<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

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
        if(!$email) return;

        $exist = User::where('email', $row['email'])->exists();
        if($exist) return null;

        return new User([
            'email' => $row['email'],
            'name' => $row['name'],
            'password' => 'password'
        ]);
    }
}
