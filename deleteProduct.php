<?php

require "connection.php";
session_start();
$id = $_GET["id"];

if(isset($id)){

    Database::iud("DELETE FROM `image` WHERE `product_id` = '".$id."' ");
    Database::iud("DELETE FROM cart WHERE product_id = '".$id."' ");
    Database::iud("DELETE FROM wishlist WHERE product_id = '".$id."' ");
    Database::iud("DELETE FROM recent WHERE product_id = '".$id."' ");
    Database::iud("DELETE FROM product WHERE id = '".$id."' ");

    echo ("success");

}else{
    echo ("Something went wrong please try again later.");
}

?>