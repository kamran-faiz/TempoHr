<script setup>
import {ref} from 'vue';
import {Link ,usePage} from '@inertiajs/vue3';



const user = usePage().props.auth.user;
const openMenu = ref(null);
const toggleMenu =(menu)=>{
    if(openMenu.value===menu){
        openMenu.value=null;
    }else{
        openMenu.value=menu;
    }
 }

 defineProps({
    pageTitle: {
        type: String,
        default: 'Dashboard'
    }
});






</script>

<template>
    <div class="min-h-screen flex bg-tempo-bg">

        <!-- Sidebar -->
        <aside class="fixed top-0 left-0 h-full bg-white w-72 border-r border-tempo-border z-50 flex flex-col py-6 custom-scrollbar overflow-y-auto">

            <!-- Logo -->
            <div class="px-8 mb-10 flex items-center gap-3">
                <div class="w-10 h-10 bg-primary-container rounded-lg flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-on-primary-container">account_balance</span>
                </div>
                <div>
                    <h1 class="font-epilogue font-bold text-tempo-text leading-none">Tempo HR</h1>
                    <p class="text-xs text-tempo-muted">Premium Workspace</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 space-y-1 px-4">

                <!-- Dashboard -->
                <Link
                    :href="route('dashboard')"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 hover:translate-x-1"
                    :class="route().current('dashboard') ? 'bg-tempo-accent text-tempo-text font-semibold shadow-sm' : 'text-tempo-text hover:bg-tempo-sidebar'"
                >
                    <span class="material-symbols-outlined">dashboard</span>
                    <span>Dashboard</span>
                </Link>

                <!-- Employees -->
                <div>
                    <button
                        @click="toggleMenu('employees')"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 hover:bg-tempo-sidebar hover:translate-x-1 text-tempo-text"
                    >
                        <span class="material-symbols-outlined">group</span>
                        <span class="flex-1 text-left">Employees</span>
                        <span class="material-symbols-outlined text-sm transition-transform duration-200" :class="openMenu === 'employees' ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div v-if="openMenu === 'employees'" class="ml-4 mt-1 space-y-1">
                        <Link :href="route('employees.index')" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-tempo-muted hover:bg-tempo-sidebar hover:text-tempo-text transition-all duration-200">
                            <span class="material-symbols-outlined text-sm">group</span>
                            Employee List
                        </Link>
                        <Link :href="route('employeeSalary.index')" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-tempo-muted hover:bg-tempo-sidebar hover:text-tempo-text transition-all duration-200">
                            <span class="material-symbols-outlined text-sm">payments</span>
                            Employee Salary
                        </Link>
                    </div>
                  
                </div>

                <!-- Leaves -->
                <div>
                    <button
                        @click="toggleMenu('leaves')"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 hover:bg-tempo-sidebar hover:translate-x-1 text-tempo-text"
                    >
                        <span class="material-symbols-outlined">event_note</span>
                        <span class="flex-1 text-left">Leaves</span>
                        <span class="material-symbols-outlined text-sm transition-transform duration-200" :class="openMenu === 'leaves' ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div v-if="openMenu === 'leaves'" class="ml-4 mt-1 space-y-1">
                        <Link :href="route('leaveRequests.index')" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-tempo-muted hover:bg-tempo-sidebar hover:text-tempo-text transition-all duration-200">
                            <span class="material-symbols-outlined text-sm">event_note</span>
                            Leave Management
                        </Link>
                        <Link :href="route('leave-balances.index')" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-tempo-muted hover:bg-tempo-sidebar hover:text-tempo-text transition-all duration-200">
                            <span class="material-symbols-outlined text-sm">balance</span>
                            Leave Balances
                        </Link>
                        <Link :href="route('dashboard')" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-tempo-muted hover:bg-tempo-sidebar hover:text-tempo-text transition-all duration-200">
                            <span class="material-symbols-outlined text-sm">person</span>
                            My Leaves
                        </Link>
                    </div>
                </div>

                <!-- Payroll -->
                <div>
                    <button
                        @click="toggleMenu('payroll')"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 hover:bg-tempo-sidebar hover:translate-x-1 text-tempo-text"
                    >
                        <span class="material-symbols-outlined">payments</span>
                        <span class="flex-1 text-left">Payroll</span>
                        <span class="material-symbols-outlined text-sm transition-transform duration-200" :class="openMenu === 'payroll' ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div v-if="openMenu === 'payroll'" class="ml-4 mt-1 space-y-1">
                        <Link :href="route('dashboard')" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-tempo-muted hover:bg-tempo-sidebar hover:text-tempo-text transition-all duration-200">
                            <span class="material-symbols-outlined text-sm">list</span>
                            Salary List
                        </Link>
                        <Link :href="route('dashboard')" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-tempo-muted hover:bg-tempo-sidebar hover:text-tempo-text transition-all duration-200">
                            <span class="material-symbols-outlined text-sm">play_circle</span>
                            Run Payroll
                        </Link>
                    </div>
                </div>

                <!-- Settings -->
                <div>
                    <button
                        @click="toggleMenu('settings')"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 hover:bg-tempo-sidebar hover:translate-x-1 text-tempo-text"
                    >
                        <span class="material-symbols-outlined">settings</span>
                        <span class="flex-1 text-left">Settings</span>
                        <span class="material-symbols-outlined text-sm transition-transform duration-200" :class="openMenu === 'settings' ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div v-if="openMenu === 'settings'" class="ml-4 mt-1 space-y-1">
                        <Link :href="route('departments.index')" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-tempo-muted hover:bg-tempo-sidebar hover:text-tempo-text transition-all duration-200">
                            <span class="material-symbols-outlined text-sm">corporate_fare</span>
                            Departments
                        </Link>
                        <Link :href="route('dashboard')" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-tempo-muted hover:bg-tempo-sidebar hover:text-tempo-text transition-all duration-200">
                            <span class="material-symbols-outlined text-sm">badge</span>
                            Designations
                        </Link>
                        <Link :href="route('dashboard')" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-tempo-muted hover:bg-tempo-sidebar hover:text-tempo-text transition-all duration-200">
                            <span class="material-symbols-outlined text-sm">percent</span>
                            Allowance Types
                        </Link>
                        <Link :href="route('dashboard')" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm text-tempo-muted hover:bg-tempo-sidebar hover:text-tempo-text transition-all duration-200">
                            <span class="material-symbols-outlined text-sm">beach_access</span>
                            Leave Types
                        </Link>
                    </div>
                </div>

            </nav>

            <!-- Bottom Section -->
            <div class="px-4 mt-6 space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-tempo-text hover:bg-tempo-sidebar transition-all duration-200">
                    <span class="material-symbols-outlined">help_outline</span>
                    <span class="text-sm">Help</span>
                </a>
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-error hover:bg-error-container transition-all duration-200"
                >
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm">Logout</span>
                </Link>
            </div>

        </aside>

        <!-- Main Content Area -->
        <div class="ml-72 flex flex-col flex-1">

            <!-- Topbar -->
            <header class="sticky top-0 z-40 flex justify-between items-center h-16 px-8 bg-tempo-bg border-b border-tempo-border">
                <h2 class="font-epilogue font-black text-xl text-tempo-text uppercase tracking-wider">{{ pageTitle }}</h2>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <button class="p-2 hover:bg-tempo-sidebar rounded-full transition-colors">
                            <span class="material-symbols-outlined text-tempo-text">notifications</span>
                        </button>
                        <button class="p-2 hover:bg-tempo-sidebar rounded-full transition-colors">
                            <span class="material-symbols-outlined text-tempo-text">chat_bubble</span>
                        </button>
                    </div>
                    <div class="h-8 w-px bg-tempo-border"></div>
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-tempo-text truncate">{{ user.name }}</p>
                            <p class="text-xs text-tempo-muted">Administrator</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-on-primary-container">person</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1">
                <slot />
            </main>

        </div>

    </div>
</template>