<div class="travel-stuff">

</div>

<script>
    $(document).ready(function(){
        loadTravel();
        setInterval(loadTravel,60000); // 1 minute
    });
    function loadTravel() {
        $('.travel-stuff').load("widgets/travel/travel-loader.php");
    }
</script>


