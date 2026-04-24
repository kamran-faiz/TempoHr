<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineEmits } from 'vue';


const emit = defineEmits(['close']);


const props = defineProps({
    department: {
        type: Object,
        default: null,
    },
});
const form = useForm({
    'name': props.department ? props.department.name : '',
    'description': props.department ? props.department.description : '',
});

const submitDepartment = () => {
   
    if (props.department) {
        form.put(route('departments.update', props.department.id), {
            onSuccess: () => {
                emit('close');
            },
        });
    } else {
        form.post(route('departments.store'), {
            onSuccess: () => {
                emit('close');
            },
        });
    }
   
};
</script>
<template>
  <!-- Modal Overlay -->
  <div class="fixed inset-0 z-50 flex items-center justify-center bg-on-surface/50">
    
    <!-- Modal Box -->
    <div class="w-full max-w-3xl bg-surface-container-lowest border border-outline-variant rounded-xl p-container-padding shadow-xl mx-4 max-h-[90vh] overflow-y-auto">
      
      <!-- Header -->
      <div class="flex items-center justify-between mb-10">
        <div>
          <h3 class="text-headline-md font-epilogue text-on-surface mb-2">{{ props.department ? 'Update Department' : 'Create Department' }}</h3>
          <p class="text-body-md font-manrope text-on-surface-variant">Set up the structure and leadership for your new organizational unit.</p>
        </div>
        <button @click="emit('close')" class="p-2 hover:bg-surface-container-low rounded-lg transition-colors">
          <span class="material-symbols-outlined text-on-surface-variant">close</span>
        </button>
      </div>

      <div class="space-y-8">

        <!-- Department Name -->
        <div class="space-y-2">
          <label class="text-label-caps font-manrope text-on-surface-variant block px-1">DEPARTMENT NAME</label>
          <input
            class="w-full px-4 py-4 rounded-lg border border-outline-variant bg-surface focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all text-body-md font-manrope text-on-surface placeholder:text-outline"
            placeholder="e.g. Experience Design"
            type="text"
            v-model="form.name"
          />
        </div>
        <p v-if="form.errors.name" class="text-error text-body-sm">
          {{ form.errors.name }}
        </p>

        <!-- Description -->
        <div class="space-y-2">
          <label class="text-label-caps font-manrope text-on-surface-variant block px-1">DEPARTMENT DESCRIPTION</label>
          <textarea v-model="form.description"
            class="w-full px-4 py-4 rounded-lg border border-outline-variant bg-surface focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all text-body-md font-manrope text-on-surface placeholder:text-outline resize-none"
            placeholder="Briefly describe the responsibilities and objectives of this department..."
            rows="4"
          ></textarea>
        </div>

        <!-- Actions -->
        <div class="pt-8 border-t border-outline-variant flex justify-end items-center gap-4">
          <button @click="emit('close')" class="px-8 py-3 rounded-lg border border-on-surface text-on-surface font-manrope font-semibold hover:bg-surface-container-low transition-colors">
            Cancel
          </button>
          <button  @click="submitDepartment" :disabled="form.processing" class="px-8 py-3 rounded-lg bg-primary-container text-on-primary-container font-epilogue font-bold shadow-sm hover:opacity-90 active:scale-95 transition-all">
           {{ props.department ? 'Update Department' : 'Create Department' }}
          </button>
         
        </div>

      </div>
    </div>
  </div>
</template>