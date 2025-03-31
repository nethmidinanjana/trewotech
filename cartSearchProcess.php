<?php

require "connection.php";
session_start();

$txt = $_POST["txt"];
$email = $_SESSION["u"]["email"];

$total = 0;
$subtotal = 0;
$shipping = 0;

$cart_rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON cart.product_id = product.id 
WHERE product.title LIKE '%" . $txt . "%' AND cart.user_email ='" . $_SESSION["u"]["email"] . "' ");
$cart_num = $cart_rs->num_rows;

if ($cart_num != 0) {

?>

    <div class=" mb-3 col-12 mx-0 mx-lg-2 ">
        <div class="row g-0">

            <?php

            for ($x = 0; $x < $cart_num; $x++) {
                $cart_data = $cart_rs->fetch_assoc();

                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                $product_data = $product_rs->fetch_assoc();

                $total = $total + ($product_data["price"] * $cart_data["qty"]);

                $address_rs = Database::search("SELECT district.id AS did FROM `user_has_address` INNER JOIN `city` ON 
                                                        user_has_address.city_id = city.id INNER JOIN `district` ON city.district_id = district.id WHERE `user_email`='" . $email . "' ");

                $address_data = $address_rs->fetch_assoc();

                $ship = 0;

                if ($address_data["did"] == 5) {
                    $ship = $product_data["delivery_fee_colombo"];
                    $shipping = $shipping + $ship;
                } else {
                    $ship = $product_data["delivery_fee_other"];
                    $shipping = $shipping + $ship;
                }


            ?>

                <div class="col-lg-3">
                    <?php

                    $img_rs = Database::search("SELECT `code` FROM `image` WHERE  `product_id` ='" . $cart_data["product_id"] . "' ");
                    $img_data = $img_rs->fetch_assoc();

                    ?>

                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?> " title="Product Details">
                        <img src="<?php echo $img_data["code"]; ?>" class="img-fluid rounded-start" style="height: 200px; width:170px;">
                    </span>

                </div>
                <div class="col-lg-9">
                    <div class="card-body">

                        <?php

                        $color_rs = Database::search("SELECT `name` FROM `colour` INNER JOIN `product` ON product.colour_id = colour.id WHERE  product.id ='" . $cart_data["product_id"] . "' ");
                        $color_data = $color_rs->fetch_assoc();

                        ?>

                        <span class="card-title mt-2 fw-bold fs-5 text-success"><?php echo $product_data["title"]; ?></span><br>
                        <label class="form-label text-black-50 mt-2">Colour : </label>
                        <label class="form-label fw-bold"><?php echo $color_data["name"]; ?></label><br>
                        <label class="form-label text-black-50">Price :</label>
                        <label class="form-label fw-bold">Rs. <?php echo $product_data["price"]; ?> .00</label><br>
                        <label class="form-label text-black-50">Delivery Fee :</label>
                        <label class="form-label fw-bold">Rs. <?php echo $ship; ?> .00</label><br>
                        <div class="row">
                            <div class="col-12 col-lg-2">
                                <label class="form-label text-black-50 mt-2">Quantity :</label>
                            </div>
                            <div class="col-12 col-lg-5">
                                <input type="number" value="<?php echo $product_data["qty"]; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="row gap-3 ms-1">
                            <a href='<?php echo "singleProductView.php?id=" . $product_data["id"]; ?>' class="col-12 col-lg-4 btn btn-success mt-3">Buy Now</a>
                            <button class="col-12 col-lg-4 btn btn-danger mt-3" onclick="deleteFromCart(<?php echo $cart_data['id']; ?>);">Remove from cart</button>
                        </div>

                    </div>
                </div>

                <div class="col-md-11 mt-4 mb-3">
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <span class="fw-bold fs-5 text-black-50">Requested Total <i class="bi bi-info-circle"></i></span>
                        </div>
                        <div class="col-6 col-md-6 text-end">
                            <span class="fw-bold fs-5 text-black-50">Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</span>
                        </div>
                    </div>
                </div>
                <hr class="mt-3 mb-3">
            <?php
            }

            ?>
        </div>
    </div>

<?php
} else {
    echo ("The product you are searching is not in cart yet.");
}

?>