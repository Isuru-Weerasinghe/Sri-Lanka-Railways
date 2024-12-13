<?php

namespace classes;

use PDOException;
use PDO;

class Review {

private $review_id;
private $user_id;
private $title;
private $rate;
private $body;

public function __construct($user_id, $title, $rate, $body) {
    $this->user_id = $user_id;
    $this->title = $title;
    $this->rate = $rate;
    $this->body = $body;
  }


public function getReview_id() {
    return $this->review_id;
  }

public function getUser_id() {
    return $this->user_id;
  }

public function getRate() {
    return $this->rate;
  }

public function getTitle() {
   return $this->title;
 }

public function getBody() {
    return $this->body;
  }

public function setReview_id($review_id) {
    $this->review_id = $review_id;
  }

public function setUser_id($user_id) {
    $this->user_id = $user_id;
 }

public function setRate($rate) {
    $this->rate = $rate;
 }

public function setTitle($title) {
    $this->title = $title;
  }

public function setBody($body) {
    $this->body = $body;
 }

public function getUserName() {
    $userId = $this->user_id;
    try {
        $dbcon = new DbConnector();
        $con = $dbcon->connect();
        $query = "SELECT First_Name FROM user_details WHERE User_Id=?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $userId);
        $pstmt->execute();
        $username = $pstmt->fetchColumn(0);
        return $username;
    } catch (PDOException $exc) {
            echo "Error in getUserName method:$exc->getMessage()";
        }
    }

public static function getRateCounts($rate){
    try{
        $dbcon = new DbConnector();
        $con = $dbcon->connect();
        $query = "SELECT COUNT(*) AS total_rows FROM Review WHERE Rate=?";
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1, $rate);
        $pstmt->execute();
        $count = $pstmt->fetch(PDO::FETCH_ASSOC);
        return $count['total_rows'];
        } catch (PDOException $ex) {
            echo "Error in getRowCount method:$ex->getMessage";
          }
      }

public static function getTotalCount(){
    try{
        $dbcon = new DbConnector();
        $con = $dbcon->connect();
        $query = "SELECT COUNT(*) AS total_rows FROM Review";
        $pstmt = $con->prepare($query);
        $pstmt->execute();
        $count = $pstmt->fetch(PDO::FETCH_ASSOC);
        return $count['total_rows'];
    } catch (PDOException $ex) {
        echo "Error in getRowCount method:$ex->getMessage";
      }
  }

public function addReview() {
    try {
            $dbcon = new DbConnector();
            $con = $dbcon->connect();
            $query = "INSERT INTO review (User_Id,Title,Rate,Body) VALUES(?,?,?,?)";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $this->user_id);
            $pstmt->bindValue(2, $this->title);
            $pstmt->bindValue(3, $this->rate);
            $pstmt->bindValue(4, $this->body);
            $x = $pstmt->execute();
            return ($x > 0);
        } catch (PDOException $exc) {
            echo "Error in addReview method:$exc->getMessage()";
        }
    }

public static function deleteReview($review_id) {
    try {
            $dbcon = new DbConnector();
            $con = $dbcon->connect();
            $query = "DELETE FROM review WHERE Review_Id=?";
            $pstmt = $con->prepare($query);
            $pstmt->bindValue(1, $review_id);
            $x = $pstmt->execute();
            return ($x > 0);
        } catch (PDOException $exc) {
            echo "Error in deleteReview method:$exc->getTraceAsString()";
        }
    }

public static function showAllReviews() {
    try {
            $review_list = array();
            $dbcon = new DbConnector();
            $con = $dbcon->connect();
            $query = "SELECT *FROM review";
            $pstmt = $con->prepare($query);
            $pstmt->execute();
            $result = $pstmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
                foreach ($result as $row) {
                $row = new Review($row->User_Id, $row->Title, $row->Rate, $row->Body);
                $review_list[] = $row;
            }
                } else {
                    echo "p style='text-align:center'>nothing to display</p>";
                    }
                return $review_list;

        } catch (PDOException $exc) {
            echo "Error in showAllReviews:$exc->getTraceAsString()";
            }
        }

public static function showByStars($rate) {
        try {
                $review_list = array();
                $dbcon = new DbConnector();
                $con = $dbcon->connect();
                $query = "SELECT *FROM review WHERE Rate=?";
                $pstmt = $con->prepare($query);
                $pstmt->bindValue(1, $rate);
                $pstmt->execute();
                $result = $pstmt->fetchAll(PDO::FETCH_OBJ);
                if (!empty($result)) {
                    foreach ($result as $row) {
                    $row = new Review($row->User_Id, $row->Title, $row->Rate, $row->Body);
                    $review_list[] = $row;
                }
                    } else {
                        echo "<p style='text-align:center'>nothing to display</p>";
                }
                return $review_list;

                } catch (PDOException $exc) {
                    echo "Error in showAllReviews:$exc->getMessage)";
                }
            }

}
