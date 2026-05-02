<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ConfirmModal from '@/Components/ConfirmModal.vue';
import AddEmployeeModal from '@/Components/AddEmployeeModal.vue';
import { Head,useForm,router,Link } from '@inertiajs/vue3';
import {ref} from 'vue';


defineProps ({
  employees: {
    type : Array ,
    default :() => [],
  },
  departments: {
     type : Array ,
     default :() => [],
  },
  designations: {
    type : Array ,
    default :() => [],
  }
})
 

const form = useForm ({
  'employee_code': '',
  'first_name': '',
  'last_name':'',
  'email':'',
  'phone':'',
  'cnic':'',
  'date_of_birth':'',
  'gender':'',
  'address':'',
  'emergency_contact_name':'',
  'emergency_contact_phone':'',
  'profile_image':null,
  'department_id':null,
  'designation_id':null,
  'employee_type':'full_time',
  'joining_date':'',
   'reporting_manager_id':null,
   'status':'active',


})



const showConfirmModal = ref(false)
const deletingId = ref(null)
const openDropdown = ref(null)
const showModal = ref(false)
const editingEmployee = ref(null)
const currentStep = ref(1)
const openCreateModal = () => {
  openDropdown.value = null;
  form.reset(),
  editingEmployee.value = null;
  currentStep.value = 1;
  showModal.value = true;
}

const submit = () => {
  if (editingEmployee.value) {
    // For Update - Use POST with _method=PUT (Important for file uploads)
    form
      .transform((data) => ({
        ...data,
        _method: 'PUT',
      }))
      .post(route('employees.update', editingEmployee.value.id), {
        forceFormData: true,
        onSuccess: () => {
          showModal.value = false;
        },
        onError: (errors) => {
          console.error('Update failed with errors:', errors);
        }
      });
  } else {
    // For Create - Keep as POST
    form.post(route('employees.store'), {
      forceFormData: true,
      onSuccess: () => {
        currentStep.value = 1;
        showModal.value = false;
      },
      onError: (errors) => {
        console.error('Create failed with errors:', errors);
      }
    });
  }
};
const deleteEmployee = (employee) => {
  deletingId.value = employee.id;
  showConfirmModal.value = true ;
}

const confirmDelete = () => {
    router.delete(route('employees.destroy', deletingId.value), {
        onSuccess: () => {
            deletingId.value = null;
            showConfirmModal.value = false;
        }
    });
}


const openEditModal = (employee) => {
  openDropdown.value = null;
  editingEmployee.value = employee;

  form.reset(); // Reset form first

  form.first_name = employee.first_name;
  form.last_name = employee.last_name;
  form.email = employee.email;
  form.phone = employee.phone;
  form.employee_code = employee.employee_code;
  form.gender = employee.gender;
  form.cnic = employee.cnic;
  form.department_id = employee.department_id;
  form.designation_id = employee.designation_id;
  form.employee_type = employee.employee_type;
  form.joining_date = employee.joining_date;
  form.address = employee.address;
  form.emergency_contact_name = employee.emergency_contact_name;
  form.emergency_contact_phone = employee.emergency_contact_phone;
  form.profile_image = null;        // Important: Clear previous file

  currentStep.value = 1;
  showModal.value = true;
};

</script>


<template>
  <Head title="Employee Directory" />

  <AuthenticatedLayout pageTitle="Directory">
    <div class="p-container-padding">
      
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
          <h2 class="font-headline-lg text-headline-lg text-[#2D2A26]">Directory</h2>
          <p class="font-body-md text-body-md text-secondary mt-1">Manage and connect with your team members.</p>
        </div>
        
        <div class="flex flex-wrap items-center gap-3">
          <div class="flex items-center gap-3 bg-white border border-[#E8E0D5] p-1.5 rounded-xl">
            <select class="bg-transparent border-none text-sm focus:ring-0 cursor-pointer font-label-clean outline-none">
              <option>All Departments</option>
              <option>Engineering</option>
              <option>Design</option>
            </select>
            <div class="w-px h-4 bg-[#E8E0D5]"></div>
            <select class="bg-transparent border-none text-sm focus:ring-0 cursor-pointer font-label-clean outline-none">
              <option>All Designations</option>
              <option>Lead</option>
              <option>Senior</option>
            </select>
          </div>
          <button @click="openCreateModal" class="flex items-center gap-2 px-6 py-3 bg-[#F5D142] text-[#2D2A26] font-semibold rounded-xl hover:opacity-90 active:scale-95 transition-all shadow-sm">
            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'wght' 600;">add</span>
            <span class="font-headline-md text-base">Add Employee</span>
          </button>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-bento-gutter">
        
        <div  v-for="employee in employees" :key="employee.id" class="bg-white p-6 rounded-xl border border-[#E8E0D5] group hover:border-[#F5D142] transition-all duration-300">
          <div class="flex relative justify-between items-start mb-6">
           <div class="w-16 h-16 rounded-full overflow-hidden bg-secondary-container flex items-center justify-center text-xl font-bold text-[#2D2A26]">
  <img 
    v-if="employee.profile_image" 
    :src="`/storage/${employee.profile_image}`" 
    class="w-full h-full object-cover"
  />
  <span v-else>{{ employee.first_name[0] }}{{ employee.last_name[0] }}</span>
