<?php
   require_once '../core/init.php';
   if(!is_logged_in()){
     login_error_redirect();
   }
   include 'includes/head.php';
   include 'includes/navigation.php';
?>
<h2>Customers</h2>
<?php include 'includes/footer.php'; ?>
