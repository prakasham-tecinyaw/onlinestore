</div><br><br>

<footer class="text-center" id="footer">&copy; Copyright 2013-2017 Online PC  Hardware & Software Store</footer>

<!-- Details modal-->

<script>
	jQuery(window).scroll(function(){
		var vscroll = jQuery(this).scrollTop();
		jQuery('#logotext').css({
			"transform" :"translate(0px,"+vscroll/3+"px"
		});

	});


	function detailsmodal(id){
		var data = {"id" : id};
		jQuery.ajax({
		url : '/onlinestore/includes/detailsmodal.php',
		method : "post",
		data : data,
		success: function(data){
			jQuery('body').prepend(data);
			jQuery('#details-modal').modal('toggle');
		},
		error: function(){
			alert("Something went wrong!");
		}
    });

}

function update_cart(){

	jQuery.ajax({
		url : '/onlinestore/admin/parsers/update_cart.php',
		method :"post",
		data : '',
		success : function(){ location.reload();},
		error : function(){alert("Something went wrong");},
	});
}

 function add_to_cart(){
	 jQuery('#modal_errors').html("");
	 var quantity = jQuery('#quantity').val();
	 var available = jQuery('#available').val();
	 var error = '';
	 var data =jQuery('#add_product_form').serialize();
	 if(quantity == '' || quantity == 0)
	 {
		 error +='<p class="text-danger text-center"> You must choose a quantity.</p>';
		 jQuery('#modal_errors').html(error);
		 return;
	 }else if(quantity > available){
		 error +='<p class="text-danger text-center"> There are only '+available+' available.</p>';
		 jQuery('#modal_errors').html(error);
		 return;
	 }else{
		 jQuery.ajax({
			 url : '/onlinestore/admin/parsers/add_cart.php',
			 method : 'post',
			 data : data,
			 success :function(){
				 location.reload();
			 },
			 error : function(){alert("somethign went wrong");}
		 });
	 }
 }


</script>
</body>
</html>
