<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <Head title="Payment Canceled" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Payment Canceled
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-center">
                        <div class="text-yellow-600 text-5xl mb-4">⚠️</div>
                        <h1 class="text-2xl font-bold mb-4">Payment Not Completed</h1>

                        <div class="space-y-4 mb-6">
                            <p class="text-lg text-gray-600">
                                Your payment was not completed. You can safely try again or return to the dashboard.
                            </p>

                            <div class="flex justify-center gap-4">
                                <a
                                    :href="route('checkout')"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-500 active:bg-indigo-700 focus:outline-none transition ease-in-out duration-150"
                                >
                                    Try Again
                                </a>

                                <a
                                    :href="route('dashboard')"
                                    class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-500 active:bg-gray-700 focus:outline-none transition ease-in-out duration-150"
                                >
                                    Return to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
