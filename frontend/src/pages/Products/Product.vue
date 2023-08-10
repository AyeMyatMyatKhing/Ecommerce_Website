<template>
    <div class="flex items-center justify-between mb-3">
        <h1 class="text-3xl font-semibold">Product</h1>
        <button type="button" @click="openModal"
        class="rounded-md bg-blue-700 py-2 px-4 text-white border-transparent text-sm font-medium bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Add new product</button>
    </div>
    <ProductTable />
    <product-modal v-model="showProductModal" @close="modalClose"></product-modal>
</template>

<script setup>
import {ref} from 'vue'
import ProductTable from './ProductTable.vue'
import ProductModal from './ProductModal.vue'
const showProductModal = ref(false)
function openModal(){
    showProductModal.value = true
}
function modalClose() {
    showProductModal.value = false
}
</script>