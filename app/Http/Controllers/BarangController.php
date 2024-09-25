<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::all();
        return response()->json($barangs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kode' => 'required|string|max:100|unique:barang,kode',
            'kategori' => 'nullable|string|max:100',
            'lokasi' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $barang = Barang::create($request->all());

        return response()->json($barang, 201);
    }

    // Mendapatkan barang berdasarkan ID
    public function show($id)
    {
        $barang = Barang::find($id);
        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }
        return response()->json($barang);
    }

    // Memperbarui barang
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode' => 'required|string|max:100|unique:barang,kode,' . $id,
            'kategori' => 'nullable|string|max:100',
            'lokasi' => 'nullable|string|max:255',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return response()->json($barang);
    }

    // Menghapus barang
    public function destroy($id)
    {
        $barang = Barang::find($id);
        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        } else {
            $barang->delete();

            return response()->json(['message' => 'Barang deleted successfully'], 200);
        }
    }
}
