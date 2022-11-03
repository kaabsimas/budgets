<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="container 2xl:container mx-auto">
        <div class="navbar bg-primary w-100">
            <div class="flex-1">
                <Link :href="route('dashboard')" class="btn btn-ghost normal-case text-xl">
                    <ApplicationLogo class="block h-9 w-auto" />
                </Link>
                <ul class="menu menu-horizontal p-0">
                    <li><Link :href="route('dashboard')">Painel</Link></li>
                </ul>
            </div>
            <div class="flex-1 flex-row-reverse ">
                <ul class="menu menu-horizontal p-0">
                    <li>
                        <a>
                            {{ $page.props.auth.user.name }}
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                        </a>
                        <ul class="menu menu-compact bg-primary w-56 p-2">
                            <li><Link :href="route('logout')" method="post" as="button">Logout</Link></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Page Heading -->
        <header class="" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot />
        </main>
    </div>
</template>
