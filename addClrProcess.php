<?php

require "connection.php";

if(isset($_POST["clr"])){

    $clr = $_POST["clr"];

    $clr_rs = Database::search("SELECT * FROM `colour` WHERE `name` LIKE '".$clr."'");
    $clr_num = $clr_rs->num_rows;

    if($clr_num == 0){

        Database::iud("INSERT INTO `colour`(`name`) VALUES ('".$clr."') ");
        echo ("success");

    }else{
        echo ("This colour already exists in the database.");
    }

}else{
    echo ("Please insert a colour");
}

?>