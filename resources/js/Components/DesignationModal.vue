<script setup>

defineProps({
    show: Boolean,
    form: Object,
    editingDesignation: {
    type: Object,
    default: null,
    },

    departments:{
        type: Array,
        default: () => []
    }
});



const emit = defineEmits(['close', 'submit']);


</script>


    
<template>
  <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-stone-900/40 backdrop-blur-[2px]">
    <div class="w-full max-w-xl bg-white border border-[#E8E0D5] shadow-2xl rounded-2xl overflow-hidden mx-4">
      
      <!-- Modal Header -->
      <div class="px-container-padding py-8 flex items-center justify-between">
        <h2 class="font-headline-md text-[#2D2A26]">{{ editingDesignation ? 'Edit Designation' : 'Add New Designation' }}</h2>
        <button @click="$emit('close')" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-[#F2EDE5] transition-colors">
          <span class="material-symbols-outlined text-[#2D2A26]/40">close</span>
        </button>
      </div>

      <!-- Modal Form -->
      <div class="px-container-padding pb-8 space-y-6">
        
        <!-- Department Dropdown -->
        <div class="space-y-2">
          <label class="block font-label-caps text-secondary uppercase tracking-wider">Department</label>
          <div class="relative">
            <select v-model="form.department_id" class="w-full h-14 pl-4 pr-10 bg-white border border-[#E8E0D5] rounded-lg appearance-none focus:ring-2 focus:ring-[#F5D142] focus:border-[#F5D142] outline-none font-body-md text-on-surface transition-all">
              <option value="">Select Department</option>
              <option v-for="department in departments" :key="department.id" :value="department.id">{{ department.name }}</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
              <span class="material-symbols-outlined text-[#2D2A26]/40">expand_more</span>
            </div>
          </div>
        </div>

        <!-- Designation Name -->
        <div class="space-y-2">
          <label  class="block font-label-caps text-secondary uppercase tracking-wider">Designation Name</label>
          <input v-model="form.name"
            type="text"
            placeholder="e.g. Senior UX Designer"
            class="w-full h-14 px-4 bg-white border border-[#E8E0D5] rounded-lg focus:ring-2 focus:ring-[#F5D142] focus:border-[#F5D142] outline-none font-body-md text-on-surface placeholder:text-secondary/30 transition-all"
          />
        </div>

        <!-- Description -->
        <div class="space-y-2">
          <label class="block font-label-caps text-secondary uppercase tracking-wider">Description</label>
          <textarea v-model="form.description"
            rows="4"
            placeholder="Briefly describe the core role objectives..."
            class="w-full p-4 bg-white border border-[#E8E0D5] rounded-lg focus:ring-2 focus:ring-[#F5D142] focus:border-[#F5D142] outline-none font-body-md text-on-surface placeholder:text-secondary/30 resize-none transition-all"
          ></textarea>
        </div>

      </div>

      <!-- Modal Footer -->
      <div class="px-container-padding py-8 bg-[#FAF8F5] border-t border-[#E8E0D5] flex items-center justify-end gap-4">
        <button @click="$emit('close')" class="px-8 py-3 rounded-lg font-epilogue font-semibold text-[#2D2A26] border border-[#2D2A26] hover:bg-[#2D2A26]/5 transition-colors">
          Cancel
        </button>
        <button @click="$emit('submit')" class="px-8 py-3 rounded-lg bg-[#F5D142] font-epilogue font-bold text-[#2D2A26] shadow-sm hover:opacity-90 transition-all">
          {{ editingDesignation ? 'Update Designation' : 'Create Designation' }}
        </button>
      </div>

    </div>
  </div>
</template>








