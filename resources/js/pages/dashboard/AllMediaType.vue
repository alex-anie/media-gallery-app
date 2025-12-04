<script setup lang="ts">
    import DashboardProvider from '@/components/custom/DashboardProvider.vue';
    import { MediaData } from '@/types';

    const props = defineProps<{media: MediaData[]}>();

    const totalImageNumber = props.media.filter(item => item.mime_type.includes('image'));
    const totalVideoNumber = props.media.filter(item => item.mime_type.includes('video'));
    const totalMusicNumber = props.media.filter(item => item.mime_type.includes('audio'));
    const totalDocsNumber = props.media.filter(item => item.mime_type.includes('application'));
    const totalMediaNumber = props.media.length;
</script>

<template>
<DashboardProvider pageName="All Media Types">
  <div class="flex flex-1 flex-col gap-4 p-4 pt-0">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="aspect-video rounded-xl bg-muted/50 border border-slate-500 p-4">
              <h1 class="my-4">Total Number of Media in Gallery: {{ totalMediaNumber }}</h1>
              <div>
                <p><span class="text-slate-600">Images: </span><span>{{ totalImageNumber.length }}</span></p>
                <p><span class="text-slate-600">Videos: </span><span>{{ totalVideoNumber.length }}</span></p>
                <p><span class="text-slate-600">Music: </span><span>{{ totalMusicNumber.length }}</span></p>
                <p><span class="text-slate-600">Documents: </span><span>{{ totalDocsNumber.length }}</span></p>
              </div>
            </div>
            <div class="aspect-video rounded-xl bg-muted/50" />
            <div class="aspect-video rounded-xl bg-muted/50" />
        </div>
        <div class="min-h-screen flex-1 rounded-xl bg-muted/50 md:min-h-min" />
      </div>
</DashboardProvider>
</template>
