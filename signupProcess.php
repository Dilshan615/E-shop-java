<?php

include("connection.php");

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];

if (empty($fname)) {
    echo "Please enter your first name";
} elseif (strlen($fname) > 50) {
    echo "First name Must Contain Less Than 50 Characters";
} elseif (empty($lname)) {
    echo "Please enter your last name";
} elseif (strlen($lname) > 50) {
    echo "First name Must Contain Less Than 50 Characters";
} elseif (empty($email)) {
    echo "Please enter your email";
} elseif (strlen($email) > 100) {
    echo "Email Must Contain Less Than 100 Characters";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
} elseif (empty($password)) {
    echo "Please enter your password";
} elseif (strlen($password) < 5 || strlen($password) > 15) {
    echo "Password Must Contain 5-15 Characters";
} elseif (empty($mobile)) {
    echo "Please enter your mobile number";
} elseif (strlen($mobile) != 10) {
    echo "Mobile Number Must Contain 10 Characters";
} elseif (!preg_match("/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/", $mobile)) {
    echo "Invalid Mobile Number";
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
    $n = $rs->num_rows;

    if ($n > 0) {
        echo ("User Already Exists, Use Another Email");
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $data = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user`
(`email`,`fname`,`lname`,`password`,`mobile`,`joined_date`,`gender_gender_id`,`status_status_id`) values
('" . $email . "','" . $fname . "','" . $lname . "','" . $password . "','" . $mobile . "','" . $data . "','" . $gender . "','1')");


        echo ("success");
    }
}
