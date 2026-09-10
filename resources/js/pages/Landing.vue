<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import type { DefineComponent } from 'vue';
import AxionLogo from '@/components/brand/AxionLogo.vue';
import * as Icons from '@/components/icons';
import Button from '@/components/ui/Button.vue';
import Card from '@/components/ui/Card.vue';
import Section from '@/components/ui/Section.vue';

// Icon component type for dynamic component resolution
const iconComponents = Icons as unknown as Record<string, DefineComponent>;

// Helper to get icon component
function getIcon(name: string): DefineComponent {
    return iconComponents[
        `Icon${name.charAt(0).toUpperCase() + name.slice(1)}`
    ];
}

// Intersection Observer for scroll animations
const observer = ref<IntersectionObserver | null>(null);
const prefersReducedMotion = ref(false);

onMounted(() => {
    prefersReducedMotion.value = window.matchMedia(
        '(prefers-reduced-motion: reduce)',
    ).matches;

    if (prefersReducedMotion.value) {
        document.querySelectorAll('[data-animate]').forEach((el) => {
            el.classList.add('animate-in');
        });

        return;
    }

    observer.value = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    observer.value?.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.1, rootMargin: '0px 0px -50px 0px' },
    );

    document.querySelectorAll('[data-animate]').forEach((el) => {
        observer.value?.observe(el);
    });
});

onUnmounted(() => {
    observer.value?.disconnect();
});

// Mock data for features
const features = [
    {
        title: 'Clientes',
        description:
            'CRM completo com histórico de atendimentos, serviços e relacionamento.',
        icon: 'users',
    },
    {
        title: 'Equipamentos',
        description:
            'Controle de equipamentos, números de série, garantia e histórico de manutenção.',
        icon: 'cpu',
    },
    {
        title: 'Ordens de Serviço',
        description:
            'Crie, acompanhe, atribua e finalize ordens de serviço com facilidade.',
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
        description:
            'Acompanhe entradas, saídas, movimentações e níveis de estoque.',
        icon: 'warehouse',
    },
    {
        title: 'Vendas',
        description:
            'Gerencie vendas e gere documentos relacionados às operações.',
        icon: 'shopping-cart',
    },
    {
        title: 'Documentos',
        description:
            'Gere orçamentos, recibos, certificados de garantia e relatórios técnicos.',
        icon: 'file-text',
    },
];

// Trust categories
const trustCategories = [
    'Assistências técnicas',
    'Oficinas',
    'Manutenção',
    'Serviços especializados',
    'Empresas de reparo',
];

// OS Flow steps
const osFlowSteps = [
    {
        step: 'Entrada',
        description: 'Recepção do equipamento e cadastro inicial',
        icon: 'inbox',
    },
    {
        step: 'Diagnóstico',
        description: 'Análise técnica e identificação do problema',
        icon: 'search',
    },
    {
        step: 'Orçamento',
        description: 'Elaboração e envio do orçamento ao cliente',
        icon: 'calculator',
    },
    {
        step: 'Aprovação',
        description: 'Aprovação do cliente e autorização do serviço',
        icon: 'check-circle',
    },
    {
        step: 'Execução',
        description: 'Realização do serviço e acompanhamento',
        icon: 'hammer',
    },
    {
        step: 'Finalização',
        description: 'Entrega, pagamento e geração de documentos',
        icon: 'package-check',
    },
];

// Document types
const documentTypes = [
    {
        title: 'Orçamento',
        description: 'Orçamentos profissionais com validade e termos',
        icon: 'file-text',
    },
    {
        title: 'Ordem de Serviço',
        description: 'OS detalhada com checklist e assinaturas',
        icon: 'clipboard-list',
    },
    {
        title: 'Recibo',
        description: 'Recibos de pagamento e comprovantes',
        icon: 'receipt',
    },
    {
        title: 'Certificado de Garantia',
        description: 'Certificados personalizados por equipamento',
        icon: 'shield-check',
    },
    {
        title: 'Relatório Técnico',
        description: 'Relatórios técnicos detalhados com fotos',
        icon: 'file-chart',
    },
];

// Customization features
const customizationFeatures = [
    {
        title: 'Checklists personalizados',
        description: 'Crie checklists específicos para cada tipo de serviço.',
        icon: 'clipboard-check',
    },
    {
        title: 'Campos personalizados',
        description:
            'Adicione as informações que fazem sentido para o seu negócio.',
        icon: 'database',
    },
    {
        title: 'Anexos',
        description:
            'Fotos, documentos e arquivos vinculados diretamente aos registros.',
        icon: 'paperclip',
    },
];

// Dashboard metrics
const dashboardMetrics = [
    {
        label: 'Faturamento',
        value: 'R$ 127.450',
        change: '+12.5%',
        trend: 'up',
    },
    {
        label: 'OS Abertas',
        value: '23',
        change: '5 novas hoje',
        trend: 'neutral',
    },
    {
        label: 'OS em Andamento',
        value: '18',
        change: '3 finalizadas',
        trend: 'up',
    },
    {
        label: 'OS Concluídas',
        value: '156',
        change: '+8% vs mês passado',
        trend: 'up',
    },
    { label: 'Vendas', value: 'R$ 89.200', change: '+15.2%', trend: 'up' },
    {
        label: 'Estoque Baixo',
        value: '7 itens',
        change: 'Requer atenção',
        trend: 'down',
    },
];

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
];

// Benefits
const benefits = [
    'Mais organização',
    'Mais produtividade',
    'Menos retrabalho',
    'Histórico completo',
    'Processos padronizados',
    'Informações centralizadas',
];

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
};

// OS List data
const osList = [
    {
        id: '#OS-2024-001',
        client: 'João Silva',
        equipment: 'Notebook Dell XPS',
        status: 'diagnostico',
        value: 'R$ 450,00',
    },
    {
        id: '#OS-2024-002',
        client: 'Maria Santos',
        equipment: 'iPhone 14 Pro',
        status: 'orcamento',
        value: 'R$ 890,00',
    },
    {
        id: '#OS-2024-003',
        client: 'Carlos Oliveira',
        equipment: 'Impressora HP',
        status: 'execucao',
        value: 'R$ 320,00',
    },
    {
        id: '#OS-2024-004',
        client: 'Ana Costa',
        equipment: 'Monitor LG 27',
        status: 'finalizada',
        value: 'R$ 1.200,00',
    },
    {
        id: '#OS-2024-005',
        client: 'Pedro Lima',
        equipment: 'Placa de vídeo RTX 4080',
        status: 'aprovacao',
        value: 'R$ 2.100,00',
    },
];

// Equipment info fields
const equipmentFields = [
    { label: 'Cliente', value: 'João Silva' },
    { label: 'Equipamento', value: 'Notebook' },
    { label: 'Marca', value: 'Apple' },
    { label: 'Modelo', value: 'MacBook Pro 16 M3' },
    { label: 'Número de Série', value: 'C02XY123ABCD' },
    { label: 'Garantia', value: 'Até 15/03/2026' },
];

// Service history data
const serviceHistory = [
    {
        date: '12/01/2024',
        title: 'Troca de tela',
        status: 'Concluída',
        os: '#OS-2024-089',
    },
    {
        date: '05/11/2023',
        title: 'Limpeza interna e pasta térmica',
        status: 'Concluída',
        os: '#OS-2023-245',
    },
    {
        date: '22/07/2023',
        title: 'Substituição de bateria',
        status: 'Concluída',
        os: '#OS-2023-156',
    },
    {
        date: '10/03/2023',
        title: 'Diagnóstico inicial',
        status: 'Concluída',
        os: '#OS-2023-045',
    },
];
</script>

