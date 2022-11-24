<script setup>
import NewTransaction from '@/Pages/Ledger/Components/NewTransaction.vue';
import AuthenticatedLayout from '@/Layouts/DaisyAuthenticatedLayout.vue';
import Estimations from '@/Pages/Ledger/Components/Estimations.vue';
import Summary from '@/Pages/Ledger/Components/Summary.vue';
import { Head } from '@inertiajs/inertia-vue3';
import MonthSelect from '@/Pages/Ledger/Components/MonthSelect.vue';

const props = defineProps(['displayDate', 'ledger', 'estimations', 'accounts', 'transactions']);

const assets = props.estimations.filter(acc => acc.type == 'income');
const liabilities = props.estimations.filter(acc => acc.type == 'expense');
var assetsTotal = assets.reduce((acc, current) => (acc += parseFloat(current.amount)), 0);
var expensesTotal = liabilities.reduce((acc, current) => (acc += parseFloat(current.amount)), 0);
var ocasionals = props.transactions.reduce((acc, current) => (acc += parseFloat(current.amount)), 0);

</script>
<template>
    <Head :title="ledger.title" />
    <AuthenticatedLayout>
        <NewTransaction :ledger="ledger" :accounts="accounts" />
        <div class="flex">
            <div class="bg-rose-100 m-1 border-gray-300 border-solid rounded h-fit w-1/3">
                <MonthSelect :date="displayDate" />
                <Estimations :estimations="estimations" />
            </div>
            <div class="flex-none w-2/3">
                <!-- sumario -->
                <Summary :assetsTotal="assetsTotal" :expensesTotal="expensesTotal" :ocasionals=ocasionals />

                <table class="table table-compact w-full">
                    <tr v-for="transaction of transactions" :key="transaction.id" class="my-5">
                        <td>{{(new Date(transaction.transfered_at)).toLocaleDateString()}}</td>
                        <td>{{transaction.from_account.name}} >> {{transaction.to_account.name}} - {{parseFloat(transaction.amount).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})}}</td>
                        <td><span class="ml-5 font-bold">{{transaction.description}}</span></td>
                        <div class="btn btn-xs btn-error float-right" @click="this.$inertia.delete(route('ledger.transaction.delete', {ledger: ledger.id, transaction: transaction.id}))">
                            X
                        </div>
                    </tr>
                </table>
            </div>
        </div> 
    </AuthenticatedLayout>
</template>