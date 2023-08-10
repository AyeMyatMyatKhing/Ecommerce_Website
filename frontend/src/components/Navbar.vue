<template>
  <header class="flex justify-between items-center p-3 h-14 shadow bg-white">
    <button @click="$emit('toggle-sidebar')"
        class="flex items-center justify-center rounded transition-colors w-8 h-8 text-gray-700 hover:bg-black/10">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
    <Menu as="div" class="relative inline-block text-left">
      <MenuButton class="flex items-center">
        <img src="https://randomuser.me/api/portraits/men/1.jpg" class="rounded-full w-8 mr-2">
        <small>{{ currentUser.name }}</small>
        <ChevronDownIcon
          class="h-5 w-5 text-violet-200 hover:text-violet-100"
          aria-hidden="true"
        />
      </MenuButton>

      <transition
        enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-75 ease-in"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0"
      >
        <MenuItems
          class="absolute right-0 mt-2 w-36 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        >
          <div class="px-1 py-1">
            <MenuItem>
              <button
              >
                <UserIcon
                  :active="active"
                  class="mr-2 h-5 w-5 text-indigo-400"
                  aria-hidden="true"
                />
                Profile
              </button>
            </MenuItem>
            <MenuItem>
              <button
                @click="logout"
              >
                <LogoutIcon
                  class="mr-2 h-5 w-5 text-indigo-400"
                  aria-hidden="true"
                />
                Logout
              </button>
            </MenuItem>
          </div>
        </MenuItems>
      </transition>
    </Menu>
  </header>
</template>

<script setup>
import ChevronDownIcon from '@heroicons/vue/24/solid/ChevronDownIcon'
import { computed } from "vue"
import { useStore } from "vuex"
import router from '../router'
const store = useStore()

const currentUser = computed(() => store.state.user.data)

function logout(){
  store.dispatch('logout').then((res) => {
    router.push('/login')
  })
}
</script>