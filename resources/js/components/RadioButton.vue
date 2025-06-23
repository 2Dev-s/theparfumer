<script setup lang="ts">
import { computed, type HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils'

const props = defineProps<{
    modelValue: string
    value: string
    name: string
    id?: string
    class?: HTMLAttributes['class']
    tabindex?: number
}>()

const emits = defineEmits<{
    (e: 'update:modelValue', value: string): void
}>()

const isChecked = computed(() => props.modelValue === props.value)

function onChange() {
    emits('update:modelValue', props.value)
}
</script>

<template>
    <div
        class="peer size-6 shrink-0 border shadow-xs rounded-full transition-shadow outline-none focus-visible:ring-[3px] focus-visible:ring-yellow-600/50 disabled:cursor-not-allowed disabled:opacity-50"
        :class="cn(
      isChecked
        ? 'bg-yellow-500 text-black border-yellow-600'
        : 'border-yellow-500',
      props.class
    )"
    >
        <input
            type="radio"
            :id="id"
            :name="name"
            :value="value"
            :checked="isChecked"
            :tabindex="tabindex"
            class="opacity-0 absolute w-full h-full cursor-pointer"
            @change="onChange"
        />
        <div
            class="w-full h-full flex items-center justify-center pointer-events-none"
        >
            <div
                v-if="isChecked"
                class="w-3 h-3 bg-black rounded-full"
            />
        </div>
    </div>
</template>
