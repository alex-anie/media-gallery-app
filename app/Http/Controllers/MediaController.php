<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
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
        'user_id' => Auth::id(),
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
        return redirect()->route('media.index')->with('success', 'media created Successfully');
    }

    public function show(Media $media){
        return Inertia::render('media/Show', ['media' => $media]);
    }

    public function edit(Media $media){
        return Inertia::render('media/Edit', ['media' => $media]);
    }

    public function update(Request $request, Media $media){

        if(! Gate::allows('update-media', $media)){
            abort(403);
        }

        $validated = $request->validate([
            'path' => 'required|mimes:jpeg,png,jpg,gif,svg,mp3,wav,mp4,mov,pdf|max:512000',
        ]);

        $file = $request->file('path');

        $path = $file->store('media', 'public');

        $filePath = storage_path('app/public/' . $path);

        $metadata = [
            'path'       => $path,
            'name'       => $file->getClientOriginalName(),
            'extension'  => $file->getClientOriginalExtension(),
            'mime_type'  => $file->getMimeType(),
            'file_size'  => $file->getSize(), // bytes
        ];

        if (str_contains($file->getMimeType(), 'image')) {
            [$width, $height] = getimagesize($file);
            $metadata['width']  = $width;
            $metadata['height'] = $height;
        }

        try {
            $ffprobe = \ProtoneMedia\LaravelFFMpeg\Support\FFMpeg::getFFProbe();

            $metadata['duration'] = $ffprobe->format($filePath)->get('duration');
            $metadata['bitrate']  = $ffprobe->format($filePath)->get('bit_rate');
        } catch (\Exception $e) {
            $metadata['duration'] = null;
            $metadata['bitrate']  = null;
        }

        $media->update($metadata);
        return redirect()->route('media.index')->with('success', 'media updated Successfully');
        
    }

    public function destroy(Media $media){

        if(! Gate::allows('delete-media', $media)){
            abort(403);
        }
    
        $media->delete();
        return redirect()->route('media.index')->with('success', 'media deleted Successfully');
    }
}
