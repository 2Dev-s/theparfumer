<template>
    <AppLayout>
        <Head title="Cos" />

        <div class="min-h-screen pb-20">
            <div class="h-screen-90 relative flex items-center justify-center overflow-hidden">
                <div class="relative z-10 px-4 text-center" data-aos="fade-in" data-aos-delay="300">
                    <h1 class="font-cinzel mb-6 text-5xl text-amber-200 md:text-7xl">
                        <span class="mb-4 block text-xl text-amber-500/80">Coșul Tău Exclusiv</span>
                        COLECȚIA TA DE LUX
                    </h1>
                    <div class="mx-auto my-8 w-24 border-t border-amber-500/30"></div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="mx-auto mt-8 max-w-7xl px-4 sm:px-6 md:mt-12 lg:px-8">
                <!-- Cart Container -->
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <!-- Product List -->
                    <div class="lg:col-span-2">
                        <!-- Luxury Card -->
                        <div class="rounded-xl border border-amber-900/20 bg-[hsl(0_0%_3.9%)] p-6 shadow-xl backdrop-blur-sm md:p-8">
                            <h2 class="font-cinzel mb-6 flex items-center text-2xl text-amber-200 md:text-3xl">
                                <svg class="mr-3 h-8 w-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"
                                    />
                                </svg>
                                Produsele Tale
                            </h2>

                            <!-- Empty State -->
                            <div v-if="!products || products.length === 0" class="py-12 text-center">
                                <svg class="mx-auto mb-4 h-16 w-16 text-amber-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7h-4a4 4 0 00-8 0H4" />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1"
                                        d="M5.5 7l1.6 11.4a2 2 0 002 1.6h5.8a2 2 0 002-1.6L18.5 7"
                                    />
                                </svg>
                                <h3 class="font-cinzel mb-2 text-xl text-amber-300">Coșul tău este gol</h3>
                                <p class="mb-6 text-amber-400/70">Începe să adaugi produse de lux pentru a-ți completa colecția</p>
                                <Link
                                    :href="route('perfumes')"
                                    class="font-cinzel inline-flex cursor-pointer items-center rounded-full border border-amber-500/50 px-6 py-3 text-amber-200 transition-all hover:bg-amber-500/10"
                                >
                                    Descoperă Colecția
                                    <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </Link>
                            </div>

                            <!-- Product List -->
                            <div v-else class="divide-y divide-amber-900/20">
                                <div v-for="(product, index) in products" :key="index" class="py-6 first:pt-0 last:pb-0">
                                    <div class="flex flex-col gap-6 md:flex-row">
                                        <!-- Product Image -->
                                        <div class="h-32 w-full flex-shrink-0 overflow-hidden rounded-lg border border-amber-900/20 md:w-32">
                                            <img
                                                :src="product.image || 'https://img.freepik.com/premium-psd/perfume-bottle-mockup_439185-2579.jpg'"
                                                class="h-full w-full object-cover"
                                                :alt="product.name"
                                            />
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h3 class="font-cinzel text-lg text-amber-200">{{ product.name }}</h3>
                                                    <p class="mt-1 text-sm text-amber-500/80">{{ product.concentration }} • {{ product.size }} ml</p>
                                                </div>
                                                <p class="font-cinzel text-amber-300">{{ formatPrice(product.price) }}</p>
                                            </div>

                                            <div class="mt-4 flex items-center justify-between">
                                                <!-- Quantity Selector -->
                                                <div class="flex items-center overflow-hidden rounded-full border border-amber-900/30">
                                                    <button
                                                        @click="updateQuantity(product.id, product.quantity - 1)"
                                                        class="px-3 py-1 text-amber-400 transition-colors hover:bg-amber-900/20"
                                                        :disabled="product.quantity <= 1"
                                                    >
                                                        -
                                                    </button>
                                                    <span class="px-4 text-amber-200">{{ product.quantity }}</span>
                                                    <button
                                                        @click="updateQuantity(product.id, product.quantity + 1)"
                                                        class="px-3 py-1 text-amber-400 transition-colors hover:bg-amber-900/20"
                                                    >
                                                        +
                                                    </button>
                                                </div>

                                                <!-- Remove Button -->
                                                <button
                                                    @click="removeItem(product.id)"
                                                    class="flex items-center text-amber-500/70 transition-colors hover:text-amber-300"
                                                >
                                                    <svg class="mr-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                        />
                                                    </svg>
                                                    <span class="text-sm">Elimină</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="backdrop-blur-sm border border-amber-900/20 rounded-xl p-8 md:p-10">
                            <div class="mb-10 text-center">
                                <div class="flex items-center justify-center mb-6">
                                    <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                                    <span class="mx-6 font-cinzel text-amber-400 text-xl tracking-widest px-4">
                            ADRESĂ DE LIVRARE
                        </span>
                                    <div class="flex-grow h-px bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Denumire Companie (Optional)</Label>
                                        <input
                                            class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                            v-model="companyForm.company_name"
                                            placeholder="Numele companiei"
                                        />
                                    </div>

                                    <div>
                                        <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">CUI/CIF (Optional)</Label>
                                        <input
                                            class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                            v-model="companyForm.tax_id"
                                            placeholder="Cod de identificare"
                                        />
                                    </div>

                                    <div class="md:col-span-2">
                                        <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Stradă</Label>
                                        <input
                                            class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                            v-model="companyForm.street"
                                            placeholder="Introdu adresa companiei"
                                        />
                                    </div>

                                    <div>
                                        <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Oraș</Label>
                                        <input
                                            class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                            v-model="companyForm.city"
                                            placeholder="Orașul companiei"
                                        />
                                    </div>

                                    <div>
                                        <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Județ</Label>
                                        <input
                                            class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                            v-model="companyForm.state"
                                            placeholder="Județul companiei"
                                        />
                                    </div>

                                    <div>
                                        <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Cod Poștal</Label>
                                        <input
                                            class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                            v-model="companyForm.postal_code"
                                            placeholder="Cod poștal"
                                        />
                                    </div>

                                    <div>
                                        <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Țară</Label>
                                        <input
                                            class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                            v-model="companyForm.country"
                                            placeholder="Țara companiei"
                                        />
                                    </div>

                                    <div class="md:col-span-2">
                                        <Label class="font-cinzel text-amber-300/80 tracking-wider mb-2 block">Telefon</Label>
                                        <input
                                            class="w-full py-4 border-yellow-500 border px-4 focus:border-yellow-700 outline-0 font-cinzel"
                                            v-model="companyForm.phone"
                                            placeholder="Număr de telefon"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div>
                        <!-- Luxury Summary Card -->
                        <div class="sticky top-6 rounded-xl border border-amber-900/20 bg-[hsl(0_0%_3.9%)] p-6 shadow-xl backdrop-blur-sm md:p-8">
                            <!-- ... existing header ... -->

                            <!-- Payment Method Selector -->
                            <div class="mb-6">
                                <h3 class="font-cinzel mb-4 text-lg text-amber-200">Metodă de Plată</h3>
                                <div class="space-y-4">
                                    <!-- Card Payment -->
                                    <label
                                        class="flex items-center gap-4 p-3 rounded-lg border border-amber-900/20 hover:bg-amber-900/10 cursor-pointer transition-colors"
                                        :class="{ 'bg-amber-900/20 border-amber-500/50': paymentMethod === 'card' }"
                                    >
                                        <div class="relative flex items-center justify-center">
                                            <input
                                                type="radio"
                                                value="card"
                                                v-model="paymentMethod"
                                                class="sr-only peer"
                                            />
                                            <div
                                                class="peer border-yellow-500 peer-data-[state=checked]:bg-yellow-500 peer-data-[state=checked]:text-black peer-data-[state=checked]:border-yellow-600 peer-focus-visible:border-yellow-700 peer-focus-visible:ring-yellow-600/50 size-6 shrink-0 border shadow-xs transition-shadow outline-none peer-focus-visible:ring-[3px] peer-disabled:cursor-not-allowed peer-disabled:opacity-50 flex items-center justify-center rounded-full"
                                                :class="{
                                    'bg-yellow-500 border-yellow-600': paymentMethod === 'card',
                                    'border-yellow-500': paymentMethod !== 'card'
                                }"
                                            >
                                                <div
                                                    v-if="paymentMethod === 'card'"
                                                    class="flex items-center justify-center text-black transition-none"
                                                >
                                                    <div class="w-3 h-3 rounded-full bg-black"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center">
                                            <svg class="mr-3 h-6 w-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                            </svg>
                                            <span class="font-cinzel text-amber-300">Card bancar</span>
                                        </div>
                                    </label>

                                    <!-- Cash on Delivery -->
                                    <label
                                        class="flex items-center gap-4 p-3 rounded-lg border border-amber-900/20 hover:bg-amber-900/10 cursor-pointer transition-colors"
                                        :class="{ 'bg-amber-900/20 border-amber-500/50': paymentMethod === 'ramburs' }"
                                    >
                                        <div class="relative flex items-center justify-center">
                                            <input
                                                type="radio"
                                                value="ramburs"
                                                v-model="paymentMethod"
                                                class="sr-only peer"
                                            />
                                            <div
                                                class="peer border-yellow-500 peer-data-[state=checked]:bg-yellow-500 peer-data-[state=checked]:text-black peer-data-[state=checked]:border-yellow-600 peer-focus-visible:border-yellow-700 peer-focus-visible:ring-yellow-600/50 size-6 shrink-0 border shadow-xs transition-shadow outline-none peer-focus-visible:ring-[3px] peer-disabled:cursor-not-allowed peer-disabled:opacity-50 flex items-center justify-center rounded-full"
                                                :class="{
                                    'bg-yellow-500 border-yellow-600': paymentMethod === 'ramburs',
                                    'border-yellow-500': paymentMethod !== 'ramburs'
                                }"
                                            >
                                                <div
                                                    v-if="paymentMethod === 'ramburs'"
                                                    class="flex items-center justify-center text-black transition-none"
                                                >
                                                    <div class="w-3 h-3 rounded-full bg-black"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center">
                                            <svg class="mr-3 h-6 w-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <span class="font-cinzel text-amber-300">Ramburs la livrare</span>
                                        </div>
                                    </label>
                                </div>

                                <!-- Payment Method Info -->
                                <div v-if="paymentMethod === 'card'" class="mt-4 rounded-lg border border-amber-900/20 bg-amber-900/10 p-3">
                                    <div class="flex items-start">
                                        <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                                            />
                                        </svg>
                                        <p class="ml-2 text-xs text-amber-500/80">Plata securizată și criptată. Datele tale sunt protejate.</p>
                                    </div>
                                </div>

                                <div v-if="paymentMethod === 'ramburs'" class="mt-4 rounded-lg border border-amber-900/20 bg-amber-900/10 p-3">
                                    <div class="flex items-start">
                                        <svg class="mt-0.5 h-5 w-5 flex-shrink-0 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
                                            />
                                        </svg>
                                        <p class="ml-2 text-xs text-amber-500/80">Plătești la primirea coletului. Taxă de ramburs: 10 RON.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <!-- ... existing order details ... -->
                            </div>

                            <!-- Updated Checkout Button -->
                            <button
                                @click="proceedToCheckout"
                                class="font-cinzel group relative mt-8 w-full cursor-pointer overflow-hidden rounded-full border border-amber-500/50 bg-gradient-to-r from-amber-500/10 to-amber-600/10 px-6 py-4 tracking-wider text-amber-200 transition-all hover:bg-amber-500/20 hover:text-amber-100"
                            >
                                <div class="relative z-10">
                                    {{ paymentMethod === 'card' ? 'FINALIZEAZĂ CU CARDUL' : 'FINALIZEAZĂ CU RAMBURS' }}
                                </div>
                                <span
                                    class="absolute inset-0 bg-gradient-to-r from-amber-500/20 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                                ></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import eventBus from '@/lib/event-bus';
