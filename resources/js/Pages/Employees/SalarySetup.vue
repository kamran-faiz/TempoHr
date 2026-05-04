<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { Head,useForm,router,Link } from '@inertiajs/vue3';

defineProps({
  employee: {
    type: Object,
    required: true
  },
  allowanceTypes:{
    type:Array,
    default :() => [],
  },
  currentSalary:{
    type:Object,
    required: true
  }
})

const form = useForm({
  'employee_id' : '',
  'basic_salary' : '',
  'effective_date' :'',
  'allowances' : []
})
</script>

<template>
  <Head title="Salary Setup" />
  <AuthenticatedLayout pageTitle="Salary Setup">
    <div class="p-container-padding max-w-5xl mx-auto space-y-bento-gutter">

      <!-- Employee Snapshot Card -->
      <section class="bg-white border border-[#E8E0D5] p-6 rounded-xl flex items-center justify-between">
        <div class="flex items-center gap-6">
          <div class="relative">
            <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-primary-container bg-secondary-container flex items-center justify-center text-2xl font-bold text-[#2D2A26]">
              Employee
            </div>
            <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 border-2 border-white rounded-full"></div>
          </div>
          <div>
            <h2 class="font-headline-md text-stone-900">Employee Name</h2>
            <p class="font-label-clean text-stone-500 flex items-center gap-2">
              <span class="material-symbols-outlined text-sm">badge</span>
              Designation
            </p>
            <p class="font-label-clean text-stone-400 flex items-center gap-2">
              <span class="material-symbols-outlined text-sm">lan</span>
              Department
            </p>
          </div>
        </div>
        <div class="flex gap-3">
          <button class="px-4 py-2 border border-stone-200 rounded-lg font-label-clean hover:bg-stone-50 transition-colors">View Profile</button>
          <button class="px-4 py-2 bg-stone-50 border border-stone-200 rounded-lg font-label-clean hover:bg-stone-100 transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">history</span>
            History
          </button>
        </div>
      </section>

      <!-- Main Setup Form Card -->
      <section class="bg-white border border-[#E8E0D5] p-container-padding rounded-xl">
        <div class="flex justify-between items-center mb-8">
          <div>
            <span class="font-label-caps text-stone-400 uppercase">Financial Configuration</span>
            <h3 class="font-headline-md text-stone-900">Salary Structure</h3>
          </div>
          <span class="material-symbols-outlined text-stone-300 scale-125">account_balance_wallet</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
          <div class="space-y-2">
            <label class="font-label-clean text-stone-600 block">Basic Salary</label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-stone-400">PKR</span>
              <input
                type="number"
                placeholder="0.00"
                class="w-full pl-14 pr-4 py-3 bg-white border border-[#E8E0D5] rounded-lg focus:ring-2 focus:ring-[#F5D142] focus:border-[#F5D142] outline-none transition-all font-display-num text-xl"
              />
            </div>
            <p class="text-[11px] text-stone-400 font-label-clean">Standard monthly basic compensation before deductions.</p>
          </div>
          <div class="space-y-2">
            <label class="font-label-clean text-stone-600 block">Effective Date</label>
            <input
              type="date"
              class="w-full px-4 py-3 bg-white border border-[#E8E0D5] rounded-lg focus:ring-2 focus:ring-[#F5D142] focus:border-[#F5D142] outline-none transition-all font-body-md h-[58px]"
            />
            <p class="text-[11px] text-stone-400 font-label-clean">Date from which this salary setup becomes active.</p>
          </div>
        </div>

        <!-- Allowances Section -->
        <div class="border-t border-[#E8E0D5] pt-8">
          <div class="flex justify-between items-center mb-6">
            <h4 class="font-headline-md text-stone-900 text-lg">Allowances & Benefits</h4>
            <button class="flex items-center gap-2 px-4 py-2 border border-stone-900 rounded-lg font-label-clean text-stone-900 hover:bg-stone-50 transition-all">
              <span class="material-symbols-outlined text-sm">add</span>
              Add Allowance
            </button>
          </div>

          <div class="space-y-4">
            <!-- Allowance Row -->
            <div class="flex flex-wrap md:flex-nowrap items-start gap-4 p-4 rounded-xl border border-dashed border-[#E8E0D5] bg-stone-50/50">
              <div class="w-full md:w-1/3 space-y-1">
                <label class="font-label-caps text-[10px] text-stone-400 uppercase">Type</label>
                <select class="w-full px-4 py-2 bg-white border border-[#E8E0D5] rounded-lg font-label-clean outline-none focus:border-[#F5D142]">
                  <option value="">Select Allowance Type</option>
                </select>
              </div>
              <div class="w-full md:w-1/4 space-y-1">
                <label class="font-label-caps text-[10px] text-stone-400 uppercase">Value</label>
                <input
                  type="number"
                  placeholder="0.00"
                  class="w-full px-4 py-2 bg-white border border-[#E8E0D5] rounded-lg font-label-clean outline-none focus:border-[#F5D142]"
                />
              </div>
              <div class="pt-6">
                <button class="p-2 text-stone-400 hover:text-error hover:bg-error-container rounded-lg transition-all">
                  <span class="material-symbols-outlined">delete</span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <div class="mt-12 flex items-center justify-between border-t border-[#E8E0D5] pt-8">
          <div class="space-y-1">
            <span class="font-label-caps text-stone-400 uppercase">Total Monthly Gross</span>
            <p class="font-display-num text-3xl text-stone-900">PKR 0.00</p>
          </div>
          <button class="bg-[#F5D142] text-stone-900 px-12 py-4 rounded-xl font-headline-md hover:brightness-95 active:scale-98 transition-all flex items-center gap-3 shadow-lg shadow-primary-container/20">
            Save Salary Setup
            <span class="material-symbols-outlined">check_circle</span>
          </button>
        </div>
      </section>

      <!-- Bottom Note -->
      <div class="bg-surface-container border border-[#E8E0D5] p-6 rounded-xl flex gap-4 items-start">
        <span class="material-symbols-outlined text-primary">info</span>
        <div class="space-y-1">
          <p class="font-label-clean text-stone-700 font-bold">Policy Compliance Check</p>
          <p class="text-sm text-stone-500">Salary setup will be effective from the date specified above and will apply to the next payroll cycle.</p>
        </div>
      </div>

    </div>
  </AuthenticatedLayout>
</template>