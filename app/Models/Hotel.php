<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama',
        'gambar',
        'fasilitas',
        'deskripsi',
        'harga',
        'totalKamar',
    ];

    public function kategoriHotel()
    {
        return $this->belongsTo(KategoriHotel::class, 'category_id');
    }
}
