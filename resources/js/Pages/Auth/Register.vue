<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Create Account" />

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
                    <h1 class="font-headline-lg text-headline-lg text-center">Create Account</h1>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-2 text-center">Join our workspace and start managing your team.</p>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div class="space-y-2">
                        <label class="font-label-clean text-label-clean text-on-surface-variant ml-1" for="name">Full Name</label>
                        <div class="relative">
                            <input 
                                v-model="form.name"
                                class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface font-body-md focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all duration-200" 
                                id="name" 
                                name="name" 
                                placeholder="John Doe" 
                                type="text"
                                required
                                autofocus
                            />
                        </div>
                        <p v-if="form.errors.name" class="text-sm text-red-600 mt-1">{{ form.errors.name }}</p>
                    </div>

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
                            />
                        </div>
                        <p v-if="form.errors.email" class="text-sm text-red-600 mt-1">{{ form.errors.email }}</p>
                    </div>

                    <div class="space-y-2">
                        <label class="font-label-clean text-label-clean text-on-surface-variant ml-1" for="password">Password</label>
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

                    <div class="space-y-2">
                        <label class="font-label-clean text-label-clean text-on-surface-variant ml-1" for="password_confirmation">Confirm Password</label>
                        <div class="relative">
                            <input 
                                v-model="form.password_confirmation"
                                class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface font-body-md focus:outline-none focus:border-primary-container focus:ring-2 focus:ring-primary-container/20 transition-all duration-200" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                placeholder="••••••••" 
                                type="password"
                                required
                            />
                        </div>
                        <p v-if="form.errors.password_confirmation" class="text-sm text-red-600 mt-1">{{ form.errors.password_confirmation }}</p>
                    </div>

                    <button 
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        class="w-full py-4 bg-primary-container text-on-primary-container font-headline-md text-body-lg rounded-lg hover:opacity-90 transition-all duration-200 shadow-sm" 
                        type="submit"
                    >
                        Register
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-outline-variant flex flex-col items-center gap-4">
                    <p class="font-label-clean text-label-clean text-on-surface-variant">Already have an account?</p>
                    <Link :href="route('login')" class="w-full py-3 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors text-center font-label-caps text-label-caps text-on-surface">
                        Sign In
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
