<?php
require_once 'DB.php';

$db = new DB();
$employees = $db->getBirthdayEmployees();

?>
<div style="width: 100%; height: 100%; overflow: hidden; padding: 20px; font-size: 15px; text-align: center;">
<a href="birthdaysettings.php" target="_blank">(Click here to choose whose birthday does or doesn't get shown)</a>
<h1> Birthdays 🎉 </h1>
<? foreach ($employees as $employee): ?>
<h2 style="background-color: rgba(77,167,122,1);"><?= $employee->employeeName ?></h2>
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