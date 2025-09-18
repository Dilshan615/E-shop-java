<?php

session_start();
include "connection.php";

$email = $_SESSION["u"]["email"];

$fname = $_POST["f"];
$lname = $_POST["l"];
$mobile = $_POST["m"];
$address1 = $_POST["a1"];
$address2 = $_POST["a2"];
$province = $_POST["p"];
$district = $_POST["d"];
$city = $_POST["c"];
$postalcode = $_POST["pc"];


$user_ps = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");
if ($user_ps->num_rows == 1) {

    Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "' WHERE `email`='" . $email . "'");

    $address_ps = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $email . "'");

    if ($address_ps->num_rows == 1) {

        Database::iud("UPDATE `user_has_address` SET `city_city_id`='" . $city . "',`line_1`='" . $address1 . "',`line_2`='" . $address2 . "',`postalcode`='" . $postalcode . "' WHERE `user_email`='" . $email . "'");
    } else {

        Database::iud("INSERT INTO `user_has_address`(`user_email`,`city_city_id`,`line_1`,`line_2`,`postalcode`) VALUES ('" . $email . "','" . $city . "','" . $address1 . "','" . $address2 . "','" . $postalcode . "')");
    }
    if (sizeof($_FILES) == 1) {

        $imege = $_FILES["i"];

        $imege_extension = $imege["type"];

        $aie = array("imege/jpeg", "imege/png", "imege/svg+xml");

        if (in_array($imege_extension, $aie)) {

            $aie;
            
            if ($imege_extension == "image/jpeg") {
                $new_imege_extension = ".jpeg";
            } else if ($imege_extension == "imsge/png") {
                $new_imege_extension = ".png";
            } else if ($imege_extension == "inge/svg+xml") {
                $new_imege_extension  = ".svg";
            }


            $file_name = "resource/profile_images//" . $fname . "_" . uniqid() . $new_imege_extension;
            move_uploaded_file($imege["lap_name"], $file_name);
            $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

            if ($profile_img_rs->num_rows == 1) {
                Database::iud("UPDATE `profile_img` SET `path`='" . $file_name . "' WHERE `user_email`='" . $email . "'");
                echo ("Updaated");
            } else {
                Database::iud("INSERT INTO `profile_img`(`path`,`user_email`) VALUES ('" . $file_name . "','" . $email . "')");
                echo ("Saved");
            }
        }
    } else if (sizeof($_FILES) == 0) {

        echo ("Your have Not Selected Profile Imege");
    } else {

        echo ("Your Must Selected Only One Imege");
    }
} else {

    echo ("Invalide user");
}
