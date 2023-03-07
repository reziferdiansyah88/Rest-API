<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Members extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'members';
    protected $fillable = [
        'username',
        'address'
    ];

    protected $hidden = [];
}
