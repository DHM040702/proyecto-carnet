<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Seguimiento',
        href: '/seguimiento',
    },
];
</script>

<template>
    <Head title="Seguimiento" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-6">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Seguimiento</h2>
                <p class="text-muted-foreground">Seguimiento de solicitudes</p>
            </div>

            <div class="rounded-lg border bg-card p-6">
                <p class="text-center text-muted-foreground">
                    Contenido del módulo de Seguimiento próximamente...
                </p>
            </div>
        </div>
    </AppLayout>
</template>
