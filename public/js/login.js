jQuery(document).ready(function () {
    login();
    register();
    forgotpassword();
    jQuery('#account').on('click',function () {
        if(jQuery(this).hasClass('open'))
        {
            jQuery(this).removeClass('open');
        }
        else{
            jQuery(this).addClass('open');
        }

    });
    if(jQuery("#frmChangePassword").length)
    {
        jQuery("#frmChangePassword").validate({
            rules: {
                current_password: {required: true},
                new_password: {required: true,minlength: 6,maxlength: 15},
                retype_password: {required: true, equalTo: "#new_password"}
            },
            messages: {
                current_password: {required: "Please enter Current Password."},
                new_password: {required: "Please enter New Password.", minlength: "Password must be at least 6 characters long.", maxlength: "Password should not exceed more than 15 characters."},
                retype_password: {required: "Please retype New Password."}
            },

            invalidHandler: function() {
                //alert(validator1.numberOfInvalids() + " input(s) are invalid.\nPlease, check your all input(s).");
            }
        });
    }

    jQuery('.popup-modal-sm').unbind('click');
    jQuery('.popup-modal-sm').on('click',function(){

        var url = jQuery(this).attr('data-url');
        var type = jQuery(this).attr('data-target');


        //jQuery('#modal-popup-sm .modal-content').html('<p class="text-center"><br>Loading ...</p>');
        jQuery('#modal-popup-'+type).modal('show');


        if(type == 'signup')
        {
            jQuery('#modal-popup-login').modal('hide');
            jQuery('#modal-popup-forgot').modal('hide');
            register();
        }
        if(type == 'login')
        {
            jQuery("#modal-popup-success").modal('hide');
            jQuery('#modal-popup-signup').modal('hide');
            jQuery('#modal-popup-forgot').modal('hide');
            login();
        }
        if(type == 'forgot')
        {
            jQuery('#modal-popup-signup').modal('hide');
            jQuery('#modal-popup-login').modal('hide');
            forgotpassword();
        }
    });

});


/* sign in register popup*/



function login()
{
    if(jQuery("#frmLogin").length)
    {
        jQuery("#frmLogin").validate({

            submitHandler: function(form) {

                // jQuery("#frmLogin button[type=submit]").attr('disabled', 'disabled');

                var param = jQuery("#frmLogin").serializeArray();
                if(parent.jQuery("input[name='OnPage']").length)
                {
                    param['OnPage'] = parent.jQuery("input[name='OnPage']").val();
                }

                if(parent.jQuery("input[name='mlsNum']").length)
                {
                    param['mlsNum'] = parent.jQuery("input[name='mlsNum']").val();
                } // while we are not getting mls from url, need to fetch from hidden

                param.push({'name':'action','value':'webkits_login'});
                jQuery.post(ajaxurl, param).done(function( data )
                {
                    if(data.status == 'success')
                    {
                        jQuery('#modal-popup-login').modal('toggle');
                        listing = 'btn-map-sold';

                        if(IsFullView == true)
                        {
                            window.location.reload();
                        }
                        else{
                            window.location = data['login_url'];
                        }
                        jQuery("#property-listings").removeClass('blur');
                        jQuery("#search").removeClass('blur');
                    }
                    else{
                        jQuery("#login-error").html(data.msg);
                    }



                });
                //return false;

            }

        });
    }
}

function register()
{

    if(jQuery("#frmRegister").length)
    {
        jQuery("#frmRegister").validate({

            submitHandler: function(form) {

                jQuery("#frmRegister button[type=submit]").attr('disabled', 'disabled');

                var param = jQuery("#frmRegister").serializeArray();

                if(parent.jQuery("input[name='OnPage']").length)
                {
                    param['OnPage'] = parent.jQuery("input[name='OnPage']").val();
                }

                if(parent.jQuery("input[name='mlsNum']").length)
                {
                    param['mlsNum'] = parent.jQuery("input[name='mlsNum']").val();
                }
                // while we are not getting mls from url, need to fetch from hidden
                param.push({'name':'action','value':'webkits_register'});



                jQuery.post(ajaxurl, param).done(function( data )
                {

                    //console.log(data);
                    if(data.status == 'error') {
                        jQuery('#signup-error').html(data.msg)
                    }
                    else
                    {  var obj = JSON.parse(data);
                        jQuery('#signup-success').html(obj.msg);
                        jQuery("#frmRegister .btn-signup").hide();
                    }


                });

                //return false;
                // xajax_ListingAjaxCall('User', 'Signup', param);


            }

        });
    }
}

function forgotpassword()
{
    if(jQuery("#frmForgetPwd").length)
    {
        jQuery("#frmForgetPwd").validate({

            submitHandler: function(form) {

                //jQuery("#frmForgetPwd button[type=submit]").attr('disabled', 'disabled');

                var param = jQuery("#frmForgetPwd").serializeArray();
                param.push({'name':'action','value':'webkits_forgot'});
                jQuery.post(ajaxurl, param).done(function( data )
                {
                    if(data.status == 'success')
                    {
                        //jQuery('#modal-popup-forgot').modal('toggle');
                        jQuery("#frmForgetPwd").trigger("reset");
                        jQuery("#forgot-success").html(data.msg);
                    }
                    else{
                        jQuery("#forgot-error").html(data.msg);
                    }



                });


            }

        });
    }
}