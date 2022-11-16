<script setup>
import NewTransaction from '@/Pages/Ledger/Components/NewTransaction.vue';
import AuthenticatedLayout from '@/Layouts/DaisyAuthenticatedLayout.vue';
import Estimations from '@/Pages/Ledger/Components/Estimations.vue';
import Summary from '@/Pages/Ledger/Components/Summary.vue';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps(['ledger', 'estimations']);
var month = (new Date()).toLocaleString('default', {month: 'long'});

const assets = props.estimations.filter(acc => acc.type == 'income');
const liabilities = props.estimations.filter(acc => acc.type == 'expense');
const assetsTotal = assets.reduce((acc, current) => (acc += parseFloat(current.amount)), 0);
const expensesTotal = liabilities.reduce((acc, current) => (acc += parseFloat(current.amount)), 0);
// inserir uma coluna com apenas transações "estimated"
// quando essas transações forem confirmadas, não será alterado seu 
// status, mas criada uma nova transação do tipo confirmed.
// (estudar criar um novo tipo de entidade apenas para "estimativas" e criar apenas dois status 
//  "pendente" e "pago")
</script>
<template>
    <Head :title="ledger.title" />
    <AuthenticatedLayout>
        <NewTransaction />
        <div class="flex">
            <div class="bg-rose-100 m-1 border-gray-300 border-solid rounded h-fit w-1/3">
                <div class="mx-auto w-fit">{{month}}</div>
                <Estimations :estimations="estimations" />
            </div>
            <div class="flex-none w-1/3">
                <!-- nova transação -->
                <div></div>
                <!-- sumario -->
                <Summary :assetsTotal="assetsTotal" :expensesTotal="expensesTotal" />
            </div>
        </div> 
    </AuthenticatedLayout>
</template>