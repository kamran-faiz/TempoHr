<script setup>
import { ref } from 'vue'

const currentStep = ref(1)

const steps = [
  { title: 'Basic Info' },
  { title: 'Job Details' },
  { title: 'Salary' },
  { title: 'Documents' }
]

const form = ref({
  basic: {
    fullName: '',
    email: '',
    phone: '',
    dob: '',
    gender: '',
    cnic: ''
  },
  job: {
    department: '',
    designation: '',
    employmentType: '',
    joiningDate: '',
    reportingManager: '',
    workLocation: ''
  },
  salary: {
    basicSalary: null,
    houseAllowance: null,
    transportAllowance: null,
    medicalAllowance: null,
    taxDeduction: null
  }
})

const nextStep = () => {
  if (currentStep.value < 4) currentStep.value++
}

const prevStep = () => {
  if (currentStep.value > 1) currentStep.value--
}

const finishOnboarding = () => {
  alert('Employee profile created successfully! 🎉')
  // Here you would normally submit the form
  console.log('Final Form Data:', form.value)
}
</script>






</script>





<template>
  <div class="min-h-screen bg-[#F5F0E8] font-body-md text-on-surface p-6">
    <div class="max-w-5xl mx-auto">
      <!-- Header -->
      <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-stone-900 font-headline-md">
          Onboard New Employee
        </h1>
        <p class="text-stone-500 mt-1">Complete the employee enrollment process step by step.</p>
      </div>

      <!-- Step Indicator -->
      <div class="bg-white rounded-2xl border border-[#E8E0D5] p-8 mb-8">
        <div class="flex items-center justify-between relative">
          <!-- Progress Line -->
          <div class="absolute top-6 left-0 h-0.5 bg-[#E8E0D5] w-full -z-10"></div>
          <div 
            class="absolute top-6 left-0 h-0.5 bg-primary-container transition-all duration-500"
            :style="{ width: `${((currentStep - 1) / 3) * 100}%` }"
          ></div>

          <!-- Steps -->
          <div v-for="(step, i) in steps" :key="i" class="flex flex-col items-center relative z-10">
            <div 
              class="w-11 h-11 rounded-full flex items-center justify-center font-bold text-sm ring-4 ring-white transition-all"
              :class="{
                'bg-primary-container text-on-primary-container': currentStep > i + 1,
                'bg-primary-container text-on-primary-container ring-primary-container/30': currentStep === i + 1,
                'bg-white border-2 border-[#E8E0D5] text-stone-400': currentStep < i + 1
              }"
            >
              <span v-if="currentStep > i + 1" class="material-symbols-outlined text-xl">check</span>
              <span v-else>{{ i + 1 }}</span>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider mt-3 font-label-caps"
                  :class="{ 'text-stone-900': currentStep >= i + 1, 'text-stone-400': currentStep < i + 1 }">
              {{ step.title }}
            </span>
          </div>
        </div>
      </div>

      <!-- Form Content -->
      <div class="bg-white rounded-2xl border border-[#E8E0D5] overflow-hidden">
        
        <!-- Step 1: Basic Info -->
        <div v-if="currentStep === 1" class="p-10">
          <div class="mb-10">
            <h3 class="text-2xl font-semibold font-headline-md text-stone-900">Personal Identity</h3>
            <p class="text-stone-500 mt-1">Foundational information for the new employee record.</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Full Name</label>
              <input v-model="form.basic.fullName" type="text" placeholder="e.g. Julian Montgomery"
                     class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5] focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 outline-none"/>
            </div>
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Professional Email</label>
              <input v-model="form.basic.email" type="email" placeholder="julian.m@company.com"
                     class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5] focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 outline-none"/>
            </div>
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Phone Number</label>
              <input v-model="form.basic.phone" type="tel" placeholder="+1 (555) 000-0000"
                     class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5] focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 outline-none"/>
            </div>
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Date of Birth</label>
              <input v-model="form.basic.dob" type="date"
                     class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5] focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 outline-none"/>
            </div>
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Gender Identity</label>
              <select v-model="form.basic.gender" 
                      class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5] focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 outline-none">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="non-binary">Non-Binary</option>
                <option value="prefer-not-to-say">Prefer not to say</option>
              </select>
            </div>
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Government ID (CNIC)</label>
              <input v-model="form.basic.cnic" type="text" placeholder="00000-0000000-0"
                     class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5] focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 outline-none"/>
            </div>
          </div>
        </div>

        <!-- Step 2: Job Details -->
        <div v-if="currentStep === 2" class="p-10">
          <div class="mb-8">
            <h3 class="text-2xl font-semibold">Employment Information</h3>
            <p class="text-stone-500">Define the role and reporting structure.</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Department</label>
              <select v-model="form.job.department" class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5]">
                <option value="">Select department</option>
                <option>Engineering</option>
                <option>Product Design</option>
                <option>Marketing</option>
                <option>Human Resources</option>
                <option>Finance</option>
              </select>
            </div>
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Designation</label>
              <select v-model="form.job.designation" class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5]">
                <option value="">Select designation</option>
                <option>Software Engineer</option>
                <option>Senior Product Designer</option>
                <option>Marketing Specialist</option>
              </select>
            </div>
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Employment Type</label>
              <select v-model="form.job.employmentType" class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5]">
                <option value="">Select type</option>
                <option>Full-time</option>
                <option>Part-time</option>
                <option>Contract</option>
              </select>
            </div>
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Joining Date</label>
              <input v-model="form.job.joiningDate" type="date" class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5]"/>
            </div>
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Reporting Manager</label>
              <select v-model="form.job.reportingManager" class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5]">
                <option value="">Search manager</option>
                <option>Alex Rivera (CTO)</option>
                <option>Sarah Chen (VP Design)</option>
              </select>
            </div>
            <div class="space-y-2">
              <label class="block text-label-clean text-stone-600">Work Location</label>
              <input v-model="form.job.workLocation" type="text" placeholder="e.g. Headquarters, Karachi"
                     class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5]"/>
            </div>
          </div>
        </div>

        <!-- Step 3: Salary -->
        <div v-if="currentStep === 3" class="p-10">
          <div class="mb-8">
            <h3 class="text-2xl font-semibold">Compensation Structure</h3>
            <p class="text-stone-500">Set up the salary and allowances.</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="md:col-span-2">
              <label class="block text-label-clean text-stone-600 mb-2">Basic Salary (Monthly)</label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-stone-400 font-bold">$</span>
                <input v-model="form.salary.basicSalary" type="number" placeholder="0.00"
                       class="w-full pl-10 pr-4 py-3 rounded-xl border border-[#E8E0D5]"/>
              </div>
            </div>
            <div>
              <label class="block text-label-clean text-stone-600 mb-2">House Allowance</label>
              <input v-model="form.salary.houseAllowance" type="number" placeholder="Amount"
                     class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5]"/>
            </div>
            <div>
              <label class="block text-label-clean text-stone-600 mb-2">Transport Allowance</label>
              <input v-model="form.salary.transportAllowance" type="number" placeholder="Amount"
                     class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5]"/>
            </div>
            <div>
              <label class="block text-label-clean text-stone-600 mb-2">Medical Allowance</label>
              <input v-model="form.salary.medicalAllowance" type="number" placeholder="Amount"
                     class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5]"/>
            </div>
            <div>
              <label class="block text-label-clean text-stone-600 mb-2">Tax Deduction (%)</label>
              <input v-model="form.salary.taxDeduction" type="number" placeholder="15"
                     class="w-full px-4 py-3 rounded-xl border border-[#E8E0D5]"/>
            </div>
          </div>
        </div>

        <!-- Step 4: Documents -->
        <div v-if="currentStep === 4" class="p-10">
          <div class="mb-10">
            <h3 class="text-2xl font-semibold">Required Documents</h3>
            <p class="text-stone-500">Upload necessary documents for verification.</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Profile Photo -->
            <div class="border border-dashed border-[#E8E0D5] rounded-2xl p-8 text-center">
              <span class="material-symbols-outlined text-5xl text-stone-300 mb-4">add_a_photo</span>
              <h4 class="font-medium">Profile Photo</h4>
              <p class="text-xs text-stone-500 mt-1">Clear headshot (Max 5MB)</p>
              <button class="mt-6 px-6 py-2 text-sm border border-stone-700 rounded-full hover:bg-stone-50">Browse</button>
            </div>

            <!-- CNIC Front -->
            <div class="border border-dashed border-[#E8E0D5] rounded-2xl p-8 text-center">
              <span class="material-symbols-outlined text-5xl text-stone-300 mb-4">badge</span>
              <h4 class="font-medium">CNIC Front</h4>
              <button class="mt-6 px-6 py-2 text-sm border border-stone-700 rounded-full hover:bg-stone-50">Upload</button>
            </div>

            <!-- CNIC Back -->
            <div class="border border-dashed border-[#E8E0D5] rounded-2xl p-8 text-center">
              <span class="material-symbols-outlined text-5xl text-stone-300 mb-4">security</span>
              <h4 class="font-medium">CNIC Back</h4>
              <button class="mt-6 px-6 py-2 text-sm border border-stone-700 rounded-full hover:bg-stone-50">Upload</button>
            </div>
          </div>

          <div class="mt-10 border border-dashed border-[#E8E0D5] rounded-2xl p-10 text-center">
            <span class="material-symbols-outlined text-6xl text-stone-300 mb-4">drive_folder_upload</span>
            <p class="font-medium">Additional Documents</p>
            <p class="text-sm text-stone-500 mt-1">Education certificates, experience letters, etc.</p>
            <button class="mt-6 px-8 py-3 bg-white border border-stone-700 rounded-full text-sm font-medium">Select Files</button>
          </div>
        </div>

        <!-- Footer Actions -->
        <div class="border-t border-[#E8E0D5] px-10 py-6 flex items-center justify-between bg-white">
          <button 
            @click="prevStep"
            :disabled="currentStep === 1"
            class="px-8 py-3 rounded-xl border border-stone-700 text-stone-700 font-medium flex items-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed hover:bg-stone-50">
            <span class="material-symbols-outlined">arrow_back</span>
            Back
          </button>

          <button 
            v-if="currentStep < 4"
            @click="nextStep"
            class="px-10 py-3 rounded-xl bg-primary-container text-on-primary-container font-bold flex items-center gap-2 hover:brightness-105 active:scale-95 transition-all">
            Next Step
            <span class="material-symbols-outlined">arrow_forward</span>
          </button>

          <button 
            v-else
            @click="finishOnboarding"
            class="px-10 py-3 rounded-xl bg-primary-container text-on-primary-container font-bold flex items-center gap-2 hover:brightness-105 active:scale-95 transition-all">
            Finish & Create Profile
          </button>
        </div>
      </div>
    </div>
  </div>
</template>




<style>

.material-symbols-outlined {
  font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
}
</style>