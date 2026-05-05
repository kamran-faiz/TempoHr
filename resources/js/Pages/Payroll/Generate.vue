<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    employees: {
        type: Array,
        default: () => []
    },
    months: {
        type: Object,
        default: () => ({})
    },
    currentYear: {
        type: Number,
        default: 2026
    }
});

const filters = ref({
    month: new Date().getMonth() + 1,
    year: props.currentYear,
    department: ''
});

const selectedEmployees = ref([]);
const isLoading = ref(false);

const departments = computed(() => {
    const depts = [...new Set(props.employees.map(e => e.department?.name).filter(Boolean))];
    return ['All Departments', ...depts];
});

const filteredEmployees = computed(() => {
    let filtered = props.employees;
    
    if (filters.value.department && filters.value.department !== 'All Departments') {
        filtered = filtered.filter(e => e.department?.name === filters.value.department);
    }
    
    return filtered;
});

const toggleEmployee = (employeeId) => {
    if (selectedEmployees.value.includes(employeeId)) {
        selectedEmployees.value = selectedEmployees.value.filter(id => id !== employeeId);
    } else {
        selectedEmployees.value.push(employeeId);
    }
};

const toggleAll = () => {
    if (selectedEmployees.value.length === filteredEmployees.value.length) {
        selectedEmployees.value = [];
    } else {
        selectedEmployees.value = filteredEmployees.value.map(e => e.id);
    }
};

const getEmployeeSalary = (employee) => {
    const salary = employee.employee_salary?.basic_salary || 0;
    const allowances = employee.employee_salary?.allowances?.reduce((sum, a) => sum + Number(a.value), 0) || 0;
    return {
        basic: salary,
        allowances: allowances,
        gross: salary + allowances
    };
};

const totalSelectedPayroll = computed(() => {
    const selected = filteredEmployees.value.filter(e => selectedEmployees.value.includes(e.id));
    return selected.reduce((sum, emp) => sum + getEmployeeSalary(emp).gross, 0);
});

const applyFilters = () => {
    // Filtering is already handled by computed properties
};

const generatePayroll = () => {
    if (selectedEmployees.value.length === 0) {
        alert('Please select at least one employee');
        return;
    }
    
    isLoading.value = true;
    
    const payrollData = {
        month: filters.value.month,
        year: filters.value.year,
        employees: filteredEmployees.value
            .filter(e => selectedEmployees.value.includes(e.id))
            .map(e => ({
                id: e.id,
                basic_salary: getEmployeeSalary(e).basic,
                allowances: getEmployeeSalary(e).allowances,
                gross_salary: getEmployeeSalary(e).gross
            }))
    };
    
    router.post(route('payroll.process'), payrollData, {
        onSuccess: () => {
            isLoading.value = false;
            selectedEmployees.value = [];
        },
        onError: () => {
            isLoading.value = false;
        }
    });
};

const formatCurrency = (value) => {
    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', minimumFractionDigits: 2 }).format(value);
};
</script>

