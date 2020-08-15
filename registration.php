<?php
require_once $_SERVER['DOCUMENT_ROOT'] .'/onlinestore/core/init.php';
include 'includes/head.php';

if(isset($_POST['register'])){

  $fullname =$_POST['full_name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $address = $_POST['address'];
  $mobile = $_POST['mobile'];
  //check if email exists in the database
  $query = $db->query("SELECT * FROM `customers` WHERE `email` = '$email'");
	$check = $query->num_rows;
		if($check == 1)
			{
			echo "<script>alert('EMAIL ALREADY EXIST')</script>";
			}

			else
			{
      $insertSql = "INSERT INTO customers (`full_name`,`email`,`password`,`address`,`mobile`) VALUES ('$fullname','$email','$password','$address','$mobile')";
      $db->query($insertSql);
      header('Location: index.php');
      }

}

?>

<h2 class="text-center"> Customer Registration Form </h2><hr>
<div class="container-fluid">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <form action ="registration.php" method="POST" enctype="multipart/form-data">
      <!-- 1. Name -->
      <div>
        <label for="name">Name*:</label>
        <input type="text" name="full_name" class="form-control" id="name" value="" placeholder="John" required>
      </div>
      <div>
        <label for="name">Email*:</label>
        <input type="text" name="email" class="form-control" id="email" value="" placeholder="abc@gmail.com" required>
      </div>
      <div>
        <label for="name">Password*:</label>
        <input type="password" name="password" class="form-control" id="password" value="" placeholder="******" required>
      </div>
      <div>
        <label for="name">Address*:</label>
        <input type="text" name="address" class="form-control" id="address" value="" placeholder="No. 19 MMU street" required>
      </div>
      <div>
        <label for="name">Mobile Number*:</label>
        <input type="text" name="mobile" class="form-control" id="mobile" value="" placeholder="0123456789" required>
      </div>
      <hr>
      <div class="form-group pull-right">
         <input type="submit"  name="register" value="Register Now" class=" btn btn-success ">
      </div>
      <p class="text-left text-info"><a href="/onlinestore/index.php" alt="home">Visit Store</a></p>
      <div class="clearfix"></div>
    </form>

  </div>
  <div class="col-md-4"></div>

</div>


<?php  include 'includes/footer.php'; ?>
