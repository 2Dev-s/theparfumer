<script setup lang="ts">
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import DeleteUser from '@/components/DeleteUser.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { type BreadcrumbItem, type SharedData, type User } from '@/types';

interface Props {
    mustVerifyEmail: boolean;
    status?: string;
}

defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Setări profil',
        href: '/settings/profile',
    },
];

const page = usePage<SharedData>();
const user = page.props.auth.user as User;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        preserveScroll: true,
    });
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <Head title="Cont" />

        <SettingsLayout>
            <!-- Luxury Profile Header -->
            <div class="relative overflow-hidden bg-black/90 mb-12 rounded-xl">
                <div class="absolute inset-0 z-0 opacity-20">
                    <div  class="absolute inset-0 bg-[url('https://img.freepik.com/free-vector/luxury-perfume-logo-concept_23-2148476347.jpg?t=st=1746744206~exp=1746747806~hmac=175ad50e90ab9156f6611331310099cfefc2c967e0bf917ba37c6f33771a0b0d&w=740')] bg-cover bg-center"></div>
                </div>

                <div class="relative z-10 p-8 md:p-12" data-aos="fade-up">
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                        <div class="relative">
                            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full border-2 border-amber-500/30 overflow-hidden bg-black/50 flex items-center justify-center">
                                <span class="text-3xl font-cinzel text-amber-400">{{ user.name.charAt(0).toUpperCase() }}</span>
                            </div>
                        </div>

                        <div>
                            <h1 class="font-cinzel text-3xl md:text-4xl text-amber-200">{{ user.name }}</h1>
                            <p class="text-amber-500/80 tracking-widest text-sm mt-1">EXCLUSIVE MEMBER</p>
                            <div class="flex items-center mt-3 space-x-4">
                                <span class="text-amber-300/80 text-sm flex items-center">
                                    {{ user.email }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Form Section -->
            <div class="backdrop-blur-sm border border-amber-900/20 rounded-xl p-8 md:p-10" data-aos="fade-down">
                <div class="mb-12 text-center">
                    <div class="flex items-center justify-center mb-6">
                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                        <span class="mx-6 font-cinzel text-amber-400 text-xl tracking-widest px-4">
                            INFORMAȚII PROFIL
                        </span>
                        <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                    </div>
                    <p class="text-amber-200/70 max-w-2xl mx-auto">
                        Actualizează-ți detaliile personale și gestionează-ți contul exclusiv
                    </p>
                </div>

                <form @submit.prevent="submit" class="space-y-8">
                    <div class="grid gap-6">
                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block" for="name">Full Name</Label>
                            <input
                                id="name"
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="form.name"
                                required
                                autocomplete="name"
                                placeholder="Introdu numele complet"
                            />
                            <InputError class="mt-2 text-amber-500" :message="form.errors.name" />
                        </div>

                        <div>
                            <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block" for="email">Adresă de email</Label>
                            <input
                                id="email"
                                type="email"
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                v-model="form.email"
                                required
                                autocomplete="username"
                                placeholder="Emailul tău exclusiv"
                            />
                            <InputError class="mt-2 text-amber-500" :message="form.errors.email" />
                        </div>
                    </div>

                    <div v-if="mustVerifyEmail && !user.email_verified_at" class="p-4 bg-amber-900/10 border border-amber-800/30 rounded-lg">
                        <p class="text-sm text-amber-300/80">
                            Adresa ta de email nu este verificată.
                            <Link
                                :href="route('verification.send')"
                                method="post"
                                as="button"
                                class="ml-1 text-amber-300 underline decoration-amber-500/50 underline-offset-4 hover:decoration-amber-300 transition-colors duration-300"
                            >
                                Apasă aici pentru a retrimite emailul de verificare.
                            </Link>
                        </p>

                        <div v-if="status === 'verification-link-sent'" class="mt-2 text-sm font-medium text-amber-300">
                            Un nou link de verificare a fost trimis către adresa ta de email.
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6">
                        <Transition
                            enter-active-class="transition ease-in-out"
                            enter-from-class="opacity-0"
                            leave-active-class="transition ease-in-out"
                            leave-to-class="opacity-0"
                        >
                            <p v-show="form.recentlySuccessful" class="text-sm text-amber-400/80 flex items-center font-cinzel">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Modificările au fost salvate
                            </p>
                        </Transition>

                        <Button
                            :disabled="form.processing"
                            class="relative overflow-hidden bg-transparent border border-amber-500/50 text-amber-200 hover:text-amber-100 px-8 py-3 rounded-full hover:bg-amber-500/10 transition-all font-cinzel tracking-wider group"
                        >
                            <span class="relative z-10">ACTUALIZEAZĂ PROFILUL</span>
                            <span class="absolute inset-0 bg-gradient-to-r from-amber-500/10 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        </Button>
                    </div>
                </form>
            </div>

            <!-- Delete Account Section -->
            <div class="mt-16 border-t border-amber-900/20 pt-12">
                <DeleteUser />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>

<style>
/* Custom scrollbar for luxury feel */
::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::-webkit-scrollbar-track {
    background: #111827;
}

::-webkit-scrollbar-thumb {
    background: #b45309;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #d97706;
}
</style>
