<?php

namespace classes;

use classes\DbConnector;
use classes\User;
use classes\Passenger;
use PDO;
use PDOException;

require_once 'DbConnector.php';
require_once 'User.php';
require_once 'Passenger.php';

class Admin extends User
{

    public static function getUserCount()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT COUNT(User_Id) FROM User;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $count = $pstmt->fetch(PDO::FETCH_BOTH);
            return $count[0];
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getReviewCount()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT COUNT(Review_Id) FROM Review;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $count = $pstmt->fetch(PDO::FETCH_BOTH);
            return $count[0];
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    public static function getChatBotCount()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT COUNT(Chat_Id) FROM ChatBot;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $count = $pstmt->fetch(PDO::FETCH_BOTH);
            return $count[0];
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getReviews()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT User.User_Id, User.UserName, Review.Review_Id, Review.Rate, Review.Title, Review.Body FROM User INNER JOIN Review ON Review.User_Id = User.User_Id ORDER BY Review.User_Id;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getChatBot()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT * FROM ChatBot;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getPassengers()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT User.User_Id, User.UserName, User_Details.First_Name, User_Details.Last_Name, User_Details.NIC, User_Details.Email, User_Details.Telephone FROM User INNER JOIN User_Details ON User_Details.User_Id = User.User_Id WHERE User.Role = ?;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, "Passenger");
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getOtherUsers()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT * FROM User WHERE Role != ?;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, "Passenger");
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function addUser($username, $pass, $passRepeat, $role, $hashedPwd)
    {
        $signUp = new Passenger(null, null, null, null, null, $username, $pass, $passRepeat);

        if (!($signUp->validateUsername())) {
            header("Location: ../admin/admin_users.php?status=2");
        } else if (!($signUp->invalidUsername())) {
            header("Location: ../admin/admin_users.php?status=3");
        } else if (!($signUp->validatePassword())) {
            header("Location: ../admin/admin_users.php?status=4");
        } else if (!($signUp->passwordMatch())) {
            header("Location: ../admin/admin_users.php?status=5");
        } else {
            $dbcon = new DbConnector;
            $con = $dbcon->connect();
            $query = "INSERT INTO User(UserName, Password, Role) VALUES(?, ?, ?);";

            try {
                $pstmt = $con->prepare($query);
                $pstmt->bindValue(1, $username);
                $pstmt->bindValue(2, $hashedPwd);
                $pstmt->bindValue(3, $role);
                $a = $pstmt->execute();

                if ($a > 0) {
                    header("Location: ../admin/admin_users.php?status=6");
                    exit;
                } else {
                    header("Location: ../admin/admin_users.php?status=7");
                    exit;
                }
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    }

    public static function addChat($question, $reply)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "INSERT INTO ChatBot(Question, Reply) VALUES(?, ?);";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $question);
            $pstmt->bindValue(2, $reply);
            $a = $pstmt->execute();

            if ($a > 0) {
                header("Location: ../admin/admin_chatbot.php?status=1");
                exit;
            } else {
                header("Location: ../admin/admin_chatbot.php?status=2");
                exit;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function deleteChatBot($chatId)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "DELETE FROM ChatBot WHERE Chat_Id = ?;";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $chatId);
            $a = $pstmt->execute();

            if ($a > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
