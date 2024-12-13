<?php

namespace classes;

use classes\DbConnector;
use classes\User;
use PDO;
use PDOException;

require_once 'DbConnector.php';
require_once 'User.php';

class CaterStaff extends User
{

    public static function getOrderCount()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT COUNT(Food_Order_Id) FROM Food_Order;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $count = $pstmt->fetch(PDO::FETCH_BOTH);
            return $count[0];
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getFoodCount()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT COUNT(Food_Id) FROM Food;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $count = $pstmt->fetch(PDO::FETCH_BOTH);
            return $count[0];
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getFoodOrders()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT Food_Order.Food_Order_Id, Food_Order.User_Id, Food_Order.Total_Price, Food_Order.Status, User_Details.Email, Food_Order.Quantity FROM User_Details INNER JOIN Food_Order ON Food_Order.User_Id = User_Details.User_Id";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getFood()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT * FROM Food;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function addFood($food, $price, $filename)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "INSERT INTO Food(Food_Name, Price, Image) VALUES(?, ?, ?);";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $food);
            $pstmt->bindValue(2, $price);
            $pstmt->bindValue(3, $filename);
            $a = $pstmt->execute();

            if ($a > 0) {
                header("Location: ../admin/cater_staff_foods.php?status=4");
                exit;
            } else {
                header("Location: ../admin/cater_staff_foods.php?status=5");
                exit;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function deleteFoodOrder($foodOrderId)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "DELETE FROM Food_Order WHERE Food_Order_Id = ?;";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $foodOrderId);
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

    public static function prepareFoodOrder($foodOrderId)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "UPDATE Food_Order SET Status = ? WHERE Food_Order_Id = ?;";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, "Prepared");
            $pstmt->bindValue(2, $foodOrderId);
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

    public static function successFoodOrder($foodOrderId)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "UPDATE Food_Order SET Status = ? WHERE Food_Order_Id = ?;";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, "Collected");
            $pstmt->bindValue(2, $foodOrderId);
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

    public static function deleteFood($foodId)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "DELETE FROM Food WHERE Food_Id = ?;";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $foodId);
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

    public static function getSum()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT SUM(Total_Price) FROM Food_Order;";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetch(PDO::FETCH_ASSOC);
            if($rs[0] == null){
                return 0;
            } else{
                return $rs[0];
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}