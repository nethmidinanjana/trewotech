<?php

require "connection.php";
$pid = $_GET["id"];

Database::iud("UPDATE `invoice` SET `status` = '5' WHERE `product_id` = '$pid' ");

echo ("Successfully removed the order.");
?>