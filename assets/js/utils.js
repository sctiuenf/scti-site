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