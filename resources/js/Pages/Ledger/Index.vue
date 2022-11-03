<script setup>
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3'
import AuthenticatedLayout from '@/Layouts/DaisyAuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps(['ledger']);
var month = (new Date()).toLocaleString('default', {month: 'long'});

</script>
<template>
    <Head :title="ledger.title" />
    <AuthenticatedLayout>        
        <div class="w-1/2 bg-base-200">
            <div class="mx-auto w-fit">{{month}}</div>
            <div class="flex">
                <div class="flex-none w-1/2 bg-red-200">Despesas</div>
                <div class="flex-none w-1/2 bg-blue-200">Receitas</div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>