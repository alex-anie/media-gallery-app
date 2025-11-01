<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

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
            // dd($request->all());
            $file = $request->file("path");

            $validated = $request->validate([
                'path' => 'required|mimes:jpeg,png,jpg,gif,svg,mp3,wav,mp4,mov,pdf|max:20480', // 20MB
            ]);

            $path = $file->store('media', 'public');

            $metadata = [
                'path' => $path,
                'name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ];

            // If image, extract dimensions
            if(str_contains($file->getMimeType(), 'image')){
                [$width, $height] = getimagesize($file);
                $metadata['width'] = $width;
                $metadata['heigh'] = $height;
            }

            // If audio or video, use FFmpeg for duration + bitrate (if installed)
            if(str_contains($file->getMimeType(), 'audio') || str_contains($file->getMimeType(), 'video')){

                // Check if FFmpeg is installed
                if(shell_exec('which ffprobe')){
                    $ffprobe = \FFMpeg\FFProbe::create();

                    $filePath = storage_path('app/public/'.$path);
                    $metadata['duration'] = $ffprobe->format($filePath)->get('duration');
                    $metadata['bitrate'] = $ffprobe->format($filePath)->get('bit_rate');
                }
            }

            Media::create( $metadata );

        return redirect('/media')->with('success', 'media created Successfully');
    
    }

    public function show(){
    //    
    }
}
