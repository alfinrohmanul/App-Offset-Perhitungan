<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffsetKertasProduk extends Model
{
    use HasFactory;

    public function kertas() {
        return $this->belongsTo(OffsetJenisKertas::class, 'kertas_id', 'id');
    }

    public function produk() {
        return $this->belongsTo(OffsetProduk::class, 'produk_id', 'id');
    }
}
