<?php
require('pages/functions/index_functions.php');
require('pages/header.php');
require('pages/css/index_css.php');
?>

<div class="container">
    <div class="row">
        <div class="d-flex align-items-center justify-content-center">
            <div class="card shadow">
                <div class="card-body">
                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <img src="Assets/images/Login/user.png" alt="usr_logo" srcset="" class="logo1">
                        <h1 class="head">

                            <style>
                                .hr-text {
                                    display: flex;
                                    align-items: center;
                                    text-align: center;
                                }

                                .hr-text::before,
                                .hr-text::after {
                                    content: '';
                                    flex: 1;
                                    border-bottom: 2px solid #000;
                                }

                                .hr-text::before {
                                    margin-right: 0.5em;
                                }

                                .hr-text::after {
                                    margin-left: 0.5em;
                                }
                            </style>
                            <link rel="preconnect" href="https://fonts.googleapis.com">
                            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                            <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

                            <div class="s1 hr-text mt-3" style="margin-top:12px">
                                <span style="background-color: white;color:black; padding: 0 10px;font-weight:900;  font-weight: bold;font-size:x-large; margin-top:5px;    font-family: 'Poppins', sans-serif;" class="social mt-3">
                                    Administrative Login
                                </span>
                            </div>
                        </h1>
                        <div>
                            <label for="exampleInputEmail1" class="form-label mt-4"> Username</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" value="<?php echo isset($_COOKIE['remembered_email']) ? htmlspecialchars($_COOKIE['remembered_email']) : ''; ?>">
                            <div id="emailHelp" class="form-text">Hint - Username email address</div>
                            <div class="invalid-feedback" id="username-error"></div>
                        </div>
                        <div>
                            <label for="exampleInputPassword1" class="form-label mt-2">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                            <div class="invalid-feedback" id="password-error"></div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div>
                        <!-- <div class="forget">
                            <a href="forget_password.php" style="text-decoration: none;">Forget Password</a>
                        </div> -->
                        <button type="submit" class="btn btn-primary shadow mt-3">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

// if (isset($_COOKIE['remembered_email'])) {
//     $rememberedEmail = $_COOKIE['remembered_email'];
//     echo "Remembered email: " . $rememberedEmail;
// } else {
//     echo "Remembered email not found.";
// }
require('pages/js/index_js.php');
require('pages/footer.php');
?>