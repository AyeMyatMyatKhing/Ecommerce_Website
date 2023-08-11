<template>
  <div class="bg-white p-4 rounded-lg shadow animate-fade-in-down">
    <div class="flex justify-between border-b-2 pb-2">
      <div class="flex items-center">
        <span class="whitespace-nowrap mr-2">per page</span>
        <select
            v-model="itemsPerPage"
            class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
        >
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span class="ml-2">found {{ products.length }} products</span>
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
          <td class="border-b p-2">
            <Menu as="div" class="relative inline-block text-left">
              <MenuButton
                class="inline-flex items-center justify-center w-full justify-center rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-white hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-6 h-6 text-black"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                  />
                </svg>
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
                    class="absolute z-10 right-0 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                  >
                    <div class="p-1">
                      <MenuItem v-slot="{ active }">
                        <button
                            @click="openModal(product.id)"
                            :class="[
                                active
                                    ? 'bg-indigo-600 text-white'
                                    : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                            ]"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                />
                            </svg>
                            Edit
                        </button>
                      </MenuItem>
                      <MenuItem v-slot="{ active }">
                        <button
                            :class="[
                                active
                                    ? 'bg-indigo-600 text-white'
                                    : 'text-gray-900',
                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                            ]"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                />
                            </svg>
                            Delete
                        </button>
                      </MenuItem>
                    </div>
                  </MenuItems>
              </transition>
            </Menu>
          </td>
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
import TableHeaderCell from "../../components/core/table/TableHeaderCell.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { computed, onMounted, ref } from "vue";
import { useStore } from "vuex";
const store = useStore();
const sortField = ref("updated_at");
const sortDirection = ref("desc");
const products = ref([]);
const search = ref();
const currentPage = ref(1);
const itemsPerPage = ref(10);

onMounted(() => {
    getProduct();
});

const filterProduct = computed(() => {
  const filterData = products.value;
  if (search.value) {
    return filterData.filter((data) =>
      data.title.toLowerCase().includes(search.value.toLowerCase())
    );
  }
  return filterData;
});

const displayProducts = computed(() => {
  let sortedData = filterProduct.value.slice();
  if (sortField.value) {
      sortedData.sort((a, b) => {
          const aValue = a[sortField.value];
          const bValue = b[sortField.value];
          if (sortField.value === "price" || sortField.value === "id") {
              return (
                  (aValue - bValue) * (sortDirection.value === "asc" ? 1 : -1)
              );
          } else {
              return (
                  aValue.localeCompare(bValue) *
                  (sortDirection.value === "asc" ? 1 : -1)
              );
          }
      });
  }
  const startIndex = (currentPage.value - 1) * itemsPerPage.value;
  const endIndex = currentPage.value * itemsPerPage.value;

  return sortedData.slice(startIndex, endIndex);
});

function getProduct() {
  store.dispatch("getProduct").then((res) => {
    products.value = store.state.product.data;
  });
}

function sortProduct(field) {
  if (sortField.value === field) {
    sortDirection.value = sortDirection.value === "desc" ? "asc" : "desc";
  } else {
    sortField.value = field;
    sortDirection.value = "asc";
  }
}
</script>
