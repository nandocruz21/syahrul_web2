<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdukRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Wajib return true agar request diizinkan
    }

    public function rules(): array
{
    return [
        'nama_produk' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ];
}
}