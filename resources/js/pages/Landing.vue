<script setup lang="ts">
import { Head } from '@inertiajs/vue3'
import { ref, onMounted  } from 'vue'
import type {DefineComponent} from 'vue';
import AxionLogo from '@/components/brand/AxionLogo.vue'
import * as Icons from '@/components/icons'
import Button from '@/components/ui/Button.vue'
import Card from '@/components/ui/Card.vue'
import Section from '@/components/ui/Section.vue'

// Icon component type for dynamic component resolution
const iconComponents = Icons as unknown as Record<string, DefineComponent>

// Helper to get icon component
function getIcon(name: string): DefineComponent {
  return iconComponents[`Icon${name.charAt(0).toUpperCase() + name.slice(1)}`]
}

// Intersection Observer for scroll animations
const observer = ref<IntersectionObserver | null>(null)
const animatedElements = ref<Set<Element>>(new Set())

onMounted(() => {
  observer.value = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-in')
          animatedElements.value.add(entry.target)
          observer.value?.unobserve(entry.target)
        }
      })
    },
    { threshold: 0.1, rootMargin: '0px 0px -50px 0px' }
  )

  document.querySelectorAll('[data-animate]').forEach((el) => {
    observer.value?.observe(el)
  })
})

// Mock data for features
const features = [
  {
    title: 'Clientes',
    description: 'CRM completo com histórico de atendimentos, serviços e relacionamento.',
    icon: 'users',
  },
  {
    title: 'Equipamentos',
    description: 'Controle de equipamentos, números de série, garantia e histórico de manutenção.',
    icon: 'cpu',
  },
  {
    title: 'Ordens de Serviço',
    description: 'Crie, acompanhe, atribua e finalize ordens de serviço com facilidade.',
    icon: 'clipboard-list',
  },
  {
    title: 'Serviços',
    description: 'Crie seu catálogo de serviços e defina preços.',
    icon: 'wrench',
  },
  {
    title: 'Produtos',
    description: 'Controle produtos, custos e preços de venda.',
    icon: 'package',
  },
  {
    title: 'Estoque',
    description: 'Acompanhe entradas, saídas, movimentações e níveis de estoque.',
    icon: 'warehouse',
  },
  {
    title: 'Vendas',
    description: 'Gerencie vendas e gere documentos relacionados às operações.',
    icon: 'shopping-cart',
  },
  {
    title: 'Documentos',
    description: 'Gere orçamentos, recibos, certificados de garantia e relatórios técnicos.',
    icon: 'file-text',
  },
]

// Trust categories
const trustCategories = [
  'Assistências técnicas',
  'Oficinas',
  'Manutenção',
  'Serviços especializados',
  'Empresas de reparo',
]

// OS Flow steps
const osFlowSteps = [
  { step: 'Entrada', description: 'Recepção do equipamento e cadastro inicial', icon: 'inbox' },
  { step: 'Diagnóstico', description: 'Análise técnica e identificação do problema', icon: 'search' },
  { step: 'Orçamento', description: 'Elaboração e envio do orçamento ao cliente', icon: 'calculator' },
  { step: 'Aprovação', description: 'Aprovação do cliente e autorização do serviço', icon: 'check-circle' },
  { step: 'Execução', description: 'Realização do serviço e acompanhamento', icon: 'hammer' },
  { step: 'Finalização', description: 'Entrega, pagamento e geração de documentos', icon: 'package-check' },
]

// Document types
const documentTypes = [
  { title: 'Orçamento', description: 'Orçamentos profissionais com validade e termos', icon: 'file-text' },
  { title: 'Ordem de Serviço', description: 'OS detalhada com checklist e assinaturas', icon: 'clipboard-list' },
  { title: 'Recibo', description: 'Recibos de pagamento e comprovantes', icon: 'receipt' },
  { title: 'Certificado de Garantia', description: 'Certificados personalizados por equipamento', icon: 'shield-check' },
  { title: 'Relatório Técnico', description: 'Relatórios técnicos detalhados com fotos', icon: 'file-chart' },
]

// Customization features
const customizationFeatures = [
  {
    title: 'Checklists personalizados',
    description: 'Crie checklists específicos para cada tipo de serviço.',
    icon: 'clipboard-check',
  },
  {
    title: 'Campos personalizados',
    description: 'Adicione as informações que fazem sentido para o seu negócio.',
    icon: 'database',
  },
  {
    title: 'Anexos',
    description: 'Fotos, documentos e arquivos vinculados diretamente aos registros.',
    icon: 'paperclip',
  },
]

// Dashboard metrics
const dashboardMetrics = [
  { label: 'Faturamento', value: 'R$ 127.450', change: '+12.5%', trend: 'up' },
  { label: 'OS Abertas', value: '23', change: '5 novas hoje', trend: 'neutral' },
  { label: 'OS em Andamento', value: '18', change: '3 finalizadas', trend: 'up' },
  { label: 'OS Concluídas', value: '156', change: '+8% vs mês passado', trend: 'up' },
  { label: 'Vendas', value: 'R$ 89.200', change: '+15.2%', trend: 'up' },
  { label: 'Estoque Baixo', value: '7 itens', change: 'Requer atenção', trend: 'down' },
]

// Target audiences
const audiences = [
  {
    title: 'Assistências técnicas',
    description: 'Gerencie equipamentos, diagnósticos, peças e serviços.',
    icon: 'tool',
  },
  {
    title: 'Oficinas',
    description: 'Controle clientes, veículos, serviços e histórico.',
    icon: 'car',
  },
  {
    title: 'Manutenção',
    description: 'Organize chamados, equipamentos e técnicos.',
    icon: 'wrench',
  },
  {
    title: 'Serviços especializados',
    description: 'Adapte o Axion ao fluxo da sua empresa.',
    icon: 'cog',
  },
]

