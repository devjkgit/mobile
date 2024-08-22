<?php
require_once('function.php');

$userlogout=session_destroy() ;

header("Location: index.php");die;
?>