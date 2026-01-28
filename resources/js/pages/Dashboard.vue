<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { 
    FileText, 
    CheckCircle, 
    Settings, 
    TrendingUp, 
    BarChart3, 
    User 
} from 'lucide-vue-next';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Inicio',
        href: dashboard().url,
    },
];

const modules = [
    {
        title: 'Solicitud',
        description: 'Gestión de solicitudes de carnés',
        icon: FileText,
        color: 'bg-red-900',
        href: '/solicitud'
    },
    {
        title: 'Validación',
        description: 'Validación de documentos y datos',
        icon: CheckCircle,
        color: 'bg-green-900',
        href: '/validacion'
    },
    {
        title: 'Gestión',
        description: 'Administración del sistema',
        icon: Settings,
        color: 'bg-purple-900',
        href: '/gestion'
    },
    {
        title: 'Seguimiento',
        description: 'Seguimiento de solicitudes',
        icon: TrendingUp,
        color: 'bg-orange-900',
        href: '/seguimiento'
    },
    {
        title: 'Reportes',
        description: 'Generación de reportes',
        icon: BarChart3,
        color: 'bg-blue-900',
        href: '/reportes'
    },
    {
        title: 'Usuario',
        description: 'Gestión de usuarios',
        icon: User,
        color: 'bg-indigo-900',
        href: '/usuario'
    }
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-6">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Módulos del Sistema para </h2>
                <p class="text-muted-foreground">Selecciona un módulo para comenzar</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <a
                    v-for="module in modules"
                    :key="module.title"
                    :href="module.href"
                    class="group relative overflow-hidden rounded-lg border bg-card p-6 shadow-sm transition-all hover:shadow-md hover:border-primary"
                >
                    <div class="flex items-start gap-4">
                        <div :class="[module.color, 'rounded-lg p-3 text-white transition-transform group-hover:scale-110']">
                            <component :is="module.icon" class="h-6 w-6" />
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg mb-1">{{ module.title }}</h3>
                            <p class="text-sm text-muted-foreground">{{ module.description }}</p>
                        </div>
                    </div>
                    <div class="absolute bottom-0 right-0 h-24 w-24 translate-x-8 translate-y-8 rounded-full opacity-10 transition-transform group-hover:scale-150" :class="module.color"></div>
                </a>
            </div>
        </div>
    </AppLayout>
</template>
