const psg = document.getElementsByClassName("psg");
const mutd = document.getElementsByClassName("mutd");
const rma = document.getElementsByClassName("rma");
const chelsea = document.getElementsByClassName("chelsea");
const napoli = document.getElementsByClassName("napoli");
const ol = document.getElementsByClassName("ol");

var cardsShown = [];

const teamArray = [psg[0], psg[1], mutd[0], mutd[1], rma[0], rma[1], chelsea[0], chelsea[1], napoli[0], napoli[1], ol[0], ol[1]];

shuffle();

function shuffle(){
    const teamContainer = document.getElementById("teamContainer");
    const used = [false, false, false, false, false, false, false, false, false, false, false, false]
    var id = 0;
    var usedAll = false;
    while(!usedAll){
        var teamNum = getRandomInt(12);
        if(!used[teamNum]){
            teamArray[teamNum].id = id;
            teamContainer.append(teamArray[teamNum]);
            teamContainer.removeChild(teamContainer.firstChild);
            used[teamNum] = true;
            id++;
        }
        usedAll = true;
        used.forEach((use) => {
            if(!use){ usedAll = false }
        })
    }
}

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}

function showCard(clickedTeam){
    const teamContainer = document.getElementsByClassName("card");
    console.log(clickedTeam)
    teamContainer[clickedTeam.id].classList.remove("card-back");
    cardsShown.push(clickedTeam.id);
    if(cardsShown.length === 2){
        if(teamContainer[cardsShown[0]].classList[1] === teamContainer[cardsShown[1]].classList[1]){
            teamContainer[cardsShown[0]].classList.add("match");
            teamContainer[cardsShown[1]].classList.add("match");
        }
    }
    setTimeout(() => {
        console.log(cardsShown)
        if(cardsShown.length === 2){ 
            [...teamContainer].forEach((team) => {
                console.log(team.classList[2])
                if(team.classList[2] !== "match"){
                    team.classList.add("card-back");
                }
            })
            cardsShown = [];
        }
    },1000);
    var count = 0;
    [...teamContainer].forEach((team) => {
        if(team.classList[2] === "match"){
            count++;
            console.log(count);
        }
    })
    if(count === 12){ win() }
}

function win(){
    setTimeout(() => {
        alert("Vous avez gagné");
        window.location.reload();
    },1000);
}