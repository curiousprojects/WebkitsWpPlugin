<div class="container">
    <div>
        <h2 class="text-center">Change Password</h2>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="post" class="box-white" role="form" name="frmChangePassword" id="frmChangePassword" >
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div>
	                        <?php if(isset($_GET['update']) && $_GET['update'] == 'true') {?>

                                <p class="alert alert-success">Your New Password has been changed successfully.</p>

	                        <?php }
	                        if(isset($_GET['update']) && $_GET['update'] == 'false') {?>

                                <p class="alert alert-danger">Old password confirmation does not match.</p>

	                        <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" class="form-control ps-v" placeholder="Current Password" name="current_password" id="current_password" value="">
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control ps-v" placeholder="New Password" name="new_password" id="new_password" value="">
                </div>
                <div class="form-group">
                    <label for="confirm_new_password">Comfirm New Password</label>
                    <input type="password" class="form-control ps-v" placeholder="Confirm New Password" name="retype_password" id="retype_password" value="">
                </div>
                <div class="row justify-content-center">
                    <div class="col-9 col-sm-8 col-md-8 col-lg-4 btn-center ">
                        <div class="form-group text-center">
                            <button class="btn form-control btn-danger lnk-default" type="submit" name="Update" value="Change Password">Change Password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>