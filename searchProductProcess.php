<?php

require "connection.php";

$txt = $_POST["txt"];

if (empty($txt)) {
    echo ("Enter the product title.");
} else {

    $product_rs = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%" . $txt . "%' ");
    $product_num = $product_rs->num_rows;

?>

    <div class="col-12 bg-body py-2 px-2 border rounded" >
        <div class="row justify-content-center gap-2">

            <?php

            for ($x = 0; $x < $product_num; $x++) {
                $product_data = $product_rs->fetch_assoc();

            ?>

                <div class="col-12 col-lg-2 ms-3">
                    <div class="card" style="width: 14rem;">
                        <div class="col-8 offset-2">
                            <?php

                            $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $product_data["id"] . "' ");
                            $image_data = $image_rs->fetch_assoc();

                            if (isset($image_data["code"])) {
                            ?>

                                <img src="<?php echo $image_data["code"]; ?>" class="card-img-top" style="height: 110px; width: 110px;">

                            <?php
                            } else {
                            ?>

                                <img src="resource/i 3.jpg" class="card-img-top" style="height: 110px; width: 110px;">

                            <?php
                            }

                            ?>
                        </div>
                        <div class="card-body text-center">
                            <span class="card-title text-success fw-bold"><?php echo $product_data["title"]; ?></span><br>
                            <span class="fs-5 text-primary fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</span>
                            <button class="col-12 btn btn-dark mt-2">Block Product &nbsp;<i class="bi bi-x-circle"></i></button>
                        </div>
                    </div>
                </div>

            <?php
            }

            ?>



        </div>
    </div>


<?php
}

?>