<template>
  <TransitionRoot as="template" :show="show">
    <Dialog as="div" @close="show = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
        leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-black bg-opacity-70 transition-opacity"/>
      </TransitionChild>
      <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
          <TransitionChild as="template" enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-[700px] sm:w-full">
              <header class="py-3 px-4 flex justify-between items-center">
                <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                  Create new Product
                </DialogTitle>
                <button
                  @click="closeModal()"
                  class="w-8 h-8 flex items-center justify-center rounded-full transition-colors cursor-pointer hover:bg-[rgba(0,0,0,0.2)]"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"
                    />
                  </svg>
                </button>
              </header>
              <form @submit.prevent="createProduct" enctype="multipart/form-data">
                <div class="bg-white px-4 pt-5 pb-4">
                  <custom-input label="Product Title" type="text" v-model="title" />
                  <custom-input label="Product Image" type="file" @change="handleFileChange" />
                  <custom-input label="Product Price" type="number" v-model="price" />
                  <custom-input label="Product Descripton" type="textarea" v-model="description" />
                  <custom-input label="Published" type="checkbox" v-model="published"/>
                </div>
                <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                  <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Submit</button>
                  <button type="button" @click="closeModal"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                  Cancel</button>
                </footer>
              </form>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { computed , ref,defineEmits  } from 'vue';
import CustomInput from '../../components/core/CustomInput.vue'
import { TransitionRoot , TransitionChild, Dialog , DialogPanel , DialogTitle } from '@headlessui/vue'
import { useStore } from 'vuex';
const store = useStore()
const title = ref()
const description = ref()
const published = ref()
const price = ref(0)
const selectedFile = ref(null)
const props = defineProps({
    modelValue: Boolean,
    product: {
        required: true,
        type: Object
    }
})
const emits = defineEmits();

const show = computed({
  get: () => props.modelValue,
  set: (value) => emits('update:modelValue', value)
})

function closeModal()
{
  show.value = false
}

// function handleFileChange(event){
//  selectedFile.value = event.target.files[0];
// }

function createProduct(){
  const formData = new FormData()
  formData.append('title' , title.value)
  formData.append('description' , description.value)
  formData.append('price' , price.value)
  formData.append('published' , published.value ? 1 : 0)
  formData.append('image' , selectedFile.value)
  store.dispatch('createProduct' , formData).then((res) => {
    store.dispatch('getProduct')
    closeModal()
  })
}
</script>