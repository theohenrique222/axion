<script setup lang="ts">
interface SectionProps {
  id?: string
  className?: string
  ariaLabel?: string
}

const props = defineProps<SectionProps>()
</script>

<template>
  <section
    v-if="id"
    :id="id"
    :class="['py-16 md:py-24 lg:py-32 px-4 md:px-6 lg:px-8', className]"
    :aria-label="ariaLabel"
  >
    <div class="mx-auto max-w-7xl">
      <slot />
    </div>
  </section>
  <section
    v-else
    :class="['py-16 md:py-24 lg:py-32 px-4 md:px-6 lg:px-8', className]"
    :aria-label="ariaLabel"
  >
    <div class="mx-auto max-w-7xl">
      <slot />
    </div>
  </section>
</template>