// Benefits
const benefits = [
  'Mais organização',
  'Mais produtividade',
  'Menos retrabalho',
  'Histórico completo',
  'Processos padronizados',
  'Informações centralizadas',
]

// Footer links
const footerLinks = {
  produto: [
    { label: 'Funcionalidades', href: '#funcionalidades' },
    { label: 'Preços', href: '#precos' },
    { label: 'Integrações', href: '#integracoes' },
    { label: 'Changelog', href: '#changelog' },
    { label: 'Roadmap', href: '#roadmap' },
  ],
  empresa: [
    { label: 'Sobre nós', href: '#sobre' },
    { label: 'Blog', href: '#blog' },
    { label: 'Carreiras', href: '#carreiras' },
    { label: 'Imprensa', href: '#imprensa' },
    { label: 'Parceiros', href: '#parceiros' },
  ],
  suporte: [
    { label: 'Central de ajuda', href: '#ajuda' },
    { label: 'Documentação', href: '#docs' },
    { label: 'Comunidade', href: '#comunidade' },
    { label: 'Contato', href: '#contato' },
    { label: 'Status do sistema', href: '#status' },
  ],
  legal: [
    { label: 'Termos de uso', href: '#termos' },
    { label: 'Política de privacidade', href: '#privacidade' },
    { label: 'Política de cookies', href: '#cookies' },
    { label: 'LGPD', href: '#lgpd' },
    { label: 'Segurança', href: '#seguranca' },
  ],
}

// OS List data
const osList = [
  { id: '#OS-2024-001', client: 'João Silva', equipment: 'Notebook Dell XPS', status: 'diagnostico', value: 'R$ 450,00' },
  { id: '#OS-2024-002', client: 'Maria Santos', equipment: 'iPhone 14 Pro', status: 'orcamento', value: 'R$ 890,00' },
  { id: '#OS-2024-003', client: 'Carlos Oliveira', equipment: 'Impressora HP', status: 'execucao', value: 'R$ 320,00' },
  { id: '#OS-2024-004', client: 'Ana Costa', equipment: 'Monitor LG 27', status: 'finalizada', value: 'R$ 1.200,00' },
  { id: '#OS-2024-005', client: 'Pedro Lima', equipment: 'Placa de vídeo RTX 4080', status: 'aprovacao', value: 'R$ 2.100,00' },
]

// Equipment info fields
const equipmentFields = [
  { label: 'Cliente', value: 'João Silva' },
  { label: 'Equipamento', value: 'Notebook' },
  { label: 'Marca', value: 'Apple' },
  { label: 'Modelo', value: 'MacBook Pro 16 M3' },
  { label: 'Número de Série', value: 'C02XY123ABCD' },
  { label: 'Garantia', value: 'Até 15/03/2026' },
]

// Service history data
const serviceHistory = [
  { date: '12/01/2024', title: 'Troca de tela', status: 'Concluída', os: '#OS-2024-089' },
  { date: '05/11/2023', title: 'Limpeza interna e pasta térmica', status: 'Concluída', os: '#OS-2023-245' },
  { date: '22/07/2023', title: 'Substituição de bateria', status: 'Concluída', os: '#OS-2023-156' },
  { date: '10/03/2023', title: 'Diagnóstico inicial', status: 'Concluída', os: '#OS-2023-045' },
]
</script>

