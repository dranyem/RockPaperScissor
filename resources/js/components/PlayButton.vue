<template>
    <div class="tile">
        <h1 class="subtitle">{{winner.toUpperCase()}}</h1>
        <button class="button is-success is-medium" @click="play">PLAY!</button>
    </div>
</template>
<script>
export default {
    name: 'PlayButton',
    data(){
        return{
            playerMove: "rock",
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
            var top = this;
            axios.get('/get-move')
                .then(response => {
                    var index =0;
                    var moves = ["rock","paper","scissor","rock","paper","scissor"];
                    var interval = setInterval(function(){
                        top.$root.$emit('animateImage',moves[index]);
                        index++;
                    },500);
                    var clearInt =
                    setTimeout(function(){
                        top.computerMove = response.data.move;
                        top.$root.$emit('computerMove', top.computerMove);
                        top.checkForWin();
                        clearInterval(interval)
                    },3000);

                })
                .catch(error => {
                    console.log(error);
                    this.quote = 'Error';
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
            } else {
                this.winner = "Please choose your move!";
            }
        }
    },
}
</script>
<style scoped>

</style>
