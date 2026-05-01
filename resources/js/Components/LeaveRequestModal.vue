<script setup>
import { defineEmits,ref } from 'vue';
import {useForm} from '@inertiajs/vue3';
import { watch } from 'vue'

const props = defineProps({
    show: Boolean,
    employees: Array,
    leaveTypes: Array,
    editingRequest: Object
})
const form = useForm({
    employee_id: null,
    leave_type_id: null,
    start_date: '',
    end_date: '',
    reason: ''
})


const emit = defineEmits(['close', 'submit'])



watch(() => props.editingRequest, (newRequest) => {
    if (newRequest) {
        form.employee_id = newRequest.employee_id
        form.leave_type_id = newRequest.leave_type_id
        form.start_date = newRequest.start_date
        form.end_date = newRequest.end_date
        form.reason = newRequest.reason
    } else {
        form.employee_id = null
        form.leave_type_id = null
        form.start_date = ''
        form.end_date = ''
        form.reason = ''
    }
})








</script>





<template>

    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-[2px]">
<!-- Modal Card -->
<div class="w-full max-w-xl bg-white rounded-2xl border border-[#E8E0D5] shadow-2xl overflow-hidden">
<!-- Modal Header -->
<div class="px-8 py-6 border-b border-[#E8E0D5] flex justify-between items-center">
<h2 class="font-headline-md text-headline-md text-[#2D2A26]">{{  editingRequest ? 'Edit Leave Request' : 'Submit Request' }}</h2>
<button @click="emit('close')" class="p-2 hover:bg-[#F5F0E8] rounded-full transition-colors text-stone-500">
<span class="material-symbols-outlined">close</span>
</button>
</div>
<!-- Modal Content (Form) -->
<div class="p-8 space-y-6">
<!-- Row 1: Employee Dropdown -->
<div class="space-y-2">
<label class="font-label-clean text-label-clean text-stone-600">Employee</label>
<div class="relative">
<select v-model="form.employee_id"  class="w-full appearance-none bg-white border border-[#E8E0D5] rounded-xl px-4 py-3 pr-10 font-body-md text-on-surface focus:ring-2 focus:ring-[#F5D142] focus:border-transparent outline-none transition-all">
<option v-for="employee in employees" :key="employee.id" :value="employee.id" >{{ employee.first_name }} {{ employee.last_name }}</option>


</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 pointer-events-none">expand_more</span>
</div>
</div>
<!-- Row 2: Leave Type Dropdown -->
<div class="space-y-2">
<label class="font-label-clean text-label-clean text-stone-600">Leave Type</label>
<div class="relative">
<select v-model="form.leave_type_id" class="w-full appearance-none bg-white border border-[#E8E0D5] rounded-xl px-4 py-3 pr-10 font-body-md text-on-surface focus:ring-2 focus:ring-[#F5D142] focus:border-transparent outline-none transition-all">
<option v-for="leaveType in leaveTypes" :key="leaveType.id" :value="leaveType.id">{{ leaveType.name }}</option>

</select>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 pointer-events-none">expand_more</span>
</div>
</div>
<!-- Row 3: Date Grid -->
<div class="grid grid-cols-2 gap-6">
<div class="space-y-2">
<label class="font-label-clean text-label-clean text-stone-600">Start Date</label>
<div class="relative">
<input v-model="form.start_date" class="w-full bg-white border border-[#E8E0D5] rounded-xl px-4 py-3 font-body-md text-on-surface focus:ring-2 focus:ring-[#F5D142] focus:border-transparent outline-none transition-all" type="date"/>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 pointer-events-none">calendar_today</span>
</div>
</div>
<div class="space-y-2">
<label class="font-label-clean text-label-clean text-stone-600">End Date</label>
<div class="relative">
<input v-model="form.end_date" class="w-full bg-white border border-[#E8E0D5] rounded-xl px-4 py-3 font-body-md text-on-surface focus:ring-2 focus:ring-[#F5D142] focus:border-transparent outline-none transition-all" type="date"/>
<span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 pointer-events-none">calendar_today</span>
</div>
</div>
</div>
<!-- Row 4: Reason Textarea -->
<div class="space-y-2">
<label class="font-label-clean text-label-clean text-stone-600">Reason</label>
<textarea v-model="form.reason" class="w-full bg-white border border-[#E8E0D5] rounded-xl px-4 py-3 font-body-md text-on-surface focus:ring-2 focus:ring-[#F5D142] focus:border-transparent outline-none transition-all resize-none" placeholder="Briefly describe the purpose of your request..." rows="3"></textarea>
</div>
</div>
<!-- Modal Footer -->
<div class="px-8 py-6 bg-[#FAF8F5] flex justify-end items-center gap-4">
<button @click="emit('close')" class="px-6 py-2.5 text-[#2D2A26] font-semibold font-label-clean hover:underline transition-all active:scale-95">
                    Cancel
                </button>
<button @click="emit('submit',form)" class="bg-[#F5D142] text-[#2D2A26] font-bold px-8 py-3 rounded-xl shadow-sm hover:shadow-md transition-all active:scale-95 flex items-center gap-2">
                   {{ editingRequest ? 'Update Request' : 'Submit Request' }}
                </button>
</div>
</div>
</div>

</template>