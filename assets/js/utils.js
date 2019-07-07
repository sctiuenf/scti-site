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