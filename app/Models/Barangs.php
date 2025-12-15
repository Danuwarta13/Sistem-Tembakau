<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barangs extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function pelanggan()
    {
        // Barang dimiliki oleh 1 pelanggan
        return $this->belongsTo(Pelanggans::class, 'pelanggan_id', 'id');
    }
}
