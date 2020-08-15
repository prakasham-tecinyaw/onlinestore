<?php
require_once $_SERVER['DOCUMENT_ROOT'] .'/onlinestore/core/init.php';
include 'includes/head.php';

$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors = array();
?>
<style>
#login-form{
  width: 30%;
  height: 60%;
  border: 2px solid #000;
  border-radius: 15px;
  box-shadow:7px 7px 15px rgba(0,0,0,0.6);
  margin: 7% auto;
  padding:15px;
  background-color: #fff;
}
</style>
<div id="login-form">
  <div>
    <?php
       if($_POST){

         //form validation
         if(empty($_POST['email']) || empty($_POST['password'])){
           $errors[] = 'You must provide Email and Password.';
         }

         //password is more than 6 characters
         if(strlen($password)< 6){
           $errors[] = 'Password must be  at least 6 characters.';
         }

         //validate Email
         if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           $errors[] ='Your must enter a valid Email';
         }

         //check if customer email exists in Database
         $query = $db->query("SELECT * FROM customers WHERE email = '$email ' AND password='$password'");
         $customer = mysqli_fetch_assoc($query);
         $customerCount = mysqli_num_rows($query);
         //echo $customerCount;

         if($customerCount < 1){
           $errors[] = 'That Email doesn\'t exist in our Database ';
         }
         //if(!password_verify($password, $customer['password'])){
          // $errors[] = 'The password does not match our records. Please try again!';
        // }

         //check for errors
         if(!empty($errors)){
           echo display_errors($errors);
         }else{
           // log user in
           $customer_id = $customer['id'];
           customer_login($customer_id);
         }
       }
    ?>
   </div>
   <h2 class="text-center">Customer Login</h2><hr>
   <form action ="cuslog.php" method="post">
     <div class="form-group">
       <label for="email">Email</label>
       <input type="text" name="email" id="email" class="form-control" value="<?= $email;?>">
     </div>
     <div class="form-group">
       <label for="password">Email</label>
       <input type="password" name="password" id="email" class="form-control" value="<?= $password;?>">
     </div>
     <div class="form-group">
       <input type="submit" value ="Login" class="btn btn-primary">
     </div>
   </form>
  <p class="text-right"><a href="/onlinestore/index.php" alt="home">Visit Site</a></p>

</div>
<?php include 'includes/footer.php'; ?>
