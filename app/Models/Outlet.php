<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table ='outlet';

    protected $primaryKey = 'id_outlet';

    protected $fillable = [
        'id_outlet',
        'nama_outlet',
    ];

    protected $hidden =[
        'created_at',
        'updated_at',
    ];
}
