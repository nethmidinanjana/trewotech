<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />

    <title>My Profile | Trewo Tech</title>
</head>

<body>

    <div class="container-fluid" style="background-color: #E9EBEE;">
        <div class="row">

            <?php

            session_start();
            require "connection.php";

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON gender.id = user.gender_id WHERE `email` ='" . $email . "' ");

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email` ='" . $email . "' ");

                $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON 
            user_has_address.city_id=city.id INNER JOIN `district` ON 
            city.district_id=district.id INNER JOIN `province` ON 
            district.province_id=province.id WHERE `user_email`= '" . $email . "' ");

                $data = $details_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();


            ?>

                <div class="col-12">
                    <div class="row ">

                        <div class="col-12">
                            <div class="row">
                                <!-- header -->
                                <div class="col-12">
                                    <nav class="navbar navbar-dark bg-dark fixed-top">
                                        <div class="container-fluid">
                                            <div class="col-10 offset-1 text-center mt-3 mb-3">
                                                <span class="navbar-brand fs-1">My Profile</span>
                                            </div>
                                            <button class="navbar-toggler me-5 border border-secondary border-4 rounded" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                                                <span class="navbar-toggler-icon"></span>
                                            </button>
                                            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                                                <div class="offcanvas-header">
                                                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Other Options</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                </div>
                                                <div class="offcanvas-body">
                                                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                                        <li class="nav-item">
                                                            <div class="col-12 bg-secondary mt-3 mb-3 text-white-50 border rounded text-center">
                                                                <a class="nav-link active" aria-current="page" href="home.php">Home &nbsp;<i class="bi bi-house-heart-fill"></i></i></a>
                                                            </div>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="wishList.php">Wish List</a>
                                                            <a class="nav-link" href="cart.php">My Cart</a>
                                                        </li>
                                                        <li class="nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                See More
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-dark">
                                                                <li><a class="dropdown-item" href="message.php">Message</a></li>
                                                                <li><a class="dropdown-item" href="purchasedHistory.php">Purchased History</a></li>
                                                                <li>
                                                                    <hr class="dropdown-divider">
                                                                </li>
                                                                <li><a class="dropdown-item" href="mySelling.php">My shop</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                                <!-- header -->
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br><br>

                <!-- body -->

                <div class="col-12 bg- rounded mt-4 ">
                    <div class="row g-2">

                        <div class="col-12 col-md-3 border-end border-4">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                <?php

                                if (empty($image_data["path"])) {

                                ?>

                                    <img src="resource/new_user_img.png" class="rounded-circle mb-3" style="height: 180px; width: 180px;" id="viewImg">

                                <?php

                                } else {

                                ?>

                                    <img src="<?php echo $image_data["path"]; ?>" class="rounded-circle mb-3" style="height: 180px; width: 180px;" id="viewImg">

                                <?php

                                }

                                ?>


                                <span class="fs-5 fw-bold"><?php echo $data["fname"] . " " . $data["lname"]; ?></span><br>
                                <span class="fw-bold text-black-50"><?php echo $email; ?></span><br>

                                <input type="file" class="d-none" accept="image/*" id="profileimg">
                                <label for="profileimg" class="btn btn-primary mt-2" onclick="changeImg();">Upload Profile Image</label>

                            </div>
                        </div>

                        <div class="col-12 col-md-6 offset-lg-2 border rounded border-2 bg-body mb-5">
                            <div class="p-1 py-3 mx-3">

                                <div class="col-12 text-center text-primary mt-2">
                                    <h3 class="fw-bold">Profile Informations</h3>
                                </div>

                                <div class="row mt-4 ">
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" value="<?php echo $data["fname"]; ?>" id="fname">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" value="<?php echo $data["lname"]; ?>" id="lname">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">Mobile</label>
                                        <input type="text" class="form-control" value="<?php echo $data["mobile"]; ?>" id="mobile">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" value="<?php echo $data["password"]; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="<?php echo $data["email"]; ?>" disabled>
                                </div>
                                <div class="col-12 mt-3">
                                    <label class="form-label">Registered Date</label>
                                    <input type="text" class="form-control" value="<?php echo $data["joined_date"]; ?>" disabled>
                                </div>

                                <?php

                                if (!empty($address_data["line1"])) {

                                ?>
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Address Line 1</label>
                                        <input type="text" class="form-control" value="<?php echo $address_data["line1"]; ?>" id="line1">
                                    </div>
                                <?php

                                } else {

                                ?>
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Address Line 1</label>
                                        <input type="text" class="form-control" id="line1">
                                    </div>
                                <?php

                                }

                                ?>

                                <?php

                                if (!empty($address_data["line2"])) {

                                ?>
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Address Line 2</label>
                                        <input type="text" class="form-control" value="<?php echo $address_data["line2"]; ?>" id="line2">
                                    </div>
                                <?php

                                } else {

                                ?>
                                    <div class="col-12 mt-3">
                                        <label class="form-label">Address Line 2</label>
                                        <input type="text" class="form-control" id="line2">
                                    </div>
                                <?php

                                }

                                $province_rs = Database::search("SELECT * FROM `province`");
                                $district_rs = Database::search("SELECT * FROM `district`");

                                ?>
                                <div class="row mt-4">
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">Province</label>
                                        <select class="form-select" id="province">
                                            <option value="0">Select Province</option>
                                            <?php

                                            $province_num = $province_rs->num_rows;
                                            for ($x = 0; $x < $province_num; $x++) {
                                                $province_data = $province_rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $province_data["id"]; ?>" <?php

                                                                                                    if (!empty($address_data["province_id"])) {
                                                                                                        if ($province_data["id"] == $address_data["province_id"]) {
                                                                                                    ?>selected<?php
                                                                                                        }
                                                                                                    }

                                                                                                            ?>><?php echo $province_data["name"]; ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">District</label>
                                        <select class="form-select" id="district">
                                            <option value="0">Select District</option>
                                            <?php
                                            $district_num = $district_rs->num_rows;
                                            for ($x = 0; $x < $district_num; $x++) {
                                                $district_data = $district_rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $district_data["id"]; ?>" <?php
                                                                                                    if (!empty($address_data["district_id"])) {

                                                                                                        if ($district_data["id"] == $address_data["district_id"]) {
                                                                                                    ?>selected<?php

                                                                                                        }
                                                                                                    }
                                                                                                            ?>><?php echo $district_data["name"]; ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 col-lg-6">
                                        <label class="form-label">City</label>
                                        <select class="form-select" id="city">
                                            <option value="0">Select City</option>
                                            <?php
                                            $city_rs = Database::search("SELECT * FROM `city`");
                                            $city_num = $city_rs->num_rows;
                                            for ($x = 0; $x < $city_num; $x++) {
                                                $city_data = $city_rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $city_data["id"]; ?>" <?php
                                                                                                if (!empty($address_data["city_id"])) {
                                                                                                    if ($city_data["id"] == $address_data["city_id"]) {
                                                                                                ?>selected<?php

                                                                                                    }
                                                                                                }
                                                                                                        ?>><?php echo $city_data["city_name"]; ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <?php

                                    if (!empty($address_data["postal_code"])) {
                                    ?>
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" id="pcode">
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-12 col-lg-6">
                                            <label class="form-label">Postal Code</label>
                                            <input type="text" class="form-control" id="pcode">
                                        </div>
                                    <?php
                                    }

                                    ?>


                                </div>
                                <div class="col-12 mt-3">
                                    <label class="form-label">Gender</label>
                                    <input type="text" class="form-control" disabled value="<?php echo $data["gender_name"]; ?>" />
                                </div>
                                <div class="col-12 d-grid mt-3">
                                    <button class="btn btn-primary" onclick="updateProfile();">Update My Profile</button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- body -->

            <?php

            } else {
                header("Location:http://localhost/trewotech/home.php");
            }

            include "footer.php";

            ?>


        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>