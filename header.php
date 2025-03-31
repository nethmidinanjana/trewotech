<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="col-12">
        <div class="row mt-1 mb-1">

            <div class="offset-lg-1 col-12 col-lg-4 align-self-start mt-2">

                <?php

                session_start();

                if (isset($_SESSION["u"])) {

                    $data = $_SESSION["u"];

                ?>

                    <span class="text-lg-start "><b>Welcome </b><?php echo $data["fname"]; ?></span> |
                    <span class="text-lg-start fw-bold signout" onclick="signout();">Sign out</span> |

                <?php

                } else {

                ?>

                    <a href="index.php" class="text-decoration-none fw-bold text-black">Sign In or Register</a> |

                <?php

                }

                ?>

                <a class="text-lg-start fw-bold col-12 text-decoration-none text-dark" href="help&contact.php">Help and Contact |</a>
                <a class="text-lg-start fw-bold col-12 ms-2 text-decoration-none text-dark" href="home.php"><i class="bi bi-house-door-fill"></i>&nbsp; Home</a>


            </div>

            <div class="offset-lg-2 col-12 col-lg-5 align-self-end">
                <div class="row">
                    <div class="col-1 col-lg-3 mt-2 col-6">
                        <a class="fw-bold text-black-50 text-decoration-none wishList" href="wishList.php" style="font-size:15px;">Wish list &nbsp;<i class="bi bi-suit-heart-fill"></i></a>
                    </div>
                    <div class="col-1 col-lg-3 mt-2 col-6">
                        <a class="fw-bold text-black-50 text-decoration-none" href="myProfile.php">Account &nbsp;<i class="bi bi-person-circle"></i></a>
                    </div>
                    <div class="col-1 col-lg-3 mt-2 col-6">
                        <a class="fw-bold text-black-50 text-decoration-none" href="mySelling.php">My Shop &nbsp;<i class="bi bi-house-heart-fill"></i></a>
                    </div>
                    <div class="col-1 col-lg-3 mt-2 col-6">
                        <a class="fw-bold text-black-50 text-decoration-none" href="message.php">Chat &nbsp;<i class="bi bi-chat-dots-fill"></i></a>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script src="script.js"></script>
</body>

</html>