<?php

include("connection.php");

session_start();

$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["rMe"];


if (empty($email)) {
    echo "Please enter your email";
} elseif (empty($password)) {
    echo "Please enter your password";
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
    $n = $rs->num_rows;

    if ($n != 0) {
        echo "success";
        $d = $rs->fetch_assoc();
        $_SESSION["u"] = $d;
        if ($rememberMe == "true") {
            setcookie("e", $email, time() + (60 * 60 * 24 * 30));
            setcookie("p", $password, time() + (60 * 60 * 24 * 30));
        } else {
            setcookie("email", "", -1);
            setcookie("password", "", -1);
        }
    } else {
        echo ("Invalid Email or Password");
    }
}
