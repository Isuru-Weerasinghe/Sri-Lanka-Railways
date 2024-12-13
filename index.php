<?php
session_start();

if (isset($_SESSION["login"])) {
	if ($_SESSION['role'] == "Admin") {
		header("Location: admin/admin_dashboard.php");
		exit;
	} else if ($_SESSION['role'] == "Cater Staff") {
		header("Location: admin/cater_staff_dashboard.php");
		exit;
	} else if ($_SESSION['role'] == "Railway Operator") {
		header("Location: admin/railway_operator_dashboard.php");
		exit;
	} else if ($_SESSION['role'] == "Station Staff") {
		header("Location: admin/station_staff_dashboard.php");
		exit;
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
	<title>Home</title>
    <link rel="icon" href="https://icons.veryicon.com/png/o/object/material-design-icons/train-21.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bot-style.css" />
	<link rel="stylesheet" href="assets/css/Contact-Details-icons.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <script src="https://kit.fontawesome.com/79271f9696.js" crossorigin="anonymous"></script>
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
                <span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon">
                    <img src="assets/img/icon.png" class="img-thumbnail">
                </span>
                <span>Sri Lanka Railways</span>
            </a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a id="anchor1" class="nav-link active" data-bss-hover-animate="pulse" href="index.php">Home</a></li>
                    <li class="nav-item"><a id="anchor2" class="nav-link" data-bss-hover-animate="pulse" href="train_schedule.php">Train Schedule</a></li>
                    <li class="nav-item"><a id="anchor3" class="nav-link" data-bss-hover-animate="pulse" href="reservations.php">Reservations</a></li>
                    <li class="nav-item"><a id="anchor3" class="nav-link" data-bss-hover-animate="pulse" href="e-catering-homepage.php" target="_blank">E-Catering</a></li>
                    <li class="nav-item"><a id="anchor5" class="nav-link" data-bss-hover-animate="pulse" href="contact_us.php">Contact Us</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Other
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="notices.php">Notices</a></li>
                            <li><a class="dropdown-item" href="rate_review.php">Rate & Review</a></li>
                            <li><a class="dropdown-item" href="other.php">Station Details</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
<div class="carousel slide carousel-dark" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="false" id="carousel-1">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="w-100 d-block" src="assets/img/gallery-1.jpg" alt="Slide Image" />
		</div>
		<div class="carousel-item">
			<img class="w-100 d-block" src="assets/img/gallery-2.jpg" alt="Slide Image" />
		</div>
		<div class="carousel-item">
			<img class="w-100 d-block" src="assets/img/gallery-3.jpg" alt="Slide Image" />
		</div>
		<div class="carousel-item">
			<img class="w-100 d-block" src="assets/img/gallery-4.jpg" alt="Slide Image" />
		</div>
		<div class="carousel-item">
			<img class="w-100 d-block" src="assets/img/gallery-5.jpg" alt="Slide Image" />
		</div>
		<div class="carousel-item">
			<img class="w-100 d-block" src="assets/img/gallery-6.jpg" alt="Slide Image" />
		</div>
	</div>
	<div>
		<a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span><span class="visually-hidden">Previous</span></a>
		<a class="carousel-control-next" href="#carousel-1" role="button" data-bs-slide="next"><span class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a>
	</div>
	<ol class="carousel-indicators">
		<li data-bs-target="#carousel-1" data-bs-slide-to="0" class="active"></li>
		<li data-bs-target="#carousel-1" data-bs-slide-to="1"></li>
		<li data-bs-target="#carousel-1" data-bs-slide-to="2"></li>
		<li data-bs-target="#carousel-1" data-bs-slide-to="3"></li>
		<li data-bs-target="#carousel-1" data-bs-slide-to="4"></li>
		<li data-bs-target="#carousel-1" data-bs-slide-to="5"></li>
	</ol>
</div>
<div class="container py-4 py-xl-5">
	<div class="row mb-5">
		<div class="col-md-8 col-xl-6 text-center mx-auto">
			<h2>About Us</h2>
			<p>
				Sri Lanka Railway is the national railway network of Sri Lanka, which operates passenger and freight train services across the country. The railway system covers major cities and towns in Sri Lanka, with over 1,500
				kilometers of tracks, and is operated by the Sri Lanka Railways Department, which is under the Ministry of Transport. The railway system has a rich history, dating back to the 19th century when it was first introduced by
				the British colonial government, and today it serves as an affordable and convenient mode of transportation for Sri Lankan citizens and tourists alike. Some of the popular train routes in Sri Lanka include the
				Colombo-Badulla line, the Colombo-Galle line, and the Colombo-Kandy line, which offer stunning views of the country's natural landscapes and cultural landmarks.
			</p>
		</div>
	</div>
	<hr>
	<div class="container py-4 py-xl-5">
		<div class="row mb-5">
			<div class="col-md-8 col-xl-6 text-center mx-auto">
				<h2>Services We Provide</h2>
				<p class="w-lg-50">Sri Lanka Railways offers variety of services. Find what you need at the moment.</p>
			</div>
		</div>
		<div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
			<div class="col">
				<a type="button" class="btn" data-bss-hover-animate="pulse" href="train_schedule.php">
					<div class="text-center d-flex flex-column align-items-center align-items-xl-center">
						<div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="fas fa-table"></i></div>
						<div class="px-3">
							<h4>View Train Timetable</h4>
							<p>Find the correct trains through the train timetable service.</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col">
				<a type="button" class="btn" data-bss-hover-animate="pulse" href="reservations.php">
					<div class="text-center d-flex flex-column align-items-center align-items-xl-center">
						<div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="far fa-registered"></i></div>
						<div class="px-3">
							<h4>Reserve Tickets</h4>
							<p>Reserve tickets easily through the ticket reservation service.</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col">
				<a type="button" class="btn" data-bss-hover-animate="pulse" href="e-catering-homepage.php" target="_blank">
					<div class="text-center d-flex flex-column align-items-center align-items-xl-center">
						<div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="fas fa-hamburger"></i></div>
						<div class="px-3">
							<h4>Order Foods</h4>
							<p>Order desired food & beverages through E-Catering service.</p>
						</div>
					</div>
				</a>
			</div>
		</div>
		<br><br>
		<div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
			<div class="col">
				<a type="button" class="btn" data-bss-hover-animate="pulse" href="rate_review.php">
					<div class="text-center d-flex flex-column align-items-center align-items-xl-center">
						<div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="fas fa-star"></i></div>
						<div class="px-3">
							<h4>Rate & Review</h4>
							<p>Rate & review the services offered by the system.</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col">
				<a type="button" class="btn" data-bss-hover-animate="pulse" href="#footer">
					<div class="text-center d-flex flex-column align-items-center align-items-xl-center">
						<div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="fas fa-comments"></i></div>
						<div class="px-3">
							<h4>Customer Support</h4>
							<p>customer service & support through the chatbot.</p>
						</div>
					</div>
				</a>
			</div>
			<div class="col">
				<a type="button" class="btn" data-bss-hover-animate="pulse" href="notices.php">
					<div class="text-center d-flex flex-column align-items-center align-items-xl-center">
						<div class="bs-icon-lg bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-3 bs-icon lg"><i class="fas fa-bell"></i></div>
						<div class="px-3">
							<h4>Stay Updated</h4>
							<p>Get Accurate Real-time updates regarding train delays.</p>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<button type="button" class="border rounded d-inline scroll-to-top d-none d-md-block" id="chatbot-button"><i class="fas fa-comments"></i></button>

<div id="chatbot-container" class="container">
	<div class="wrapper">
		<div class="title">Sri Lankan Railways ChatBot</div>
		<div class="form">
			<div class="bot-inbox inbox">
				<div class="icon">
					<i class="fa fa-train"></i>
				</div>
				<div class="msg-header">
					<p>Dear passenger, how can I help you?</p>
				</div>
			</div>
		</div>
		<div class="typing-field">
			<div class="input-data">
				<input id="data" type="text" placeholder="Type something here.." required>
				<button id="send-btn">Send</button>
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><script>
	var button = document.getElementById("chatbot-button");
	var chatbotContainer = document.getElementById("chatbot-container");
	var send = document.getElementById("send-btn");
	var isOpen = false;

	button.addEventListener("click", function() {
		if (isOpen) {
			chatbotContainer.style.display = "none";
		} else {
			chatbotContainer.style.display = "block";
		}
		isOpen = !isOpen;
	});

	$(document).ready(function() {
		$("#send-btn").on("click", function() {
			$value = $("#data").val();
			$msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + $value + '</p></div></div>';
			$(".form").append($msg);
			$("#data").val('');

			// start ajax code
			$.ajax({
				url: 'includes/chatbot.inc.php',
				type: 'POST',
				data: 'text=' + $value,
				success: function(result) {
					$reply = '<div class="bot-inbox inbox"><div class="icon"><i class="fa fa-train"></i></div><div class="msg-header"><p>' + result + '</p></div></div>';
					$(".form").append($reply);
					// when chat goes down the scroll bar automatically comes to the bottom
					$(".form").scrollTop($(".form")[0].scrollHeight);
				}
			});
		});
	});
</script>

<?php include_once "footer.php";
?>
