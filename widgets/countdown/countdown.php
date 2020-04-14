<h1 id="currentDateText"></h1>
<h1 id="currentTimeText"></h1>
<p id="countdown-text"></p>

<script>

   $(document).ready(function() {
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
    
            var date = today.getDate() +' '+ (monthLetters)+' '+ today.getFullYear();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            document.getElementById("currentDateText").innerHTML = date;
            document.getElementById("currentTimeText").innerHTML = time;
           document.getElementById("countdown-text").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s " + "until Friday.";

           if (distance < 0) {
               clearInterval(x);
               var day = new Date().getDay();
               var weekend = day == 6 || day == 0;
               if (weekend) {
                document.getElementById("countdown-text").innerHTML = "WEEKEND!";
               }
               document.getElementById("countdown-text").innerHTML = "Something went wrong.";
           }
       }, 1000);
   });

</script>