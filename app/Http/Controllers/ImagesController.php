<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use App\Models\Media;


class ImagesController extends Controller
{
    public function index(){
        $images = Media::where('mime_type', 'LIKE', 'image/%')
                ->orderBy('id', 'desc')->get();
        return Inertia::render("images/Index", ['media' => $images]);
    }
}
