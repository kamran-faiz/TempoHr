<script setup>
// Static layout only - no functionality yet
</script>

<template>
  <Head title="Payslip" />
  <AuthenticatedLayout pageTitle="Payroll Management">
    <div class="max-w-5xl mx-auto py-12 px-container-padding">

      <!-- Breadcrumb / Actions Row -->
      <div class="flex justify-between items-end mb-8">
        <div>
          <h2 class="text-headline-lg font-epilogue text-on-surface">Monthly Payslip</h2>
          <p class="text-label-caps font-manrope text-on-surface-variant mt-1">Generated on October 28, 2023</p>
        </div>
        <div class="flex gap-3">
          <button class="flex items-center gap-2 px-5 py-2.5 border border-on-surface rounded-xl font-epilogue text-sm text-on-surface hover:bg-surface-container-low transition-all active:scale-95">
            <span class="material-symbols-outlined text-lg">print</span>
            Print
          </button>
          <button class="flex items-center gap-2 px-5 py-2.5 bg-primary-container rounded-xl font-epilogue text-sm text-on-primary-container hover:opacity-90 transition-all active:scale-95">
            <span class="material-symbols-outlined text-lg">download</span>
            Download PDF
          </button>
        </div>
      </div>

      <!-- Payslip Card -->
      <div class="bg-surface-container-lowest border border-outline-variant rounded-3xl overflow-hidden shadow-sm">

        <!-- Card Header -->
        <div class="p-container-padding border-b border-outline-variant bg-surface-container-low">
          <div class="flex justify-between items-start mb-12">
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 bg-primary-container rounded-xl flex items-center justify-center">
                <span class="material-symbols-outlined text-on-primary-container text-3xl">lightbulb</span>
              </div>
              <div>
                <h3 class="text-headline-md font-epilogue text-on-surface">Lumina HRMS</h3>
                <p class="text-label-caps font-manrope text-on-surface-variant">ENTERPRISE SOLUTIONS</p>
              </div>
            </div>
            <div class="text-right">
              <p class="text-label-caps font-manrope text-on-surface-variant">PAY PERIOD</p>
              <p class="text-headline-md font-epilogue text-on-surface">October 2023</p>
            </div>
          </div>

          <!-- Employee Info -->
          <div class="grid grid-cols-4 gap-8">
            <div>
              <p class="text-label-caps font-manrope text-on-surface-variant mb-1">EMPLOYEE NAME</p>
              <p class="font-epilogue text-on-surface">Alexandra Rivera</p>
            </div>
            <div>
              <p class="text-label-caps font-manrope text-on-surface-variant mb-1">DESIGNATION</p>
              <p class="font-epilogue text-on-surface">Senior Product Designer</p>
            </div>
            <div>
              <p class="text-label-caps font-manrope text-on-surface-variant mb-1">DEPARTMENT</p>
              <p class="font-epilogue text-on-surface">Product</p>
            </div>
            <div>
              <p class="text-label-caps font-manrope text-on-surface-variant mb-1">EMPLOYEE ID</p>
              <p class="font-epilogue text-on-surface">LMN-082</p>
            </div>
          </div>
        </div>

        <!-- Card Body -->
        <div class="p-container-padding">
          <div class="grid grid-cols-2 gap-16">

            <!-- Earnings -->
            <div class="space-y-6">
              <h4 class="text-label-caps font-manrope text-on-surface-variant flex items-center gap-2">
                <span class="material-symbols-outlined text-emerald-600 text-sm">add_circle</span>
                EARNINGS
              </h4>
              <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-outline-variant">
                  <span class="font-manrope text-on-surface/80">Basic Salary</span>
                  <span class="font-epilogue text-on-surface">$8,500.00</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-outline-variant">
                  <span class="font-manrope text-on-surface/80">Housing Allowance</span>
                  <span class="font-epilogue text-on-surface">$1,200.00</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-outline-variant">
                  <span class="font-manrope text-on-surface/80">Transport Allowance</span>
                  <span class="font-epilogue text-on-surface">$450.00</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-outline-variant">
                  <span class="font-manrope text-on-surface/80">Performance Bonus</span>
                  <span class="font-epilogue text-on-surface">$1,000.00</span>
                </div>
                <div class="flex justify-between items-center pt-4">
                  <span class="font-epilogue font-semibold text-sm text-on-surface">Gross Earnings</span>
                  <span class="font-epilogue font-semibold text-lg text-on-surface">$11,150.00</span>
                </div>
              </div>
            </div>

            <!-- Deductions -->
            <div class="space-y-6">
              <h4 class="text-label-caps font-manrope text-on-surface-variant flex items-center gap-2">
                <span class="material-symbols-outlined text-error text-sm">do_not_disturb_on</span>
                DEDUCTIONS
              </h4>
              <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-outline-variant">
                  <span class="font-manrope text-on-surface/80">Income Tax (PAYE)</span>
                  <span class="font-epilogue text-error">-$1,450.00</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-outline-variant">
                  <span class="font-manrope text-on-surface/80">Health Insurance</span>
                  <span class="font-epilogue text-error">-$220.00</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-outline-variant">
                  <span class="font-manrope text-on-surface/80">Retirement Fund</span>
                  <span class="font-epilogue text-error">-$415.00</span>
                </div>
                <div class="flex justify-between items-center pt-4">
                  <span class="font-epilogue font-semibold text-sm text-on-surface">Total Deductions</span>
                  <span class="font-epilogue font-semibold text-lg text-error">-$2,085.00</span>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Net Salary Footer -->
        <div class="mx-container-padding border-t border-outline-variant py-10">
          <div class="flex justify-between items-center">
            <div>
              <p class="text-label-caps font-manrope text-on-surface-variant mb-1">FINAL PAYMENT</p>
              <h3 class="text-headline-lg font-epilogue text-on-surface">Net Salary</h3>
            </div>
            <div class="text-right">
              <span class="text-display-num font-epilogue text-primary-container block">$9,065.00</span>
              <p class="text-label-caps font-manrope text-on-surface-variant">Paid via Direct Deposit on 10/25/2023</p>
            </div>
          </div>
        </div>

        <!-- Security Strip -->
        <div class="h-2 bg-primary-container w-full"></div>
      </div>

      <!-- Supporting Tiles -->
      <div class="mt-bento-gutter grid grid-cols-12 gap-bento-gutter">

        <!-- YTD -->
        <div class="col-span-4 bg-surface-container-lowest border border-outline-variant rounded-3xl p-container-padding">
          <div class="flex justify-between mb-4">
            <span class="text-label-caps font-manrope text-on-surface-variant">TAX YEAR YTD</span>
            <span class="material-symbols-outlined text-on-surface-variant">analytics</span>
          </div>
          <p class="text-headline-lg font-epilogue text-on-surface">$84,500</p>
          <p class="text-label-caps font-manrope text-on-surface-variant mt-2">Total earnings for 2023</p>
        </div>

        <!-- Bank Account -->
        <div class="col-span-8 bg-surface-container-lowest border border-outline-variant rounded-3xl p-container-padding flex items-center justify-between">
          <div class="flex gap-6 items-center">
            <div class="w-16 h-16 rounded-full bg-surface-container flex items-center justify-center">
              <span class="material-symbols-outlined text-secondary text-2xl">account_balance</span>
            </div>
            <div>
              <p class="text-label-caps font-manrope text-on-surface-variant">BANK ACCOUNT</p>
              <p class="font-epilogue text-on-surface">Chase Premier Checking</p>
              <p class="text-label-caps font-manrope text-on-surface-variant">Ending in **** 4920</p>
            </div>
          </div>
          <button class="font-epilogue text-sm text-on-surface underline hover:text-primary-container transition-colors">
            Change Account
          </button>
        </div>

      </div>

      <!-- Footer -->
      <footer class="mt-12 text-center">
        <p class="text-label-caps font-manrope text-on-surface-variant">
          Questions about your payslip? Contact the
          <a class="text-on-surface underline" href="#">Payroll Support Team</a>
          or visit the
          <a class="text-on-surface underline" href="#">FAQ</a>.
        </p>
      </footer>

    </div>
  </AuthenticatedLayout>
</template>