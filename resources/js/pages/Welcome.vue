<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login } from '@/routes';

withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);
</script>

<style scoped>
@keyframes blob {
    0% {
        transform: translate(0px, 0px) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
    100% {
        transform: translate(0px, 0px) scale(1);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}
</style>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="relative flex min-h-screen flex-col items-center bg-gradient-to-br from-white via-[#f0f9ff] to-[#dbeafe] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-gradient-to-br dark:from-[#0a0a0a] dark:via-[#1e3a8a] dark:to-[#1e40af] overflow-hidden"
    >
        <!-- Elementos decorativos de fondo -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-0 -left-4 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow"
        >
            <main
                class="flex w-full max-w-2xl items-center justify-center"
            >
                <!-- Contenedor central en cuadrado con fondo blanco -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-2xl p-6 sm:p-8 md:p-10 lg:p-12 w-full dark:bg-gray-800">
                    <div class="flex flex-col items-center text-center">
                        <!-- Badge -->
                        <div class="inline-flex items-center gap-2 rounded-full bg-blue-100 px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium text-blue-700 dark:bg-blue-900/40 dark:text-blue-300 mb-4 sm:mb-6">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                            </svg>
                            S I C U
                        </div>
                        
                        <h1
                            class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-extrabold leading-tight tracking-tight text-gray-900 dark:text-white -mb-3 sm:-mb-4 md:-mb-5 lg:-mb-6"
                        >
                            <span class="bg-gradient-to-r from-blue-500 to-cyan-700 bg-clip-text text-transparent">
                                Sistema de Carné Universitario
                            </span>
                        </h1>

                       
                        <div class="relative w-48 h-48 sm:w-56 sm:h-56 md:w-64 md:h-64 lg:w-80 lg:h-80 xl:w-96 xl:h-96 mx-auto -mb-3 sm:-mb-4 md:-mb-5 lg:-mb-6">
                            <img 
                                src="/ogga.png" 
                                alt="Logo SECU" 
                                class="w-full h-full object-contain drop-shadow-2xl transition-transform hover:scale-110 duration-300"
                                style="filter: drop-shadow(0 0 15px rgba(59, 130, 246, 0.5)) drop-shadow(0 0 5px rgba(6, 182, 212, 0.3));"
                            />
                        </div>

                        
                        <p class="text-sm sm:text-base md:text-lg text-gray-600 leading-relaxed dark:text-gray-300 mb-6 sm:mb-8 px-2 sm:px-0">
                            Plataforma integral para la gestión, emisión y validación de carnés universitarios.
                            Facilita el proceso de identificación estudiantil con tecnología moderna y segura.
                        </p>

                        
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 w-full justify-center px-4 sm:px-0">
                            <Link
                                :href="login()"
                                class="group inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-2.5 sm:px-8 sm:py-3 text-sm sm:text-base font-bold text-white shadow-xl shadow-blue-600/40 transition-all hover:shadow-2xl hover:shadow-blue-700/50 hover:scale-105 hover:from-blue-700 hover:to-blue-800 dark:from-blue-500 dark:to-blue-600 dark:shadow-blue-500/40"
                            >
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                                Comenzar
                            </Link>
                            
                            <Link
                                :href="login()"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border-2 border-blue-600 bg-transparent px-6 py-2.5 sm:px-8 sm:py-3 text-sm sm:text-base font-bold text-blue-700 shadow-lg transition-all hover:bg-blue-50 hover:shadow-xl hover:scale-105 dark:border-blue-400 dark:text-blue-300 dark:hover:bg-blue-900/30"
                            >
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Iniciar sesión
                            </Link>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
