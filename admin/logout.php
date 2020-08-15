<?php
require_once $_SERVER['DOCUMENT_ROOT'] .'/onlinestore/core/init.php';
unset($_SESSION['SBUser']);
header('Location: login.php');
?>
