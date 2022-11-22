<script setup>
    import { Inertia } from '@inertiajs/inertia';
    
    const props = defineProps({date: Date});

    function backOneMonth() {
        var date = props.date;
        
        date.setMonth(date.getMonth() - 1);

        Inertia.get('', {display_month: date.toISOString()});
    }

    function forwardOneMonth() {
        var date = props.date;
            
        date.setMonth(date.getMonth() + 1);

        Inertia.get('', {display_month: date.toISOString()});
    }

    
</script>
<template>
    <div class="flex items-center px-2">
        <font-awesome-icon icon="fa-backward" class="hover:bg-rose-400 rounded p-2 active:bg-rose-200" @click="backOneMonth()" />
        <div class="mx-auto w-fit">
            {{ date.toLocaleDateString('default', {month:'long', year: 'numeric'}) }}
        </div> 
        <font-awesome-icon icon="fa-forward" class="hover:bg-rose-400 rounded p-2 active:bg-rose-200" @click="forwardOneMonth()" />
    </div>
</template>