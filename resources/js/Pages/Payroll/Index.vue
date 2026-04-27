<script setup>
// Static layout only - no functionality yet
</script>

<template>
  <Head title="Payroll" />
  <AuthenticatedLayout pageTitle="Payroll Management">
    <div class="p-container-padding space-y-bento-gutter">

      <!-- Summary Cards -->
      <div class="grid grid-cols-12 gap-bento-gutter">
        
        <!-- Total Payroll -->
        <div class="col-span-4 bg-surface-container-lowest border border-outline-variant rounded-xl p-container-padding">
          <div class="flex justify-between items-start mb-4">
            <span class="text-label-caps font-manrope text-tertiary">TOTAL PAYROLL (AUG)</span>
            <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
          </div>
          <h3 class="text-display-num font-epilogue text-on-surface">$428,500</h3>
          <div class="flex items-center gap-2 text-xs font-manrope text-emerald-600 mt-1">
            <span class="material-symbols-outlined text-sm">trending_up</span>
            <span>+4.2% from last month</span>
          </div>
        </div>

        <!-- Employees Paid -->
        <div class="col-span-4 bg-surface-container-lowest border border-outline-variant rounded-xl p-container-padding">
          <div class="flex justify-between items-start mb-4">
            <span class="text-label-caps font-manrope text-tertiary">EMPLOYEES PAID</span>
            <span class="material-symbols-outlined text-primary">person_check</span>
          </div>
          <h3 class="text-display-num font-epilogue text-on-surface">1,284</h3>
          <div class="flex items-center gap-2 text-xs font-manrope text-tertiary mt-1">
            <span class="material-symbols-outlined text-sm">groups</span>
            <span>Total 1,302 active staff</span>
          </div>
        </div>

        <!-- Pending Payments -->
        <div class="col-span-4 bg-surface-container-lowest border border-outline-variant rounded-xl p-container-padding">
          <div class="flex justify-between items-start mb-4">
            <span class="text-label-caps font-manrope text-tertiary">PENDING PAYMENTS</span>
            <span class="material-symbols-outlined text-error">pending_actions</span>
          </div>
          <h3 class="text-display-num font-epilogue text-on-surface">18</h3>
          <div class="flex items-center gap-2 text-xs font-manrope text-error mt-1">
            <span class="material-symbols-outlined text-sm">warning</span>
            <span>Awaiting bank approval</span>
          </div>
        </div>

      </div>

      <!-- Payroll Table -->
      <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden">

        <!-- Table Header -->
        <div class="p-8 border-b border-outline-variant flex justify-between items-center bg-surface-container-low">
          <div>
            <h4 class="text-headline-md font-epilogue text-on-surface">Payroll Directory</h4>
            <p class="text-label-caps font-manrope text-tertiary">Monthly disbursement report for August 2024</p>
          </div>
          <div class="flex items-center gap-4">
            <div class="flex flex-col">
              <label class="text-label-caps font-manrope text-tertiary mb-1">DEPARTMENT</label>
              <select class="bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm font-manrope focus:ring-2 focus:ring-primary-container outline-none">
                <option>All Departments</option>
                <option>Engineering</option>
                <option>Design</option>
                <option>Marketing</option>
                <option>Operations</option>
              </select>
            </div>
            <div class="flex flex-col">
              <label class="text-label-caps font-manrope text-tertiary mb-1">MONTH</label>
              <select class="bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm font-manrope focus:ring-2 focus:ring-primary-container outline-none">
                <option>August 2024</option>
                <option>July 2024</option>
                <option>June 2024</option>
              </select>
            </div>
            <button class="mt-5 w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors">
              <span class="material-symbols-outlined text-on-surface-variant">filter_list</span>
            </button>
          </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-surface-container-low border-b border-outline-variant">
                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">EMPLOYEE</th>
                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">ROLE</th>
                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">BASIC SALARY</th>
                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">ALLOWANCES</th>
                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">DEDUCTIONS</th>
                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">NET SALARY</th>
                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">STATUS</th>
                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">ACTION</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">

              <!-- Row 1 -->
              <tr class="hover:bg-surface-container-low transition-colors group">
                <td class="px-8 py-5">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
                      <span class="material-symbols-outlined text-on-surface-variant">person</span>
                    </div>
                    <div>
                      <p class="font-epilogue font-bold text-sm text-on-surface">Eleanor Shellstrop</p>
                      <p class="font-manrope text-xs text-tertiary">Product Design</p>
                    </div>
                  </div>
                </td>
                <td class="px-8 py-5 font-manrope text-sm text-on-surface">Senior UX Designer</td>
                <td class="px-8 py-5 font-epilogue text-sm font-semibold text-on-surface">$8,500</td>
                <td class="px-8 py-5 font-epilogue text-sm text-emerald-600">+$1,200</td>
                <td class="px-8 py-5 font-epilogue text-sm text-error">-$450</td>
                <td class="px-8 py-5 font-epilogue text-sm font-bold text-on-surface">$9,250</td>
                <td class="px-8 py-5">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Paid</span>
                </td>
                <td class="px-8 py-5">
                  <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-surface-container hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined text-lg text-on-surface-variant">receipt_long</span>
                  </button>
                </td>
              </tr>

              <!-- Row 2 -->
              <tr class="hover:bg-surface-container-low transition-colors group">
                <td class="px-8 py-5">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
                      <span class="material-symbols-outlined text-on-surface-variant">person</span>
                    </div>
                    <div>
                      <p class="font-epilogue font-bold text-sm text-on-surface">Chidi Anagonye</p>
                      <p class="font-manrope text-xs text-tertiary">Engineering</p>
                    </div>
                  </div>
                </td>
                <td class="px-8 py-5 font-manrope text-sm text-on-surface">Frontend Architect</td>
                <td class="px-8 py-5 font-epilogue text-sm font-semibold text-on-surface">$12,000</td>
                <td class="px-8 py-5 font-epilogue text-sm text-emerald-600">+$800</td>
                <td class="px-8 py-5 font-epilogue text-sm text-error">-$920</td>
                <td class="px-8 py-5 font-epilogue text-sm font-bold text-on-surface">$11,880</td>
                <td class="px-8 py-5">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Pending</span>
                </td>
                <td class="px-8 py-5">
                  <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-surface-container hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined text-lg text-on-surface-variant">receipt_long</span>
                  </button>
                </td>
              </tr>

            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="p-8 border-t border-outline-variant flex justify-between items-center bg-surface-container-low">
          <p class="font-manrope text-xs text-tertiary">Showing 1-4 of 1,284 employees</p>
          <div class="flex gap-2">
            <button class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg text-tertiary opacity-40" disabled>
              <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="w-10 h-10 flex items-center justify-center border border-primary-container bg-primary-container text-on-primary-container font-bold rounded-lg">1</button>
            <button class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg hover:bg-surface-container-low text-on-surface">2</button>
            <button class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg hover:bg-surface-container-low text-on-surface">3</button>
            <button class="w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg text-tertiary">
              <span class="material-symbols-outlined">chevron_right</span>
            </button>
          </div>
        </div>

      </div>
    </div>
  </AuthenticatedLayout>
</template>