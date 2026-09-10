<script setup lang="ts">
interface AxionLogoProps {
  size?: 'sm' | 'md' | 'lg' | 'xl'
  class?: string
  variant?: 'default' | 'light' | 'dark'
}

const props = withDefaults(defineProps<AxionLogoProps>(), {
  size: 'md',
  class: '',
  variant: 'default',
})

const sizeClasses = {
  sm: 'w-6 h-6',
  md: 'w-8 h-8',
  lg: 'w-10 h-10',
  xl: 'w-12 h-12',
}

const variantClasses = {
  default: 'bg-gradient-to-br from-axion-600 to-axion-800',
  light: 'bg-gradient-to-br from-axion-400 to-axion-600',
  dark: 'bg-gradient-to-br from-axion-700 to-axion-900',
}
</script>

<template>
  <span :class="['inline-flex items-center justify-center rounded-xl font-bold text-white', sizeClasses[props.size], variantClasses[props.variant], props.class]">
    <svg viewBox="0 0 32 32" fill="none" class="w-full h-full" aria-hidden="true">
      <!-- Geometric symbol representing connection/organization -->
      <path
        d="M8 16L14 22L24 10"
        stroke="currentColor"
        stroke-width="2.5"
        stroke-linecap="round"
        stroke-linejoin="round"
      />
      <circle cx="8" cy="16" r="3" fill="currentColor" opacity="0.3" />
      <circle cx="16" cy="8" r="3" fill="currentColor" opacity="0.3" />
      <circle cx="24" cy="22" r="3" fill="currentColor" opacity="0.3" />
    </svg>
  </span>
</template>