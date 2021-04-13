<div class="head-title">

	<b class="font-22 head-font text-center"> Contact <?php echo $listing->content->A_Name->name ?><span id="agent_name"> </span> </b><br/>
</div>
<form id="frmListing" method="post" role="form">

	<div class="row m-t-10">

		<div class="col-md-12 col-sm-12 form-group">
			<input type="text" class="form-control required" name="user_name" id="user_name" data-msg-required="Please enter your name" placeholder="First and Last Name">
		</div>
		<div class="col-md-12 col-sm-12 form-group">
			<input type="email" class="form-control required" name="user_email" id="user_email" data-msg-required="Please enter your email" placeholder="Email">
		</div>
		<div class="col-md-12 col-sm-12 form-group">
			<input type="text" class="form-control required" name="user_phone" id="user_phone" data-msg-required="Please enter your phone number" placeholder="Phone">
		</div>
		<div class="col-md-12 col-sm-12 form-group">
			<input type="text" class="form-control" name="user_address" id="user_address" placeholder="Address" readonly value="<?php echo $listing->content->full_add ?>">
		</div>
		<div class="col-md-12 col-sm-12 form-group">
			<textarea class="form-control required" rows="4" name="user_message" data-msg-required="Please enter comments" placeholder="Comments"></textarea>
		</div>

		<div class="col-md-12 col-sm-12 form-group">
			<div class="col-xs-12 loading-area text-center">
			</div>
		</div>
		<div class="col-md-12 col-sm-12 form-group text-center">By clicking the submit button you are agreeing and giving us expressed written consent to contact you.</div>
		<input type="hidden" id="agent_email" name="agent_email" value="<?php echo $listing->content->A_Name->email ?>">

		<input type="hidden" id="agent_broker" name="agent_broker" value="<?php echo $listing->content->A_Name->broker ?>">
		<div class="col-md-12 col-sm-12 col-xs-12 form-group">
			<div id="contact-error" role="alert" class="error f-20 text-center"></div>
			<div id="contact-success" role="alert" class="success f-20 text-center"></div>
		</div>
        <div id='recaptcha' class="g-recaptcha"
             data-sitekey="<?php echo $options['webkits_google_site_key'] ?>"
             data-callback="submit_form"
             data-size="invisible"></div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-group center text-center">
			<button type="submit" class="btn btn-danger w-20 btn-login btn-reg"> Submit </button>
		</div>


	</div>
</form>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $options['webkits_google_site_key'] ?>"></script>
<script>
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    var webkits_google_site_key = '<?php echo $options['webkits_google_site_key'] ?>';
</script>