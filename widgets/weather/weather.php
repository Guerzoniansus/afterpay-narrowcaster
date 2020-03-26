<?
// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

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
$strjson = CallAPI("POST","api.openweathermap.org/data/2.5/weather?id=2754669&appid=4bbb93bb09fb3e81168d23a070f612b5");
$decodejson = json_decode($strjson, true);
echo var_dump($decodejson);
foreach($decodejson as $item){
    $type = gettype($item);
    if($type == "array"){
        foreach($item as $items){
            $types = gettype($items);
            if($types == "array"){
                foreach($items as $itemss){
                    echo $itemss . "<br/><br/><br/>";
                }
            }else echo $items . "<br/><br/>";
        }
    }
    else echo $item . "<br/>";
}
echo "<h1>Het weer in ".$decodejson['name']."</h1>";
?>