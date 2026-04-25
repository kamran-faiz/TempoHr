<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {useForm} from '@inertiajs/vue3';
import SettingsNav from '@/Components/SettingsNav.vue';
import {ref} from 'vue';
import ConfirmModal from '@/Components/ConfirmModal.vue';
import DesignationModal from '@/Components/DesignationModal.vue';

defineProps({
    designations: {
        type: Array,
        default: () => [],
    },
    departments: {
        type: Array,
        default: () => [],
    },

});

const showConfirmModal = ref(false);
const deletingId = ref(null);

const form = useForm({
    department_id: null,
    name: '',
    description: '',
});

const showModal = ref(false);
const editingDesignation = ref(null);

const openCreateModal = () => {
    form.name = '';
    form.description = '';
    form.department_id = null;
    editingDesignation.value = null;
    showModal.value = true;
};

const openeditModal = (designation) => {
    form.reset();
    form.name = designation.name;
    form.description = designation.description;
    form.department_id = designation.department_id;
    editingDesignation.value = designation;
    showModal.value = true;
};

const submit = () => {
    if (editingDesignation.value) {
        form.put(route('designations.update', editingDesignation.value.id),{
            onSuccess: () => {
                showModal.value = false;
            
            }
        })
    } else {
        form.post(route('designations.store'),{
            onSuccess: () => {
                showModal.value = false;
            }
        });
    }
}


const deleteDesignation = (id) => {
    deletingId.value = id;
    showConfirmModal.value = true;
};
const confirmDelete = () => {
    form.delete(route('designations.destroy', deletingId.value), {
        onSuccess: () => {
            showConfirmModal.value = false;
            deletingId.value = null;
        }
    });
};

</script>

<template>
  <Head title="Designations" />
  <AuthenticatedLayout pageTitle="Designations">
    <div class="p-section-margin">
      <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl border border-[#E8E0D5] shadow-sm flex overflow-hidden min-h-[700px]">
          
          <SettingsNav />

          <div class="flex-1 flex flex-col">
            
            <!-- Content Header -->
            <header class="p-container-padding flex justify-between items-start">
              <div>
                <h2 class="font-headline-lg text-stone-900 mb-1">Designation Management</h2>
                <p class="text-stone-500 font-body-md text-sm">Define and manage the professional roles within your organization.</p>
              </div>
              <button @click="openCreateModal" class="bg-primary-container hover:bg-[#e7c435] text-on-primary-fixed px-6 py-3 rounded-lg font-headline-md text-sm font-bold flex items-center gap-2 transition-colors">
                Add New Designation
              </button>
            </header>

            <!-- Content Body -->
            <div class="px-container-padding pb-container-padding">
              
              <!-- Stats Section -->
              <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-[#F8F3EB] p-6 rounded-xl border border-[#E8E0D5]">
                  <div class="flex justify-between items-start mb-4">
                    <span class="text-stone-400 font-label-caps uppercase tracking-widest text-[10px]">Total Designations</span>
                    <span class="material-symbols-outlined text-stone-400 text-lg">badge</span>
                  </div>
                  <p class="font-display-num text-3xl text-stone-900">{{ designations.length }}</p>
                </div>
                <div class="bg-[#F8F3EB] p-6 rounded-xl border border-[#E8E0D5]">
                  <div class="flex justify-between items-start mb-4">
                    <span class="text-stone-400 font-label-caps uppercase tracking-widest text-[10px]">Total Departments</span>
                    <span class="material-symbols-outlined text-stone-400 text-lg">account_tree</span>
                  </div>
                  <p class="font-display-num text-3xl text-stone-900">{{ departments.length }}</p>
                </div>
                <div class="bg-[#F8F3EB] p-6 rounded-xl border border-[#E8E0D5]">
                  <div class="flex justify-between items-start mb-4">
                    <span class="text-stone-400 font-label-caps uppercase tracking-widest text-[10px]">Total Employees</span>
                    <span class="material-symbols-outlined text-stone-400 text-lg">groups</span>
                  </div>
                  <p class="font-display-num text-3xl text-stone-900">156</p>
                </div>
              </div>

              <!-- Table Section -->
              <div class="border border-[#E8E0D5] rounded-xl overflow-hidden bg-white">
                <table class="w-full text-left border-collapse">
                  <thead>
                    <tr  class="bg-[#FAF8F5] border-b border-[#E8E0D5]">
                      <th class="px-6 py-4 font-label-caps text-[11px] uppercase tracking-wider text-stone-500">Designation</th>
                      <th class="px-6 py-4 font-label-caps text-[11px] uppercase tracking-wider text-stone-500">Department</th>
                      <th class="px-6 py-4 font-label-caps text-[11px] uppercase tracking-wider text-stone-500">Description</th>
                      <th  class="px-6 py-4 font-label-caps text-[11px] uppercase tracking-wider text-stone-500 text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-[#E8E0D5]">
                    <tr v-for="designation in designations" :key="designation.id" class="group hover:bg-[#FAF8F5] transition-colors">
                      <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                          <div class="w-8 h-8 rounded bg-[#F2EDE5] flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-sm">badge</span>
                          </div>
                          <span class="font-headline-md text-sm text-stone-900">{{ designation.name }}</span>
                        </div>
                      </td>
                      <td class="px-6 py-5">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#E5DED8] text-stone-600">{{ designation.department.name }}</span>
                      </td>
                      <td class="px-6 py-5">
                        <p class="text-sm text-stone-500 font-label-clean line-clamp-1">{{designation.description}}</p>
                      </td>
                      <td class="px-6 py-5 text-right">
                        <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                          <button @click="openeditModal(designation)" class="p-2 hover:bg-white rounded-lg border border-transparent hover:border-[#E8E0D5] text-stone-400 hover:text-primary transition-all">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                          </button>
                          <button @click="deleteDesignation(designation.id)" class="p-2 hover:bg-white rounded-lg border border-transparent hover:border-[#E8E0D5] text-stone-400 hover:text-error transition-all">
                            <span class="material-symbols-outlined text-[18px]">delete</span>
                          </button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>

                <!-- Table Footer -->
                <div class="px-6 py-4 bg-[#FAF8F5] border-t border-[#E8E0D5] flex items-center justify-between">
                  <span class="text-xs text-stone-500 font-label-clean">Showing designations</span>
                  <div class="flex items-center gap-2">
                    <button class="p-1 border border-[#E8E0D5] rounded bg-white text-stone-400 hover:text-stone-900 transition-colors">
                      <span class="material-symbols-outlined text-sm">chevron_left</span>
                    </button>
                    <button class="px-3 py-1 border border-primary-container rounded bg-white text-stone-900 text-xs font-bold">1</button>
                    <button class="p-1 border border-[#E8E0D5] rounded bg-white text-stone-400 hover:text-stone-900 transition-colors">
                      <span class="material-symbols-outlined text-sm">chevron_right</span>
                    </button>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <DesignationModal 
    :show="showModal" 
    :departments="departments"
     @close="showModal = false" 
     @submit="submit" 
     :form="form" 
     :editingDesignation="editingDesignation" />

    <ConfirmModal
      :show="showConfirmModal"
      title="Delete Designation"
      message="Are you sure you want to delete this designation? This action cannot be undone."
      confirmText="Delete"
      @confirm="confirmDelete"
      @close="showConfirmModal = false"
    />

  </AuthenticatedLayout>
</template>