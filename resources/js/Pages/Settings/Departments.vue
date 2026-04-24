<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import SettingsNav from '@/Components/SettingsNav.vue';
import DepartmentModal from '@/Components/DepartmentModal.vue';
import {ref} from 'vue';
import { router } from '@inertiajs/vue3';
import ConfirmModal from '@/Components/ConfirmModal.vue';

const showDepartmentModal = ref(false);   
defineProps({
    departments: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    'name': '',
    'description': '',
});
const deleteDepartment = (id) => {
    if (confirm('Are you sure you want to delete this department? This action cannot be undone.')) {
        router.delete(route('departments.destroy', id), {
            onSuccess: () => {
                // Optionally show a success message or perform additional actions after deletion
            },
        });
    }         
 
}

const isConfirming = ref(false);
const idToDelete = ref(null);

const openDeleteModal = (id) => {
    idToDelete.value = id;
    isConfirming.value = true;
};

const executeDelete = () => {
    router.delete(route('departments.destroy', idToDelete.value), {
        onSuccess: () => {
            isConfirming.value = false;
            idToDelete.value = null;
        },
    });

};

const editform = useForm({
    department_id: null,
    name: '',
    description: '',
});
const openEditModal = (department) => {
    editform.department_id = department.id;
    editform.name = department.name;
    editform.description = department.description;
    showDepartmentModal.value = true;
};

const updateDepartment = () => {
    // We call .put directly on the form object
    editform.put(route('departments.update', editform.department_id), {
        onSuccess: () => {
            showDepartmentModal.value = false;
            editform.reset(); // This clears all fields back to their defaults
        },
    });
};


</script>
<template>
  <Head title="Departments" />
  <AuthenticatedLayout pageTitle="Departments">
    <div class="p-section-margin">
      <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl border border-[#E8E0D5] shadow-sm flex overflow-hidden min-h-[700px]">
          
          <SettingsNav />

          <section class="flex-1 p-container-padding flex flex-col">
            <header class="flex justify-between items-start mb-element-gap">
              <div>
                <h2 class="font-headline-lg text-[#2D2A26] mb-1">Department Management</h2>
                <p class="font-body-md text-[#2D2A26]/60">Manage and organize your company departments</p>
              </div>
              <button @click="showDepartmentModal = true" class="bg-[#F5D142] text-[#2D2A26] px-6 py-3 rounded-lg font-epilogue font-semibold shadow-sm hover:opacity-90 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">add</span>
                Add New Department
              </button>
            </header>

            <!-- Stats Overview -->
            <div class="grid grid-cols-3 gap-bento-gutter mb-section-margin mt-8">
              <div class="bg-[#F8F3EB] p-6 rounded-xl border border-[#E8E0D5]">
                <p class="font-label-caps text-[#2D2A26]/60 mb-2">TOTAL DEPARTMENTS</p>
                <p class="font-display-num text-3xl">08</p>
              </div>
              <div class="bg-[#F8F3EB] p-6 rounded-xl border border-[#E8E0D5]">
                <p class="font-label-caps text-[#2D2A26]/60 mb-2">TOTAL EMPLOYEES</p>
                <p class="font-display-num text-3xl">124</p>
              </div>
              <div class="bg-[#F8F3EB] p-6 rounded-xl border border-[#E8E0D5]">
                <p class="font-label-caps text-[#2D2A26]/60 mb-2">ACTIVE BUDGETS</p>
                <p class="font-display-num text-3xl">100%</p>
              </div>
            </div>

            <!-- Department Table -->
            <div class="flex-1">
              <table class="w-full text-left border-collapse">
                <thead>
                  <tr class="border-b border-[#E8E0D5]">
                    <th class="py-4 font-label-caps text-[#2D2A26]/40">DEPARTMENT NAME</th>
                    <th class="py-4 font-label-caps text-[#2D2A26]/40">DESCRIPTION</th>
                    <th class="py-4 font-label-caps text-[#2D2A26]/40 text-right">ACTIONS</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-[#E8E0D5]/50">
                  <tr v-for="department in departments" :key="department.id" class="hover:bg-[#FAF8F5] transition-colors group">
                    <td class="py-5">
                      <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#E8E0D5] flex items-center justify-center">
                          <span class="material-symbols-outlined text-[#2D2A26]/60">corporate_fare</span>
                        </div>
                        <span class="font-headline-md text-base">{{ department.name }}</span>
                      </div>
                    </td>
                    <td class="py-5 font-body-md text-[#2D2A26]/70">{{ department.description }}</td>
                    <td class="py-5 text-right">
                      <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button @click="openEditModal(department)" class="p-2 hover:bg-[#F5D142]/20 rounded-lg transition-colors text-[#2D2A26]">
                          <span class="material-symbols-outlined">edit</span>
                        </button>
                        <button @click="openDeleteModal(department.id)" class="p-2 hover:bg-error/10 rounded-lg transition-colors text-error">
                          <span  class="material-symbols-outlined">delete</span>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

          </section>
        </div>
      </div>
    </div>
    <DepartmentModal v-if="showDepartmentModal" @close="showDepartmentModal = false"/>
    <ConfirmModal
    :show="isConfirming"
    title="Confirm Deletion"
    message="Are you sure you want to delete this department? This action cannot be undone."
    confirmText="Delete"
    @close="isConfirming = false"
    @confirm="executeDelete"
/>  
  </AuthenticatedLayout>
</template>