<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ImagesController extends Controller
{
    public function index(){
        $images = Image::orderBy('id', 'desc')->get();
        return Inertia::render("index/ImagesIndex", ['images' => $images]);
    }
    public function create(){
        return Inertia::render("create/ImagesCreate");
    }

    public function store(Request $request){
        // dd($request);

        // Validate only image files up to 2MB
        $validated = $request->validate([
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Store file in storage/app/public/images
        if ($request->hasFile('path')) {
            $validated['path'] = $request->file('path')->store('images', 'public');
        }

        // Save file path to DB
        Image::create($validated);

        return redirect('/images')->with('success', 'Image created Successfully');
    
    }

    public function show(Image $images){
    //    
    }
}
