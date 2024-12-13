<?php
session_start();

use classes\Admin;

require_once '../classes/User.php';
require_once '../classes/Admin.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['adminAddUser'])) {
        if (!empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['passRepeat']) && isset($_POST['role'])) {
            $username = $_POST['username'];
            $pass = $_POST['pass'];
            $passRepeat = $_POST['passRepeat'];
            $role = $_POST['role'];
            $hashedPwd = password_hash($pass, PASSWORD_BCRYPT);

            Admin::addUser($username, $pass, $passRepeat, $role, $hashedPwd);
        } else {
            header("Location: ../admin/admin_users.php?status=1");
            exit;
        }
    } else if (isset($_POST['adminAddChat'])) {
        if (!empty($_POST['question']) && !empty($_POST['reply'])) {
            $question = $_POST['question'];
            $reply = $_POST['reply'];

            Admin::addChat($question, $reply);
        } else {
            header("Location: ../admin/admin_users.php?status=1");
            exit;
        }
    } else {
        header("Location: ../admin/admin_dashboard.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['action']) && isset($_GET['target']) && isset($_GET['id'])) {
        if ($_GET['action'] == "delete" && $_GET['target'] == "chatbot") {
            $chatId = $_GET['id'];

            if (Admin::deleteChatBot($chatId)) {
                header("Location: ../admin/admin_chatbot.php?status=3");
                exit;
            } else {
                header("Location: ../admin/admin_chatbot.php?status=4");
                exit;
            }
        }
    } else {
        header("Location: ../admin/admin_dashboard.php");
        exit;
    }
} else {
    header("Location: ../admin/admin_dashboard.php");
    exit;
}
