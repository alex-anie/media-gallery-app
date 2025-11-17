<script setup lang="ts">
import NavLayouts from '@/layouts/navbar/NavLayouts.vue';
import PageTitle from '@/components/custom/PageTitle.vue';
import CreatePost from '@/components/custom/CreatePost.vue';
import MediaCard from '@/components/custom/MediaCard.vue';
import { MediaData } from '@/types';

defineProps<{ media: MediaData[] }>();

</script>

<template>
    <NavLayouts>
        <div class="w-[90%] mx-auto py-10 mt-10">
            <PageTitle pageTitle="Document Gallery" />
            <CreatePost />
            <!-- Media Content -->
            <MediaCard :items="media"/>
        </div>
    </NavLayouts>
</template>

