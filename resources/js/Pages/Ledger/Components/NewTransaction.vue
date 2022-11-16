<script setup>
    import {useForm} from '@inertiajs/inertia-vue3';

    const form = useForm({
        date: (new Date()).toISOString().split('T')[0],
        from: '',
        to: '',
        description: '',
        amount: 0.0
    });
</script>
<template>
    <form @submit.prevent="form.post('/transaction')">
        <div class="px-4 pt-4 bg-primary-content flex flex-row gap-x-2">
            <div class="form-control">
                <div class="input-group input-group-sm">
                    <span>Data</span>
                    <input type="date" v-model="form.date" class="input input-bordered input-sm" autofocus>
                </div>
            </div>
            <div class="form-control">
                <div class="input-group input-group-sm">
                    <span>Conta Origem</span>
                    <input type="text" v-model="form.from" class="input input-bordered input-sm" required>
                </div>
            </div>
            <div class="divider sm:divider-horizontal text-primary font-bold">>></div>
            <div class="form-control">
                <div class="input-group input-group-sm">
                    <span>Conta Destino</span>
                    <input type="text" v-model="form.to" class="input input-bordered input-sm" required>
                </div>
            </div>  
            <div class="form-control">
                <div class="input-group input-group-sm">
                    <span>Valor</span>
                    <input type="number" step="0.1" v-model="form.amount" class="input input-sm" required>
                </div>
            </div>
        </div>
        <div class="px-4 pb-4 bg-primary-content">
            <div class="form-control">
                <div class="input-group input-group-sm">
                    <span>Descrição</span>
                    <input type="text" v-model="form.description" class="input w-full">
                    <button type="submit" class="btn btn-primary">Lançar</button>
                </div>
            </div>
        </div>
    </form>
</template>