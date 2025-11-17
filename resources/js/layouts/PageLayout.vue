<script setup lang="ts">
    import Footer from './footer/Footer.vue';
    import Nav from './navbar/Nav.vue';
</script>
<template>
    <div>
        <Nav />
    </div>
    <div>
        <slot></slot>
    </div>
    <div>
        <Footer />
    </div>
</template>