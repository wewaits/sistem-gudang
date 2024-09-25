<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    
    use HasFactory;
    protected $table = 'mutasi';
    protected $fillable = [
        'barang_id',
        'user_id',
        'tanggal',
        'jenis_mutasi',
        'jumlah',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
