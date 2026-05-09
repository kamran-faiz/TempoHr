<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    employees: {
        type: Array,
        default: () => []
    },
    activeLeaves: Number,
    pendingRequests: Number
})
</script>

<template>
<Head title="Leave Balances" />
<AuthenticatedLayout>
  <div class="flex-1 overflow-y-auto p-container-padding space-y-bento-gutter">
    <!-- Page Header -->
    <div class="flex justify-between items-end mb-4">
      <div>
        <h2 class="font-headline-lg text-headline-lg text-on-surface">Leave Balances</h2>
        <p class="font-body-md text-body-md text-on-surface-variant">Manage and audit employee holiday and sick leave allocations.</p>
      </div>
      <div class="flex gap-4">
        <button class="flex items-center gap-2 px-6 py-3 bg-white border border-secondary-fixed text-on-surface font-label-caps text-label-caps rounded-lg hover:bg-surface-container-low transition-colors">
          <span class="material-symbols-outlined text-sm">filter_list</span>
          FILTER BY DEPT
        </button>
        <button class="flex items-center gap-2 px-6 py-3 bg-primary-container text-on-primary-container font-label-caps text-label-caps rounded-lg font-bold hover:shadow-lg transition-all active:scale-95">
          <span class="material-symbols-outlined text-sm">download</span>
          EXPORT REPORT
        </button>
      </div>
    </div>

    <!-- Dashboard Stats -->
    <div class="grid grid-cols-4 gap-bento-gutter">
      <div class="bento-card rounded-xl">
        <div class="flex justify-between items-start mb-4">
          <span class="font-label-caps text-label-caps text-on-surface-variant uppercase">TOTAL EMPLOYEES</span>
          <span class="material-symbols-outlined text-primary">group</span>
        </div>
        <p class="font-display-num text-display-num text-on-surface">{{ employees.length }}</p>
      </div>
      <div class="bento-card rounded-xl">
        <div class="flex justify-between items-start mb-4">
          <span class="font-label-caps text-label-caps text-on-surface-variant uppercase">ACTIVE LEAVE</span>
          <span class="material-symbols-outlined text-primary">beach_access</span>
        </div>
        <p class="font-display-num text-display-num text-on-surface">{{ activeLeaves }}</p>
      </div>
      <div class="bento-card rounded-xl">
        <div class="flex justify-between items-start mb-4">
          <span class="font-label-caps text-label-caps text-on-surface-variant uppercase">PENDING REQUESTS</span>
          <span class="material-symbols-outlined text-primary">pending_actions</span>
        </div>
        <p class="font-display-num text-display-num text-on-surface">{{ pendingRequests }}</p>
      </div>
      <div class="bento-card rounded-xl border-primary-container bg-surface-container-lowest">
        <div class="flex justify-between items-start mb-4">
          <span class="font-label-caps text-label-caps text-on-surface-variant uppercase">POLICY AUDIT</span>
          <span class="material-symbols-outlined text-primary">verified_user</span>
        </div>
        <p class="font-display-num text-display-num text-on-surface">100<span class="text-xl">%</span></p>
      </div>
    </div>

    <!-- Employee Leave Balances -->
    <div class="space-y-bento-gutter">
      <section v-for="employee in employees" :key="employee.id" class="bento-card rounded-xl">
        <div class="flex items-center justify-between mb-8">
          <div class="flex items-center gap-4">
            <img 
              v-if="employee.profile_image" 
              :src="'/storage/' + employee.profile_image" 
              class="w-14 h-14 rounded-full object-cover border-2 border-primary-fixed"
            />
            <div v-else class="w-14 h-14 rounded-full bg-secondary-container flex items-center justify-center text-2xl font-bold">
              {{ employee.first_name?.[0] }}{{ employee.last_name?.[0] }}
            </div>
            <div>
              <h3 class="font-headline-md text-headline-md text-on-surface">{{ employee.first_name }} {{ employee.last_name }}</h3>
              <div class="flex gap-2 items-center">
                <span class="font-label-clean text-label-clean text-on-surface-variant">{{ employee.designation?.name }}</span>
                <span class="w-1 h-1 rounded-full bg-outline-variant"></span>
                <span class="font-label-clean text-label-clean text-on-surface-variant">{{ employee.department?.name }}</span>
              </div>
            </div>
          </div>
          <button class="text-primary font-label-caps text-label-caps hover:underline cursor-pointer">VIEW HISTORY</button>
        </div>

        <div class="overflow-hidden">
          <table class="w-full text-left">
            <thead class="border-b border-secondary-fixed">
              <tr>
                <th class="pb-4 font-label-caps text-label-caps text-on-surface-variant uppercase">Leave Type</th>
                <th class="pb-4 font-label-caps text-label-caps text-on-surface-variant uppercase text-right">Allocated</th>
                <th class="pb-4 font-label-caps text-label-caps text-on-surface-variant uppercase text-right">Used</th>
                <th class="pb-4 font-label-caps text-label-caps text-on-surface-variant uppercase text-right">Remaining</th>
                <th class="pb-4 font-label-caps text-label-caps text-on-surface-variant uppercase text-right">Carried Fwd</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-secondary-fixed">
              <tr v-for="balance in employee.leave_balances" :key="balance.id">
                <td class="py-5">
                  <div class="flex items-center gap-3">
                    <div class="w-2 h-2 rounded-full bg-primary"></div>
                    <span class="font-body-md text-body-md text-on-surface">{{ balance.leave_type?.name }}</span>
                  </div>
                </td>
                <td class="py-5 font-display-num text-2xl text-right text-on-surface">{{ balance.allocated_days }}</td>
                <td class="py-5 font-display-num text-2xl text-right text-on-surface">{{ balance.used_days }}</td>
                <td class="py-5 font-display-num text-2xl text-right text-primary font-bold">{{ balance.remaining_days }}</td>
                <td class="py-5 font-display-num text-2xl text-right text-on-surface-variant opacity-60">{{ balance.carried_forward_days || '—' }}</td>
              </tr>
              <tr v-if="!employee.leave_balances?.length">
                <td colspan="5" class="py-8 text-center text-on-surface-variant opacity-60">
                  No leave balances found for this employee.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <div v-if="!employees.length" class="bento-card rounded-xl p-12 text-center">
        <p class="text-on-surface-variant">No employees found.</p>
      </div>
    </div>

    <!-- Load More Section -->
    <div class="flex justify-center py-8">
      <button class="px-8 py-3 border border-outline text-on-surface font-label-caps text-label-caps rounded-lg hover:bg-surface-container-low transition-all">
        LOAD NEXT 10 EMPLOYEES
      </button>
    </div>
  </div>
</AuthenticatedLayout>
</template>