<script type="text/javascript">

	(function ($){

$('#enquiry').submit(function(event){

     event.preventDefault();

     var endpoint= '<?php echo admin_url('admin-ajax.php');?>';
     // alert(endpoint);

     var form= $('#enquiry');

     var formdata = new FormData;
     formdata.append('action','enquiry');
     formdata.append('enquiry','form');
     $.ajax(endpoint,{
     	type: 'POST',
     	url: endpoint,
     	data: form.serialize(), 
     	processData: false,
     	contentType: false,

     	success: function(res)
     	{
     		alert(res.data);

     	},

     	error: function(err){
     		
     	}

     })


	})
	

})(jQuery)



</script>