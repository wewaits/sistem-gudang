<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    
    protected $fillable = [
        'nama_barang',
        'kode',
        'kategori',
        'lokasi',
    ];
    public function mutasi()
    {
        return $this->hasMany(Mutasi::class);
    }
}
