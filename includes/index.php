<script>

<?php if(isset($_GET['login']) && $_GET['login'] == true){?>
    <script>
        var IsFullView;
        IsFullView = true;
		<?php if(!isset($_SESSION['User_Logged']) || (isset($_SESSION['User_Logged']) && $_SESSION['User_Logged'] != true)){?>
        jQuery('#modal-popup-login').modal({backdrop: 'static', keyboard: false});
        jQuery('#modal-popup-signup').modal({backdrop: 'static', keyboard: false});
        jQuery('#modal-popup-signup').modal("hide");
        jQuery("#modal-popup-login").modal("show");

		<?php if((isset($_GET['success']) && $_GET['success'] == true)){ ?>
        jQuery('#login-success').html('Your account is now activated. Please check your email for your VOW Login User name and password.');
		<?php } }else{ ?>
        jQuery('#messageModal').appendTo("body");
        if(typeof showModal !== "undefiened" && showModal == 1)
            jQuery("#messageModal").modal("show");

		<?php } ?>
    </script>
<?php } ?>
</script>