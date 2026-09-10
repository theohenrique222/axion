<script setup lang="ts">
import { computed } from 'vue'
import { clsx } from 'clsx'

interface ButtonProps {
  variant?: 'primary' | 'secondary' | 'outline' | 'ghost'
  size?: 'sm' | 'md' | 'lg'
  disabled?: boolean
  type?: 'button' | 'submit' | 'reset'
  class?: string
}

const props = withDefaults(defineProps<ButtonProps>(), {
  variant: 'primary',
  size: 'md',
  disabled: false,
  type: 'button',
  class: '',
})

const baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-200 rounded-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed'

const variantClasses = {
  primary: 'bg-axion-600 text-white hover:bg-axion-700 focus-visible:ring-axion-500 shadow-sm hover:shadow-md',
  secondary: 'bg-axion-900 text-white hover:bg-axion-800 focus-visible:ring-axion-700',
  outline: 'border-2 border-axion-600 text-axion-600 hover:bg-axion-50 focus-visible:ring-axion-500 dark:border-axion-400 dark:text-axion-400 dark:hover:bg-axion-950',
  ghost: 'text-axion-600 hover:bg-axion-50 focus-visible:ring-axion-500 dark:text-axion-400 dark:hover:bg-axion-950',
}

const sizeClasses = {
  sm: 'px-4 py-2 text-sm gap-2',
  md: 'px-6 py-3 text-base gap-2.5',
  lg: 'px-8 py-4 text-lg gap-3',
}

const computedClass = computed(() =>
  clsx(baseClasses, variantClasses[props.variant], sizeClasses[props.size], props.class)
)
</script>

<template>
  <button
    :type="type"
    :disabled="disabled"
    :class="computedClass"
    @click="$emit('click', $event)"
  >
    <slot />
  </button>
</template>