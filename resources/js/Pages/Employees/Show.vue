<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';


defineProps({
  employee: {
    type: Object,
    required: true
  },
  
})

const activeTab = ref('personal')
</script>

<template>
  <Head title="Employee Profile" />
  <AuthenticatedLayout>
    <div class="p-container-padding max-w-6xl mx-auto flex flex-col gap-bento-gutter">
      
      <!-- Back Navigation -->
      <div class="flex items-center gap-2 text-on-surface-variant mb-2">
        <span class="material-symbols-outlined text-sm">arrow_back</span>
        <Link :href="route('employees.index')" class="font-label-clean">Back to Employee Directory</Link>
      </div>

      <!-- Header Profile Card -->
      <section class="bg-white border border-[#E8E0D5] rounded-xl p-container-padding flex flex-col md:flex-row items-center md:items-start gap-8 relative overflow-hidden">
        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-[#F5F0E8] flex-shrink-0">
          <img v-if="employee.profile_image" :src="`/storage/${employee.profile_image}`" class="w-full h-full object-cover"/>
          <div v-else class="w-full h-full bg-secondary-container flex items-center justify-center text-3xl font-bold text-[#2D2A26]">
            {{ employee.first_name[0] }}{{ employee.last_name[0] }}
          </div>
        </div>
        <div class="flex-grow text-center md:text-left">
          <div class="flex flex-col md:flex-row md:items-center gap-3 mb-2">
            <h1 class="font-headline-lg text-[#2D2A26]">{{ employee.first_name }} {{ employee.last_name }}</h1>
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-[#E8F5E9] text-[#2E7D32] text-[10px] font-bold uppercase tracking-widest border border-[#C8E6C9]">{{ employee.status }}</span>
          </div>
          <div class="flex flex-wrap justify-center md:justify-start gap-x-6 gap-y-2 text-on-surface-variant font-body-md">
            <div class="flex items-center gap-1.5">
              <span class="material-symbols-outlined text-lg">badge</span>
              <span>{{ employee.designation.name }}</span>
            </div>
            <div class="flex items-center gap-1.5">
              <span class="material-symbols-outlined text-lg">corporate_fare</span>
              <span>{{ employee.department.name }}</span>
            </div>
            <div class="flex items-center gap-1.5">
              <span class="material-symbols-outlined text-lg">fingerprint</span>
              <span>ID: {{ employee.employee_code }}</span>
            </div>
          </div>
        </div>
        <div class="flex gap-3 mt-4 md:mt-0">
          <button class="px-6 py-2.5 border border-[#2D2A26] text-[#2D2A26] rounded-lg font-semibold text-sm hover:bg-[#F5F0E8] transition-all">Edit Profile</button>
          <button class="px-6 py-2.5 bg-surface-container text-[#2D2A26] rounded-lg font-semibold text-sm hover:bg-surface-variant transition-all">Deactivate</button>
        </div>
        <div class="absolute top-0 right-0 w-24 h-24 bg-primary-container/10 rounded-bl-full -mr-8 -mt-8"></div>
      </section>

      <!-- Tabs -->
      <nav class="flex border-b border-[#E8E0D5] gap-8">
        <button @click="activeTab = 'personal'" :class="activeTab === 'personal' ? 'text-[#2D2A26] active-tab-indicator' : 'text-[#2D2A26]/40'" class="font-semibold text-sm pb-4">Personal Info</button>
        <button @click="activeTab = 'job'" :class="activeTab === 'job' ? 'text-[#2D2A26] active-tab-indicator' : 'text-[#2D2A26]/40'" class="font-semibold text-sm pb-4">Job Details</button>
        <button @click="activeTab = 'leave'" :class="activeTab === 'leave' ? 'text-[#2D2A26] active-tab-indicator' : 'text-[#2D2A26]/40'" class="font-semibold text-sm pb-4">Leave History</button>
        <button @click="activeTab = 'documents'" :class="activeTab === 'documents' ? 'text-[#2D2A26] active-tab-indicator' : 'text-[#2D2A26]/40'" class="font-semibold text-sm pb-4">Profile Photo</button>
      </nav>

      <!-- Content Grid -->
      <div  v-if="activeTab === 'personal'" class="grid grid-cols-12 gap-bento-gutter">
        
        <!-- General Information -->
        <div class="col-span-12 md:col-span-8 bg-white border border-[#E8E0D5] rounded-xl p-container-padding">
          <div class="flex justify-between items-center mb-8">
            <h3 class="font-label-caps text-on-surface-variant">General Information</h3>
          </div>
          <div  class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
            <div>
              <label class="font-label-clean text-on-surface-variant block mb-1">Email Address</label>
              <p class="font-body-lg text-[#2D2A26]">{{ employee.email }}</p>
            </div>
            <div>
              <label class="font-label-clean text-on-surface-variant block mb-1">Phone Number</label>
              <p class="font-body-lg text-[#2D2A26]">{{ employee.phone ?? '—' }}</p>
            </div>
            <div>
              <label class="font-label-clean text-on-surface-variant block mb-1">CNIC / National ID</label>
              <p class="font-body-lg text-[#2D2A26]">{{ employee.cnic ?? '—' }}</p>
            </div>
            <div>
              <label class="font-label-clean text-on-surface-variant block mb-1">Date of Birth</label>
              <p class="font-body-lg text-[#2D2A26]">{{ employee.date_of_birth ?? '—' }}</p>
            </div>
            <div>
              <label class="font-label-clean text-on-surface-variant block mb-1">Gender</label>
              <p class="font-body-lg text-[#2D2A26]">{{ employee.gender ?? '—' }}</p>
            </div>
            <div>
              <label class="font-label-clean text-on-surface-variant block mb-1">Residential Address</label>
              <p class="font-body-lg text-[#2D2A26]">{{ employee.address ?? '—' }}</p>
            </div>
          </div>
        </div>

        <!-- Emergency Contact -->
        <div class="col-span-12 md:col-span-4 bg-white border border-[#E8E0D5] rounded-xl p-container-padding flex flex-col">
          <div class="flex justify-between items-center mb-8">
            <h3 class="font-label-caps text-on-surface-variant">Emergency Contact</h3>
            <span class="material-symbols-outlined text-error">emergency_home</span>
          </div>
          <div class="bg-surface-container-low p-6 rounded-xl border border-[#E8E0D5]/50 flex flex-col gap-4">
            <div class="flex items-center gap-4">
              <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-bold text-secondary">
                {{ employee.emergency_contact_name ? employee.emergency_contact_name[0] : '?' }}
              </div>
              <div>
                <p class="font-body-md font-bold text-[#2D2A26]">{{ employee.emergency_contact_name ?? '—' }}</p>
              </div>
            </div>
            <div class="h-px bg-[#E8E0D5]"></div>
            <div class="flex items-center gap-3 text-on-surface">
              <span class="material-symbols-outlined text-lg">call</span>
              <span class="font-body-md">{{ employee.emergency_contact_phone ?? '—' }}</span>
            </div>
          </div>
        </div>

      </div>
      <!-- Job Details Tab -->
<div v-if="activeTab === 'job'" class="grid grid-cols-12 gap-bento-gutter">
  
  <!-- Employment Details -->
  <div class="col-span-12 md:col-span-8 bg-white border border-[#E8E0D5] rounded-xl p-container-padding">
    <div class="flex justify-between items-center mb-8">
      <h3 class="font-label-caps text-on-surface-variant">Employment Details</h3>
      <span class="material-symbols-outlined text-[#2D2A26]/20">work</span>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-12">
      <div>
        <label class="font-label-clean text-on-surface-variant block mb-1">Department</label>
        <p class="font-body-lg text-[#2D2A26]">{{ employee.department.name }}</p>
      </div>
      <div>
        <label class="font-label-clean text-on-surface-variant block mb-1">Designation</label>
        <p class="font-body-lg text-[#2D2A26]">{{ employee.designation.name }}</p>
      </div>
      <div>
        <label class="font-label-clean text-on-surface-variant block mb-1">Employment Type</label>
        <p class="font-body-lg text-[#2D2A26]">{{ employee.employee_type }}</p>
      </div>
      <div>
        <label class="font-label-clean text-on-surface-variant block mb-1">Joining Date</label>
        <p class="font-body-lg text-[#2D2A26]">{{ employee.joining_date ?? '—' }}</p>
      </div>
      <div>
        <label class="font-label-clean text-on-surface-variant block mb-1">Employee Code</label>
        <p class="font-body-lg text-[#2D2A26]">{{ employee.employee_code }}</p>
      </div>
      <div>
        <label class="font-label-clean text-on-surface-variant block mb-1">Status</label>
        <span class="inline-flex items-center px-3 py-1 rounded-full bg-[#E8F5E9] text-[#2E7D32] text-[10px] font-bold uppercase tracking-widest border border-[#C8E6C9]">{{ employee.status }}</span>
      </div>
    </div>
  </div>



</div>
<!-- Leave History Tab -->
<div v-if="activeTab === 'leave'" class="grid grid-cols-12 gap-bento-gutter">

  <!-- Leave Balances -->
  <div class="col-span-12 bg-white border border-[#E8E0D5] rounded-xl p-container-padding">
    <div class="flex justify-between items-center mb-8">
      <h3 class="font-label-caps text-on-surface-variant">Leave Balances</h3>
      <span class="material-symbols-outlined text-[#2D2A26]/20">calendar_today</span>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div v-for="balance in employee.leave_balances" :key="balance.id" class="bg-surface-container-low border border-[#E8E0D5] rounded-xl p-6">
        <p class="font-label-caps text-on-surface-variant mb-4">{{ balance.leave_type.name }}</p>
        <p class="font-display-num text-3xl text-[#2D2A26]">{{ balance.remaining_days }}</p>
        <p class="font-label-clean text-on-surface-variant mt-1">days remaining</p>
        <div class="mt-4 h-1.5 bg-[#E8E0D5] rounded-full overflow-hidden">
          <div class="h-full bg-primary-container rounded-full" :style="{ width: `${(balance.remaining_days / balance.allocated_days) * 100}%` }"></div>
        </div>
        <div class="mt-3 flex justify-between">
          <span class="font-label-clean text-xs text-on-surface-variant">Used: {{ balance.used_days }}</span>
          <span class="font-label-clean text-xs text-on-surface-variant">Total: {{ balance.allocated_days }}</span>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- Profile Photo Tab -->
<div v-if="activeTab === 'documents'" class="flex justify-center items-center min-h-[400px]">
  <div class="bg-white border border-[#E8E0D5] rounded-xl p-12 text-center max-w-md w-full">
    <div class="w-40 h-40 rounded-full overflow-hidden mx-auto mb-6">
      <img 
        v-if="employee.profile_image" 
        :src="`/storage/${employee.profile_image}`" 
        class="w-full h-full object-cover"
      />
      <div v-else class="w-full h-full bg-secondary-container flex items-center justify-center text-4xl font-bold">
        {{ employee.first_name[0] }}{{ employee.last_name[0] }}
      </div>
    </div>
    <h3 class="font-semibold text-xl">Profile Photo</h3>
    <p class="text-sm text-stone-500 mt-2">Current profile image</p>
    <p class="text-xs text-stone-400 mt-4">To change photo, edit the employee profile</p>
  </div>
</div>
    </div>
  </AuthenticatedLayout>
</template>

<style>
.active-tab-indicator {
  position: relative;
}
.active-tab-indicator::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  right: 0;
  height: 2px;
  background-color: #F5D142;
}
</style>