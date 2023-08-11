<template>
  <div>
    <label>{{ label }}</label>
    <div class="mt-1 flex round-md shadow-sm">
      <template v-if="type === 'textarea'">
      <textarea :class="inputClass" :name="name" @input="$emit('update:modelValue' , $event.target.value)"></textarea>
      </template>
      <template v-else-if="type === 'file'">
        <input :type="type" :class="inputClass" :name="name" @input="$emit('change' , $event.target.files[0])">
      </template>
      <template v-else-if="type === 'checkbox'">
        <input :type="type" 
          :id="id"
          :name="name"
          class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
          @change="$emit('update:modelValue' , $event.target.checked)">
        <label :for="id" class="ml-2 block text-sm text-gray-900">{{ label }}</label>
      </template>
      <template v-else>
        <input :type="type" :class="inputClass" :name="name" @input="$emit('update:modelValue' , $event.target.value)">
      </template>
    </div>
  </div>
</template>
<script setup>
import { computed } from "vue"

const props = defineProps({
  label: String,
  type: {
    type: String,
    default: 'text'
  },
  name: String
})

const inputClass = computed(()=> {
  return "block mb-2 w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
})
</script>