</div>
            <button @click="openDropdown = openDropdown === employee.id ? null : employee.id" class="p-1.5 text-secondary/40 hover:text-[#2D2A26] transition-colors">
              <span class="material-symbols-outlined">more_vert</span>
            </button>
            <div v-if="openDropdown === employee.id" class="absolute right-0 top-8 bg-white border border-[#E8E0D5] rounded-xl shadow-lg z-10 w-36 overflow-hidden">
  <button @click="openEditModal(employee)" class="w-full flex items-center gap-2 px-4 py-3 text-sm text-[#2D2A26] hover:bg-[#FAF8F5] transition-colors">
    <span class="material-symbols-outlined text-sm">edit</span>
    Edit
  </button>
  <button @click="deleteEmployee(employee)" class="w-full flex items-center gap-2 px-4 py-3 text-sm text-error hover:bg-error-container transition-colors">
    <span class="material-symbols-outlined text-sm">delete</span>
    Delete
  </button>
</div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <h3 class="font-headline-md text-lg text-[#2D2A26]">{{ employee.first_name }} {{ employee.last_name }}</h3>
              <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-green-50 text-green-700 border border-green-100">{{ employee.status }}</span>
            </div>
            <p class="font-label-clean text-secondary text-sm">{{ employee.designation.name }}</p>
            <p class="font-label-clean text-secondary/60 text-xs mt-1">{{ employee.department.name }}</p>
          </div>
          <div class="mt-6 pt-6 border-t border-[#F5F0E8] flex gap-2">
            <Link :href="route('employees.show', employee.id)" class="flex-1 py-2 text-center block text-xs font-semibold rounded-lg bg-[#F5F0E8] hover:bg-[#F5D142] transition-colors">Profile</Link>
            <button class="p-2 rounded-lg bg-[#F5F0E8] text-secondary hover:text-[#2D2A26] transition-colors">
              <span class="material-symbols-outlined text-sm">mail</span>
            </button>
          </div>
        </div>
        </div>

      <div class="mt-12 flex items-center justify-between pb-10">
        <p class="font-label-clean text-secondary text-sm">Showing 1 to 1 of 1 employees</p>
        <div class="flex items-center gap-2">
          <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-[#E8E0D5] bg-white hover:bg-[#F5F0E8]">
            <span class="material-symbols-outlined">chevron_left</span>
          </button>
          <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#F5D142] font-bold shadow-sm">1</button>
          <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-white border border-[#E8E0D5]">2</button>
          <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-[#E8E0D5] bg-white hover:bg-[#F5F0E8]">
            <span class="material-symbols-outlined">chevron_right</span>
          </button>
        </div>
      </div>

    </div>
    <ConfirmModal
  :show="showConfirmModal"
  title="Delete Employee"
  message="Are you sure you want to delete this employee? This action cannot be undone."
  confirmText="Delete"
  @confirm="confirmDelete"
  @close="showConfirmModal = false"
/>
    <AddEmployeeModal :editing-employee="editingEmployee" 
    :show="showModal" 
    @update:show="showModal = $event" 
    :form="form" :departments="departments" 
    :designations="designations" 
    :current-step="currentStep" 
    @update:currentStep="currentStep = $event" 
    @submit="submit"/>
  </AuthenticatedLayout>
</template>