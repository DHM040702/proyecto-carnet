<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

type Props = {
    className?: HTMLAttributes['class'];
};

defineProps<Props>();
</script>

<template>
    <img
        src="/logo ogga.png"
        alt="Logo OGGA"
        :class="className"
        v-bind="$attrs"
    >
</template>
