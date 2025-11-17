<script setup lang="ts">
    defineProps<{
        pageTitle: string
    }>();
</script>
<template>
    <div>
        <h1 class="text-2xl font-bold mb-6 text-red-600">
            {{ pageTitle }}
        </h1>
    </div>
</template>