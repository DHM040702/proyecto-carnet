<script setup lang="ts">
import AppLayout from '@/layouts/app/AppSidebarLayout.vue';
import type { BreadcrumbItem } from '@/types';
import AppLayoutWithToast from './AppLayoutWithToast.vue';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayoutWithToast>
    <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout>
    </AppLayoutWithToast>
</template>
