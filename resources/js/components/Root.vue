<template>
    <div id="container">
        <div class="level" id="streak">
            <h1 class="title level-left">Current Streak : {{currentStreak}}</h1>
            <h1 class="title level-right">Highest Streak : {{highestStreak}}</h1>
        </div>
        <div class="box" id="player-box" :class="this.isPlayerWinner? 'win':'lose'">
            <h1 class="title">You</h1>
            <MoveButton />
            <div>
                <img :src="playerMoveImage" >
            </div>
        </div>
        <div class="box" id="computer-box" :class="this.isComputerWinner? 'win':'lose'">
            <h1 class="title">Computer</h1>
            <h2 class="subtitle">{{computerMove.toUpperCase()}}</h2>
            <div>
                <img :src="computerMoveImage" >
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
                playerMoveImage: "images/rock.png",
                computerMoveImage: "images/default.png",
                computerMove:"",
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
            this.$root.$on('animateImage', this.animate);
        },
        methods: {
            changeImage(data){
                this.playerMoveImage = "images/"+data+".png";
            },
            changeComputerImage(data){
                this.computerMoveImage = "images/"+data+".png";
                this.computerMove = data;
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
            },
            animate(data){
                this.computerMoveImage = "images/"+data+".png";
                this.computerMove = data;
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
    margin: 10px 30px 0 30px;
    place-self: center;
    grid-template-areas: 'streak streak'
                         'playerBox computerBox'
                         'playerBox computerBox'
                         'play play';
    text-align: center;
    /* gap: 50px; */
    row-gap: 0;
    column-gap: 25px;

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
    min-width: 200px;
    width: 300px;
    height: 300px;
}
.win{
    border: 5px solid green;
}
.lose{
    border: 5px solid red;
}
</style>