<template>
    <Head title="Axion - Gestão inteligente para negócios que fazem acontecer">
        <meta
            name="description"
            content="Plataforma de gestão completa para assistências técnicas, oficinas e empresas de serviços. Clientes, equipamentos, ordens de serviço, estoque, vendas e documentos em um só lugar."
        />
        <meta
            property="og:title"
            content="Axion - Gestão inteligente para negócios que fazem acontecer"
        />
        <meta
            property="og:description"
            content="Centralize clientes, equipamentos, ordens de serviço, estoque, vendas e documentos em uma plataforma única."
        />
        <meta property="og:type" content="website" />
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>

    <div
        class="min-h-screen bg-white font-sans text-axion-900 antialiased dark:bg-axion-950 dark:text-axion-100"
    >
        <!-- Navigation -->
        <nav
            class="fixed top-0 right-0 left-0 z-50 border-b border-axion-200/50 bg-white/90 backdrop-blur-xl transition-all duration-300 dark:border-axion-800/50 dark:bg-axion-950/90"
            data-animate
        >
            <div class="mx-auto max-w-7xl px-4 md:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-2">
                        <AxionLogo size="lg" />
                        <span
                            class="hidden text-xl font-semibold text-axion-900 sm:block dark:text-white"
                            >Axion</span
                        >
                    </div>
                    <div class="hidden items-center gap-1 md:flex">
                        <a
                            href="#funcionalidades"
                            class="rounded-lg px-3 py-2 text-sm font-medium text-axion-600 transition-all duration-200 hover:bg-axion-100 hover:text-axion-900 dark:text-axion-400 dark:hover:bg-axion-800/50 dark:hover:text-white"
                            >Funcionalidades</a
                        >
                        <a
                            href="#para-quem"
                            class="rounded-lg px-3 py-2 text-sm font-medium text-axion-600 transition-all duration-200 hover:bg-axion-100 hover:text-axion-900 dark:text-axion-400 dark:hover:bg-axion-800/50 dark:hover:text-white"
                            >Para quem é</a
                        >
                        <a
                            href="#precos"
                            class="rounded-lg px-3 py-2 text-sm font-medium text-axion-600 transition-all duration-200 hover:bg-axion-100 hover:text-axion-900 dark:text-axion-400 dark:hover:bg-axion-800/50 dark:hover:text-white"
                            >Preços</a
                        >
                        <a
                            href="#contato"
                            class="rounded-lg px-3 py-2 text-sm font-medium text-axion-600 transition-all duration-200 hover:bg-axion-100 hover:text-axion-900 dark:text-axion-400 dark:hover:bg-axion-800/50 dark:hover:text-white"
                            >Contato</a
                        >
                    </div>
                    <div class="flex items-center gap-3">
                        <Button
                            variant="ghost"
                            size="sm"
                            class="hidden sm:inline-flex"
                            >Entrar</Button
                        >
                        <Button size="sm" class="shadow-sm hover:shadow-md"
                            >Começar agora</Button
                        >
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <Section
            id="hero"
            class="relative overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-28"
            aria-label="Hero"
        >
            <!-- Background decoration -->
            <div class="absolute inset-0 -z-10">
                <div
                    class="absolute top-20 left-1/4 h-72 w-72 rounded-full bg-axion-500/10 blur-3xl"
                    aria-hidden="true"
                ></div>
                <div
                    class="absolute right-1/4 bottom-20 h-72 w-72 rounded-full bg-axion-600/10 blur-3xl"
                    aria-hidden="true"
                ></div>
                <div
                    class="absolute top-1/2 left-1/2 h-[600px] w-[600px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-r from-axion-500/5 via-transparent to-axion-600/5 blur-3xl"
                    aria-hidden="true"
                ></div>
            </div>

            <div
                class="relative z-10 grid items-center gap-12 lg:grid-cols-2 lg:gap-16"
            >
                <div class="text-center lg:text-left" data-animate>
                    <div
                        class="animate-fade-in-up mb-6 inline-flex items-center gap-2 rounded-full border border-axion-200/50 bg-white/80 px-4 py-2 text-sm font-medium text-axion-700 shadow-sm backdrop-blur-sm dark:border-axion-800/50 dark:bg-axion-900/80 dark:text-axion-300"
                    >
                        <span class="relative flex h-2 w-2">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-axion-500 opacity-75"
                            ></span>
                            <span
                                class="relative inline-flex h-2 w-2 rounded-full bg-axion-500"
                            ></span>
                        </span>
                        Novo: Dashboard financeiro avançado disponível
                    </div>
                    <h1
                        class="animate-fade-in-up mb-6 text-4xl font-bold tracking-tight text-axion-900 md:text-5xl lg:text-6xl dark:text-white"
                        style="animation-delay: 100ms"
                    >
                        Gestão inteligente para
                        <br />
                        <span
                            class="bg-gradient-to-r from-axion-600 via-axion-700 to-axion-800 bg-clip-text text-transparent"
                            >negócios que fazem acontecer.</span
                        >
                    </h1>
                    <p
                        class="animate-fade-in-up mx-auto mb-8 max-w-xl text-lg leading-relaxed text-axion-600 md:text-xl lg:mx-0 dark:text-axion-300"
                        style="animation-delay: 200ms"
                    >
                        Clientes, equipamentos, ordens de serviço, estoque,
                        vendas e documentos. Tudo o que sua empresa precisa para
                        organizar e crescer em um só lugar.
                    </p>
                    <div
                        class="animate-fade-in-up flex flex-col items-center justify-center gap-4 sm:flex-row lg:justify-start"
                        style="animation-delay: 300ms"
                    >
                        <Button
                            size="lg"
                            class="group w-full shadow-lg hover:shadow-xl sm:w-auto"
                        >
                            Começar agora
                            <svg
                                class="h-5 w-5 transition-transform group-hover:translate-x-1"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"
                                />
                            </svg>
                        </Button>
                        <Button
                            variant="outline"
                            size="lg"
                            class="w-full border-2 hover:bg-axion-50 sm:w-auto dark:hover:bg-axion-900/50"
                            >Conhecer o Axion</Button
                        >
                    </div>
                    <div
                        class="animate-fade-in-up mt-10 flex flex-wrap items-center justify-center gap-6 text-sm text-axion-500 lg:justify-start dark:text-axion-400"
                        style="animation-delay: 400ms"
                    >
                        <div class="flex items-center gap-2">
                            <span
                                class="flex h-5 w-5 items-center justify-center"
                            >
                                <svg
                                    class="h-5 w-5 text-axion-500"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </span>
                            <span>Sem cartão de crédito</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="flex h-5 w-5 items-center justify-center"
                            >
                                <svg
                                    class="h-5 w-5 text-axion-500"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </span>
                            <span>Teste grátis por 14 dias</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span
                                class="flex h-5 w-5 items-center justify-center"
                            >
                                <svg
                                    class="h-5 w-5 text-axion-500"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </span>
                            <span>Cancelamento a qualquer momento</span>
                        </div>
                    </div>
                </div>

                <!-- Product Mockup -->
                <div class="relative" data-animate>
                    <div
                        class="animate-mockup relative overflow-hidden rounded-2xl border border-axion-200 bg-white shadow-2xl dark:border-axion-800 dark:bg-axion-900"
                        style="
                            box-shadow:
                                0 25px 50px -12px rgb(15 23 42 / 0.15),
                                0 0 0 1px rgb(15 23 42 / 0.04),
                                inset 0 1px 0 rgb(255 255 255 / 0.8);
                        "
                    >
                        <!-- Mockup Header -->
                        <div
                            class="flex items-center gap-2 border-b border-axion-100 bg-axion-50/80 px-4 py-3 dark:border-axion-700 dark:bg-axion-800"
                        >
                            <div class="flex gap-1.5">
                                <div
                                    class="h-3 w-3 rounded-full bg-red-400"
                                ></div>
                                <div
                                    class="h-3 w-3 rounded-full bg-yellow-400"
                                ></div>
                                <div
                                    class="h-3 w-3 rounded-full bg-green-400"
                                ></div>
                            </div>
                            <div
                                class="flex-1 text-center font-mono text-xs text-axion-400 dark:text-axion-500"
                            >
                                app.axion.com.br / dashboard
                            </div>
                            <div
                                class="h-3 w-3 rounded-full bg-transparent"
                            ></div>
                        </div>

                        <!-- Mockup Content -->
                        <div
                            class="space-y-6 bg-axion-50/50 p-6 dark:bg-axion-950/50"
                        >
                            <!-- Top Stats Row -->
                            <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                                <div
                                    class="rounded-xl border border-axion-200 bg-white p-4 shadow-sm dark:border-axion-700 dark:bg-axion-800/50"
                                >
                                    <p
                                        class="mb-1 text-xs font-medium text-axion-500 dark:text-axion-400"
                                    >
                                        Faturamento do mês
                                    </p>
                                    <p
                                        class="text-2xl font-bold text-axion-900 dark:text-white"
                                    >
                                        R$ 127.450
                                    </p>
                                    <p
                                        class="mt-1 flex items-center gap-1 text-xs font-medium text-green-600 dark:text-green-400"
                                    >
                                        <svg
                                            class="h-3 w-3"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 10l7-7m0 0l7 7m-7-7v18"
                                            />
                                        </svg>
                                        +12,5%
                                    </p>
                                </div>
                                <div
                                    class="rounded-xl border border-axion-200 bg-white p-4 shadow-sm dark:border-axion-700 dark:bg-axion-800/50"
                                >
                                    <p
                                        class="mb-1 text-xs font-medium text-axion-500 dark:text-axion-400"
                                    >
                                        OS Abertas
                                    </p>
                                    <p
                                        class="text-2xl font-bold text-axion-900 dark:text-white"
                                    >
                                        23
                                    </p>
                                    <p
                                        class="mt-1 text-xs text-axion-500 dark:text-axion-400"
                                    >
                                        5 novas hoje
                                    </p>
                                </div>
                                <div
                                    class="rounded-xl border border-axion-200 bg-white p-4 shadow-sm dark:border-axion-700 dark:bg-axion-800/50"
                                >
                                    <p
                                        class="mb-1 text-xs font-medium text-axion-500 dark:text-axion-400"
                                    >
                                        OS em Andamento
                                    </p>
                                    <p
                                        class="text-2xl font-bold text-axion-900 dark:text-white"
                                    >
                                        18
                                    </p>
                                    <p
                                        class="mt-1 text-xs text-blue-600 dark:text-blue-400"
                                    >
                                        3 finalizadas
                                    </p>
                                </div>
                            </div>

                            <!-- Main Content Area -->
                            <div class="grid gap-4 lg:grid-cols-3">
                                <!-- Sidebar Navigation -->
                                <div class="space-y-2 lg:col-span-1">
                                    <nav
                                        class="space-y-1 rounded-xl border border-axion-200 bg-white p-2 shadow-sm dark:border-axion-700 dark:bg-axion-800/40"
                                    >
                                        <a
                                            href="#"
                                            class="flex items-center gap-3 rounded-lg bg-axion-600 px-3 py-2.5 text-sm font-medium text-white shadow-sm"
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                                                />
                                            </svg>
                                            Dashboard
                                        </a>
                                        <a
                                            href="#"
                                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-axion-600 transition-colors hover:bg-axion-100 hover:text-axion-900 dark:text-axion-400 dark:hover:bg-axion-800/50 dark:hover:text-white"
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                                />
                                            </svg>
                                            Ordens de Serviço
                                        </a>
                                        <a
                                            href="#"
                                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-axion-600 transition-colors hover:bg-axion-100 hover:text-axion-900 dark:text-axion-400 dark:hover:bg-axion-800/50 dark:hover:text-white"
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                                />
                                            </svg>
                                            Clientes
                                        </a>
                                        <a
                                            href="#"
                                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-axion-600 transition-colors hover:bg-axion-100 hover:text-axion-900 dark:text-axion-400 dark:hover:bg-axion-800/50 dark:hover:text-white"
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                                />
                                            </svg>
                                            Equipamentos
                                        </a>
                                        <a
                                            href="#"
                                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-axion-600 transition-colors hover:bg-axion-100 hover:text-axion-900 dark:text-axion-400 dark:hover:bg-axion-800/50 dark:hover:text-white"
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                                />
                                            </svg>
                                            Financeiro
                                        </a>
                                        <a
                                            href="#"
                                            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm text-axion-600 transition-colors hover:bg-axion-100 hover:text-axion-900 dark:text-axion-400 dark:hover:bg-axion-800/50 dark:hover:text-white"
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                            </svg>
                                            Configurações
                                        </a>
                                    </nav>
                                </div>

                                <!-- Main Content -->
                                <div class="space-y-4 lg:col-span-2">
                                    <!-- OS List -->
                                    <div
                                        class="overflow-hidden rounded-xl border border-axion-200 bg-white shadow-sm dark:border-axion-700 dark:bg-axion-950"
                                    >
                                        <div
                                            class="flex items-center justify-between border-b border-axion-100 px-4 py-3 dark:border-axion-700"
                                        >
                                            <h3
                                                class="text-sm font-semibold text-axion-900 dark:text-white"
                                            >
                                                Ordens de Serviço Recentes
                                            </h3>
                                            <Button
                                                variant="ghost"
                                                size="sm"
                                                class="text-xs text-axion-500 hover:text-axion-900 dark:text-axion-400 dark:hover:text-white"
                                                >Ver todas</Button
                                            >
                                        </div>
                                        <div
                                            class="divide-y divide-axion-100 dark:divide-axion-700"
                                        >
                                            <div
                                                v-for="(os, index) in osList"
                                                :key="index"
                                                class="px-4 py-3 transition-colors hover:bg-axion-50/60 dark:hover:bg-axion-900"
                                            >
                                                <div
                                                    class="flex items-center justify-between gap-4"
                                                >
                                                    <div class="min-w-0 flex-1">
                                                        <p
                                                            class="truncate text-sm font-medium text-axion-900 dark:text-white"
                                                        >
                                                            {{ os.id }} -
                                                            {{ os.client }}
                                                        </p>
                                                        <p
                                                            class="truncate text-xs text-axion-500 dark:text-axion-400"
                                                        >
                                                            {{ os.equipment }}
                                                        </p>
                                                    </div>
                                                    <div
                                                        class="flex items-center gap-3 whitespace-nowrap"
                                                    >
                                                        <span
                                                            :class="[
                                                                'rounded-full px-2.5 py-1 text-xs font-medium',
                                                                os.status ===
                                                                    'diagnostico' &&
                                                                    'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400',
                                                                os.status ===
                                                                    'orcamento' &&
                                                                    'bg-yellow-100 text-yellow-700 dark:bg-yellow-500/20 dark:text-yellow-400',
                                                                os.status ===
                                                                    'aprovacao' &&
                                                                    'bg-purple-100 text-purple-700 dark:bg-purple-500/20 dark:text-purple-400',
                                                                os.status ===
                                                                    'execucao' &&
                                                                    'bg-orange-100 text-orange-700 dark:bg-orange-500/20 dark:text-orange-400',
                                                                os.status ===
                                                                    'finalizada' &&
                                                                    'bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400',
                                                            ]"
                                                        >
                                                            {{
                                                                os.status ===
                                                                'diagnostico'
                                                                    ? 'Diagnóstico'
                                                                    : os.status ===
                                                                        'orcamento'
                                                                      ? 'Orçamento'
                                                                      : os.status ===
                                                                          'aprovacao'
                                                                        ? 'Aprovação'
                                                                        : os.status ===
                                                                            'execucao'
                                                                          ? 'Execução'
                                                                          : 'Finalizada'
                                                            }}
                                                        </span>
                                                        <span
                                                            class="font-mono text-sm font-semibold text-axion-900 dark:text-white"
                                                            >{{
                                                                os.value
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quick Actions -->
                                    <div class="grid grid-cols-2 gap-3">
                                        <Button
                                            variant="outline"
                                            class="h-24 flex-col gap-2 bg-axion-50/50 dark:bg-axion-800/30"
                                        >
                                            <svg
                                                class="h-6 w-6"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                                />
                                            </svg>
                                            <span class="font-medium"
                                                >Nova OS</span
                                            >
                                        </Button>
                                        <Button
                                            variant="outline"
                                            class="h-24 flex-col gap-2 bg-axion-50/50 dark:bg-axion-800/30"
                                        >
                                            <svg
                                                class="h-6 w-6"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"
                                                />
                                            </svg>
                                            <span class="font-medium"
                                                >Novo Cliente</span
                                            >
                                        </Button>
                                        <Button
                                            variant="outline"
                                            class="h-24 flex-col gap-2 bg-axion-50/50 dark:bg-axion-800/30"
                                        >
                                            <svg
                                                class="h-6 w-6"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                                />
                                            </svg>
                                            <span class="font-medium"
                                                >Novo Equipamento</span
                                            >
                                        </Button>
                                        <Button
                                            variant="outline"
                                            class="h-24 flex-col gap-2 bg-axion-50/50 dark:bg-axion-800/30"
                                        >
                                            <svg
                                                class="h-6 w-6"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                />
                                            </svg>
                                            <span class="font-medium"
                                                >Novo Documento</span
                                            >
                                        </Button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating indicator -->
                    <div
                        class="animate-float-badge absolute -bottom-6 -left-6 rounded-xl border border-axion-200 bg-white p-4 shadow-2xl md:-left-8 md:p-6 lg:-left-10 dark:border-axion-800 dark:bg-axion-900"
                    >
                        <div class="flex items-center gap-3 md:gap-4">
                            <div
                                class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-axion-500 to-axion-700 md:h-14 md:w-14"
                            >
                                <svg
                                    class="h-6 w-6 text-white md:h-7 md:w-7"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <p
                                    class="text-sm font-medium text-axion-900 dark:text-white"
                                >
                                    Faturamento em tempo real
                                </p>
                                <p
                                    class="text-2xl font-bold text-axion-900 md:text-3xl dark:text-white"
                                >
                                    R$ 127.450
                                </p>
                                <p
                                    class="mt-1 flex items-center gap-1 text-xs text-green-600 dark:text-green-400"
                                >
                                    <svg
                                        class="h-3 w-3"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18"
                                        />
                                    </svg>
                                    +12,5% vs mês anterior
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Section>

        <!-- Trust Bar -->
        <Section
            class="border-y border-axion-200/50 bg-axion-50 py-16 dark:border-axion-800/50 dark:bg-axion-900/50"
            aria-label="Empresas que confiam"
        >
            <div class="mb-12 text-center" data-animate>
                <p
                    class="text-sm font-medium tracking-wider text-axion-600 uppercase dark:text-axion-400"
                >
                    Feito para empresas que trabalham com serviços
                </p>
            </div>
            <div
                class="flex flex-wrap items-center justify-center gap-6 text-sm font-medium text-axion-500 md:gap-10 dark:text-axion-400"
                data-animate
            >
                <span
                    v-for="(category, index) in trustCategories"
                    :key="index"
                    class="flex items-center gap-2 rounded-lg border border-axion-200/50 bg-white/50 px-4 py-2 transition-all duration-200 hover:border-axion-300 hover:bg-white hover:shadow-md dark:border-axion-700/50 dark:bg-axion-800/50 dark:hover:border-axion-600 dark:hover:bg-axion-800"
                >
                    <svg
                        class="h-4 w-4 text-axion-400"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"
                        />
                    </svg>
                    {{ category }}
                </span>
            </div>
        </Section>

        <!-- Features Section -->
        <Section id="funcionalidades" aria-label="Funcionalidades">
            <div class="mx-auto mb-16 max-w-3xl text-center" data-animate>
                <h2
                    class="mb-4 text-3xl font-bold tracking-tight text-axion-900 md:text-4xl lg:text-5xl dark:text-white"
                >
                    Do atendimento à entrega,
                    <br />
                    <span class="text-axion-600 dark:text-axion-400"
                        >tudo conectado.</span
                    >
                </h2>
                <p class="text-lg text-axion-600 dark:text-axion-300">
                    Centralize toda a operação da sua empresa em uma plataforma
                    única, integrada e feita para quem presta serviços.
                </p>
            </div>

            <div
                class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4"
                data-animate
            >
                <Card
                    v-for="(feature, index) in features"
                    :key="index"
                    variant="outlined"
                    padding="lg"
                    class="group h-full transition-all duration-300 hover:border-axion-400 hover:shadow-xl dark:hover:border-axion-600"
                >
                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-axion-100 to-axion-200 transition-all duration-300 group-hover:from-axion-500 group-hover:to-axion-600 group-hover:text-white dark:from-axion-800/50 dark:to-axion-700/50"
                    >
                        <component
                            :is="getIcon(feature.icon)"
                            class="h-6 w-6 text-axion-600 group-hover:text-white dark:text-axion-400"
                        />
                    </div>
                    <h3
                        class="mb-2 text-lg font-semibold text-axion-900 dark:text-white"
                    >
                        {{ feature.title }}
                    </h3>
                    <p
                        class="text-sm leading-relaxed text-axion-600 dark:text-axion-400"
                    >
                        {{ feature.description }}
                    </p>
                </Card>
            </div>
        </Section>

        <!-- Equipment Section -->
        <Section
            id="equipamentos"
            class="bg-axion-50 dark:bg-axion-900/30"
            aria-label="Gestão de equipamentos"
        >
            <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
                <div data-animate>
                    <h2
                        class="mb-6 text-3xl font-bold tracking-tight text-axion-900 md:text-4xl lg:text-5xl dark:text-white"
                    >
                        Conheça o histórico de
                        <br />
                        <span class="text-axion-600 dark:text-axion-400"
                            >cada equipamento.</span
                        >
                    </h2>
                    <p class="mb-8 text-lg text-axion-600 dark:text-axion-300">
                        Saiba exatamente o que aconteceu com cada equipamento
                        desde o primeiro atendimento. Histórico completo,
                        garantias, anexos e muito mais.
                    </p>
                    <ul class="space-y-4" role="list">
                        <li
                            v-for="(item, index) in [
                                'Cliente e informações de contato',
                                'Equipamento, marca, modelo e número de série',
                                'Status de garantia e vigência',
                                'Histórico completo de serviços realizados',
                                'Ordens de serviço anteriores vinculadas',
                                'Anexos, fotos e documentos técnicos',
                            ]"
                            :key="index"
                            class="flex items-start gap-3 text-axion-600 dark:text-axion-300"
                        >
                            <svg
                                class="mt-0.5 h-5 w-5 flex-shrink-0 text-axion-500"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <span>{{ item }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Equipment Mockup -->
                <div data-animate>
                    <Card
                        variant="elevated"
                        padding="none"
                        class="overflow-hidden border border-axion-200 dark:border-axion-800"
                    >
                        <div
                            class="flex items-center justify-between border-b border-axion-800 bg-axion-900 px-6 py-4 dark:border-axion-700 dark:bg-axion-800"
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-lg bg-axion-600/20"
                                >
                                    <svg
                                        class="h-5 w-5 text-axion-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                        />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white">
                                        MacBook Pro 16" M3
                                    </p>
                                    <p class="text-xs text-axion-400">
                                        EQP-2024-0142 • João Silva
                                    </p>
                                </div>
                            </div>
                            <span
                                class="rounded-full bg-green-500/20 px-3 py-1 text-xs font-medium text-green-400"
                                >Em garantia</span
                            >
                        </div>

                        <div
                            class="max-h-[500px] space-y-6 overflow-y-auto p-6"
                        >
                            <!-- Info Grid -->
                            <div class="grid grid-cols-2 gap-4">
                                <div
                                    v-for="(field, index) in equipmentFields"
                                    :key="index"
                                    class="rounded-xl bg-axion-50 p-4 dark:bg-axion-800/50"
                                >
                                    <p
                                        class="mb-1 text-xs font-medium tracking-wider text-axion-500 uppercase dark:text-axion-400"
                                    >
                                        {{ field.label }}
                                    </p>
                                    <p
                                        class="font-medium text-axion-900 dark:text-white"
                                    >
                                        {{ field.value }}
                                    </p>
                                </div>
                            </div>

                            <!-- Service History -->
                            <div>
                                <h4
                                    class="mb-4 flex items-center gap-2 font-semibold text-axion-900 dark:text-white"
                                >
                                    <svg
                                        class="h-5 w-5 text-axion-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                    Histórico de Serviços
                                </h4>
                                <div
                                    class="space-y-3 border-l-2 border-axion-200 pl-4 dark:border-axion-800"
                                >
                                    <div
                                        v-for="(
                                            service, index
                                        ) in serviceHistory"
                                        :key="index"
                                        class="relative before:absolute before:top-1/2 before:left-[-8px] before:h-2 before:w-2 before:-translate-y-1/2 before:rounded-full before:bg-axion-500"
                                    >
                                        <div
                                            class="flex items-start justify-between gap-4"
                                        >
                                            <div>
                                                <p
                                                    class="text-sm font-medium text-axion-900 dark:text-white"
                                                >
                                                    {{ service.title }}
                                                </p>
                                                <p
                                                    class="text-xs text-axion-500 dark:text-axion-400"
                                                >
                                                    {{ service.os }} •
                                                    {{ service.date }}
                                                </p>
                                            </div>
                                            <span
                                                class="rounded-full bg-green-500/20 px-2 py-0.5 text-xs font-medium whitespace-nowrap text-green-400"
                                                >{{ service.status }}</span
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Attachments -->
                            <div>
                                <h4
                                    class="mb-4 flex items-center gap-2 font-semibold text-axion-900 dark:text-white"
                                >
                                    <svg
                                        class="h-5 w-5 text-axion-500"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"
                                        />
                                    </svg>
                                    Anexos e Fotos
                                </h4>
                                <div class="grid grid-cols-3 gap-3">
                                    <div
                                        v-for="i in 3"
                                        :key="i"
                                        class="group relative flex aspect-square items-center justify-center overflow-hidden rounded-xl border border-axion-200 bg-axion-100 dark:border-axion-700 dark:bg-axion-800/50"
                                    >
                                        <svg
                                            class="h-8 w-8 text-axion-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>
                                        <div
                                            class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 transition-opacity group-hover:opacity-100"
                                        >
                                            <svg
                                                class="h-6 w-6 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                />
                                            </svg>
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
        <Section
            id="ordens-servico"
            class="relative overflow-hidden"
            aria-label="Fluxo de Ordens de Serviço"
        >
            <!-- Background decoration -->
            <div class="absolute inset-0 -z-10">
                <div
                    class="absolute top-0 right-1/4 h-72 w-72 rounded-full bg-axion-500/5 blur-3xl"
                    aria-hidden="true"
                ></div>
            </div>

            <div
                class="relative z-10 mx-auto mb-16 max-w-3xl text-center"
                data-animate
            >
                <h2
                    class="mb-4 text-3xl font-bold tracking-tight text-axion-900 md:text-4xl lg:text-5xl dark:text-white"
                >
                    Fluxo completo de
                    <br />
                    <span class="text-axion-600 dark:text-axion-400"
                        >Ordens de Serviço.</span
                    >
                </h2>
                <p class="mb-8 text-lg text-axion-600 dark:text-axion-300">
                    Menos papel. Menos informações perdidas. Mais controle sobre
                    cada serviço.
                </p>
            </div>

            <div class="relative" data-animate>
                <!-- Flow Line -->
                <div
                    class="absolute top-14 right-10 left-10 hidden h-0.5 bg-gradient-to-r from-axion-200 via-axion-500 to-axion-200 lg:block dark:from-axion-800 dark:via-axion-600 dark:to-axion-800"
                />

                <div
                    class="relative z-10 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-6 lg:gap-0"
                >
                    <Card
                        v-for="(step, index) in osFlowSteps"
                        :key="index"
                        variant="outlined"
                        padding="lg"
                        class="group relative h-full text-center transition-all duration-300 hover:border-axion-400 hover:shadow-xl dark:hover:border-axion-600"
                    >
                        <div
                            class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-axion-100 to-axion-200 transition-all duration-300 group-hover:from-axion-500 group-hover:to-axion-600 group-hover:text-white dark:from-axion-800/50 dark:to-axion-700/50"
                        >
                            <component
                                :is="getIcon(step.icon)"
                                class="h-7 w-7 text-axion-600 group-hover:text-white dark:text-axion-400"
                            />
                        </div>
                        <h3
                            class="mb-1 font-semibold text-axion-900 dark:text-white"
                        >
                            {{ step.step }}
                        </h3>
                        <p class="text-sm text-axion-600 dark:text-axion-400">
                            {{ step.description }}
                        </p>

                        <!-- Step number -->
                        <div
                            class="absolute -top-3 -right-3 flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-axion-500 to-axion-600 text-xs font-bold text-white shadow-lg"
                        >
                            {{ index + 1 }}
                        </div>

                        <!-- Arrow between steps (mobile) -->
                        <div
                            v-if="index < osFlowSteps.length - 1"
                            class="mt-4 hidden text-axion-300 sm:block lg:hidden"
                        >
                            <svg
                                class="mx-auto h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                />
                            </svg>
                        </div>
                    </Card>
                </div>

                <!-- Mobile arrows -->
                <div
                    class="mt-8 flex justify-between px-4 text-axion-300 lg:hidden"
                >
                    <div v-for="i in 5" :key="i" class="w-1/6">
                        <svg
                            class="mx-auto h-6 w-6"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </Section>

        <!-- Documents Section -->
        <Section
            id="documentos"
            class="relative overflow-hidden bg-axion-50 dark:bg-axion-900/30"
            aria-label="Documentos profissionais"
        >
            <!-- Background decoration -->
            <div class="absolute inset-0 -z-10">
                <div
                    class="absolute bottom-0 left-1/4 h-72 w-72 rounded-full bg-axion-500/5 blur-3xl"
                    aria-hidden="true"
                ></div>
            </div>

            <div
                class="relative z-10 mx-auto mb-16 max-w-3xl text-center"
                data-animate
            >
                <h2
                    class="mb-4 text-3xl font-bold tracking-tight text-axion-900 md:text-4xl lg:text-5xl dark:text-white"
                >
                    Transforme seus serviços em
                    <br />
                    <span class="text-axion-600 dark:text-axion-400"
                        >documentos profissionais.</span
                    >
                </h2>
            </div>

            <div
                class="relative z-10 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-5"
                data-animate
            >
                <Card
                    v-for="(doc, index) in documentTypes"
                    :key="index"
                    variant="outlined"
                    padding="lg"
                    class="group h-full text-center transition-all duration-300 hover:border-axion-400 hover:shadow-xl dark:hover:border-axion-600"
                >
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-axion-100 to-axion-200 transition-all duration-300 group-hover:from-axion-500 group-hover:to-axion-600 group-hover:text-white dark:from-axion-800/50 dark:to-axion-700/50"
                    >
                        <component
                            :is="getIcon(doc.icon)"
                            class="h-7 w-7 text-axion-600 group-hover:text-white dark:text-axion-400"
                        />
                    </div>
                    <h3
                        class="mb-2 font-semibold text-axion-900 dark:text-white"
                    >
                        {{ doc.title }}
                    </h3>
                    <p class="text-sm text-axion-600 dark:text-axion-400">
                        {{ doc.description }}
                    </p>
                </Card>
            </div>
        </Section>

        <!-- Customization Section -->
        <Section id="personalizacao" aria-label="Personalização">
            <div class="mx-auto mb-16 max-w-3xl text-center" data-animate>
                <h2
                    class="mb-4 text-3xl font-bold tracking-tight text-axion-900 md:text-4xl lg:text-5xl dark:text-white"
                >
                    Adapte o Axion ao
                    <br />
                    <span class="text-axion-600 dark:text-axion-400"
                        >seu jeito de trabalhar.</span
                    >
                </h2>
                <p class="text-lg text-axion-600 dark:text-axion-300">
                    Cada negócio é único. O Axion oferece flexibilidade para
                    moldar o sistema às suas necessidades.
                </p>
            </div>

            <div class="grid gap-8 md:grid-cols-3" data-animate>
                <Card
                    v-for="(feature, index) in customizationFeatures"
                    :key="index"
                    variant="elevated"
                    padding="xl"
                    class="text-center transition-shadow duration-300 hover:shadow-2xl"
                >
                    <div
                        class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-axion-500 to-axion-700 shadow-lg shadow-axion-500/20"
                    >
                        <component
                            :is="getIcon(feature.icon)"
                            class="h-8 w-8 text-white"
                        />
                    </div>
                    <h3
                        class="mb-3 text-xl font-semibold text-axion-900 dark:text-white"
                    >
                        {{ feature.title }}
                    </h3>
                    <p
                        class="leading-relaxed text-axion-600 dark:text-axion-400"
                    >
                        {{ feature.description }}
                    </p>
                </Card>
            </div>
        </Section>

        <!-- Dashboard Section -->
        <Section id="dashboard" aria-label="Dashboard do Axion">
            <div class="mx-auto mb-12 max-w-3xl text-center" data-animate>
                <h2
                    class="mb-4 text-3xl font-bold tracking-tight text-axion-900 md:text-4xl lg:text-5xl dark:text-white"
                >
                    Tenha sua empresa na
                    <br />
                    <span class="text-axion-600 dark:text-axion-400"
                        >palma da mão.</span
                    >
                </h2>
                <p class="text-lg text-axion-600 dark:text-axion-300">
                    Uma visão clara do que está acontecendo para você tomar
                    decisões melhores.
                </p>
            </div>

            <!-- Dashboard Mockup -->
            <div data-animate>
                <Card
                    variant="elevated"
                    padding="none"
                    class="overflow-hidden border border-axion-200 dark:border-axion-800"
                >
                    <!-- Header -->
                    <div
                        class="flex flex-col items-start justify-between gap-4 border-b border-axion-800 bg-axion-900 px-6 py-4 sm:flex-row sm:items-center dark:border-axion-700 dark:bg-axion-800"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-axion-600/20"
                            >
                                <svg
                                    class="h-5 w-5 text-axion-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-white">
                                    Dashboard Executivo
                                </p>
                                <p class="text-xs text-axion-400">
                                    Visão geral em tempo real
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <select
                                class="rounded-lg border border-axion-700 bg-axion-800 px-3 py-2 text-sm text-white focus:ring-2 focus:ring-axion-500 focus:outline-none"
                            >
                                <option>Últimos 30 dias</option>
                                <option>Últimos 7 dias</option>
                                <option>Últimos 90 dias</option>
                                <option>Este ano</option>
                            </select>
                            <Button variant="ghost" size="sm">
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                                    />
                                </svg>
                            </Button>
                        </div>
                    </div>

                    <!-- Metrics Grid -->
                    <div
                        class="grid grid-cols-2 gap-4 p-6 md:grid-cols-3 lg:grid-cols-6"
                    >
                        <div
                            v-for="(metric, index) in dashboardMetrics"
                            :key="index"
                            class="rounded-xl border border-axion-200/50 bg-axion-50 p-4 transition-all duration-200 hover:border-axion-300 hover:shadow-md dark:border-axion-700/50 dark:bg-axion-800/50 dark:hover:border-axion-600"
                        >
                            <p
                                class="mb-2 text-xs font-medium tracking-wider text-axion-500 uppercase dark:text-axion-400"
                            >
                                {{ metric.label }}
                            </p>
                            <p
                                class="mb-1 text-2xl font-bold tracking-tight text-axion-900 md:text-3xl dark:text-white"
                            >
                                {{ metric.value }}
                            </p>
                            <p
                                class="flex items-center gap-1 text-xs"
                                :class="
                                    metric.trend === 'up'
                                        ? 'text-green-600 dark:text-green-400'
                                        : metric.trend === 'down'
                                          ? 'text-red-600 dark:text-red-400'
                                          : 'text-axion-500 dark:text-axion-400'
                                "
                            >
                                <svg
                                    v-if="metric.trend === 'up'"
                                    class="h-3 w-3"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 10l7-7m0 0l7 7m-7-7v18"
                                    />
                                </svg>
                                <svg
                                    v-else-if="metric.trend === 'down'"
                                    class="h-3 w-3"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19 14l-7 7m0 0l-7-7m7 7V3"
                                    />
                                </svg>
                                <svg
                                    v-else
                                    class="h-3 w-3"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 12h14"
                                    />
                                </svg>
                                {{ metric.change }}
                            </p>
                        </div>
                    </div>

                    <!-- Charts Area -->
                    <div class="px-6 pb-6">
                        <div class="grid gap-6 lg:grid-cols-2">
                            <!-- Revenue Chart -->
                            <Card variant="outlined" padding="lg">
                                <h4
                                    class="mb-4 flex items-center justify-between font-semibold text-axion-900 dark:text-white"
                                >
                                    Faturamento (últimos 30 dias)
                                    <span
                                        class="text-xs text-axion-500 dark:text-axion-400"
                                        >+12,5%</span
                                    >
                                </h4>
                                <div class="relative h-48" style="width: 100%">
                                    <svg
                                        viewBox="0 0 400 200"
                                        class="h-full w-full"
                                        aria-hidden="true"
                                    >
                                        <defs>
                                            <linearGradient
                                                id="revenueGradient"
                                                x1="0"
                                                y1="0"
                                                x2="0"
                                                y2="1"
                                            >
                                                <stop
                                                    offset="0%"
                                                    stop-color="#2563eb"
                                                    stop-opacity="0.3"
                                                />
                                                <stop
                                                    offset="100%"
                                                    stop-color="#2563eb"
                                                    stop-opacity="0"
                                                />
                                            </linearGradient>
                                        </defs>
                                        <!-- Grid lines -->
                                        <g
                                            stroke="#e5e7eb"
                                            stroke-width="0.5"
                                            stroke-dasharray="4,4"
                                        >
                                            <line
                                                v-for="i in 4"
                                                :key="i"
                                                x1="0"
                                                :y1="i * 40 + 20"
                                                x2="400"
                                                :y2="i * 40 + 20"
                                            />
                                        </g>
                                        <!-- Area chart -->
                                        <path
                                            d="M0,180 L40,140 L80,160 L120,120 L160,100 L200,90 L240,80 L280,70 L320,65 L360,60 L400,55"
                                            fill="url(#revenueGradient)"
                                            stroke="#2563eb"
                                            stroke-width="2"
                                            fill-opacity="0.4"
                                        />
                                        <!-- Line -->
                                        <path
                                            d="M0,180 L40,140 L80,160 L120,120 L160,100 L200,90 L240,80 L280,70 L320,65 L360,60 L400,55"
                                            fill="none"
                                            stroke="#2563eb"
                                            stroke-width="2.5"
                                        />
                                        <!-- Points -->
                                        <circle
                                            v-for="(point, i) in [
                                                180, 140, 160, 120, 100, 90, 80,
                                                70, 65, 60, 55,
                                            ]"
                                            :key="i"
                                            :cx="i * 40"
                                            :cy="point"
                                            r="4"
                                            fill="#2563eb"
                                            stroke="white"
                                            stroke-width="2"
                                        />
                                    </svg>
                                </div>
                            </Card>

                            <!-- OS Status Chart -->
                            <Card variant="outlined" padding="lg">
                                <h4
                                    class="mb-4 font-semibold text-axion-900 dark:text-white"
                                >
                                    Status das OS
                                </h4>
                                <div class="relative h-48" style="width: 100%">
                                    <svg
                                        viewBox="0 0 400 200"
                                        class="h-full w-full"
                                        aria-hidden="true"
                                    >
                                        <!-- Donut chart -->
                                        <g transform="translate(200, 100)">
                                            <!-- Background circle -->
                                            <circle
                                                cx="0"
                                                cy="0"
                                                r="70"
                                                fill="none"
                                                stroke="#e5e7eb"
                                                stroke-width="28"
                                            />
                                            <!-- Completed -->
                                            <circle
                                                cx="0"
                                                cy="0"
                                                r="70"
                                                fill="none"
                                                stroke="#22c55e"
                                                stroke-width="28"
                                                stroke-dasharray="439.8"
                                                stroke-dashoffset="439.8 * 0.4"
                                                transform="rotate(-90)"
                                                stroke-linecap="round"
                                            />
                                            <!-- In progress -->
                                            <circle
                                                cx="0"
                                                cy="0"
                                                r="70"
                                                fill="none"
                                                stroke="#3b82f6"
                                                stroke-width="28"
                                                stroke-dasharray="439.8"
                                                stroke-dashoffset="439.8 * 0.75"
                                                transform="rotate(-90)"
                                                stroke-linecap="round"
                                            />
                                            <!-- Open -->
                                            <circle
                                                cx="0"
                                                cy="0"
                                                r="70"
                                                fill="none"
                                                stroke="#f59e0b"
                                                stroke-width="28"
                                                stroke-dasharray="439.8"
                                                stroke-dashoffset="439.8 * 0.9"
                                                transform="rotate(-90)"
                                                stroke-linecap="round"
                                            />
                                        </g>
                                        <!-- Legend -->
                                        <g transform="translate(50, 140)">
                                            <g
                                                v-for="(item, i) in [
                                                    {
                                                        color: '#22c55e',
                                                        label: 'Concluídas (156)',
                                                    },
                                                    {
                                                        color: '#3b82f6',
                                                        label: 'Em andamento (18)',
                                                    },
                                                    {
                                                        color: '#f59e0b',
                                                        label: 'Abertas (23)',
                                                    },
                                                ]"
                                                :key="i"
                                                :transform="`translate(0, ${i * 24})`"
                                            >
                                                <rect
                                                    x="0"
                                                    y="0"
                                                    width="12"
                                                    height="12"
                                                    :fill="item.color"
                                                    rx="2"
                                                />
                                                <text
                                                    x="20"
                                                    y="10"
                                                    fill="#6b7280"
                                                    font-size="12"
                                                    font-family="Inter, system-ui"
                                                >
                                                    {{ item.label }}
                                                </text>
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
            <div class="mx-auto mb-16 max-w-3xl text-center" data-animate>
                <h2
                    class="mb-4 text-3xl font-bold tracking-tight text-axion-900 md:text-4xl lg:text-5xl dark:text-white"
                >
                    Feito para quem
                    <br />
                    <span class="text-axion-600 dark:text-axion-400"
                        >trabalha com serviços.</span
                    >
                </h2>
                <p class="mb-8 text-lg text-axion-600 dark:text-axion-300">
                    Se sua empresa trabalha com serviços, o Axion foi feito para
                    você.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4" data-animate>
                <Card
                    v-for="(audience, index) in audiences"
                    :key="index"
                    variant="outlined"
                    padding="xl"
                    class="group transition-all duration-300 hover:-translate-y-0.5 hover:border-axion-400 hover:shadow-xl dark:hover:border-axion-600"
                >
                    <div
                        class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-axion-100 to-axion-200 transition-all duration-300 group-hover:from-axion-500 group-hover:to-axion-600 group-hover:text-white dark:from-axion-800/50 dark:to-axion-700/50"
                    >
                        <component
                            :is="getIcon(audience.icon)"
                            class="h-7 w-7 text-axion-600 group-hover:text-white dark:text-axion-400"
                        />
                    </div>
                    <h3
                        class="mb-2 text-lg font-semibold text-axion-900 dark:text-white"
                    >
                        {{ audience.title }}
                    </h3>
                    <p
                        class="text-sm leading-relaxed text-axion-600 dark:text-axion-400"
                    >
                        {{ audience.description }}
                    </p>
                </Card>
            </div>
        </Section>

        <!-- Benefits Section -->
        <Section
            className="bg-axion-900 dark:bg-axion-950 relative overflow-hidden"
            aria-label="Benefícios"
        >
            <!-- Background decoration -->
            <div class="absolute inset-0">
                <div
                    class="absolute top-0 left-1/4 h-72 w-72 rounded-full bg-axion-600/10 blur-3xl"
                    aria-hidden="true"
                ></div>
                <div
                    class="absolute right-1/4 bottom-0 h-72 w-72 rounded-full bg-axion-500/10 blur-3xl"
                    aria-hidden="true"
                ></div>
            </div>

            <div
                class="relative z-10 mx-auto mb-16 max-w-3xl text-center"
                data-animate
            >
                <h2
                    class="mb-4 text-3xl font-bold tracking-tight text-white md:text-4xl lg:text-5xl"
                >
                    Resultados que
                    <br />
                    <span class="text-axion-400">fazem a diferença.</span>
                </h2>
                <p class="text-lg text-axion-300">
                    Empresas que adotam o Axion experimentam transformação real
                    na operação.
                </p>
            </div>

            <div
                class="relative z-10 grid grid-cols-2 gap-6 md:grid-cols-3 lg:grid-cols-6"
                data-animate
            >
                <div
                    v-for="(benefit, index) in benefits"
                    :key="index"
                    class="rounded-xl border border-axion-700/40 bg-axion-800/20 p-4 text-center transition-all duration-300 hover:border-axion-600/60 hover:bg-axion-800/40"
                >
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-axion-500 to-axion-700 shadow-lg shadow-axion-500/20"
                    >
                        <svg
                            class="h-7 w-7 text-white"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-white">{{ benefit }}</p>
                </div>
            </div>
        </Section>

        <!-- Final CTA -->
        <Section
            id="cta-final"
            class="relative overflow-hidden"
            aria-label="Call to action final"
        >
            <div
                class="absolute inset-0 bg-gradient-to-br from-axion-500 via-axion-700 to-axion-900"
            />
            <div
                class="absolute inset-0 bg-[url('/pattern.svg')] opacity-20"
                aria-hidden="true"
            />
            <div
                class="absolute -top-24 -right-24 h-96 w-96 rounded-full bg-white/10 blur-3xl"
                aria-hidden="true"
            ></div>
            <div
                class="absolute -bottom-24 -left-24 h-96 w-96 rounded-full bg-axion-400/20 blur-3xl"
                aria-hidden="true"
            ></div>

            <div
                class="relative mx-auto max-w-4xl px-6 text-center"
                data-animate
            >
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-medium text-white shadow-sm backdrop-blur-sm"
                >
                    <span class="relative flex h-2 w-2">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75"
                        ></span>
                        <span
                            class="relative inline-flex h-2 w-2 rounded-full bg-green-400"
                        ></span>
                    </span>
                    Mais de 500 empresas já usam o Axion
                </div>

                <h2
                    class="mb-6 text-3xl font-bold tracking-tight text-white md:text-4xl lg:text-5xl"
                >
                    Sua empresa merece uma
                    <br />
                    <span class="text-axion-300">gestão mais inteligente.</span>
                </h2>

                <p
                    class="mx-auto mb-10 max-w-2xl text-lg text-axion-200 md:text-xl"
                >
                    Deixe processos manuais para trás e tenha tudo o que precisa
                    para administrar seus serviços em um só lugar.
                </p>

                <div
                    class="flex flex-col items-center justify-center gap-4 sm:flex-row"
                >
                    <Button
                        size="lg"
                        variant="secondary"
                        class="group w-full bg-white px-10 py-4 text-axion-900 shadow-xl shadow-axion-900/20 hover:bg-axion-50 sm:w-auto"
                    >
                        Começar agora
                        <svg
                            class="h-5 w-5 transition-transform group-hover:translate-x-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"
                            />
                        </svg>
                    </Button>
                    <Button
                        size="lg"
                        variant="outline"
                        class="w-full border-white px-10 py-4 text-white hover:bg-white/10 sm:w-auto"
                        >Agendar demonstração</Button
                    >
                </div>

                <p class="mt-8 text-sm text-axion-400">
                    Configuração em minutos · Suporte em português ·
                    Cancelamento a qualquer momento
                </p>
            </div>
        </Section>

        <!-- Footer -->
        <footer
            class="border-t border-axion-800/60 bg-axion-950 dark:bg-axion-950"
            aria-label="Rodapé"
        >
            <div class="py-16 lg:py-24">
                <div
                    class="mb-12 grid grid-cols-2 gap-8 md:grid-cols-6 lg:gap-12"
                >
                    <!-- Brand -->
                    <div class="col-span-2 lg:col-span-2">
                        <div class="mb-4 flex items-center gap-2">
                            <AxionLogo size="xl" variant="light" />
                            <span class="text-2xl font-semibold text-white"
                                >Axion</span
                            >
                        </div>
                        <p
                            class="mb-6 max-w-xs text-sm leading-relaxed text-axion-400"
                        >
                            Plataforma de gestão completa para empresas de
                            assistência técnica, oficinas e serviços. Organize,
                            controle e cresça.
                        </p>
                        <div class="flex items-center gap-3">
                            <a
                                href="#"
                                class="flex h-10 w-10 items-center justify-center rounded-lg border border-axion-800 bg-axion-900 text-axion-500 transition-all duration-200 hover:border-axion-700 hover:bg-axion-800 hover:text-white"
                                aria-label="LinkedIn"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"
                                    />
                                </svg>
                            </a>
                            <a
                                href="#"
                                class="flex h-10 w-10 items-center justify-center rounded-lg border border-axion-800 bg-axion-900 text-axion-500 transition-all duration-200 hover:border-axion-700 hover:bg-axion-800 hover:text-white"
                                aria-label="Twitter"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"
                                    />
                                </svg>
                            </a>
                            <a
                                href="#"
                                class="flex h-10 w-10 items-center justify-center rounded-lg border border-axion-800 bg-axion-900 text-axion-500 transition-all duration-200 hover:border-axion-700 hover:bg-axion-800 hover:text-white"
                                aria-label="GitHub"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"
                                    />
                                </svg>
                            </a>
                            <a
                                href="#"
                                class="flex h-10 w-10 items-center justify-center rounded-lg border border-axion-800 bg-axion-900 text-axion-500 transition-all duration-200 hover:border-axion-700 hover:bg-axion-800 hover:text-white"
                                aria-label="YouTube"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Produto -->
                    <nav>
                        <h4
                            class="mb-4 text-sm font-semibold tracking-wider text-axion-200 text-white uppercase"
                        >
                            Produto
                        </h4>
                        <ul class="space-y-3" role="list">
                            <li
                                v-for="link in footerLinks.produto"
                                :key="link.label"
                            >
                                <a
                                    :href="link.href"
                                    class="text-sm text-axion-400 transition-colors hover:text-white"
                                    >{{ link.label }}</a
                                >
                            </li>
                        </ul>
                    </nav>

                    <!-- Empresa -->
                    <nav>
                        <h4
                            class="mb-4 text-sm font-semibold tracking-wider text-axion-200 text-white uppercase"
                        >
                            Empresa
                        </h4>
                        <ul class="space-y-3" role="list">
                            <li
                                v-for="link in footerLinks.empresa"
                                :key="link.label"
                            >
                                <a
                                    :href="link.href"
                                    class="text-sm text-axion-400 transition-colors hover:text-white"
                                    >{{ link.label }}</a
                                >
                            </li>
                        </ul>
                    </nav>

                    <!-- Suporte -->
                    <nav>
                        <h4
                            class="mb-4 text-sm font-semibold tracking-wider text-axion-200 text-white uppercase"
                        >
                            Suporte
                        </h4>
                        <ul class="space-y-3" role="list">
                            <li
                                v-for="link in footerLinks.suporte"
                                :key="link.label"
                            >
                                <a
                                    :href="link.href"
                                    class="text-sm text-axion-400 transition-colors hover:text-white"
                                    >{{ link.label }}</a
                                >
                            </li>
                        </ul>
                    </nav>

                    <!-- Legal -->
                    <nav>
                        <h4
                            class="mb-4 text-sm font-semibold tracking-wider text-axion-200 text-white uppercase"
                        >
                            Legal
                        </h4>
                        <ul class="space-y-3" role="list">
                            <li
                                v-for="link in footerLinks.legal"
                                :key="link.label"
                            >
                                <a
                                    :href="link.href"
                                    class="text-sm text-axion-400 transition-colors hover:text-white"
                                    >{{ link.label }}</a
                                >
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Bottom Bar -->
                <div
                    class="flex flex-col items-center justify-between gap-4 border-t border-axion-800 pt-8 md:flex-row"
                >
                    <p class="text-sm text-axion-500">
                        © 2024 Axion. Todos os direitos reservados.
                    </p>
                    <div class="flex items-center gap-6 text-sm text-axion-500">
                        <span
                            >Feito com dedicação para empresas brasileiras</span
                        >
                        <a href="#" class="transition-colors hover:text-white"
                            >Privacidade</a
                        >
                        <a href="#" class="transition-colors hover:text-white"
                            >Termos</a
                        >
                        <a href="#" class="transition-colors hover:text-white"
                            >Cookies</a
                        >
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