<template>
    <Head title="Generate Payroll" />
    <AuthenticatedLayout pageTitle="Payroll Processing">
        <div class="p-container-padding flex-1">

            <!-- Filters Card -->
            <div class="bg-surface-container-lowest rounded-xl border border-outline-variant p-container-padding mb-bento-gutter flex flex-wrap items-end gap-element-gap">
                
                <!-- Payroll Period -->
                <div class="flex-1 min-w-[200px] space-y-2">
                    <label class="text-label-caps font-manrope text-on-surface-variant block">PAYROLL PERIOD</label>
                    <div class="flex gap-4">
                        <select v-model="filters.month" class="flex-1 bg-surface border border-outline-variant rounded-lg px-4 py-3 font-manrope text-on-surface focus:border-primary-container outline-none">
                            <option v-for="(name, num) in months" :key="num" :value="parseInt(num)">
                                {{ name }}
                            </option>
                        </select>
                        <select v-model="filters.year" class="w-32 bg-surface border border-outline-variant rounded-lg px-4 py-3 font-manrope text-on-surface focus:border-primary-container outline-none">
                            <option :value="currentYear - 1">{{ currentYear - 1 }}</option>
                            <option :value="currentYear">{{ currentYear }}</option>
                            <option :value="currentYear + 1">{{ currentYear + 1 }}</option>
                        </select>
                    </div>
                </div>

                <!-- Department -->
                <div class="flex-1 min-w-[200px] space-y-2">
                    <label class="text-label-caps font-manrope text-on-surface-variant block">DEPARTMENT</label>
                    <select v-model="filters.department" class="w-full bg-surface border border-outline-variant rounded-lg px-4 py-3 font-manrope text-on-surface focus:border-primary-container outline-none">
                        <option v-for="dept in departments" :key="dept" :value="dept">{{ dept }}</option>
                    </select>
                </div>

                <!-- Apply Button -->
                <button @click="applyFilters" class="px-8 py-3.5 bg-surface-container text-on-surface font-manrope font-semibold rounded-lg hover:bg-surface-container-high transition-colors flex items-center gap-2">
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
                        <p class="text-label-caps font-manrope text-on-surface-variant">
                            Reviewing {{ filteredEmployees.length }} active employees for the {{ months[filters.month] }} {{ filters.year }} cycle.
                        </p>
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
                                    <input type="checkbox" 
                                        :checked="selectedEmployees.length === filteredEmployees.length && filteredEmployees.length > 0"
                                        @change="toggleAll"
                                        class="w-4 h-4 rounded border-outline-variant cursor-pointer"/>
                                </th>
                                <th class="px-6 py-4">EMPLOYEE</th>
                                <th class="px-6 py-4">DESIGNATION</th>
                                <th class="px-6 py-4">DEPARTMENT</th>
                                <th class="px-6 py-4 text-right">BASIC SALARY</th>
                                <th class="px-6 py-4 text-right">ALLOWANCES</th>
                                <th class="px-6 py-4 text-right">GROSS SALARY</th>
                             </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            <tr v-for="employee in filteredEmployees" :key="employee.id" class="hover:bg-surface-container-low transition-colors">
                                <td class="px-6 py-5 text-center">
                                    <input type="checkbox" 
                                        :value="employee.id"
                                        v-model="selectedEmployees"
                                        class="w-4 h-4 rounded border-outline-variant cursor-pointer"/>
                                 </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center overflow-hidden">
                                            <img v-if="employee.profile_image" :src="'/storage/' + employee.profile_image" class="w-full h-full object-cover"/>
                                            <span v-else class="material-symbols-outlined text-on-surface-variant">person</span>
                                        </div>
                                        <div>
                                            <p class="font-epilogue font-semibold text-on-surface">{{ employee.first_name }} {{ employee.last_name }}</p>
                                            <p class="text-label-caps font-manrope text-on-surface-variant">{{ employee.employee_code }}</p>
                                        </div>
                                    </div>
                                 </td>
                                <td class="px-6 py-5 font-manrope text-on-surface">{{ employee.designation?.name || '—' }}</td>
                                <td class="px-6 py-5">
                                    <span class="px-2.5 py-1 rounded-full bg-surface-container text-on-surface-variant text-xs font-semibold font-manrope">{{ employee.department?.name || '—' }}</span>
                                </td>
                                <td class="px-6 py-5 text-right font-epilogue text-on-surface">{{ formatCurrency(getEmployeeSalary(employee).basic) }}</td>
                                <td class="px-6 py-5 text-right font-epilogue text-primary">+{{ formatCurrency(getEmployeeSalary(employee).allowances) }}</td>
                                <td class="px-6 py-5 text-right font-epilogue font-bold text-on-surface">{{ formatCurrency(getEmployeeSalary(employee).gross) }}</td>
                             </tr>
                            <tr v-if="filteredEmployees.length === 0">
                                <td colspan="7" class="px-6 py-12 text-center text-on-surface-variant">
                                    No employees found.
                                </td>
                             </tr>
                        </tbody>
                     </table>
                </div>

                <!-- Pagination Placeholder -->
                <div class="px-8 py-6 bg-surface-container-low flex items-center justify-between">
                    <p class="text-label-caps font-manrope text-on-surface-variant">Showing {{ filteredEmployees.length }} of {{ filteredEmployees.length }} employees</p>
                    <div class="flex gap-2">
                        <button class="px-3 py-1 border border-outline-variant rounded-md hover:bg-surface-container-lowest transition-colors font-manrope text-on-surface">1</button>
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
                        <p class="text-display-num font-epilogue text-on-surface leading-none">{{ selectedEmployees.length }}</p>
                    </div>
                    <div class="h-10 w-px bg-outline-variant"></div>
                    <div>
                        <p class="text-label-caps font-manrope text-on-surface-variant mb-1">TOTAL PAYROLL AMOUNT</p>
                        <p class="text-display-num font-epilogue text-on-surface leading-none">{{ formatCurrency(totalSelectedPayroll) }}</p>
                    </div>
                </div>

                <!-- Warning + Button -->
                <div class="flex flex-col items-end gap-3">
                    <div class="flex items-center gap-2 text-amber-700 bg-amber-50 px-3 py-1.5 rounded-lg border border-amber-200">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        <p class="text-xs font-manrope font-semibold">Notice: Payslips once generated will be saved as a permanent record for this month.</p>
                    </div>
                    <button @click="generatePayroll" :disabled="isLoading || selectedEmployees.length === 0" 
                        class="px-10 py-4 bg-primary-container text-on-primary-container font-epilogue font-bold text-lg rounded-xl hover:opacity-90 active:scale-95 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        {{ isLoading ? 'Processing...' : 'Generate Payslips' }}
                    </button>
                </div>

            </div>
        </div>

    </AuthenticatedLayout>
</template>