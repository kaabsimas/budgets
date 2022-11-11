<script setup>
    const props = defineProps(['assetsTotal', 'expensesTotal']);
</script>
<template>
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
</template>