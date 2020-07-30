<div class="modal" id="modal-popup-signup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                <div>
                    <b class="text-red font-16">Sign Up For Sold Listing Access</b><br/>
                    <span class="font-14">
                        Access to Sold Data on this website may only be used by consumers that have a bonafide interest in the purchase, sale, or lease of residential real estate.
                        All Sold Listing data presented is deemed reliable but is not guaranteed accurate by the
                        Ottawa Real Estate Board (OREB).
                        <br/>
                        <br/>
                    </span>
                </div>
                <div class="section-title">
                    <h3 class="margin-none">Register</h3>
                </div>
            </div>
            <div class="modal-body">
                <form id="frmRegister" method="post" role="form">
                    <div class="form-group">
                        <div id="signup-error" role="alert" class="error"></div>

                    </div>
                    <div class="form-group">
                        <span>Already a member? </span> <a href="javascript:void(0)" class="popup-modal-sm" data-target="login">Login</a>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 form-group">
                            <label for="user_name">Name</label>
                            <input type="text" class="form-control required" name="user_name" id="user_name" data-msg-required="Please enter name" placeholder="Name">
                        </div>
                        <div class="col-md-6 col-sm-6 form-group">
                            <label for="user_email">Email</label>
                            <input type="email" class="form-control required" name="user_email" id="user_email" data-msg-required="Please enter email" placeholder="Email">
                        </div>
                        <div class="col-md-6 col-sm-6 form-group">
                            <label for="user_phone">Phone</label>
                            <input type="text" class="form-control required" name="user_phone" id="user_phone" data-msg-required="Please enter phone" placeholder="Phone">
                        </div>
                        <div class="col-md-6 col-sm-6 form-group">
                            <label for="user_phone">City</label>
                            <input type="text" class="form-control" name="user_city" id="user_city"  placeholder="City">
                        </div>
                        <div class="col-md-6 col-sm-6 form-group">
                            <label for="user_creatria">Are you looking to buy, sell or rent?</label>
                            <select class="form-control" name="user_creatria" id="user_creatria">
                                <option>None</option>
                                <option>Buy</option>
                                <option>Sell</option>
                                <option>Buy and Sell</option>
                                <option>Rent</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-6 form-group">
                            <label for="user_relator">Are you currently under contract with a REALTOR<sup>®</sup>?</label>
                            <select class="form-control" name="user_relator" id="user_relator">
                                <option>No</option>
                                <option>Yes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 loading-area text-center">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 form-group center">
                            <div id="signup-success" role="alert" class="success"></div>
                        </div>
                        <div class="col-md-12 col-sm-12 form-group center">
                            <button type="submit" class="btn btn-danger width-100 btn-signup"> Register Now </button>
                            <input type="hidden" class="Reqtype" value=""/>
                            <input type="hidden" class="mlsNum" value=""/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="modal" id="modal-popup-login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
                <div>
                    <b class="text-red font-16"> WELCOME </b><br/>
                    <span class="font-14">
                        Only Preferred Clients can browse sold listings.<br/>
                        Due to Ottawa Real Estate Board regulations, in order to see this information, you must
                        sign in or create a free account.<br/>
                        <b>Please sign in or register below.</b>
                        <br/>
                        <br/>
                    </span>
                </div>
                <div class="section-title">
                    <h3 class="margin-none">Login</h3>
                </div>
            </div>
            <div class="modal-body">
                <form id="frmLogin" method="post" role="form">
                    <div class="form-group">
                        <div id="login-error" role="alert" class="error"></div>
                        <div id="login-success" role="alert" class="success"></div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 col-sm-6 form-group">
                            <label for="user_email">Email</label>
                            <input type="email" class="form-control required" name="user_email" id="user_email" data-msg-required="Please enter email" placeholder="Email">
                        </div>
                        <div class="col-md-6 col-sm-6 form-group">
                            <label for="user_phone">Password</label>
                            <input type="password" class="form-control required" name="user_password" id="user_password" data-msg-required="Please enter password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12 loading-area text-center">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 form-group center">
                            <a href="javascript:void(0)" class="popup-modal-sm" data-target="forgot">Lost Password ?</a>
                        </div>
                        <div class="col-md-12 col-sm-12 form-group center">
                            <button type="submit" class="btn btn-danger width-100 btn-login"> Login </button>
                            <input type="hidden" class="Reqtype" value=""/>
                            <input type="hidden" class="mlsNum" value=""/>
                            <span>Don't have an account? </span> <a href="javascript:void(0)" class="popup-modal-sm" data-target="signup">Register</a>
                        </div>
                        <div>
                            <a href="<?php echo home_url() ?>">Go Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="modal" id="modal-popup-forgot" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="section-title"><h3 class="margin-none">Forgot Password</h3></div>
                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
            </div>
            <div class="modal-body">
                <p>Enter your sign in email where we will send you new generated password.</p>
                <form method="post" role="form" id="frmForgetPwd">
                    <div class="form-group">
                        <div id="forgot-error" role="alert" class="error"></div>
                        <div id="forgot-success" role="alert" class="success"></div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control input-sm required" data-msg-required="Please enter valid email" name="username" id="username" placeholder="Your email">
                        </div>
                        <!--end form-group-->

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 loading-area text-center" ></div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 form-group -text-center">
                            <button type="submit" class="btn btn-danger width-100 rounded-0 -btn-block btn-fwd">Send me new password</button>
                        </div>

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 form-group">
                            <p>Already a member? <a href="javascript:void(0)" class="popup-modal-sm" data-target="login">Login</a></p>
                        </div>
                    </div>
                </form>
                <!--end form-->
            </div>
        </div>
    </div>

</div>
<div class="modal" id="modal-popup-success" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">

                <form method="post" role="form" id="frmForgetPwd">
                    <div class="form-group">
                        <div id="success" role="alert" class="success"></div>
                    </div>
                    <div>
                        <a href="<?php echo home_url() ?>">Go Back</a>
                    </div>
                    <!--<div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 form-group">
                            <a href="javascript:void(0)" class="popup-modal-sm" data-target="login">Login</a></p>
                        </div>
                    </div>-->
                </form>
                <!--end form-->
            </div>
        </div>
    </div>

</div>
<?php if((isset($listing->info) && $listing->info->Status == 'Sold') || (isset($_GET['login']) && $_GET['login'] == true)){?>
    <script>
        var IsFullView;
        IsFullView = true;
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		<?php if(!isset($_SESSION['User_Logged']) || (isset($_SESSION['User_Logged']) && $_SESSION['User_Logged'] != true)){?>
        jQuery('#modal-popup-login').modal({backdrop: 'static', keyboard: false});
        jQuery('#modal-popup-success').modal({backdrop: 'static', keyboard: false});
        jQuery('#modal-popup-signup').modal({backdrop: 'static', keyboard: false});
        jQuery('#modal-popup-signup').modal("hide");



		<?php if((isset($_GET['success']) && $_GET['success'] == true)){ ?>
        jQuery("#modal-popup-success").modal("show");
        jQuery("#modal-popup-login").modal("hide");
        jQuery('#success').html('Thank You For Registering. Please Check Your Email For Your Username and Password.');
		<?php } else{?>
        jQuery("#modal-popup-success").modal("hide");
        jQuery("#modal-popup-login").modal("show");
        <?php }


		}else{ ?>
        jQuery('#messageModal').appendTo("body");
        if(typeof showModal !== "undefiened" && showModal == 1)
            jQuery("#messageModal").modal("show");

		<?php } ?>
    </script>
<?php } ?>