<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import SettingsNav from '@/Components/SettingsNav.vue';
import { ref } from 'vue';
import {useForm} from '@inertiajs/vue3';
import ConfirmModal from '@/Components/ConfirmModal.vue';

defineProps({
    allowanceTypes: {
        type: Array,
        default: () =>[]
    },
});

const form = useForm({
    'name': '',
    'type': 'fixed',
});

const editingAllowanceType = ref(null);
const showForm = ref(false);
const showConfirmModal = ref(false);
const deletingId = ref(null);

const openCreateForm = () => {
    form.name = '',
    form.type = 'fixed',
    editingAllowanceType.value = null;
    showForm.value = true;
}
const openEditForm = (allowanceType) => {
      form.name = allowanceType.name,
      form.type = allowanceType.type,
      editingAllowanceType.value = allowanceType;
      showForm.value = true;

}

const submit = () => {
    if(editingAllowanceType.value){
        form.put(route('allowanceTypes.update',editingAllowanceType.value.id),{
         onSuccess : () => {
        showForm.value = false;
         }
    })
    }else{
        form.post(route('allowanceTypes.store'),{
        onSuccess : () => {
        showForm.value = false;
        }
    })
    }
}

const deleteAllowanceType = (allowanceType) => {
    deletingId.value = allowanceType.id;
    showConfirmModal.value = true;
}

const confirmDelete = () => {
    form.delete(route('allowanceTypes.destroy',deletingId.value),{
        onSuccess:() => {
            showConfirmModal.value = false;
            deletingId.value = null;
        }
    })
}
</script>



<template>
  <Head title="Allowance Types" />
  <AuthenticatedLayout pageTitle="Allowance Types">
    <div class="p-section-margin">
      <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl border border-[#E8E0D5] shadow-sm flex overflow-hidden min-h-[700px]">

          <SettingsNav />

          <div class="flex-1 p-container-padding space-y-6">

            <!-- Header Section -->
            <div class="flex justify-between items-end pb-4">
              <div>
                <h1 class="font-headline-lg text-[#2D2A26]">Allowance Types</h1>
                <p class="font-body-md text-stone-500">Configure standard and custom allowance parameters</p>
              </div>
              <button @click="openCreateForm" class="bg-[#F5D142] text-[#2D2A26] px-6 py-3 rounded-lg font-label-caps flex items-center gap-2 hover:shadow-lg transition-all active:scale-95">
                <span class="material-symbols-outlined text-sm">add</span>
                Add Allowance Type
              </button>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl border border-[#E8E0D5] overflow-hidden">
              <table class="w-full text-left">
                <thead class="bg-[#FAF8F5] border-b border-[#E8E0D5]">
                  <tr>
                    <th class="px-6 py-4 font-label-caps text-stone-400">Allowance Name</th>
                    <th class="px-6 py-4 font-label-caps text-stone-400">Type</th>
                    <th class="px-6 py-4 font-label-caps text-stone-400 text-right">Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-[#E8E0D5]">
                  <tr v-for="allowanceType in allowanceTypes" :key="allowanceType.id" class="hover:bg-[#FAF8F5] transition-colors">
                    <td class="px-6 py-5">
                      <span class="font-headline-md text-sm text-[#2D2A26]">{{ allowanceType.name }}</span>
                    </td>
                    <td class="px-6 py-5">
                      <span class="px-3 py-1 bg-[#E5DED8] text-[#4a4642] text-[11px] font-bold rounded-full uppercase tracking-wider">{{ allowanceType.type }}</span>
                    </td>
                    <td class="px-6 py-5 text-right">
                      <div class="flex justify-end gap-2">
                        <button @click="openEditForm(allowanceType)" class="p-2 hover:bg-stone-100 rounded-lg text-stone-400 hover:text-[#2D2A26] transition-colors">
                          <span class="material-symbols-outlined text-xl">edit</span>
                        </button>
                        <button @click="deleteAllowanceType(allowanceType)" class="p-2 hover:bg-error-container rounded-lg text-stone-400 hover:text-error transition-colors">
                          <span class="material-symbols-outlined text-xl">delete</span>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Form -->
            <div v-if="showForm" class="bg-white rounded-xl border border-[#E8E0D5] p-8">
              <div class="flex items-center gap-3 mb-8">
                <div class="w-1.5 h-6 bg-[#F5D142] rounded-full"></div>
                <h2 class="font-headline-md text-[#2D2A26]">Add/Edit Allowance Type</h2>
              </div>

              <div class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                  <div class="space-y-2">
                    <label class="block font-label-caps text-stone-500">Allowance Name</label>
                    <input v-model="form.name"
                      type="text"
                      placeholder="e.g. Health & Wellness"
                      class="w-full bg-white border border-[#E8E0D5] rounded-lg px-4 py-3 focus:ring-2 focus:ring-[#F5D142] focus:border-[#F5D142] font-body-md text-on-surface outline-none transition-all"
                    />
                  </div>
                  <div class="space-y-2">
                    <label class="block font-label-caps text-stone-500">Calculation Type</label>
                    <div class="flex p-1 bg-[#FAF8F5] border border-[#E8E0D5] rounded-xl w-fit">
                      <button 
                         @click="form.type = 'fixed'" 
                         :class="form.type === 'fixed' ? 'bg-[#F5D142] text-[#2D2A26]' : 'text-stone-400 hover:text-stone-600'"
                         class="px-8 py-2.5 rounded-lg font-headline-md text-sm transition-all" 
                         type="button">
                         Fixed Amount
                     </button>
                      <button 
                        @click="form.type = 'percentage'" 
                        :class="form.type === 'percentage' ? 'bg-[#F5D142] text-[#2D2A26]' : 'text-stone-400 hover:text-stone-600'"
                         class="px-8 py-2.5 rounded-lg font-headline-md text-sm transition-all" 
                         type="button">
                                    Percentage
                      </button>
                    </div>
                  </div>
                </div>

                <div class="pt-4 flex justify-end gap-4 border-t border-[#E8E0D5]">
                  <button @click="showForm = false" class="px-8 py-3 rounded-lg border border-[#2D2A26] text-[#2D2A26] font-label-caps hover:bg-stone-50 transition-colors" type="button">
                    Discard Changes
                  </button>
                  <button @click="submit" class="px-10 py-3 rounded-lg bg-[#F5D142] text-[#2D2A26] font-label-caps hover:shadow-lg transition-all active:scale-95">
                    Save Allowance Type
                  </button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <ConfirmModal
      :show="showConfirmModal"
      title="Delete Allowance Type"
      message="Are you sure you want to delete this allowance type? This action cannot be undone."
      confirmText="Delete"
      @confirm="confirmDelete"
      @close="showConfirmModal = false"
    />

  </AuthenticatedLayout>
</template>