import axios from 'axios';
import FillAddress from '@/pages/Checkout/FillAddress.vue';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';

export default {
    components: { Button, Input, Label, FillAddress, Head, Link, AppLayout },
    props: {
        products: Array,
        companyAddress: Object,
    },
    data() {
        return {
            companyForm: {
                company_name: this.companyAddress?.company_name || '',
                tax_id: this.companyAddress?.tax_id || '',
                street: this.companyAddress?.street || '',
                city: this.companyAddress?.city || '',
                state: this.companyAddress?.state || '',
                postal_code: this.companyAddress?.postal_code || '',
                country: this.companyAddress?.country || '',
                phone: this.companyAddress?.phone || ''
            },
            paymentMethod: 'card',
        };
    },
    computed: {
        subtotal() {
            return this.products.reduce((sum: number, product: any) => sum + product.price * product.quantity, 0);
        },
        shipping() {
            // Add cash on delivery fee
            const baseShipping = this.subtotal > 250 ? 0 : 50;
            return this.paymentMethod === 'ramburs' ? baseShipping + 10 : baseShipping;
        },
        total() {
            return this.subtotal + this.shipping;
        },
    },
    methods: {
        formatPrice(price: number) {
            return new Intl.NumberFormat('ro-RO', {
                style: 'currency',
                currency: 'RON',
                minimumFractionDigits: 2,
            }).format(price);
        },
        updateQuantity(productId, quantity) {
            if (quantity < 1) return;

            eventBus.emit('cart-updated', { id: productId, quantity });
            setTimeout(() => {
                window.location.reload();
            }, 100);
        },
        removeItem(productId) {
            eventBus.emit('remove-item', productId);
            setTimeout(() => {
                window.location.reload();
            }, 100);
        },
        async proceedToCheckout() {
            // Required address fields
            const requiredFields = [
                'street',
                'city',
                'state',
                'postal_code',
                'country',
                'phone'
            ];

            // Check if any required field is empty
            const isAddressIncomplete = requiredFields.some(field => {
                return !this.companyForm[field] || this.companyForm[field].trim() === '';
            });

            if (isAddressIncomplete) {
                // Show error message (you can use a toast/notification library)
                alert('Te rugăm să completezi toate câmpurile obligatorii din adresă înainte de a continua.');
                return;
            }

            try {
                if (this.paymentMethod === 'card') {
                    // Existing Stripe flow
                    const response = await axios.post(route('checkout.create'), {
                        products: this.products.map((p) => ({
                            product_id: p.id,
                            price_id: p.price_id,
                            quantity: p.quantity,
                        })),
                        address: this.companyForm,
                        payment_method: 'card'
                    });

                    if (response.data.url) {
                        localStorage.setItem('checkout_address', JSON.stringify(this.companyForm));
                        window.location.href = response.data.url;
                    }
                } else {
                    // Cash on delivery flow
                    const response = await axios.post(route('checkout.cod'), {
                        products: this.products.map((p) => ({
                            product_id: p.id,
                            quantity: p.quantity,
                            price_id: p.price_id,
                            price: p.price
                        })),
                        address: this.companyForm,
                        total: this.total,
                        name: this.companyForm.name,          // ✅ pentru guest checkout
                        email: this.companyForm.email,        // ✅ pentru guest checkout
                        currency: 'RON'                       // sau orice alegi
                    });

                    if (response.data.success) {
                        // Redirect to success page
                        router.visit(route('checkout.cod-success', {
                            order: response.data.order
                        }));
                    }
                }
            } catch (error) {
                console.error('Checkout error:', error);
                alert('A apărut o eroare la procesarea comenzii. Te rugăm să încerci din nou.');
            }
        },
    },
};
</script>

<style scoped>
/* Custom animations */
@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

@keyframes spin-reverse {
    to {
        transform: rotate(-360deg);
    }
}

.animate-spin {
    animation: spin 2s linear infinite;
}

.animate-spin-reverse {
    animation: spin-reverse 3s linear infinite;
}

.h-screen-90 {
    height: 30vh;
}
</style>
