<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import semestre from '@/routes/semestre';
import { router } from '@inertiajs/vue3'
import {
  AlertDialogContent,
  AlertDialogTitle,
  AlertDialogDescription,
  AlertDialogCancel,
  AlertDialogAction,
  AlertDialogRoot,
  AlertDialogTrigger,
  AlertDialogPortal,
  AlertDialogOverlay,
} from 'reka-ui'

const props = defineProps<{ open: boolean; semestreId: number }>()
const emit = defineEmits(['close'])

const confirmDelete = () => {
  router.delete(semestre.destroy(props.semestreId), {
    onSuccess: () => emit('close'),
  })
}
function handleAction() {
  // eslint-disable-next-line no-alert
  alert('clicked action button!')
}
</script>

<template>
  <AlertDialogRoot :open="open" @open-change="emit('close')">
    <AlertDialogPortal>
      <AlertDialogOverlay class=" dark:bg-blackA9 data-[state=open]:animate-overlayShow fixed inset-0 z-30" />
      <AlertDialogContent
        class="z-[100] text-sm data-[state=open]:animate-contentShow fixed top-[50%] left-[50%] max-h-[85vh] w-[90vw] max-w-[500px] translate-x-[-50%] translate-y-[-50%] rounded-lg bg-white p-[25px] shadow-[hsl(206_22%_7%_/_35%)_0px_10px_38px_-10px,_hsl(206_22%_7%_/_20%)_0px_10px_20px_-15px] focus:outline-none">
        <AlertDialogTitle class="dark:text-black m-0 text-[17px] font-semibold">
          Are you absolutely sure?
        </AlertDialogTitle>
        <AlertDialogDescription class="dark:text-black text-mauve11 mt-4 mb-5 text-sm leading-normal">
          This action cannot be undone. This will permanently delete your account and remove your data from our servers.
        </AlertDialogDescription>
        <div class="flex justify-end gap-4">
          <AlertDialogCancel class="">

            <Button variant="secondary" @click="emit('close')">Cancelar</Button>
          </AlertDialogCancel>

          <AlertDialogAction class="bg-red-600 rounded-md text-white" @click="confirmDelete">

            <Button variant="destructive">Sí, eliminar</Button>

          </AlertDialogAction>
        </div>
      </AlertDialogContent>
    </AlertDialogPortal>
  </AlertDialogRoot>
  <!--  
  <AlertDialogRoot :open="open" @open-change="emit('close')">
    <AlertDialogTrigger
      class="bg-white text-sm text-grass11 font-semibold hover:bg-white/90 shadow-sm border inline-flex h-[35px] items-center justify-center rounded-md px-[15px] leading-none outline-none focus:shadow-[0_0_0_2px] dark:focus:shadow-green8 focus:shadow-black transition-all"
    >
    
    </AlertDialogTrigger>
    <AlertDialogContent>
      <AlertDialogTitle>¿Eliminar semestre?</AlertDialogTitle>
      <AlertDialogDescription>
        Esta acción no se puede deshacer
      </AlertDialogDescription>

      <div class="flex justify-end gap-2 mt-4">
        <AlertDialogAction class="bg-red-600 text-white" @click="confirmDelete">
          Eliminar
        </AlertDialogAction>
      </div>
    </AlertDialogContent>
  </AlertDialogRoot> -->
</template>
