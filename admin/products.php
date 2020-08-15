<?php
require_once $_SERVER['DOCUMENT_ROOT'] .'/onlinestore/core/init.php';
if(!is_logged_in()){
  header('Location: login.php');
}
include 'includes/head.php';
include 'includes/navigation.php';
//Delete Products
if(isset($_GET['delete'])){
  $id = sanitize($_GET['delete']);
  $db->query("UPDATE products SET deleted = 1 WHERE id = '$id'");
  header('Location: products.php');
}

$dbpath ='';
if(isset($_GET['add']) || isset($_GET['edit'])){
$brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
$parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
$title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
$brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
$parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
$category = ((isset($_POST['child'])) && !empty($_POST['child'])?sanitize($_POST['child']):'');
$price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
$list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):'');
$unit = ((isset($_POST['unit']) && $_POST['unit'] != '')?sanitize($_POST['unit']):'');
$description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
$saved_image ='';

if(isset($_GET['edit'])){
  $edit_id = (int)$_GET['edit'];
  $productresults = $db->query("SELECT * FROM products WHERE id = '$edit_id' ");
  $product = mysqli_fetch_assoc($productresults);
  If(isset($_GET['delete_image'])){
     $image_url = $_SERVER['DOCUMENT_ROOT'].$product['image'];
     unlink($image_url);
     $db->query("UPDATE products SET image ='' WHERE id = '$edit_id'");
     header('Location: products.php?edit='.$edit_id);
   }
  $category = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$product['categories']);

  $title = ((isset($_POST['title']) && !empty($_POST['title']))?sanitize($_POST['title']):$product['title']);
  $brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):$product['brand']);

  $parentQ = $db->query("SELECT * FROM categories WHERE id = '$category'");
  $parentResult = mysqli_fetch_assoc($parentQ);
  $parent = ((isset($_POST['parent']) && $_POST['parent'] != '')?sanitize($_POST['parent']):$parentResult['parent']);
  $price = ((isset($_POST['price']) && !empty($_POST['price']))?sanitize($_POST['price']):$product['price']);
  $list_price = ((isset($_POST['list_price']) && !empty($_POST['list_price']))?sanitize($_POST['list_price']):$product['list_price']);
  $unit = ((isset($_POST['unit']) && !empty($_POST['unit']))?sanitize($_POST['unit']):$product['unit']);
  $description = ((isset($_POST['description']) && !empty($_POST['description']))?sanitize($_POST['description']):$product['description']);
  $saved_image = (($product['image'] != '')?$product['image']:'');
  $dbpath = $saved_image;
}
if ($_POST){
  //variables decralation
  $errors = array();
  $required = array('title' , 'brand','price','parent','child','unit');
  foreach ($required as $field ){
  if($_POST[$field] == ''){
    $errors[] = 'ALL Fields With Astrisk are required.';
    break;
  }
}
if(!empty($_FILES)){

     $photo = $_FILES['photo'];
     $name = $photo['name'];
     $nameArray = explode('.', $name);
     $fileName = $nameArray[0];
     $fileExt = $nameArray[1];
     $mime = explode('/', $photo['type']);
     $mimeType = $mime[0];
     $mimeExt = $mime[1];
     $tmpLoc = $photo['tmp_name'];
     $fileSize = $photo['size'];
     $allowed = array('png','jpg','jpeg','gif');
     $uploadName = md5(microtime()).'.'.$fileExt;
     $uploadPath = BASEURL.'images/'.$uploadName;

     $dbpath = '/onlinestore/images/'.$uploadName;

     if($mimeType != 'image'){
     $errors[] = 'The file must be an image!';
      }
     if(!in_array($fileExt, $allowed)){
        $errors[] = 'The file extension must be a png, jpg, jpeg, or gif!';
      }
      if($fileSize > 15000000){
       $errors[] = 'The file size must be less than 15MB!';
      }
     if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
               $errors[] = 'File extension does not match the file.';
           }
    }
    if(!empty($errors)){
     echo display_errors($errors);
    } else {
     //upload file and insert into database
      move_uploaded_file($tmpLoc,$uploadPath);
      $insertSql = "INSERT INTO products (`title`,`price`,`list_price`,`brand`,`categories`,`image`,`description`,`unit`)
      VALUES ('$title','$price', '$list_price', '$brand', '$category','$dbpath','$description','$unit')";

      if(isset($_GET['edit'])){

      $insertSql = "UPDATE products SET  title='$title', price='$price' , list_price='$list_price' , brand='$brand' , categories='$category' , image='$dbpath' , description='$description' , featured='1', unit='$unit' , deleted='0'
      WHERE id='$edit_id'";
     }
        $db->query($insertSql);
        header('Location: products.php');
  }
}
?>
  <!-- This section for addinng information about product-->
  <h2 class="text-center"><?=((isset($_GET['edit']))?'Edit':'Add a');?> New Product</h2><hr>
  <form action ="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="POST" enctype="multipart/form-data">
    <!-- 1.section for getting title -->
    <div class="form-group col-md-3">
      <label for="title">Title*:</label>
        <input type="text" name="title" class="form-control" id="title" value="<?= $title; ?>">
    </div>
    <!-- 2. section for selecting brand-->
    <div class="form-group col-md-3">
    <label for="brand">Brand*:</label>
    <select class="form-control" id="brand" name="brand">
      <option value=""<?=(($brand == '')?'selected':'');?>></option>
      <?php while($b = mysqli_fetch_assoc($brandQuery)): ?>
        <option value="<?= $b['id']; ?>"<?=(($brand == $b['id'])?'selected':'');?>><?= $b['brand'];?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <!-- 3. section for selecting parent category-->
  <div class="form-group col-md-3">
    <label for="parent">Parent Category*:</label>
    <select class="form-control" id="parent" name="parent">
      <option value=""<?=(($parent == '')?'selected':'');?>></option>
      <?php while ($p = mysqli_fetch_assoc($parentQuery)):?>
        <option value="<?= $p['id'];?>"<?=(($parent == $p['id'])?'selected':''); ?>><?= $p['category']; ?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <!-- 4. section for selecting child category-->
  <div class="form-group col-md-3">
    <label for="child">Child Category*:</label>
    <select id="child" name="child" class="form-control"></select>
  </div>
  <!-- 5. section for selecting price -->
  <div class="form-group col-md-3">
    <label for="price">Price*:</label>
    <input type="text" id="price" name="price" class="form-control" value="<?= $price;?>">
  </div>
  <!-- 6. section for selecting list price -->
  <div class="form-group col-md-3">
    <label for="list_price">List Price:</label>
    <input type="text" id="list_price" name="list_price" class="form-control" value="<?= $list_price;?>">
  </div>
  <!-- 7. section for selecting Quantity -->
  <div class="form-group col-md-3">
    <label>Quantity*:</label>
    <input type="number" name="unit" class="form-control" value="<?= $unit;?>" min="0">
  </div>
  <!-- 8. section for selecting list price -->
  <div class="form control col-md-6">
    <?php if($saved_image != ''): ?>
     <label for="photo">Product Picture: </label>
     <div class="saved-image" >
       <img src ="<?=$saved_image; ?>" alt="saved image" style="width:300px; height:auto;"/><br>
       <a href="products.php?delete_image=1&edit=<?= $edit_id; ?>" class="text-danger">Delete image</a>
     </div>
    <?php else: ?>
     <label for="photo">Product Picture: </label>
     <input type="file" name="photo" id="photo" class="form-control">
  <?php endif; ?>
  </div>
  <div class="form-group col-md-6">
    <label for="description">Description:</label>
    <textarea id="description" name="description" class="form-control" rows="6"><?= $description;?></textarea>
  </div>
  <div class="form-group pull-right">
    <a href="products.php" class="btn btn-default">Cancel</a>
  <input type="submit"  value="<?= ((isset($_GET['edit']))?'Edit':'Add'); ?> Product" class=" btn btn-success ">
  </div>
  <div class="clearfix"></div>
  </form>
