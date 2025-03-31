<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    if(isset($_GET["id"])){

        $email = $_SESSION["u"]["email"];
        $pid = $_GET["id"];

        $wishlist_rs = Database::search("SELECT * FROM `wishlist` WHERE `product_id`='" .  $pid . "' AND
        `user_email`='" . $email . "'");
        $wishlist_num = $wishlist_rs->num_rows;

        if($wishlist_num == 1){
            $wishlist_data = $wishlist_rs->fetch_assoc();
            $list_id = $wishlist_data["id"];

            Database::iud("DELETE FROM `wishlist` WHERE `id`='".$list_id."'");
            echo ("removed");

        }else{
            Database::iud("INSERT INTO `wishlist`(`product_id`,`user_email`) VALUES ('".$pid."','" . $email . "')");
            echo ("added");
        }

    }else{
        echo ("Something went wrong");
    }

}else{
    echo ("Please Login First");
}

?>