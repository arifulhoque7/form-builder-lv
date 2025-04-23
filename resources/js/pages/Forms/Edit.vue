<template>
  <AppLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <h1 class="text-2xl font-semibold mb-6">Edit Form: {{ form.title }}</h1>

            <form @submit.prevent="submitForm">
              <div class="mb-6">
                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="title">
                  Form Title
                </label>
                <input
                  v-model="form.title"
                  type="text"
                  id="title"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline"
                  required
                />
              </div>

              <div class="mb-6">
                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="method">
                  Method
                </label>
                <select
                  v-model="form.method"
                  id="method"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline"
                  required
                >
                  <option value="GET">GET</option>
                  <option value="POST">POST</option>
                  <option value="PUT">PUT</option>
                  <option value="PATCH">PATCH</option>
                  <option value="DELETE">DELETE</option>
                </select>
              </div>

              <div class="mb-6">
                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="action">
                  Action URL
                </label>
                <input
                  v-model="form.action"
                  type="text"
                  id="action"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline"
                />
              </div>

              <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                  <h2 class="text-xl font-semibold">Form Fields</h2>
                  <button
                    type="button"
                    @click="addField"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                  >
                    Add Field
                  </button>
                </div>

                <div class="space-y-4">
                  <draggable
                    v-model="form.fields"
                    item-key="order"
                    handle=".drag-handle"
                    @end="onDragEnd"
                    class="space-y-4"
                  >
                    <template #item="{ element: field, index }">
                      <div
                        class="border dark:border-gray-700 p-4 rounded-lg bg-white dark:bg-gray-800"
                      >
                        <div class="flex justify-between items-center mb-4">
                          <div class="flex items-center gap-2">
                            <button
                              type="button"
                              class="drag-handle cursor-move text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                            >
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                              </svg>
                            </button>
                            <h3 class="text-lg font-semibold dark:text-white">Field {{ index + 1 }}</h3>
                          </div>
                          <button
                            type="button"
                            @click="removeField(index)"
                            class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                          >
                            Remove
                          </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                          <div>
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                              Type
                            </label>
                            <select
                              v-model="field.type"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline"
                              required
                            >
                              <option value="text">Text</option>
                              <option value="email">Email</option>
                              <option value="number">Number</option>
                              <option value="textarea">Textarea</option>
                              <option value="select">Select</option>
                              <option value="checkbox">Checkbox</option>
                              <option value="radio">Radio</option>
                            </select>
                          </div>

                          <div>
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                              Name
                            </label>
                            <input
                              v-model="field.name"
                              type="text"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline"
                              required
                            />
                          </div>

                          <div>
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                              Label
                            </label>
                            <input
                              v-model="field.label"
                              type="text"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline"
                              required
                            />
                          </div>

                          <div>
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                              Placeholder
                            </label>
                            <input
                              v-model="field.placeholder"
                              type="text"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline"
                            />
                          </div>

                          <div class="flex items-center">
                            <input
                              v-model="field.required"
                              type="checkbox"
                              class="mr-2 dark:bg-gray-700 dark:border-gray-600"
                            />
                            <label class="text-gray-700 dark:text-gray-300 text-sm font-bold">
                              Required
                            </label>
                          </div>

                          <!-- Options for select, radio, and checkbox fields -->
                          <div v-if="['select', 'radio', 'checkbox'].includes(field.type)" class="col-span-2">
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                              Options
                            </label>
                            <div class="space-y-2">
                              <div
                                v-for="(option, optionIndex) in field.options"
                                :key="optionIndex"
                                class="flex items-center gap-2"
                              >
                                <input
                                  v-model="option.label"
                                  type="text"
                                  placeholder="Option Label"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline"
                                />
                                <input
                                  v-model="option.value"
                                  type="text"
                                  placeholder="Option Value"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 dark:border-gray-600 leading-tight focus:outline-none focus:shadow-outline"
                                />
                                <button
                                  type="button"
                                  @click="removeOption(field, optionIndex)"
                                  class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                                >
                                  Remove
                                </button>
                              </div>
                              <button
                                type="button"
                                @click="addOption(field)"
                                class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300"
                              >
                                Add Option
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </template>
                  </draggable>
                </div>
              </div>

              <div class="flex justify-end">
                <button
                  type="submit"
                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                  :disabled="isSubmitting"
                >
                  {{ isSubmitting ? 'Updating...' : 'Update Form' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { router } from '@inertiajs/vue3';
import { Form, FormField } from '@/types/form';
import AppLayout from '@/Layouts/AppLayout.vue';
import draggable from 'vuedraggable';

const props = defineProps<{
  form: Form;
}>();

const form = ref<Form>({
  ...props.form,
  fields: props.form.fields.map(field => ({
    ...field,
    options: field.options || [],
  })),
});

const isSubmitting = ref(false);

const addField = () => {
  form.value.fields.push({
    type: 'text',
    name: '',
    label: '',
    placeholder: '',
    required: false,
    order: form.value.fields.length,
    options: [],
  });
};

const removeField = (index: number) => {
  form.value.fields.splice(index, 1);
  // Update order of remaining fields
  form.value.fields.forEach((field, idx) => {
    field.order = idx;
  });
};

const onDragEnd = () => {
  // Update order of fields after drag
  form.value.fields.forEach((field, idx) => {
    field.order = idx;
  });
};

const addOption = (field: FormField) => {
  if (!field.options) {
    field.options = [];
  }
  field.options.push({
    label: '',
    value: '',
  });
};

const removeOption = (field: FormField, optionIndex: number) => {
  field.options?.splice(optionIndex, 1);
};

const submitForm = async () => {
  if (isSubmitting.value) return;
  
  isSubmitting.value = true;
  try {
    await router.put(route('forms.update', form.value.id), form.value);
  } catch (error) {
    console.error('Error updating form:', error);
  } finally {
    isSubmitting.value = false;
  }
};

onMounted(() => {
  // Initialize any additional data or subscriptions if needed
});

onBeforeUnmount(() => {
  isSubmitting.value = false;
});
</script>

<style scoped>
.drag-handle {
  cursor: move;
  cursor: grab;
}

.drag-handle:active {
  cursor: grabbing;
}
</style> 