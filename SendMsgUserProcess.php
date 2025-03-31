<?php

session_start();
require "connection.php";

$msg_txt = $_POST["txt"];
$receiver = $_POST["rmail"];

if(empty($msg_txt)){
    echo ("Type a message !!!");
}else{

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $sender = $_SESSION["au"]["email"];

    Database::iud("INSERT INTO `admin_chat`(`content`,`date_time`,`status`,`from`,`to`) VALUES
    ('".$msg_txt."','".$date."','2','".$sender."','".$receiver."') ");

    echo ("success2");
}

?>