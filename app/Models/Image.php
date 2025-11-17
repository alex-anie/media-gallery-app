<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'path',
        'name',
        'extension',
        'mime_type',
        'file_size',
        'file_size',
        'width',
        'height',
        'duration',
        'bitrate',
    ];
}
