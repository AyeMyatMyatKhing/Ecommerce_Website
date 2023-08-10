<template>
    <div class="min-w-[160px] w-[160px]  transition-all bg-indigo-700 text-white py-4 px-2">
      <router-link :to="{name: 'app.dashboard'}"
                   class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
        <span class="mr-2 text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </span>
        <span class="text-sm">
          Dashboard
        </span>
      </router-link>
      <router-link :to="{name: 'app.products'}"
                   class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
        <span class="mr-2 text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </span>
        <span class="text-sm">
          Products
        </span>
      </router-link>
      <router-link :to="{name: 'app.users'}"
                   class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
        <span class="mr-2 text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>

        </span>
        <span class="text-sm">
          Users
        </span>
      </router-link>
      <!-- <router-link :to="{name: 'reports.orders'}"
                   class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
        <span class="mr-2 text-gray-300">
          <ChartBarIcon class="w-5"/>
        </span>
        <span class="text-xs">
          Reports
        </span>
      </router-link> -->
    </div>
  </template>