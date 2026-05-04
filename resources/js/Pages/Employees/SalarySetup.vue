<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
  employees: {
    type: Array,
    default: () => []
  },
  allowanceTypes: {
    type: Array,
    default: () => []
  },
  employeeSalary: {
    type: Array,
    default: () => []
  },
  currentSalary: {
    type: Object,
    default: null
  }
})

const showModal = ref(false)
const editingSalary = ref(null)

const form = useForm({
  employee_id: '',
  basic_salary: '',
  effective_date: '',
  allowances: []
})

const allowanceRows = ref([])

const addAllowanceRow = () => {
  allowanceRows.value.push({
    id: Date.now(),
    allowance_type_id: '',
    value: ''
  })
}

const removeAllowanceRow = (id) => {
  allowanceRows.value = allowanceRows.value.filter(row => row.id !== id)
}

const submitSalary = () => {
  const payload = {
    employee_id: form.employee_id,
    basic_salary: form.basic_salary,
    effective_date: form.effective_date,
    allowances: allowanceRows.value.map(row => ({
      allowance_type_id: row.allowance_type_id,
      value: row.value
    }))
  }

  if (editingSalary.value) {
    router.put(route('employeeSalary.update', editingSalary.value.id), payload, {
      onSuccess: () => {
        resetForm()
        alert('Salary updated successfully')
      },
      onError: (errors) => {
        console.error(errors)
      }
    })
  } else {
    form.post(route('employeeSalary.store'), {
      ...payload,
      onSuccess: () => {
        resetForm()
        alert('Salary saved successfully')
      },
      onError: (errors) => {
        console.error(errors)
      }
    })
  }
}

const resetForm = () => {
  form.employee_id = ''
  form.basic_salary = ''
  form.effective_date = ''
  allowanceRows.value = []
  editingSalary.value = null
  showModal.value = false
}

const editSalary = (salary) => {
  editingSalary.value = salary
  form.employee_id = salary.employee_id
  form.basic_salary = salary.basic_salary
  form.effective_date = salary.effective_date
  allowanceRows.value = (salary.allowances || []).map(allowance => ({
    id: allowance.id || Date.now(),
    allowance_type_id: allowance.allowance_type_id,
    value: allowance.value
  }))
  showModal.value = true
}

const deleteSalary = (id) => {
  if (confirm('Are you sure you want to delete this salary record?')) {
    router.delete(route('employeeSalary.destroy', id), {
      onSuccess: () => {
        alert('Salary deleted successfully')
      },
      onError: (errors) => {
        console.error(errors)
      }
    })
  }
}

const getEmployeeName = (id) => {
  const emp = props.employees.find(e => e.id === id)
  return emp ? `${emp.first_name} ${emp.last_name}` : 'No Employee Selected'
}

const getEmployeeDesignation = (id) => {
  const emp = props.employees.find(e => e.id === id)
  return emp?.designation?.name || '—'
}

const getEmployeeDepartment = (id) => {
  const emp = props.employees.find(e => e.id === id)
  return emp?.department?.name || '—'
}

const totalGross = computed(() => {
  const basic = Number(form.basic_salary) || 0
  const allowancesTotal = allowanceRows.value.reduce((sum, row) => sum + (Number(row.value) || 0), 0)
  return basic + allowancesTotal
})

const openCreateModal = () => {
  resetForm()
  showModal.value = true
}
</script>

