<script setup lang="ts">
import { ImageUp, Image as ImageIcon } from 'lucide-vue-next'
import { useForm } from '@inertiajs/vue3'
import type { MediaFile } from '@/types'

const form = useForm<MediaFile>({
    path: null,
})

function submit() {
    form.post('/media', {
        forceFormData: true
    })
}

const handleImageInput = (e: Event) => {
    const target = e.target as HTMLInputElement
    const file = target.files?.[0]
    if (file) {
        form.path = file
    }
}
</script>

<template>
    <main class="min-h-screen flex items-center justify-center bg-gray-50 p-6">
        <div class="w-[90%] md:w-[50%] bg-white p-8 rounded-xl shadow-lg border">

            <!-- Title -->
            <h1 class="text-2xl font-bold text-center text-red-600 mb-8">
                Upload Media File
            </h1>

            <form @submit.prevent="submit" class="space-y-6">
                
                <!-- Upload Box -->
                <div class="flex flex-col items-center border border-gray-200 rounded-xl p-6 cursor-pointer hover:bg-gray-100 transition">

                    <label for="path" class="flex flex-col items-center cursor-pointer">
                        <ImageIcon class="w-12 h-12 text-red-600 mb-2" />
                        <span class="text-red-600 font-medium">Select Media File</span>
                    </label>

                    <input
                        id="path"
                        type="file"
                        class="hidden"
                        name="path"
                        @change="handleImageInput"
                    />

                    <p v-if="form.path" class="mt-2 text-sm text-gray-700">
                        Selected: {{ form.path?.name }}
                    </p>

                    <p class="text-red-500 text-sm mt-2">{{ form.errors.path }}</p>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-red-600 text-white py-3 rounded-lg font-medium hover:bg-red-700 transition duration-300"
                >
                    <ImageUp class="w-5 h-5" />
                    Save Media
                </button>
            </form>
        </div>
    </main>
</template>
