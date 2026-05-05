<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    payroll: {
        type: Object,
        required: true
    }
});

const formatCurrency = (value) => {
    return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', minimumFractionDigits: 2 }).format(value);
};

const printPayslip = () => {
    window.print();
};

// Generate allowances breakdown dynamically from payroll data
// Note: Since your Payroll table only stores total allowances, 
// you'll need to either:
// 1. Store allowance breakdown in JSON field, or
// 2. Fetch from employee_salary allowances
// For now, we'll show total allowances
const allowances = ref([
    { name: 'Total Allowances', amount: props.payroll.allowances_total }
]);

const deductions = ref([
    { name: 'Income Tax', amount: 0 },
    { name: 'Health Insurance', amount: 0 },
    { name: 'Retirement Fund', amount: 0 }
]);

// For demo, calculate 15% tax on gross salary
const calculatedDeductions = ref([
    { name: 'Income Tax (Estimated)', amount: props.payroll.gross_salary * 0.15 },
    { name: 'Health Insurance', amount: 50 },
    { name: 'Retirement Fund', amount: props.payroll.gross_salary * 0.05 }
]);

const getMonthlyName = (month) => {
    const months = ['January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'];
    return months[month - 1];
};
</script>

<template>
    <Head title="Payslip" />
    <AuthenticatedLayout pageTitle="Payroll Management">
        <div class="max-w-5xl mx-auto py-12 px-container-padding">

            <!-- Breadcrumb / Actions Row -->
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-headline-lg font-epilogue text-on-surface">Monthly Payslip</h2>
                    <p class="text-label-caps font-manrope text-on-surface-variant mt-1">
                        Generated on {{ new Date().toLocaleDateString() }}
                    </p>
                </div>
                <div class="flex gap-3">
                    <button @click="printPayslip" class="flex items-center gap-2 px-5 py-2.5 border border-on-surface rounded-xl font-epilogue text-sm text-on-surface hover:bg-surface-container-low transition-all active:scale-95">
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
                                <span class="material-symbols-outlined text-on-primary-container text-3xl">account_balance</span>
                            </div>
                            <div>
                                <h3 class="text-headline-md font-epilogue text-on-surface">Tempo HR</h3>
                                <p class="text-label-caps font-manrope text-on-surface-variant">PREMIUM HRMS</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-label-caps font-manrope text-on-surface-variant">PAY PERIOD</p>
                            <p class="text-headline-md font-epilogue text-on-surface">{{ getMonthlyName(payroll.month) }} {{ payroll.year }}</p>
                        </div>
                    </div>

                    <!-- Employee Info -->
                    <div class="grid grid-cols-4 gap-8">
                        <div>
                            <p class="text-label-caps font-manrope text-on-surface-variant mb-1">EMPLOYEE NAME</p>
                            <p class="font-epilogue text-on-surface">{{ payroll.employee?.first_name }} {{ payroll.employee?.last_name }}</p>
                        </div>
                        <div>
                            <p class="text-label-caps font-manrope text-on-surface-variant mb-1">DESIGNATION</p>
                            <p class="font-epilogue text-on-surface">{{ payroll.employee?.designation?.name || '—' }}</p>
                        </div>
                        <div>
                            <p class="text-label-caps font-manrope text-on-surface-variant mb-1">DEPARTMENT</p>
                            <p class="font-epilogue text-on-surface">{{ payroll.employee?.department?.name || '—' }}</p>
                        </div>
                        <div>
                            <p class="text-label-caps font-manrope text-on-surface-variant mb-1">EMPLOYEE ID</p>
                            <p class="font-epilogue text-on-surface">{{ payroll.employee?.employee_code }}</p>
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
                                    <span class="font-epilogue text-on-surface">{{ formatCurrency(payroll.basic_salary) }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-outline-variant">
                                    <span class="font-manrope text-on-surface/80">Total Allowances</span>
                                    <span class="font-epilogue text-on-surface">{{ formatCurrency(payroll.allowances_total) }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-4 border-t-2 border-outline-variant mt-2">
                                    <span class="font-epilogue font-semibold text-sm text-on-surface">Gross Earnings</span>
                                    <span class="font-epilogue font-semibold text-lg text-on-surface">{{ formatCurrency(payroll.gross_salary) }}</span>
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
                                    <span class="font-epilogue text-error">{{ formatCurrency(calculatedDeductions[0].amount) }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-outline-variant">
                                    <span class="font-manrope text-on-surface/80">Health Insurance</span>
                                    <span class="font-epilogue text-error">{{ formatCurrency(calculatedDeductions[1].amount) }}</span>
                                </div>
                                <div class="flex justify-between items-center py-2 border-b border-outline-variant">
                                    <span class="font-manrope text-on-surface/80">Retirement Fund</span>
                                    <span class="font-epilogue text-error">{{ formatCurrency(calculatedDeductions[2].amount) }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-4">
                                    <span class="font-epilogue font-semibold text-sm text-on-surface">Total Deductions</span>
                                    <span class="font-epilogue font-semibold text-lg text-error">{{ formatCurrency(calculatedDeductions[0].amount + calculatedDeductions[1].amount + calculatedDeductions[2].amount) }}</span>
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
                            <span class="text-display-num font-epilogue text-primary-container block">
                                {{ formatCurrency(payroll.gross_salary - (calculatedDeductions[0].amount + calculatedDeductions[1].amount + calculatedDeductions[2].amount)) }}
                            </span>
                            <p class="text-label-caps font-manrope text-on-surface-variant">Processed on {{ new Date(payroll.processed_at).toLocaleDateString() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Security Strip -->
                <div class="h-2 bg-primary-container w-full"></div>
            </div>

            <!-- Supporting Tiles -->
            <div class="mt-bento-gutter grid grid-cols-12 gap-bento-gutter">

                <!-- YTD (Year to Date - would need aggregation) -->
                <div class="col-span-4 bg-surface-container-lowest border border-outline-variant rounded-3xl p-container-padding">
                    <div class="flex justify-between mb-4">
                        <span class="text-label-caps font-manrope text-on-surface-variant">PAYMENT STATUS</span>
                        <span class="material-symbols-outlined text-on-surface-variant">receipt_long</span>
                    </div>
                    <p class="text-headline-lg font-epilogue text-on-surface capitalize">{{ payroll.status }}</p>
                    <p class="text-label-caps font-manrope text-on-surface-variant mt-2">Current payroll status</p>
                </div>

                <!-- Bank Account Info -->
                <div class="col-span-8 bg-surface-container-lowest border border-outline-variant rounded-3xl p-container-padding flex items-center justify-between">
                    <div class="flex gap-6 items-center">
                        <div class="w-16 h-16 rounded-full bg-surface-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary text-2xl">account_balance</span>
                        </div>
                        <div>
                            <p class="text-label-caps font-manrope text-on-surface-variant">EMPLOYEE BANK ACCOUNT</p>
                            <p class="font-epilogue text-on-surface">{{ payroll.employee?.first_name }} {{ payroll.employee?.last_name }}</p>
                            <p class="text-label-caps font-manrope text-on-surface-variant">Ask employee for bank details</p>
                        </div>
                    </div>
                    <span class="text-label-caps font-manrope text-on-surface-variant">Direct Deposit</span>
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

<style media="print">
@media print {
    .fixed {
        display: none !important;
    }
    .bg-surface-container-lowest {
        background: white !important;
    }
    button {
        display: none !important;
    }
    .material-symbols-outlined {
        display: none !important;
    }
}
</style>