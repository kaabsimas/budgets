<script setup>
    const props = defineProps(['estimations']);

    const assets = props.estimations.filter(acc => acc.type == 'income');
    const liabilities = props.estimations.filter(acc => acc.type == 'expense');
</script>
<template>
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
</template>