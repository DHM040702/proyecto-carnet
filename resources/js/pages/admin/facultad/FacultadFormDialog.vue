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
import facultad from '@/routes/facultad';
import Button from '@/components/ui/button/Button.vue';
import InputError from '@/components/InputError.vue';

const props = defineProps<{
  open: boolean
  facultad?: any
}>()

const emit = defineEmits(['close'])

const form = useForm({
  facultad: '',
  abreviatura: '',
})

const validateForm = (): boolean => {
  const errors: Record<string, string> = {}

  if (!form.facultad.trim()) {
    errors.facultad = '*Campo requerido'
  }

  if (!form.abreviatura.trim()) {
    errors.abreviatura = '*Campo requerido'
  }

  if (Object.keys(errors).length > 0) {
    form.errors = errors
    return false
  }

  return true
}

const resetForm = () => {
  form.reset()
  form.errors = {}
  emit('close')
}

watch(
  () => props.facultad,
  (value) => {
    form.reset()
    if (value) {
      form.facultad = value.facultad
      form.abreviatura = value.abreviatura
    } else {
      form.reset()
    }
  },
  { immediate: true }
)

const submit = () => {
  if (!validateForm()) {
    return
  }

  props.facultad
    ? form.put(facultad.update(props.facultad.id).url, {
        onSuccess: () => resetForm(),
      })
    : form.post(facultad.store().url, {
        onSuccess: () => resetForm(),
      })
}
</script>

<template>
  <Dialog :open="open" @open-change="emit('close')">
    <DialogContent class="w-[480px]">
      <DialogHeader>
        <DialogTitle>
          {{ props.facultad ? 'Editar facultad' : 'Crear nueva facultad' }}
        </DialogTitle>
      </DialogHeader>

      <DialogDescription class="text-mauve11 mt-[10px] mb-5 text-sm leading-normal">
        {{ props.facultad ? 'Editar la facultad' : 'Crear una nueva facultad' }}
      </DialogDescription>

      <Label class="text-sm font-semibold leading-[35px] text-stone-700 dark:text-white" for="facultad">
        Nombre de la facultad
      </Label>
      <input
        id="facultad"
        class="border inline-flex h-[35px] rounded-lg px-[10px] text-sm shadow-sm outline-none focus:shadow-[0_0_0_2px_black]"
        type="text"
        v-model="form.facultad"
        placeholder="Ejemplo: Ingeniería de Sistemas e Informática"
      />
      <InputError :message="form.errors.facultad" />

      <Label class="text-sm font-semibold leading-[35px] text-stone-700 dark:text-white mt-4" for="abreviatura">
        Abreviaturas de la facultad
      </Label>
      <input
        id="abreviatura"
        class="border inline-flex h-[35px] rounded-lg px-[10px] text-sm shadow-sm outline-none focus:shadow-[0_0_0_2px_black]"
        type="text"
        v-model="form.abreviatura"
        placeholder="Ejemplo: FISI"
      />
      <InputError :message="form.errors.abreviatura" />

      <DialogFooter class="mt-6">
        <Button variant="secondary" @click="resetForm()">Cancelar</Button>
        <Button variant="success" @click="submit">Guardar</Button>
      </DialogFooter>
    </DialogContent>
  </Dialog>
</template>
