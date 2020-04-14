<?php
require_once 'DB.php';

$db = new DB();
$employees = $db->getBirthdayEmployees();

if (!function_exists("calculateAge")) {
	function calculateAge($birthday) {
		$date  = new DateTime($birthday);
		$now = new DateTime();
		$difference = $now->diff($date);
		// y means years
		return $difference->y;
	}
}

?>
<div style="width: 100%; height: 100%; overflow: hidden; padding: 20px; font-size: 15px; text-align: center;">
<a href="birthdaysettings.php" target="_blank">(Click here to choose whose birthday does or doesn't get shown)</a>
<h1> Birthdays 🎉 </h1>
    <br>
<? foreach ($employees as $employee): ?>
<h1 style="background-color: #87CD9B;"><?= $employee->employeeName ?></h1>
    <h2>Age: <?= calculateAge($employee->birthday) ?></h2>
<p>Function:   <?= $employee->function ?></p>
<? endforeach; ?>
</div>


<script>

    $(document).ready(function() {

        $('.birthdayDisplayOption').change(function() {
            var employeeID = $(this).attr("name");
            var newValue = $(this).val();

            $.post("DB.php",
                {
                    action: "updateBirthdayDisplay",
                    employeeID: employeeID,
                    newValue: newValue,
                });
        });

    });
</script>