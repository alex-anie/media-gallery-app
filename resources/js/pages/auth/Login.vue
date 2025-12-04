<script setup lang="ts">
import { reactive } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import { Mail, Lock } from "lucide-vue-next";

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const errors = reactive({
  email: "",
});

function validateEmail() {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  errors.email = regex.test(form.email) ? "" : "Please enter a valid email address.";
}

function submit() {
  validateEmail();
  if (errors.email) return;
  form.post("/login");
}
</script>

<template>
  <div class="min-h-screen bg-slate-100 flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
      <h1 class="text-2xl font-bold text-slate-800 mb-6 text-center">
        Login
      </h1>

      <!-- Email -->
      <label class="block mb-4">
        <span class="text-slate-600 font-medium">Email</span>
        <div class="flex items-center border rounded-lg px-3 mt-1">
          <Mail class="w-5 h-5 text-slate-500" />
          <input
            v-model="form.email"
            @input="validateEmail"
            type="email"
            placeholder="your@email.com"
            class="w-full px-2 py-2 focus:outline-none"
          />
        </div>
        <p v-if="errors.email" class="text-red-600 text-sm mt-1">{{ errors.email }}</p>
      </label>

      <!-- Password -->
      <label class="block mb-6">
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

      <!-- Submit -->
      <button
        @click="submit"
        class="w-full bg-red-600 text-white py-2 rounded-lg font-semibold hover:bg-red-700"
      >
        Login
      </button>

      <!-- Switch to Register -->
      <p class="text-center mt-4 text-slate-600">
        Don't have an account?
        <Link href="/register" class="text-red-600 font-semibold hover:underline">
            Register
        </Link>
        </p>
    </div>
  </div>
</template>
