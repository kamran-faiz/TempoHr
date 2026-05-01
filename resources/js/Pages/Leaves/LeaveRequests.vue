<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import LeaveRequestModal from '@/Components/LeaveRequestModal.vue';
import { ref } from 'vue';
import {router} from '@inertiajs/vue3';




const showModal = ref(false)
defineProps({
    employees: {
        type: Array,
        default: () => []
    },
    leaveTypes: {
        type: Array,
        default: () => []
    },
    leaveRequests: {
    type: Array,
    default: () => []
}
})

const handleSubmit = (formData) => {
    if(editingRequest.value){
        router.put(route('leaveRequests.update',editingRequest.value.id),formData,{
            onSuccess:() => {
                showModal.value=false
                 editingRequest.value = null
            }
        })
    }




   else { router.post(route('leaveRequests.store'),formData,{

        onSuccess: () => {
        showModal.value = false
        
      },
    })
}
}


const activeDropdown = ref(null)

const toggleDropdown = (id) => {
    activeDropdown.value = activeDropdown.value === id ? null : id
}

const editingRequest = ref(null)
const editRequest = (request) => {
    activeDropdown.value = null
    editingRequest.value= request
    showModal.value=true
}

const deleteRequest = (request) => {
    activeDropdown.value = null
    // Confirm and delete
}
const closeModal = () => {
    showModal.value = false
    editingRequest.value = null
}



</script>

<template>

<AuthenticatedLayout>
    <header class=" h-20 bg-[#F5F0E8]/80 backdrop-blur-md border-b border-[#E8E0D5] z-40 flex justify-between items-center px-8 font-['Epilogue']">
<div class="flex items-center gap-4">
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-stone-400">search</span>
<input class="bg-white border border-[#E8E0D5] rounded-full py-2 pl-10 pr-4 w-64 focus:outline-none focus:ring-2 focus:ring-[#F5D142] text-sm" placeholder="Search requests..." type="text"/>
</div>


<h2 class="text-lg font-semibold text-[#2D2A26]">Leave Management</h2>
</div>
<button @click="showModal = true" class="bg-[#F5D142] text-[#2D2A26] px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
        <span class="material-symbols-outlined text-sm">add</span> 
        Request Leave
    </button>
