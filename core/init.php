<?php
  session_start();
	$db = mysqli_connect('localhost', 'root', '', 'onlinepcstore');

		 require_once $_SERVER['DOCUMENT_ROOT'].'/onlinestore/config.php';
		 require_once BASEURL.'helpers/helpers.php';

     $cart_id = '';
     if (isset($_COOKIE[CART_COOKIE])){
         $cart_id = sanitize($_COOKIE[CART_COOKIE]);
     }
		 if(isset($_SESSION['Admin'])){
		 $user_id = $_SESSION['Admin'];
		 $queryUser = $db->query("SELECT * FROM users WHERE id ='$user_id'");
		 $user_data = mysqli_fetch_assoc($queryUser);
		 $user_data['full_name'];
	}

		 if(isset($_SESSION['Customer'])){
	 	 $customer_id = $_SESSION['Customer'];
	 	 $queryCustomer = $db->query("SELECT * FROM customers WHERE id ='$customer_id'");
	 	 $customer_data = mysqli_fetch_assoc($queryCustomer);
	 	 $customer_data['full_name'];

}

if(isset($_SESSION['success_flash'])){
	echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
	unset($_SESSION['success_flash']);
}
if(isset($_SESSION['error_flash'])){
	echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
	unset($_SESSION['errors_flash']);
}
//session_destroy();
