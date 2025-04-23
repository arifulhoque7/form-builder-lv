<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h1 class="text-2xl font-semibold mb-6">{{ form.title }}</h1>

          <form @submit.prevent="submitForm" :action="form.action" :method="form.method">
            <div class="space-y-6">
              <div
                v-for="field in form.fields"
                :key="field.id"
                class="mb-4"
              >
                <label
                  :for="field.name"
                  class="block text-gray-700 text-sm font-bold mb-2"
                >
                  {{ field.label }}
                  <span v-if="field.required" class="text-red-500">*</span>
                </label>

                <!-- Text Input -->
                <input
                  v-if="field.type === 'text'"
                  :type="field.type"
                  :id="field.name"
                  :name="field.name"
                  :placeholder="field.placeholder"
                  v-model="formData[field.name]"
                  :required="field.required"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />

                <!-- Email Input -->
                <input
                  v-else-if="field.type === 'email'"
                  type="email"
                  :id="field.name"
                  :name="field.name"
                  :placeholder="field.placeholder"
                  v-model="formData[field.name]"
                  :required="field.required"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />

                <!-- Number Input -->
                <input
                  v-else-if="field.type === 'number'"
                  type="number"
                  :id="field.name"
                  :name="field.name"
                  :placeholder="field.placeholder"
                  v-model="formData[field.name]"
                  :required="field.required"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                />

                <!-- Textarea -->
                <textarea
                  v-else-if="field.type === 'textarea'"
                  :id="field.name"
                  :name="field.name"
                  :placeholder="field.placeholder"
                  v-model="formData[field.name]"
                  :required="field.required"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  rows="4"
                ></textarea>

                <!-- Select -->
                <select
                  v-else-if="field.type === 'select'"
                  :id="field.name"
                  :name="field.name"
                  v-model="formData[field.name]"
                  :required="field.required"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                >
                  <option value="">Select an option</option>
                  <option
                    v-for="option in field.options"
                    :key="option.value"
                    :value="option.value"
                  >
                    {{ option.label }}
                  </option>
                </select>

                <!-- Checkbox -->
                <div v-else-if="field.type === 'checkbox'" class="flex items-center">
                  <input
                    type="checkbox"
                    :id="field.name"
                    :name="field.name"
                    v-model="formData[field.name]"
                    :required="field.required"
                    class="mr-2"
                  />
                  <label :for="field.name" class="text-gray-700 text-sm">
                    {{ field.label }}
                  </label>
                </div>

                <!-- Radio -->
                <div v-else-if="field.type === 'radio'" class="space-y-2">
                  <div
                    v-for="option in field.options"
                    :key="option.value"
                    class="flex items-center"
                  >
                    <input
                      type="radio"
                      :id="`${field.name}-${option.value}`"
                      :name="field.name"
                      :value="option.value"
                      v-model="formData[field.name]"
                      :required="field.required"
                      class="mr-2"
                    />
                    <label
                      :for="`${field.name}-${option.value}`"
                      class="text-gray-700 text-sm"
                    >
                      {{ option.label }}
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="flex justify-end mt-6">
              <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
              >
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Form } from '@/types/form';

const props = defineProps<{
  form: Form;
}>();

const formData = ref<Record<string, any>>({});

const submitForm = () => {
  // Here you can handle the form submission
  console.log('Form data:', formData.value);
  // You can add validation here if needed
};
</script> 