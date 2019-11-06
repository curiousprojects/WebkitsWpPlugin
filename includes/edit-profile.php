<div class="container">
	<div>
		<h2 class="text-center">Edit Profile</h2>
	</div>
	<div class="row">
		<div class="col-12">
			<form role="form" action="" name="frmEditProfile" class="box-white p-3" id="frmEditProfile" method="post" data-toggle="standardform">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12">
						<div>
							<?php if(isset($_GET['update']) && $_GET['update'] == 'true') {?>

								<p class="alert alert-success">Profile has been updated successfully.</p>

							<?php }
							if(isset($_GET['update']) && $_GET['update'] == 'false') {?>

								<p class="alert alert-danger">Please, check all your input(s). Make sure you have entered all valid information.</p>

							<?php } ?>
						</div>
					</div>
				</div>

				<div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="user_email" id="email" value="<?php echo $user->user_email?>" disabled="disabled">
                        </div>

                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">

                        <div class="form-group">
                            <label for="first_name">Name</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter Your Name" value="<?php echo $user->user_name?>">
                        </div>

                    </div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6">

						<div class="form-group">
							<label for="phone_no">Phone</label>
							<input type="text" class="form-control phone_no" name="user_phone" id="phone_no" placeholder="Enter Your Phone" value="<?php echo $user->user_phone?>">
						</div>

					</div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="user_city">City</label>
                            <input type="text" class="form-control" name="user_city" id="user_city" placeholder="Enter Your City" value="<?php echo $user->user_city?>">
                        </div>
                    </div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="user_creatria">Are you looking to buy, sell or rent?</label>
							<select class="form-control" name="user_creatria" id="user_creatria" value="<?php echo $user->user_creatria?>">
								<option>None</option>
								<option>Buy</option>
								<option>Sell</option>
								<option>Buy and Sell</option>
								<option>Rent</option>
							</select>
						</div>
					</div>
					<div class="col-12 col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label for="user_relator">Are you currently under contract with a REALTOR<sup>®</sup>?</label>
							<select class="form-control" name="user_relator" id="user_relator" value="<?php echo $user->user_relator?>">
								<option>Yes</option>
								<option>No</option>
							</select>
						</div>
					</div>

				</div>
				<div class="row justify-content-center ">
					<div class="col-9 col-sm-8 col-md-8 col-lg-4 btn-center ">
						<div class="form-group text-center">
							<button class="btn form-control btn-danger lnk-default" type="submit" name="Submit" value="Save Changes">Save Changes</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

