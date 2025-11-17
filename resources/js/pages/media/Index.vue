<script setup lang="ts">
import PageTitle from '@/components/custom/PageTitle.vue';
import CreatePost from '@/components/custom/CreatePost.vue';
import MediaCard from '@/components/custom/MediaCard.vue';
import { MediaData } from '@/types';
import PageLayout from '@/layouts/PageLayout.vue';

defineProps<{ media: MediaData[] }>();
defineOptions({
    layout: PageLayout
})

</script>

<template>
    <PageLayout>
        <div class="w-[90%] mx-auto py-10 mt-10">
            <PageTitle pageTitle="Media Gallery" />
            <CreatePost />

            <!-- Media Content -->
            <MediaCard :items="media"/>
        </div>
    </PageLayout>
</template>