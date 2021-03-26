<div class="modal" id="modal-popup-contact" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header border-bottom-0">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
				<div class="head-title">
					<b class="font-22 head-font"> Contact <?php echo $agent->agent->firstname." ". $agent->agent->lastname ?> </b><br/>
				</div>
			</div>
			<div class="modal-body pt-0">
				<form id="frmContact" method="post" role="form">
					<div class="form-group">
						<div id="contact-error" role="alert" class="error"></div>
						<div id="contact-success" role="alert" class="success"></div>
					</div>
					<div class="row">

						<div class="col-md-12 col-sm-12 form-group">
							<input type="text" class="form-control required" name="user_name" id="user_name" data-msg-required="Please enter your name" placeholder="First and Last Name">
						</div>
						<div class="col-md-12 col-sm-12 form-group">
							<input type="email" class="form-control required" name="user_email" id="user_email" data-msg-required="Please enter your email" placeholder="Email">
						</div>
						<div class="col-md-12 col-sm-12 form-group">
							<input type="text" class="form-control" name="user_phone" id="user_phone" data-msg-required="Please enter your phone number" placeholder="Phone (Optional)">
						</div>
						<div class="col-md-12 col-sm-12 form-group">
							<textarea class="form-control" rows="4" name="user_message" placeholder="I am looking for someone to help me with my real estate needs. Please contact me to discuss. (Please include any date and time preferences in this space.)"></textarea>
						</div>
						<div class="col-md-12 col-sm-12 form-group">
							<div class="col-xs-12 loading-area text-center">
							</div>
						</div>
						<div class="col-md-12 col-sm-12 form-group">By clicking the submit button you are agreeing and giving us expressed written consent to contact you.</div>
	                    <input type="hidden" name="agent_email" value="<?php echo $agent->agent->email ?>">
						<div class="col-md-12 col-sm-12 col-xs-12 form-group center text-center">
							<button type="submit" class="btn btn-danger width-100 btn-login btn-reg"> Submit </button>


						</div>
    
					</div>
				</form>
			</div>
		</div>
	</div>

</div>

<script>
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>