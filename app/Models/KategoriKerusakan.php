<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\InstansiScope;

use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([InstansiScope::class])]
class KategoriKerusakan extends Model
{
    /** @use HasFactory<\Database\Factories\KategoriKerusakanFactory> */
    use HasFactory;

    protected $fillable  = [
        'name',
        'kode_unit',
        'kode_kerusakan',
        'sub_kategori'
    ];

    protected $casts = [
        'sub_kategori' => 'array',
    ];
}
