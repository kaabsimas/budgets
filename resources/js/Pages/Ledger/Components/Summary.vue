<script setup>
    const props = defineProps(['assetsTotal', 'expensesTotal', 'ocasionals']);
</script>
<template>
    <div class="">
        <table class="table table-compact w-full mb-5">
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
                <td>{{ ocasionals.toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) }}</td>
            </tr>
            <tr class="bg-base-300">
                <td>Resto</td>
                <td>{{ (assetsTotal - expensesTotal - ocasionals).toLocaleString('pt-BR', {style: 'currency', currency: 'BRL'}) }}</td>
            </tr>
        </table>
    </div>
</template>