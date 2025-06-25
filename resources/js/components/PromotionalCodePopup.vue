<template>
    <transition name="fade">
        <div v-if="showPopup" class="fixed inset-0 z-50 flex items-center justify-center bg-black/30 backdrop-blur-sm">
            <div
                class="relative w-full max-w-lg border border-amber-400 bg-gray-950 px-8 py-10 shadow-[0_0_60px_rgba(212,175,55,0.25)]"
            >
                <div class="absolute -inset-1 rounded-3xl border-2 border-amber-400 opacity-20 blur-md"></div>

                <div class="relative z-10 text-center text-amber-100">
                    <h2 class="font-cinzel mb-4 text-3xl font-bold tracking-wider text-amber-400">COD EXCLUSIV</h2>
                    <p class="mb-2 text-lg font-light text-amber-200">
                        Un cadou de lux din partea noastră, pentru a-ți face experiența și mai rafinată
                    </p>

                    <p class="my-6 text-2xl font-semibold">
                        Folosește codul pentru {{promotionalCode.discount}}% reducere
                        <span class="ml-2 mt-4 inline-block bg-amber-400 px-4 py-1 font-bold tracking-widest text-gray-900 shadow">
                            {{ promotionalCode.code }}
                        </span>
                    </p>

                    <p class="text-sm text-amber-300 italic">Valabil doar pentru o perioadă limitată. Răsfață-te cum meriți.</p>

                    <button
                        class="font-cinzel mt-8 flex w-full items-center justify-center gap-2 bg-amber-500 px-6 py-3 font-bold tracking-wider text-black uppercase transition-colors duration-300 hover:cursor-pointer hover:bg-amber-600"
                        @click="closePopup"
                    >
                        <span>MULTUMESC</span>
                    </button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    props: {
        promotionalCode: {
            type: String,
            default: null,
        },
    },
    data() {
        return {
            showPopup: false,
        };
    },
    watch: {
        promotionalCode: {
            immediate: true,
            handler(newVal) {
                this.showPopup = !!newVal;
            },
        },
    },
    methods: {
        closePopup() {
            this.showPopup = false;
        },
    },
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.4s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
