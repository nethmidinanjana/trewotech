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

        <title>Admin Panel | Trewo Tech</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resource/logo.png" />
    </head>

    <body>

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
                                <a class="btn btn-primary d-grid text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold" style="font-family: Gill Sans;">Dashboard</a>
                                <a href="manageUser.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-light" style="font-family: Gill Sans;">Manage Users</a>
                                <a href="manageProduct.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-light" style="font-family: Gill Sans;">Manage Product</a>
                                <a href="adminHelp.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-light" style="font-family: Gill Sans;">Customer issues</a>
                            </div>
                            <hr class="border border-light">
                            <div class="col-12 fs-5 text-center mb-2">
                                <a href="sellingHistory.php" class="text-white fw-bold fs-4 text-decoration-none" style="font-family: Futara;">Selling History</a>
                            </div>

                            <hr class="border border-light">

                        </div>

                        <div class="col-12 col-lg-9">

                            <h3 class="col-12 text-primary fs-1 fw-bold mt-4 ms-2 ms-lg-5" style="font-family: aria;">Dashboard</h3>

                            <hr class="mt-3 mb-3">

                            <div class="row mt-3 mb-3">
                                <div class="col-12 col-lg-10 offset-lg-1 bg-dark border rounded border-dark py-2">
                                    <div class="col-12 text-center mt-2 mb-2">
                                        <span class="fs-3 fw-bold text-warning">Top selling categories.</span>
                                        <hr>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12 col-lg-3">
                                            <span class="fs-4 fw-bold text-white">Laptops & Computers</span>
                                        </div>
                                        <div class="col-12 col-lg-9 mt-2">
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" aria-label="Success example" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12 col-lg-3">
                                            <span class="fs-4 fw-bold text-white">Mobile phones</span>
                                        </div>
                                        <div class="col-12 col-lg-9 mt-2">
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar" aria-label="Info example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12 col-lg-3">
                                            <span class="fs-4 fw-bold text-white">Speakers</span>
                                        </div>
                                        <div class="col-12 col-lg-9 mt-2">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-label="Warning example" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2 mb-2">
                                        <div class="col-12 col-lg-3">
                                            <span class="fs-4 fw-bold text-white">Lamps & Bulbs</span>
                                        </div>
                                        <div class="col-12 col-lg-9 mt-2">
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" role="progressbar" aria-label="Danger example" style="width: 70%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-12 col-lg-10 offset-lg-1">

                                    <?php

                                    $today = date("Y-m-d");
                                    $thismonth = date("m");
                                    $thisyear = date("Y");

                                    $a = "0";
                                    $b = "0";
                                    $c = "0";
                                    $e = "0";
                                    $f = "0";

                                    $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                    $invoice_num = $invoice_rs->num_rows;

                                    for ($x = 0; $x < $invoice_num; $x++) {
                                        $invoice_data = $invoice_rs->fetch_assoc();

                                        $f = $f + $invoice_data["qty"]; //total qty

                                        $d = $invoice_data["date"];
                                        $splitdate = explode(" ", $d); //separate date from time
                                        $pdate = $splitdate[0]; //sold date

                                        if ($pdate == $today) {
                                            $a = $a + $invoice_data["total"];
                                            $c = $c + $invoice_data["qty"];
                                        }

                                        $splitMonth = explode("-", $pdate); //separate date as year,month & date
                                        $pyear = $splitMonth[0]; //year
                                        $pmonth = $splitMonth[1]; //month

                                        if ($pyear == $thisyear) {
                                            if ($pmonth == $thismonth) {
                                                $b = $b + $invoice_data["total"];
                                                $e = $e + $invoice_data["qty"];
                                            }
                                        }
                                    }

                                    ?>

                                    <div class="row">
                                        <div class="col-12 col-lg-4 d-grid bg-body border rounded py-4">
                                            <label class="fs-5 text-center fw-bold text-dark-50 " style="font-family: Century Gothic;">Monthly Earnings &nbsp;<i class="bi bi-currency-dollar fs-4 text-success"></i></label>
                                            <label class="fw-bold text-center mb-2">Rs . <?php echo $b; ?> .00</label>
                                        </div>
                                        <div class="col-12 col-lg-4 d-grid bg-body border rounded py-4">
                                            <label class="fs-5 text-center fw-bold" style="font-family: Century Gothic;">Monthly Sellings &nbsp;<i class="bi bi-box-seam fs-4 text-danger"></i></label>
                                            <label class="fw-bold text-center mt-1 mb-2"><?php echo $e; ?> Items</label>
                                        </div>
                                        <div class="col-12 col-lg-4 d-grid bg-body border rounded py-4">
                                            <label class="fs-5 text-center fw-bold" style="font-family: Century Gothic;">Total Engagements &nbsp;<i class="bi bi-people-fill fs-4 text-secondary"></i></label>
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `user`");
                                            $user_num = $user_rs->num_rows;
                                            ?>
                                            <label class="fw-bold text-center mt-1 mb-2"><?php echo $user_num; ?> Requests</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-lg-4 d-grid bg-body border rounded py-4">
                                            <label class="fs-5 text-center fw-bold text-dark-50 " style="font-family: Century Gothic;">Todays Earnings &nbsp;<i class="bi bi-currency-dollar fs-4 text-primary"></i></label>
                                            <label class="fw-bold text-center mb-2">Rs . <?php echo $a; ?> .00</label>
                                        </div>
                                        <div class="col-12 col-lg-4 d-grid bg-body border rounded py-4">
                                            <label class="fs-5 text-center fw-bold" style="font-family: Century Gothic;">Todays Sellings &nbsp;<i class="bi bi-box-seam fs-4 text-warning"></i></label>
                                            <label class="fw-bold text-center mt-1 mb-2"><?php echo $c; ?> Items</label>
                                        </div>
                                        <div class="col-12 col-lg-4 d-grid bg-body border rounded py-4">
                                            <label class="fs-5 text-center fw-bold" style="font-family: Century Gothic;">Total Sellings &nbsp;<i class="bi bi-boxes fs-4 text-success"></i></label>
                                            <label class="fw-bold text-center mt-1 mb-2"><?php echo $f; ?> Items</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-4 mb-3 border border-4 border-dark">

                            <div class="col-12 col-lg-10 offset-lg-1 d-grid bg-body mt-2 mb-3 border rounded py-4">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <label class="fs-4 text-success ms-3 fw-bold">Total Active Time &nbsp;<i class="bi bi-hourglass-split fs-4 text-black"></i></label>
                                    </div>
                                    <div class="col-12 col-lg-8">
                                        <?php

                                        $start_date = new DateTime("2022-09-27 00:00:00");

                                        $tdate = new DateTime();
                                        $tz = new DateTimeZone("Asia/Colombo");
                                        $tdate->setTimezone($tz);

                                        $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                        $difference = $end_date->diff($start_date);

                                        ?>
                                        <label class="fs-4 text-info ms-3 fw-bold form-label">

                                            <?php

                                            echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                                $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                                $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";

                                            ?>

                                        </label>
                                    </div>
                                </div>
                            </div>

                            <hr class="border border-4 border-dark">

                            <div class="row mb-3">
                                <div class="col-12 col-lg-10 offset-lg-1">
                                    <div class="row">

                                        <div class="col-12 col-lg-6">
                                            <div class="card mb-3" style="max-width: 540px;">
                                                <div class="row g-0 py-3 px-2">
                                                    <?php

                                                    $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence` FROM `invoice` WHERE `date` 
                                                    LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurence` DESC LIMIT 1");

                                                    $freq_num = $freq_rs->num_rows;
                                                    if ($freq_num > 0) {
                                                        $freq_data = $freq_rs->fetch_assoc();

                                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                                        $product_data = $product_rs->fetch_assoc();

                                                        $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $freq_data["product_id"] . "'");
                                                        $image_data = $image_rs->fetch_assoc();

                                                        $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE 
                                                        `product_id`='" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                                        $qty_data = $qty_rs->fetch_assoc();

                                                    ?>

                                                        <div class="col-md-4">
                                                            <img src="<?php echo $image_data["code"]; ?>" class="img-fluid rounded-start mt-3 ms-2">
                                                        </div>
                                                        <div class="col-md-8 text-center">
                                                            <div class="card-body">
                                                                <h5 class="card-title fw-bolder pb-2">Mostly Sold Item</h5>
                                                                <h5 class=" fw-bold mt-2" style="font-family: Lucida Sans;"><?php echo $product_data["title"]; ?></h5>
                                                                <span class="card-text fw-bold text-primary">Rs. <?php echo $qty_data["qty_total"] * $product_data["price"]; ?> .00</span><br />
                                                                <span class="card-text fw-bold text-success"><?php echo $qty_data["qty_total"]; ?> Items</span> <br>
                                                                <img src="resource/star.jpg" style="height: 60px; width:60px;" class="mt-2">
                                                            </div>
                                                        </div>

                                                    <?php

                                                    } else {
                                                    ?>

                                                        <div class="col-md-4">
                                                            <img src="resource/empty.svg" class="img-fluid rounded-start mt-3 ms-2">
                                                        </div>
                                                        <div class="col-md-8 text-center">
                                                            <div class="card-body">
                                                                <h5 class="card-title fw-bolder pb-2">Mostly Sold Item</h5>
                                                                <h5 class=" fw-bold mt-2" style="font-family: Lucida Sans;">-----</h5>
                                                                <span class="card-text fw-bold text-primary">Rs. 00 .00</span><br />
                                                                <span class="card-text fw-bold text-success">00 Items</span> <br>
                                                                <img src="resource/star.jpg" style="height: 60px; width:60px;" class="mt-2">
                                                            </div>
                                                        </div>

                                                    <?php
                                                    }

                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <div class="card mb-3" style="max-width: 540px;">
                                                <div class="row g-0 py-3 px-2">
                                                    <?php

                                                    if ($freq_num > 0) {

                                                        $profile_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $product_data["user_email"] . "'");
                                                        $profile_data = $profile_rs->fetch_assoc();

                                                        $user_rs1 = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                                        $user_data1 = $user_rs1->fetch_assoc();

                                                    ?>

                                                        <div class="col-md-4">
                                                            <img src="<?php echo $profile_data["path"]; ?>" class="img-fluid rounded-start mt-3 ms-2">
                                                        </div>
                                                        <div class="col-md-8 text-center">
                                                            <div class="card-body">
                                                                <h5 class="card-title pb-2 fw-bold">Most Famous Seller</h5>
                                                                <h5 class=" fw-bold mt-2" style="font-family: Lucida Sans;"><?php echo $user_data1["fname"] . " " . $user_data1["lname"]; ?></h5>
                                                                <span class="card-text fw-bold text-primary"><?php echo $user_data1["email"]; ?></span><br />
                                                                <span class="card-text fw-bold text-success"><?php echo $user_data1["mobile"]; ?></span> <br>
                                                                <img src="resource/star.jpg" style="height: 60px; width:60px;" class="mt-2">
                                                            </div>
                                                        </div>

                                                    <?php
                                                    } else {
                                                    ?>

                                                        <div class="col-md-4">
                                                            <img src="resource/user-3.jpg" class="img-fluid rounded-start mt-3 ms-2">
                                                        </div>
                                                        <div class="col-md-8 text-center">
                                                            <div class="card-body">
                                                                <h5 class="card-title pb-2 fw-bold">Most Famous Seller</h5>
                                                                <h5 class=" fw-bold mt-2" style="font-family: Lucida Sans;">-----</h5>
                                                                <span class="card-text fw-bold text-primary">------</span><br />
                                                                <span class="card-text fw-bold text-success">----</span> <br>
                                                                <img src="resource/star.jpg" style="height: 60px; width:60px;" class="mt-2">
                                                            </div>
                                                        </div>

                                                    <?php
                                                    }

                                                    ?>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
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