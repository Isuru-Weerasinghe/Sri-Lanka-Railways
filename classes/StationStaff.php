<?php

namespace classes;

use classes\DbConnector;
use classes\User;
use PDO;
use PDOException;

require_once 'DbConnector.php';
require_once 'User.php';

class StationStaff extends User
{

    public static function getReservationCount()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT COUNT(Reservation_Id) FROM Reservation;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $count = $pstmt->fetch(PDO::FETCH_BOTH);
            return $count[0];
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getStationCount()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT COUNT(Station_Id) FROM Station;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $count = $pstmt->fetch(PDO::FETCH_BOTH);
            return $count[0];
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getNoticeCount()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT COUNT(Notice_Id) FROM Notice;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $count = $pstmt->fetch(PDO::FETCH_BOTH);
            return $count[0];
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getReservation()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT * FROM Reservation;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getStation()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT * FROM Station;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getNotice()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT Notice.Notice_Id, Notice.Notice, User.User_Id, User.UserName FROM User INNER JOIN Notice ON User.User_Id = Notice.User_Id;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function addStation($station)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "INSERT INTO Station(Station_Name) VALUES(?);";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $station);
            $a = $pstmt->execute();

            if ($a > 0) {
                header("Location: ../admin/station_staff_stations.php?status=2");
                exit;
            } else {
                header("Location: ../admin/station_staff_stations.php?status=3");
                exit;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function addNotice($notice, $userId)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "INSERT INTO Notice(User_Id, Notice) VALUES(?, ?);";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $userId);
            $pstmt->bindValue(2, $notice);
            $a = $pstmt->execute();

            if ($a > 0) {
                header("Location: ../admin/station_staff_notices.php?status=2");
                exit;
            } else {
                header("Location: ../admin/station_staff_notices.php?status=3");
                exit;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function deleteStation($stationId)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "DELETE FROM Station WHERE Station_Id = ?;";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $stationId);
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

    public static function deleteNotice($noticeId)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "DELETE FROM Notice WHERE Notice_Id = ?;";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $noticeId);
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
        $query = "SELECT SUM(Price) FROM Reservation;";

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