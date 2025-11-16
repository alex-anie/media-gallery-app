<script setup lang="ts">
import { MediaData, MediaFile } from "@/types";
import { useForm, Link } from "@inertiajs/vue3";
import { ArrowLeft, Save } from "lucide-vue-next";
import { ref } from "vue";

const props = defineProps<{media: MediaData}>();

const previewUrl = `/storage/${props.media.path}`;

const newFilePreview = ref(null);

const form = useForm<MediaFile>({
    path: null,
});

const handleFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    const file = target.files?.[0];

    if (file) {
        form.path = file;
    }
};

const submit = () => {
    form.post(`/media/${props.media.id}`, {
        forceFormData: true,
        onSuccess: () => {
            newFilePreview.value = null;
        }
    });
};

</script>

<template>
    <div class="p-6 max-w-3xl mx-auto">

        <!-- Back -->
        <Link href="/media" class="flex items-center gap-2 text-gray-600 hover:text-black mb-6">
            <ArrowLeft class="w-4 h-4" />
            Back to Media
        </Link>

        <h1 class="text-2xl font-bold mb-4">Edit / Replace Media</h1>

        <!-- Current Preview -->
        <div class="rounded-lg p-4 mb-6 flex justify-center">
            <p class="font-semibold text-center text-gray-700 ml-10 mb-2">Current File:</p>

            <!-- Images -->
            <img
                v-if="props.media.mime_type.includes('image')"
                :src="previewUrl"
                class="max-h-64 mx-auto rounded-lg"
            />

            <!-- Video -->
            <video
                v-else-if="props.media.mime_type.includes('video')"
                :src="previewUrl"
                controls
                class="max-h-120 mt-10 rounded-lg"
            ></video>

            <!-- Audio -->
            <audio
                v-else-if="props.media.mime_type.includes('audio')"
                :src="previewUrl"
                controls
                class="w-full"
            ></audio>

            <!-- PDF -->
            <iframe
                v-else-if="props.media.mime_type.includes('pdf')"
                :src="previewUrl"
                class="w-full h-64 rounded-lg"
            ></iframe>

            <p v-else class="text-sm text-gray-600">No preview available for this type.</p>
        </div>

        <!-- Upload New File -->
        <div class="bg-white p-5 shadow rounded-lg border">

            <label class="block mb-3 font-semibold">Upload New File</label>

            <input
                type="file"
                @change="handleFileChange"
                class="border p-3 mb-3 w-full rounded"
            />

            <!-- New File Preview -->
            <div v-if="newFilePreview" class="mt-4">
                <p class="font-semibold text-gray-700 mb-2">New File Preview:</p>

                <img
                    v-if="form.file && form.file.type.includes('image')"
                    :src="newFilePreview"
                    class="max-h-64 mx-auto rounded-lg"
                />

                <video
                    v-else-if="form.file && form.file.type.includes('video')"
                    :src="newFilePreview"
                    controls
                    class="max-h-96 rounded"
                ></video>

                <audio
                    v-else-if="form.file && form.file.type.includes('audio')"
                    :src="newFilePreview"
                    controls
                    class="w-full"
                ></audio>
            </div>

            <!-- Progress -->
            <div v-if="form.progress" class="mt-4 w-full bg-gray-200 rounded-full p-1">
                <div
                    class="bg-green-600 text-white text-xs font-bold text-center rounded-full"
                    :style="{ width: form.progress.percentage + '%' }"
                >
                    {{ form.progress.percentage }}%
                </div>
            </div>

            <button
                @click="submit"
                :disabled="form.processing"
                class="mt-5 flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-lg"
            >
                <Save class="w-4 h-4" />
                Save Changes
            </button>
        </div>

    </div>
</template>
