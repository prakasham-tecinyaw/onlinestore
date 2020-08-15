<?php
 function display_errors($errors){
   $display = '<ul class="bg-danger">';
   foreach ($errors as $error ) {
     $display .= '<li class = "text-danger">'.$error.'</li>';
   }
   $display .= '</ul>';
   return $display;
 }

function sanitize($dirty){
  return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

function money($number){
  return 'RM '.number_format($number,2);
}
//login success redirect
function login($user_id){
  $_SESSION['Admin'] = $user_id;
  global $db;
  $date = date("Y-m-d H:i:s");
  $db->query("UPDATE users SET last_login = '$date' WHERE id = '$user_id'");
  $_SESSION['success_flash'] = 'You are now logged In !';
  header('Location:index.php');

}
//login validation
function is_logged_in(){
  if(isset($_SESSION['Admin']) && $_SESSION['Admin'] > 0){
    return true;
  }
  return false;
}
//login error redirect
function login_error_redirect($url = 'login.php'){
  $_SESSION['error_flash'] = ' You must be logged in to access that page';
  header('Location:'.$url);
}
// customer login success redirect
function customer_login($customer_id){
  $_SESSION['Customer'] = $customer_id;
  $_SESSION['success_flash'] = 'You are now logged in !';
  header('Location: index.php');
}
//customer login validation
function customer_is_logged_in(){
  if(isset($_SESSION['Customer']) && $_SESSION['Customer'] > 0){
    return true;
  }
  return false;
}
//failed customer login redirect
function customer_login_error_redirect($url = 'cuslog.php'){
  $_SESSION['error_flash'] = ' You must be logged in to access that page';
  header('Location:'.$url);
}
function get_category($child_id){
  global $db;
  $id = sanitize($child_id);
  $sql = "SELECT p.id AS'pid', p.category AS 'parent', c.id AS 'cid', c.category AS 'child' FROM categories c
          INNER JOIN categories p
          ON c.parent = p.id
          WHERE c.id = $id";
  $query = $db->query($sql);
  $category = mysqli_fetch_assoc($query);
  return $category;
}









// permission error redirect
//function permission_error_redirect($url = 'login.php'){
  //$_SESSION['error_flash'] = ' You do not have permission to access that page';
  //header('Location:'.$url);
//}

//function has_permission($permission = 'admin'){
  //global $user_data;
  //$permission = explode(','. $user_data['permission']);
  //if(int_array($permission,$permission,true)){
  //  return true;
  //}
  //return false;
//}
?>