<div class="flex items-center gap-6">
<div class="flex items-center gap-4">
<button class="text-stone-500 hover:text-[#2D2A26] transition-colors relative">
<span class="material-symbols-outlined">notifications</span>
<span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border-2 border-[#F5F0E8]"></span>
</button>
<button class="text-stone-500 hover:text-[#2D2A26] transition-colors">
<span class="material-symbols-outlined">settings</span>
</button>
</div>
<div class="flex items-center gap-3 border-l border-[#E8E0D5] pl-6">
<div class="text-right">
<p class="text-sm font-semibold text-[#2D2A26]">Alex Rivers</p>
<p class="text-[10px] text-stone-500 uppercase tracking-wider">Administrator</p>
</div>
<img alt="Administrator Profile" class="w-10 h-10 rounded-full object-cover border-2 border-white" data-alt="Close-up professional headshot of a smiling man in business attire with soft natural lighting and neutral background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCkfWZMk-W6BTFogY-w7V54vAS4CtgekwZHxGrIzKzx7WcxyvfeifRgGZE8rstPK_ySAqOXwWFUzZqvJDPHjLfle17SBtm4_Gy65w6b_n61VVHH4Ffs5iS8JZcgrd9BlbkGp5SNXdNXnoQVaGehX9nUhRMwFTeMTS-zMlsqx9KRo2ySPP_8OwbfOYsYuhw-U1VVo7PbPBek1mlIHXFgBGQESyLiXo3zi8FyUcsD3PRjCoRQjKLH2d9jV3i2aJksIXuhASsEGFK6881V"/>
</div>
</div>
</header>
<!-- Main Content Canvas -->
<main class="p-8 min-h-screen">
<!-- Top Summary Cards -->
<section class="grid grid-cols-4 gap-bento-gutter mb-section-margin">
<div class="bento-card p-container-padding">
<div class="flex justify-between items-start mb-4">
<span class="font-label-caps text-on-secondary-container">TOTAL REQUESTS</span>
<span class="material-symbols-outlined text-primary">analytics</span>
</div>
<p class="font-display-num text-display-num text-on-surface">{{leaveRequests.length }}</p>
<p class="text-sm text-stone-500 mt-2 flex items-center gap-1">
<span class="text-emerald-600 font-semibold">Requests</span>
                </p>
</div>
<div class="bento-card p-container-padding">
<div class="flex justify-between items-start mb-4">
<span class="font-label-caps text-on-secondary-container">PENDING</span>
<span class="material-symbols-outlined text-primary-container">pending_actions</span>
</div>
<p class="font-display-num text-display-num text-on-surface">18</p>
<p class="text-sm text-stone-500 mt-2">Requires immediate action</p>
</div>
<div class="bento-card p-container-padding">
<div class="flex justify-between items-start mb-4">
<span class="font-label-caps text-on-secondary-container">APPROVED</span>
<span class="material-symbols-outlined text-emerald-500">check_circle</span>
</div>
<p class="font-display-num text-display-num text-on-surface">92</p>
<p class="text-sm text-stone-500 mt-2">This month so far</p>
</div>
<div class="bento-card p-container-padding">
<div class="flex justify-between items-start mb-4">
<span class="font-label-caps text-on-secondary-container">REJECTED</span>
<span class="material-symbols-outlined text-error">cancel</span>
</div>
<p class="font-display-num text-display-num text-on-surface">14</p>
<p class="text-sm text-stone-500 mt-2">Policy non-compliance</p>
</div>
</section>
<div class="flex gap-bento-gutter">
<!-- Main Section: Leave Requests List -->
<section class="w-3/4">
<div class="bento-card overflow-hidden">
<div class="px-container-padding py-6 border-b border-[#E8E0D5] flex justify-between items-center">
<h3 class="font-headline-md text-headline-md text-on-surface">Active Leave Requests</h3>
<div class="flex gap-2">
<button class="bg-[#FAF8F5] border border-[#E8E0D5] px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2">
<span class="material-symbols-outlined text-sm">filter_list</span> Filter
                            </button>
</div>
</div>
<div class="divide-y divide-[#E8E0D5]">
<!-- Row 1 -->
 
<div v-for="request in leaveRequests" :key="request.id" class="px-container-padding py-6 flex items-center hover:bg-[#FAF8F5] transition-colors">

<div class="w-1/4 flex items-center gap-4">
<img alt="Employee Photo" class="w-10 h-10 rounded-full object-cover" data-alt="Professional headshot of a young woman with a warm smile, outdoor lighting with soft greenery background" :src="`/storage/${request.employee.profile_image}`"/>
<div>
<p class="font-semibold text-on-surface">{{ request.employee.first_name }} {{ request.employee.last_name }}</p>
<p class="text-xs text-stone-500 font-label-clean">{{ request.employee.designation.name }}</p>
</div>
</div>
<div class="w-1/6">
<span class="px-3 py-1 bg-blue-50 text-blue-700 text-[11px] font-bold rounded-full uppercase tracking-wider">{{request.leave_type.name}}</span>
</div>
<div class="w-1/4">
<p class="text-sm text-on-surface">{{ request.start_date }} - {{ request.end_date }}</p>

</div>
<div class="flex-1">
<p class="text-sm text-stone-600 italic">{{ request.reason }}</p>
</div>
<div class="w-1/6 flex justify-end items-center gap-4">
<button class="text-[#705d00] font-semibold text-sm hover:underline decoration-2">Approve</button>
<span class="text-stone-300">|</span>
<button class="text-stone-400 font-medium text-sm hover:text-error transition-colors">Reject</button>

<div class="relative">
    <button @click="toggleDropdown(request.id)" class="p-1">
        <span class="material-symbols-outlined">more_vert</span>
    </button>
    
    <div v-if="activeDropdown === request.id" class="absolute right-0 mt-2 bg-white border rounded-lg shadow-lg z-10 w-32">
        <button @click="editRequest(request)" class="w-full text-left px-4 py-2 hover:bg-gray-100 text-sm">Edit</button>
        <button @click="deleteRequest(request)" class="w-full text-left px-4 py-2 hover:bg-gray-100 text-sm text-red-600">Delete</button>
    </div>
</div>
</div>
</div>

</div>
<div class="p-6 bg-[#FAF8F5] text-center">
<button class="text-stone-500 font-semibold text-sm hover:text-[#2D2A26] transition-colors">View All Request History</button>
</div>
</div>
</section>
<!-- Side Panel: Leave Balance Summary -->
<aside class="w-1/4">
<div class="bento-card p-container-padding sticky top-24">
<h3 class="font-headline-md text-headline-md text-on-surface mb-6">Leave Balance Summary</h3>
<div class="space-y-8">
<!-- Balance Item 1 -->
<div>
<div class="flex justify-between items-end mb-2">
<div>
<p class="font-label-caps text-stone-500">ANNUAL LEAVE</p>
<p class="font-semibold text-on-surface">14 Days Left</p>
</div>
<p class="text-xs text-stone-400">Total: 25</p>
</div>
<div class="w-full bg-stone-100 h-2 rounded-full overflow-hidden">
<div class="bg-[#F5D142] h-full w-[56%] rounded-full"></div>
</div>
</div>
<!-- Balance Item 2 -->
<div>
<div class="flex justify-between items-end mb-2">
<div>
<p class="font-label-caps text-stone-500">SICK LEAVE</p>
<p class="font-semibold text-on-surface">8 Days Left</p>
</div>
<p class="text-xs text-stone-400">Total: 10</p>
</div>
<div class="w-full bg-stone-100 h-2 rounded-full overflow-hidden">
<div class="bg-red-300 h-full w-[80%] rounded-full"></div>
</div>
</div>
<!-- Balance Item 3 -->
<div>
<div class="flex justify-between items-end mb-2">
<div>
<p class="font-label-caps text-stone-500">PERSONAL DAYS</p>
<p class="font-semibold text-on-surface">3 Days Left</p>
</div>
<p class="text-xs text-stone-400">Total: 5</p>
</div>
<div class="w-full bg-stone-100 h-2 rounded-full overflow-hidden">
<div class="bg-stone-400 h-full w-[60%] rounded-full"></div>
</div>
</div>
<div class="pt-6 border-t border-[#E8E0D5]">
<div class="bg-[#FAF8F5] p-4 rounded-xl">
<p class="font-label-caps text-[#705d00] mb-2 flex items-center gap-2">
<span class="material-symbols-outlined text-sm">info</span> TIP FOR ADMIN
                                </p>
<p class="text-xs text-stone-600 leading-relaxed">
                                    Approval rates are up by 8% this quarter. Consider reviewing the remote work policy to reduce sick leave requests.
                                </p>
</div>
</div>
</div>
<div class="mt-10">
<h4 class="font-label-caps text-stone-500 mb-4">TEAM AVAILABILITY TODAY</h4>
<div class="flex -space-x-3 overflow-hidden">
<img alt="User" class="inline-block h-8 w-8 rounded-full ring-2 ring-white" data-alt="Small avatar of a professional man" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhAO68A-pvW4EGe0MAjhmPFUHfht7NQSSzJ4garCxDdfcMAqDybTbpRhvwPhrXKlMcloNcm-PXAh0VY9n8yho_FaLQ9t7XKxjFtwNZl24j6a5TBv6HPOKtzOlR-ufNSXUBCyVZMTlh1t90TaOzP04vuNsDOi41xiG2WDwlbnFc7x2nDb2EwkKchWPl2ZlISvkHaJntmDBqyBPV1y_65e8RKm_643kAm90VdBdMowSj9caGawS6nJmOJyBGV1A_ESZEqOU3kk9irFJy"/>
<img alt="User" class="inline-block h-8 w-8 rounded-full ring-2 ring-white" data-alt="Small avatar of a professional woman" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_Eu3juIDGDQfNMMlAx8DnmoJNhMlY5rhD0C0rSjIEzBb6LEsMfOx_6oXSh2yvPA5F6OBpLyf6dh6uMP7O5IjPbBaShMek6OEg-DpJojLzqfmY3yc6L-Wb0ZOI11gGc_s1h-zfWYOqL1UZxkbepIKy77C251rTm5SLRCJaj6GoV9vhcprGxcy1d6XfRDk2m7PdXKtiDsEeRLFOIaPOCiV0BZaGafSxUOzmiLtRAqaIiCyX6zIqUT8xmSljEgWcOUU-hqe7X_OmrlvK"/>
<img alt="User" class="inline-block h-8 w-8 rounded-full ring-2 ring-white" data-alt="Small avatar of a man with glasses" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC03xPgMfOaaJB8pVm2QCG38pdzMF3yfXu06kRX-LiG1jJYo2I76Lca6FHKvYOboo2DazJhN4peFxy6O1tujgSHZZayTv-U9epne6f93qgIF7JPPZXV5-JKtXRUnKc5yBWUR1JAsAxnnkQ79KOSaOnkw9JJAb-ek4iE-RWj267v2PwprhuRucdgSe4S7F-Qo6fnEVb06Ali8l8OqDFJjtg4QDozUb7rD-66QeoYj5IsuQgyQ50GM_rROrp0eCQpb-tSfOFHsznaOYyh"/>
<div class="flex items-center justify-center h-8 w-8 rounded-full ring-2 ring-white bg-[#F5D142] text-[10px] font-bold text-[#2D2A26]">
                                +12
                            </div>
</div>
<p class="text-xs text-stone-500 mt-3">88% of your team is online</p>
</div>
</div>
</aside>
</div>
</main>
<LeaveRequestModal :show="showModal"
                   :employees="employees"
                   :leaveTypes="leaveTypes"
                   
                    @submit="handleSubmit"
                    :editing-request="editingRequest" 
                    @close="closeModal"/>
</AuthenticatedLayout>
</template>