<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


// Add Pagination and Search in List Mahasiswa


class Mahasiswa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'mahasiswa';
    protected $fillable = [
        'nim',
        'name',
        'address',
        'email'
    ];

    protected $hidden = [];
}
