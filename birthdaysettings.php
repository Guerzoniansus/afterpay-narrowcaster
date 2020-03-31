<?php

require 'DB.php';
$db = new DB();

$employees = $db->getAllEmployees();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Birthday Settings</title>

    <!-- IMPORT BOOTSTRAP AND JQUERY -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/birthdaysettings.css">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

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
