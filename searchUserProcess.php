<?php

require "connection.php";

$txt = $_POST["txt"];

if (empty($txt)) {
    echo ("Type the name of the user.");
} else {

    $user_rs = Database::search("SELECT * FROM `user` WHERE `fname` LIKE '%" . $txt . "%' OR `lname` LIKE '%" . $txt . "%' ");
    $user_num = $user_rs->num_rows;

?>

    <div class="col-12 bg-dark pb-4 pt-4 border rounded" >
        <div class="row justify-content-center gap-2">

            <?php

            for ($x = 0; $x < $user_num; $x++) {
                $user_data = $user_rs->fetch_assoc();

            ?>

                <div class="col-12 col-lg-2 g-grid ms-3">
                    <div class="card pt-2 mb-2" style="width: 14rem;">

                        <?php

                        $img_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $user_data["email"] . "' ");
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

                        <div class="card-body text-center">
                            <span class="fs-5"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span><br>
                            <span class="text-primary"><?php echo $user_data["mobile"]; ?></span><br>
                            <button class="col-12 btn btn-success mt-2">Contact User </button>
                            <button class="col-12 btn btn-dark mt-2">Block user &nbsp;<i class="bi bi-x-circle"></i></button>
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