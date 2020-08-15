<?php
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
if($cart_id != ''){
  $cartQ = $db->query("SELECT * FROM cart WHERE id= '{$cart_id}'");
  $result = mysqli_fetch_assoc($cartQ);
  $items = json_decode($result['items'],true);
  $i =1;
  $sub_total = 0;
  $item_count = 0;


}
?>
<style>
.totals-table-header th{
  text-align: center;
}
.col-md-8{
  margin-left:350px;
}
</style>

<div class="col-md-8">
  <div class="row">
    <h2 class="text-center">Shopping Cart</h2><hr>
    <?php if($cart_id == ''):?>
    <div class="bg-danger">
      <p class="text-center text-danger">Your shopping is empty!</p>
    </div>
  <?php else: ?>
    <!--fetching product details -->
      <table class="table table-bordered table-condensed table-striped">
        <thead><th>#</th><th>Item</th><th>Price</th><th>Quantity</th><th>Sub Total</th></thead>
        <tbody>
          <?php

            foreach ($items as $item){
            $product_id = $item['id'];
            $productQ = $db->query("SELECT * FROM products where id='{$product_id}'");
            $product = mysqli_fetch_assoc($productQ);
            $available = $product['unit'];

          ?>
          <!-- display the details-->
        <tr>
          <td><?=$i; ?></td>
          <td><?=$product['title'];?></td>
          <td><?=money($product['price']);?></td>
          <td><?=$item['quantity'];?></td>
          <td><?=money($item['quantity'] * $product['price']);?></td>
        </tr>

        <?php
        // display grand total
         $i++;
         $item_count += $item['quantity'];
         $sub_total += ($product['price'] * $item['quantity']);
         }
         $tax = TAXRATE * $sub_total;
         $tax = number_format($tax,2);
         $grand_total = $tax + $sub_total;

        ?>
      </table>
      </tbody>
      <table class="table table-bordered  table-condensed text-right">
        <legend >Totals</legend>
        <thead class="totals-table-header"><th>Total Items</th><th>Sub Total</th><th>GST Tax</th><th>Grand Total</th></thead>
        <tbody>
          <tr>
            <td><?= $item_count; ?></td>
            <td><?= money($sub_total); ?></td>
            <td><?= money($tax); ?></td>
            <td class="bg-success"><?= money($grand_total); ?></td>
          </tr>
        </tbody>
      </table>
      <!-- checkout button -->
<button type="button" class="btn btn-primary  pull-right" data-toggle="modal" data-target="#checkoutModal">
<span class="glyphicon glyphicon-shopping-cart"></span> Check Out >>
</button>

<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkoutModalLabel">Confirm Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2>Grand Total : <?= money($grand_total); ?></h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="update_cart()">Confrim</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php include 'includes/footer.php'; ?>
  </div>

</div>