<template>
  <Head title="Axion - Gestão inteligente para negócios que fazem acontecer">
    <meta name="description" content="Plataforma de gestão completa para assistências técnicas, oficinas e empresas de serviços. Clientes, equipamentos, ordens de serviço, estoque, vendas e documentos em um só lugar." />
    <meta property="og:title" content="Axion - Gestão inteligente para negócios que fazem acontecer" />
    <meta property="og:description" content="Centralize clientes, equipamentos, ordens de serviço, estoque, vendas e documentos em uma plataforma única." />
    <meta property="og:type" content="website" />
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  </Head>

  <div class="min-h-screen bg-white dark:bg-axion-950 text-axion-900 dark:text-axion-100 font-sans antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-axion-950/80 backdrop-blur-md border-b border-axion-200 dark:border-axion-800 transition-all duration-300" data-animate>
      <div class="mx-auto max-w-7xl px-4 md:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center gap-2">
            <AxionLogo size="lg" />
            <span class="font-semibold text-xl text-axion-900 dark:text-white hidden sm:block">Axion</span>
          </div>
          <div class="hidden md:flex items-center gap-8">
            <a href="#funcionalidades" class="text-sm font-medium text-axion-600 dark:text-axion-400 hover:text-axion-900 dark:hover:text-white transition-colors">Funcionalidades</a>
            <a href="#para-quem" class="text-sm font-medium text-axion-600 dark:text-axion-400 hover:text-axion-900 dark:hover:text-white transition-colors">Para quem é</a>
            <a href="#precos" class="text-sm font-medium text-axion-600 dark:text-axion-400 hover:text-axion-900 dark:hover:text-white transition-colors">Preços</a>
            <a href="#contato" class="text-sm font-medium text-axion-600 dark:text-axion-400 hover:text-axion-900 dark:hover:text-white transition-colors">Contato</a>
          </div>
          <div class="flex items-center gap-3">
            <Button variant="ghost" size="sm" class="hidden sm:inline-flex">Entrar</Button>
            <Button size="sm">Começar agora</Button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <Section id="hero" class="pt-32 pb-20 lg:pt-40 lg:pb-28" aria-label="Hero">
      <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        <div class="text-center lg:text-left" data-animate>
          <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-axion-50 dark:bg-axion-900/50 border border-axion-200 dark:border-axion-800 mb-6 text-sm font-medium text-axion-700 dark:text-axion-300 animate-fade-in-up">
            <span class="relative flex h-2 w-2">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-axion-500 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-axion-500"></span>
            </span>
            Novo: Dashboard financeiro avançado disponível
          </div>
          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-axion-900 dark:text-white mb-6 animate-fade-in-up" style="animation-delay: 100ms">
            Gestão inteligente para
            <br />
            <span class="bg-gradient-to-r from-axion-600 to-axion-800 bg-clip-text text-transparent">negócios que fazem acontecer.</span>
          </h1>
          <p class="text-lg md:text-xl text-axion-600 dark:text-axion-300 mb-8 max-w-xl mx-auto lg:mx-0 animate-fade-in-up" style="animation-delay: 200ms">
            Clientes, equipamentos, ordens de serviço, estoque, vendas e documentos. Tudo o que sua empresa precisa para organizar e crescer em um só lugar.
          </p>
          <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 animate-fade-in-up" style="animation-delay: 300ms">
            <Button size="lg" class="w-full sm:w-auto group">
              Começar agora
              <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
              </svg>
            </Button>
            <Button variant="outline" size="lg" class="w-full sm:w-auto">Conhecer o Axion</Button>
          </div>
          <div class="mt-10 flex items-center justify-center lg:justify-start gap-8 text-sm text-axion-500 dark:text-axion-400 animate-fade-in-up" style="animation-delay: 400ms">
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-axion-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
              <span>Sem cartão de crédito</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-axion-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
              <span>Teste grátis por 14 dias</span>
            </div>
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5 text-axion-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
              <span>Cancelamento a qualquer momento</span>
            </div>
          </div>
        </div>

        <!-- Product Mockup -->
        <div class="relative" data-animate>
          <div class="relative bg-axion-950 dark:bg-axion-900 rounded-2xl border border-axion-800 dark:border-axion-700 overflow-hidden shadow-2xl animate-fade-in-up" style="animation-delay: 200ms">
            <!-- Mockup Header -->
            <div class="flex items-center gap-2 px-4 py-3 bg-axion-900 dark:bg-axion-800 border-b border-axion-800 dark:border-axion-700">
              <div class="flex gap-1.5">
                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                <div class="w-3 h-3 rounded-full bg-green-500"></div>
              </div>
              <div class="flex-1 text-center text-xs text-axion-500 font-mono">app.axion.com.br / dashboard</div>
              <div class="w-3 h-3 rounded-full bg-transparent"></div>
            </div>

            <!-- Mockup Content -->
            <div class="p-6 space-y-6">
              <!-- Top Stats Row -->
              <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div class="bg-axion-900/50 dark:bg-axion-800/50 rounded-xl p-4 border border-axion-800 dark:border-axion-700">
                  <p class="text-xs font-medium text-axion-400 mb-1">Faturamento do mês</p>
                  <p class="text-2xl font-bold text-white">R$ 127.450</p>
                  <p class="text-xs text-green-400 mt-1 flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg> +12,5%</p>
                </div>
                <div class="bg-axion-900/50 dark:bg-axion-800/50 rounded-xl p-4 border border-axion-800 dark:border-axion-700">
                  <p class="text-xs font-medium text-axion-400 mb-1">OS Abertas</p>
                  <p class="text-2xl font-bold text-white">23</p>
                  <p class="text-xs text-axion-400 mt-1">5 novas hoje</p>
                </div>
                <div class="bg-axion-900/50 dark:bg-axion-800/50 rounded-xl p-4 border border-axion-800 dark:border-axion-700">
                  <p class="text-xs font-medium text-axion-400 mb-1">OS em Andamento</p>
                  <p class="text-2xl font-bold text-white">18</p>
                  <p class="text-xs text-blue-400 mt-1">3 finalizadas</p>
                </div>
              </div>

              <!-- Main Content Area -->
              <div class="grid lg:grid-cols-3 gap-4">
                <!-- Sidebar Navigation -->
                <div class="lg:col-span-1 space-y-2">
                  <nav class="space-y-1 bg-axion-900/30 dark:bg-axion-800/30 rounded-xl p-2 border border-axion-800 dark:border-axion-700">
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-axion-700/50 text-white font-medium text-sm">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                      Dashboard
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-axion-300 hover:text-white hover:bg-axion-800/50 text-sm transition-colors">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                      Ordens de Serviço
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-axion-300 hover:text-white hover:bg-axion-800/50 text-sm transition-colors">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                      Clientes
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-axion-300 hover:text-white hover:bg-axion-800/50 text-sm transition-colors">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                      Equipamentos
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-axion-300 hover:text-white hover:bg-axion-800/50 text-sm transition-colors">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                      Financeiro
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-axion-300 hover:text-white hover:bg-axion-800/50 text-sm transition-colors">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                      Configurações
                    </a>
                  </nav>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-4">
                  <!-- OS List -->
                  <div class="bg-axion-900/50 dark:bg-axion-800/50 rounded-xl border border-axion-800 dark:border-axion-700 overflow-hidden">
                    <div class="px-4 py-3 border-b border-axion-800 dark:border-axion-700 flex items-center justify-between">
                      <h3 class="font-semibold text-white text-sm">Ordens de Serviço Recentes</h3>
                      <Button variant="ghost" size="sm" class="text-xs text-axion-300 hover:text-white">Ver todas</Button>
                    </div>
                    <div class="divide-y divide-axion-800 dark:divide-axion-700">
                      <div v-for="(os, index) in osList" :key="index" class="px-4 py-3 hover:bg-axion-800/30 transition-colors">
                        <div class="flex items-center justify-between gap-4">
                          <div class="flex-1 min-w-0">
                            <p class="font-medium text-white text-sm truncate">{{ os.id }} - {{ os.client }}</p>
                            <p class="text-xs text-axion-400 truncate">{{ os.equipment }}</p>
                          </div>
                          <div class="flex items-center gap-3 whitespace-nowrap">
                            <span :class="[
                              'px-2.5 py-1 rounded-full text-xs font-medium',
                              os.status === 'diagnostico' && 'bg-blue-500/20 text-blue-400',
                              os.status === 'orcamento' && 'bg-yellow-500/20 text-yellow-400',
                              os.status === 'aprovacao' && 'bg-purple-500/20 text-purple-400',
                              os.status === 'execucao' && 'bg-orange-500/20 text-orange-400',
                              os.status === 'finalizada' && 'bg-green-500/20 text-green-400',
                            ]">
                              {{ os.status === 'diagnostico' ? 'Diagnóstico' : os.status === 'orcamento' ? 'Orçamento' : os.status === 'aprovacao' ? 'Aprovação' : os.status === 'execucao' ? 'Execução' : 'Finalizada' }}
                            </span>
                            <span class="font-mono font-semibold text-white text-sm">{{ os.value }}</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Quick Actions -->
                  <div class="grid grid-cols-2 gap-3">
                    <Button variant="outline" class="h-24 flex-col gap-2">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                      <span class="font-medium">Nova OS</span>
                    </Button>
                    <Button variant="outline" class="h-24 flex-col gap-2">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                      <span class="font-medium">Novo Cliente</span>
                    </Button>
                    <Button variant="outline" class="h-24 flex-col gap-2">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                      <span class="font-medium">Novo Equipamento</span>
                    </Button>
                    <Button variant="outline" class="h-24 flex-col gap-2">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                      <span class="font-medium">Novo Documento</span>
                    </Button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Floating indicator -->
          <div class="absolute -bottom-6 -left-6 md:-left-8 lg:-left-10 bg-white dark:bg-axion-900 rounded-xl shadow-2xl border border-axion-200 dark:border-axion-800 p-4 md:p-6 animate-fade-in-up" style="animation-delay: 400ms">
            <div class="flex items-center gap-3 md:gap-4">
              <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-gradient-to-br from-axion-500 to-axion-700 flex items-center justify-center flex-shrink-0">
                <svg class="w-6 h-6 md:w-7 md:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
              </div>
              <div>
                <p class="text-sm font-medium text-axion-900 dark:text-white">Faturamento em tempo real</p>
                <p class="text-2xl md:text-3xl font-bold text-axion-900 dark:text-white">R$ 127.450</p>
                <p class="text-xs text-green-600 dark:text-green-400 flex items-center gap-1 mt-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg> +12,5% vs mês anterior</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Section>

    <!-- Trust Bar -->
    <Section className="bg-axion-50 dark:bg-axion-900/50 border-y border-axion-200 dark:border-axion-800 py-12" aria-label="Empresas que confiam">
      <div class="text-center mb-10" data-animate>
        <p class="text-sm font-medium text-axion-600 dark:text-axion-400 uppercase tracking-wider">Feito para empresas que trabalham com serviços</p>
      </div>
      <div class="flex flex-wrap items-center justify-center gap-8 md:gap-12 text-axion-500 dark:text-axion-400 font-medium text-sm" data-animate>
        <span v-for="(category, index) in trustCategories" :key="index" class="flex items-center gap-2 transition-colors hover:text-axion-700 dark:hover:text-axion-200">
          <svg class="w-4 h-4 text-axion-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
          {{ category }}
        </span>
      </div>
    </Section>

    <!-- Features Section -->
    <Section id="funcionalidades" aria-label="Funcionalidades">
      <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-axion-900 dark:text-white mb-4">
          Do atendimento à entrega,
          <br />
          <span class="text-axion-600 dark:text-axion-400">tudo conectado.</span>
        </h2>
        <p class="text-lg text-axion-600 dark:text-axion-300">Centralize toda a operação da sua empresa em uma plataforma única, integrada e feita para quem presta serviços.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" data-animate>
        <Card v-for="(feature, index) in features" :key="index" variant="outlined" padding="lg" class="hover:border-axion-300 dark:hover:border-axion-700 hover:shadow-lg transition-all duration-300 group">
          <div class="w-12 h-12 rounded-xl bg-axion-100 dark:bg-axion-800/50 flex items-center justify-center mb-4 group-hover:bg-axion-600 group-hover:text-white transition-all duration-300">
            <component :is="getIcon(feature.icon)" class="w-6 h-6 text-axion-600 dark:text-axion-400 group-hover:text-white" />
          </div>
          <h3 class="text-lg font-semibold text-axion-900 dark:text-white mb-2">{{ feature.title }}</h3>
          <p class="text-axion-600 dark:text-axion-400 text-sm leading-relaxed">{{ feature.description }}</p>
        </Card>
      </div>
    </Section>

    <!-- Equipment Section -->
    <Section id="equipamentos" class="bg-axion-50 dark:bg-axion-900/30" aria-label="Gestão de equipamentos">
      <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        <div data-animate>
          <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-axion-900 dark:text-white mb-6">
            Conheça o histórico de
            <br />
            <span class="text-axion-600 dark:text-axion-400">cada equipamento.</span>
          </h2>
          <p class="text-lg text-axion-600 dark:text-axion-300 mb-8">
            Saiba exatamente o que aconteceu com cada equipamento desde o primeiro atendimento. Histórico completo, garantias, anexos e muito mais.
          </p>
          <ul class="space-y-4" role="list">
            <li v-for="(item, index) in [
              'Cliente e informações de contato',
              'Equipamento, marca, modelo e número de série',
              'Status de garantia e vigência',
              'Histórico completo de serviços realizados',
              'Ordens de serviço anteriores vinculadas',
              'Anexos, fotos e documentos técnicos',
            ]" :key="index" class="flex items-start gap-3 text-axion-600 dark:text-axion-300">
              <svg class="w-5 h-5 text-axion-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
              <span>{{ item }}</span>
            </li>
          </ul>
        </div>

        <!-- Equipment Mockup -->
        <div data-animate>
          <Card variant="elevated" padding="none" class="overflow-hidden border border-axion-200 dark:border-axion-800">
            <div class="bg-axion-900 dark:bg-axion-800 px-6 py-4 border-b border-axion-800 dark:border-axion-700 flex items-center justify-between">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-axion-600/20 flex items-center justify-center">
                  <svg class="w-5 h-5 text-axion-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </div>
                <div>
                  <p class="font-semibold text-white">MacBook Pro 16" M3</p>
                  <p class="text-xs text-axion-400">EQP-2024-0142 • João Silva</p>
                </div>
              </div>
              <span class="px-3 py-1 rounded-full bg-green-500/20 text-green-400 text-xs font-medium">Em garantia</span>
            </div>

            <div class="p-6 space-y-6 max-h-[500px] overflow-y-auto">
              <!-- Info Grid -->
              <div class="grid grid-cols-2 gap-4">
                <div v-for="(field, index) in equipmentFields" :key="index" class="bg-axion-50 dark:bg-axion-800/50 rounded-xl p-4">
                  <p class="text-xs font-medium text-axion-500 dark:text-axion-400 uppercase tracking-wider mb-1">{{ field.label }}</p>
                  <p class="font-medium text-axion-900 dark:text-white">{{ field.value }}</p>
                </div>
              </div>

              <!-- Service History -->
              <div>
                <h4 class="font-semibold text-axion-900 dark:text-white mb-4 flex items-center gap-2">
                  <svg class="w-5 h-5 text-axion-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                  Histórico de Serviços
                </h4>
                <div class="space-y-3 border-l-2 border-axion-200 dark:border-axion-800 pl-4">
                  <div v-for="(service, index) in serviceHistory" :key="index" class="relative before:absolute before:left-[-8px] before:top-1/2 before:-translate-y-1/2 before:w-2 before:h-2 before:rounded-full before:bg-axion-500">
                    <div class="flex items-start justify-between gap-4">
                      <div>
                        <p class="text-sm font-medium text-axion-900 dark:text-white">{{ service.title }}</p>
                        <p class="text-xs text-axion-500 dark:text-axion-400">{{ service.os }} • {{ service.date }}</p>
                      </div>
                      <span class="px-2 py-0.5 rounded-full bg-green-500/20 text-green-400 text-xs font-medium whitespace-nowrap">{{ service.status }}</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Attachments -->
              <div>
                <h4 class="font-semibold text-axion-900 dark:text-white mb-4 flex items-center gap-2">
                  <svg class="w-5 h-5 text-axion-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                  Anexos e Fotos
                </h4>
                <div class="grid grid-cols-3 gap-3">
                  <div v-for="i in 3" :key="i" class="aspect-square rounded-xl bg-axion-100 dark:bg-axion-800/50 border border-axion-200 dark:border-axion-700 flex items-center justify-center relative group overflow-hidden">
                    <svg class="w-8 h-8 text-axion-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                      <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </Card>
        </div>
      </div>
    </Section>

    <!-- OS Flow Section -->
    <Section id="ordens-servico" aria-label="Fluxo de Ordens de Serviço">
      <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-axion-900 dark:text-white mb-4">
          Fluxo completo de
          <br />
          <span class="text-axion-600 dark:text-axion-400">Ordens de Serviço.</span>
        </h2>
        <p class="text-lg text-axion-600 dark:text-axion-300 mb-8">
          Menos papel. Menos informações perdidas. Mais controle sobre cada serviço.
        </p>
      </div>

      <div class="relative" data-animate>
        <!-- Flow Line -->
        <div class="hidden lg:block absolute top-14 left-10 right-10 h-0.5 bg-gradient-to-r from-axion-200 via-axion-500 to-axion-200 dark:from-axion-800 dark:via-axion-600 dark:to-axion-800" />

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4 lg:gap-0 relative z-10">
          <Card v-for="(step, index) in osFlowSteps" :key="index" variant="outlined" padding="lg" class="relative text-center h-full transition-all duration-300 hover:border-axion-300 dark:hover:border-axion-700 hover:shadow-xl group">
