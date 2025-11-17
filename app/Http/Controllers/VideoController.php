<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use App\Models\Media;


class VideoController extends Controller
{
    public function index(){
        $videos = Media::where('mime_type', 'LIKE', 'video/%')
                ->orderBy('id', 'desc')->get();
        return Inertia::render("video/Index", ['media' => $videos]);
    }
}
