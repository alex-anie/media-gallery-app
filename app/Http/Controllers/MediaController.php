<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Inertia\Inertia;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class MediaController extends Controller
{
    public function index(){
        $media = Media::orderBy('id', 'desc')->get();
        return Inertia::render("media/Index", ['media' => $media]);
    }
    public function create(){
        return Inertia::render("media/Create");
    }

    public function store(Request $request){
    /**
     * Validate uploaded file
     * Accept images, audio, video, PDF up to 500MB
     */
    $validated = $request->validate([
        'path' => 'required|mimes:jpeg,png,jpg,gif,svg,mp3,wav,mp4,mov,pdf|max:512000',
    ]);

    // Retrieve uploaded file from request
    $file = $request->file('path');

    // Store file in storage/app/public/media
    $path = $file->store('media', 'public');

    // Correct absolute filepath for FFmpeg & getimagesize
    $filePath = storage_path('app/public/' . $path);

    /**
     * Base metadata to store in DB
     */
    $metadata = [
        'path'       => $path,
        'name'       => $file->getClientOriginalName(),
        'extension'  => $file->getClientOriginalExtension(),
        'mime_type'  => $file->getMimeType(),
        'file_size'  => $file->getSize(), // bytes
    ];

    /**
     * Extract image dimensions if it's an image
     */
    if (str_contains($file->getMimeType(), 'image')) {
        [$width, $height] = getimagesize($file);
        $metadata['width']  = $width;
        $metadata['height'] = $height;
    }

    /**
     * Extract audio/video metadata (duration & bitrate)
     * Only runs if FFMPEG is configured on system
     */
    try {
        $ffprobe = \ProtoneMedia\LaravelFFMpeg\Support\FFMpeg::getFFProbe();

        $metadata['duration'] = $ffprobe->format($filePath)->get('duration');
        $metadata['bitrate']  = $ffprobe->format($filePath)->get('bit_rate');
    } catch (\Exception $e) {
        // If FFmpeg fails, still save file without extra metadata
        $metadata['duration'] = null;
        $metadata['bitrate']  = null;
    }

    // Save record to database
    Media::create($metadata);

        return redirect('/media')->with('success', 'media created Successfully');
    
    }

    public function show(Media $media){
        return Inertia::render('media/Show', ['media' => $media]);
    }
}
