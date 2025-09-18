<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eshop</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <link rel="icon" href="resource/logo.svg" />
</head>

<body class="main-body">
    <div class="container-fluid d-flex justify-content-center vh-100">
        <div class="row align-content-center">

            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01">Hi, Welcome to Eshop</p>
                    </div>
                </div>
            </div>

            <!-- content -->
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background"></div>

                    <!-- signup -->
                    <div class="col-12 col-lg-6" id="signUpBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Create new Account</p>
                            </div>
                            <div class="col-12 d-none" id="msgdiv">
                                <div class="alert alert-danger" role="alert" id="msg"></div>
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">First Name</label>
                                <input type="text" class="form-control" placeholder="ex:- john" id="fname">
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="ex:- Deo" id="lname">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="ex:- john@gmail.com" id="email">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="ex:- ***********" id="password">
                            </div>
                            <div class="col-6">
                                <label for="" class="form-label">Mobile</label>
                                <input type="text" class="form-control" placeholder="ex:- 0701234567" id="mobile">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select id="gender" class="form-control">
                                    <?php
                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $num = $rs->num_rows;

                                    for ($x = 0; $x < $num; $x++) {
                                        $data = $rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $data["gender_id"]; ?>">
                                            <?php echo $data["gender_name"]; ?> </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="SignUp();">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-dark" onclick="chengeView();">Already have an account? Sign In</button>
                            </div>
                        </div>
                    </div>
                    <!-- SignIn -->
                    <div class="col-12 col-lg-6 d-none" id="SignInBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title02">Sign In</p>
                            </div>

                            <?php
                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email2"])) {
                                $email = $_COOKIE["email2"];
                            }
                            if (isset($_COOKIE["password2"])) {
                                $password = $_COOKIE["password2"];
                            }
                            ?>
                            <div class="col-12 d-none" id="msgdiv2">
                                <div class="alert alert-danger" role="alert" id="msg2"></div>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="ex:- john@gmail.com" id="email2" value="<?php echo $email; ?>">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="ex:- ***********" id="password2" value="<?php echo $password; ?>">
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" onclick="forgotPassword();">Forget Password?</a>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="SignIn();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="chengeView();">New to Eshop? Sign Up</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="Fpassword">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np">
                                        <button class="btn btn-outline-secondary" id="npb" type="button" onclick="ShowPassword1();">Show</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Re-Type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp">
                                        <button class="btn btn-outline-secondary" id="rnpb" type="button" onclick="ShowPassword2();">Show</button>
                                    </div>
                                </div>

                                <div>
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vcode">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="ResetPassword();">Reset</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 fixed-bottom d-lg-block text-center">
                <p>&copy; 2025 eShop.lk || All Rights Reserved</p>
            </div>
        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>