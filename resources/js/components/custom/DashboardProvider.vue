<script setup lang="ts">
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarGroup,
    SidebarGroupContent,
    SidebarGroupLabel,
    SidebarHeader,
    SidebarInset,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
    SidebarProvider,
    SidebarRail,
    SidebarTrigger,
} from '@/components/ui/sidebar'
import { VenetianMask, Clapperboard, User } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
import GoBackBtn from '@/components/custom/GoBackBtn.vue';

defineProps<{
    pageName: string
}>();

</script>

<template>
  <SidebarProvider>
    <Sidebar collapsible="offcanvas" variant="sidebar">
      <SidebarHeader>
        <SidebarMenu>
          <SidebarMenuItem>
            <SidebarMenuButton variant="outline" class="group hover:bg-red-600" size="lg">
            <!-- Logo -->
            <div>
                <VenetianMask class="text-red-600 group-hover:text-white" />
            </div>
                
              <div class="grid flex-1 text-left text-sm leading-tight text-slate-900 group-hover:text-white" >
                <span class="truncate font-semibold">Media</span>
                <span class="truncate text-xs">Gallery</span>
              </div>
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>

      <SidebarContent>
        <SidebarGroup>
          <SidebarGroupLabel class="text-slate-900">Dashboard</SidebarGroupLabel>
          <SidebarGroupContent>
            <SidebarMenu>
              <SidebarMenuItem class="text-slate-900">
                <SidebarMenuButton as-child class="hover:bg-red-600 text-slate-900">
                    <Link href="/dashboard/all-media-type">
                        <Clapperboard />
                        <span>All Media Types</span>
                    </Link>
                </SidebarMenuButton>

                <SidebarMenuButton as-child class="hover:bg-red-600 text-slate-900">
                    <Link href="/dashboard/users">
                        <User />
                        <span>Users</span>
                    </Link>
                </SidebarMenuButton>
              </SidebarMenuItem>
            </SidebarMenu>
          </SidebarGroupContent>
        </SidebarGroup>
      </SidebarContent>
      <SidebarFooter />
      <SidebarRail />
    </Sidebar>
    
    <SidebarInset>
    <header class="flex h-16 shrink-0 items-center gap-2 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12">
        <div class="flex items-center gap-2 px-4">
            <SidebarTrigger class="-ml-1" />
            <div class="fixed bottom-5 right-8">
                <GoBackBtn href="/media" />
            </div>
            <p><span class="text-slate-500">Dashboard |</span><span> {{ pageName }}</span></p>
        </div>
    </header>

    <slot></slot>
    </SidebarInset>

  </SidebarProvider>
</template>
