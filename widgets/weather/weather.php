<style>
    #weatherdisplay{
        font-size:225%;
    }
    #weathericon{background-color:rgba(153,215,150,0.5); border-radius:100%;}
    .weathertd{
        border-radius:20px;
    }
    .weathertr{background-color: rgba(77,167,122,0.05);}
    .weathertr:nth-child(even){background-color: rgba(153,215,150,0.05)}
</style>
<table id="weatherdisplay" width=90% height=90%>
    
</table>

<script>
    $(document).ready(function(){
        loadWeather();
        setInterval(loadWeather, 60000);
    });
    function loadWeather(){
        $('#weatherdisplay').load("widgets/weather/weatherload.php");
    }
</script>