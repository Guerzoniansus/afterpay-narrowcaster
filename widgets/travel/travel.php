<div class="travel-stuff" style="height: 100%; width: 100%; overflow-y: hidden;">
</div>

<script>
    $(document).ready(function(){
        loadTravel();
        setInterval(loadTravel, 60000); // 1 minute
    });

    function loadTravel() {
        $('.travel-stuff').load("widgets/travel/travel-loader.php");
    };
</script>

