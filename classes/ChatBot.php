<?php

namespace classes;

use classes\DbConnector;
use PDO;
use PDOException;

require_once 'DbConnector.php';

class ChatBot
{
    private $msg;

    private $reply;

    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    public function getReply()
    {
        try {
            $dbcon = new DbConnector;
            $con = $dbcon->connect();
            $query = "SELECT Reply FROM ChatBot WHERE Question LIKE '%$this->msg%'";
            $stmt = $con->query($query);
            $rs = $stmt->fetch(PDO::FETCH_BOTH);

            if ($stmt->rowCount() > 0) {
                foreach ($rs as $key => $value) {
                    $this->reply = $value;
                }
            } else {
                $this->reply = "Sorry can't be able to understand you!";
            }
            return $this->reply;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}