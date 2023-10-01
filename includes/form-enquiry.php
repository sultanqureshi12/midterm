
<div id="success_message" class="alert alert_success" style="display: none;"></div>
<form id="enquiry">
    <div class="form-group row">


        <div class="col-lg-6">
            <input type="text" name="fname" placeholder="First Name" class="form-control" required>
        </div>
        <div class="col-lg-6">
            <input type="text" name="lname" placeholder="Last Name" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6">
            <input type="email" name="email" placeholder="Email" class="form-control" required>
        </div>
        <div class="col-lg-6">
            <input type="tel" name="phone" placeholder="Phone" class="form-control" required>
        </div>
    </div>
    <div class="form-group">
        <!-- Corrected placeholder placement -->
        <textarea name="enquiry" class="form-control" placeholder="Your Enquiry" required></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success btn-block">Send your enquiry</button>
    </div>
</form>




<script type="text/javascript">
    
    jQuery(document).ready(function($){
        $('#enquiry').submit(function(e){
            e.preventDefault();
              var nonce_value='<?php echo wp_create_nonce('ajax-nonce');?>';
            var formData =$('#enquiry').serialize();
               // formData.append('nonce','<?php echo wp_create_nonce('ajax-nonce');?>');
            $.ajax({
                type:'POST',
                url: '<?php echo admin_url('admin-ajax.php');?>',
                data: formData + '&action=send_email&nonce='+nonce_value,
                dataType:'json',
                success: function(response){
                    $('#enquiry').fadeOut(200);

                    $('#success_message').text('Thank you for your enquiry').show();

                    $('#enquiry').trigger('reset');

                     $('#enquiry').fadeIn(500);
                },
                error: function(res){

                    alert('there was an error');

                }
            })
        })
    })
</script>
