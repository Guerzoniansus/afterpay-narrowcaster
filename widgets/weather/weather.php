<?
// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value
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

function CallAPI($method, $url, $data = false)
{
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
$currentweathercode = CallAPI("POST","api.openweathermap.org/data/2.5/weather?id=2754669&appid=4bbb93bb09fb3e81168d23a070f612b5");
$currentweather = json_decode($currentweathercode, true);
echo print_r($currentweather);
// foreach($currentweather as $item){
//     $type = gettype($item);
//     if($type == "array"){
//         foreach($item as $items){
//             $types = gettype($items);
//             if($types == "array"){
//                 foreach($items as $itemss){
//                     echo $itemss . "<br/>";
//                 }
//             }else echo $items . "<br/>";
//         }
//     }
//     else echo $item . "<br/>";
// }
$temp = round($currentweather["main"]["temp"]-273,1);
$feeltemp = round($currentweather["main"]["feels_like"]-273,1);
$pressure = $currentweather["main"]["pressure"];
$humidity = $currentweather["main"]["humidity"];
$windspeed = round($currentweather["wind"]["speed"],1);
$windspeedbf = ConvertToBeaufort($currentweather["wind"]["speed"]);
$cardinaldirection = ConvertCardinalDirection($currentweather["wind"]["deg"]);
$skies = $currentweather["weather"][0]["main"];
?>
<h1><?=$currentweather["name"]?></h1>
<h3><?=$skies?></h3>
<h3>Current temperature: <?=$temp?>°C</h2>
<h3>It feels like: <?=$feeltemp?>°C</h2>
<h3>The air pressure is: <?=$pressure?> hPa</h2>
<h3>The humidity is: <?=$humidity?>%</h2>
<h2>Wind: <?=$windspeedbf?> Bf (<?=$windspeed?> m/s) <?=$cardinaldirection[0]?></h2>
<h3></h3>
<?php
?>