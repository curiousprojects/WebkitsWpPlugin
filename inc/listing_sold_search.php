<form id="search" class="search-listing" method="POST" action="<?php if (isset($atts['redirect']) && $atts['redirect'] ==1 ){ echo get_post($options['webkits_sold_listings_page'])->guid;}?>">
	<div clas="row">
		<!--<div class="searcharrow">
			<img src="https://curiouscloud.ca/assets/images/home-search-arrow.png" alt="Search Arrow">
		</div>-->
	</div>
	<input name="wk-advanced" id="advancedValue" value="<?php if (isset($_POST['advanced'])) echo $_POST['advanced']; else echo 0; ?>"
	       type="hidden">
	<input name="wk-offset" value="<?php if (isset($_POST['offset'])) $_POST['offset']; else echo 0; ?> " type="hidden">

	<div class="flexible-div flexible-text">
		<input type="text" class="form-control search-input" name="wk-input" value="<?php echo $_POST['input_main']; ?>" id="usr-sold"
		       placeholder="Try searching Address, Street.">
        <input type="hidden" value="<?php echo $_POST['input_main']; ?>" name="wk-input_main" id="wk-input_main"/>
	</div>
	<div class="flexible-div width-element" id="s-property-type">
		<div class="search-select-wrap">
			<?php $input_property_type = (isset($_POST['input_property_type']) ? $_POST['input_property_type'] : 0); ?>
			<select class="form-control search-select " placeholder="" name="wk-input_property_type">
				<?php $options = get_option('webkits'); ?>
				<?php $bcAgent = isset($options['webkits_bc_agent']) ? $options['webkits_bc_agent'] : 0; ?>
				<option value="0" <?php if ($input_property_type==0 ) echo "selected"; ?> class="text">Property Type</option>
				<option value="1" <?php if ($input_property_type==1 ) echo "selected"; ?> class="text">Residential</option>
				<option value="2" <?php if ($input_property_type==2 ) echo "selected"; ?> class="text">Lots/Acreage</option>
				<option value="3" <?php if ($input_property_type==3 ) echo "selected"; ?> class="text">Multifamily</option>
				<option value="4" <?php if ($input_property_type==4 ) echo "selected"; ?> class="text">Commercial</option>
				<option value="5" <?php if ($input_property_type==5 ) echo "selected"; ?> class="text">Farm</option>
			</select>
		</div>
	</div>

	<div class="flexible-div width-element" id="s-bedroom">
		<div class="search-select-wrap">
			<select class="form-control search-select" name="wk-bedroom">
				<option style="color:gray" disabled selected hidden>Bedrooms</option>
				<?php for ($i = 1; $i <= 10; $i++) { ?>
					<option class="text" value="<?= $i; ?>" <?= isset($_POST[ 'bedroom']) && $_POST[ 'bedroom']== $i ? 'selected="selected"' : '' ?> >
						<?= $i; ?>
					</option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="flexible-div width-element" id="s-bathroom">
		<div class="search-select-wrap">
			<select class="form-control search-select" name="wk-bathroom">
				<option style="color:gray" disabled selected hidden>Bathrooms</option>
				<?php for ($i = 1; $i <= 10; $i++) { ?>
					<option class="text" value="<?= $i; ?>" <?= isset($_POST[ 'bathroom']) && $_POST[ 'bathroom']== $i ? 'selected="selected"' : '' ?> >
						<?= $i; ?>
					</option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="flexible-div width-element" id="s-price">
		<div class="search-select-wrap">
			<span id="advanced-search" class="btn search-input form-control search-select">Price</span>
		</div>
	</div>
	<div class="flexible-div width-element" id="s-search">
		<button class="submit-search" type="submit" name="pressed">Search</button>
	</div>
	<div class="flexible-div width-element" id="s-clear">
		<button class="submit-search" type="submit" name="clear">Clear</button>
	</div>

	<div class="hide" id="advanced-form">

		<div class="">
			<div class="flexible-div price-slider" style="">
				<input type="text" id='range-price' name="price" value="" />

			</div>

		</div>
	</div>
</form>

<form id="clearForm" method="post">
	<input type="hidden" name="wk-clear" value="Clear">
</form>

<?php
if(isset($_POST['price']))
	$mm = explode(';',$_POST['price']);
else $mm = array(0,1000);
?>

<script>
    jQuery(window).bind('load resize', function () {
        var search_listing = jQuery('.search-listing').outerWidth();
        var form_element_width = 0;
        jQuery('.width-element').each(function () {
            form_element_width += jQuery(this).outerWidth();
        });
        jQuery('.flexible-text').width(search_listing - form_element_width - 30 + 'px');
    });
    jQuery( document ).ready(function() {
        jQuery("#range-price").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: <?= $mm[0]?>,
            to: <?= $mm[1]?>,
            prefix: "$",
            step: 50,
            max_postfix: "M+",
            prettify_enabled: true,
            prettify: function (num) {
                if(num == 1000) return 1;
                else return num+"k";
            }
        });


        jQuery( "#usr-sold" ).autocomplete({
            source: function( request, response ) {

                jQuery.post(ajaxurl, {term: request.term,onlyshow:'<?php echo $_POST['onlyshow'] ?>', action: "webkits_get_addresses"}).done(function (data) {

                    response(data);
                });
            },
            minLength: 2,
            select: function( event, ui ) {
                    jQuery('#wk-input_main').val(ui.item.value);

                //setTimeout(function(){  jQuery('#search').submit(); }, 1000);
               // console.log( "Selected: " + ui.item.value + " aka " + ui.item.id );
            }
        } ).data("ui-autocomplete")._renderItem = function (ul, item) {
            var newText = String(item.value).replace(
                new RegExp(this.term, "gi"),
                "<span class='ui-state-highlight'>$&</span>");

            return jQuery("<li></li>")
                .data("item.autocomplete", item)
                .append("<div>" + newText + "</div>")
                .appendTo(ul);
    }} );




</script>