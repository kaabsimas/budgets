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
                <v-btn class="hover:text-slate-100" color="primary" prepend-icon="mdi-account" append-icon="mdi-chevron-down">
                    {{ $page.props.auth.user.name }}
                    <v-menu activator="parent">
                        <v-list>
                            <v-list-item>
                                <Link :href="route('logout')" method="post" as="button">Logout</Link>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </v-btn>
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
