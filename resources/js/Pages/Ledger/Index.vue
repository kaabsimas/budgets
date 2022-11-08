<script setup>
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue3'
import AuthenticatedLayout from '@/Layouts/DaisyAuthenticatedLayout.vue';
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
        <div class="flex">
            <div class="bg-rose-100 m-1 border-gray-300 border-solid rounded w-1/3">
                <div class="mx-auto w-fit">{{month}}</div>
                <div class="flex">
                    <div class="flex-none w-1/2 bg-red-200">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-red-300">
                                    <th class="pl-2 w-1/2">Passivos</th>
                                    <th class="pl-2 w-1/2">Valor</th>
                                </tr>
                            </thead>
                            <tbody class="bg-red-200">
                                <tr v-for="liability in liabilities" :key="liability.id">
                                    <td class="pl-2">{{liability.account.name}}</td>
                                    <td class="pl-2">{{parseFloat(liability.amount).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex-none w-1/2 bg-blue-200">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-blue-300">
                                    <th class="pl-2">Ativos</th>
                                    <th class="pl-2">Valor</th>
                                </tr>
                            </thead>
                            <tbody class="bg-blue-200">
                                <tr v-for="asset in assets" :key="asset.id">
                                    <td class="pl-2">{{asset.account.name}}</td>
                                    <td class="pl-2">{{parseFloat(asset.amount).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'})}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex-none w-1/3">
                <!-- sumario -->
                <div class="">
                    <table class="table table-compact w-80">
                        <tr>
                            <td>Despesas Fixas</td>
                            <td>
                                {{ expensesTotal.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) }}
                            </td>
                        </tr>
                        <tr>
                            <td>Entradas</td>
                            <td>{{ assetsTotal.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) }}</td>
                        </tr>
                        <tr>
                            <td>Resto Mês</td>
                            <td>{{ (assetsTotal - expensesTotal).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) }}</td>
                        </tr>
                        <tr>
                            <td>Soma Incidentais</td>
                            <td></td>
                        </tr>
                        <tr class="bg-base-300">
                            <td>Resto</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div> 
    </AuthenticatedLayout>
</template>