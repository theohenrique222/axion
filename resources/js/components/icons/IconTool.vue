<script setup lang="ts">
defineProps<{ class?: string }>()
</script>
<template>
  <svg :class="$attrs.class" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.827 12.697A4.5 4.5 0 0112 15.75a4.5 4.5 0 01-1.827-3.053M18.36 5.64a9 9 0 011.414 12.72m0 0a9 9 0 01-12.72 1.414" /></svg>
</template>