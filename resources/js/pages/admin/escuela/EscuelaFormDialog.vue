<script setup lang="ts">
import { onMounted, watch, ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogFooter,
} from '@/components/ui/dialog'
import DialogDescription from '@/components/ui/dialog/DialogDescription.vue'
import Label from '@/components/ui/label/Label.vue'
import escuela from '@/routes/escuela'
import Button from '@/components/ui/button/Button.vue'
import InputError from '@/components/InputError.vue'

interface Facultad {
  id: number
  facultad: string
}

const props = defineProps<{
  open: boolean
  escuela?: any
}>()

const emit = defineEmits(['close'])

const form = useForm({
  escuela: '',
  facultad_id: '',
})

const facultades = ref<Facultad[]>([])

onMounted(async () => {
  const response = await fetch('/api/facultades')
  facultades.value = await response.json()
})

const validateForm = (): boolean => {
  const errors: Record<string, string> = {}

  if (!form.escuela.trim()) {
    errors.escuela = '*Campo requerido'
  }

  if (!form.facultad_id) {
    errors.facultad_id = '*Campo requerido'
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
  () => props.escuela,
  (value) => {
    form.reset()
    if (value) {
      form.escuela = value.escuela
      form.facultad_id = value.facultad_id
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

  props.escuela
    ? form.put(escuela.update(props.escuela.id).url, {
        onSuccess: () => resetForm(),
      })
    : form.post(escuela.store().url, {
        onSuccess: () => resetForm(),
      })
}
</script>

<template>
  <Dialog :open="open" @open-change="emit('close')">
    <DialogContent class="w-[480px]">
      <DialogHeader>
        <DialogTitle>
          {{ props.escuela ? 'Editar escuela' : 'Crear nueva escuela' }}
        </DialogTitle>
      </DialogHeader>

      <DialogDescription class="text-mauve11 mt-[10px] mb-5 text-sm leading-normal">
        {{ props.escuela ? 'Editar la escuela' : 'Crear una nueva escuela' }}
      </DialogDescription>

      <Label class="text-sm font-semibold leading-[35px] text-stone-700 dark:text-white" for="escuela">
        Nombre de la escuela
      </Label>
      <input
        id="escuela"
        class="border inline-flex h-[35px] rounded-lg px-[10px] text-sm shadow-sm outline-none focus:shadow-[0_0_0_2px_black]"
        type="text"
        v-model="form.escuela"
        placeholder="Ejemplo: Ingeniería de Sistemas"
      />
      <InputError :message="form.errors.escuela" />

      <Label class="text-sm font-semibold leading-[35px] text-stone-700 dark:text-white mt-4" for="facultad_id">
        Facultad
      </Label>
      <select
        id="facultad_id"
        class="border inline-flex h-[35px] rounded-lg px-[10px] text-sm shadow-sm outline-none focus:shadow-[0_0_0_2px_black]"
        v-model="form.facultad_id"
      >
        <option value="">Selecciona una facultad</option>
        <option v-for="fac in facultades" :key="fac.id" :value="fac.id">
          {{ fac.facultad }}
        </option>
      </select>
      <InputError :message="form.errors.facultad_id" />

      <DialogFooter class="mt-6">
        <Button variant="secondary" @click="resetForm()">Cancelar</Button>
        <Button variant="success" @click="submit">Guardar</Button>
      </DialogFooter>
    </DialogContent>
  </Dialog>
</template>
