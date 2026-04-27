<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';



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
          <button class="flex items-center gap-2 px-6 py-3 bg-[#F5D142] text-[#2D2A26] font-semibold rounded-xl hover:opacity-90 active:scale-95 transition-all shadow-sm">
            <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'wght' 600;">add</span>
            <span class="font-headline-md text-base">Add Employee</span>
          </button>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-bento-gutter">
        
        <div class="bg-white p-6 rounded-xl border border-[#E8E0D5] group hover:border-[#F5D142] transition-all duration-300">
          <div class="flex justify-between items-start mb-6">
            <div class="w-16 h-16 rounded-full bg-secondary-container flex items-center justify-center text-xl font-bold text-[#2D2A26]">MA</div>
            <button class="p-1.5 text-secondary/40 hover:text-[#2D2A26] transition-colors">
              <span class="material-symbols-outlined">more_vert</span>
            </button>
          </div>
          <div>
            <div class="flex items-center justify-between mb-1">
              <h3 class="font-headline-md text-lg text-[#2D2A26]">Marcus Aurelius</h3>
              <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-green-50 text-green-700 border border-green-100">Active</span>
            </div>
            <p class="font-label-clean text-secondary text-sm">Principal Product Designer</p>
            <p class="font-label-clean text-secondary/60 text-xs mt-1">Product & Design</p>
          </div>
          <div class="mt-6 pt-6 border-t border-[#F5F0E8] flex gap-2">
            <button class="flex-1 py-2 text-xs font-semibold rounded-lg bg-[#F5F0E8] hover:bg-[#F5D142] transition-colors">Profile</button>
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
  </AuthenticatedLayout>
</template>