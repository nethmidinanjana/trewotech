<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Trewo Tech</title>

    <link rel="stylesheet" href="bootstrap.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css"/>
    <link rel="icon" href="resource/logo.png"/>

</head>

<body class="main-body" style="background-color: #E9EBEE;">

    <div class="container-fluid vh-100 justify-content-center">
        <div class="row">

            <!-- header -->

            <div class="col-12  bg-secondary">
                <div class="row">
                    <div class="col-12 col-lg-3 logo mt-3 mb-3 offset-lg-1"></div>
                    <div class="col-12 col-lg-4 mt-4">
                        <h2 class="text-center title1 fw-bold text-dark mt-lg-4 mb-4" style="font-family: Trebuchet MS;">Hi, Welcome to Trewo Tech.</h2>
                    </div>
                </div>
            </div>

            <!-- header -->

            <!-- content -->

            <div class="col-12 p-3 mt-1">
                <div class="row">

                    <div class="col-6 d-lg-block bg"></div>

                    <div class="col-12 col-lg-6 mt-lg-5 pt-lg-4" id="signupbox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title2">Create New Account.</p>
                            </div>
                            <div class="col-12 d-none" id="msg_div">
                                <div class="alert alert-danger" role="alert" id="alertdiv">
                                    <i class="bi bi-x-octagon-fill fs-5" id="msg"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="f">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="l">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="e">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="p">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="m">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select text-center" id="g">

                                    <?php

                                    require "connection.php";

                                    $gender_rs = Database::search("SELECT * FROM `gender`");
                                    $gender_num = $gender_rs->num_rows;

                                    for ($x = 0; $x < $gender_num; $x++) {
                                        $gender_data = $gender_rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo $gender_data["id"]; ?>"><?php echo $gender_data["gender_name"]; ?></option>

                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 d-grid mt-3">
                                <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid mt-3">
                                <button class="btn btn-dark" onclick="changeView();">Already have an account ? Sign In</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 d-none mt-lg-5 pt-lg-4" id="signinbox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title2">Sign In</p>
                            </div>
                            <div class="col-12 d-none" id="msg_div2">
                                <div class="alert alert-danger" role="alert" id="alertdiv2">
                                    <i class="bi bi-x-octagon-fill fs-5" id="msg2"></i>
                                </div>
                            </div>
                            <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email2" value="<?php echo $email; ?>">
                      
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password2" value="<?php echo $password; ?>">
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberme" checked>
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <a href="#" class="link-primary" onclick="forgotPassword();">Forgot Password ?</a>
                            </div>
                            <div class="col-12 col-lg-12 d-grid mt-3">
                                <button class="btn btn-success" onclick="signIn();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-12 d-grid mt-3">
                                <button class="btn btn-secondary" onclick="changeView();">Don't have an account ? Sign Up</button>
                            </div>
                            <div class="col-12 d-grid mt-3 mb-3">
                                <a class="btn btn-light btn btn-outline-secondary" href="adminSignin.php" ;>Are You an Admin ? Sign In <i class="bi bi-person-lines-fill"></i></a>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

            <!-- content -->

            <!-- rp modal -->
            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="npi" />
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword1();"><i id="icon1" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp"/>
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();"><i id="icon2" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vc" />
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetpw();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- rp modal -->

            <div class="col-12 fixed-bottom d-none d-lg-block">
                <p class="text-center">&copy; 2022 trewoTech.lk || All Right Reserved</p>
            </div>
        </div>
    </div>


    <script src="bootstrap.js"></script>
    <script src="script.js"></script>
</body>

</html>