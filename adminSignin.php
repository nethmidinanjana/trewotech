<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Sign In | Trewo Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />
</head>

<body>

    <div class="main-body" style="background-color: #E9EBEE;">
        <div class="container-fluid vh-100  justify-content-center">
            <div class="row">

                <!-- header -->

                <div class="col-12  bg-secondary">
                    <div class="row">
                        <div class="col-12  logo mt-2 mb-3"></div>
                    </div>
                </div>

                <!-- header -->

                <!-- content -->

                <div class="col-12 mt-5 mb-">
                    <h3 class="text-center title1 fw-bold  text-success" style="font-family: Lucida Sans;">WELCOME ADMINS.</h3>
                </div>

                <div class="col-12 p-3 mt-2">
                    <div class="row ">


                        <div class="col-lg-6 d-lg-block bg"></div>

                        <div class="col-12 col-lg-4 mt-5 py-5">
                            <div class="row g-2">
                                <div class="col-12">
                                    <p class="title2">Admin Sign In</p>
                                    <span class="text-danger"></span>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter your email" id="e">
                                </div>
                                <div class="col-12 d-grid mt-3">
                                    <button class="btn btn-warning" onclick="adminVerification();">
                                        <span id="btn_txt">Send verification code</span>
                                    </button>
                                </div>
                                <div class="col-12 d-grid mt-3">
                                    <a class="btn btn-secondary" href="index.php" ;>Back to customer Login</a>
                                </div>

                            </div>
                            <div class="col-12 fixed-bottom d-none d-lg-block">
                                <p class="text-center">&copy; 2022 trewoTech.lk || All Right Reserved</p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- content -->

            </div>

            <!-- Modal -->

            <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>