<div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-axion-100 dark:bg-axion-800/50 flex items-center justify-center group-hover:bg-axion-600 group-hover:text-white transition-all duration-300">
            <component :is="getIcon(step.icon)" class="w-7 h-7 text-axion-600 dark:text-axion-400 group-hover:text-white" />
          </div>
            <h3 class="font-semibold text-axion-900 dark:text-white mb-1">{{ step.step }}</h3>
            <p class="text-sm text-axion-600 dark:text-axion-400">{{ step.description }}</p>
            
            <!-- Step number -->
            <div class="absolute -top-3 -right-3 w-8 h-8 rounded-full bg-axion-600 text-white text-xs font-bold flex items-center justify-center">
              {{ index + 1 }}
            </div>
            
            <!-- Arrow between steps (mobile) -->
            <div v-if="index < osFlowSteps.length - 1" class="hidden sm:block lg:hidden mt-4 text-axion-300">
              <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
            </div>
          </Card>
        </div>

        <!-- Mobile arrows -->
        <div class="lg:hidden flex justify-between px-4 mt-8 text-axion-300">
          <div v-for="i in 5" :key="i" class="w-1/6">
            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
          </div>
        </div>
      </div>
    </Section>

    <!-- Documents Section -->
    <Section id="documentos" class="bg-axion-50 dark:bg-axion-900/30" aria-label="Documentos profissionais">
      <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-axion-900 dark:text-white mb-4">
          Transforme seus serviços em
          <br />
          <span class="text-axion-600 dark:text-axion-400">documentos profissionais.</span>
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6" data-animate>
        <Card v-for="(doc, index) in documentTypes" :key="index" variant="outlined" padding="lg" class="text-center hover:border-axion-300 dark:hover:border-axion-700 hover:shadow-lg transition-all duration-300 group">
          <div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-axion-100 dark:bg-axion-800/50 flex items-center justify-center group-hover:bg-axion-600 group-hover:text-white transition-all duration-300">
            <component :is="getIcon(doc.icon)" class="w-7 h-7 text-axion-600 dark:text-axion-400 group-hover:text-white" />
          </div>
          <h3 class="font-semibold text-axion-900 dark:text-white mb-2">{{ doc.title }}</h3>
          <p class="text-sm text-axion-600 dark:text-axion-400">{{ doc.description }}</p>
        </Card>
      </div>
    </Section>

    <!-- Customization Section -->
    <Section id="personalizacao" aria-label="Personalização">
      <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-axion-900 dark:text-white mb-4">
          Adapte o Axion ao
          <br />
          <span class="text-axion-600 dark:text-axion-400">seu jeito de trabalhar.</span>
        </h2>
        <p class="text-lg text-axion-600 dark:text-axion-300">Cada negócio é único. O Axion oferece flexibilidade para moldar o sistema às suas necessidades.</p>
      </div>

      <div class="grid md:grid-cols-3 gap-8" data-animate>
        <Card v-for="(feature, index) in customizationFeatures" :key="index" variant="elevated" padding="xl" class="text-center">
          <div class="w-16 h-16 mx-auto mb-6 rounded-xl bg-axion-100 dark:bg-axion-800/50 flex items-center justify-center">
            <component :is="getIcon(feature.icon)" class="w-8 h-8 text-axion-600 dark:text-axion-400" />
          </div>
          <h3 class="text-xl font-semibold text-axion-900 dark:text-white mb-3">{{ feature.title }}</h3>
          <p class="text-axion-600 dark:text-axion-400 leading-relaxed">{{ feature.description }}</p>
        </Card>
      </div>
    </Section>

    <!-- Dashboard Section -->
    <Section id="dashboard" aria-label="Dashboard do Axion">
      <div class="text-center max-w-3xl mx-auto mb-12" data-animate>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-axion-900 dark:text-white mb-4">
          Tenha sua empresa na
          <br />
          <span class="text-axion-600 dark:text-axion-400">palma da mão.</span>
        </h2>
        <p class="text-lg text-axion-600 dark:text-axion-300">Uma visão clara do que está acontecendo para você tomar decisões melhores.</p>
      </div>

      <!-- Dashboard Mockup -->
      <div data-animate>
        <Card variant="elevated" padding="none" class="overflow-hidden border border-axion-200 dark:border-axion-800">
          <!-- Header -->
          <div class="bg-axion-900 dark:bg-axion-800 px-6 py-4 border-b border-axion-800 dark:border-axion-700 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-lg bg-axion-600/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-axion-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
              </div>
              <div>
                <p class="font-semibold text-white">Dashboard Executivo</p>
                <p class="text-xs text-axion-400">Visão geral em tempo real</p>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <select class="bg-axion-800 border border-axion-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-axion-500">
                <option>Últimos 30 dias</option>
                <option>Últimos 7 dias</option>
                <option>Últimos 90 dias</option>
                <option>Este ano</option>
              </select>
              <Button variant="ghost" size="sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
              </Button>
            </div>
          </div>

          <!-- Metrics Grid -->
          <div class="p-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <div v-for="(metric, index) in dashboardMetrics" :key="index" class="bg-axion-50 dark:bg-axion-800/50 rounded-xl p-4 border border-axion-200 dark:border-axion-700">
              <p class="text-xs font-medium text-axion-500 dark:text-axion-400 uppercase tracking-wider mb-2">{{ metric.label }}</p>
              <p class="text-2xl md:text-3xl font-bold text-axion-900 dark:text-white mb-1">{{ metric.value }}</p>
              <p class="text-xs flex items-center gap-1" :class="metric.trend === 'up' ? 'text-green-600 dark:text-green-400' : metric.trend === 'down' ? 'text-red-600 dark:text-red-400' : 'text-axion-500 dark:text-axion-400'">
                <svg v-if="metric.trend === 'up'" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                <svg v-else-if="metric.trend === 'down'" class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                <svg v-else class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" /></svg>
                {{ metric.change }}
              </p>
            </div>
          </div>

          <!-- Charts Area -->
          <div class="px-6 pb-6">
            <div class="grid lg:grid-cols-2 gap-6">
              <!-- Revenue Chart -->
              <Card variant="outlined" padding="lg">
                <h4 class="font-semibold text-axion-900 dark:text-white mb-4 flex items-center justify-between">
                  Faturamento (últimos 30 dias)
                  <span class="text-xs text-axion-500 dark:text-axion-400">+12,5%</span>
                </h4>
                <div class="h-48 relative" style="width: 100%">
                  <svg viewBox="0 0 400 200" class="w-full h-full" aria-hidden="true">
                    <defs>
                      <linearGradient id="revenueGradient" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#2563eb" stop-opacity="0.3" />
                        <stop offset="100%" stop-color="#2563eb" stop-opacity="0" />
                      </linearGradient>
                    </defs>
                    <!-- Grid lines -->
                    <g stroke="#e5e7eb" stroke-width="0.5" stroke-dasharray="4,4">
                      <line v-for="i in 4" :key="i" x1="0" :y1="i * 40 + 20" x2="400" :y2="i * 40 + 20" />
                    </g>
                    <!-- Area chart -->
                    <path d="M0,180 L40,140 L80,160 L120,120 L160,100 L200,90 L240,80 L280,70 L320,65 L360,60 L400,55" fill="url(#revenueGradient)" stroke="#2563eb" stroke-width="2" fill-opacity="0.4" />
                    <!-- Line -->
                    <path d="M0,180 L40,140 L80,160 L120,120 L160,100 L200,90 L240,80 L280,70 L320,65 L360,60 L400,55" fill="none" stroke="#2563eb" stroke-width="2.5" />
                    <!-- Points -->
                    <circle v-for="(point, i) in [180,140,160,120,100,90,80,70,65,60,55]" :key="i" :cx="i * 40" :cy="point" r="4" fill="#2563eb" stroke="white" stroke-width="2" />
                  </svg>
                </div>
              </Card>

              <!-- OS Status Chart -->
              <Card variant="outlined" padding="lg">
                <h4 class="font-semibold text-axion-900 dark:text-white mb-4">Status das OS</h4>
                <div class="h-48 relative" style="width: 100%">
                  <svg viewBox="0 0 400 200" class="w-full h-full" aria-hidden="true">
                    <!-- Donut chart -->
                    <g transform="translate(200, 100)">
                      <!-- Background circle -->
                      <circle cx="0" cy="0" r="70" fill="none" stroke="#e5e7eb" stroke-width="28" />
                      <!-- Completed -->
                      <circle cx="0" cy="0" r="70" fill="none" stroke="#22c55e" stroke-width="28" stroke-dasharray="439.8" stroke-dashoffset="439.8 * 0.4" transform="rotate(-90)" stroke-linecap="round" />
                      <!-- In progress -->
                      <circle cx="0" cy="0" r="70" fill="none" stroke="#3b82f6" stroke-width="28" stroke-dasharray="439.8" stroke-dashoffset="439.8 * 0.75" transform="rotate(-90)" stroke-linecap="round" />
                      <!-- Open -->
                      <circle cx="0" cy="0" r="70" fill="none" stroke="#f59e0b" stroke-width="28" stroke-dasharray="439.8" stroke-dashoffset="439.8 * 0.9" transform="rotate(-90)" stroke-linecap="round" />
                    </g>
                    <!-- Legend -->
                    <g transform="translate(50, 140)">
                      <g v-for="(item, i) in [
                        { color: '#22c55e', label: 'Concluídas (156)' },
                        { color: '#3b82f6', label: 'Em andamento (18)' },
                        { color: '#f59e0b', label: 'Abertas (23)' },
                      ]" :key="i" :transform="`translate(0, ${i * 24})`">
                        <rect x="0" y="0" width="12" height="12" :fill="item.color" rx="2" />
                        <text x="20" y="10" fill="#6b7280" font-size="12" font-family="Inter, system-ui">{{ item.label }}</text>
                      </g>
                    </g>
                  </svg>
                </div>
              </Card>
            </div>
          </div>
        </Card>
      </div>
    </Section>

    <!-- Target Audience Section -->
    <Section id="para-quem" aria-label="Para quem é o Axion">
      <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-axion-900 dark:text-white mb-4">
          Feito para quem
          <br />
          <span class="text-axion-600 dark:text-axion-400">trabalha com serviços.</span>
        </h2>
        <p class="text-lg text-axion-600 dark:text-axion-300 mb-8">Se sua empresa trabalha com serviços, o Axion foi feito para você.</p>
      </div>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6" data-animate>
        <Card v-for="(audience, index) in audiences" :key="index" variant="outlined" padding="xl" class="hover:border-axion-300 dark:hover:border-axion-700 hover:shadow-lg transition-all duration-300 group">
          <div class="w-14 h-14 rounded-xl bg-axion-100 dark:bg-axion-800/50 flex items-center justify-center mb-4 group-hover:bg-axion-600 group-hover:text-white transition-all duration-300">
            <component :is="getIcon(audience.icon)" class="w-7 h-7 text-axion-600 dark:text-axion-400 group-hover:text-white" />
          </div>
          <h3 class="text-lg font-semibold text-axion-900 dark:text-white mb-2">{{ audience.title }}</h3>
          <p class="text-axion-600 dark:text-axion-400 text-sm leading-relaxed">{{ audience.description }}</p>
        </Card>
      </div>
    </Section>

    <!-- Benefits Section -->
    <Section className="bg-axion-900 dark:bg-axion-950" aria-label="Benefícios">
      <div class="text-center max-w-3xl mx-auto mb-16" data-animate>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-white mb-4">
          Resultados que
          <br />
          <span class="text-axion-400">fazem a diferença.</span>
        </h2>
        <p class="text-lg text-axion-300">Empresas que adotam o Axion experimentam transformação real na operação.</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6" data-animate>
        <div v-for="(benefit, index) in benefits" :key="index" class="text-center p-4">
          <div class="w-14 h-14 mx-auto mb-4 rounded-xl bg-axion-800/50 flex items-center justify-center border border-axion-700">
            <svg class="w-7 h-7 text-axion-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
          </div>
          <p class="font-medium text-white text-sm">{{ benefit }}</p>
        </div>
      </div>
    </Section>

    <!-- Final CTA -->
    <Section id="cta-final" class="relative overflow-hidden" aria-label="Call to action final">
      <div class="absolute inset-0 bg-gradient-to-br from-axion-600 via-axion-700 to-axion-900" />
      <div class="absolute inset-0 bg-[url('/pattern.svg')] opacity-20" />
      
      <div class="relative max-w-4xl mx-auto text-center px-6" data-animate>
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 mb-6 text-sm font-medium text-white backdrop-blur-sm">
          <span class="relative flex h-2 w-2">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-400"></span>
          </span>
          Mais de 500 empresas já usam o Axion
        </div>
        
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-white mb-6">
          Sua empresa merece uma
          <br />
          <span class="text-axion-300">gestão mais inteligente.</span>
        </h2>
        
        <p class="text-lg md:text-xl text-axion-200 mb-10 max-w-2xl mx-auto">
          Deixe processos manuais para trás e tenha tudo o que precisa para administrar seus serviços em um só lugar.
        </p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
          <Button size="lg" variant="secondary" class="w-full sm:w-auto bg-white text-axion-900 hover:bg-axion-100 group px-10 py-4">
            Começar agora
            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
          </Button>
          <Button size="lg" variant="outline" class="w-full sm:w-auto border-white text-white hover:bg-white/10 px-10 py-4">Agendar demonstração</Button>
        </div>

        <p class="mt-8 text-axion-400 text-sm">
          Configuração em minutos · Suporte em português · Cancelamento a qualquer momento
        </p>
      </div>
    </Section>

    <!-- Footer -->
    <footer class="bg-axion-950 dark:bg-axion-950 border-t border-axion-800" aria-label="Rodapé">
      <div class="py-16 lg:py-24">
        <div class="grid grid-cols-2 md:grid-cols-6 gap-8 lg:gap-12 mb-12">
          <!-- Brand -->
          <div class="col-span-2 lg:col-span-2">
            <div class="flex items-center gap-2 mb-4">
              <AxionLogo size="xl" variant="light" />
              <span class="font-semibold text-2xl text-white">Axion</span>
            </div>
            <p class="text-axion-400 text-sm leading-relaxed max-w-xs mb-6">
              Plataforma de gestão completa para empresas de assistência técnica, oficinas e serviços. Organize, controle e cresça.
            </p>
            <div class="flex items-center gap-4">
              <a href="#" class="text-axion-500 hover:text-white transition-colors" aria-label="LinkedIn">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
              </a>
              <a href="#" class="text-axion-500 hover:text-white transition-colors" aria-label="Twitter">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
              </a>
              <a href="#" class="text-axion-500 hover:text-white transition-colors" aria-label="GitHub">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
              </a>
              <a href="#" class="text-axion-500 hover:text-white transition-colors" aria-label="YouTube">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
              </a>
            </div>
          </div>

          <!-- Produto -->
          <nav>
            <h4 class="font-semibold text-white mb-4">Produto</h4>
            <ul class="space-y-3" role="list">
              <li v-for="link in footerLinks.produto" :key="link.label">
                <a :href="link.href" class="text-axion-400 hover:text-white transition-colors text-sm">{{ link.label }}</a>
              </li>
            </ul>
          </nav>

          <!-- Empresa -->
          <nav>
            <h4 class="font-semibold text-white mb-4">Empresa</h4>
            <ul class="space-y-3" role="list">
              <li v-for="link in footerLinks.empresa" :key="link.label">
                <a :href="link.href" class="text-axion-400 hover:text-white transition-colors text-sm">{{ link.label }}</a>
              </li>
            </ul>
          </nav>

          <!-- Suporte -->
          <nav>
            <h4 class="font-semibold text-white mb-4">Suporte</h4>
            <ul class="space-y-3" role="list">
              <li v-for="link in footerLinks.suporte" :key="link.label">
                <a :href="link.href" class="text-axion-400 hover:text-white transition-colors text-sm">{{ link.label }}</a>
              </li>
            </ul>
          </nav>

          <!-- Legal -->
          <nav>
            <h4 class="font-semibold text-white mb-4">Legal</h4>
            <ul class="space-y-3" role="list">
              <li v-for="link in footerLinks.legal" :key="link.label">
                <a :href="link.href" class="text-axion-400 hover:text-white transition-colors text-sm">{{ link.label }}</a>
              </li>
            </ul>
          </nav>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-8 border-t border-axion-800 flex flex-col md:flex-row items-center justify-between gap-4">
          <p class="text-axion-500 text-sm">© 2024 Axion. Todos os direitos reservados.</p>
          <div class="flex items-center gap-6 text-sm text-axion-500">
            <span>Feito com dedicação para empresas brasileiras</span>
            <a href="#" class="hover:text-white transition-colors">Privacidade</a>
            <a href="#" class="hover:text-white transition-colors">Termos</a>
            <a href="#" class="hover:text-white transition-colors">Cookies</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>
