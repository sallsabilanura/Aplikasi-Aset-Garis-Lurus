<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey ='BarangID';
    protected $fillable =['BarangID',  'AsetID', 'Invoice', 'user_id'];
    protected $table ='barangs';

      public function aset()
    {
        return $this->belongsTo(Aset::class, 'AsetID');
    }
      public function lokasis()
    {
        return $this->hasMany(LokasiAset::class, 'BarangID');
    }
     public function gambar()
    {
        return $this->hasMany(LokasiAset::class, 'BarangID', 'BarangID')
                    ->whereNotNull('Gambar');
    }

        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
