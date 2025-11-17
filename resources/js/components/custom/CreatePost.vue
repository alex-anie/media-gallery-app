<script setup lang="ts">
    import { SquarePen } from 'lucide-vue-next';
    import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="fixed z-20 right-10 bottom-10 mt-8">
        <Link class="text-white flex items-center gap-x-2 bg-red-500 py-2 px-4 rounded" href="/media/create">
            <SquarePen class="size-4" />
            <span class="text-[12px]">Create Media</span>
        </Link>
    </div>
</template>