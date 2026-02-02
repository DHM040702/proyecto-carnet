<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { ChevronLeft, ChevronRight, ChevronsLeft, ChevronsRight, } from 'lucide-vue-next';
import {
  PaginationRoot,
  PaginationList,
  PaginationListItem,
  PaginationNext,
  PaginationPrev,
  PaginationFirst,
  PaginationLast,
  PaginationEllipsis,
} from 'reka-ui'

const props = defineProps<{
  meta: {
    current_page: number
    last_page: number
    per_page: number
    total: number
    path: string
  }
}>()

const goToPage = (page: number) => {
  if (page === props.meta.current_page) return

  router.get(
    props.meta.path,
    { page },
    {
      preserveScroll: true,
      preserveState: true,
      replace: true,
    }
  )
}
</script>

<template>
  <PaginationRoot :total="meta.total" :items-per-page="meta.per_page" :default-page="meta.current_page" show-edges
    :sibling-count="1" @update:page="goToPage">
    <PaginationList v-slot="{ items }" class="flex items-center gap-1">
      <PaginationFirst
        class="w-9 h-9  flex items-center justify-center bg-transparent hover:bg-white dark:hover:bg-stone-700/70 transition disabled:opacity-50 rounded-lg">
        <ChevronsLeft />
      </PaginationFirst>
      <PaginationPrev class="btn">
        <ChevronLeft />
      </PaginationPrev>

      <template v-for="(item, index) in items" :key="index">
        <PaginationListItem v-if="item.type === 'page'" :value="item.value" class="
            w-9 h-9 rounded-lg border
            data-[selected]:bg-white
            data-[selected]:text-black
            hover:bg-gray-100
          ">
          {{ item.value }}
        </PaginationListItem>

        <PaginationEllipsis v-else class="w-9 h-9 flex items-center justify-center">
          …
        </PaginationEllipsis>
      </template>
      
      <PaginationNext class="btn">
        <ChevronRight />
      </PaginationNext>
      <PaginationLast class="btn">
        <ChevronsRight />
      </PaginationLast>
    </PaginationList>
  </PaginationRoot>
</template>
