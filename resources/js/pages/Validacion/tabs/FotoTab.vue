<script setup lang="ts">
import FotoUploader from '../components/FotoUploader.vue'
</script>

<template>
    <div class="space-y-4">
        <h3 class="text-lg font-semibold">
            Validación de Fotografía
        </h3>

        <p class="text-sm text-muted-foreground">
            Suba una fotografía en formato JPG para validar
            las especificaciones del carnet.
        </p>

        <FotoUploader />
    </div>
</template>
