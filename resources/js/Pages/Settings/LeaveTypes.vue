<script setup>
import { ref } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import SettingsNav from '@/Components/SettingsNav.vue'
import { Head,useForm } from '@inertiajs/vue3'
import ConfirmModal from '@/Components/ConfirmModal.vue';

defineProps({
  leaveTypes: {
    type: Array,
    default: () => []
  }
})
const form = useForm({
  'name': '',
  'days_per_year':null,
  'carry_forward':false,
  'carry_forward_limit':null,
  'is_encashable':false,
  'allow_encroachment':false
})

const editingLeaveType = ref(null);
const showFormModal = ref(false);

const openCreateForm =() => {
  editingLeaveType.value = null;
  form.name = '';
  form.days_per_year = null;
  form.carry_forward = false;
  form.carry_forward_limit = null;
  form.is_encashable = false;
  form.allow_encroachment = false;
  showFormModal.value = true;
}
const openEditForm =(leaveType) => {
  editingLeaveType.value = leaveType;
  form.name = leaveType.name;
  form.days_per_year = leaveType.days_per_year;
  form.carry_forward = leaveType.carry_forward;
  form.carry_forward_limit = leaveType.carry_forward_limit;
  form.is_encashable = leaveType.is_encashable;
  form.allow_encroachment = leaveType.allow_encroachment;
  showFormModal.value = true;
}

const submit = () => {
  if(editingLeaveType.value){
    form.put(route('leaveTypes.update',editingLeaveType.value.id),{
      onSuccess:() => {
        showFormModal.value = false;
      }
    })
  }else{
    form.post(route('leaveTypes.store'),{
      onSuccess:() => {
        showFormModal.value = false;
      }
    })
  }
}

const deletingId = ref(null);
const showConfirmModal = ref(false);

const deleteLeaveType = (id) =>{
  deletingId.value=id;
  showConfirmModal.value = true;
}
const confirmDelete = () => {
  form.delete(route('leaveTypes.destroy',deletingId.value),{
    onSuccess:() => {
      showConfirmModal.value = false;
      deletingId.value = null;
    }
  })
}

</script>


