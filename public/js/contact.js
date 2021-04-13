jQuery(document).ready(function () {

    contact();

    jQuery(".modal-contact").unbind("click");
    jQuery(".modal-contact").on("click", function () {

        jQuery("#modal-popup-contact").modal("show");
    });
});

function contact()
{

    if(jQuery("#frmContact").length) {
        jQuery("#frmContact").validate({

            submitHandler: function (form) {
                jQuery("#frmContact button[type=submit]").attr("disabled", "disabled");

                var param = jQuery("#frmContact").serializeArray();

                param.push({"name":"action","value":"webkits_contact"});

                jQuery.post(ajaxurl, param).done(function( data ) {



                   var obj = JSON.parse(data);
                     console.log(obj);
                    if(obj.status == 'error') {
                        jQuery('#contact-error').html(obj.msg);

                    }
                    else
                    {
                        jQuery('#contact-error').html('');
                        jQuery('#contact-success').html(obj.msg);

                    }
                    jQuery("#frmContact button[type=submit]").removeAttr('disabled');
                });

            }
        });
    }

    if(jQuery("#frmListing").length) {


        jQuery("#frmListing").validate({

            submitHandler: function (form) {
                grecaptcha.execute();


            }
        });
    }
}
function ajax_listing(ajaxurl,param)
{
    jQuery.post(ajaxurl, param).done(function( data ) {



        var obj = JSON.parse(data);

        if(obj.status == 'error') {
            jQuery('#contact-error').html(obj.msg);

        }
        else
        {
            jQuery('#contact-error').html('');
            jQuery('#contact-success').html(obj.msg);

        }
        $('#frmListing').trigger("reset");

        jQuery("#frmListing button[type=submit]").removeAttr
        ('disabled');

    });

}
function submit_form(token)
{
    jQuery("#frmListing button[type=submit]").attr("disabled", "disabled");

    var param = jQuery("#frmListing").serializeArray();

    param.push({"name":"action","value":"webkits_listing"});

    setTimeout(function(){ ajax_listing(ajaxurl,param); }, 1000);
}