<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    //
    protected $fillable = [
        'firstname', 'lastname', 'rooms', 'room_type',
        'check_in', 'check_out', 'package_type', 'family_size',
    ];
}