@keyframes float {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-14px);
    }
}

.animate-mockup {
    animation:
        fade-in-up 0.6s ease-out 200ms both,
        float 6s ease-in-out 1.2s infinite;
}

.animate-float-badge {
    animation:
        fade-in-up 0.6s ease-out 400ms both,
        float 7s ease-in-out 1.4s infinite;
}

[data-animate] {
    opacity: 0;
}

[data-animate].animate-in {
    animation: fade-in-up 0.6s ease-out forwards;
}

/* Staggered animation delays for grid items */
[data-animate].animate-in:nth-child(1) {
    animation-delay: 100ms;
}
[data-animate].animate-in:nth-child(2) {
    animation-delay: 200ms;
}
[data-animate].animate-in:nth-child(3) {
    animation-delay: 300ms;
}
[data-animate].animate-in:nth-child(4) {
    animation-delay: 400ms;
}
[data-animate].animate-in:nth-child(5) {
    animation-delay: 500ms;
}
[data-animate].animate-in:nth-child(6) {
    animation-delay: 600ms;
}
[data-animate].animate-in:nth-child(7) {
    animation-delay: 700ms;
}
[data-animate].animate-in:nth-child(8) {
    animation-delay: 800ms;
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Focus visible styles */
*:focus-visible {
    outline: 2px solid #2563eb;
    outline-offset: 2px;
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    html {
        scroll-behavior: auto;
    }
    [data-animate],
    [data-animate].animate-in,
    .animate-fade-in-up,
    .animate-mockup,
    .animate-float-badge {
        animation: none !important;
        opacity: 1 !important;
        transition: none !important;
    }
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
