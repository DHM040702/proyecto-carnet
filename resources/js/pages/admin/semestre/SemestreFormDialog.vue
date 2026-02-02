<script setup lang="ts">
import { watch } from 'vue'
import { useForm } from '@inertiajs/vue3'
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogFooter,
} from '@/components/ui/dialog'
import DialogDescription from '@/components/ui/dialog/DialogDescription.vue';
import Label from '@/components/ui/label/Label.vue';
import semestre from '@/routes/semestre';
import Button from '@/components/ui/button/Button.vue';
import InputError from '@/components/InputError.vue';

const props = defineProps<{
  open: boolean
  semestre?: any
}>()

const emit = defineEmits(['close'])
const resetForm = () => {
  form.reset()
  form.errors = {}
  emit('close')
}
const form = useForm({
  semestre: '',
  fecha_inicio: '',
  fecha_fin: '',
  fecha_inicio_solicitud: '',
  fecha_fin_solicitud: '',
})

watch(

  () => props.semestre,

  (value) => {
    form.reset()
    if (value) {
      form.semestre = value.semestre
      form.fecha_inicio = value.fecha_inicio
      form.fecha_fin = value.fecha_fin
      form.fecha_inicio_solicitud = value.fecha_inicio_solicitud
      form.fecha_fin_solicitud = value.fecha_fin_solicitud
    } else {
      form.reset()
    }
  },
  { immediate: true }
)

const submit = () => {
  props.semestre
    ? form.put(semestre.update(props.semestre.id).url, {
      onSuccess: () => resetForm(),
    })
    : form.post(semestre.store().url, {
      onSuccess: () => resetForm(),
    })
}
</script>

<template>
  <Dialog :open="open" @open-change="emit('close')">
    <DialogContent class="w-[480px]">
      <DialogHeader>
        <DialogTitle>
          {{ semestre ? 'Editar semestre' : 'Crear semestre' }}
        </DialogTitle>
      </DialogHeader>
      <DialogDescription class="text-mauve11 mt-[10px] mb-5 text-sm leading-normal">
        {{ semestre ? 'Se editará el semestre: ' : 'Se creará un nuevo semestre' }}
      </DialogDescription>
      <Label class="  text-sm font-semibold leading-[35px] text-stone-700 dark:text-white" for="firstName"> Nombre del
        semestre
      </Label>
      <input id="firstName"
        class=" border inline-flex h-[35px] appearance-none items-center justify-center rounded-lg px-[10px] text-sm leading-none shadow-sm outline-none focus:shadow-[0_0_0_2px_black] selection:color-white selection:bg-blackA9"
        type="text" v-model="form.semestre" placeholder="Ejemplo: 2024-I">
      <InputError :message="form.errors.semestre" />

      <div class="grid grid-cols-2 gap-4 ">
        <Label class=" col-span-2 text-sm font-semibold leading-[35px] text-stone-700 dark:text-white" for="firstName">
          Nombre del
          Fecha de inicio y fin del semestre
        </Label>
        <div>
          <input type="date" v-model="form.fecha_inicio" class="input date-input" />
          <InputError :message="form.errors.fecha_inicio" />
        </div>
        <div>
          <input type="date" v-model="form.fecha_fin" class="input date-input" />
          <InputError :message="form.errors.fecha_fin" />
        </div>
        <Label class="col-span-2 text-sm font-semibold leading-[35px] text-stone-700 dark:text-white" for="firstName">
          Nombre del
          Fecha de inicio y fin del proceso de solicitud de carnets
        </Label>
        <div>
          <input type="date" v-model="form.fecha_inicio_solicitud" class="input date-input" />
          <InputError :message="form.errors.fecha_inicio_solicitud" />
        </div>
        <div>
          <input type="date" v-model="form.fecha_fin_solicitud" class="input date-input" />
          <InputError :message="form.errors.fecha_fin_solicitud" />
        </div>
      </div>
      <DialogFooter class="mt-6">
        <Button variant="secondary" @click="resetForm()">Cancelar</Button>
        <Button variant="success" @click="submit">Guardar</Button>
      </DialogFooter>
    </DialogContent>
  </Dialog>
</template>
