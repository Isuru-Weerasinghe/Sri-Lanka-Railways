<?php
session_start();

if (isset($_SESSION["login"])) {
    if ($_SESSION["login"] = true) {
        echo '<script>alert("Please log out before proceed!");window.location="index.php";</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Sign Up</title>
    <link rel="icon" href="https://icons.veryicon.com/png/o/object/material-design-icons/train-21.png"
        type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Details-icons.css">
    <link rel="stylesheet" href="assets/css/login-signup.css" />
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">
        var onloadCallback = function () {
            grecaptcha.enterprise.render('recaptcha', {
                'sitekey': '6LeWIgUpAAAAAJOw9CCC29ZYoZ7YrsvqJ-57k7s1',
            });
        };
    </script>
    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .modal-body::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .modal-body,
        body {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .scroll-to-top {
            position: fixed;
            right: 1rem;
            bottom: 1rem;
            display: none;
            width: 2.75rem;
            height: 2.75rem;
            text-align: center;
            color: #fff;
            background: rgba(90, 92, 105, .5);
            line-height: 46px
        }

        .scroll-to-top:focus,
        .scroll-to-top:hover {
            color: #fff
        }

        .scroll-to-top:hover {
            background: #5a5c69
        }

        .scroll-to-top i {
            font-weight: 800
        }
    </style>
</head>

<body id="page-top">
    <nav class="navbar navbar-dark navbar-expand-md bg-dark py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <span
                    class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon">
                    <img src="assets/img/icon.png" class="img-thumbnail">
                </span>
                <span>Sri Lanka Railways</span>
            </a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a id="anchor1" class="nav-link" data-bss-hover-animate="pulse"
                            href="index.php">Home</a></li>
                    <li class="nav-item"><a id="anchor2" class="nav-link" data-bss-hover-animate="pulse"
                            href="train_schedule.php">Train Schedule</a></li>
                    <li class="nav-item"><a id="anchor3" class="nav-link" data-bss-hover-animate="pulse"
                            href="reservations.php">Reservations</a></li>
                    <li class="nav-item"><a id="anchor3" class="nav-link" data-bss-hover-animate="pulse"
                            href="e-catering-homepage.php" target="_blank">E-Catering</a></li>
                    <li class="nav-item"><a id="anchor5" class="nav-link" data-bss-hover-animate="pulse"
                            href="contact_us.php">Contact Us</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Other
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="notices.php">Notices</a></li>
                            <li><a class="dropdown-item" href="rate_review.php">Rate & Review</a></li>
                            <li><a class="dropdown-item" href="other.php">Station Details</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="overview.php">Overview</a></li>
                            <li><a class="dropdown-item" href="history.php">History</a></li>
                            <li><a class="dropdown-item" href="our_network.php">Our Network</a></li>
                        </ul>
                    </li>
                    <?php if (isset($_SESSION["login"])) {
                        if (isset($_SESSION["login"]) == true) {
                            echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="includes/logout.inc.php">Log Out</a>';
                        } else {
                            echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="login.php">Log in</a>';
                        }
                    } else {
                        echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="login.php">Log in</a>';
                    } ?>
                </ul>
            </div>
        </div>
    </nav>
    <section class="vh-200 gradient-custom">
        <form action="includes/signup.inc.php" method="POST">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <span class="text-danger">
                                    <!--error handling-->
                                    <?php if (isset($_GET["status"])) {
                                        if ($_GET["status"] == 1) {
                                            echo "Please fill all fields!";
                                        } elseif ($_GET["status"] == 2) {
                                            echo "Please enter a valid NIC!";
                                        } elseif ($_GET["status"] == 3) {
                                            echo "Please enter a valid contact number!";
                                        } elseif ($_GET["status"] == 4) {
                                            echo "Please enter a valid email!";
                                        } elseif ($_GET["status"] == 5) {
                                            echo "Please enter a valid username!";
                                        } elseif ($_GET["status"] == 6) {
                                            echo "Username has already taken!";
                                        } elseif ($_GET["status"] == 7) {
                                            echo "Please enter a valid password!";
                                        } elseif ($_GET["status"] == 8) {
                                            echo "Passwords does not match!";
                                        } elseif ($_GET["status"] == 9) {
                                            echo '<script>alert("Registration successfull. Please sign in!");window.location="login.php";</script>';
                                        }
                                    } ?>
                                </span>
                                <div class="mb-md-0 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                                    <p class="text-white-50 mb-5">Please enter below details!</p>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-outline">
                                                <input type="text" id="fname" class="form-control form-control-lg"
                                                    name="fname" required>
                                                <label class="form-label" for="fname">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-outline">
                                                <input type="text" id="lname" class="form-control form-control-lg"
                                                    name="lname" required>
                                                <label class="form-label" for="lname">Last Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="nic" class="form-control form-control-lg" id="nic"
                                            name="nic" required>
                                        <label class="form-label" for="nic">NIC Number</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="tel" id="tele" class="form-control form-control-lg" id="tele"
                                            name="tele" required>
                                        <label class="form-label" for="tele">Contact Number</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" id="email" class="form-control form-control-lg" id="email"
                                            name="email" required>
                                        <label class="form-label" for="email">Email</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="userName" class="form-control" id="userName"
                                            name="userName" required>
                                        <label class="form-label" for="userName">Username</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="pwd" class="form-control form-control-lg" id="pwd"
                                            name="pwd" required>
                                        <label class="form-label" for="pwd">Password</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" id="pwdRepeat" class="form-control form-control-lg"
                                            id="pwdRepeat" name="pwdRepeat" required>
                                        <label class="form-label" for="pwdRepeat">Repeat Password</label>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="g-recaptcha mb-3" id="recaptcha"></div>
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit"
                                        name="submit_signup">Sign Up</button>
                                </div>
                                <div>
                                    <p class="mb-0">Already have an account? <a href="login.php"
                                            class="text-white-50 fw-bold">Log in</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script src="https://www.google.com/recaptcha/enterprise.js?onload=onloadCallback&render=explicit" async
        defer></script>
    <script type="text/javascript">
        // Function to validate the NIC number using regex
        function validateNic(nic) {
            const nicRegex = /^(?:\d{12}|\d{9}[vV])$/;
            return nicRegex.test(nic);
        }
        // Function to validate the phone number using regex
        function validatePhone(phone) {
            const phoneRegex = /^0\d{9}$/;
            return phoneRegex.test(phone);
        }
        // Function to validate the email address using regex
        function validateEmail(email) {
            const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
            return emailRegex.test(email);
        }
        // Function to validate the username using regex
        function validateUsername(username) {
            const usernameRegex = /^[a-z]{1,15}$/;
            return usernameRegex.test(username);
        }
        // Function to validate the password using regex
        function validatePassword(pwd) {
            const pwdRegex = /(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{8,24}/;
            return pwdRegex.test(pwd);
        }
        // Function to validate the password and repeat password fields
        function validatePasswordsMatch(pwd, pwdRepeat) {
            return pwd === pwdRepeat;
        }
        // Function to handle form submission
        function validateForm(event) {
            const nic = document.getElementById("nic").value;
            const tele = document.getElementById("tele").value;
            const email = document.getElementById("email").value;
            const username = document.getElementById("userName").value;
            const pwd = document.getElementById("pwd").value;
            const pwdRepeat = document.getElementById("pwdRepeat").value;
            // Perform validation checks
            const isNicValid = validateNic(nic);
            const isPhoneValid = validatePhone(tele);
            const isEmailValid = validateEmail(email);
            const isUsernameValid = validateUsername(username);
            const isPasswordValid = validatePassword(pwd);
            const arePasswordsMatch = validatePasswordsMatch(pwd, pwdRepeat);
            var response = grecaptcha.enterprise.getResponse();

            if (!isNicValid) {
                alert("Invalid NIC format");
                event.preventDefault(); // Prevent form submission
            } else if (!isPhoneValid) {
                alert("Invalid contact number format");
                event.preventDefault(); // Prevent form submission
            } else if (!isEmailValid) {
                alert("Invalid email");
                event.preventDefault(); // Prevent form submission
            } else if (!isUsernameValid) {
                alert("Username should contain 5 or more characters and can not contain uppercase letters");
                event.preventDefault(); // Prevent form submission
            } else if (!isPasswordValid) {
                alert("Password should contain 8 or more characters with at least 1 uppercase and 1 symbol");
                event.preventDefault(); // Prevent form submission
            } else if (!arePasswordsMatch) {
                alert("Password and Repeat Password fields does not match");
                event.preventDefault(); // Prevent form submission
            } else if (response.length === 0) {
                alert("Please complete the reCAPTCHA.");
                event.preventDefault(); // Prevent form submission
            }
            // Form will be submitted if all validations pass
        }
        // Attach the validateForm function to the form's submit event
        const form = document.querySelector("form");
        form.addEventListener("submit", validateForm);
    </script>

    <?php include_once "footer.php";
    ?>