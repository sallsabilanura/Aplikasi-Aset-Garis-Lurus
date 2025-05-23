<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $primaryKey ='TestimonialID';
    protected $fillable = ['Riview', 'Rating', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
