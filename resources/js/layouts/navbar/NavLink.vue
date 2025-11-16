<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';

    defineProps<{
        href: string,
        active: boolean
    }>();
</script>
<template>
    <Link 
        :href="href" 
        :class="[active ? 'text-red-600': 'text-slate-600', 'text-sm hover:text-red-400 transition-color duration-75 ease-in']"
        >
        <slot></slot>
    </Link>
</template>