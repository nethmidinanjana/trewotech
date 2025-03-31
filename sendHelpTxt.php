<?php

require "connection.php";

$txt = $_POST["txt"];
$email = $_POST["email"];

if(empty($txt)){

    echo ("Type your message!!!");

}else if(empty($email)){

    echo ("Enter your email!!!");

}else{

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s"); 

    Database::iud("INSERT INTO `help`(`email`,`content`,`date_n_time`) VALUES ('".$email."','".$txt."','".$date."') ");

    echo ("success");
}

?>