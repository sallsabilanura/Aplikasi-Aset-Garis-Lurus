<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $primaryKey ='AsetID';
    protected $fillable =['KategoriID', 'user_id', 'NamaAset','Dana', 'Kuantitas', 'Program', 'KodeAset',  'NilaiPerolehan', 'NilaiResidu', 'MasaManfaat', 'TanggalPerolehan', 'LokasiAset', 'Status'];
    protected $table ='asets';

    public function kategori()
    {
        return $this->belongsTo(KategoriAset::class, 'KategoriID', 'KategoriID'); 
    }
    
 
    public function penyusutan()
    {
        return $this->hasMany(Penyusutan::class, 'PenyusutanID', 'PenyusutanID');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
      public function barangs()
    {
        return $this->hasMany(Barang::class, 'AsetID');
    }
    public function barang()
{
    return $this->hasOne(Barang::class, 'AsetID', 'AsetID');
}


}
