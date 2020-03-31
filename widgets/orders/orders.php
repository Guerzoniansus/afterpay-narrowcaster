<?php

?>

<h1 style="font-size: 100px">Orders:</h1>
<h2 style="font-size: 70px" class="orderAmount" align="center"></h2>

<script>

    // 1000 milliseconds * 5
    var timerInterval = 1000 * 5;

    function loadOrders() {
        $(".orderAmount").load('../../DB.php', {action: "getOrders"} );
    }

    function updateOrders() {
        // Random number rounded down to whole number between 1000 and 11000
        var randomNumber = Math.floor(Math.random() * 10000) + 1000;

        $.post('../../DB.php', {action: "updateOrders", newAmount: randomNumber}, function() {
            loadOrders();
        })
    }

    $(document).ready(function() {
        loadOrders();

        var timer = setInterval(updateOrders, timerInterval);
    })


</script>
