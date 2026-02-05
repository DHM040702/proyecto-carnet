<script setup lang="ts">
import { ref , computed } from 'vue'
import { Head , usePage } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import FotoTab from './tabs/FotoTab.vue'

const page = usePage()

interface ValidacionFoto {
    recibido: boolean
    nombre: string
}

const validacion = computed<ValidacionFoto | null>(() => {
    return (page.props.flash?.validacion as ValidacionFoto) ?? null
})

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Validación', href: '/validacion' },
]

const activeTab = ref<'foto' | 'voucher'>('foto')
</script>

<template>
    <Head title="Validación" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-6">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Módulo de Validación</h2>
                <p class="text-muted-foreground">
                    Validación de fotografías y documentos
                </p>
            </div>

            <!-- CARD PRINCIPAL -->
            <div class="rounded-lg border bg-card p-6">
                <!-- TABS -->
                <div class="mb-6 flex gap-2 border-b pb-2">
                    <button
                        class="px-4 py-2 text-sm font-medium rounded"
                        :class="activeTab === 'foto'
                            ? 'bg-primary text-black'
                            : 'text-muted-foreground hover:bg-muted'"
                        @click="activeTab = 'foto'"
                    >
                        Validación de Foto
                    </button>

                    <button
                        :class="activeTab === 'voucher'
                            ? 'bg-primary text-black'
                            : 'text-muted-foreground hover:bg-muted'"
                        @click="activeTab = 'voucher'"
                    >
                        Validación de Voucher
                    </button>

                    <!-- futuras pestañas -->
                    <!--
                    <button>Validación DNI</button>
                    -->
                </div>

                <!-- CONTENIDO -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- PANEL IZQUIERDO -->
                    <div class="rounded border p-4 bg-muted/30">
                        <h3 class="font-semibold mb-2">Estado de validación</h3>

                        <div v-if="validacion">
                        <ul class="space-y-2">
                            <li
                            v-for="regla in validacion.resultados"
                            :key="regla.key"
                            class="flex flex-col"
                            >
                            <span
                                class="flex items-center gap-2 text-sm"
                                :class="regla.ok ? 'text-green-600' : 'text-red-600'"
                            >
                                {{ regla.ok ? '✔️' : '❌' }} {{ regla.label }}
                            </span>

                            <span
                                v-if="!regla.ok"
                                class="ml-6 text-xs text-muted-foreground"
                            >
                                {{ regla.mensaje }}
                            </span>
                            </li>
                        </ul>
                        </div>

                        <!-- <FotoTab v-if="activeTab === 'foto'" /> -->

                        <p v-else class="text-sm text-muted-foreground">
                            Aún no se ha validado ninguna imagen.
                        </p>
                    </div>

                    <!-- PANEL DERECHO -->
                    <div>
                        <FotoTab v-if="activeTab === 'foto'" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
