const psg = document.getElementsByClassName("psg");
const mutd = document.getElementsByClassName("mutd");
const rma = document.getElementsByClassName("rma");
const chelsea = document.getElementsByClassName("chelsea");
const napoli = document.getElementsByClassName("napoli");
const ol = document.getElementsByClassName("ol");

const teamArray = [psg[0], psg[1], mutd[0], mutd[1], rma[0], rma[1], chelsea[0], chelsea[1], napoli[0], napoli[1], ol[0], ol[1]];

//shuffle();

function shuffle(){
    const teamContainer = document.getElementById("teamContainer");
    for(var i=0; i<20; i++){
        var teamNum = getRandomInt(12);
        teamContainer.append(teamArray[teamNum])
    }
}

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}