@keyframes fade-in-up {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-up {
  animation: fade-in-up 0.6s ease-out forwards;
}

[data-animate] {
  opacity: 0;
}

[data-animate].animate-in {
  animation: fade-in-up 0.6s ease-out forwards;
}

/* Staggered animation delays for grid items */
[data-animate].animate-in:nth-child(1) { animation-delay: 100ms; }
[data-animate].animate-in:nth-child(2) { animation-delay: 200ms; }
[data-animate].animate-in:nth-child(3) { animation-delay: 300ms; }
[data-animate].animate-in:nth-child(4) { animation-delay: 400ms; }
[data-animate].animate-in:nth-child(5) { animation-delay: 500ms; }
[data-animate].animate-in:nth-child(6) { animation-delay: 600ms; }
[data-animate].animate-in:nth-child(7) { animation-delay: 700ms; }
[data-animate].animate-in:nth-child(8) { animation-delay: 800ms; }

/* Smooth scrolling */
html {
  scroll-behavior: smooth;
}

/* Focus visible styles */
*:focus-visible {
  outline: 2px solid #2563eb;
  outline-offset: 2px;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-track {
  background: transparent;
}

::-webkit-scrollbar-thumb {
  background: #94a3b8;
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: #64748b;
}

.dark ::-webkit-scrollbar-thumb {
  background: #475569;
}

.dark ::-webkit-scrollbar-thumb:hover {
  background: #64748b;
}
</style>