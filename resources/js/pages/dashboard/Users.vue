<script setup lang="ts">
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableFooter,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { Input } from '@/components/ui/input'

import { Link } from '@inertiajs/vue3';
import DashboardProvider from '@/components/custom/DashboardProvider.vue';
import { UserDataTyped } from '@/types';

const props = defineProps<{
    names: {
        data: Array<UserDataTyped>
        links: Array<{url: string | null; label: string; active: boolean}>
        search?: string
    }
}>();

</script>

<template>
<DashboardProvider pageName="Users">
  <div class="w-[80%] mx-auto my-8">
    <div>
        <form>
            <Input type="search" placeholder="Search..." />
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
      <TableRow v-for="user in props.names.data" :key="user.auth.user?.id">
        <TableCell class="font-medium">
          {{ user.auth.user?.id }}
        </TableCell>
        <TableCell>
          <div class="size-5 rounded-full">
            <img class="size-full rounded-full bg-center" :src="user.auth.user?.profile_image" :alt="user.auth.user?.name">
          </div>
        </TableCell>
        <TableCell>{{ user.auth.user?.name }}</TableCell>
        <TableCell>{{ user.auth.user?.email }}</TableCell>
        <TableCell>{{ user.auth.user?.created_at }}</TableCell>
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
    <TableFooter>
      <TableRow>
        <TableCell colspan="3">
          Total
        </TableCell>
        <TableCell class="text-right">
          $2,500.00
        </TableCell>
      </TableRow>
    </TableFooter>
  </Table>
    </div>
</DashboardProvider>
</template>
