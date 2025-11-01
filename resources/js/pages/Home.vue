<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';

</script>

<template>
    <section class="flex justify-center mt-30">
        <aside>
            <h1 class="text-6xl font-black">Image Gallery</h1>
            <div class="flex justify-center mt-8">
                <Link class="text-white flex bg-red-500 py-2 px-4 rounded" href="/media">View Images</Link>
            </div>
        </aside>
    </section>
</template>