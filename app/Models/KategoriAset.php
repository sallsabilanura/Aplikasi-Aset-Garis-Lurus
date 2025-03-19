<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{
    use HasFactory;

    protected $primaryKey ='KategoriID';
    protected $fillable = ['NamaKategori', 'Deskripsi', 'user_id'];
    protected $table ='kategori_asets';


    public function asets()
    {
        return $this->hasMany(Aset::class, 'KategoriID', 'KategoriID');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
