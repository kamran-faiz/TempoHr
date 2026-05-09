<script setup>
import { ref, watch, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const toasts = ref([]);

const addToast = (message, type = 'success') => {
    const id = Date.now();
    toasts.value.push({ id, message, type });
    setTimeout(() => {
        removeToast(id);
    }, 5000);
};

const removeToast = (id) => {
    toasts.value = toasts.value.filter(t => t.id !== id);
};

watch(() => page.props.flash, (flash) => {
    if (flash.success) {
        addToast(flash.success, 'success');
    }
    if (flash.error) {
        addToast(flash.error, 'error');
    }
}, { deep: true });

onMounted(() => {
    if (page.props.flash.success) {
        addToast(page.props.flash.success, 'success');
    }
    if (page.props.flash.error) {
        addToast(page.props.flash.error, 'error');
    }
});
</script>

<template>
    <TransitionGroup 
        tag="div" 
        enter-active-class="transition duration-300 ease-out"
        enter-from-class="transform translate-y-2 opacity-0"
        enter-to-class="transform translate-y-0 opacity-100"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
        class="fixed bottom-5 right-5 z-[100] space-y-3"
    >
        <div v-for="toast in toasts" :key="toast.id" 
             class="flex items-center gap-3 px-6 py-4 rounded-xl shadow-2xl border-l-4 min-w-[300px]"
             :class="toast.type === 'success' ? 'bg-white border-emerald-500' : 'bg-white border-red-500'"
        >
            <div class="shrink-0">
                <span v-if="toast.type === 'success'" class="material-symbols-outlined text-emerald-500">check_circle</span>
                <span v-else class="material-symbols-outlined text-red-500">error</span>
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-stone-800">{{ toast.message }}</p>
            </div>
            <button @click="removeToast(toast.id)" class="text-stone-400 hover:text-stone-600">
                <span class="material-symbols-outlined text-sm">close</span>
            </button>
        </div>
    </TransitionGroup>
</template>
