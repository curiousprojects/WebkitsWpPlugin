function login(){jQuery("#frmLogin").length&&jQuery("#frmLogin").validate({submitHandler:function(e){var r=jQuery("#frmLogin").serializeArray();parent.jQuery("input[name='OnPage']").length&&(r.OnPage=parent.jQuery("input[name='OnPage']").val()),parent.jQuery("input[name='mlsNum']").length&&(r.mlsNum=parent.jQuery("input[name='mlsNum']").val()),r.push({name:"action",value:"webkits_login"}),jQuery.post(ajaxurl,r).done(function(e){"success"==e.status?(jQuery("#modal-popup-login").modal("toggle"),listing="btn-map-sold",1==IsFullView?window.location.reload():window.location=e.home_url+"/sold-listings",jQuery("#property-listings").removeClass("blur"),jQuery("#search").removeClass("blur")):jQuery("#login-error").html(e.msg)})}})}function register(){jQuery("#frmRegister").length&&jQuery("#frmRegister").validate({submitHandler:function(e){jQuery("#frmRegister button[type=submit]").attr("disabled","disabled");var r=jQuery("#frmRegister").serializeArray();parent.jQuery("input[name='OnPage']").length&&(r.OnPage=parent.jQuery("input[name='OnPage']").val()),parent.jQuery("input[name='mlsNum']").length&&(r.mlsNum=parent.jQuery("input[name='mlsNum']").val()),r.push({name:"action",value:"webkits_register"}),jQuery.post(ajaxurl,r).done(function(e){if("error"==e.status)jQuery("#signup-error").html(e.msg);else{var r=e;jQuery("#signup-success").html(r.msg),jQuery("#frmRegister .btn-signup").hide()}})}})}jQuery(document).ready(function(){login(),register(),jQuery("#frmChangePassword").length&&jQuery("#frmChangePassword").validate({rules:{current_password:{required:!0},new_password:{required:!0,minlength:6,maxlength:15},retype_password:{required:!0,equalTo:"#new_password"}},messages:{current_password:{required:"Please enter Current Password."},new_password:{required:"Please enter New Password.",minlength:"Password must be at least 6 characters long.",maxlength:"Password should not exceed more than 15 characters."},retype_password:{required:"Please retype New Password."}},invalidHandler:function(){}}),jQuery(".popup-modal-sm").unbind("click"),jQuery(".popup-modal-sm").on("click",function(){jQuery(this).attr("data-url");var e=jQuery(this).attr("data-target");jQuery("#modal-popup-"+e).modal("show"),"signup"==e&&(jQuery("#modal-popup-login").modal("hide"),register()),"login"==e&&(jQuery("#modal-popup-signup").modal("hide"),login())})});