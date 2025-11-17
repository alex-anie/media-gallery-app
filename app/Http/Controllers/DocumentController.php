<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use App\Models\Media;


class DocumentController extends Controller
{
    public function index(){
        $docs = Media::where('mime_type', 'LIKE', 'application/%')
                ->orderBy('id', 'desc')->get();
        return Inertia::render("video/Index", ['media' => $docs]);
    }
}
