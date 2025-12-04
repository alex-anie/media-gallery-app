<script setup lang="ts">
import { reactive } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import { Mail, Lock, User, Image as ImageIcon } from "lucide-vue-next";

const form = useForm({
  name: "",
  email: "",
  password: "",
  profile_image: null as File | null,
});

const errors = reactive({
  email: "",
});

function validateEmail() {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  errors.email = emailRegex.test(form.email)
    ? ""
    : "Email format is incorrect.";
}

function handleFile(event: Event) {
  const files = (event.target as HTMLInputElement).files;
  if (files && files[0]) {
    form.profile_image = files[0];
  }
}

function submit() {
  validateEmail();
  if (errors.email) return;

  form.post("/register", {
    forceFormData: true,
  });
}
</script>

<template>
  <div class="min-h-screen bg-slate-100 flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
      <h1 class="text-2xl font-bold text-slate-800 mb-6 text-center">
        Create an Account
      </h1>

      <!-- Full Name -->
      <label class="block mb-4">
        <span class="text-slate-600 font-medium">Full Name</span>
        <div class="flex items-center border rounded-lg px-3 mt-1">
          <User class="w-5 h-5 text-slate-500" />
          <input
            v-model="form.name"
            type="text"
            placeholder="John Doe"
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
            @input="validateEmail"
            type="email"
            placeholder="example@mail.com"
            class="w-full px-2 py-2 focus:outline-none"
          />
        </div>
        <p v-if="errors.email" class="text-red-600 text-sm mt-1">{{ errors.email }}</p>
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
        <!-- <p v-if="form.errors.profile_image" class="text-red-600 text-sm mt-1">{{ form.errors.profile_image }}</p> -->
      </label>

      <!-- Submit -->
      <button
        @click="submit"
        class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700"
      >
        Register
      </button>

      <!-- Switch to Login -->
      <p class="text-center mt-4 text-slate-600">
        Already have an account?
        <Link href="/login" class="text-red-600 font-semibold hover:underline">
          Login
        </Link>
      </p>
    </div>
  </div>
</template>