<template>
  <Head title="Leave Types" />
  <AuthenticatedLayout pageTitle="Leave Types">
    <div class="p-section-margin">
      <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl border border-[#E8E0D5] shadow-sm flex overflow-hidden min-h-[700px]">

          <SettingsNav />

          <div class="flex-1 p-container-padding space-y-6">

            <!-- Table Section -->
            <div  class="bg-[#FAF8F5] rounded-2xl border border-[#E8E0D5] p-container-padding">
              <div class="flex justify-between items-end mb-8">
                <div>
                  <span class="font-label-caps text-stone-500 block mb-2 uppercase tracking-widest">Configuration</span>
                  <h2 class="font-headline-lg text-on-surface">Leave Types</h2>
                </div>
                <button @click="openCreateForm" class="bg-[#F5D142] text-[#2D2A26] px-6 py-3 rounded-xl font-semibold flex items-center gap-2 hover:shadow-lg transition-shadow">
                  <span class="material-symbols-outlined">add</span>
                  Add Leave Type
                </button>
              </div>

              <div class="overflow-x-auto">
                <table class="w-full text-left">
                  <thead>
                    <tr class="border-b border-[#E8E0D5]">
                      <th class="py-4 font-label-caps text-stone-400 font-semibold">Name</th>
                      <th class="py-4 font-label-caps text-stone-400 font-semibold text-center">Days/Year</th>
                      <th class="py-4 font-label-caps text-stone-400 font-semibold text-center">Carry Forward</th>
                      <th class="py-4 font-label-caps text-stone-400 font-semibold text-center">Limit</th>
                      <th class="py-4 font-label-caps text-stone-400 font-semibold text-center">Encashable</th>
                      <th class="py-4 font-label-caps text-stone-400 font-semibold text-center">Encroach</th>
                      <th class="py-4 font-label-caps text-stone-400 font-semibold text-right">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-[#E8E0D5]/50">
                    <tr v-for="leaveType in leaveTypes" :key="leaveType.id">
                      <td class="py-5">
                        <div class="flex items-center gap-3">
                          <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                          <span class="font-headline-md text-lg">{{leaveType.name}}</span>
                        </div>
                      </td>
                      <td class="py-5 text-center font-display-num text-2xl">{{ leaveType.days_per_year }}</td>
                      <td class="py-5 text-center">
                        <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-bold rounded-full border border-green-100">{{ leaveType.carry_forward }}</span>
                      </td>
                      <td class="py-5 text-center text-stone-600">5 days</td>
                      <td class="py-5 text-center">
                        <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-bold rounded-full border border-green-100">{{ leaveType.carry_forward_limit}}</span>
                      </td>
                      <td class="py-5 text-center">
                        <span class="px-3 py-1 bg-stone-100 text-stone-500 text-xs font-bold rounded-full">{{ leaveType.is_encashable }}</span>
                      </td>
                      <td class="py-5 text-right">
                        <div class="flex justify-end gap-2">
                          <button @click="openEditForm(leaveType)" class="p-2 hover:bg-stone-100 rounded-lg transition-colors text-stone-400 hover:text-stone-900">
                            <span class="material-symbols-outlined">edit</span>
                          </button>
                          <button @click="deleteLeaveType(leaveType.id)" class="p-2 hover:bg-red-50 rounded-lg transition-colors text-stone-400 hover:text-red-500">
                            <span class="material-symbols-outlined">delete</span>
                          </button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Form Section -->
            <div v-if="showFormModal" class="bg-[#FAF8F5] rounded-2xl border border-[#E8E0D5] p-container-padding">
              <div class="mb-8">
                <span class="font-label-caps text-stone-500 block mb-2 uppercase tracking-widest">Entry Panel</span>
                <h2 class="font-headline-lg text-on-surface">Add/Edit Leave Type</h2>
              </div>

              <div class="space-y-8">
                <div class="grid grid-cols-2 gap-8">
                  <div class="space-y-2">
                    <label class="font-label-clean text-stone-600 block">Leave Name</label>
                    <input v-model="form.name" class="w-full p-4 bg-white border border-[#E8E0D5] rounded-xl focus:ring-2 focus:ring-[#F5D142] focus:border-[#F5D142] outline-none transition-all placeholder:text-stone-300" placeholder="e.g. Parental Leave" type="text"/>
                  </div>
                  <div class="space-y-2">
                    <label class="font-label-clean text-stone-600 block">Days per Year</label>
                    <input v-model="form.days_per_year" class="w-full p-4 bg-white border border-[#E8E0D5] rounded-xl focus:ring-2 focus:ring-[#F5D142] focus:border-[#F5D142] outline-none transition-all" placeholder="0" type="number"/>
                  </div>
                </div>

                <div class="grid grid-cols-2 gap-8 items-start">
                  <div class="space-y-6">
                    <div class="flex items-center justify-between p-4 bg-stone-50 rounded-xl border border-[#E8E0D5]">
                      <div>
                        <p class="font-medium text-stone-900">Carry Forward</p>
                        <p class="text-xs text-stone-500">Allow unused days to roll over</p>
                      </div>
                      <input v-model="form.carry_forward" class="w-10 h-5 appearance-none bg-stone-300 rounded-full checked:bg-[#F5D142] transition-colors relative cursor-pointer before:content-[''] before:absolute before:w-4 before:h-4 before:bg-white before:rounded-full before:top-0.5 before:left-0.5 checked:before:left-5 before:transition-all" type="checkbox"/>
                    </div>
                    <div class="p-4 bg-[#FAF8F5] rounded-xl border-2 border-dashed border-[#E8E0D5] space-y-3">
                      <label class="font-label-clean text-stone-600 block">Carry Forward Limit (Days)</label>
                      <input v-model="form.carry_forward_limit" class="w-full p-3 bg-white border border-[#E8E0D5] rounded-lg focus:ring-2 focus:ring-[#F5D142] outline-none transition-all" placeholder="5" type="number"/>
                      <p class="text-[10px] text-stone-400 italic">This limit applies to the rollover from previous year only.</p>
                    </div>
                  </div>

                  <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-stone-50 rounded-xl border border-[#E8E0D5]">
                      <div>
                        <p class="font-medium text-stone-900">Encashable</p>
                        <p class="text-xs text-stone-500">Days can be converted to salary</p>
                      </div>
                      <input v-model="form.is_encashable" class="w-10 h-5 appearance-none bg-stone-300 rounded-full checked:bg-[#F5D142] transition-colors relative cursor-pointer before:content-[''] before:absolute before:w-4 before:h-4 before:bg-white before:rounded-full before:top-0.5 before:left-0.5 checked:before:left-5 before:transition-all" type="checkbox"/>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-stone-50 rounded-xl border border-[#E8E0D5]">
                      <div>
                        <p class="font-medium text-stone-900">Allow Encroachment</p>
                        <p class="text-xs text-stone-500">Can use future leave balance</p>
                      </div>
                      <input v-model="form.allow_encroachment" class="w-10 h-5 appearance-none bg-stone-300 rounded-full checked:bg-[#F5D142] transition-colors relative cursor-pointer before:content-[''] before:absolute before:w-4 before:h-4 before:bg-white before:rounded-full before:top-0.5 before:left-0.5 checked:before:left-5 before:transition-all" type="checkbox"/>
                    </div>
                  </div>
                </div>

                <div class="flex justify-end gap-4 pt-8 border-t border-[#E8E0D5]">
                  <button @click="showFormModal = false" class="px-8 py-3 rounded-xl border border-stone-300 font-semibold text-stone-600 hover:bg-stone-50 transition-colors" type="button">Discard</button>
                  <button @click="submit" class="bg-[#F5D142] text-[#2D2A26] px-10 py-3 rounded-xl font-bold shadow-md hover:shadow-xl transition-all active:scale-95">Save Changes</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <ConfirmModal @confirm="confirmDelete"
                  :show="showConfirmModal"
                  title="Delete Leave Type"
                  message="Are you sure you want to delete this leave type? This action cannot be undone."
                  @close="showConfirmModal = false"        
    />
  </AuthenticatedLayout>
</template>