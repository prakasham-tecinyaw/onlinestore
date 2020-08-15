<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/onlinestore/core/init.php';
$mode - sanitize($_POST['mode']);
$edit_id = sanitize($_POST['edit_id']);
$items = json_decode($result['items'],true);
$updated_items = array();
$domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);


if(empty($updated_items)){
  $db->query("DELETE FROM cart WHERE id = '{$cart_id}'");
  setcookie(CART_COOKIE,'',1,"/",$domain,false);
  $_SESSION['success_flash'] = 'Thanks You for Shopping with us!';
}

?>
