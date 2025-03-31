<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Chat | Trewo Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />
</head>

<?php

include "header.php";
if (isset($_SESSION["u"])) {

?>

    <body style="background-color: #E9EBEE;">

        <div class="container-fluid">
            <div class="row">

                <?php

                require "connection.php";

                $mail = $_SESSION["u"]["email"];

                ?>

                <hr class="mt-2">

                <div class="row justify-content-md-end mt-3">
                    <div class="col-1 col-lg-1">
                        <button type="button" class="btn btn-light position-relative rounded-pill mt-2">
                            <i class="bi bi-bell-fill"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                99+
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </button>
                    </div>
                    <div class="col-2 ms-5 col-lg-1">
                        <?php

                        $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $mail . "'");
                        $img_data = $img_rs->fetch_assoc();

                        if (isset($img_data["path"])) {
                        ?>
                            <img src="<?php echo $img_data["path"]; ?>" style="width: 50px; height: 50px;" class="rounded-circle" />
                        <?php
                        } else {
                        ?>
                            <img src="resource/new_user4.png" ; style="width: 50px; height: 50px;" class="rounded-circle">
                        <?php
                        }

                        ?>
                    </div>
                    <div class="col-7 col-lg-2 ms-2">
                        <button class="btn btn-secondary rounded-pill ms-lg-3 px-4 mt-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Customize <i class="bi bi-gear-fill"></i></button>

                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title fs-4 text-success fw-bold" id="offcanvasRightLabel">Adjust to your preference</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">

                                <img src="resource/gear.png" style="height: 250px; width:350px;">

                                <div class="col-12 text-center mt-2">
                                    <span class="fs-5 text-primary fw-bold">Select colour theme</span><br>
                                    <span class="text-black-50">Overall light or dark presentation.</span>
                                    <div class="btn-group btn-group-lg mt-4 " role="group" aria-label="Large button group">
                                        <button type="button" class="btn btn-outline-secondary"><i class="bi bi-brightness-high"></i>&nbsp; Light</button>
                                        <button type="button" class="btn btn-outline-secondary"><i class="bi bi-moon"></i>&nbsp; Dark</button>
                                        <button type="button" class="btn btn-outline-secondary"><i class="bi bi-cloud-sun-fill"></i>&nbsp; Auto</button>
                                    </div>
                                </div>

                                <div class="col-12 text-center mt-5">
                                    <span class="fs-5 text-primary fw-bold">Navigation colour</span><br>
                                    <span class="text-black-50">Usually dictated by the color scheme.</span>
                                    <div class="btn-group btn-group-lg mt-4 " role="group" aria-label="Large button group">
                                        <button type="button" class="btn btn-outline-secondary">Default</button>
                                        <button type="button" class="btn btn-outline-secondary">Inverted</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 py-5 px-4">
                    <div class="row overflow-hidden shadow rounded">

                        <div class="col-12 col-lg-5 px-0">
                            <div class="bg-white">
                                <div class="bg-light px-4 py-2">
                                    <div class="col-12">
                                        <h5 class="mb-0 my-1 fw-bold text-primary mb-2">Recents</h5>
                                    </div>

                                    <div class="col-12">
                                        <!-- msg list box -->

                                        <?php

                                        $msg_rs = Database::search("SELECT DISTINCT `content`,`date_time`,`status`,`from` 
                                    FROM `chat` WHERE `to`='" . $mail . "' ORDER BY `date_time` DESC");
                                        $msg_num = $msg_rs->num_rows;

                                        ?>

                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Received</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sent</button>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="message_box" id="message_box">

                                                    <?php

                                                    for ($x = 0; $x < $msg_num; $x++) {
                                                        $msg_data = $msg_rs->fetch_assoc();

                                                        if ($msg_data["status"] == 0) {

                                                    ?>

                                                            <div class="list-group rounded-0" onclick="viewMessages('<?php echo $msg_data['from']; ?>');">
                                                                <a href="#" class="list-group-item list-group-item-action text-white rounded-0 bg-primary">

                                                                    <?php
                                                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data["from"] . "'");
                                                                    $user_data = $user_rs->fetch_assoc();

                                                                    $img_rs1 = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $msg_data["from"] . "'");
                                                                    $img_data1 = $img_rs1->fetch_assoc();
                                                                    ?>

                                                                    <div class="media">

                                                                        <?php

                                                                        if (isset($img_data1["path"])) {
                                                                        ?>
                                                                            <img src="<?php echo $img_data1["path"]; ?>" width="50px" class="rounded-circle" />
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <img src="resource/new_user4.png" ; width="50px" class="rounded-circle">
                                                                        <?php
                                                                        }

                                                                        ?> <div class="me-4">
                                                                            <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                                <h6 class="mb-0 fw-bold"><?php echo $user_data["fname"]; ?></h6>
                                                                                <small class="small fw-bold"><?php echo $msg_data["date_time"]; ?></small>

                                                                            </div>
                                                                            <p class="mb-0"><?php echo $msg_data["content"]; ?></p>
                                                                        </div>

                                                                    </div>

                                                                </a>
                                                            </div>

                                                        <?php

                                                        } else {
                                                        ?>

                                                            <div class="list-group rounded-0" onclick="viewMessages('<?php echo $msg_data['from']; ?>');">
                                                                <a href="#" class="list-group-item list-group-item-action text-dark rounded-0 bg-body">

                                                                    <?php

                                                                    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data["from"] . "'");
                                                                    $user_data = $user_rs->fetch_assoc();

                                                                    $img_rs1 = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $msg_data["from"] . "'");
                                                                    $img_data1 = $img_rs1->fetch_assoc();

                                                                    ?>
                                                                    <div class="media">
                                                                        <?php

                                                                        if (isset($img_data["path"])) {
                                                                        ?>
                                                                            <img src="<?php echo $img_data1["path"]; ?>" width="50px" class="rounded-circle" />
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <img src="resource/new_user4.png" width="50px" class="rounded-circle">
                                                                        <?php
                                                                        }

                                                                        ?>

                                                                        <div class="me-4">
                                                                            <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                                <h6 class="mb-0 fw-bold"><?php echo $user_data["fname"]; ?></h6>
                                                                                <small class="small fw-bold"><?php echo $msg_data["date_time"]; ?></small>

                                                                            </div>
                                                                            <p class="mb-0"><?php echo $msg_data["content"]; ?></p>
                                                                        </div>
                                                                    </div>
                                                                </a>

                                                            </div>

                                                    <?php
                                                        }
                                                    }

                                                    ?>

                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                                <div class="message_box" id="message_box">
                                                    <?php

                                                    $msg_rs2 = Database::search("SELECT DISTINCT `content`,`date_time`,`status`,`to` FROM `chat` WHERE `from`='" . $mail . "' ORDER BY `date_time` DESC");
                                                    $msg_num2 = $msg_rs2->num_rows;

                                                    for ($y = 0; $y < $msg_num2; $y++) {
                                                        $msg_data2 = $msg_rs2->fetch_assoc();
                                                    ?>
                                                        <div class="list-group rounded-0" onclick="viewMessages('<?php echo $msg_data['from']; ?>');">
                                                            <a href="#" class="list-group-item list-group-item-action text-black rounded-0 bg-secondary">
                                                                <div class="media">
                                                                    <?php
                                                                    $user_rs2 = Database::search("SELECT * FROM `user` WHERE `email`='" . $msg_data2["to"] . "'");
                                                                    $user_data2 = $user_rs2->fetch_assoc();

                                                                    $img_rs3 = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $msg_data2["to"] . "'");
                                                                    $img_data3 = $img_rs3->fetch_assoc();

                                                                    if (isset($img_data3["path"])) {
                                                                    ?>
                                                                        <img src="<?php echo $img_data3["path"]; ?>" width="50px" class="rounded-circle" />
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <img src="resource/new_user4.png" width="50px" class="rounded-circle">
                                                                    <?php
                                                                    }

                                                                    ?>
                                                                    <div class="me-4">
                                                                        <div class="d-flex align-items-center justify-content-between mb-1 ">
                                                                            <h6 class="mb-0 fw-bold"> Me</h6>
                                                                            <small class="small fw-bold"><?php echo $msg_data2["date_time"]; ?></small>

                                                                        </div>
                                                                        <p class="mb-0"><?php echo $msg_data2["content"]; ?></p>
                                                                    </div>
                                                                </div>
                                                            </a>

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

                        <!-- chat_box -->
                        <div class="col-12 col-lg-7 px-0">
                            <div class="row px-4 py-5 text-white chat_box" id="chat_box">

                                <!-- view area -->

                            </div>
                            <!-- txt -->
                            <div class="col-12 px-2">
                                <div class="row">
                                    <div class="input-group mb-3 ">
                                        <input type="text" id="msg_txt" class="form-control rounded border-0 py-3 bg-light" placeholder="Type a message ..." aria-describedby="send_btn">
                                        <button class="btn btn-light fs-2 rounded" id="send_btn" onclick="send_msg();"><i class="bi bi-send-fill fs-1"></i></button>
                                    </div>
                                </div>
                            </div>
                            <!-- txt -->
                        </div>
                        <!-- chat_box -->

                    </div>
                </div>

                <div class="row justify-content-md-end mb-3">
                    <div class="col-12 col-lg-2 d-grid">
                        <button type="button" class="btn btn-warning rounded-pill btn-lg" onclick="contactAdmin('<?php echo $_SESSION['u']['email']; ?>');">
                            Contact Admin &nbsp;<i class="bi bi-wechat"></i></button>
                    </div>
                </div>

                <!-- msg modal -->
                <div class="modal" tabindex="-1" id="contactAdmin">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img src="resource/admin.png" ; width="50px" class="rounded-circle">
                                <h5 class="modal-title ms-5 fw-bold">Contact Admin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body overflow-scroll" style="height: 40vh;">

                                <?php

                                $message_rs = Database::search("SELECT * FROM `admin_chat` WHERE `from` = '" . $mail . "' OR `to` = '" . $mail . "'  ");
                                $message_num = $message_rs->num_rows;

                                for ($y = 0; $y < $message_num; $y++) {
                                    $message_data = $message_rs->fetch_assoc();

                                    if ($message_data["status"] == "1") {

                                ?>

                                        <!-- sent -->
                                        <div class="col-12 mt-2">
                                            <div class="row">
                                                <div class="offset-5 col-7 rounded border border-primary">
                                                    <div class="row">
                                                        <div class="col-12 pt-2">
                                                            <span class="text- fw-bold fs-4"><?php echo $message_data["content"]; ?></span>
                                                        </div>
                                                        <div class="col-12 text-end pb-2">
                                                            <span class="text- fs-6"><?php echo $message_data["date_time"]; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- sent -->

                                    <?php

                                    } else if ($message_data["status"] == "2") {

                                    ?>

                                        <!-- received -->
                                        <div class="col-12 mt-2">
                                            <div class="row">
                                                <div class="col-7 rounded border border-success">
                                                    <div class="row">
                                                        <div class="col-12 pt-2">
                                                            <span class="text- fw-bold fs-4"><?php echo $message_data["content"]; ?></span>
                                                        </div>
                                                        <div class="col-12 text-end pb-2">
                                                            <span class="text- fs-6"><?php echo $message_data["date_time"]; ?></span>
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
                            <div class="modal-footer">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="text" placeholder="Type your message..." class="form-control border border-black-50" id="msgtxt" />
                                        </div>
                                        <div class="col-3 d-grid">
                                            <button type="button" class="btn btn-primary rounded-pill" onclick="sendAdminMsg('<?php echo $mail; ?>');">Send &nbsp;<i class="bi bi-send"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- msg modal -->

                <?php include "footer.php"; ?>

            </div>
        </div>


        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>

    </body>
<?php
} else {
?>

    <body>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="d-flex flex-column align-items-center mt-5">
                        <img src="resource/message.png" style="height: 320px; width: 320px;">
                    </div>
                    <div class="d-flex flex-column align-items-center mt-5">
                        <span class="fs-2 fw-bold text-warning">You need to sign In to use this feature.</span>
                    </div>
                    <div class="d-flex flex-column align-items-center mt-5">
                        <a class="btn btn-secondary btn-lg" href="index.php">Sign In or Register</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

</html>

<?php
}

?>

</html>