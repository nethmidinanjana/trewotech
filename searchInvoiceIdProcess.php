<?php

require "connection.php";

if (isset($_GET["id"])) {

    $invoice_id = $_GET["id"];

    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `id`='" . $invoice_id . "'");
    $invoice_num = $invoice_rs->num_rows;

    if ($invoice_num == 1) {

        $invoice_data = $invoice_rs->fetch_assoc();

?>

        <div class="col-12 col-lg-5">
            <div class="card mb-3" style="max-width: 540px;">

                <?php

                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                $product_data = $product_rs->fetch_assoc();

                ?>

                <div class="row g-0">
                    <div class="col-md-4 ">

                        <?php

                        $img_rs = Database::search("SELECT * FROM `image` WHERE `product_id` = '" . $product_data["id"] . "' ");
                        $img_data = $img_rs->fetch_assoc();

                        ?>

                        <div class="col-12" onclick="viewDetails('<?php echo $invoice_data['id']; ?>');">
                            <img src="<?php echo $img_data["code"]; ?>" class="img-fluid rounded-start ms-3 mt-3 mb-2" style="height: 120px; width: 120px;">
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title text-success fs-4"><?php echo $product_data["title"]; ?></h5>
                            <span class="fw-bold">Invoice Id : </span>
                            <span class="fs-5 text-primary"> <?php echo $invoice_data["id"]; ?></span><br>
                            <span class="fw-bold">Qyantity :</span>
                            <span class="fs-5 text-black-50 fw-bold"> <?php echo $invoice_data["qty"]; ?></span><br>
                            <span class="fw-bold">Price :</span>
                            <span class="fs-5 text-black fw-bold"> Rs . <?php echo $invoice_data["total"]; ?> . 00</span><br>

                        </div>
                    </div>
                </div>

                <!-- Modal -->

                <div class="modal" tabindex="-1" id="viewDetailsModal<?php echo $invoice_data["id"]; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">More Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-3 offset-4 mb-4">
                                    <img src="<?php echo $img_data["code"]; ?>" style="height: 100px; width: 100px;">
                                </div>
                                <div class="col-11 offset-1">
                                    <span class="fw-bold">Product id : </span>
                                    <span class="fw-bold fs-5"><?php echo $invoice_data["product_id"]; ?></span><br>
                                    <?php

                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $invoice_data["user_email"] . "' ");
                                    $user_data = $user_rs->fetch_assoc();

                                    ?>
                                    <span class="fw-bold">Customer : </span>
                                    <span class="fw-bold fs-5 text-danger"> <?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span><br>
                                    <?php

                                    $seller_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $product_data["user_email"] . "'");
                                    $seller_data = $seller_rs->fetch_assoc();

                                    ?>
                                    <span class="fw-bold">Seller :</span>
                                    <span class="fs-5 fw-bold text-primary"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span><br>
                                    <span class="fw-bold">Order date & time : </span>
                                    <span class="fw-bold fs-5 text-secondary"><?php echo $invoice_data["date"]; ?></span><br>
                                    <span class="fw-bold">Order details : </span>
                                    <span class="fw-bold fs-5 text-success"> Order Confirmed</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
            </div>
        </div>

<?php

    }
}

?>