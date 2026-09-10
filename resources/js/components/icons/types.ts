// Icon component type definitions
import type { DefineComponent } from 'vue'

export interface IconComponents {
  IconUsers: DefineComponent
  IconCpu: DefineComponent
  IconClipboardList: DefineComponent
  IconWrench: DefineComponent
  IconPackage: DefineComponent
  IconWarehouse: DefineComponent
  IconShoppingCart: DefineComponent
  IconFileText: DefineComponent
  IconInbox: DefineComponent
  IconSearch: DefineComponent
  IconCalculator: DefineComponent
  IconCheckCircle: DefineComponent
  IconHammer: DefineComponent
  IconPackageCheck: DefineComponent
  IconReceipt: DefineComponent
  IconShieldCheck: DefineComponent
  IconFileChart: DefineComponent
  IconClipboardCheck: DefineComponent
  IconDatabase: DefineComponent
  IconPaperclip: DefineComponent
  IconTool: DefineComponent
  IconCar: DefineComponent
  IconCog: DefineComponent
}

export type IconName = keyof IconComponents

export function getIconComponent(name: string): DefineComponent | undefined {
  const icons: Record<string, DefineComponent> = {}

  return icons[name as IconName]
}