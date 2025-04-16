<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenghapusanAset extends Model
{
    use HasFactory;
    protected $primaryKey = 'PenghapusanID';
    protected $fillable = ['AsetID', 'user_id', 'Status'];


    public function aset()
    {
        return $this->belongsTo(Aset::class, 'AsetID');
    }
    
}
