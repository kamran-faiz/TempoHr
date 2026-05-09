<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
    payrolls: {
        type: Object,
        default: () => ({})
    },
    totalAmount: {
        type: Number,
        default: 0
    },
    totalEmployees: {
        type: Number,
        default: 0
    },
    pendingCount: {
        type: Number,
        default: 0
    },
    months: {
        type: Object,
        default: () => ({})
    },
    currentYear: {
        type: Number,
        default: 2026
    },
    departments: {
        type: Array,
        default: () => []
    }
});

const filters = ref({
    department: '',
    month: '',
    year: props.currentYear
});

const applyFilters = () => {
    router.get('/payroll/records', filters.value, {
        preserveState: true,
        onSuccess: (page) => {
            // Update payrolls data
            Object.assign(props.payrolls, page.props.payrolls);
        }
    });
};

const viewPayslip = (id) => {
    router.get(route('payroll.payslip', id));
};

const formatCurrency = (value) => {
    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', minimumFractionDigits: 2 }).format(value);
};

const getStatusBadgeClass = (status) => {
    switch (status) {
        case 'paid':
            return 'bg-emerald-100 text-emerald-800';
        case 'processed':
            return 'bg-blue-100 text-blue-800';
        case 'draft':
            return 'bg-amber-100 text-amber-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
};

const getStatusText = (status) => {
    return status.charAt(0).toUpperCase() + status.slice(1);
};
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
                        <span class="text-label-caps font-manrope text-tertiary">TOTAL PAYROLL</span>
                        <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                    </div>
                    <h3 class="text-display-num font-epilogue text-on-surface">{{ formatCurrency(totalAmount) }}</h3>
                    <div class="flex items-center gap-2 text-xs font-manrope text-tertiary mt-1">
                        <span class="material-symbols-outlined text-sm">groups</span>
                        <span>Total processed payroll records</span>
                    </div>
                </div>

                <!-- Employees Paid -->
                <div class="col-span-4 bg-surface-container-lowest border border-outline-variant rounded-xl p-container-padding">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-label-caps font-manrope text-tertiary">EMPLOYEES PAID</span>
                        <span class="material-symbols-outlined text-primary">person_check</span>
                    </div>
                    <h3 class="text-display-num font-epilogue text-on-surface">{{ totalEmployees }}</h3>
                    <div class="flex items-center gap-2 text-xs font-manrope text-tertiary mt-1">
                        <span class="material-symbols-outlined text-sm">receipt_long</span>
                        <span>Payroll records generated</span>
                    </div>
                </div>

                <!-- Pending Payments -->
                <div class="col-span-4 bg-surface-container-lowest border border-outline-variant rounded-xl p-container-padding">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-label-caps font-manrope text-tertiary">PENDING PAYMENTS</span>
                        <span class="material-symbols-outlined text-error">pending_actions</span>
                    </div>
                    <h3 class="text-display-num font-epilogue text-on-surface">{{ pendingCount }}</h3>
                    <div class="flex items-center gap-2 text-xs font-manrope text-error mt-1">
                        <span class="material-symbols-outlined text-sm">warning</span>
                        <span>Awaiting final approval</span>
                    </div>
                </div>

            </div>

            <!-- Payroll Table -->
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden">

                <!-- Table Header with Filters -->
                <div class="p-8 border-b border-outline-variant flex flex-wrap justify-between items-center gap-4 bg-surface-container-low">
                    <div>
                        <h4 class="text-headline-md font-epilogue text-on-surface">Payroll Directory</h4>
                        <p class="text-label-caps font-manrope text-tertiary">Monthly disbursement report</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex flex-col">
                            <label class="text-label-caps font-manrope text-tertiary mb-1">DEPARTMENT</label>
                            <select v-model="filters.department" class="bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm font-manrope focus:ring-2 focus:ring-primary-container outline-none">
                                <option value="">All Departments</option>
                                <option v-for="dept in departments" :key="dept.id" :value="dept.name">
                                    {{ dept.name }}
                                </option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-label-caps font-manrope text-tertiary mb-1">MONTH</label>
                            <select v-model="filters.month" class="bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm font-manrope focus:ring-2 focus:ring-primary-container outline-none">
                                <option value="">All Months</option>
                                <option v-for="(name, num) in months" :key="num" :value="num">{{ name }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-label-caps font-manrope text-tertiary mb-1">YEAR</label>
                            <select v-model="filters.year" class="bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm font-manrope focus:ring-2 focus:ring-primary-container outline-none">
                                <option :value="currentYear - 1">{{ currentYear - 1 }}</option>
                                <option :value="currentYear">{{ currentYear }}</option>
                                <option :value="currentYear + 1">{{ currentYear + 1 }}</option>
                            </select>
                        </div>
                        <button @click="applyFilters" class="mt-5 w-10 h-10 flex items-center justify-center border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors">
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
                                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">MONTH/YEAR</th>
                                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">BASIC SALARY</th>
                                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">ALLOWANCES</th>
                                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">GROSS SALARY</th>
                                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">STATUS</th>
                                <th class="px-8 py-4 text-label-caps font-manrope text-tertiary">ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            <tr v-for="payroll in payrolls.data" :key="payroll.id" class="hover:bg-surface-container-low transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-surface-container flex items-center justify-center">
                                            <span class="material-symbols-outlined text-on-surface-variant">person</span>
                                        </div>
                                        <div>
                                            <p class="font-epilogue font-bold text-sm text-on-surface">{{ payroll.employee?.first_name }} {{ payroll.employee?.last_name }}</p>
                                            <p class="font-manrope text-xs text-tertiary">{{ payroll.employee?.department?.name || '—' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 font-manrope text-sm text-on-surface">{{ payroll.employee?.designation?.name || '—' }}</td>
                                <td class="px-8 py-5 font-manrope text-sm text-on-surface">{{ months[payroll.month] }} {{ payroll.year }}</td>
                                <td class="px-8 py-5 font-epilogue text-sm font-semibold text-on-surface">{{ formatCurrency(payroll.basic_salary) }}</td>
                                <td class="px-8 py-5 font-epilogue text-sm text-emerald-600">+{{ formatCurrency(payroll.allowances_total) }}</td>
                                <td class="px-8 py-5 font-epilogue text-sm font-bold text-on-surface">{{ formatCurrency(payroll.gross_salary) }}</td>
                                <td class="px-8 py-5">
                                    <span :class="['inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium', getStatusBadgeClass(payroll.status)]">
                                        {{ getStatusText(payroll.status) }}
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <button @click="viewPayslip(payroll.id)" class="w-8 h-8 flex items-center justify-center rounded-lg bg-surface-container hover:bg-primary-container transition-colors">
                                        <span class="material-symbols-outlined text-lg text-on-surface-variant">receipt_long</span>
                                    </button>
                                 </td>
                             </tr>
                            <tr v-if="!payrolls.data?.length">
                                <td colspan="8" class="px-8 py-12 text-center text-tertiary">
                                    No payroll records found.
                                 </td>
                             </tr>
                        </tbody>
                     </table>
                </div>

                <!-- Pagination -->
                <div v-if="payrolls.data?.length" class="p-8 border-t border-outline-variant flex justify-between items-center bg-surface-container-low">
                    <p class="font-manrope text-xs text-tertiary">
                        Showing {{ payrolls.from || 0 }} to {{ payrolls.to || 0 }} of {{ payrolls.total || 0 }} records
                    </p>
                    <div class="flex gap-2">
                        <button v-for="link in payrolls.links" :key="link.label" 
                            @click="link.url && router.get(link.url)"
                            v-html="link.label"
                            class="min-w-[40px] h-10 flex items-center justify-center border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors"
                            :class="{ 'bg-primary-container text-on-primary-container border-primary-container': link.active, 'text-tertiary': !link.active }">
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>