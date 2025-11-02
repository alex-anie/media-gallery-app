<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import { Trash2, Music, Video, FileText } from 'lucide-vue-next';
    import { MediaData } from '@/types';


    defineProps<{ media : MediaData[]}>();

</script>

<template>
   <div class="w-[80%] mx-auto py-10">
     <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold mb-6 text-red-600">Media Gallery</h1>
        <div class=" mt-8">
            <Link class="text-white flex bg-red-500 py-2 px-4 rounded" href="/media/create">Create Media</Link>
        </div>
     </div>

    <!-- Gallery empty state -->
    <div v-if="media.length === 0" class="flex-col items-center mt-20 text-gray-500">
        <Trash2 class="w-14 h-14 mb-4" />
        <p class="text-xl font-semibold">Gallery is Empty</p>
    </div>

    <!-- Media Grid -->
    <div v-else class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <Link
            v-for="item in media"
            :key="item.id"
            :href="`/media/${item.id}`"
            class="block group p-1 border rounded-xl shadow-sm hover:shadow-md transition duration-300"
        >
            <div class="rounded-lg overflow-hidden w-full h-100 bg-gray-100 flex items-center justify-center">
                <!-- Image Preview -->
                <img
                    v-if="item.mime_type.includes('image')" 
                    :src="`/storage/${item.path}`" 
                    :alt="item.name"
                    class="w-full h-full object-cover transition group-hover:scale-105"
                    >

                <!-- Audio Icon -->
                 <Music
                    v-else-if="item.mime_type.includes('audio')"
                    class="w-12 h-12 text-red-600"
                />
                

                <!-- Video Thumbnail -->
                 <div v-else-if="item.mime_type.includes('video')"
                    class=" text-red-600">

                    <video controls autoplay loop muted playsinline class="h-full w-full rounded-3xl object-cover object-[50%_50%]">
                        <source :src="`/storage/${item.path}`" :type="item.mime_type" />
                    </video>
                </div>
                

                <!-- PDF / File -->
                <FileText 
                    v-else
                    class="w-12 h-12 text-red-600"
                />
            </div>

            <!-- Metadata -->
            <div class="mt-3 text-sm">
                <p class="font-semibold text-gray-800 truncate">{{ item.name }}</p>
                <p class="text-gray-600">{{ (item.file_size / 1024 / 1024).toFixed(2) }} MB</p>

                <!-- Show dimensions if image -->
                <p class="text-gray-500 text-xs">{{ item.width }} x {{ item.height }}</p>

                <!-- Duration if audio/video -->
                <p v-if="item.duration" class="text-gray-500 text-xs">
                    Duration: {{ item.duration.toFixed(1) }}s
                </p>

                <!-- Show Icon -->
                 <Video
                     v-else-if="item.mime_type.includes('video')"
                    class="w-12 h-12 text-red-600"
                />

                <div v-else-if="item.mime_type.includes('audio')">
                    <audio class="h-8 w-full"  controls :src="`/storage/${item.path}`"></audio>
                 </div>
            </div>

            <!-- Button -->
             <button 
                class="mt-3 w-full py-2 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700 transition"
             >
                View File
             </button>
        </Link>
    </div>
   </div>
</template>