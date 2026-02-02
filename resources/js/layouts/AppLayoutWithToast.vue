<script setup lang="ts">
import { ref, watch } from 'vue'
import { usePage } from '@inertiajs/vue3'
import {
  ToastClose,
  ToastDescription,
  ToastProvider,
  ToastRoot,
  ToastTitle,
  ToastViewport,
} from 'reka-ui'
import { X } from 'lucide-vue-next'

const page = usePage()
const open = ref(false)
const message = ref('')

watch(
  () => page.props.flash?.toast_id,
  () => {
    const success = page.props.flash?.success
    if (success) {
      open.value = false

      setTimeout(() => {
        message.value = success
        open.value = true
      }, 50)
    }
  }
)
</script>

<template>
  <ToastProvider :duration="3000">
    <slot />

    <ToastRoot  v-model:open="open"
      class="rounded-lg border shadow p-4 bg-green-400 text-white ">
      <ToastTitle class="text-sm font-medium">
        Éxito
      </ToastTitle>

      <ToastDescription class="text-sm text-green-900">
        {{ message }}
      </ToastDescription>

      <ToastClose class="absolute top-2 right-2 cursor-pointer text-white">
        <X />
      </ToastClose>
    </ToastRoot>

    <ToastViewport class="
        fixed
        top-4
        right-4
        z-[2147483647]
        flex
        flex-col
        gap-2
        w-[360px]
        max-w-[100vw]
        outline-none
      " />
  </ToastProvider>
</template>
