<script setup lang="ts">
import { ref, watch } from 'vue'
import SemestreFormDialog from './SemestreFormDialog.vue'
import DeleteSemestreDialog from './DeleteSemestreDialog.vue'
import { Head, router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import { BreadcrumbItem } from '@/types';
import { PaginationEllipsis, PaginationFirst, PaginationLast, PaginationList, PaginationListItem, PaginationNext, PaginationPrev, PaginationRoot, } from 'reka-ui'

import { Edit, Icon, Trash2 } from 'lucide-vue-next'
import Button from '@/components/ui/button/Button.vue'
import semestre from '@/routes/semestre';
import Input from '@/components/ui/input/Input.vue'
import Pagination from '@/components/ui/Pagination/Pagination.vue'
import Card from '@/components/ui/card/Card.vue'
const wait = () => new Promise(resolve => setTimeout(resolve, 1000))
const open = ref(false)
const props = defineProps<{
    semestres: any
    filters: {
        search?: string
    }
}>()
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Reportes',
        href: '/reportes',
    },
];
const showForm = ref(false)
const editing = ref(null)
const deletingId = ref<number | null>(null)
const search = ref(props.filters.search ?? '')

let timeout: ReturnType<typeof setTimeout>

watch(search, (value) => {
    clearTimeout(timeout)

    timeout = setTimeout(() => {
        router.get(
            semestre.index().url,
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        )
    }, 400)
})
</script>

<template>

    <Head title="Reportes" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-6">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Gestión de semestres</h2>
                <p class="text-muted-foreground">Semestres académicos registrados</p>
            </div>
            <div class="flex justify-end">
                <Button variant="success" class="mt-4" @click="showForm = true">
                    Nuevo semestre
                </Button>
            </div>
            <div class=" items-center gap-2 mb-2">
                <Input v-model="search" type="text" placeholder="Buscar semestre…" class="input" />
            </div>
            <div>
            </div>
            <!-- tabla -->
            <Card>
                <div class="rounded-lg   p-6">
                    <div class=" p-2 my-1">
                        <span class="text-sm font-medium my-6">Se encontraron: {{ semestres?.total }} semestres</span>
                    </div>
                    <div v-if="semestres?.total > 0" class="overflow-x-auto   rounded shadow ">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium  uppercase">Semestres
                                    </th>
                                    <th class="px-6 py-3  text-left text-xs font-medium  uppercase">Detalle
                                        Semestre</th>

                                    <th class="px-6 py-3  text-left text-xs font-medium  uppercase">Detalle
                                        Solicitud</th>
                                    <th class="px-6 py-3 w-40 text-right text-xs font-medium  uppercase">
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr v-for="semestre in semestres?.data" :key="semestre.id">
                                    <td class="px-6 py-4 whitespace-nowrap ">{{ semestre.semestre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        Inicio: {{ semestre.fecha_inicio }} <br />
                                        Fin: {{ semestre.fecha_fin }} <br />
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        Inicio: {{ semestre.fecha_inicio_solicitud }} <br />
                                        Fin: {{ semestre.fecha_fin_solicitud }}
                                    </td>
                                    <td class="text-right flex gap-2 px-6 py-4 whitespace-nowrap">
                                        <Button variant="warning" @click="editing = semestre; showForm = true">
                                            <Edit></Edit>
                                        </Button>
                                        <Button variant="destructive" @click="deletingId = semestre.id">
                                            <Trash2></Trash2>
                                        </Button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-6 flex justify-center ">
                            <Pagination :meta="semestres" />
                        </div>
                    </div>
                    <div v-else class="py-6 text-center text-sm text-muted-foreground">
                        No se encontraron semestres.
                    </div>
                </div>
            </Card>

            <SemestreFormDialog :open="showForm" :semestre="editing" @close="showForm = false; editing = null" />

            <DeleteSemestreDialog v-if="deletingId" :open="true" :semestre-id="deletingId" @close="deletingId = null" />

        </div>
    </AppLayout>
</template>
