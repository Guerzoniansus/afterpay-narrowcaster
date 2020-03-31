<?php
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
        $passErr = "Pass is empty";
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


<form method="post">
    <p>Username</p>
    <input type="text" name="username">
    <p> <?= $userErr ?> </p>
    <p>Password</p>
    <input type="password" name="password">
    <p> <?= $passErr ?> </p>
    <input type="submit">
</form>