<template>
  <Head title="Salary Setup" />
  <AuthenticatedLayout pageTitle="Salary Setup">
    <div class="p-container-padding max-w-7xl mx-auto space-y-bento-gutter">

      <!-- Header with Add Button -->
      <div class="flex justify-between items-center">
        <div>
          <h2 class="font-headline-lg text-stone-900">Salary Management</h2>
          <p class="text-stone-500">Configure employee salary structures and allowances</p>
        </div>
        <button @click="openCreateModal" class="bg-[#F5D142] text-stone-900 px-6 py-3 rounded-xl font-semibold hover:brightness-95 transition-all flex items-center gap-2">
          <span class="material-symbols-outlined">add</span>
          New Salary Setup
        </button>
      </div>

      <!-- Salary Records List -->
      <section class="bg-white border border-[#E8E0D5] rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-[#E8E0D5] bg-stone-50/50">
          <h3 class="font-headline-md text-stone-900">Existing Salary Records</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-stone-50 border-b border-[#E8E0D5]">
              <tr>
                <th class="text-left px-6 py-3 text-sm font-semibold text-stone-600">Employee</th>
                <th class="text-left px-6 py-3 text-sm font-semibold text-stone-600">Basic Salary</th>
                <th class="text-left px-6 py-3 text-sm font-semibold text-stone-600">Effective Date</th>
                <th class="text-left px-6 py-3 text-sm font-semibold text-stone-600">Total Allowances</th>
                <th class="text-left px-6 py-3 text-sm font-semibold text-stone-600">Gross</th>
                <th class="text-right px-6 py-3 text-sm font-semibold text-stone-600">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-[#E8E0D5]">
              <tr v-for="salary in employeeSalary" :key="salary.id" class="hover:bg-stone-50/50 transition-colors">
                <td class="px-6 py-4">
                  <div>
                    <p class="font-medium text-stone-900">{{ getEmployeeName(salary.employee_id) }}</p>
                    <p class="text-xs text-stone-500">{{ getEmployeeDesignation(salary.employee_id) }}</p>
                  </div>
                </td>
                <td class="px-6 py-4 text-stone-700">PKR {{ Number(salary.basic_salary).toLocaleString() }}</td>
                <td class="px-6 py-4 text-stone-700">{{ salary.effective_date }}</td>
                <td class="px-6 py-4 text-stone-700">
                  PKR {{ (salary.allowances || []).reduce((sum, a) => sum + Number(a.value), 0).toLocaleString() }}
                </td>
                <td class="px-6 py-4 font-semibold text-stone-900">
                  PKR {{ (Number(salary.basic_salary) + (salary.allowances || []).reduce((sum, a) => sum + Number(a.value), 0)).toLocaleString() }}
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                  <button @click="editSalary(salary)" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Edit
                  </button>
                  <button @click="deleteSalary(salary.id)" class="text-red-600 hover:text-red-800 text-sm font-medium">
                    Delete
                  </button>
                </td>
              </tr>
              <tr v-if="employeeSalary.length === 0">
                <td colspan="6" class="px-6 py-12 text-center text-stone-400">
                  No salary records found. Click "New Salary Setup" to create one.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Modal for Create/Edit -->
      <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto shadow-2xl">
          <div class="sticky top-0 bg-white border-b border-[#E8E0D5] px-6 py-4 flex justify-between items-center">
            <h3 class="font-headline-md text-stone-900">{{ editingSalary ? 'Edit Salary Setup' : 'New Salary Setup' }}</h3>
            <button @click="resetForm" class="p-2 hover:bg-stone-100 rounded-full">
              <span class="material-symbols-outlined">close</span>
            </button>
          </div>

          <div class="p-6 space-y-6">
            <!-- Employee Selection -->
            <div>
              <label class="block text-sm font-medium text-stone-700 mb-2">Select Employee</label>
              <select v-model="form.employee_id" class="w-full border border-[#E8E0D5] rounded-lg px-4 py-3 bg-white">
                <option value="">-- Select Employee --</option>
                <option v-for="emp in employees" :key="emp.id" :value="emp.id">
                  {{ emp.first_name }} {{ emp.last_name }} ({{ emp.employee_code }})
                </option>
              </select>
            </div>

            <!-- Basic Salary & Effective Date -->
            <div class="grid grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">Basic Salary (PKR)</label>
                <input v-model="form.basic_salary" type="number" placeholder="0.00" class="w-full border border-[#E8E0D5] rounded-lg px-4 py-3" />
              </div>
              <div>
                <label class="block text-sm font-medium text-stone-700 mb-2">Effective Date</label>
                <input v-model="form.effective_date" type="date" class="w-full border border-[#E8E0D5] rounded-lg px-4 py-3" />
              </div>
            </div>

            <!-- Allowances Section -->
            <div>
              <div class="flex justify-between items-center mb-4">
                <label class="block text-sm font-medium text-stone-700">Allowances</label>
                <button @click="addAllowanceRow" type="button" class="text-sm text-blue-600 hover:text-blue-800 flex items-center gap-1">
                  <span class="material-symbols-outlined text-sm">add</span>
                  Add Allowance
                </button>
              </div>
              <div class="space-y-3">
                <div v-for="(row, index) in allowanceRows" :key="row.id" class="flex gap-3 items-end">
                  <div class="flex-1">
                    <select v-model="row.allowance_type_id" class="w-full border border-[#E8E0D5] rounded-lg px-3 py-2">
                      <option value="">Select Type</option>
                      <option v-for="type in allowanceTypes" :key="type.id" :value="type.id">{{ type.name }}</option>
                    </select>
                  </div>
                  <div class="w-40">
                    <input v-model="row.value" type="number" placeholder="Amount" class="w-full border border-[#E8E0D5] rounded-lg px-3 py-2" />
                  </div>
                  <button @click="removeAllowanceRow(row.id)" class="p-2 text-red-500 hover:text-red-700">
                    <span class="material-symbols-outlined text-sm">delete</span>
                  </button>
                </div>
                <p v-if="allowanceRows.length === 0" class="text-sm text-stone-400 italic">No allowances added. Click "Add Allowance" to add.</p>
              </div>
            </div>

            <!-- Total Gross -->
            <div class="bg-stone-50 p-4 rounded-lg border border-[#E8E0D5]">
              <div class="flex justify-between items-center">
                <span class="font-semibold text-stone-700">Total Monthly Gross:</span>
                <span class="font-headline-md text-stone-900">PKR {{ totalGross.toLocaleString() }}</span>
              </div>
            </div>
          </div>

          <div class="sticky bottom-0 bg-white border-t border-[#E8E0D5] px-6 py-4 flex justify-end gap-3">
            <button @click="resetForm" class="px-6 py-2 border border-stone-300 rounded-lg hover:bg-stone-50">Cancel</button>
            <button @click="submitSalary" class="px-6 py-2 bg-[#F5D142] text-stone-900 rounded-lg font-semibold hover:brightness-95">
              {{ editingSalary ? 'Update Salary' : 'Save Salary' }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>