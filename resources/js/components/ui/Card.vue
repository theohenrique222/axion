<script setup lang="ts">
import { computed } from 'vue'
import { clsx } from 'clsx'

interface CardProps {
  variant?: 'default' | 'elevated' | 'outlined'
  padding?: 'none' | 'sm' | 'md' | 'lg' | 'xl'
  class?: string
}

const props = withDefaults(defineProps<CardProps>(), {
  variant: 'default',
  padding: 'md',
  class: '',
})

const variantClasses = {
  default: 'bg-white dark:bg-axion-950 shadow-sm',
  elevated: 'bg-white dark:bg-axion-950 shadow-xl',
  outlined: 'bg-white dark:bg-axion-950 border border-axion-200 dark:border-axion-800',
}

const paddingClasses = {
  none: '',
  sm: 'p-4',
  md: 'p-6',
  lg: 'p-8',
  xl: 'p-10',
}

const computedClass = computed(() =>
  clsx('rounded-2xl', variantClasses[props.variant], paddingClasses[props.padding], props.class)
)
</script>

<template>
  <div :class="computedClass">
    <slot />
  </div>
</template>