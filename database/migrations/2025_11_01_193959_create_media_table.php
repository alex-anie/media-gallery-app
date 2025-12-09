<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('name');
            $table->string('extension');
            $table->string('mime_type');

            $table->unsignedBigInteger('file_size'); //bytes

            // Image-only field
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();

            // Audio/Video-only
            $table->float('duration')->nullable(); // seconds
            $table->integer('bitrate')->nullable(); // for music/video

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
