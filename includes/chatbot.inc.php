<?php
session_start();

use classes\ChatBot;

require_once '../classes/ChatBot.php';

$msg = strip_tags($_POST['text']);
$chatBot = new ChatBot($msg);
$reply = $chatBot->getReply();
echo $reply;
