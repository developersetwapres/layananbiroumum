<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\InstansiScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([InstansiScope::class])]
class DaftarRuangan extends Model
{
    /** @use HasFactory<\Database\Factories\DaftarRuanganFactory> */
    use HasFactory;

    protected $casts = [
        'fasilitas' => 'array'
    ];

    protected $fillable = [
        'nama_ruangan',
        'kode_unit',
        'kode_ruangan',
        'lokasi',
        'kapasitas',
        'kapasitas_max',
        'image',
        'status',
        'fasilitas',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'kode_unit', 'kode_unit');
    }
}
