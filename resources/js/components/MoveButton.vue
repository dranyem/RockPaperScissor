<template>
    <div class="columns" id="moves">
        <button class=" column button is-danger" @click="playerMove('rock')">ROCK</button>
        <button class="column button is-info" @click="playerMove('paper')">PAPER</button>
        <button class="column button is-warning" @click="playerMove('scissor')">SCISSOR</button>
    </div>
</template>

<script>
export default {
    name: 'MoveButton',
    methods:{
        playerMove(data){
            this.$root.$emit('move', data);
        }
    },
}
</script>
<style scoped>
    #moves{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 10px;
    }
</style>
