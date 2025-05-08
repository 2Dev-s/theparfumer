<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

// Componente
import HeadingSmall from '@/components/HeadingSmall.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const passwordInput = ref<HTMLInputElement | null>(null);

const form = useForm({
    password: '',
});

const deleteUser = (e: Event) => {
    e.preventDefault();

    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value?.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    form.clearErrors();
    form.reset();
};
</script>

<template>
    <div class="space-y-8">
        <!-- Secțiune de Avertizare de Lux -->
        <div class="text-center mb-8">
            <h2 class="font-cinzel text-3xl text-amber-200 mb-3">Terminarea Contului</h2>
            <div class="flex items-center justify-center my-6">
                <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                <span class="mx-6 font-cinzel text-amber-500/80 tracking-widest text-sm">MEMBRU EXCLUSIV</span>
                <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
            </div>
            <p class="text-amber-200/80 max-w-2xl mx-auto font-light">
                Gestionează-ți statutul exclusiv al contului
            </p>
        </div>

        <!-- Casetă de Avertizare -->
        <div class="space-y-6 rounded-xl border border-amber-900/20 bg-gradient-to-br from-amber-900/10 to-transparent p-6 backdrop-blur-sm">
            <div class="flex items-start">
                <div class="bg-amber-500/10 p-2 rounded-full mt-0.5">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="font-cinzel text-xl text-amber-200">Avertisment Final</h3>
                    <p class="text-amber-300/80 mt-1 text-sm">
                        Această acțiune va revoca permanent calitatea de membru exclusiv și toate privilegiile asociate.
                    </p>
                </div>
            </div>

            <Dialog>
                <DialogTrigger as-child>
                    <Button
                        class="w-full md:w-auto font-cinzel tracking-wider bg-transparent border border-red-500/50 text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all duration-300"
                    >
                        Termină Calitatea de Membru
                    </Button>
                </DialogTrigger>

                <!-- Dialog de Confirmare -->
                <DialogContent class="bg-gray-950/90 backdrop-blur-lg border border-amber-900/30 rounded-xl max-w-md">
                    <form class="space-y-6" @submit="deleteUser">
                        <DialogHeader class="space-y-4">
                            <div class="text-center">
                                <svg class="w-12 h-12 mx-auto text-red-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <DialogTitle class="font-cinzel text-2xl text-amber-200">
                                    Confirmă Terminarea
                                </DialogTitle>
                            </div>
                            <DialogDescription class="text-amber-300/80 text-center">
                                Acest lucru va șterge permanent contul tău și va anula accesul la conținutul exclusiv.
                                Te rugăm să introduci parola pentru a confirma această acțiune ireversibilă.
                            </DialogDescription>
                        </DialogHeader>

                        <div class="space-y-2">
                            <Label class="font-cinzel text-amber-300/80 tracking-wider" for="password">
                                Parolă de Verificare
                            </Label>
                            <input
                                id="password"
                                type="password"
                                ref="passwordInput"
                                v-model="form.password"
                                class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                placeholder="Introdu parola"
                            />
                            <InputError class="text-amber-500 mt-1" :message="form.errors.password" />
                        </div>

                        <DialogFooter class="gap-3 pt-4">
                            <DialogClose as-child>
                                <Button
                                    variant="outline"
                                    class="font-cinzel tracking-wider bg-transparent border border-amber-500/50 text-amber-300 hover:bg-amber-500/10 hover:text-amber-200 transition-all duration-300"
                                    @click="closeModal"
                                >
                                    Anulează
                                </Button>
                            </DialogClose>

                            <Button
                                class="font-cinzel tracking-wider bg-transparent border border-red-500/50 text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all duration-300"
                                :disabled="form.processing"
                            >
                                Confirmă Terminarea
                            </Button>
                        </DialogFooter>
                    </form>
                </DialogContent>
            </Dialog>
        </div>
    </div>
</template>

<style scoped>
/* Custom focus states */
input:focus {
    outline: none;
    box-shadow: 0 1px 0 0 rgba(217, 119, 6, 0.5);
}

/* Smooth transitions for form elements */
input {
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}
</style>
