<script setup lang="ts">
defineProps<{ class?: string }>()
</script>
<template>
  <svg :class="$attrs.class" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.36 5.64a9 9 0 011.414 12.72m0 0a9 9 0 01-12.72 1.414" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h.01M12 4h.01" /></svg>
</template>