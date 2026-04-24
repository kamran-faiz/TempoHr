<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';





</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="p-container-padding space-y-section-margin max-w-7xl mx-auto">
<!-- Greeting & Stats Section -->
<section class="grid grid-cols-12 gap-bento-gutter">
<div class="col-span-12 md:col-span-7 flex flex-col justify-center">
<span class="font-label-caps text-primary tracking-[0.2em] mb-2">MONDAY, OCTOBER 23</span>
<h1 class="font-headline-lg text-on-surface mb-2">Welcome back, Alex.</h1>
<p class="font-body-lg text-on-surface-variant max-w-xl">Your workspace at <span class="font-bold text-on-surface">HRM Premium</span> is looking productive today. You have 4 pending leave requests to review.</p>
</div>
<div class="col-span-12 md:col-span-5 grid grid-cols-3 gap-4">
<div class="bg-white border border-[#E8E0D5] p-6 rounded-xl text-center">
<p class="font-label-caps text-on-surface-variant mb-1">TOTAL</p>
<p class="font-display-num text-on-surface">124</p>
<p class="font-label-clean text-on-surface-variant">Employees</p>
</div>
<div class="bg-white border border-[#E8E0D5] p-6 rounded-xl text-center">
<p class="font-label-caps text-on-surface-variant mb-1">PRESENT</p>
<p class="font-display-num text-primary">118</p>
<p class="font-label-clean text-on-surface-variant">In Office</p>
</div>
<div class="bg-white border border-[#E8E0D5] p-6 rounded-xl text-center">
<p class="font-label-caps text-on-surface-variant mb-1">PENDING</p>
<p class="font-display-num text-error">04</p>
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
<h3 class="font-headline-lg mt-6">Sarah Jenkins</h3>
<p class="font-body-md text-white/70">Senior Product Designer • Joined 3 years ago</p>
</div>
<div class="mt-auto">
<p class="font-body-lg italic mb-6">"Sarah has consistently exceeded expectations in our latest workspace redesign project."</p>
<button class="bg-primary-container text-on-primary-container px-6 py-3 rounded-lg font-bold hover:opacity-90 transition-all flex items-center gap-2">
                            View Profile <span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
