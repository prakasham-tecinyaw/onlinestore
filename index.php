<?php
        require_once 'core/init.php';
        include 'includes/head.php';

        $sql = "SELECT * FROM products WHERE featured = 1 ";
        $featured = $db-> query($sql);


        //session_destroy();

 ?>
 <?php include 'includes/navigation.php'; ?>
  <div class="container-fluid">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
      <?php

      include 'includes/headerfull.php';

      ?>


    </div>

    <div class="col-md-2">

  </div>
</div>
  <div class="container-fluid">
  <div class="col-md-2"><p>

  </p>
</div>
  <div class="col-md-8">

	    <div class="row">
		<h2 class="text-center">Featured Products</h2>
		<?php while ($product = mysqli_fetch_assoc($featured)) :
      ?>
		    <div class="col-md-3 text-center">

		         <h4><?= $product['title'];?></h4>
		         <img src="<?= $product['image']; ?>" alt="<?= $product['title'];?>" class="img-thumb"/>
		         <p class="list-price text-danger">List Price <s>RM <?= $product['list_price']; ?></s></span></p>
             <p class="price text-info"> Price RM <?= $product['price']; ?></s></span></p>
		         <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $product['id'];?>)">Details</button>


	     </div>

	     <?php endwhile; ?>
	    </div>
  </div>
  <div class="col-md-2"><?php
  include 'includes/rightbar.php';
  ?></div>
</div>

<?php
  include 'includes/footer.php';
 ?>
