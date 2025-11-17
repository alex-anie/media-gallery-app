<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Models\Media;


class MusicController extends Controller
{
    public function index(){
        $music = Media::where('mime_type', 'LIKE', 'audio/%')
                ->orderBy('id', 'desc')->get();
        return Inertia::render("music/Index", ['media' => $music]);
    }
}
