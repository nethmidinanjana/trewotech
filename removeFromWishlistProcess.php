<?php

require "connection.php";

if(isset($_GET["id"])){

    $wid = $_GET["id"];

    $wishlist_rs = Database::search("SELECT * FROM `wishlist` WHERE `id`= '".$wid."'");
    $wishlist_num = $wishlist_rs->num_rows;
    $wishlist_data = $wishlist_rs->fetch_assoc();

    if($wishlist_num == 0){
        echo ("Something went wrong. Please try again later.");
    }else{
        Database::iud("INSERT INTO `recent` (`product_id`,`user_email`) VALUES 
        ('".$wishlist_data["product_id"]."','".$wishlist_data["user_email"]."')");

        Database::iud("DELETE FROM `wishlist` WHERE `id`='".$wid."'");

        echo ("success");
    }

}else{
    echo ("Please Select a Product");
}

?>