<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import type { BreadcrumbItemType } from '@/types';
import NavBar from '@/components/NavBar.vue';
import Footer from '@/components/Footer.vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell variant="sidebar">
        <AppContent variant="sidebar">
            <NavBar />
            <slot />
            <Footer />
        </AppContent>
    </AppShell>
</template>
