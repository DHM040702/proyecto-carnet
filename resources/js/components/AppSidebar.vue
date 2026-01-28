<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { 
    // BookOpen, activar para las redirecciones pe
    // Folder, activar para las redirecciones pe
    LayoutGrid,
    FileText,
    CheckCircle,
    Settings as SettingsIcon,
    TrendingUp,
    BarChart3,
    User as UserIcon
} from 'lucide-vue-next';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import { type NavItem } from '@/types';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Inicio',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Solicitud',
        href: '/solicitud',
        icon: FileText,
    },
    {
        title: 'Validación',
        href: '/validacion',
        icon: CheckCircle,
    },
    {
        title: 'Gestión',
        href: '/gestion',
        icon: SettingsIcon,
    },
    {
        title: 'Seguimiento',
        href: '/seguimiento',
        icon: TrendingUp,
    },
    {
        title: 'Reportes',
        href: '/reportes',
        icon: BarChart3,
    },
    {
        title: 'Usuario',
        href: '/usuario',
        icon: UserIcon,
    },
];

const footerNavItems: NavItem[] = [
    //aca redirecciones pe mascotas
    //{
    //    title: 'Github Repo',
    //   href: 'https://github.com/laravel/vue-starter-kit',
    //    icon: Folder,
    // },
    
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
