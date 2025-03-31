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

        <title>Manage User | Trewo Tech</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resource/logo.png" />
    </head>

    <body>

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
                                    <a href="manageUser.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-primary" style="font-family: Gill Sans;">Manage Users</a>
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
                                <h3 class="col-12 text-primary fw-bold mt-4 ms-2 ms-lg-5" style="font-family: aria;">Manage User</h3>
                                <hr class="mt-3 mb-3">
                                <div class="row">
                                    <div class="col-12 col-lg-8 offset-lg-2">
                                        <div class="input-group mt-3 mt-lg-3 mb-3">
                                            <input type="text" class="form-control" placeholder="Search User..." id="searchusertxt">
                                            <button type="button" class=" btn btn-primary" onclick="searchUser();"><i class="bi bi-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mt-4 mb-3">

                                <!-- box1 -->

                                <div class="col-12 bg-dark pb-4 pt-4 border rounded" id="searchUserResult">
                                    <div class="row justify-content-center gap-2">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $user_rs = Database::search("SELECT * FROM `user`");
                                        $user_num = $user_rs->num_rows;

                                        $results_per_page = 10;
                                        $number_of_pages = ceil($user_num / $results_per_page);

                                        $page_results = ($pageno - 1) * $results_per_page;

                                        $selected_rs = Database::search("SELECT * FROM `user` LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                                        $selected_num = $selected_rs->num_rows;

                                        for ($x = 0; $x < $selected_num; $x++) {
                                            $selected_data = $selected_rs->fetch_assoc();

                                        ?>

                                            <div class="col-12 col-lg-2 g-grid ms-3">
                                                <div class="card pt-2 mb-2" style="width: 14rem;">

                                                    <div class="col-12" onclick="viewUserModal('<?php echo $selected_data['email']; ?>')">

                                                        <?php

                                                        $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $selected_data["email"] . "' ");
                                                        $img_data = $img_rs->fetch_assoc();

                                                        if (isset($img_data["path"])) {
                                                        ?>

                                                            <img src="<?php echo $img_data["path"]; ?>" class="card-img-top ms-5" style="height: 130px; width:130px;">

                                                        <?php
                                                        } else {
                                                        ?>

                                                            <img src="resource/newuser.jpg" class="card-img-top ms-5" style="height: 130px; width:130px;">

                                                        <?php
                                                        }

                                                        ?>

                                                    </div>

                                                    <div class="card-body text-center">
                                                        <span class="fs-5"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span><br>
                                                        <button class="col-12 btn btn-secondary mt-2" onclick="viewMsgModal('<?php echo $selected_data['email']; ?>');">Contact User &nbsp;<i class="bi bi-chat-dots-fill"></i></button>

                                                        <div class="col-12 d-grid mt-2">
                                                            <?php

                                                            if ($selected_data["status"] == 1) {
                                                            ?>
                                                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-danger" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Block</button>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <button id="ub<?php echo $selected_data['email']; ?>" class="btn btn-success" onclick="blockUser('<?php echo $selected_data['email']; ?>');">Unblock</button>
                                                            <?php
                                                            }

                                                            ?>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- modal01 -->
                                            <div class="modal" tabindex="-1" id="viewUserModal<?php echo $selected_data["email"]; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-bold text-success"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="offset-4 col-4">
                                                                <?php

                                                                if (isset($img_data["path"])) {
                                                                ?>

                                                                    <img src="<?php echo $img_data["path"]; ?>" class="card-img-top ms-5" style="height: 130px; width:130px;">

                                                                <?php
                                                                } else {
                                                                ?>

                                                                    <img src="resource/newuser.jpg" class="card-img-top ms-5" style="height: 130px; width:130px;">

                                                                <?php
                                                                }

                                                                ?>
                                                            </div>
                                                            <div class="col-12 mt-4">
                                                                <span class="fs-5 fw-bold">Email :</span>&nbsp;
                                                                <span class="fs-5"><?php echo $selected_data["email"]; ?></span><br>
                                                                <span class="fs-5 fw-bold">Mobile :</span>&nbsp;
                                                                <span class="fs-5"><?php echo $selected_data["mobile"]; ?></span><br>
                                                                <span class="fs-5 fw-bold">Joined Date :</span>&nbsp;
                                                                <span class="fs-5"><?php echo $selected_data["joined_date"]; ?></span><br>
                                                                <?php
                                                                $gender_rs = Database::search("SELECT * FROM `gender` WHERE `id`='" . $selected_data["gender_id"] . "' ");
                                                                $gender_data = $gender_rs->fetch_assoc();
                                                                ?>
                                                                <span class="fs-5 fw-bold">Gender :</span>&nbsp;
                                                                <span class="fs-5"><?php echo $gender_data["gender_name"]; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- modal01 -->

                                            <!-- msg modal -->
                                            <div class="modal" tabindex="-1" id="userMsgModal<?php echo $selected_data["email"]; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-info">

                                                            <?php

                                                            if (isset($img_data["path"])) {
                                                            ?>
                                                                <img src="<?php echo $img_data["path"]; ?>" width="50px" class="rounded-circle" />
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <img src="resource/newuser.jpg" ; width="50px" class="rounded-circle">
                                                            <?php
                                                            }

                                                            ?> <h5 class="modal-title fw-bold ms-5"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body overflow-scroll" style="height: 40vh;">

                                                            <?php

                                                            $msg_rs = Database::search("SELECT * FROM `admin_chat` WHERE `from` = '" . $selected_data["email"] . "' 
                                                            OR `to` = '" . $selected_data["email"] . "' ");
                                                            $msg_num = $msg_rs->num_rows;

                                                            for ($y = 0; $y < $msg_num; $y++) {
                                                                $msg_data = $msg_rs->fetch_assoc();

                                                                if ($msg_data["status"] == "2") {

                                                            ?>

                                                                    <!-- sent -->
                                                                    <div class="col-12 mt-2">
                                                                        <div class="row">
                                                                            <div class="offset-5 col-7 rounded bg-body border border-primary">
                                                                                <div class="row">
                                                                                    <div class="col-12 pt-2">
                                                                                        <span class="text-black fw-bold fs-5"><?php echo $msg_data["content"]; ?></span>
                                                                                    </div>
                                                                                    <div class="col-12 text-end pb-2">
                                                                                        <span class="text-black fs-6"><?php echo $msg_data["date_time"]; ?></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- sent -->

                                                                <?php

                                                                } else if ($msg_data["status"] == "1") {

                                                                ?>

                                                                    <!-- received -->
                                                                    <div class="col-12 mt-2">
                                                                        <div class="row">
                                                                            <div class="col-7 rounded bg-body border border-success">
                                                                                <div class="row">
                                                                                    <div class="col-12 pt-2">
                                                                                        <span class="text-black fw-bold fs-5"><?php echo $msg_data["content"]; ?></span>
                                                                                    </div>
                                                                                    <div class="col-12 text-end pb-2">
                                                                                        <span class="text-black fs-6"><?php echo $msg_data["date_time"]; ?></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- received -->

                                                            <?php

                                                                }
                                                            }

                                                            ?>

                                                        </div>
                                                        <!-- txt -->
                                                        <div class="modal-footer mt-3">

                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-9">
                                                                        <input type="text" class="form-control" id="msgtxt" placeholder="Type something..." />
                                                                    </div>
                                                                    <div class="col-3 d-grid">
                                                                        <button type="button" class="btn btn-primary" onclick="sendAdminMsg2('<?php echo $selected_data['email']; ?>');">Send <i class="bi bi-send"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- txt -->

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- msg modal -->

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


                                    </div>
                                </div>



                                <!-- box1 -->

                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
        </body>

    </body>

    </html>

<?php
} else {
    echo ("You are Not a valid user.");
}

?>