<script setup lang="ts">
import { ref, watch } from 'vue'
import EscuelaFormDialog from './EscuelaFormDialog.vue'
import DeleteEscuelaDialog from './DeleteEscuelaDialog.vue'
import { Head, router } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'
import Button from '@/components/ui/button/Button.vue'
import Input from '@/components/ui/input/Input.vue'
import Card from '@/components/ui/card/Card.vue'
import Pagination from '@/components/ui/Pagination/Pagination.vue'
import escuela from '@/routes/escuela'
import { Edit, Trash2 } from 'lucide-vue-next'

const props = defineProps<{
    escuelas: any
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
            escuela.index().url,
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
  <Head title="Escuelas" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-6 overflow-x-auto rounded-xl p-6">
      <div>
        <h2 class="text-2xl font-bold tracking-tight">Gestión de escuelas</h2>
        <p class="text-muted-foreground">Escuelas registradas</p>
      </div>
      <div class="flex justify-end">
        <Button variant="success" class="mt-4" @click="showForm = true">
          Nueva escuela
        </Button>
      </div>
      <div class="items-center gap-2 mb-2">
        <Input v-model="search" type="text" placeholder="Buscar escuela…" class="input" />
      </div>

      <Card>
        <div class="rounded-lg p-6">
          <div class="p-2 my-1">
            <span class="text-sm font-medium my-6">Se encontraron: {{ escuelas?.total }} escuelas</span>
          </div>
          <div v-if="escuelas?.total > 0" class="overflow-x-auto rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
              <thead>
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase">Escuela</th>
                  <th class="px-6 py-3 text-left text-xs font-medium uppercase">Facultad</th>
                  <th class="px-6 py-3 w-40 text-right text-xs font-medium uppercase">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="esc in escuelas?.data" :key="esc.id">
                  <td class="px-6 py-4 whitespace-nowrap">{{ esc.escuela }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ esc.facultad?.facultad }}</td>
                  <td class="text-right flex gap-2 px-6 py-4 whitespace-nowrap">
                    <Button variant="warning" @click="editing = esc; showForm = true">
                      <Edit />
                    </Button>
                    <Button variant="destructive" @click="deletingId = esc.id">
                      <Trash2 />
                    </Button>
                  </td>
                </tr>
              </tbody>
            </table>

            <div class="mt-6 flex justify-center">
              <Pagination :meta="escuelas" />
            </div>
          </div>
          <div v-else class="py-6 text-center text-sm text-muted-foreground">
            No se encontraron escuelas.
          </div>
        </div>
      </Card>

      <EscuelaFormDialog :open="showForm" :escuela="editing" @close="showForm = false; editing = null" />
      <DeleteEscuelaDialog v-if="deletingId" :open="true" :escuela-id="deletingId" @close="deletingId = null" />
    </div>
  </AppLayout>
</template>
