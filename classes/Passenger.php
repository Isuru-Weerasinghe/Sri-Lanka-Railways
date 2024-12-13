<?php
namespace classes;

use classes\DbConnector;
use classes\User;
use PDO;
use PDOException;

require_once 'DbConnector.php';
require_once 'User.php';

class Passenger extends User
{
    private $userId;
    private $firstName;
    private $lastName;
    private $nic;
    private $telephone;
    private $email;
    private $username;
    private $password;
    private $passwordRepeat;
    private $recQuestion;
    private $recAnswer;
    public function __construct($firstName, $lastName, $nic, $telephone, $email, $username, $password, $passwordRepeat)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->nic = $nic;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    public function validateNic()
    {
        if (preg_match('/^(?:\d{12}|\d{9}[vV])$/', $this->nic)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateTelephone()
    {
        if (preg_match('/^0\d{9}$/', $this->telephone)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateEmail()
    {
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateUsername()
    {
        if (preg_match('/^[a-z]{1,15}$/', $this->username)) {
            return true;
        } else {
            return false;
        }
    }

    public function invalidUsername()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT * FROM User WHERE UserName = ?;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->username);
            $pstmt->execute();
            $rs = $pstmt->fetch(PDO::FETCH_ASSOC);

            if ($pstmt->rowCount() > 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function validatePassword()
    {
        if (preg_match('/(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{8,24}/', $this->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function passwordMatch()
    {
        if ($this->password !== $this->passwordRepeat) {
            return false;
        } else {
            return true;
        }
    }

    public function signUp($hashedPwd)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query1 = "INSERT INTO User(UserName, Password, Role) VALUES(?, ?, ?);";
        $query2 = "SELECT User_Id FROM User WHERE UserName = ?;";
        try {
            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $this->username);
            $pstmt1->bindValue(2, $hashedPwd);
            $pstmt1->bindValue(3, "Passenger");
            $a1 = $pstmt1->execute();

            $pstmt2 = $con->prepare($query2);
            $pstmt2->bindValue(1, $this->username);
            $pstmt2->execute();
            $rs = $pstmt2->fetch(PDO::FETCH_BOTH);
            $this->userId = $rs['User_Id'];

            $query3 = "INSERT INTO User_Details(User_Id, First_Name, Last_Name, NIC, Email, Telephone) VALUES(?, ?, ?, ?, ?, ?);";
            $pstmt3 = $con->prepare($query3);
            $pstmt3->bindValue(1, $this->userId);
            $pstmt3->bindValue(2, $this->firstName);
            $pstmt3->bindValue(3, $this->lastName);
            $pstmt3->bindValue(4, $this->nic);
            $pstmt3->bindValue(5, $this->email);
            $pstmt3->bindValue(6, $this->telephone);
            $a2 = $pstmt3->execute();

            if ($a1 > 0 && $a2 > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function forgotPasswordEmptyInput($username)
    {
        if (empty($username)) {
            return false;
        } else {
            return true;
        }
    }

    public static function forgotPasswordFindUser($username)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT * FROM User_Details WHERE User_Id IN(SELECT User_Id FROM User WHERE Username = ?);";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $username);
            $pstmt->execute();
            $pstmt->fetch(PDO::FETCH_BOTH);

            if ($pstmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function generateOtp($otp, $expiry)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "UPDATE User SET OTP = ?, Expiry = ? WHERE User_Id IN(SELECT User_Id FROM User WHERE Username = ?);";
        $a = 0;
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $otp);
            $pstmt->bindValue(2, $expiry);
            $pstmt->bindValue(3, $_SESSION['username']);
            $a = $pstmt->execute();

            return $a > 0;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function deleteOtp()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "UPDATE User SET OTP = ?, Expiry = ? WHERE User_Id IN(SELECT User_Id FROM User WHERE Username = ?);";
        $a = 0;
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, null);
            $pstmt->bindValue(2, null);
            $pstmt->bindValue(3, $_SESSION['username']);
            $a = $pstmt->execute();

            return $a > 0;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function forgotPasswordGetRecDetails()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT OTP, Expiry FROM User WHERE User_Id IN(SELECT User_Id FROM User WHERE Username = ?);";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $_SESSION['username']);
            $pstmt->execute();
            $rs = $pstmt->fetch(PDO::FETCH_BOTH);

            if ($pstmt->rowCount() > 0) {
                if ($rs['Expiry'] - time() > 0) {
                    //Passenger::deleteOtp();
                    return $rs['OTP'];
                } else {
                    $rs['OTP'] = null;
                    $rs['Expiry'] = null;
                    return $rs['OTP'];
                }
            } else {
                $rs['OTP'] = null;
                return $rs;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function forgotPasswordValidatePassword($newPass)
    {
        if (preg_match('/(?=.*\d)(?=.*[A-Z])(?=.*[a-z]).{8,24}/', $newPass)) {
            return true;
        } else {
            return false;
        }
    }

    public static function updatePassword($hashedPwd)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "UPDATE User SET Password = ? WHERE Username = ?;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $hashedPwd);
            $pstmt->bindValue(2, $_SESSION['username']);
            $a = $pstmt->execute();

            if ($a > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getScheduleId()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT DISTINCT Schedule_Id FROM Schedule ORDER BY Schedule_Id";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function viewReservation()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $userId = $_SESSION['userId'];
        $query = "SELECT * FROM Reservation WHERE User_Id = ? ORDER BY Res_Date";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $userId);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function calculatePrice($class, $qty)
    {
        $price = 0;
        if ($class == 1) {
            $price = $qty * 3000;
        } else if ($class == 2) {
            $price = $qty * 2000;
        } else if ($class == 3) {
            $price = $qty * 1000;
        }
        return $price;
    }

    public static function checkSeatAvailability()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query1 = "SELECT SUM(Quantity) AS Quantity FROM Reservation WHERE Class = ? AND Schedule_Id = ? AND Res_Date = ?;";

        if ($_SESSION['class'] == 1) {
            $query2 = "SELECT T.Seats_1 FROM Train T JOIN Schedule S ON T.Train_Id = S.Train_Id WHERE S.Schedule_Id = ?;";
        } else if ($_SESSION['class'] == 2) {
            $query2 = "SELECT T.Seats_2 FROM Train T JOIN Schedule S ON T.Train_Id = S.Train_Id WHERE S.Schedule_Id = ?;";
        }
        if ($_SESSION['class'] == 3) {
            $query2 = "SELECT T.Seats_3 FROM Train T JOIN Schedule S ON T.Train_Id = S.Train_Id WHERE S.Schedule_Id = ?;";
        }
        try {
            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $_SESSION['class']);
            $pstmt1->bindValue(2, $_SESSION['schId']);
            $pstmt1->bindValue(3, $_SESSION['date']);
            $pstmt1->execute();
            $rs1 = $pstmt1->fetch(PDO::FETCH_BOTH);

            $pstmt2 = $con->prepare($query2);
            $pstmt2->bindValue(1, $_SESSION['schId']);
            $pstmt2->execute();
            $rs2 = $pstmt2->fetch(PDO::FETCH_BOTH);

            return (($rs2[0] - ($rs1[0] + $_SESSION['qty'])) >= 0);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function placeReservation($schId, $class, $date, $qty, $ticket_id)
    {
        $userId = $_SESSION['userId'];
        $expDate = date("Y-m-d", strtotime("1 day", strtotime($date)));

        if ($class == 1) {
            $price = $qty * 3000;
        } else if ($class == 2) {
            $price = $qty * 2000;
        } else if ($class == 3) {
            $price = $qty * 1000;
        }

        try {
            $dbcon = new DbConnector;
            $con = $dbcon->connect();
            $query = "INSERT INTO Reservation(User_Id, Schedule_Id, Class, Quantity, Price, Res_Date, Exp_Date, Ticket_Id) VALUES(?, ?, ?, ?, ?, ?, ?, ?);";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $userId);
            $pstmt->bindValue(2, $schId);
            $pstmt->bindValue(3, $class);
            $pstmt->bindValue(4, $qty);
            $pstmt->bindValue(5, $price);
            $pstmt->bindValue(6, $date);
            $pstmt->bindValue(7, $expDate);
            $pstmt->bindValue(8, $ticket_id);
            $a = $pstmt->execute();

            if ($a > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function verifyTicket($ticket_id)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT Ticket_Id, Res_date FROM Reservation WHERE Ticket_Id = ?;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $ticket_id);
            $pstmt->execute();
            $rs = $pstmt->fetch(PDO::FETCH_BOTH);
            if (!empty($rs)) {
                if ((strtotime($rs['Res_date']) >= strtotime(date("Y-m-d")))) {
                    if ($ticket_id == $rs['Ticket_Id']) {
                        return 4;
                    } else {
                        return 3;
                    }
                } else {
                    return 2;
                }
            } else {
                return 1;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getStation()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT DISTINCT Station_Name FROM Station ORDER BY Station_Name;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_BOTH);
            return $rs;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getSchedule()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT DISTINCT Schedule_Id FROM Schedule ORDER BY Schedule_Id;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function viewNotice()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT * FROM Notice ORDER BY Notice_Id;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}