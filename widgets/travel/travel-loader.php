<?php
function getData()
{
	$service_url = 'http://v0.ovapi.nl/stopareacode/hreoos';
	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
		$info = curl_getinfo($curl);
		curl_close($curl);
		die('error occured during curl exec. Additional info: ' . var_export($info));
	}
	curl_close($curl);
	// Het JSON-bestand wordt omgezet naar een PHP array
	$decoded = json_decode($curl_response, true);

	if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		die('Something went wrong: ' . $decoded->response->errormessage);
	}
	// Hierin zit DE informatie
	$allInfo = $decoded['hreoos']['24002020'];
	return $allInfo;
}

$dataInfo = getData();

?>

<h1><?php echo ($dataInfo['Stop']['TimingPointTown']); echo(" - "); echo ($dataInfo['Stop']['TimingPointName'])?></h1>
<table id="travelTable">
	<?php foreach ($dataInfo['Passes'] as $passData) : ?>
		<tr>
			<td><?php echo ($passData['LinePublicNumber']) ?></td>
			<td><?php echo ($passData['DestinationName50']) ?></td>
			<td><?php $dt = new \DateTime($passData['ExpectedDepartureTime']);
				echo $dt->format('H:i'); ?></td>
		</tr>
	<?php endforeach ?>
</table>

<script>
    $(document).ready(function() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("travelTable");
        switching = true;
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 0; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[2];
                y = rows[i + 1].getElementsByTagName("TD")[2];
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
	});
</script>
