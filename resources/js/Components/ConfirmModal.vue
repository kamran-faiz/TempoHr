<script setup>
defineProps({
    show: Boolean,
    title: {
        type: String,
        default: 'Are you sure?'
    },
    message: {
        type: String,
        default: 'This action cannot be undone.'
    },
    confirmText: {
        type: String,
        default: 'Confirm'
    }
});

defineEmits(['close', 'confirm']);
</script>

<template>
    <div v-if="show" class="fixed inset-0 bg-stone-900/40 backdrop-blur-sm flex items-center justify-center p-6 z-[100]">
        <div class="bg-white max-w-md w-full rounded-xl border border-[#E8E0D5] shadow-2xl overflow-hidden flex flex-col items-center text-center p-8">
            
            <div class="w-16 h-16 bg-[#ffdad6] text-[#ba1a1a] rounded-full flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'wght' 300;">warning</span>
            </div>

            <h2 class="font-headline-md text-2xl font-semibold text-[#1d1c17] mb-4">{{ title }}</h2>

            <p class="font-body-md text-[#625e59] mb-10 px-4">
                {{ message }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 w-full">
                <button 
                    @click="$emit('close')"
                    class="flex-1 py-3.5 px-6 rounded-lg border border-[#2D2A26] text-[#2D2A26] font-semibold text-xs tracking-widest hover:bg-stone-50 transition-colors order-2 sm:order-1"
                >
                    CANCEL
                </button>
                <button 
                    @click="$emit('confirm')"
                    class="flex-1 py-3.5 px-6 rounded-lg bg-[#ba1a1a] text-white font-semibold text-xs tracking-widest hover:bg-red-700 transition-colors shadow-sm order-1 sm:order-2"
                >
                    {{ confirmText }}
                </button>
            </div>
        </div>
    </div>
</template>