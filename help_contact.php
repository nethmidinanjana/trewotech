<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Help And Contact | Trewo Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body style="background-color: #E9EBEE;">

    <?php

    require "header.php";

    ?>
    <hr>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-4">

                <div class="col-12 col-lg-8 offset-lg-2 border border-3 mt-3 rounded px-3 py-3 bg-body">

                    <div class="col-12 text-center">
                        <span class="fs-4 fw-bold">How can we help you?</span>
                    </div>
                    <div class="d-flex flex-column align-items-center mt-3">
                        <img src="resource/admin.png" style="height: 90px; width: 90px;">
                    </div>

                    <div class="col-12 mt-3">
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading"> “Happy to help!”</h4>
                            <p>We are Trewo Tech supporting team. If you are having trouble using the application we are here to help you. Tell us your problem and we will fix it as soon as possible. Thank you for your concern.</p>
                            <hr>
                            <p class="mb-0">Whenever you need to, be sure to contact us.</p>
                        </div>
                    </div>

                    <div class="col-12 px-3 py-3">
                        <span class="fs-5 fw-bold text-warning">Type your problem here.</span>
                    </div>
                    <div class="col-12 px-3">
                        <textarea class="form-control" cols="10" rows="8" id="text"></textarea>
                    </div>
                    <div class="col-12 px-3">
                        <input type="email" placeholder="Enter your email..." class="form-control mt-3 mb-2" id="email">
                    </div>
                    <div class="col-12 col-lg-3 px-3 d-grid offset-lg-9 mt-4 mb-3">
                        <button class="btn btn-success" onclick="sendHelpTxt();">Send</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php

    require "footer.php";

    ?>

    <script src="script.js"></script>
</body>

</html>