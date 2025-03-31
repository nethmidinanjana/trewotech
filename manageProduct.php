<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Manage Product | Trewo Tech</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resource/logo.png" />
    </head>

    <body class="bg-info">

        <div class="container-fluid " style="background-color: #E9EBEE;">
            <div class="row ">

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-3 bg-secondary">
                            <div class="col-4 offset-3 col-lg-3 mt-3 mb-3 offset-lg-4 ">
                                <img src="resource/admin.png" style="width: 110px; height:110px;">
                            </div>
                            <hr class="border border-light">
                            <div class="col-12 ms-5 ps-2">
                                <label class="form-label fs-5 fw-bold text-white " style="font-family: Lucida Sans;">Admin : <?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></label>
                            </div>
                            <div class="col-12 mt-2 mb-2">
                                <a href="adminPanel.php" class="btn btn-light d-grid text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold" style="font-family: Gill Sans;">Dashboard</a>
                                <a href="manageUser.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-light" style="font-family: Gill Sans;">Manage Users</a>
                                <a href="manageProduct.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-primary" style="font-family: Gill Sans;">Manage Product</a>
                                <a href="adminHelp.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-light" style="font-family: Gill Sans;">Customer issues</a>

                            </div>
                            <hr class="border border-light">
                            <div class="col-12 fs-5 text-center mb-2">
                                <a href="sellingHistory.php" class="text-white fw-bold fs-4 text-decoration-none" style="font-family: Futara;">Selling History</a>
                            </div>

                            <hr class="border border-light">

                        </div>

                        <div class="col-12 col-lg-9">
                            <h3 class="col-12 text-primary fw-bold mt-4 ms-2 ms-lg-5" style="font-family: aria;">Manage Product</h3>
                            <hr class="mt-3 mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-4 offset-lg-1">
                                    <img src="resource/instockimg.png" style="height: 120px; width: 120px;">
                                    <?php

                                    $stock_rs = Database::search("SELECT * FROM `product` WHERE `qty` != '0' ");
                                    $stock_num = $stock_rs->num_rows;

                                    ?>
                                    <span class="fw-bold fs-2 text-success"><?php echo $stock_num; ?> </span>
                                    <span class="fs-5 fw-bold"> Products in stock</span>
                                </div>
                                <div class="col-12 col-lg-4 offset-lg-1">

                                    <?php

                                    $outofstock_rs = Database::search("SELECT * FROM `product` WHERE `qty` = '0' ");
                                    $outofstock_num = $outofstock_rs->num_rows;

                                    ?>

                                    <img src="resource/outofstock.png" style="height: 100px; width: 100px;" onclick="viewModalOFS();">

                                    <span class="fw-bold fs-2 text-danger ms-lg-3"><?php echo $outofstock_num; ?> </span>
                                    <span class="fs-5 fw-bold"> Products out of stock</span>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-12 col-lg-9 offset-lg-1">
                                    <div class="input-group mt-3 mt-lg-3 mb-3">
                                        <input type="text" class="form-control" placeholder="Search Product..." id="searchUsertxt">
                                        <button type="button" class=" btn btn-primary" onclick="searchProduct();"><i class="bi bi-search"></i></button>
                                    </div>
                                </div>

                            </div>
                            <hr class="mt-4 mb-3">

                            <div class="col-12 bg-body py-2 px-2 border rounded" id="productSearchResult">
                                <div class="row justify-content-center gap-2">

                                    <?php

                                    if (isset($_GET["page"])) {
                                        $pageno = $_GET["page"];
                                    } else {
                                        $pageno = 1;
                                    }

                                    $product_rs = Database::search("SELECT * FROM `product`");
                                    $product_num = $product_rs->num_rows;

                                    $results_per_page = 10;
                                    $number_of_pages = ceil($product_num / $results_per_page);

                                    $page_results = ($pageno - 1) * $results_per_page;

                                    $selected_rs = Database::search("SELECT * FROM `product` LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                    $selected_num = $selected_rs->num_rows;

                                    for ($x = 0; $x < $selected_num; $x++) {
                                        $selected_data = $selected_rs->fetch_assoc();

                                    ?>

                                        <div class="col-12 col-lg-2 ms-3">
                                            <div class="card" style="width: 14rem;">
                                                <div class="col-8 offset-2" onclick="viewProductModal('<?php echo $selected_data['id']; ?>');">
                                                    <?php

                                                    $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $selected_data["id"] . "' ");
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
                                                    <span class="card-title text-success fw-bold"><?php echo $selected_data["title"]; ?></span><br>
                                                    <span class="fs-5 text-primary fw-bold">Rs. <?php echo $selected_data["price"]; ?> .00</span>
                                                    <div class="col-12 d-grid mt-2">
                                                        <?php
                                                        if ($selected_data["status_id"] == 1) {
                                                        ?>
                                                            <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Block</button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button id="pb<?php echo $selected_data['id']; ?>" class="btn btn-success" onclick="blockProduct('<?php echo $selected_data['id']; ?>');">Unblock</button>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- modal01 -->
                                        <div class="modal" tabindex="-1" id="viewProductModal<?php echo $selected_data["id"]; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title fw-bold text-success"><?php echo $selected_data["title"]; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="offset-4 col-4">
                                                            <img src="<?php echo $image_data["code"]; ?>" class="img-fluid" style="height: 150px;">
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                                            <span class="fs-4 text-success">Rs: <?php echo $selected_data["price"]; ?> .00</span><br>
                                                            <span class="fs-5 fw-bold">Quantity :</span>&nbsp;
                                                            <span class="fs-5 text-primary"><?php echo $selected_data["qty"]; ?> Products Left</span><br>
                                                            <span class="fs-5 fw-bold">Seller :</span>&nbsp;
                                                            <?php
                                                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "' ");
                                                            $user_data = $user_rs->fetch_assoc();
                                                            ?>
                                                            <span class="fs-5 text-danger"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span><br>
                                                            <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                                            <span class="fs-5"><?php echo $selected_data["description"]; ?></span><br>
                                                            <?php

                                                            if ($selected_data["qty"] != 0) {
                                                            ?>

                                                                <span class="fw-bold fs-4 text-warning">In Stock</span>

                                                            <?php
                                                            } else {
                                                            ?>

                                                                <span class="fw-bold fs-4 text-danger">Out of Stock</span>

                                                            <?php
                                                            }

                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- modal01 -->

                                    <?php
                                    }

                                    ?>

                                    <div class="offset-lg-1 col-12 col-lg-6 text-center mb-3 mt-3">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination pagination-lg justify-content-center">
                                                <li class="page-item">
                                                    <a class="page-link" href="<?php if ($pageno <= 1) {
                                                                                    echo "#";
                                                                                } else {
                                                                                    echo "?page=" . ($pageno - 1);
                                                                                } ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <?php

                                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                                    if ($x == $pageno) {

                                                ?>
                                                        <li class="page-item active">
                                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                        </li>
                                                    <?php

                                                    } else {

                                                    ?>

                                                        <li class="page-item ">
                                                            <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                                        </li>

                                                <?php

                                                    }
                                                }

                                                ?>

                                                <li class="page-item">
                                                    <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                                    echo "#";
                                                                                } else {
                                                                                    echo "?page=" . ($pageno + 1);
                                                                                } ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>

                                    <!-- modal02 -->

                                    <div class="modal" tabindex="-1" id="outOfStockModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold">Out of stock products.</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php

                                                    for ($y = 0; $y < $outofstock_num; $y++) {
                                                        $outofstock_data = $outofstock_rs->fetch_assoc();

                                                    ?>
                                                        <span class="fs-5 text-success">Product id: <?php echo $outofstock_data["id"]; ?> -</span>
                                                        <span class="fs-5 text-primary"> <?php echo $outofstock_data["title"]; ?></span><br>

                                                    <?php
                                                    }

                                                    ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- modal02 -->



                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
    echo ("You are Not a valid user.");
}

?>