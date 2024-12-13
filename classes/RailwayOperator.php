<?php

namespace classes;

use classes\DbConnector;
use classes\User;
use PDO;
use PDOException;

require_once 'DbConnector.php';
require_once 'User.php';

class RailwayOperator extends User
{

    public static function getScheduleCount()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT COUNT(Schedule_Id) FROM Schedule;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $count = $pstmt->fetch(PDO::FETCH_BOTH);
            return $count[0];
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getTrainCount()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT COUNT(Train_Id) FROM Train;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $count = $pstmt->fetch(PDO::FETCH_BOTH);
            return $count[0];
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getRouteCount()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT COUNT(Route_Id) FROM Route;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $count = $pstmt->fetch(PDO::FETCH_BOTH);
            return $count[0];
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getSchedule()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT Schedule.Schedule_Id, Schedule.Train_Id, Schedule.Start_Station_Id, Schedule.End_Station_Id, Schedule.Route_Id, Schedule.Dept_Time, Schedule.Arr_Time, Train.Train_Id, Train.Train_Name FROM Schedule INNER JOIN Train ON Schedule.Train_Id = Train.Train_Id ORDER BY Schedule.Arr_Time;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getTrain()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT * FROM Train;";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $rs = $pstmt->fetchAll(PDO::FETCH_ASSOC);
            return $rs;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getRoute()
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "SELECT * FROM Route;";
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

    public static function addSchedule($route, $train, $arrTime, $depTime, $startStation, $endStation)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query1 = "SELECT Train_Id FROM Train WHERE Train_Name = ?;";
        $query2 = "SELECT Station_Id FROM Station WHERE Station_Name = ?;";
        $query3 = "SELECT Station_Id FROM Station WHERE Station_Name = ?;";
        $query4 = "SELECT Route_Id FROM Route WHERE Route_Name = ?;";
        $query5 = "INSERT INTO Schedule(Train_Id, Start_Station_Id, End_Station_Id, Route_Id, Dept_Time, Arr_Time) VALUES(?, ?, ?, ?, ?, ?);";
        try {
            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $train);
            $pstmt1->execute();
            $trainId = $pstmt1->fetch(PDO::FETCH_BOTH)[0];

            $pstmt2 = $con->prepare($query2);
            $pstmt2->bindValue(1, $startStation);
            $pstmt2->execute();
            $startStationId = $pstmt2->fetch(PDO::FETCH_BOTH)[0];

            $pstmt3 = $con->prepare($query3);
            $pstmt3->bindValue(1, $endStation);
            $pstmt3->execute();
            $endStationId = $pstmt3->fetch(PDO::FETCH_BOTH)[0];

            $pstmt4 = $con->prepare($query4);
            $pstmt4->bindValue(1, $route);
            $pstmt4->execute();
            $routeId = $pstmt4->fetch(PDO::FETCH_BOTH)[0];

            $pstmt5 = $con->prepare($query5);
            $pstmt5->bindValue(1, $trainId);
            $pstmt5->bindValue(2, $startStationId);
            $pstmt5->bindValue(3, $endStationId);
            $pstmt5->bindValue(4, $routeId);
            $pstmt5->bindValue(5, $depTime);
            $pstmt5->bindValue(6, $arrTime);
            $a = $pstmt5->execute();

            if ($a > 0) {
                header("Location: ../admin/railway_operator_schedules.php?status=2");
                exit;
            } else {
                header("Location: ../admin/railway_operator_schedules.php?status=3");
                exit;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function addRoute($route)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "INSERT INTO Route(Route_Name) VALUES(?);";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $route);
            $a = $pstmt->execute();

            if ($a > 0) {
                header("Location: ../admin/railway_operator_routes.php?status=2");
                exit;
            } else {
                header("Location: ../admin/railway_operator_routes.php?status=3");
                exit;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function addTrain($train, $canteen)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "INSERT INTO Train(Train_Name, Canteen) VALUES(?, ?);";
        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $train);
            $pstmt->bindValue(2, $canteen);
            $a = $pstmt->execute();

            if ($a > 0) {
                header("Location: ../admin/railway_operator_trains.php?status=2");
                exit;
            } else {
                header("Location: ../admin/railway_operator_trains.php?status=3");
                exit;
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function deleteSchedule($scheduleId)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "DELETE FROM schedule WHERE Schedule_Id = ?;";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $scheduleId);
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

    public static function deleteTrain($trainId)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "DELETE FROM Train WHERE Train_Id = ?;";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $trainId);
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

    public static function deleteRoute($routeId)
    {
        $dbcon = new DbConnector;
        $con = $dbcon->connect();
        $query = "DELETE FROM Route WHERE Route_Id = ?;";

        try {
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $routeId);
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
