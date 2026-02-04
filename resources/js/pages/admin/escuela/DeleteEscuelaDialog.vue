<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import escuela from '@/routes/escuela';
import { router } from '@inertiajs/vue3'
import {
  AlertDialogContent,
  AlertDialogTitle,
  AlertDialogDescription,
  AlertDialogCancel,
  AlertDialogAction,
  AlertDialogRoot,
  AlertDialogPortal,
  AlertDialogOverlay,
} from 'reka-ui'

const props = defineProps<{ open: boolean; escuelaId: number }>()
const emit = defineEmits(['close'])

const confirmDelete = () => {
  router.delete(escuela.destroy(props.escuelaId).url, {
    onSuccess: () => emit('close'),
  })
}
</script>

<template>
  <AlertDialogRoot :open="open" @open-change="emit('close')">
    <AlertDialogPortal>
      <AlertDialogOverlay class="fixed inset-0 z-30 data-[state=open]:animate-overlayShow dark:bg-blackA9" />
      <AlertDialogContent
        class="z-[100] fixed top-[50%] left-[50%] max-h-[85vh] w-[90vw] max-w-[500px] translate-x-[-50%] translate-y-[-50%] rounded-lg bg-white p-[25px] shadow-lg focus:outline-none data-[state=open]:animate-contentShow">
        <AlertDialogTitle class="text-[17px] font-semibold m-0 dark:text-black">
          ¿Eliminar escuela?
        </AlertDialogTitle>
        <AlertDialogDescription class="mt-4 mb-5 text-sm leading-normal dark:text-black">
          Esta acción no se puede deshacer. Se eliminará permanentemente la escuela y sus datos asociados.
        </AlertDialogDescription>
        <div class="flex justify-end gap-4">
          <AlertDialogCancel>
            <Button variant="secondary" @click="emit('close')">Cancelar</Button>
          </AlertDialogCancel>
          <AlertDialogAction>
            <Button variant="destructive" @click="confirmDelete">Sí, eliminar</Button>
          </AlertDialogAction>
        </div>
      </AlertDialogContent>
    </AlertDialogPortal>
  </AlertDialogRoot>
</template>
