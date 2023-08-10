<template>
    <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
        <div class="flex justify-between border-b-2 pb-2">
            <div class="flex items-center">
                <span class="whitespace-nowrap mr-2">per page</span>
                <select
                    class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                >
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="ml-2">found products</span>
            </div>
            <div>
                <input
                    type="text"
                    v-model="search"
                    class="appearance-none relative block w-48 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Type to search products"
                />
            </div>
        </div>
        <table class="table-auto w-full">
            <thead>
                <table-header-cell
                    field="id"
                    :sortField="sortField"
                    :sortDirection="sortDirection"
                    @click="sortProduct('id')"
                    >ID</table-header-cell
                >
                <table-header-cell field="image" :sortField="sortField"
                    >Image</table-header-cell
                >
                <table-header-cell
                    field="title"
                    :sortField="sortField"
                    :sortDirection="sortDirection"
                    @click="sortProduct('title')"
                    >Title</table-header-cell
                >
                <table-header-cell
                    field="price"
                    :sortField="sortField"
                    :sortDirection="sortDirection"
                    @click="sortProduct('price')"
                    >Price</table-header-cell
                >
                <table-header-cell
                    field="updated_at"
                    :sortField="sortField"
                    :sortDirection="sortDirection"
                    @click="sortProduct('updated_at')"
                    >Last Updated At</table-header-cell
                >
                <table-header-cell field="actions">Actions</table-header-cell>
            </thead>
            <tbody>
                <tr v-for="product of displayProducts" :key="product.id">
                    <td class="border-b p-2">{{ product.id }}</td>
                    <td class="border-b p-2">
                        <img
                            class="w-16 h-16 object-cover"
                            :src="product.image_url"
                            alt=""
                        />
                    </td>
                    <td class="border-b p-2">{{ product.title }}</td>
                    <td class="border-b p-2">{{ product.price }}</td>
                    <td class="border-b p-2">{{ product.updated_at }}</td>
                    <td class="border-b p-2"></td>
                </tr>
            </tbody>
        </table>
        <div>
            <button @click="prevPage" :disabled="currentPage === 1">
                Previous
            </button>
            <span>{{ currentPage }}</span>
            <button @click="nextPage" :disabled="currentPage === totalPages">
                Next
            </button>
        </div>
    </div>
</template>

<script setup>
import TableHeaderCell from '../../components/core/table/TableHeaderCell.vue'
import { computed, onMounted, ref } from 'vue';
import { useStore } from 'vuex';
const store = useStore()
const sortField = ref('updated_at')
const sortDirection = ref('desc')
const products = ref()
// const displayProducts = ref()
const search = ref()
const currentPage = 1
const itemsPerPage = 10

onMounted(() => {
    getProduct()
})

function getProduct(){
    store.dispatch('getProduct').then((res)=> {
        products.value = store.state.product.data;
        console.log(store.state.product.data;)
    })
}

const filterProduct = computed(() => {
    const filterData = products.value
    if(search.value) {
        filterData = filterData.filter((data) => data.title.toLowerCase().includes(search.value.toLowerCase()))
    }
    return filterData
})

const displayProducts = computed(() => {
    let sortedData = filterProduct.value
    if(sortField.value) {
        sortedData.sort((a,b) => {
            const A = a[sortField.value]
            const B = b[sortField.value]
            if(sortDirection.value) {
                return B.localeCompare(A)
            } else {
                return A.localeCompare(B)
            }
        })
    }
    const startIndex = (currentPage.value - 1) * itemsPerPage.value;
    const endIndex = currentPage.value * itemsPerPage.value;

    return sortedData.slice(startIndex, endIndex);
}) 

// function applyFilterAndSort(){
//     let filterData = products.value

//     if (search.value) {
//         filterData = filterData.filter(product =>
//             product.title.toLowerCase().includes(search.value.toLowerCase()))
//     }

//     if(sortField.value) {
//         filterData.sort((a,b) => {
//             const A = a[sortField.value]
//             const B = b[sortField.value]
//             if(sortDirection.value) {
//                 return B.localeCompare(A)
//             } else {
//                 return A.localeCompare(B)
//             }
//         })
//     }
//     displayProducts.value = filterData
//     // displayProducts.value = filterData.slice((currentPage.value - 1) * itemsPerPage.value , currentPage.value * itemsPerPage.value )
//     console.log(displayProducts.value)
// }

function sortProduct(field) {
    if(sortField.value === field) {
        sortDirection.value = !sortDirection.value
    } else {
        sortField.value = field
        sortDirection.value = false
    }
}
</script>
