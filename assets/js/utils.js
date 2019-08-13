function capitalize(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function formatHour(dateString){
    let date = new Date(dateString);
    let fullHour = addZero(date.getHours());

    let minutes = date.getMinutes();
    if(minutes > 0)
        fullHour += ':' + addZero(minutes);

    return fullHour;
}

function addZero(time){
    return time < 10 ? '0' + time:time;
}

function getCurrentPath(){
    return window.location.pathname.split('/').pop();
}

function rootUrl(){
    let protocol = window.location.protocol;
    let hostname = window.location.hostname;

    if(hostname.indexOf('localhost') !== -1)
        hostname += '/scti';
    
    return protocol + '//' + hostname;
}

//Randomiza um número em um intervalo
function random(v1, v2){
    return v1 + Math.random() * (v2 - v1);
}

function dist2dSqr(x1, y1, x2, y2){
    return Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2);
}

//Reescala um número pertencente a um intervalo em um novo intervalo
function map(v, oldMin, oldMax, newMin, newMax){
    let prop = (v - oldMin) / (oldMax - oldMin);
    return newMin + prop * (newMax - newMin);
}