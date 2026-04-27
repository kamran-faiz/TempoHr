<script setup>
// Static layout only - no functionality yet
</script>

<template>
  <Head title="Generate Payroll" />
  <AuthenticatedLayout pageTitle="Payroll Processing">
    <div class="p-container-padding flex-1">

      <!-- Filters Card -->
      <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-container-padding mb-bento-gutter flex items-end gap-element-gap">
        
        <!-- Payroll Period -->
        <div class="flex-1 space-y-2">
          <label class="text-label-caps font-manrope text-on-surface-variant block">PAYROLL PERIOD</label>
          <div class="flex gap-4">
            <select class="flex-1 bg-surface border border-outline-variant rounded-lg px-4 py-3 font-manrope text-on-surface focus:border-primary-container outline-none">
              <option>October</option>
              <option selected>November</option>
              <option>December</option>
            </select>
            <select class="w-32 bg-surface border border-outline-variant rounded-lg px-4 py-3 font-manrope text-on-surface focus:border-primary-container outline-none">
              <option>2023</option>
              <option selected>2024</option>
              <option>2025</option>
            </select>
          </div>
        </div>

        <!-- Department -->
        <div class="flex-1 space-y-2">
          <label class="text-label-caps font-manrope text-on-surface-variant block">DEPARTMENT</label>
          <select class="w-full bg-surface border border-outline-variant rounded-lg px-4 py-3 font-manrope text-on-surface focus:border-primary-container outline-none">
            <option selected>All Departments</option>
            <option>Product & Design</option>
            <option>Engineering</option>
            <option>Marketing</option>
            <option>Human Resources</option>
          </select>
        </div>

        <!-- Apply Button -->
        <button class="px-8 py-3.5 bg-surface-container text-on-surface font-manrope font-semibold rounded-lg hover:bg-surface-container-high transition-colors flex items-center gap-2">
          <span class="material-symbols-outlined text-sm">filter_list</span>
          Apply Filters
        </button>

      </div>

      <!-- Main Table Card -->
      <div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden">

        <!-- Table Header -->
        <div class="p-container-padding border-b border-outline-variant flex justify-between items-center">
          <div>
            <h2 class="text-headline-md font-epilogue text-on-surface">Employee Remuneration List</h2>
            <p class="text-label-caps font-manrope text-on-surface-variant">Reviewing 24 active employees for the November 2024 cycle.</p>
          </div>
          <div class="flex gap-2">
            <button class="p-2 text-on-surface-variant hover:bg-surface-container-low rounded-lg transition-colors">
              <span class="material-symbols-outlined">download</span>
            </button>
            <button class="p-2 text-on-surface-variant hover:bg-surface-container-low rounded-lg transition-colors">
              <span class="material-symbols-outlined">print</span>
            </button>
          </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-surface-container-low text-label-caps font-manrope text-on-surface-variant border-b border-outline-variant">
                <th class="px-6 py-4 w-12 text-center">
                  <input checked type="checkbox" class="w-4 h-4 rounded border-outline-variant cursor-pointer"/>
                </th>
                <th class="px-6 py-4">EMPLOYEE</th>
                <th class="px-6 py-4">DESIGNATION</th>
                <th class="px-6 py-4">DEPARTMENT</th>
                <th class="px-6 py-4 text-right">BASIC SALARY</th>
                <th class="px-6 py-4 text-right">ALLOWANCES</th>
                <th class="px-6 py-4 text-right">DEDUCTIONS</th>
                <th class="px-6 py-4 text-right">NET SALARY</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant">

              <!-- Row 1 -->
              <tr class="hover:bg-surface-container-low transition-colors">
                <td class="px-6 py-5 text-center">
                  <input checked type="checkbox" class="w-4 h-4 rounded border-outline-variant cursor-pointer"/>
                </td>
                <td class="px-6 py-5">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
                      <span class="material-symbols-outlined text-on-surface-variant">person</span>
                    </div>
                    <div>
                      <p class="font-epilogue font-semibold text-on-surface">Elena Rodriguez</p>
                      <p class="text-label-caps font-manrope text-on-surface-variant">EMP-2045</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-5 font-manrope text-on-surface">Senior Product Designer</td>
                <td class="px-6 py-5">
                  <span class="px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-semibold font-manrope">Product</span>
                </td>
                <td class="px-6 py-5 text-right font-epilogue text-on-surface">$8,500.00</td>
                <td class="px-6 py-5 text-right font-epilogue text-primary">$1,200.00</td>
                <td class="px-6 py-5 text-right font-epilogue text-error">($450.00)</td>
                <td class="px-6 py-5 text-right font-epilogue font-bold text-on-surface">$9,250.00</td>
              </tr>

              <!-- Row 2 -->
              <tr class="hover:bg-surface-container-low transition-colors">
                <td class="px-6 py-5 text-center">
                  <input checked type="checkbox" class="w-4 h-4 rounded border-outline-variant cursor-pointer"/>
                </td>
                <td class="px-6 py-5">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
                      <span class="material-symbols-outlined text-on-surface-variant">person</span>
                    </div>
                    <div>
                      <p class="font-epilogue font-semibold text-on-surface">Marcus Chen</p>
                      <p class="text-label-caps font-manrope text-on-surface-variant">EMP-2048</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-5 font-manrope text-on-surface">Lead Full-stack Engineer</td>
                <td class="px-6 py-5">
                  <span class="px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-semibold font-manrope">Engineering</span>
                </td>
                <td class="px-6 py-5 text-right font-epilogue text-on-surface">$9,800.00</td>
                <td class="px-6 py-5 text-right font-epilogue text-primary">$800.00</td>
                <td class="px-6 py-5 text-right font-epilogue text-error">($520.00)</td>
                <td class="px-6 py-5 text-right font-epilogue font-bold text-on-surface">$10,080.00</td>
              </tr>

              <!-- Row 3 -->
              <tr class="hover:bg-surface-container-low transition-colors">
                <td class="px-6 py-5 text-center">
                  <input checked type="checkbox" class="w-4 h-4 rounded border-outline-variant cursor-pointer"/>
                </td>
                <td class="px-6 py-5">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
                      <span class="material-symbols-outlined text-on-surface-variant">person</span>
                    </div>
                    <div>
                      <p class="font-epilogue font-semibold text-on-surface">Sarah Jenkins</p>
                      <p class="text-label-caps font-manrope text-on-surface-variant">EMP-2051</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-5 font-manrope text-on-surface">HR Specialist</td>
                <td class="px-6 py-5">
                  <span class="px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-semibold font-manrope">Human Resources</span>
                </td>
                <td class="px-6 py-5 text-right font-epilogue text-on-surface">$6,200.00</td>
                <td class="px-6 py-5 text-right font-epilogue text-primary">$400.00</td>
                <td class="px-6 py-5 text-right font-epilogue text-error">($210.00)</td>
                <td class="px-6 py-5 text-right font-epilogue font-bold text-on-surface">$6,390.00</td>
              </tr>

              <!-- Row 4 -->
              <tr class="hover:bg-surface-container-low transition-colors">
                <td class="px-6 py-5 text-center">
                  <input checked type="checkbox" class="w-4 h-4 rounded border-outline-variant cursor-pointer"/>
                </td>
                <td class="px-6 py-5">
                  <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
                      <span class="material-symbols-outlined text-on-surface-variant">person</span>
                    </div>
                    <div>
                      <p class="font-epilogue font-semibold text-on-surface">David Wilson</p>
                      <p class="text-label-caps font-manrope text-on-surface-variant">EMP-2055</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-5 font-manrope text-on-surface">Marketing Manager</td>
                <td class="px-6 py-5">
                  <span class="px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-semibold font-manrope">Marketing</span>
                </td>
                <td class="px-6 py-5 text-right font-epilogue text-on-surface">$7,800.00</td>
                <td class="px-6 py-5 text-right font-epilogue text-primary">$1,500.00</td>
                <td class="px-6 py-5 text-right font-epilogue text-error">($380.00)</td>
                <td class="px-6 py-5 text-right font-epilogue font-bold text-on-surface">$8,920.00</td>
              </tr>

            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <div class="px-8 py-6 bg-surface-container-low flex items-center justify-between">
          <p class="text-label-caps font-manrope text-on-surface-variant">Showing 4 of 24 employees</p>
          <div class="flex gap-2">
            <button class="px-3 py-1 border border-outline-variant rounded-md hover:bg-surface-container-lowest transition-colors font-manrope text-on-surface">1</button>
            <button class="px-3 py-1 border border-outline-variant rounded-md hover:bg-surface-container-lowest transition-colors font-manrope text-on-surface">2</button>
            <button class="px-3 py-1 border border-outline-variant rounded-md hover:bg-surface-container-lowest transition-colors font-manrope text-on-surface">3</button>
            <span class="flex items-center px-1 text-on-surface-variant">...</span>
            <button class="px-3 py-1 border border-outline-variant rounded-md hover:bg-surface-container-lowest transition-colors font-manrope text-on-surface">6</button>
          </div>
        </div>

      </div>

      <!-- Spacer for sticky footer -->
      <div class="h-32"></div>

    </div>

    <!-- Sticky Footer Summary Bar -->
    <div class="fixed bottom-0 right-0 left-72 bg-surface-container-lowest/90 backdrop-blur-md border-t border-outline-variant px-container-padding py-6 z-50">
      <div class="flex items-center justify-between">
        
        <!-- Totals -->
        <div class="flex items-center gap-10">
          <div>
            <p class="text-label-caps font-manrope text-on-surface-variant mb-1">TOTAL EMPLOYEES SELECTED</p>
            <p class="text-display-num font-epilogue text-on-surface leading-none">24</p>
          </div>
          <div class="h-10 w-px bg-outline-variant"></div>
          <div>
            <p class="text-label-caps font-manrope text-on-surface-variant mb-1">TOTAL PAYROLL AMOUNT</p>
            <p class="text-display-num font-epilogue text-on-surface leading-none">$142,500.00</p>
          </div>
        </div>

        <!-- Warning + Button -->
        <div class="flex flex-col items-end gap-3">
          <div class="flex items-center gap-2 text-amber-700 bg-amber-50 px-3 py-1.5 rounded-lg border border-amber-200">
            <span class="material-symbols-outlined text-sm">warning</span>
            <p class="text-xs font-manrope font-semibold">Notice: Payslips once generated will be saved as a permanent record for this month.</p>
          </div>
          <button class="px-10 py-4 bg-primary-container text-on-primary-container font-epilogue font-bold text-lg rounded-xl hover:opacity-90 active:scale-95 transition-all">
            Generate Payslips
          </button>
        </div>

      </div>
    </div>

  </AuthenticatedLayout>
</template>