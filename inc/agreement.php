<!-- Modal --><?php if($_SESSION['listing'] != ''){?>    <div>        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index:1400" data-backdrop="static" data-keyboard="false">            <div class="modal-dialog" role="document">                <div class="modal-content">                    <div class="modal-body">						<?php print_r($_SESSION['webkits-accept']); ?>                        <p><b>REALTOR</b>®, <b>REALTORS</b>®, and the <b>REALTOR</b>® logo are certification marks that are owned by <b>REALTOR</b>® Canada Inc. and licensed exclusively to The Canadian Real Estate Association (CREA). These certification marks identify real estate professionals who are members of CREA and who must abide by CREA’s By-Laws, Rules, and the <b>REALTOR</b>® Code. The <b>MLS</b>® trademark and the <b>MLS</b>® logo are owned by CREA and identify the quality of services provided by real estate professionals who are members of CREA.                        </p>                        <p>The information contained on this site is based in whole or in part on information that is provided by members of The Canadian Real Estate Association, who are responsible for its accuracy. CREA reproduces and distributes this information as a service for its members and assumes no responsibility for its accuracy.                        </p>                        <p>This web site is owned and operated by <b><?php     bloginfo( 'name'); ?></b> who is a member of The Canadian Real Estate Association.                        </p><p>                            The listing content on this website is protected by copyright and other laws, and is intended solely for the private, non-commercial use by individuals. Any other reproduction, distribution or use of the content, in whole or in part, is specifically forbidden. The prohibited uses include commercial use, “screen scraping”, “database scraping”, and any other activity intended to collect, store, reorganize or manipulate data on the pages produced by or displayed on this website.                        </p>  </div>                    <div class="modal-footer">                        <a href="/"  class="btn btn-default" rel="noindex, nofollow">I Don't Agree</a>                        <span id="accept"  class="btn btn-primary">I Agree</span>                    </div>                </div>            </div>        </div>    </div><?php } ?><?php if($_SESSION['listing'] != ''){?>    <script>        showModal = <?php if ((isset($_SESSION['webkits-accept']) && $_SESSION['webkits-accept'] == 1 ) || isset($webkitsIgnore) ) echo 0; else echo 1; ?>;        jQuery(document).ready(function() {			<?php if($listing->info->Status != 'Sold'){?>            jQuery('#messageModal').appendTo("body");            if(typeof showModal !== "undefined" && showModal == 1)                jQuery("#messageModal").modal("show");			<?php } ?>        });        jQuery("#accept").click(function(e) {            e.preventDefault();            jQuery.post('<?= admin_url('admin-ajax.php'); ?>', {data: 1, action: "webkits_accept_crea"}, function (data) {                jQuery("#messageModal").modal("hide");                /*if(typeof showModal !== "undefiened" && showModal == 1)					jQuery("#messageModal").modal("show");*/            });        });    </script><?php } ?><?php if($_SESSION['listing'] == ''){?>    <script>        jQuery(document).ready(function() {            jQuery('.n-avaliable').closest('section').siblings().not('section:last,section:first').html('');        });    </script><?php }?><?php if(isset($listing->info->Status) && $listing->info->Status == 'Sold'){?>    <script>        var IsFullView;        IsFullView = true;		<?php if(!isset($_SESSION['User_Logged']) || (isset($_SESSION['User_Logged']) && $_SESSION['User_Logged'] != true)){?>        jQuery('#modal-popup-login').modal({backdrop: 'static', keyboard: false});        jQuery('#modal-popup-signup').modal({backdrop: 'static', keyboard: false});        jQuery('#modal-popup-signup').modal("hide");        jQuery("#modal-popup-login").modal("show");		<?php if(isset($_GET['success']) && $_GET['success'] == true){ ?>        jQuery('#login-success').html('Your account is activated successfully, Please check your email for username and password.   ');		<?php } }else{ ?>        jQuery('#messageModal').appendTo("body");        if(typeof showModal !== "undefiened" && showModal == 1)            jQuery("#messageModal").modal("show");		<?php } ?>    </script><?php } ?><style>    .n-avaliable    {        color:red;        width:100%;        text-align:center;        margin-bottom:20px;    }    #map{        width: auto !important;        height: auto !important;    }</style>