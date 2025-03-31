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

        <title>Selling History | Trewo Tech</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resource/logo.png" />

    </head>

    <body style="background-color: #FFFAFA;">

        <div class="container-fluid">
            <div class="row">

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
                            <hr class="border border-light">
                            <div class="col-12 fs-5 text-center mb-2">
                                <a href="sellingHistory.php" class="text-white fw-bold fs-4 text-decoration-none" style="font-family: Futara;">Selling History</a>
                            </div>

                            <hr class="border border-light">
                            <div class="col-12 mt-2 mb-2">
                                <a href="adminPanel.php" class="btn btn-light d-grid text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold" style="font-family: Gill Sans;">Dashboard</a>
                                <a href="manageUser.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-light" style="font-family: Gill Sans;">Manage Users</a>
                                <a href="manageProduct.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-light" style="font-family: Gill Sans;">Manage Product</a>
                                <a href="adminHelp.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-light" style="font-family: Gill Sans;">Customer issues</a>
                            </div>
                            <hr class="border border-light">
                            

                        </div>

                        <div class="col-12 col-lg-9">
                            <div class="col-12">
                                <h2 class="col-12 text-primary fw-bold mt-4 ms-2 ms-lg-5" style="font-family: aria;">Selling History</h2>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-12 col-lg-4 text-black-50 text-center">
                                    <label class="fs-5 fw- mt-2 mb-2">SEARCH BY INVOICE ID :</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Type invoice id..." id="searchTxt" onkeyup="searchInvoiceId();">
                                        <button class="btn btn-primary" type="button"><i class="bi bi-search"></i></button>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 text-black-50 text-center">
                                    <label class="fs-5 fw- mt-2 mb-2">SEARCH FROM DATE :</label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" placeholder="Search from..." id="from">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-3 text-black-50 text-center">
                                    <label class="fs-5 fw- mt-2 mb-2">SEARCH TO DATE :</label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" placeholder="Search to..." id="to">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-2 text-black-50 text-center">
                                    <button class="btn btn-primary mt-5" onclick="findSelling();"><i class="bi bi-search"></i>&nbsp; Search</button>
                                </div>
                            </div>
                            <hr>

                            <div class="col-12 pb-4 pt-4 border rounded">
                                <div class="row justify-content-center " id="viewArea">

                                    <?php

                                    $query = "SELECT * FROM `invoice`";
                                    $pageno;

                                    if (isset($_GET["page"])) {
                                        $pageno = $_GET["page"];
                                    } else {
                                        $pageno = 1;
                                    }

                                    $invoice_rs = Database::search($query);
                                    $invoice_num = $invoice_rs->num_rows;

                                    $results_per_page = 6;
                                    $number_of_pages = ceil($invoice_num / $results_per_page);

                                    $page_results = ($pageno - 1) * $results_per_page;
                                    $selected_rs =  Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                    $selected_num = $selected_rs->num_rows;

                                    for ($x = 0; $x < $selected_num; $x++) {
                                        $selected_data = $selected_rs->fetch_assoc();

                                    ?>

                                        <div class="col-12 col-lg-5">
                                            <div class="card mb-3" style="max-width: 540px;">

                                                <?php

                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["product_id"] . "'");
                                                $product_data = $product_rs->fetch_assoc();

                                                ?>

                                                <div class="row g-0">
                                                    <div class="col-md-4 ">

                                                        <?php

                                                        $img_rs = Database::search("SELECT * FROM `image` WHERE `product_id` = '" . $product_data["id"] . "' ");
                                                        $img_data = $img_rs->fetch_assoc();

                                                        ?>

                                                        <div class="col-12" onclick="viewDetails('<?php echo $selected_data['id']; ?>');">
                                                            <img src="<?php echo $img_data["code"]; ?>" class="img-fluid rounded-start ms-3 mt-3 mb-2" style="height: 120px; width: 120px;">
                                                        </div>

                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-success fs-4"><?php echo $product_data["title"]; ?></h5>
                                                            <span class="fw-bold">Invoice Id : </span>
                                                            <span class="fs-5 text-primary"> <?php echo $selected_data["id"]; ?></span><br>
                                                            <span class="fw-bold">Qyantity :</span>
                                                            <span class="fs-5 text-black-50 fw-bold"> <?php echo $selected_data["qty"]; ?></span><br>
                                                            <span class="fw-bold">Price :</span>
                                                            <span class="fs-5 text-black fw-bold"> Rs . <?php echo $selected_data["total"]; ?> . 00</span><br>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal -->

                                                <div class="modal" tabindex="-1" id="viewDetailsModal<?php echo $selected_data["id"]; ?>">
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
                                                                    <span class="fw-bold fs-5"><?php echo $selected_data["product_id"]; ?></span><br>
                                                                    <?php

                                                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $selected_data["user_email"] . "' ");
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
                                                                    <span class="fw-bold fs-5 text-secondary"><?php echo $selected_data["date"]; ?></span><br>
                                                                    <span class="fw-bold">Order status : </span>
                                                                    <?php
                                                                    if ($selected_data["status"] == 0) {
                                                                    ?>

                                                                        <span class="fw-bold fs-5 text-success"> Order not confirmed yet</span>

                                                                    <?php
                                                                    } else if ($selected_data["status"] == 1) {
                                                                    ?>

                                                                        <span class="fw-bold fs-5 text-warning"> Order confirmed and packing</span>

                                                                    <?php
                                                                    } else if ($selected_data["status"] == 2) {
                                                                    ?>

                                                                        <span class="fw-bold fs-5 text-info"> Dispatch</span>

                                                                    <?php
                                                                    } else if ($selected_data["status"] == 3) {
                                                                    ?>

                                                                        <span class="fw-bold fs-5 text-primary"> Shipping</span>

                                                                    <?php
                                                                    } else if ($selected_data["status"] == 4) {
                                                                    ?>

                                                                        <span class="fw-bold fs-5 text-danger"> Delivered</span>

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

                                                <!-- Modal -->
                                            </div>
                                        </div>

                                    <?php

                                    }

                                    ?>

                                    <!-- pagination -->
                                    <div class="offset-1 col-8 col-lg-7 text-center mb-3 mt-5">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination pagination-lg justify-content-center">
                                                <li class="page-item">
                                                    <a class="page-link" href=" <?php if ($pageno <= 1) {
                                                                                    echo ("#");
                                                                                } else {
                                                                                    echo "?page="($pageno - 1);
                                                                                } ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <?php

                                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                                    if ($x == $pageno) {
                                                ?>
                                                        <li class="page-item active">
                                                            <a class="page-link" href="<?php echo "?page=" . ($x) ?>"><?php echo $x; ?></a>
                                                        </li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="<?php echo "?page=" . ($x) ?>"><?php echo $x; ?></a>
                                                        </li>
                                                <?php
                                                    }
                                                }

                                                ?>

                                                <li class="page-item">
                                                    <a class="page-link" href="<?php if ($pageno >= $number_of_pages) {
                                                                                    echo ("#");
                                                                                } else {
                                                                                    echo "?page="($pageno + 1);
                                                                                } ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <!-- pagination -->

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