<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biro extends Model
{
    protected $primaryKey = 'kode_biro';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_biro', 'nama_biro', 'kode_deputi'];
}
