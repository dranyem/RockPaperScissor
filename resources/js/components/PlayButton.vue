<template>
    <div>
        <h1>{{winner}}</h1>
        <button @click="play">PLAY!</button>
    </div>
</template>
<script>
export default {
    name: 'PlayButton',
    data(){
        return{
            playerMove: "",
            computerMove: "",
            winner: "",
        }
    },
    mounted(){
        this.$root.$on('move', this.player);
    },
    methods: {
        player(data){
            this.playerMove = data;
        },
        play(){
            axios.get('/get-move')
                .then(response => {
                    this.computerMove = response.data.move;
                    this.$root.$emit('computerMove', this.computerMove);
                    this.checkForWin();
                })
                .catch(error => {
                    console.log(error);
                    this.quote = 'Error getting that sweet sweet Kanye Quote';
                });
        },
        checkForWin(){
            if(this.computerMove==this.playerMove){
                this.$root.$emit('draw');
                this.winner = "DRAW!!";
            } else if(this.playerMove=="rock"){
                if(this.computerMove=="paper"){
                    this.$root.$emit('computerWins');
                    this.winner = "Computer Won!! Try again.";
                } else if(this.computerMove=="scissor"){
                    this.$root.$emit('playerWins');
                    this.winner = "You Won!! Keep it up.";
                }
            } else if(this.playerMove=="paper"){
                if(this.computerMove=="rock"){
                    this.$root.$emit('playerWins');
                    this.winner = "You Won!! Keep it up.";
                } else if(this.computerMove=="scissor"){
                    this.$root.$emit('computerWins');
                    this.winner = "Computer Won!! Try again.";
                }
            } else if(this.playerMove=="scissor"){
                if(this.computerMove=="paper"){
                    this.$root.$emit('playerWins');
                    this.winner = "You Won!! Keep it up.";
                } else if(this.computerMove=="rock"){
                    this.$root.$emit('computerWins');
                    this.winner = "Computer Won!! Try again.";
                }
            }
        }
    },
}
</script>
<style scoped>

</style>
