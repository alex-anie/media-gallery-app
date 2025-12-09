<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Mail, Lock, User, Image as ImageIcon } from "lucide-vue-next";

type User = {
    id: number;
    name: string;
    email: string;
    created_at: string;
    profile_image: string;
}

const props = defineProps<{user: User}>();

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  password: "",
  profile_image: null as File | null,
});

function handleFile(event: Event) {
  const files = (event.target as HTMLInputElement).files;
  if (files && files[0]) {
    form.profile_image = files[0];
  }
}

function submit(){
    form.post(`/dashboard/users/${props.user.id}`, {
        forceFormData: true
    });
}
</script>

<template>
  <div class="min-h-screen bg-slate-100 flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
      <h1 class="text-2xl font-bold text-slate-800 mb-6 text-center">
        Update an Account
      </h1>

      <!-- Full Name -->
      <label class="block mb-4">
        <span class="text-slate-600 font-medium">Full Name</span>
        <div class="flex items-center border rounded-lg px-3 mt-1">
          <User class="w-5 h-5 text-slate-500" />
          <input
            v-model="form.name"
            type="text"
            class="w-full px-2 py-2 focus:outline-none"
          />
        </div>
         <p v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</p>
      </label>

      <!-- Email -->
      <label class="block mb-4">
        <span class="text-slate-600 font-medium">Email</span>
        <div class="flex items-center border rounded-lg px-3 mt-1">
          <Mail class="w-5 h-5 text-slate-500" />
          <input
            v-model="form.email"
            type="email"
            class="w-full px-2 py-2 focus:outline-none"
          />
        </div>
        <p v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</p>
      </label>

      <!-- Password -->
      <label class="block mb-4">
        <span class="text-slate-600 font-medium">Password</span>
        <div class="flex items-center border rounded-lg px-3 mt-1">
          <Lock class="w-5 h-5 text-slate-500" />
          <input
            v-model="form.password"
            type="password"
            placeholder="********"
            class="w-full px-2 py-2 focus:outline-none"
            />
        </div>
        <p v-if="form.errors.password" class="text-red-600 text-sm mt-1">{{ form.errors.password }}</p>
      </label>

      <!-- Profile Image -->
      <label class="block mb-6">
        <span class="text-slate-600 font-medium">Profile Image</span>
        <div class="flex items-center border rounded-lg px-3 py-2 mt-1">
          <ImageIcon class="w-5 h-5 text-slate-500" />
          <input
            @change="handleFile"
            type="file"
            accept="image/*"
            class="ml-3"
          />
        </div>
      </label>

      <!-- Submit -->
      <button
        @click="submit"
        class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700"
      >
        Update User
      </button>
    </div>
  </div>
</template>
