<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('is-admin')) {
            // Admin melihat semua testimonial
            $testimonials = Testimonial::latest()->get();
            $averageRating = Testimonial::average('Rating');
        } else {
            // Instansi hanya melihat testimonial mereka sendiri
            $testimonials = Testimonial::where('user_id', auth()->id())->latest()->get();
            $averageRating = Testimonial::where('user_id', auth()->id())->average('Rating');
        }
    
        $userHasTestimonial = Testimonial::where('user_id', auth()->id())->exists(); 
    
        return view('testimonials.index', compact('testimonials', 'averageRating', 'userHasTestimonial'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Riview' => 'required|string|max:500',
            'Rating' => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create([
            'user_id' => auth()->id(), 
            'Riview' => $request->Riview,
            'Rating' => $request->Rating,
        ]);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial berhasil ditambahkan!');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        //
    }
}
