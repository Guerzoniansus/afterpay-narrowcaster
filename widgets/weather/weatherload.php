<?
if(!function_exists("ConvertToBeaufort")){
    function ConvertToBeaufort($speed){
        switch ($speed){
            default:
                return 0;
            break;
            case $speed<1.6:
                return 1;
                break;
            case $speed<3.4:
                return 2;
                break;
            case $speed>=3.4:
                return 3;
                break;
            case $speed>=5.5:
                return 4;
                break;
            case $speed>=8:
                return 5;
                break;
            case $speed>=10.8:
                return 6;
                break;
            case $speed>=13.9:
                return 7;
                break;
            case $speed>=17.2:
                return 8;
                break;
            case $speed>=20.8:
                return 9;
                break;
            case $speed>=24.5:
                return 10;
                break;
            case $speed>=28.5:
                return 11;
                break;
            case $speed>=32.7:
                return 12;
                break;
        }
    }
}
if(!function_exists("ConvertCardinalDirection")){
    function ConvertCardinalDirection($direction){
        switch ($direction){
            default:
                return array(0=>"North",1=>"N");
                break;
            case $direction>=337.5&&$direction<22.5:
                return array(0=>"North",1=>"N");
                break;
            case $direction>=22.5&&$direction<67.5:
                return array(0=>"North-East",1=>"NE");
                break;
            case $direction>=67.5&&$direction<112.5:
                return array(0=>"East",1=>"E");
                break;
            case $direction>=112.5&&$direction<157.5:
                return array(0=>"South-East",1=>"SE");
                break;
            case $direction>=157.5&&$direction<202.5:
                return array(0=>"South",1=>"S");
                break;
            case $direction>=202.5&&$direction<247.5:
                return array(0=>"South-West",1=>"SW");
                break;
            case $direction>=247.5&&$direction<292.5:
                return array(0=>"West",1=>"W");
                break;
            case $direction>=292.5&&$direction<337.5:
                return array(0=>"North-West",1=>"NW");
                break;
        }
    }
}
if(!function_exists("CallAPI")){
    function CallAPI($method, $url, $data = false){
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);
        return $result;
    }
}

$currentweathercode = CallAPI("POST","api.openweathermap.org/data/2.5/weather?id=2754669&appid=4bbb93bb09fb3e81168d23a070f612b5&units=metric");
$currentweather = json_decode($currentweathercode, true);

// echo print_r($currentweather);

$temp = round($currentweather["main"]["temp"],1);
$feeltemp = round($currentweather["main"]["feels_like"],1);
$pressure = $currentweather["main"]["pressure"];
$humidity = $currentweather["main"]["humidity"];
$windspeed = round($currentweather["wind"]["speed"],1);
$windspeedbft = ConvertToBeaufort($currentweather["wind"]["speed"]);
$cardinaldirection = ConvertCardinalDirection($currentweather["wind"]["deg"]);
$cityname =  $currentweather["name"];
$skies = $currentweather["weather"][0]["main"];
$weathericon = $currentweather["weather"][0]["icon"];
?>
<tr class="weathertr">
    <td class="weathertd">The weather in <?=$cityname?></td>
    <td class="weathertd"><img id="weathericon" src="http://openweathermap.org/img/wn/<?=$weathericon?>@2x.png" height=80 width=80> <?=$skies?></td>
</tr>
<tr class="weathertr">
    <td class="weathertd">Temperature</td>
    <td class="weathertd"><?=$temp?>°C</td>
</tr>
<tr class="weathertr">
    <td class="weathertd">Wind chill Temperature</td>
    <td class="weathertd"><?=$feeltemp?>°C</td>
</tr>
<tr class="weathertr">
    <td class="weathertd">Air pressure</td>
    <td class="weathertd"><?=$pressure?> hPa</td>
</tr>
<tr class="weathertr">
    <td class="weathertd">Humidity</td>
    <td class="weathertd"><?=$humidity?>%</td>
</tr>
<tr class="weathertr">
    <td class="weathertd">Wind</td>
    <td class="weathertd"><?=$windspeedbft?> Bft (<?=$windspeed?> m/s) <?=$cardinaldirection[1]?></td>
</tr>