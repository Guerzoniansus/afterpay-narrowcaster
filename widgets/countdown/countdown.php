<!DOCTYPE HTML>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        p {
            text-align: center;
            font-size: 60px;
            margin-top: 0px;
        }
    </style>
</head>

<body>
    <p id="currentDateText"></p>
    <p id="text"></p>

    <script>
        
        var currentDate = new Date("l n F Y");
        // Set the date we're counting down to
        var countDownDate = new Date();
        countDownDate.setDate(countDownDate.getDate() + (5 - countDownDate.getDay()));
        countDownDate.setHours(16);
        countDownDate.setMinutes(30);
        countDownDate.setSeconds(0);
        countDownDate.setMilliseconds(0);

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

            document.getElementById("currentDateText").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            document.getElementById("text").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(x);
                var day = new Date().getDay();
                var weekend = day == 6 || day == 0;
                if (weekend) {
                    // Show image
                }
                document.getElementById("text").innerHTML = "Fuck t maar";
            }
        }, 1000);

    </script>

</body>

</html>