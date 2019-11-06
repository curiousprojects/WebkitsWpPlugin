<?php if($options['webkits_enable_sold'] == SOLD_PASSWORD){?>
	<?php if(isset($_SESSION['User_Logged']) && $_SESSION['User_Logged'] == true){?>
        <a href="/<?php echo get_post($options['webkits_sold_listings_page'])->post_name ?>" id="sold" class="btn btn-lg bg-red text-white" >SEARCH RECENT SOLDS</a>
	<?php }else{ ?>
        <a href="javascript:void(0)" id="sold" class="btn btn-lg bg-red text-white popup-modal-sm" data-url="register.php" data-target="login">SEARCH RECENT SOLDS</a>
	<?php }}?>
<script>
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>

