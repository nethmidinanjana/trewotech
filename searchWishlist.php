<?php

require "connection.php";

$txt = $_GET["txt"];

if (empty($txt)) {
    echo ("Enter the product name.");
} else {
    $wishlist_rs = Database::search("SELECT * FROM product INNER JOIN wishlist ON wishlist.product_id = product.id
    WHERE product.title LIKE '%$txt%' ");

    $wishlist_num = $wishlist_rs->num_rows;

    if ($wishlist_num != 0) {

?>

        <div class="row">

            <?php

            for ($x = 0; $x < $wishlist_num; $x++) {
                $wishlist_data = $wishlist_rs->fetch_assoc();


            ?>

                <div class="col-md-3">

                    <?php

                    $img = array();

                    $images_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $wishlist_data["product_id"] . "'");
                    $images_data = $images_rs->fetch_assoc();

                    ?>

                    <img src="<?php echo $images_data["code"]; ?>" class="img-fluid rounded-start" style="height: 250px; width:200px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">

                        <?php

                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $wishlist_data["product_id"] . "'");
                        $product_data = $product_rs->fetch_assoc();

                        ?>

                        <h5 class="card-title text-success fs-5 fw-bold"><?php echo $product_data["title"]; ?></h5>
                        <p class="card-text mt-2"><?php echo $product_data["description"]; ?></p>
                        <label class="form-label text-black-50">Colour : </label>
                        <?php

                        $clr_rs = Database::search("SELECT * FROM `colour` WHERE `id`='" . $product_data["colour_id"] . "'");
                        $clr_data = $clr_rs->fetch_assoc();

                        ?>
                        <label class="form-label fw-bold"><?php echo $clr_data["name"]; ?></label><br>
                        <label class="form-label text-black-50">Price :</label>
                        <label class="form-label fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</label><br>
                        <label class="form-label text-black-50">Quantity :</label>
                        <label class="form-label fw-bold"><?php echo $product_data["qty"]; ?></label><br>
                        <label class="form-label text-black-50">Condition :</label>
                        <?php

                        $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $product_data["condition_id"] . "'");
                        $condition_data = $condition_rs->fetch_assoc();

                        ?>
                        <label class="form-label fw-bold"><?php echo $condition_data["name"]; ?></label><br>

                        <div class="row gap-2">
                            <button class="col-12 col-lg-3 btn btn-success mt-3 mx-1">Buy Now</button>
                            <button class="col-12 col-lg-3 btn btn-warning mt-3 mx-1">Add to cart</button>
                            <button class="col-12 col-lg-3 btn btn-danger mt-3 mx-1" onclick='removeFromWatchlist(<?php echo $wishlist_data["id"]; ?>);'>Remove</button>
                        </div>


                    </div>
                </div>

                <div class="col-12 mt-3 mb-3 mx-1">
                    <hr>
                </div>

            <?php
            }
            ?>
        </div>

    <?php

    } else {
    ?>

        <span>No Results Show.</span>

<?php
    }
}

?>