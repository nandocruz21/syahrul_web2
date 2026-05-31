<?php

namespace App\Http\Controllers;


use App\Services\ProdukService;
use App\Models\Produk;
use Exception;

class ProdukController extends Controller
{
    protected $service;

    // Dependency Injection: Menggunakan Service untuk logika bisnis
    public function __construct(ProdukService $service)
    {
        $this->service = $service;
    }

   // Ubah fungsi index menjadi return JSON
public function index()
{
    $produks = Produk::all();
    return response()->json($produks); // Mengembalikan JSON, bukan view()
}

// Ubah fungsi store agar respon-nya JSON juga
public function store(StoreProdukRequest $request)
{
    try {
        $data = $this->service->simpanData($request->validated());
        return response()->json(['message' => 'Data berhasil ditambah!', 'data' => $data], 201);
    } catch (Exception $e) {
        return response()->json(['message' => 'Gagal: ' . $e->getMessage()], 500);
    }
}

public function destroy($id)
{
    try {
        $this->service->hapusData($id); 
        return response()->json(['message' => 'Data berhasil dihapus!'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Data tidak ditemukan!'], 404);
    }
}
}