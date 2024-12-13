<?php
session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['role'])) {
    header("Location: ../index.php");
} else if (isset($_SESSION['role']) && $_SESSION['role'] != "Admin") {
    header("Location: ../index.php");
}

use classes\Admin;

require_once '../classes/User.php';
require_once '../classes/Admin.php';

$rs = Admin::getChatBot();
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$results_per_page = 10;
if (count($rs) < 10) {
    $results_per_page = count($rs);
}
if (count($rs) == 0) {
    $results_per_page = 1;
}
$page_first_result = ($page - 1) * $results_per_page;
$number_of_result = count($rs);
$number_of_page = ceil($number_of_result / $results_per_page);
if($page == $number_of_page){
    $results_per_page = count($rs) - $page_first_result;
}
if (isset($_GET['page'])) {
    if ($_GET['page'] < 1) {
        header('Location: admin_chatbot.php?page=1');
    } else if ($_GET['page'] > $number_of_page) {
        header('Location: admin_chatbot.php?page=' . $number_of_page);
    }
}

if(isset($_GET['status'])){
    if($_GET['status'] == 1){
        echo '<script>alert("Chat added successfully!");</script>';
    } else if($_GET['status'] == 2){
        echo '<script>alert("An error occurred!");</script>';
    } else if($_GET['status'] == 3){
        echo '<script>alert("Chat deleted successfully!");</script>';
    } else if($_GET['status'] == 4){
        echo '<script>alert("An error occurred!");</script>';
    } 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Administrator</title>
    <link rel="icon" href="https://icons.veryicon.com/png/o/object/material-design-icons/train-21.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
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
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark bg-dark accordion p-0" style="padding-bottom: 0px;">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="admin_dashboard.php">
                    <div class="sidebar-brand-text mx-3"><span>Admin Panel</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="admin_dashboard.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="admin_users.php"><i class="fas fa-user"></i><span>Users</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="admin_reviews.php"><i class="fas fa-comment"></i><span>Reviews</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="#"><i class="fa-solid fa-robot"></i><span>ChatBot</span></a></li>
                </ul>
                <a class="btn btn-primary btn-md" role="button" data-bss-hover-animate="pulse" href="../includes/logout.inc.php">Log Out</a>
                <hr class="sidebar-divider my-2">
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>
        <!-- Modal -->
            <form action="../includes/admin.inc.php" method="POST">
                <div class="modal fade" id="addNewChat" tabindex="-1" aria-labelledby="addNewChatLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title h3" id="addNewChatLabel">Add Chat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div id="modal-body" class="modal-body bg-dark text-light">
                                    <div class="form-outline form-white h5">
                                        <label class="form-label h5" for="question">Question</label>
                                        <br />
                                        <input type="text" class="form-control" id="question" name="question" required />
                                        <br />
                                        <label class="form-label h5" for="reply">Reply</label>
                                        <br />
                                        <input type="text" class="form-control" id="reply" name="reply" required />
                                        <br />
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-dark text-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="adminAddChat">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand-md bg-white shadow mb-4 py-3 static-top">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h4>Hello Admin!</h4>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">ChatBot Details</h3>
                    <!-- Button trigger modal -->
                <button class="btn btn-primary btn-md" type="submit" data-bs-toggle="modal" data-bs-target="#addNewChat" style="float: right;">Add New Chat</button>
                <br></br>
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th><b>#</b></th>
                                                <th>Question</th>
                                                <th>Reply</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($rs) > 0) {
                                                for ($i = $page_first_result; $i < $page_first_result + $results_per_page; $i++) {
                                                    $row = $rs[$i];
                                            ?>
                                                    <tr>
                                                        <td><b><?php echo $i + 1; ?></b></td>
                                                        <td><?php echo $row['Question']; ?></td>
                                                        <td><?php echo $row['Reply']; ?></td>
                                                        <td><a type="button" class="btn btn-danger" href="../includes/admin.inc.php?action=delete&target=chatbot&id=<?php echo $row['Chat_Id'];?>" name="delete">Delete</a></td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="4">No data found</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing <?php echo $page_first_result + 1; ?> to <?php echo $page_first_result + $results_per_page; ?> of <?php echo count($rs); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" aria-label="Previous" href="admin_chatbot.php?page=<?php echo $page - 1; ?>">
                                                    <span aria-hidden="true">«</span>
                                                </a>
                                            </li>
                                            <?php
                                            for ($i = 1; $i <= $number_of_page; $i++) {
                                                if ($i == $page) {
                                            ?>
                                                    <li class="page-item">
                                                        <a class="page-link active" href="admin_chatbot.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                    </li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="admin_chatbot.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                    </li>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <li class="page-item">
                                                <a class="page-link" aria-label="Next" href="admin_chatbot.php?page=<?php echo $page + 1; ?>">
                                                    <span aria-hidden="true">»</span>
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
            <footer class="bg-white sticky-footer">
                <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Sri Lanka Railways 2023</span></div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/theme.js"></script>
</body>

</html>