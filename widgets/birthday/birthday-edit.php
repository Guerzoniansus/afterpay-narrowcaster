<?php
require_once 'DB.php';

$db = new DB();
$employees = $db->getBirthdayEmployees();

?>
<div style="width: 100%; height: 100%; overflow: hidden; padding: 20px; font-size: 15px; text-align: center;">
<a href="birthdaysettings.php" target="_blank">Klik hier om verjaardagen wel of niet te laten zien</a>
<h1> Verjaardagen 🎉 </h1>
<? foreach ($employees as $employee): ?>
<h5 style="background-color: rgba(77,167,122,1);"><?= $employee->employeeName ?></h5>
<p>Functie:   <?= $employee->function ?></p>
<p><?= $employee->birthday ?></p>
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