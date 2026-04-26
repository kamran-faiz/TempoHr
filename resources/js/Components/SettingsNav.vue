<script setup>
import {Link} from '@inertiajs/vue3';


</script>

<template>
    <!-- Left Pane: Settings Navigation -->
<aside class="w-72 border-r border-[#E8E0D5] bg-[#FAF8F5] p-container-padding">
<h3 class="font-label-caps text-on-surface-variant mb-6 px-4">SETTINGS MENU</h3>
<nav class="flex flex-col gap-2">
<Link :class="route().current('departments.index') ? 'bg-[#F5D142] text-[#2D2A26] font-semibold' : 'text-[#2D2A26]/70 hover:bg-[#F5F0E8]'" class="flex items-center justify-between px-4 py-3 rounded-lg  transition-all group" :href="route('departments.index')">
<span class="font-body-md">Department Management</span>
<span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
</Link>
<Link :class="route().current('designations.index') ? 'bg-[#F5D142] text-[#2D2A26] font-semibold' : 'text-[#2D2A26]/70 hover:bg-[#F5F0E8]'" class="flex items-center justify-between px-4 py-3 rounded-lg  transition-all group" :href="route('designations.index')">
<span>Designation Management</span>
<span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity" data-icon="chevron_right">chevron_right</span>
</Link>
<Link :class="route().current('leaveTypes.index')" class="flex items-center justify-between px-4 py-3 rounded-lg text-[#2D2A26]/70 hover:bg-[#F5F0E8] transition-all font-body-md group" :href="route('leaveTypes.index')">
<span>Leave Types</span>
<span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity" data-icon="chevron_right">chevron_right</span>
</Link>
<Link :class="route().current('allowanceTypes.index')" class="flex items-center justify-between px-4 py-3 rounded-lg text-[#2D2A26]/70 hover:bg-[#F5F0E8] transition-all font-body-md group" :href="route('allowanceTypes.index')">
<span>Allowance Types</span>
<span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity" data-icon="chevron_right">chevron_right</span>
</Link>
<Link class="flex items-center justify-between px-4 py-3 rounded-lg text-[#2D2A26]/70 hover:bg-[#F5F0E8] transition-all font-body-md group" href="#">
<span>Company Profile</span>
<span class="material-symbols-outlined text-sm opacity-0 group-hover:opacity-100 transition-opacity" data-icon="chevron_right">chevron_right</span>
</Link>
</nav>
</aside>
</template>