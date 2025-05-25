<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    customerName: String,
    amount: String,
    currency: String
});
</script>

<template>
    <Head title="Payment Successful" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Payment Successful
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-center">
                        <div class="text-green-600 text-5xl mb-4">🎉</div>
                        <h1 class="text-2xl font-bold mb-4">Thank you for your purchase!</h1>

                        <div class="space-y-2 mb-6">
                            <p class="text-lg">
                                <span class="font-semibold">{{ customerName }}</span>, your payment of
                                <span class="font-semibold">{{ currency }} {{ amount }}</span>
                                was successfully processed.
                            </p>
                        </div>

                        <a
                            :href="route('dashboard')"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-500 active:bg-indigo-700 focus:outline-none transition ease-in-out duration-150"
                        >
                            Return to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
