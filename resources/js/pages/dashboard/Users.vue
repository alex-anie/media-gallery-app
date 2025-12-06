<script setup lang="ts">
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { Input } from '@/components/ui/input'
import profileIcon from './../../../../public/static-img/profile_icon.jpg'
import { ref, watch } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import DashboardProvider from '@/components/custom/DashboardProvider.vue';

type User = {
      id: number;
      name: string;
      email: string;
      created_at: string;
      profile_image: string;
};

const props = defineProps<{
    users: {
        data: Array<User>
        links: Array<{url: string | null; label: string; active: boolean}>
        filters?:{ 
          search?: string
        }
    }
}>();

const search = ref(props.users.filters?.search || '');

watch(search, (value)=>{
  router.get('', {search: value}, 
    {
      preserveState: true,
      replace: true
    }
  )
})

</script>

<template>
<DashboardProvider pageName="Users">
  <div class="w-[80%] mx-auto my-8">
    <div>
        <form @submit.prevent>
            <Input v-model="search" type="search" placeholder="Search..." />
        </form>
    </div>

    <Table>
    <TableCaption>A list of your recent invoices.</TableCaption>
    <TableHeader>
      <TableRow>
        <TableHead class="w-5">
          ID
        </TableHead>
        <TableHead class="w-[100px]">
          Avatar
        </TableHead>
        <TableHead>Names</TableHead>
        <TableHead>Email</TableHead>
        <TableHead>Created At</TableHead>
        <TableHead class="text-right">
          Actions
        </TableHead>
      </TableRow>
    </TableHeader>
    <TableBody>
      <TableRow v-for="user in props.users.data" :key="user.id">
        <TableCell class="font-medium">
          {{ user.id }}
        </TableCell>
        <TableCell>
          <div class="size-5 rounded-full">
            <img 
                class="size-full rounded-full object-cover" 
                :src="user.profile_image ? `/storage/${user.profile_image}` :  profileIcon" 
                :alt="user.profile_image ? user.name : 'profile image Icon - user does not have image yet'"
            >
          </div>
        </TableCell>
        <TableCell>{{ user.name }}</TableCell>
        <TableCell>{{ user.email }}</TableCell>
        <TableCell>{{ user.created_at }}</TableCell>
        <TableCell  class="flex justify-end gap-x-2">
            <div>
                <Link class="text-blue-600">Edit</Link>
            </div>
            <div>
                <Link class="text-red-600">Delete</Link>
            </div>
        </TableCell>
      </TableRow>
    </TableBody>
  </Table>

   <Link 
          v-for="link in props.users.links"
          :key="link.label"
          :link="link.label"
          :href="link.url ?? ''"
          v-html="link.label"
          class="px-3 py-1 rounded berder"
          :class="{
            'bg-red-600 text-white' : link.active,
            'text-slate-500 cursor-not-allowed' : !link.url
          }"
        />
  </div>

 
</DashboardProvider>
</template>
