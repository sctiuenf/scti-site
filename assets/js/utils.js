function capitalize(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function addZero(time){
    return time < 10 ? '0' + time:time;
}

function getCurrentPath(){
    return window.location.pathname.split('/').pop();
}
//Randomiza um número em um intervalo
function random(v1, v2){
    return v1 + Math.random() * (v2 - v1);
}

//Reescala um número pertencente a um intervalo em um novo intervalo
function map(v, oldMin, oldMax, newMin, newMax){
    let prop = (v - oldMin) / (oldMax - oldMin);
    return newMin + prop * (newMax - newMin);
}

//Função que retorna a distância ao quadrado entre dois pontos num ambiente 2d
function dist2dSqr(x1, y1, x2, y2){
    return Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2);
}

//Função que retorna o menor entre dois valores
function min(n1, n2){
    return (n1 < n2 ? n1 : n2);
}

//Função que retorna o menor entre dois valores
function max(n1, n2){
    return (n1 < n2 ? n2 : n1);
}