<script setup>
// Static layout only - no functionality yet
</script>

<template>
  <Head title="Salary Setup" />
  <AuthenticatedLayout pageTitle="Salary Setup">
    <div class="p-container-padding max-w-5xl mx-auto space-y-bento-gutter">

      <!-- Employee Snapshot Card -->
      <section class="bg-surface-container-lowest border border-outline-variant p-6 rounded-xl flex items-center justify-between">
        <div class="flex items-center gap-6">
          <div class="relative">
            <div class="w-20 h-20 rounded-full bg-surface-container border-2 border-primary-container flex items-center justify-center">
              <span class="material-symbols-outlined text-on-surface-variant text-4xl">person</span>
            </div>
            <div class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 border-2 border-white rounded-full"></div>
          </div>
          <div>
            <h2 class="text-headline-md font-epilogue text-on-surface">Marcus Thorne</h2>
            <p class="text-label-caps font-manrope text-on-surface-variant flex items-center gap-2">
              <span class="material-symbols-outlined text-sm">badge</span>
              Senior Product Designer
            </p>
            <p class="text-label-caps font-manrope text-on-surface-variant flex items-center gap-2">
              <span class="material-symbols-outlined text-sm">lan</span>
              Product Design Department
            </p>
          </div>
        </div>
        <div class="flex gap-3">
          <button class="px-4 py-2 border border-outline-variant rounded-lg font-manrope text-on-surface hover:bg-surface-container-low transition-colors">
            View Profile
          </button>
          <button class="px-4 py-2 bg-surface-container-low border border-outline-variant rounded-lg font-manrope text-on-surface hover:bg-surface-container transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">history</span>
            History
          </button>
        </div>
      </section>

      <!-- Main Setup Form Card -->
      <section class="bg-surface-container-lowest border border-outline-variant p-container-padding rounded-xl">
        
        <!-- Section Header -->
        <div class="flex justify-between items-center mb-8">
          <div>
            <span class="text-label-caps font-manrope text-on-surface-variant">FINANCIAL CONFIGURATION</span>
            <h3 class="text-headline-md font-epilogue text-on-surface">Salary Structure</h3>
          </div>
          <span class="material-symbols-outlined text-on-surface-variant">account_balance_wallet</span>
        </div>

        <!-- Basic Salary + Effective Date -->
        <div class="grid grid-cols-2 gap-8 mb-10">
          <div class="space-y-2">
            <label class="text-label-caps font-manrope text-on-surface-variant block">BASIC SALARY</label>
            <div class="relative">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant">$</span>
              <input
                class="w-full pl-8 pr-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all font-epilogue text-xl"
                placeholder="0.00"
                type="text"
                value="8,500.00"
              />
            </div>
            <p class="text-xs font-manrope text-on-surface-variant">Standard monthly basic compensation before deductions.</p>
          </div>
          <div class="space-y-2">
            <label class="text-label-caps font-manrope text-on-surface-variant block">EFFECTIVE DATE</label>
            <input
              class="w-full px-4 py-3 bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all font-manrope h-[58px]"
              type="date"
              value="2023-11-01"
            />
            <p class="text-xs font-manrope text-on-surface-variant">Date from which this salary setup becomes active.</p>
          </div>
        </div>

        <!-- Allowances Section -->
        <div class="border-t border-outline-variant pt-8">
          <div class="flex justify-between items-center mb-6">
            <h4 class="text-headline-md font-epilogue text-on-surface">Allowances & Benefits</h4>
            <button class="flex items-center gap-2 px-4 py-2 border border-on-surface rounded-lg font-manrope text-on-surface hover:bg-surface-container-low transition-all">
              <span class="material-symbols-outlined text-sm">add</span>
              Add Allowance
            </button>
          </div>

          <div class="space-y-4">

            <!-- Allowance Row 1 -->
            <div class="flex items-start gap-4 p-4 rounded-xl border border-dashed border-outline-variant bg-surface-container-low">
              <div class="w-1/3 space-y-1">
                <label class="text-label-caps font-manrope text-on-surface-variant block">TYPE</label>
                <select class="w-full px-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg font-manrope outline-none focus:border-primary-container">
                  <option>Housing Allowance</option>
                  <option selected>Transport Allowance</option>
                  <option>Medical Allowance</option>
                  <option>Education Grant</option>
                </select>
              </div>
              <div class="w-1/4 space-y-1">
                <label class="text-label-caps font-manrope text-on-surface-variant block">VALUE TYPE</label>
                <select class="w-full px-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg font-manrope outline-none focus:border-primary-container">
                  <option>Fixed Amount ($)</option>
                  <option selected>Percentage (%)</option>
                </select>
              </div>
              <div class="w-1/4 space-y-1">
                <label class="text-label-caps font-manrope text-on-surface-variant block">VALUE</label>
                <input class="w-full px-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg font-manrope outline-none focus:border-primary-container" type="text" value="15"/>
                <p class="text-xs text-primary font-manrope mt-1">Calculated: $1,275.00 (15% of basic)</p>
              </div>
              <div class="pt-6">
                <button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container rounded-lg transition-all">
                  <span class="material-symbols-outlined">delete</span>
                </button>
              </div>
            </div>

            <!-- Allowance Row 2 -->
            <div class="flex items-start gap-4 p-4 rounded-xl border border-dashed border-outline-variant bg-surface-container-low">
              <div class="w-1/3 space-y-1">
                <label class="text-label-caps font-manrope text-on-surface-variant block">TYPE</label>
                <select class="w-full px-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg font-manrope outline-none focus:border-primary-container">
                  <option>Housing Allowance</option>
                  <option>Transport Allowance</option>
                  <option selected>Medical Allowance</option>
                  <option>Education Grant</option>
                </select>
              </div>
              <div class="w-1/4 space-y-1">
                <label class="text-label-caps font-manrope text-on-surface-variant block">VALUE TYPE</label>
                <select class="w-full px-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg font-manrope outline-none focus:border-primary-container">
                  <option selected>Fixed Amount ($)</option>
                  <option>Percentage (%)</option>
                </select>
              </div>
              <div class="w-1/4 space-y-1">
                <label class="text-label-caps font-manrope text-on-surface-variant block">VALUE</label>
                <input class="w-full px-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg font-manrope outline-none focus:border-primary-container" type="text" value="450.00"/>
              </div>
              <div class="pt-6">
                <button class="p-2 text-on-surface-variant hover:text-error hover:bg-error-container rounded-lg transition-all">
                  <span class="material-symbols-outlined">delete</span>
                </button>
              </div>
            </div>

          </div>
        </div>

        <!-- Total + Save -->
        <div class="mt-12 flex items-center justify-between border-t border-outline-variant pt-8">
          <div class="space-y-1">
            <span class="text-label-caps font-manrope text-on-surface-variant">TOTAL MONTHLY GROSS</span>
            <p class="text-display-num font-epilogue text-on-surface">$10,225.00</p>
          </div>
          <button class="bg-primary-container text-on-primary-container px-12 py-4 rounded-xl font-epilogue font-bold hover:opacity-90 active:scale-95 transition-all flex items-center gap-3">
            Save Salary Setup
            <span class="material-symbols-outlined">check_circle</span>
          </button>
        </div>

      </section>

      <!-- Policy Note -->
      <div class="bg-surface-container border border-outline-variant p-6 rounded-xl flex gap-4 items-start">
        <span class="material-symbols-outlined text-primary">info</span>
        <div class="space-y-1">
          <p class="font-manrope font-bold text-on-surface">Policy Compliance Check</p>
          <p class="text-sm font-manrope text-on-surface-variant">The current setup follows the 'Senior Management' pay scale guidelines. Any deviation above 20% will require VP-level approval before the next payroll cycle runs.</p>
        </div>
      </div>

    </div>
  </AuthenticatedLayout>
</template>