<?php

namespace App\Services;

use App\Models\Produk;

class ProdukService
{
    // Fungsi untuk memproses penambahan data
    public function simpanData(array $data)
    {
        return Produk::create($data);
    }

    public function hapusData($id)
    {
        $produk = \App\Models\Produk::findOrFail($id);
        return $produk->delete();
    }
}