</div>
</div>
<!-- Employee Breakdown & Quick Actions -->
<div class="col-span-12 lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-bento-gutter">
<!-- Breakdown (Donut Placeholder style) -->
<div class="bg-white border border-[#E8E0D5] p-container-padding rounded-2xl flex flex-col">
<div class="flex justify-between items-start mb-8">
<div>
<h4 class="font-label-caps text-on-surface-variant">DIVERSITY BREAKDOWN</h4>
<h3 class="font-headline-md mt-1">Departments</h3>
</div>
<span class="material-symbols-outlined text-on-surface-variant">pie_chart</span>
</div>
<div class="flex-1 flex items-center justify-center">
<div class="relative w-48 h-48 rounded-full border-[16px] border-[#F5F0E8] flex items-center justify-center">
<div class="absolute inset-0 rounded-full border-[16px] border-primary border-r-transparent border-b-transparent rotate-45"></div>
<div class="text-center">
<p class="font-display-num text-3xl">42%</p>
<p class="font-label-clean">Engineering</p>
</div>
</div>
</div>
<div class="grid grid-cols-2 gap-4 mt-8">
<div class="flex items-center gap-2">
<div class="w-2 h-2 rounded-full bg-primary"></div>
<span class="font-label-clean text-on-surface-variant text-xs">Engineering (52)</span>
</div>
<div class="flex items-center gap-2">
<div class="w-2 h-2 rounded-full bg-secondary"></div>
<span class="font-label-clean text-on-surface-variant text-xs">Design (18)</span>
</div>
<div class="flex items-center gap-2">
<div class="w-2 h-2 rounded-full bg-tertiary"></div>
<span class="font-label-clean text-on-surface-variant text-xs">Marketing (24)</span>
</div>
<div class="flex items-center gap-2">
<div class="w-2 h-2 rounded-full bg-surface-dim"></div>
<span class="font-label-clean text-on-surface-variant text-xs">Operations (30)</span>
</div>
</div>
</div>
<!-- Recent Activity -->
<div class="bg-white border border-[#E8E0D5] p-container-padding rounded-2xl">
<div class="flex justify-between items-start mb-8">
<div>
<h4 class="font-label-caps text-on-surface-variant">RECENT FEEDBACK</h4>
<h3 class="font-headline-md mt-1">Activity Log</h3>
</div>
<span class="material-symbols-outlined text-on-surface-variant">history</span>
</div>
<div class="space-y-6">
<div class="flex gap-4">
<div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-sm">add_task</span>
</div>
<div>
<p class="font-body-md text-sm"><span class="font-bold">New Policy</span> uploaded for remote work.</p>
<p class="font-label-clean text-xs text-on-surface-variant">2 hours ago</p>
</div>
</div>
<div class="flex gap-4">
<div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-secondary text-sm">person_add</span>
</div>
<div>
<p class="font-body-md text-sm"><span class="font-bold">Marcus Thorne</span> joined Engineering team.</p>
<p class="font-label-clean text-xs text-on-surface-variant">5 hours ago</p>
</div>
</div>
<div class="flex gap-4">
<div class="w-10 h-10 rounded-full bg-error/10 flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-error text-sm">emergency_home</span>
</div>
<div>
<p class="font-body-md text-sm"><span class="font-bold">Urgent Leave</span> requested by Emma Ray.</p>
<p class="font-label-clean text-xs text-on-surface-variant">Yesterday</p>
</div>
</div>
</div>
<button class="w-full mt-8 py-3 border border-[#E8E0D5] rounded-lg font-label-caps hover:bg-[#FAF8F5] transition-colors">VIEW ALL HISTORY</button>
</div>
</div>
</section>
<!-- Bottom Row: Leaves & Calendar -->
<section class="grid grid-cols-12 gap-bento-gutter pb-section-margin">
<!-- Leave Requests -->
<div class="col-span-12 lg:col-span-7 bg-white border border-[#E8E0D5] p-container-padding rounded-2xl">
<div class="flex justify-between items-center mb-8">
<div>
<h4 class="font-label-caps text-on-surface-variant">PENDING APPROVALS</h4>
<h3 class="font-headline-md mt-1">Leave Requests</h3>
</div>
<button class="text-primary font-label-caps hover:underline">Manage All</button>
</div>
<div class="space-y-4">
<!-- Request Item -->
<div class="flex items-center justify-between p-4 bg-[#FAF8F5] rounded-xl border border-[#E8E0D5]/50">
<div class="flex items-center gap-4">
<img alt="Profile" class="w-12 h-12 rounded-full object-cover" data-alt="portrait of a confident woman in corporate attire smiling gently in a soft lit office" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzcUpxxpeW9iSjpIec1TS767OWZkGyq8QEfznPZCiv-ChP24o9xUGEq7iNSpBPHlvRceTEVvxAU1ng0oSw9SWaAfEyzkvKL545ehkqvUISjmqC90Jz-w-6wYwJQXHkTtdbEYg6sjo2a3h7F1wOsJjNFX5vmGDvy6YGw0Dw3wb3-ofSTlU0hJctq4sLyuPsaSsysU01fXz3T2gwwsGzyElW9ONe5BrIO7ablOTWgsPuQWLP_hdDUyoWz5U17IVVroMINlhWqgiTBxO3"/>
<div>
<p class="font-headline-md text-base">Elena Rodriguez</p>
<p class="font-label-clean text-on-surface-variant">Annual Leave • 5 Days</p>
</div>
</div>
<div class="flex gap-2">
<button class="w-10 h-10 rounded-full border border-error/20 text-error hover:bg-error/10 flex items-center justify-center transition-colors">
<span class="material-symbols-outlined">close</span>
</button>
<button class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center hover:opacity-90 transition-all">
<span class="material-symbols-outlined">check</span>
</button>
</div>
</div>
<!-- Request Item -->
<div class="flex items-center justify-between p-4 bg-[#FAF8F5] rounded-xl border border-[#E8E0D5]/50">
<div class="flex items-center gap-4">
<img alt="Profile" class="w-12 h-12 rounded-full object-cover" data-alt="headshot of a man with a beard wearing glasses and a business casual blazer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA_8h80J55EFfhdejzQRyHnlAvnXC0IxQ62OYHqH5LbgtK29lqIzXz1-pYCBcA-aeGSZzbObFXwLaLlVJWpA_FT8uZPcAdE47ece7TpdXRgYQ-mfm5jYnMyXcZvU5dKEQmbjGwDuZIPjQ2pVJBZetp3ANbpBNxvjNbUgBm7DNR3pOBSs8VOxDSda8yxMIS1Bbiar95-TdabiaW2VGSHWf3mJrljFKfcjuKN23oDFq_ADXWVvprZXFCc2Dm3fFlD1tWgUQVFvlnaAn-e"/>
<div>
<p class="font-headline-md text-base">David Chen</p>
<p class="font-label-clean text-on-surface-variant">Sick Leave • 2 Days</p>
</div>
</div>
<div class="flex gap-2">
<button class="w-10 h-10 rounded-full border border-error/20 text-error hover:bg-error/10 flex items-center justify-center transition-colors">
<span class="material-symbols-outlined">close</span>
</button>
<button class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center hover:opacity-90 transition-all">
<span class="material-symbols-outlined">check</span>
</button>
</div>
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
<div class="flex gap-6">
<div class="w-12 h-14 bg-surface-container rounded-lg flex flex-col items-center justify-center border border-[#E8E0D5] shrink-0">
<span class="font-label-caps text-[10px] text-primary">OCT</span>
<span class="font-headline-md text-xl">25</span>
</div>
<div>
<p class="font-body-md font-bold">Town Hall Meeting</p>
<p class="font-label-clean text-on-surface-variant">09:30 AM • Main Conference Hall</p>
</div>
</div>
<div class="flex gap-6">
<div class="w-12 h-14 bg-surface-container rounded-lg flex flex-col items-center justify-center border border-[#E8E0D5] shrink-0">
<span class="font-label-caps text-[10px] text-primary">OCT</span>
<span class="font-headline-md text-xl">28</span>
</div>
<div>
<p class="font-body-md font-bold">Payroll Submission</p>
<p class="font-label-clean text-on-surface-variant">11:59 PM • Monthly Deadline</p>
</div>
</div>
<div class="flex gap-6">
<div class="w-12 h-14 bg-surface-container rounded-lg flex flex-col items-center justify-center border border-[#E8E0D5] shrink-0">
<span class="font-label-caps text-[10px] text-primary">NOV</span>
<span class="font-headline-md text-xl">02</span>
</div>
<div>
<p class="font-body-md font-bold">Quarterly Performance Review</p>
<p class="font-label-clean text-on-surface-variant">Full Day • Management Board</p>
</div>
</div>
</div>
<button class="w-full mt-8 py-3 bg-[#2D2A26] text-white rounded-lg font-label-caps hover:bg-stone-800 transition-colors">OPEN CALENDAR</button>
</div>
</section>
</div>

       
    </AuthenticatedLayout>
</template>
