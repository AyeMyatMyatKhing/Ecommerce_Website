<template>
  <GuestLayout title="Sign in to your account" @submit="login">
    <div>
      <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
      <div class="mt-2">
        <input id="email" v-model="email" type="text" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
        <!-- <span v-if="error."></span> -->
      </div>
    </div>

    <div>
      <div class="flex items-center justify-between">
        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
        <div class="text-sm">
          <router-link to="/request-password" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</router-link>
          <!-- <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a> -->
        </div>
      </div>
      <div class="mt-2">
        <input id="password" v-model="password" type="password" autocomplete="current-password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
      </div>
    </div>

    <div>
      <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
    </div>

    <p class="mt-10 text-center text-sm text-gray-500">Not a member?</p>
  </GuestLayout>
</template>

<script setup>
import { useStore } from 'vuex';
import { ref } from 'vue';
import GuestLayout from '../components/GuestLayout.vue'
import router from '../router';
const store = useStore()
const email = ref();
const password = ref();
const error = ref();

function login(){
  const data = {
    'email' : email.value,
    'password' : password.value
  }
  store.dispatch('login' , data)
  .then((res) => {
    router.push('/dashboard')
  }).catch((err) => {
    if (err.response.status === 422) {
      error.value = err.response.data.message
    }
  })
}
</script>