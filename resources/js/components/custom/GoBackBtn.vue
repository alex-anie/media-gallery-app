<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import { ArrowLeft } from 'lucide-vue-next';

    defineProps<{
        href: string
    }>();
</script>

<template>
    <Link :href class="flex items-center gap-2 text-gray-600 hover:text-black mb-6">
        <ArrowLeft class="w-4 h-4" />
            Back to Media
    </Link>
</template>