<div id="countdown-div" class="countdown">
<h1 id="countdown-text"></h1>
</div>
<h3 id="friday">Until Friday 16:30</h3>
<h3 id="currentDateText"></h3>
<img id="partyimg" src="widgets/countdown/365.gif" style="display:none"></img>

<script>
    function ToTwoDigits(value) {
        return ('00' + value).slice(-2);
    }

    $(document).ready(function() {
        var currentDate = new Date("l n F Y");
        // Set the date we're counting down to
        var countDownDate = new Date();
        countDownDate.setDate(countDownDate.getDate() + (5 - countDownDate.getDay()));
        countDownDate.setHours(16);
        countDownDate.setMinutes(30);
        countDownDate.setSeconds(0);
        countDownDate.setMilliseconds(0);
        var friday = countDownDate;
        // Convert to number.
        countDownDate = countDownDate.getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);


            var today = new Date();
            var d = new Date();
            var month = new Array();
            month[0] = "January";
            month[1] = "February";
            month[2] = "March";
            month[3] = "April";
            month[4] = "May";
            month[5] = "June";
            month[6] = "July";
            month[7] = "August";
            month[8] = "September";
            month[9] = "October";
            month[10] = "November";
            month[11] = "December";
            var monthLetters = month[d.getMonth()];

            var date = friday.getDate() + ' ' + (monthLetters) + ' ' + friday.getFullYear();
            
            document.getElementById("currentDateText").innerHTML = date;
            document.getElementById("countdown-text").innerHTML = days + "d " + ToTwoDigits(hours) + "h " + ToTwoDigits(minutes) + "m " + ToTwoDigits(seconds) + "s";

            if (distance < 0) {
                clearInterval(x);
                var day = new Date().getDay();
                var weekend = day == 6 || day == 0;
                if (weekend) {
                    document.getElementById("countdown-text").innerHTML = "WEEKEND!";
                }
                else if (day == 5) {
                    // Friday
                    document.getElementById("partyimg").style.display = "block";
                    document.getElementById("friday").style.display = "none";
                    document.getElementById("countdown-text").innerHTML = "PARTY TIME!";
                }
                else {
                    document.getElementById("countdown-text").innerHTML = "Something went wrong.";
                }
            }
            else {
                document.getElementById("partyimg").style.display = "none";
                document.getElementById("friday").style.display = "block";
            }
        }, 1000);
    });
</script>

<style>
    .countdown {
        background: #87CD9B;
        padding: 10px;
        margin: 10px;
        width: 60%;
        text-align: center;
    }
</style>