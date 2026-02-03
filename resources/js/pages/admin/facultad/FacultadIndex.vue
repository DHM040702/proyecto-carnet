<script setup lang="ts">
import { ref, watch } from 'vue'
import FacultadFormDialog from './FacultadFormDialog.vue'
import DeleteFacultadDialog from './DeleteFacultadDialog.vue'
import { Head, router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import Button from '@/components/ui/button/Button.vue'
import Input from '@/components/ui/input/Input.vue'
import Card from '@/components/ui/card/Card.vue'
import Pagination from '@/components/ui/Pagination/Pagination.vue'
import facultad from '@/routes/facultad'
import { Edit, Trash2 } from 'lucide-vue-next'

const props = defineProps<{
    facultades: any
    filters: {
        search?: string
    }
}>()

const search = ref(props.filters.search ?? '')
const showForm = ref(false)
const editing = ref(null)
const deletingId = ref<number | null>(null)

let timeout: ReturnType<typeof setTimeout>

watch(search, (value) => {
    clearTimeout(timeout)
    timeout = setTimeout(() => {
        router.get(
            facultad.index().url,
            { search: value },
            { preserveState: true, replace: true }
        )
    }, 400)
})

const breadcrumbs = [
    { title: 'Reportes', href: '/reportes' },
]
</script>

<template>
  <Head title="Facultades" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-6">
      <div>
        <h2 class="text-2xl font-bold tracking-tight">Gestión de facultades</h2>
        <p class="text-muted-foreground">Facultades registradas</p>
      </div>
      <div class="flex justify-end">
        <Button variant="success" class="mt-4" @click="showForm = true">
          Nueva facultad
        </Button>
      </div>
      <div class="items-center gap-2 mb-2">
        <Input v-model="search" type="text" placeholder="Buscar facultad…" class="input" />
      </div>

      <Card>
        <div class="rounded-lg p-6">
          <div class="p-2 my-1">
            <span class="text-sm font-medium my-6">Se encontraron: {{ facultades?.total }} facultades</span>
          </div>
          <div v-if="facultades?.total > 0" class="overflow-x-auto rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase">Nombre</th>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase">Abreviatura</th>
                  <th class="px-6 py-3 w-40 text-right text-xs font-medium uppercase">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="fac in facultades?.data" :key="fac.id">
                  <td class="px-6 py-4 whitespace-nowrap">{{ fac.facultad }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ fac.abreviatura }}</td>
                  <td class="text-right flex gap-2 px-6 py-4 whitespace-nowrap">
                    <Button variant="warning" @click="editing = fac; showForm = true">
                      <Edit />
                    </Button>
                    <Button variant="destructive" @click="deletingId = fac.id">
                      <Trash2 />
                    </Button>
                  </td>
                </tr>
              </tbody>
            </table>

            <div class="mt-6 flex justify-center">
              <Pagination :meta="facultades" />
            </div>
          </div>
          <div v-else class="py-6 text-center text-sm text-muted-foreground">
            No se encontraron facultades.
          </div>
        </div>
      </Card>

      <FacultadFormDialog :open="showForm" :facultad="editing" @close="showForm = false; editing = null" />
      <DeleteFacultadDialog v-if="deletingId" :open="true" :facultad-id="deletingId" @close="deletingId = null" />
    </div>
  </AppLayout>
</template>
