
<?php  foreach($agent->agent->photos as $row){ ?>
    <a class="fancybox-button" rel="fancybox-button" href="<?php echo $dbHost; ?>agents_photos/<?php echo $row->photos?>" title="">
        <img src="<?php echo $dbHost; ?>agents_photos/<?php echo $row->photos?>" alt="" height="200px" width="200px" />
    </a>

<?php } ?>
<script type="application/javascript">
    jQuery(document).ready(function() {
        jQuery(".fancybox-button").fancybox({
            openEffect	: 'none',
            closeEffect	: 'none'
        });
});


</script>
