<?php
require 'DB.php';

$db = new DB();
$employees = $db->getBirthdayEmployees();

?>
<div style="width: 100%; height: 100%; overflow: hidden; padding: 20px; font-size: 15px; text-align: center;">
<h1> Verjaardagen: </h1>
<? foreach ($employees as $employee): ?>
<p style="background-color: rgba(77,167,122,1); font-size 18px;">Naam:   <?= $employee->employeeName ?></p>
<p>Functie:   <?= $employee->function ?></p>
<p>Verjaardag:   <?= $employee->birthday ?></p>
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
