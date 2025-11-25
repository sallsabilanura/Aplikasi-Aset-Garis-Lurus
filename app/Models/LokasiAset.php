<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiAset extends Model
{
    use HasFactory;
      protected $primaryKey = 'LokasiID';
    protected $fillable = ['BarangID', 'LokasiBarang', 'Kuantitas', 'Gambar'];
    protected $table = 'lokasi_asets';

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'BarangID');
    }
}
