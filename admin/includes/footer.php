</div><br><br>

<footer class="col-md-12 text-center" id="footer" style="color:white;">&copy; Copyright 2013-2017 Online PC  Hardware & Software Store</footer>

<script>
   function get_child_options(selected){
     if(typeof selected === 'undefined'){
       var selected = '';
     }

     var parentID = jQuery('#parent').val();
     jQuery.ajax({
       url: '/onlinestore/admin/parsers/child_categories.php',
       type: 'POST',
       data: {parentID :parentID, selected :selected},
       success: function(data){
         jQuery('#child').html(data);
       },
       error: function(){alert("Something went wrong with teh child options.")},
     });
   }
   jQuery('select[name="parent"]').change(function(){
     get_child_options();
   });
</script>
</body>
</html>
