<script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import Button from '@/components/ui/button/Button.vue'
import Input from '@/components/ui/input/Input.vue'

const file = ref<File | null>(null)
const preview = ref<string | null>(null)
const error = ref<string | null>(null)
const loading = ref(false)

/**
 * Maneja la selección del archivo
 */
function onFileChange(event: Event) {
    error.value = null

    const target = event.target as HTMLInputElement
    if (!target.files || !target.files.length) return

    const selected = target.files[0]

    // Validación básica: tipo
    if (!['image/jpeg', 'image/jpg'].includes(selected.type)) {
        error.value = 'Solo se permiten imágenes JPG'
        return
    }

    // Validación básica: tamaño (2MB)
    if (selected.size > 2 * 1024 * 1024) {
        error.value = 'La imagen no debe superar los 2MB'
        return
    }

    file.value = selected
    preview.value = URL.createObjectURL(selected)
}

/**
 * Envío al backend
 */
function submit() {
    if (!file.value) {
        error.value = 'Debe seleccionar una imagen'
        return
    }

    loading.value = true

    router.post(
        '/validacion/foto',
        {
            foto: file.value,
        },
        {
            forceFormData: true,
            preserveScroll: true,

            onSuccess: () => {
                // 🔹 limpieza local al recibir respuesta correcta
                file.value = null
                preview.value = null
                error.value = null
            },

            onFinish: () => {
                loading.value = false
            },
        }
    )
}
</script>

<template>
    <div class="space-y-4">
        <Input
            type="file"
            accept="image/jpeg"
            @change="onFileChange"
        />

        <p v-if="error" class="text-sm text-red-600">
            {{ error }}
        </p>

        <div v-if="preview" class="flex justify-center">
            <img
                :src="preview"
                alt="Vista previa"
                class="h-48 rounded border object-contain"
            />
        </div>

        <div class="flex justify-center">
            <Button
                variant="success"
                :disabled="loading"
                @click="submit"
            >
                {{ loading ? 'Validando...' : 'Validar foto' }}
            </Button>
        </div>
    </div>
</template>
