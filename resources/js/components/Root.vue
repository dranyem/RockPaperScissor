<template>
    <div id="container">
        <div id="streak">
            <h1>score</h1>
            <!-- <StreakTracker :streak="currentStreak" /> -->
        </div>
        <div id="player-box">
            <h1>You</h1>
            <MoveButton />
            <div>
                <img :src="playerMoveImage" >
            </div>
        </div>
        <div id="computer-box">
            <h1>Computer</h1>
            <div>
                <img  :src="computerMoveImage" >
            </div>
        </div>
        <div id="play">
            <h1>play</h1>
            <!-- <PlayButton /> -->
        </div>

    </div>
</template>

<script>
import MoveButton from './MoveButton.vue'
    export default {
        name: 'Root',
        data(){
            return {
                currentStreak: 0,
                playerMoveImage: "images/default.png",
                computerMoveImage: "images/default.png",
            }
        },
        components: {
            MoveButton,
        },
        mounted(){
            this.$root.$on('move', this.changeImage);
        },
        methods: {
            changeImage(data){
                this.playerMoveImage = "images/"+data+".png"
            }
        }

    }
</script>

<style>
*{
    margin: 0;
    padding: 0;
}
body{
     background-color: lightblue;
}
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
    border: 1px solid black;
    grid-area: play;
}
#player-box{
    border: 1px solid black;
    display: grid;
    gap: 20px;
    grid-area: playerBox;
}
#computer-box{
    border: 1px solid black;
    display: grid;
    grid-area: computerBox;
}
img{
    width: 500px;
    height: 400px;
}
</style>
