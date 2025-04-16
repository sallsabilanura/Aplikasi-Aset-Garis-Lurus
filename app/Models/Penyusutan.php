<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyusutan extends Model
{
    use HasFactory;

    protected $primaryKey ='PenyusutanID';
    protected $fillable =['AsetID', 'user_id', 'TahunPenyusutan', 'NilaiAwal', 'PenyusutanTahunan', 'NilaiAkhir'];
    protected $table ='penyusutans';
    
    public function aset()
    {
        return $this->belongsTo(Aset::class, 'AsetID');
    }
    
    
 
    public function penyusutan()
    {
        return $this->hasMany(Penyusutan::class, 'PenyusutanID ', 'PenyusutanID ');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
