<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Mutasi;

class MutasiController extends Controller
{
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required|exists:barang,id',
            'user_id' => 'required|exists:users,id',
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|string|max:100',
            'jumlah' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $mutasi = Mutasi::create($request->all());
        return response()->json($mutasi, 201);
    }

    public function update(Request $request, $id)
    {
        $mutasi = Mutasi::find($id);
        if (!$mutasi) {
            return response()->json(['message' => 'Mutasi not found'], 404);
        }
        $mutasi->update($request->all());
        return response()->json($mutasi, 200);
    }

    public function destroy($id)
    {
        $mutasi = Mutasi::find($id);
        if (!$mutasi) {
            return response()->json(['message' => 'Mutasi not found'], 404);
        } else {
            $mutasi->delete();
            return response()->json(['message' => 'Mutasi deleted successfully'], 200);
        }
    }

    // Menampilkan history mutasi untuk tiap barang
    public function historyByBarang($barangId)
    {
        $mutasiHistory = Mutasi::where('barang_id', $barangId)
            ->with(['barang', 'user'])
            ->get();

        if ($mutasiHistory->isEmpty()) {
            return response()->json(['message' => 'No mutasi history found for this barang.'], 404);
        }
        
        return response()->json($mutasiHistory);
    }

    // Menampilkan history mutasi untuk tiap user
    public function historyByUser($userId)
    {
        $mutasiHistory = Mutasi::where('user_id', $userId)
            ->with(['barang', 'user'])
            ->get();
        
        if ($mutasiHistory->isEmpty()) {
            return response()->json(['message' => 'No mutasi history found for this barang.'], 404);
        }

        return response()->json($mutasiHistory);
    }
}
