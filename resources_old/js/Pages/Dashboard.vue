<script setup>
import { Inertia } from '@inertiajs/inertia'
// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AuthenticatedLayout from '@/Layouts/VuetifyAuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps(['ledgers']);

function newLedger() {
    console.log("fuq");
}

function goToLedger(ledgerId) {
    Inertia.get('/ledger/' + ledgerId);
}
</script>

<template>
    <Head title="Painel" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl">
                Dashboard
            </h2>
        </template> -->

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="tooltip tooltip-primary tooltip-right" data-tip="Novo Livro">
                    <button class="btn btn-primary" @click="newLedger()">+</button>
                </div>
            </div>
        </div>
        <table class="table m-auto w-80 p-2 rounded-box">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Proprietário</th>
                    <th>Atualização</th>
                </tr>
            </thead>
            <tr v-for="ledger in ledgers" v-bind:key="ledger.id" class="hover" @click="goToLedger(ledger.id)">
                <td>{{ ledger.title }}</td>
                <td>{{ ledger.description }}</td>
                <td>{{ ledger.user.name }}</td>
                <td>{{ (new Date(ledger.updated_at)).toLocaleDateString() }}</td>
            </tr>
        </table>
    </AuthenticatedLayout>
</template>
