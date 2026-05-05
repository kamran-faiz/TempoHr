<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, Link } from '@inertiajs/vue3';

const props = defineProps({
    totalEmployees: Number,
    presentToday: Number,
    pendingLeaves: Number,
    departmentBreakdown: Array,
    pendingLeaveRequests: Array,
    recentActivities: Array,
    spotlightEmployee: Object,
    upcomingEvents: Array,
    dayName: String,
    formattedDate: String
});

const approveLeave = (leaveId) => {
    router.put(route('leaveRequests.updateStatus', leaveId), { status: 'approved' });
};

const rejectLeave = (leaveId) => {
    router.put(route('leaveRequests.updateStatus', leaveId), { status: 'rejected' });
};

const getIconColorClass = (color) => {
    const colors = {
        primary: 'text-primary',
        secondary: 'text-secondary',
        error: 'text-error'
    };
    return colors[color] || 'text-primary';
};
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="p-container-padding space-y-section-margin max-w-7xl mx-auto">

            <!-- Greeting & Stats Section -->
            <section class="grid grid-cols-12 gap-bento-gutter">
                <div class="col-span-12 md:col-span-7 flex flex-col justify-center">
                    <span class="font-label-caps text-primary tracking-[0.2em] mb-2">{{ dayName }}, {{ formattedDate }}</span>
                    <h1 class="font-headline-lg text-on-surface mb-2">Welcome back, Alex.</h1>
                    <p class="font-body-lg text-on-surface-variant max-w-xl">
                        Your workspace at <span class="font-bold text-on-surface">Tempo HR</span> is looking productive today. 
                        You have {{ pendingLeaves }} pending leave requests to review.
                    </p>
                </div>
                <div class="col-span-12 md:col-span-5 grid grid-cols-3 gap-4">
                    <div class="bg-white border border-[#E8E0D5] p-6 rounded-xl text-center">
                        <p class="font-label-caps text-on-surface-variant mb-1">TOTAL</p>
                        <p class="font-display-num text-on-surface">{{ totalEmployees }}</p>
                        <p class="font-label-clean text-on-surface-variant">Employees</p>
                    </div>
                    <div class="bg-white border border-[#E8E0D5] p-6 rounded-xl text-center">
                        <p class="font-label-caps text-on-surface-variant mb-1">ACTIVE</p>
                        <p class="font-display-num text-primary">{{ presentToday }}</p>
                        <p class="font-label-clean text-on-surface-variant">Active Staff</p>
                    </div>
                    <div class="bg-white border border-[#E8E0D5] p-6 rounded-xl text-center">
                        <p class="font-label-caps text-on-surface-variant mb-1">PENDING</p>
                        <p class="font-display-num text-error">{{ pendingLeaves }}</p>
                        <p class="font-label-clean text-on-surface-variant">Leaves</p>
                    </div>
                </div>
            </section>

            <!-- Bento Grid Main Content -->
            <section class="grid grid-cols-12 gap-bento-gutter">
                
                <!-- Employee Spotlight -->
                <div class="col-span-12 lg:col-span-4 bg-gradient-to-br from-[#2D2A26] to-[#4A4642] rounded-2xl p-container-padding text-white relative overflow-hidden flex flex-col justify-between h-[450px]">
                    <div class="absolute top-0 right-0 p-container-padding opacity-20">
                        <span class="material-symbols-outlined text-[120px]" style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                    </div>
                    <div>
                        <span class="bg-primary/20 text-primary-fixed border border-primary/30 px-3 py-1 rounded-full font-label-caps">Employee Spotlight</span>
                        <h3 class="font-headline-lg mt-6">{{ spotlightEmployee?.first_name }} {{ spotlightEmployee?.last_name }}</h3>
                        <p class="font-body-md text-white/70">{{ spotlightEmployee?.designation?.name || 'Team Member' }} • Team Member</p>
                    </div>
                    <div class="mt-auto">
                        <p class="font-body-lg italic mb-6">"Outstanding contribution to the team this quarter."</p>
                        <Link :href="route('employees.show', spotlightEmployee?.id)" class="inline-block bg-primary-container text-on-primary-container px-6 py-3 rounded-lg font-bold hover:opacity-90 transition-all flex items-center gap-2">
                            View Profile <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </Link>
                    </div>
                </div>

                <!-- Employee Breakdown & Quick Actions -->
                <div class="col-span-12 lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-bento-gutter">
                    
                    <!-- Department Breakdown -->
                    <div class="bg-white border border-[#E8E0D5] p-container-padding rounded-2xl flex flex-col">
                        <div class="flex justify-between items-start mb-8">
                            <div>
                                <h4 class="font-label-caps text-on-surface-variant">TEAM BREAKDOWN</h4>
                                <h3 class="font-headline-md mt-1">Departments</h3>
                            </div>
                            <span class="material-symbols-outlined text-on-surface-variant">pie_chart</span>
                        </div>
                        <div class="flex-1 space-y-4">
                            <div v-for="dept in departmentBreakdown" :key="dept.name" class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-primary"></div>
                                    <span class="font-label-clean text-on-surface-variant text-sm">{{ dept.name }}</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="font-label-clean text-on-surface-variant text-sm">{{ dept.count }} employees</span>
                                    <span class="font-label-caps text-sm text-primary">{{ dept.percentage }}%</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 pt-4 border-t border-[#E8E0D5]">
                            <div class="w-full bg-[#F5F0E8] rounded-full h-2 overflow-hidden">
                                <div v-for="(dept, index) in departmentBreakdown" :key="dept.name" 
                                    class="h-full float-left" 
                                    :style="{ width: dept.percentage + '%', backgroundColor: index === 0 ? '#F5D142' : index === 1 ? '#625E59' : index === 2 ? '#635E55' : '#DED9D2' }">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
<div class="bg-white border border-[#E8E0D5] p-container-padding rounded-2xl">
    <div class="flex justify-between items-start mb-8">
        <div>
            <h4 class="font-label-caps text-on-surface-variant">RECENT ACTIVITY</h4>
            <h3 class="font-headline-md mt-1">Activity Log</h3>
        </div>
        <span class="material-symbols-outlined text-on-surface-variant">history</span>
    </div>
    <div class="space-y-6">
        <div v-for="activity in recentActivities" :key="activity.message" class="flex gap-4">
            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-primary text-sm">{{ activity.icon }}</span>
            </div>
            <div>
                <p class="font-body-md text-sm">{{ activity.message }}</p>
                <p class="font-label-clean text-xs text-on-surface-variant">{{ activity.time }}</p>
            </div>
        </div>
    </div>
    <button class="w-full mt-8 py-3 border border-[#E8E0D5] rounded-lg font-label-caps hover:bg-[#FAF8F5] transition-colors">
        VIEW ALL HISTORY
    </button>
</div>

            <!-- Bottom Row: Leaves & Calendar -->
            <section class="grid grid-cols-12 gap-bento-gutter pb-section-margin">
                
                <!-- Pending Leave Requests -->
                <div class="col-span-12 lg:col-span-7 bg-white border border-[#E8E0D5] p-container-padding rounded-2xl">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h4 class="font-label-caps text-on-surface-variant">PENDING APPROVALS</h4>
                            <h3 class="font-headline-md mt-1">Leave Requests</h3>
                        </div>
                        <Link :href="route('leaveRequests.index')" class="text-primary font-label-caps hover:underline">Manage All</Link>
                    </div>
                    <div class="space-y-4">
                        <div v-for="request in pendingLeaveRequests" :key="request.id" class="flex items-center justify-between p-4 bg-[#FAF8F5] rounded-xl border border-[#E8E0D5]/50">
                            <div class="flex items-center gap-4">
                                <img v-if="request.employee_avatar" :src="'/storage/' + request.employee_avatar" class="w-12 h-12 rounded-full object-cover" />
                                <div v-else class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center">
                                    <span class="material-symbols-outlined text-on-surface-variant">person</span>
                                </div>
                                <div>
                                    <p class="font-headline-md text-base">{{ request.employee_name }}</p>
                                    <p class="font-label-clean text-on-surface-variant">{{ request.leave_type }} • {{ request.days }} Days</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button @click="rejectLeave(request.id)" class="w-10 h-10 rounded-full border border-error/20 text-error hover:bg-error/10 flex items-center justify-center transition-colors">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                                <button @click="approveLeave(request.id)" class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center hover:opacity-90 transition-all">
                                    <span class="material-symbols-outlined">check</span>
                                </button>
                            </div>
                        </div>
                        <div v-if="pendingLeaveRequests.length === 0" class="text-center py-8 text-on-surface-variant">
                            No pending leave requests.
                        </div>
                    </div>
                </div>

                <!-- Calendar / Events -->
                <div class="col-span-12 lg:col-span-5 bg-white border border-[#E8E0D5] p-container-padding rounded-2xl">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h4 class="font-label-caps text-on-surface-variant">UPCOMING</h4>
                            <h3 class="font-headline-md mt-1">Events &amp; Deadlines</h3>
                        </div>
                        <span class="material-symbols-outlined text-on-surface-variant">calendar_today</span>
                    </div>
                    <div class="space-y-6">
                        <div v-for="event in upcomingEvents" :key="event.title" class="flex gap-6">
                            <div class="w-12 h-14 bg-surface-container rounded-lg flex flex-col items-center justify-center border border-[#E8E0D5] shrink-0">
                                <span class="font-label-caps text-[10px] text-primary">{{ event.month }}</span>
                                <span class="font-headline-md text-xl">{{ event.day }}</span>
                            </div>
                            <div>
                                <p class="font-body-md font-bold">{{ event.title }}</p>
                                <p class="font-label-clean text-on-surface-variant">{{ event.time }} • {{ event.location }}</p>
                            </div>
                        </div>
                    </div>
                    <button class="w-full mt-8 py-3 bg-[#2D2A26] text-white rounded-lg font-label-caps hover:bg-stone-800 transition-colors">
                        OPEN CALENDAR
                    </button>
                </div>
            </section>

        </div>
    </AuthenticatedLayout>
</template>