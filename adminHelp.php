<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Customer issues | Trewo Tech</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resource/logo.png" />
    </head>

    <body>

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
                            <div class="col-12 mt-2 mb-2">
                                <a href="adminPanel.php" class="btn btn-light d-grid text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold" style="font-family: Gill Sans;">Dashboard</a>
                                <a href="manageUser.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-light" style="font-family: Gill Sans;">Manage Users</a>
                                <a href="manageProduct.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-light" style="font-family: Gill Sans;">Manage Product</a>
                                <a href="adminHelp.php" class="text-decoration-none mt-2 mb-2 fs-5 text-warning fw-bold d-grid text-center btn btn-primary" style="font-family: Gill Sans;">Customer issues</a>
                            </div>
                            <hr class="border border-light">
                            <div class="col-12 fs-5 text-center mb-2">
                                <a href="sellingHistory.php" class="text-white fw-bold fs-4 text-decoration-none" style="font-family: Futara;">Selling History</a>
                            </div>

                            <hr class="border border-light">

                        </div>

                        <div class="col-12 col-lg-9 mb-5">
                            <div class="col-12 col-lg-10 offset-lg-1">
                                <h3 class="col-12 text-primary fs-1 fw-bold mt-4 ms-2" style="font-family: aria;">Customer issues</h3>
                            </div>

                            <?php

                            if (isset($_GET["page"])) {
                                $pageno = $_GET["page"];
                            } else {
                                $pageno = 1;
                            }

                            $help_rs = Database::search("SELECT * FROM `help`");
                            $help_num = $help_rs->num_rows;

                            $results_per_page = 4;
                            $number_of_pages = ceil($help_num / $results_per_page);

                            $page_results = ($pageno - 1) * $results_per_page;

                            $selected_rs = Database::search("SELECT * FROM `help` LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

                            $selected_num = $selected_rs->num_rows;

                            for ($x = 0; $x < $selected_num; $x++) {
                                $selected_data = $selected_rs->fetch_assoc();

                            ?>

                                <div class="col-12 col-lg-10 offset-lg-1 mt-4">
                                    <div class="card text-center">
                                        <div class="card-header text-primary">
                                            ID : <?php echo $selected_data["id"]; ?>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title text-danger">Email : <?php echo $selected_data["email"]; ?></h5>
                                            <p class="card-text"><?php echo $selected_data["content"]; ?></p>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <?php echo $selected_data["date_n_time"]; ?>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>

                            <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
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