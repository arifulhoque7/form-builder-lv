<template>
  <AppLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <div class="flex justify-between items-center mb-6">
              <h1 class="text-2xl font-semibold">Forms</h1>
              <Link
                :href="route('forms.create')"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
              >
                Create New Form
              </Link>
            </div>

            <div v-if="forms.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              <div
                v-for="form in forms"
                :key="form.id"
                class="border dark:border-gray-700 rounded-lg p-4 hover:shadow-lg transition-shadow bg-white dark:bg-gray-800"
              >
                <h2 class="text-xl font-semibold mb-2 dark:text-white">{{ form.title }}</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Method: {{ form.method }}</p>
                <div class="flex space-x-2">
                  <Link
                    :href="route('forms.show', form.id)"
                    class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300"
                  >
                    View
                  </Link>
                  <Link
                    :href="route('forms.edit', form.id)"
                    class="text-green-500 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300"
                  >
                    Edit
                  </Link>
                  <button
                    @click="deleteForm(form.id)"
                    class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                  >
                    Delete
                  </button>
                </div>
              </div>
            </div>
            <div v-else class="text-center py-8">
              <p class="text-gray-600 dark:text-gray-400">No forms found. Create your first form!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Form } from '@/types/form';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted, ref } from 'vue';

const props = defineProps<{
  forms: Form[];
}>();

const forms = ref<Form[]>([]);

onMounted(() => {
  forms.value = props.forms;
});

const deleteForm = async (id: number) => {
  if (confirm('Are you sure you want to delete this form?')) {
    try {
      await router.delete(route('forms.destroy', id));
      forms.value = forms.value.filter(form => form.id !== id);
    } catch (error) {
      console.error('Error deleting form:', error);
    }
  }
};
</script> 