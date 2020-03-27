function startTopbarClock() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTimeTopbar(m);
    s = checkTimeTopbar(s);
    document.getElementById('topbar-time').innerHTML =
        h + ":" + m;
    var t = setTimeout(startTopbarClock, 500);
}

function checkTimeTopbar(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

function showTopbarDate() {
    var today = new Date();
    // month is +1 because it starts at 0
    var date = today.getDate() + '/' + (today.getMonth()+1) + '/' + today.getFullYear();
    $("#topbar-date").text(date);
}

$(document).ready(function() {
    startTopbarClock();
    showTopbarDate();
});