<script setup lang="ts">
    import { VenetianMask } from 'lucide-vue-next';
    import NavLink from './NavLink.vue';
    import { Link } from '@inertiajs/vue3';
</script>
<template>
   <nav class="">
        <div class="w-full flex items-center justify-around bg-white/60 backdrop-blur-lg shadow h-14 fixed top-0 z-100">
            <!-- Logo -->
            <div>
                <div>
                    <Link>
                        <VenetianMask class="text-red-600" />
                    </Link>
                </div>
            </div>

            <!-- NavLinks -->
            <ul class="flex gap-x-6">
                <li>
                    <NavLink href="/" :active="$page.url === '/'">Home</NavLink>
                </li>
                <li>
                    <NavLink href="/media" :active="$page.url === '/media'">Media</NavLink>
                </li>
                <li>
                    <NavLink href="/images" :active="$page.url === '/images'">Images</NavLink>
                </li>
                <li>
                    <NavLink href="/videos" :active="$page.url === '/videos'">Videos</NavLink>
                </li>
                 <li>
                    <NavLink href="/music" :active="$page.url === '/music'">Music</NavLink>
                </li>
                <li>
                    <NavLink href="/documents" :active="$page.url === '/documents'">Documents</NavLink>
                </li>
            </ul>

            <!-- Login/Logout -->
            <div class="flex gap-x-4">
                <div>
                    <Link href="/login" class="text-sm text-red-600 border-[1px] border-red-600 rounded-md py-1 px-2">Log In</Link>
                </div>
                <div>
                    <Link href="/register" class="text-sm text-white bg-red-600 py-1 px-2 rounded-md">Register</Link>
                </div>
            </div>
        </div>
   </nav>
</template>