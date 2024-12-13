<?php

namespace classes;

use classes\DbConnector;
use PDO;
use PDOException;

require_once 'DbConnector.php';

class User
{
    private $userId;
    private $username;
    private $password;
    private $role;
    private $token;
    private $expiry;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function setExpiry($expiry)
    {
        $this->expiry = $expiry;
    }

    public function wrongUsername()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT * FROM User WHERE UserName = ?;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->username);
            $pstmt->execute();
            $pstmt->fetch(PDO::FETCH_ASSOC);

            if ($pstmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function wrongPassword()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT User_Id, Password, Role FROM User WHERE UserName = ?;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->username);
            $pstmt->execute();
            $rs = $pstmt->fetch(PDO::FETCH_BOTH);

            $dbPwd = $rs['Password'];
            $this->userId = $rs['User_Id'];

            if (password_verify($this->password, $dbPwd)) {
                $this->role = $rs['Role'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function login()
    {
        $_SESSION['login'] = true;
        $_SESSION['userId'] = $this->userId;
        $_SESSION['username'] = $this->username;
        $_SESSION['role'] = $this->role;
        return true;
    }

    public function update() {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();

        try {
            $query = "UPDATE User SET Cookie_Token = ?, Exp_Date = ? WHERE User_Id = ?;";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->token);
            $pstmt->bindValue(2, $this->expiry);
            $pstmt->bindValue(3, $this->userId);
            $a = $pstmt->execute();

            return ($a > 0);
        } catch (PDOException $e) {
            "Error: " . $e->getMessage();
        }
    }

    public function validateCookie() {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();

        try {
            $query = "SELECT * FROM User WHERE Cookie_Token = ?;";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->token);
            $pstmt->execute();
            $rs = $pstmt->fetch(PDO::FETCH_BOTH);

            if (!empty($rs)) {
                $this->userId = $rs['User_Id'];
                $this->username = $rs['UserName'];
                $this->role = $rs['Role'];
                $db_expiry_date = $rs['Exp_Date'];

                if (($db_expiry_date - time()) > 0) {
                    $this->login();
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
            "Error: " . $e->getMessage();
        }
    }
}
