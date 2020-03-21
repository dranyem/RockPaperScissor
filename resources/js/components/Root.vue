<template>
    <div id="container">
        <div id="streak">
            <h1>Current Streak : {{currentStreak}}</h1>
            <h1>Highest Streak : {{highestStreak}}</h1>
        </div>
        <div id="player-box" :class="this.isPlayerWinner? 'win':'lose'">
            <h1>You</h1>
            <MoveButton />
            <div>
                <img :src="playerMoveImage" >
            </div>
        </div>
        <div id="computer-box" :class="this.isComputerWinner? 'win':'lose'">
            <h1>Computer</h1>
            <div>
                <img  :src="computerMoveImage" >
            </div>
        </div>
        <PlayButton id="play"/>

    </div>
</template>

<script>
import MoveButton from './MoveButton.vue'
import PlayButton from './PlayButton.vue'
    export default {
        name: 'Root',
        data(){
            return {
                currentStreak: 0,
                highestStreak: 0,
                playerMoveImage: "images/default.png",
                computerMoveImage: "images/default.png",
                isPlayerWinner: true,
                isComputerWinner: true,
            }
        },
        components: {
            MoveButton,
            PlayButton,
        },
        mounted(){
            this.$root.$on('move', this.changeImage);
            this.$root.$on('computerMove', this.changeComputerImage);
            this.$root.$on('computerWins', this.computerWon);
            this.$root.$on('playerWins', this.playerWon);
            this.$root.$on('draw', this.draw);
        },
        methods: {
            changeImage(data){
                this.playerMoveImage = "images/"+data+".png";
            },
            changeComputerImage(data){
                this.computerMoveImage = "images/"+data+".png";
            },
            playerWon(){
                this.currentStreak++;
                this.isPlayerWinner = true;
                this.isComputerWinner =false;
                if(this.currentStreak>this.highestStreak){
                    this.highestStreak = this.currentStreak;
                }

            },
            computerWon(){
                this.currentStreak=0;
                this.isPlayerWinner = false;
                this.isComputerWinner =true;
            },
            draw(){
                this.isPlayerWinner = true;
                this.isComputerWinner =true;
            }

        }

    }
</script>

<style>
*{
    margin: 0;
    padding: 0;
}
/* body{
     background-color: lightblue;
} */
#container {
    display: grid;
    margin: 20px;
    /* place-items: center; */
    place-self: center;
    grid-template-areas: 'streak streak'
                         'playerBox computerBox'
                         'playerBox computerBox'
                         'play play';
    text-align: center;
    gap: 20px;

}
#streak{
    grid-area: streak;
}
#play{
    display: grid;
    place-content: center;
    grid-area: play;
}
#player-box{
    /* border: 1px solid black; */
    display: grid;
    gap: 20px;
    grid-area: playerBox;
}
#computer-box{
    /* border: 1px solid black; */
    display: grid;
    grid-area: computerBox;
}
img{
    width: 500px;
    height: 400px;
}
.win{
    border: 5px solid green;
}
.lose{
    border: 5px solid red;
}
</style>
