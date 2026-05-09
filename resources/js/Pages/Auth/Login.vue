<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Sign In" />

    <div class="min-h-screen flex flex-col font-body-md text-on-surface bg-[#F5F0E8]">
        <main class="flex-grow flex items-center justify-center px-4 py-section-margin">
            <div class="w-full max-w-[480px] bg-white border border-[#E8E0D5] rounded-xl p-container-padding shadow-sm">
                <div class="flex flex-col items-center mb-10">
                    <div class="mb-6 flex items-center justify-center">
                        <div class="w-12 h-12 rounded-lg bg-primary-container flex items-center justify-center">
                            <span class="material-symbols-outlined text-on-primary-container" style="font-variation-settings: 'FILL' 1;">
                                hotel_class
                            </span>
                        </div>
                        <span class="ml-3 font-headline-md text-headline-md text-on-surface tracking-tight">Warm HR</span>
                    </div>
                    <h1 class="font-headline-lg text-headline-lg text-center">Welcome Back</h1>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-2 text-center">Enter your credentials to access your workspace.</p>
                </div>

                <div v-if="status" class="mb-4 text-sm font-medium text-green-600 text-center">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="space-y-2">
                        <label class="font-label-clean text-label-clean text-on-surface-variant ml-1" for="email">Email Address</label>
                        <div class="relative">
                            <input 
                                v-model="form.email"
                                class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface font-body-md focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all duration-200" 
                                id="email" 
                                name="email" 
                                placeholder="name@company.com" 
                                type="email"
                                required
                                autofocus
                            />
                        </div>
                        <p v-if="form.errors.email" class="text-sm text-red-600 mt-1">{{ form.errors.email }}</p>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center px-1">
                            <label class="font-label-clean text-label-clean text-on-surface-variant" for="password">Password</label>
                        </div>
                        <div class="relative">
                            <input 
                                v-model="form.password"
                                class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface font-body-md focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all duration-200" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••" 
                                type="password"
                                required
                            />
                        </div>
                        <p v-if="form.errors.password" class="text-sm text-red-600 mt-1">{{ form.errors.password }}</p>
                    </div>

                    <div class="flex items-center justify-between px-1">
                        <div class="flex items-center">
                            <input 
                                v-model="form.remember"
                                class="h-4 w-4 rounded border-outline-variant text-primary focus:ring-primary-container" 
                                id="remember-me" 
                                name="remember-me" 
                                type="checkbox"
                            />
                            <label class="ml-2 block font-label-clean text-label-clean text-on-surface-variant" for="remember-me">Remember me</label>
                        </div>
                        <Link 
                            v-if="canResetPassword"
                            :href="route('password.request')" 
                            class="font-label-clean text-label-clean text-primary hover:underline transition-all"
                        >
                            Forgot password?
                        </Link>
                    </div>

                    <button 
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        class="w-full py-4 bg-primary-container text-on-primary-container font-headline-md text-body-lg rounded-lg hover:opacity-90 transition-all duration-200 shadow-sm" 
                        type="submit"
                    >
                        Sign In
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-outline-variant flex flex-col items-center gap-4">
                    <p class="font-label-clean text-label-clean text-on-surface-variant">Don't have an account?</p>
                    <Link :href="route('register')" class="w-full py-3 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors text-center font-label-caps text-label-caps text-on-surface">
                        Create Account
                    </Link>
                </div>
            </div>
        </main>

        <footer class="bg-[#F5F0E8] border-t border-[#E8E0D5]">
            <div class="flex flex-col md:flex-row justify-between items-center py-12 px-8 max-w-7xl mx-auto">
                <div class="mb-4 md:mb-0">
                    <span class="font-bold text-[#2D2A26] font-epilogue">Warm Professionalism HR</span>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="flex gap-6">
                        <a class="font-epilogue text-sm tracking-tight text-[#2D2A26]/70 hover:text-primary transition-colors duration-200" href="#">Privacy Policy</a>
                        <a class="font-epilogue text-sm tracking-tight text-[#2D2A26]/70 hover:text-primary transition-colors duration-200" href="#">Terms of Service</a>
                        <a class="font-epilogue text-sm tracking-tight text-[#2D2A26]/70 hover:text-primary transition-colors duration-200" href="#">Contact Support</a>
                    </div>
                    <p class="font-epilogue text-sm tracking-tight text-[#2D2A26] opacity-90">© 2024 Warm Professionalism HR. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</template>
