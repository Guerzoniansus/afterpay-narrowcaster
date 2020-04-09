<?php
require 'helpers.php';

$userErr = $passErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $userErr = "Username is empty";
    }

    else {
        if ($_POST["username"] != "admin") {
            $userErr = "Wrong username";
        }
    }

    if (empty($_POST["password"])) {
        $passErr = "Password is empty";
    }

    else if ($_POST["password"] != "GroteZakTomaten12345") {
        $passErr = "Wrong password";
    }

    if ($userErr == "" && $passErr == "") {
        setcookie("admin", "ja", time() + (86400 * (365*10)), "/"); // 86400 = 1 day, cookie is 10 years
        header('Location: edit.php');
        die();
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php addHead("Log in"); ?>
    <link rel="stylesheet" href="css/general.css">

    <style>
        p {
            text-align: center;
        }

        #submit-button {
            border: 1px solid transparent;
            border-radius: 5px;
            background-color: rgba(135, 205, 155, 0.5);
            color: black;
            font-weight: bold;
            align-self: center;
        }
    </style>
</head>
<body>

<div class="container-fluid" style="height: 90vh">

    <!-- Top bar -->
    <div class="row" id="navbar">
        <div class="col-1">
        </div>
        <div class="col-10">
            <h1 align="center"><b>Log in</b></h1>
        </div>
        <div class="col-1">
        </div>
    </div>


    <div class="row content" style="height: 100%">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
            <div class="mx-auto d-flex justify-content-center">
                <form method="post">
                    <br>
                    <p>Username</p>
                    <input class="form-control" type="text" name="username">
                    <p class="text-danger"> <?= $userErr ?> </p>
                    <p>Password</p>
                    <input class="form-control" type="password" name="password">
                    <p class="text-danger"> <?= $passErr ?> </p>
                    <div style="display: flex; align-items: center; justify-content: center;">
                        <input id="submit-button" type="submit" class="btn btn-primary w-50" value="Log in">
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-3">
        </div>
    </div>

</div>



</body>
</html>



