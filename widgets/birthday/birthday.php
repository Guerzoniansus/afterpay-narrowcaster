<?php
require_once 'DB.php';

$db = new DB();
$employees = $db->getBirthdayEmployees();

?>
<div style="height: 100%; width: 100%; overflow: hidden; padding: 20px; font-size: 15px; text-align: center;">
<h1> Birthdays 🎉 </h1>
<? foreach ($employees as $employee): ?>
<h2 style="background-color: rgba(77,167,122,1);"><?= $employee->employeeName ?></h2>
<p>Functie:   <?= $employee->function ?></p>
<p><?= $employee->birthday ?></p>
<? endforeach; ?>
</div>
