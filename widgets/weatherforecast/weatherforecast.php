<style>
    #forecast{
        font-size:225%;
    }
    #forecasticon{background-color:rgba(153,215,150,0.5); border-radius:100%;}
    .forecasttd{
        border-radius:20px;
    }
    .forecasttr{background-color: rgba(77,167,122,0.05);}
    .forecasttr:nth-child(even){background-color: rgba(153,215,150,0.05)}
    .forecasttr:last-child{font-size:50%; background-color:transparent;}
</style>
<table id="forecast" width=90% height=90%>
    
</table>

<script>
    $(document).ready(function(){
        loadForecast();
        setInterval(loadForecast,60000);
    });
    function loadForecast(){
        $('#forecast').load("widgets/weatherforecast/forecastload.php");
    }
</script>