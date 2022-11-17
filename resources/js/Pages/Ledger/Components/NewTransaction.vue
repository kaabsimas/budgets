<script setup>
    import {useForm} from '@inertiajs/inertia-vue3';
    import Dropdown from '@/Components/RichSelect.vue';

    const props = defineProps(['ledger', 'accounts']);

    const form = useForm({
        date: (new Date()).toISOString().split('T')[0],
        from: '',
        to: '',
        description: '',
        amount: null
    });
</script>
<template>
    <form @submit.prevent="form.post(route('ledger.transaction.store', {'ledger': ledger.id}))">
        <datalist id="accounts">
            <option v-for="account of accounts" :key="account.id" :value="account.name">{{ account.name }}</option>
        </datalist>
        <div class="px-4 pt-4 bg-primary-content flex flex-row gap-x-2">
            <div class="form-control">
                <div class="input-group input-group-xs">
                    <span>Data</span>
                    <input type="date" v-model="form.date" class="input input-bordered input-xs" autofocus>
                </div>
                <label class="label" v-if="form.errors.date">
                    <span class="label-text-alt text-error">{{ form.errors.date }}</span>
                </label>
            </div>
            <div class="form-control">
                <div class="input-group input-group-xs">
                    <span>Conta Origem</span>
                    <input list="accounts" type="text" v-model="form.from" placeholder="?" class="input input-bordered input-xs" >
                </div>
                <label class="label" v-if="form.errors.from">
                    <span class="label-text-alt text-error">{{ form.errors.from }}</span>
                </label>
            </div>
            <div class="mb-2 divider xs:divider-horizontal text-primary font-bold">>></div>
            <div class="form-control">
                <div class="input-group input-group-xs">
                    <span>Conta Destino</span>
                    <input list="accounts" type="text" v-model="form.to" placeholder="?" class="input input-bordered input-xs" >
                </div>
                <label class="label" v-if="form.errors.to">
                    <span class="label-text-alt text-error">{{ form.errors.to }}</span>
                </label>
            </div>  
            <div class="form-control">
                <div class="input-group input-group-xs">
                    <span>Valor</span>
                    <input type="number" step="0.01" min="0" v-model="form.amount" placeholder="0,0" class="input input-xs" >
                </div>
                <label class="label" v-if="form.errors.amount">
                    <span class="label-text-alt text-error">{{ form.errors.amount }}</span>
                </label>
            </div>
        </div>
        <div class="px-4 pb-4 bg-primary-content">
            <div class="form-control">
                <div class="input-group input-group-xs">
                    <span>Descrição</span>
                    <input type="text" v-model="form.description" class="input input-xs w-full" placeholder="Opcional, ex.: compras para almoço do final de semana">
                    <button type="submit" class="btn btn-xs btn-primary" :class="{loading: form.processing}">Lançar</button>
                </div>
            </div>
        </div>
    </form>
</template>