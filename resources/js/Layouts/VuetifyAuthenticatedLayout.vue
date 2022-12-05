<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <v-app>
        <v-app-bar>
            <template v-slot:prepend>
                <ApplicationLogo class="block h-9 w-auto" />
            </template>
            <v-app-bar-title>Budgets</v-app-bar-title>
            <template v-slot:append>
                <ul class="menu menu-horizontal p-0">
                    <li>
                        <a>
                            <!-- <font-awesome-icon icon="fa-user" /> -->
                            <v-icon icon="mdi-account"></v-icon>
                            {{ $page.props.auth.user.name }}
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                        </a>
                        <ul class="menu menu-compact bg-primary w-56 p-2 z-40">
                            <li><Link :href="route('logout')" method="post" as="button">Logout</Link></li>
                        </ul>
                    </li>
                </ul>
            </template>
        </v-app-bar>
        <!-- Page Heading -->
        <header class="" v-if="$slots.header">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>