<?php }else{

$sql = "SELECT * FROM products WHERE deleted = 0 ORDER BY categories";
$presults = $db->query($sql);
if(isset($_GET['featured'])) {
  $id = (int)$_GET['id'];
  $featured = (int)$_GET['featured'];
  $featuredSql = "UPDATE products SET featured = '$featured' WHERE id ='$id'";
  $db->query($featuredSql);
  header('Location: products.php');
}
?>
<style>
#add-product-btn{
margin-top:-45px;
}

</style>
<h2 class="text-center">Products</h2>
<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add Product</a><div class="clearfix"></div>
<hr>
<table class="table table-bordered table-condensed table-striped">
  <thead><th></th><th>Product</th><th>Price</th><th>Category</th><th>Featured</th><th>Sold</th></thead>
  <tbody>
    <?php while($product = mysqli_fetch_assoc($presults)):
         $childID = $product['categories'];
         $childSql = "SELECT * FROM categories WHERE id = '$childID'";
         $result = $db->query($childSql);
         $child = mysqli_fetch_assoc($result);
         $parentID = $child['parent'];
         $pSql = "SELECT * FROM categories WHERE id = '$parentID'";
         $presult = $db->query($pSql);
         $parent = mysqli_fetch_assoc($presult);
         $category = $parent['category'].'~'.$child['category'];
      ?>
      <tr>
        <td>
          <a href="products.php?edit=<?= $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span> </a>
          <a href="products.php?delete=<?= $product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span> </a>
        </td>
        <td><?= $product['title'];?> </td>
        <td><?= money($product['price']);?></td>
        <td><?= $category ?></td>

        <td><a href="products.php?featured=<?=(($product['featured']==0)?'1':'0'); ?>&id=<?=$product['id']; ?>" class="btn btn-xs btn-default ">
          <span class="glyphicon glyphicon-<?= (($product['featured']==1)?'minus':'plus'); ?>"></span>
          </a>&nbsp <?= (($product['featured'] == 1)?'Featured Product':''); ?></td>

        <td>0</td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
<?php } include 'includes/footer.php'; ?>
<script>
   jQuery('document').ready(function(){
     get_child_options('<?= $category; ?>');
   });
</script>
