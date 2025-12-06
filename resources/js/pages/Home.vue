<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import PageLayout from '@/layouts/PageLayout.vue';
</script>

<template>
    <PageLayout>
        <section
            class="w-screen h-screen flex justify-center items-center bg-[url(/static-img/noice-particle.jpg)] bg-cover bg-center bg-no-repeat">
            <aside class="">
                <div class="">
                    <h1 class="text-6xl font-black text-center mb-2 text-white">Image Gallery</h1>
                    <p class="text-sm text-slate-100">Manage and view multiple media files directly on your browsers.
                        Supports, <span
                            class="text-slate-700 text-[8px] bg-slate-200 border border-slate-500 p-0.5 rounded">PNG</span>,
                        <span
                            class="text-slate-700 text-[8px] bg-slate-200 border border-slate-500 p-0.5 rounded">PDF</span>,
                        <span
                            class="text-slate-700 text-[8px] bg-slate-200 border border-slate-500 p-0.5 rounded">MP4</span>,
                        <span
                            class="text-slate-700 text-[8px] bg-slate-200 border border-slate-500 p-0.5 rounded">MP3</span>,
                        and more...</p>
                    <div class="flex justify-center mt-8">
                        <Link class="text-white flex bg-red-500 py-2 px-4 rounded" href="/media">View Images</Link>
                    </div>
                </div>
            </aside>
        </section>
    </PageLayout>
</template>