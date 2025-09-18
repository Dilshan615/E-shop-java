<?php
include "connection.php";

$email = $_POST["e"];
$NewPassword = $_POST["n"];
$RetypePassword = $_POST["r"];
$Verification = $_POST["v"];

if ($NewPassword != $RetypePassword) {
    echo ("Password does not match!!");
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email`= '" . $email . "' AND `verification_code`='" . $Verification . "'");
    $num = $rs->num_rows;

    if ($num == 1) {
        Database::iud("UPDATE `user` SET `password`='" . $NewPassword . "' WHERE `email` = '" . $email . "'");
        echo ("success");
    } else {
        echo ("Invalid Email Or Verification Code!");
    }
}
