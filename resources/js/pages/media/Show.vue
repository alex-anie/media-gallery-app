<script setup lang="ts">
import { MediaData } from "@/types";
import { Link } from "@inertiajs/vue3";
import { ArrowLeft, Pencil, FileVideo, FileAudio, FileImage, FileText } from "lucide-vue-next";

const props = defineProps<{media: MediaData}>();

const media = props.media;

const fileUrl = `/storage/${media.path}`;
</script>

<template>
    <div class="p-6 max-w-4xl mx-auto">

        <!-- Back button -->
        <Link href="/media" class="flex items-center gap-2 text-gray-600 hover:text-black mb-6">
            <ArrowLeft class="w-4 h-4" />
            Back to Media
        </Link>

        <!-- Title -->
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">{{ media.name }}</h1>

            <!-- Edit / Replace button -->
            <Link
                :href="`/media/${media.id}/edit`"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2"
            >
                <Pencil class="w-4 h-4" />
                Edit / Replace
            </Link>
        </div>

        <!-- Media Preview Container -->
        <div class="bg-gray-100 rounded-xl p-4 flex items-center justify-center min-h-[350px] shadow">

            <!-- Image -->
            <img
                v-if="media.mime_type.includes('image')"
                :src="fileUrl"
                :alt="media.name"
                class="max-h-96 rounded-lg shadow object-contain"
            />

            <!-- Video -->
            <video
                v-else-if="media.mime_type.includes('video')"
                :src="fileUrl"
                controls
                class="w-full rounded-lg shadow"
            ></video>

            <!-- Audio -->
            <audio
                v-else-if="media.mime_type.includes('audio')"
                :src="fileUrl"
                controls
                class="w-full"
            ></audio>

            <!-- PDF Preview -->
            <iframe
                v-else-if="media.mime_type.includes('pdf')"
                :src="fileUrl"
                class="w-full h-[500px] rounded-lg"
            ></iframe>

            <!-- Fallback file -->
            <div v-else class="text-center">
                <FileText class="w-12 h-12 mx-auto text-gray-700" />
                <p class="mt-2 text-gray-600">Preview not available</p>
                <a :href="fileUrl" class="text-blue-600 underline mt-2 inline-block">Download File</a>
            </div>
        </div>

        <!-- Media Details -->
        <div class="bg-white p-4 mt-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4">File Details</h2>

            <div class="space-y-2 text-gray-700">
                <p><strong>Name:</strong> {{ media.name }}</p>
                <p><strong>Type:</strong> {{ media.mime_type }}</p>
                <p><strong>Extension:</strong> {{ media.extension }}</p>
                <p><strong>Size:</strong> {{ (media.file_size / 1024 / 1024).toFixed(2) }} MB</p>

                <p v-if="media.duration"><strong>Duration:</strong> {{ media.duration }}s</p>
                <p v-if="media.bitrate"><strong>Bitrate:</strong> {{ (media.bitrate / 1000).toFixed(0) }} kbps</p>

                <p v-if="media.width && media.height">
                    <strong>Resolution:</strong> {{ media.width }} × {{ media.height }}
                </p>
            </div>
        </div>

    </div>
</template>
