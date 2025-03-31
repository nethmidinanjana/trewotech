<?php

session_start();
require "connection.php";

$msg_txt = $_POST["txt"];
$sender = $_POST["email"];

if(empty($msg_txt)){

    echo ("Type a message !!!");

}else{

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `admin_chat`(`content`,`date_time`,`status`,`from`,`to`) VALUES
    ('".$msg_txt."','".$date."','1','".$sender."','nethmidinanjana02@gmail.com') ");
    
    echo ("success");

}

?>