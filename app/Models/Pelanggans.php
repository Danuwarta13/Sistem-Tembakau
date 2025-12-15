<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggans extends Model
{
    protected $guarded = [];

    public function barangs()
    {
        // Tentukan foreign key yang benar: 'pelanggan_id'
        return $this->hasMany(Barangs::class, 'pelanggan_id');
    }

    public function getTotalKeranjangAttribute()
    {
        // Contoh menghitung jumlah record barang
        return $this->barangs()->count();

        // Jika ingin jumlah total item, misal kolom 'jumlah' di tabel barangs
        // return $this->barangs()->sum('jumlah');
    }
}