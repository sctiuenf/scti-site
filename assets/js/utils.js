function capitalize(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function addZero(time){
    return time < 10 ? '0' + time:time;
}