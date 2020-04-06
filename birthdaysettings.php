<?php
require 'helpers.php';
require 'DB.php';
$db = new DB();

$employees = $db->getAllEmployees();

?>

<!doctype html>
<html lang="en">
<head>
    <?php addHead("Birthday Settings"); ?>

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/birthdaysettings.css">

    <!-- No point in making an entire separate .css file just for 4 things -->
    <style>
        th { vertical-align: middle !important; }
        td { vertical-align: middle !important; }
        #page-button { color: black; }
        #page-button:hover { transform: scale(1.1); }
    </style>
</head>
<body>

<div class="container-fluid">

    <!-- Top bar -->
    <div class="row" id="navbar">
        <div class="col-2">
            <a href="editpages.php" style="text-decoration: none;" title="Go back to all pages"><h1 id="page-button">◄ Pages</h1></a>
        </div>
        <div class="col-8">
            <div style="display: flex; justify-content: center; align-items: center;">
                <h1 align="center"><b>Birthday Settings</b></h1>
            </div>
        </div>
        <div class="col-2"></div>
    </div>


    <div class="row content">
        <div class="col-sm-3"></div>

        <div class="col-sm-6">
            <div class="employees-container mx-auto">
                <br>
                <p>Choose which employees get their birthday shown on the birthday widget and which don't.</p>
                <p><b>TIP:</b> Use CTRL+F to search for a specific name.<p></p>
                <p class="text-info">
                    <b>Settings automatically get saved, so you can safely go back to your pages or close this tab when you're done.</b>
                </p>

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Function</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Show in birthday widget</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach($employees as $employee): ?>
                    <tr id="<?= $employee->employeeID ?>">
                        <th scope="row"><?= $employee->employeeID ?></th>
                        <td><?= $employee->employeeName ?></td>
                        <td><?= $employee->function ?></td>
                        <td><?= $employee->birthday ?></td>
                        <td>
                            <select class="custom-select birthdayDisplayOption" name="<?= $employee->employeeID ?>">
                                <option value="true" <?= $employee->birthdayDisplay  == "true" ? "selected" : "" ?> >Show</option>
                                <option value="false" <?= $employee->birthdayDisplay  == "false" ? "selected" : "" ?> >Don't show</option>
                            </select>
                        </td>
                    </tr>
                    <? endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="col-sm-3"></div>
    </div>

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

</body>
</html>
