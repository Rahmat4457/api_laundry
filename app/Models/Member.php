<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table ='member';

    protected $primaryKey = 'id_member';

    protected $fillable = [
        'name',
        'alamat',
        'jenis_kelamin',
        'tlp'
    ];

    protected $hidden =[
        'created_at',
        'updated_at',
    ];
}
