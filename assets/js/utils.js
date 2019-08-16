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

function currentSection(){
    let secs = $('section');
    let scrollPos = $(window).scrollTop();
    let tolerance = window.innerHeight*0.2;

    let closerSec = null;

    $.each(secs, function (i, v) {
        let sec = $(v);
        secDist = sec.offset().top - scrollPos;

        if(closerSec === null)
            closerSec = sec;
        else if(Math.abs(secDist) < Math.abs(closerSec.offset().top - scrollPos) && secDist < tolerance)
            closerSec = sec;
    });

    return closerSec;
}

var alertTimeout;
function showAlert(type, text){
    let alert = $('#custom-alert');
    let alertText = alert.find('span');

    let animationEvent = 'webkitAnimationEnd oanimationend msAnimationEnd animationend';

    alert.on(animationEvent, function(){
        alert.removeClass('shaking-alert');
    })

    //if the same alert is visible
    if(alert.css('display') !== 'none' && alert.hasClass(type) && alertText.html() === text){
        
        alert.stop();
        alert.css('opacity', 1);
        alert.addClass('shaking-alert');

        clearTimeout(alertTimeout);

        alertTimeout = setTimeout(function(){
            alert.animate({'opacity': 0}, 2000, function(){
                hideAlert();
            })
        }, 5000);
        
        return;
    }

    alertText.html(text);
    alert.attr('class', 'alert alert-dismissible');
    alert.addClass(type);
    alert.css('opacity', 1);
    alert.show();

    alert.animate({'top': '10%'}, 500, function(){
        alertTimeout = setTimeout(function(){
            alert.animate({'opacity': 0}, 2000, function(){
                hideAlert();
            })
        }, 5000);
    });
}

function hideAlert(){
    let alert = $('#custom-alert');

    alert.css('top', '-5%');
    alert.hide();
}
function onlyNumber(tel){
   let arr = tel.match(/\d/g);
   return arr ? arr.join(''):'';
}

function getMaskedTell(tel){
  let maskedTell = '';
 
  if(tel.length > 0){
      tel.split('').forEach((v, i) => {
        if(i == 0)
          maskedTell += '('+ v;
        else if(i == 2)
          maskedTell += ') ' + v;
        else if(i == 3)
          maskedTell += ' ' + v;
        else if(i == 7)
          maskedTell += '-' + v;
        else 
          maskedTell += v;
      }); 
  }
  return maskedTell;
}



