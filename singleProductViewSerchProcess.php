<?php

require "connection.php";

$txt = $_POST["txt"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%".$txt."%' ");
$product_num = $product_rs->num_rows;

?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row gap-2">

            <?php

            for ($x = 0; $x < $product_num; $x++) {
                $product_data = $product_rs->fetch_assoc();

            ?>

                <!-- card -->


                <div class="card g-3 " style="width: 16rem;">

                    <?php
                    $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $product_data["id"] . "'");
                    $image_data = $image_rs->fetch_assoc();

                    ?>

                    <img src="<?php echo $image_data["code"]; ?>" class="card-img-top" style="height: 180px;" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product_data["title"]; ?></h5>
                        <p class="card-text"><?php echo $product_data["description"]; ?></p>
                        <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="col-12 btn btn-success">Buy Now</a>
                        <button class="col-12 btn btn-danger mt-2" onclick="addToCart(<?php echo $product_data['id'];  ?>);">Add to Cart</button>
                    </div>
                </div>

                <!-- card -->


            <?php

            }
            ?>



        </div>
    </div>

</div>