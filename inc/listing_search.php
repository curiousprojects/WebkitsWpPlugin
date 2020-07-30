<form id="search" class="search-listing searcharrow" method="post" action="<?php if (isset($atts['redirect']) && $atts['redirect'] ==1 ){ echo get_post($options['webkits_listings_page'])->guid;}?>">

	<input name="wk-advanced" id="advancedValue" value="<?php if (isset($_POST['advanced'])) echo $_POST['advanced']; else echo 0; ?>"
	    type="hidden">
	<input name="wk-offset" value="<?php if (isset($_POST['offset'])) $_POST['offset']; else echo 0; ?> " type="hidden">

	<div class="flexible-div flexible-text">
		<input type="text" class="form-control search-input" name="wk-input_main" value="<?php echo $_POST['input_main']; ?>" id="usr"
		    placeholder="Try searching Listing ID, Street, Pool etc.">
	</div>
	<div class="flexible-div width-element" id="property_type">
		<div class="search-select-wrap">
			<?php $input_property_type = (isset($_POST['input_property_type']) ? $_POST['input_property_type'] : 0); ?>
			<select  class="form-control search-select " placeholder="" name="wk-input_property_type">
				<?php $options = get_option('webkits'); ?>
				<?php $bcAgent = isset($options['webkits_bc_agent']) ? $options['webkits_bc_agent'] : 0; ?>
				<option value="0" <?php if ($input_property_type==0 ) echo "selected"; ?> class="text">Property Type</option>
				<option value="1" <?php if ($input_property_type==1 ) echo "selected"; ?> class="text">Homes for Sale</option>
				<option value="2" <?php if ($input_property_type==2 ) echo "selected"; ?> class="text">Carriage Trade</option>
				<option value="3" <?php if ($input_property_type==3 ) echo "selected"; ?> class="text">Commercial</option>
				<option value="4" <?php if ($input_property_type==4 ) echo "selected"; ?> class="text">Farm</option>
				<option value="5" <?php if ($input_property_type==5 ) echo "selected"; ?> class="text">Lot</option>
				<option value="6" <?php if ($input_property_type==6 ) echo "selected"; ?> class="text">
					<?php echo ($bcAgent == 1 ? 'Strata' : 'Condo'); ?>
				</option>
				<option value="7" <?php if ($input_property_type==7 ) echo "selected"; ?> class="text">Multi-family</option>
				<option value="8" <?php if ($input_property_type==8 ) echo "selected"; ?> class="text">Recreational</option>
				<option value="9" <?php if ($input_property_type==9 ) echo "selected"; ?> class="text">Exclusive</option>
				<option value="10" <?php if ($input_property_type==10 ) echo "selected"; ?> class="text">Mobile</option>
			</select>
		</div>
	</div>

	<div class="flexible-div width-element" id="transaction_type">
		<div class="search-select-wrap">
			<?php $input_transaction_type = (isset($_POST['input_transaction_type']) ? $_POST['input_transaction_type'] : 0); ?>
			<select class="form-control search-select " name="wk-input_transaction_type">
				<option class="text" value="0" <?php if ($input_transaction_type==0 ) echo "selected"; ?>>Buy or Lease</option>
				<option class="text" value="1" <?php if ($input_transaction_type==1 ) echo "selected"; ?>>For Lease</option>
				<option class="text" value="2" <?php if ($input_transaction_type==2 ) echo "selected"; ?>>For Sale</option>
			</select>
		</div>
	</div>
                    <?php $input_sort_by = (isset($_POST['input_sort_by']) ? $_POST['input_sort_by'] : 0); ?>
    <input type="hidden" name="wk-input_sort_by" class="input-sort-by" value="<?php echo $input_sort_by ?>">
    <input type="hidden" name="wk-input_sort_search" class="input-sort-search" value="false">
	<div class="flexible-div width-element" id="bedroom">
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
	<div class="flexible-div width-element" id="bathroom">
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
	<div class="flexible-div width-element" id="price">
		<div class="search-select-wrap">
			<span id="advanced-search" class="btn search-input form-control search-select">Price</span>
		</div>
	</div>
    
	<div class="flexible-div width-element" id="serch-btn">
		<button class="submit-search list-search" type="submit" name="pressed">Search</button>
	</div>
	<div class="flexible-div width-element" id="clear-btn">
		<button class="submit-search" type="submit" name="clear">Clear</button>
	</div>
	<a class="search-input--what">What can I search?</a>
	<div class="hide search-input--what-content">
		<div class="row">
			<div class="col-xs-12 search-input--what-content-intro">You can search the following property details:
				<br />
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<ul>
					<li>Listing ID</li>
					<li>Property Address</li>
					<li>Street Name</li>
					<li>City or Town</li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<ul>
					<li>Agent Name</li>
					<li>Property Details: i.e. pool, Forced air, Hardwood, Waterfront</li>

				</ul>
			</div>
		</div>

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
		jQuery('.flexible-text').width(search_listing - form_element_width - 32 + 'px');
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
});
</script>