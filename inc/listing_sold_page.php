<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>-->

<div class="clearfix"></div>

<div class="container-fluid">


	<div class="container-fluid container-pad property-listings" id="property-listings">

		<input name="viewtype" id="viewtype" value="<?php if (isset($_POST['viewtype'])) echo $_POST['viewtype']; else echo "grid"; ?>" type="hidden">
		<?php if($creb == true && $ll_apikey != '')
		{?>
			<div class="flexible-div width-element" id="ll-lifestyle">
				<button class="submit-search" type="submit" name="pressed" id="local-lifestyle">Life Style <span id="llcount">0</span></button>
				<section class="ll-search">
					<div id="local-search" class="d-none"></div>
				</section>
			</div>
		<?php }?>
		<div class="row buttonslisting">
			<div class="btn-group pull-right">
                <a href="/<?php echo get_post($options['webkits_listings_page'])->post_name ?>" id="sold" class="btn btn-default btn-sm">SEARCH ACTIVE</a>
				<a href="#" id="grid" class="grid btn btn-default btn-sm">Grid</a>
				<a href="#" id="list" class="list btn btn-default btn-sm">List</a>
				<a href="#" id="table" class="btn-table btn btn-default btn-sm">Table</a>
				<a href="#" id="map" class="btn-map-sold btn btn-default btn-sm">Map</a>

                <?php if(isset($_SESSION['User_Logged']) && $_SESSION['User_Logged'] == true)
                {?>
                    <div class="dropdown" id="account">
                        <img src="<?php echo plugin_dir_url(__FILE__)?>../public/img/webkits-icon1.png" height="22"/> <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Account
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="<?php echo home_url()?>/change-password">CHANGE PASSWORD</a></li>
                            <li><a href="<?php echo home_url()?>/edit-profile">EDIT PROFILE</a></li>
                            <li><a href="<?php echo home_url()?>/logout">LOGOUT</a></li>

                        </ul>
                    </div>
                <?php }?>
			</div>
		</div>

		<div class="row listingSelection listings-grid hide" id="listings-grid">
			<?php
			session_start();

			if(isset($_POST['advanced'])){
				//print_r($_POST);
				$_SESSION['webkit-sold-search'] = $_POST;
				//print_r($_SESSION['webkit-search']);
			}

			//print_r($_SESSION['webkit-searcha']);


			?>

			<?php  if(isset($Is_Search) && $Is_Search == true){
			        if($listings->totals->Showing > 0 ){
			            foreach ($listings->listing as $l) { ?>
				<?php //if($l->info->Building->Type != 'Apartment') continue; ?>
				<?php //echo '>>' . $l->info->PropertyType; ?>

				<div class="col-sm-4">
					<a href="<?php
					$link = ($l->info->UnparsedAddress == '') ? 'none' : (str_replace(" ", "-", $l->info->UnparsedAddress));
					echo "/property/" . $l->info->ListingKey . '/' . $link . '/' . $l->info->City; ?>">
						<div class="grid-box">
							<div class="grid-overlay">
								<?php if ($l->info->ct != '') { ?>
									<img class="grid-banner" src="https://curiouscloud.ca/assets/images/<?php echo $l->info->ct; ?>.png">
								<?php } ?>
								<div class="grid-image">
									<img src="https://curiouscloud.ca<?php echo $l->info->photo; ?>"/>
								</div>
							</div>
							<div class="grid-address">
								<span><?php if($l->info->ShowPrice == 1) {echo "<b class='text-red'>SOLD FOR </b>$".$l->info->ClosePrice;} ?></span>
								<span><?php echo strtoupper($l->info->UnparsedAddress); ?>
									<br/><?php echo strtoupper($l->info->City); ?></span>
								<?php if($creb == true && $ll_apikey != '')
								{
									if($l->info->lat != '' &&  $l->info->lng !='')
										?>

										<span
										class="match-score ll-match-score " style="padding: 0 10px 0 0 !important;"
										data-id="<?php echo $l->info->ListingKey ?>"
									<?php if($l->info->lat != ''){echo "data-lat=".$l->info->lat; }?>
									<?php if($l->info->lng != ''){echo "data-lng=".$l->info->lng; }?>>
									</span>
								<?php }?>
							</div>

							<div class="text-center p-t">
								<?php if((strpos($l->info->AlternateURL->VideoLink, 'youriguide.com') != false) || (strpos($l->info->AlternateURL->VideoLink, 'matterport.com') != false))
								{
									?>
                                    <img src="<?php echo plugin_dir_url(__FILE__) ?>../public/img/360.png "/>
								<?php }
								else if((strpos($l->info->AlternateURL->VideoLink, 'www.youtube.com') != false) || (strpos($l->info->AlternateURL->VideoLink, 'youtu.be') != false))
								{
									?>
                                    <img src="<?php echo plugin_dir_url(__FILE__) ?>../public/img/Youtube.png "/>
								<?php } ?>
							</div>
						</div>
					</a>
				</div>
			<?php }}else{?>
                <p class="text-align-center">
                 <b class="error">Sorry Could not find any results</b>
                </p>
            <?php }}else{?>
            <p class="text-align-center">
                <b>Search Address Or Street to start.</b>
            </p>
            <?php }?>

		</div>

		<div class="row listingSelection hide" id="listings-list">
			<?php if(isset($Is_Search) && $Is_Search == true){
			    if($listings->totals->Showing > 0) {
			        foreach ($listings->listing as $l) { ?>
                    <div class="row list-row">
                        <a href="<?php
						$link = ($l->info->UnparsedAddress == '') ? 'none' : (str_replace(" ", "-", $l->info->UnparsedAddress));
						echo "/property/" . $l->info->ListingKey . '/' . $link . '/' . $l->info->City; ?>">
                            <div class="col-sm-5 list-image-box">
                                <div class="list-overlay">


                                    <div class="list-image">
                                        <img src="https://curiouscloud.ca<?php echo $l->info->photo; ?>"/>
                                    </div>
									<?php if ($l->info->ct != '') { ?>
                                        <div class="list-banner"><img src="https://curiouscloud.ca/assets/images/<?php echo $l->info->ct; ?>.png" /> </div>
									<?php } ?>
                                </div>

                            </div>
                            <div class="col-sm-7">
                                <br/>
                                <div class="col-sm-12">
                                    <div class="list-price col-sm-5"><b class="text-red">SOLD FOR</b> $<?php echo $l->info->ClosePrice; ?><br/>
                                        <span><?php echo $l->info->beds; ?><?php echo $l->info->baths; ?></span></div>
                                    <div class="list-address pull-right"> <?php echo strtoupper($l->info->UnparsedAddress); ?>
                                        <br/><?php echo strtoupper($l->info->City); ?> </div>
                                </div>
                                <div class="col-sm-12 list-text">
									<?php echo $l->info->excerpt; ?><br/>
                                    <div class="list-broker text-center p-t">
	                                    <?php if((strpos($l->info->AlternateURL->VideoLink, 'youriguide.com') != false) || (strpos($l->info->AlternateURL->VideoLink, 'matterport.com') != false))
	                                    {
		                                    ?>
                                            <img src="<?php echo plugin_dir_url(__FILE__) ?>../public/img/360.png "/>
	                                    <?php }
	                                    else if((strpos($l->info->AlternateURL->VideoLink, 'www.youtube.com') != false) || (strpos($l->info->AlternateURL->VideoLink, 'youtu.be') != false))
	                                    {
		                                    ?>
                                            <img src="<?php echo plugin_dir_url(__FILE__) ?>../public/img/Youtube.png "/>
	                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
				<?php }}else{?>
                    <p class="text-align-center">
                        <b class="error">Sorry Could not find any results</b>
                    </p>
			    <?php }}else{?>
                <p class="text-align-center">
                    <b>Search Address Or Street to start.</b>
                </p>
			<?php }?>
		</div>

		<div class="row listingSelection " id="listings-map">
			<?php if(isset($Is_Search) && $Is_Search == false){?>
                <div class="map-message">Search Address Or Street to start.</div>

			<?php } else if($listings->totals->Showing == 0) { ?>
                <div class="map-message">
                    <b>Sorry Could not find any results</b>
                </div>
			<?php }?>
			<div class="item rounded dark">

				<div id="map_canvas_1" class="map rounded map_canvas"></div>

				<div class="" id="map-loading">
                    <img src="<?php echo plugin_dir_url(__FILE__)?>../public/img/webktgif.gif" height="22" class="loading"/>
					<!--<div class="progress-bar progress-bar-striped active" role="progressbar"
					     aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">

					</div>-->
				</div>

			</div>

		</div>
		<?php if($listings->totals->Showing > 0) { ?>
        <div id="radios" class="item radios gradient rounded shadow" style=""></div>

        <?php } ?>

		<div class="row listingSelection hide list-table" id="listings-table">
			<div class="col-sm-12">
                <?php if(isset($Is_Search) && $Is_Search == true){
                    if($listings->totals->Showing > 0){?>
                <table class="table table-hover table-responsive table-bordered listing-table">
                    <thead>
                    <tr>
                        <th class="col-sm-4">Address</th>
                        <th>Price</th>
                        <th>Bed</th>
                        <th>Bath</th>
                        <th>SqFt</th>
                        <th>Area</th>
                        <th>Sub Area</th>
                        <th>Brokerage</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($listings->listing as $l) { ?>
                        <tr>
                            <td>
                                <a href="<?php
								$link = ($l->info->UnparsedAddress == '') ? 'none' : (str_replace(" ", "-", $l->info->UnparsedAddress));
								echo "/property/" . $l->info->ListingKey . '/' . $link . '/' . $l->info->City; ?>">
                                    <div class="col-sm-5">
                                        <div class="listing-table-image">
                                            <img src="https://curiouscloud.ca<?php echo $l->info->photo; ?>"/>
                                        </div>
                                    </div>

                                    <div class="col-sm-7 listing-table-address"> <?php echo strtoupper($l->info->UnparsedAddress); ?></div>
                                </a></td>
                            <td><div class="text-red">SOLD FOR</div>$<?php echo($l->info->ClosePrice); ?></td>
                            <td><?php if (isset($l->info->Building->BedroomsTotal) && $l->info->Building->BedroomsTotal > 0) echo($l->info->Building->BedroomsTotal); else echo "-"; ?></td>
                            <td><?php if (isset($l->info->Building->BathroomTotal) && $l->info->Building->BathroomTotal > 0) echo($l->info->Building->BathroomTotal); else echo "-"; ?></td>
                            <td><?php echo($l->info->Land->SizeTotalText); ?></td>
                            <td><?php echo($l->info->City); ?> </td>
                            <td><?php echo($l->info->Address->Neighbourhood); ?> </td>
                            <td><?php

								if (isset($l->info->AgentDetails->Office->Name))
									echo($l->info->AgentDetails->Office->Name);

								if (is_array($l->info->AgentDetails))
									echo($l->info->AgentDetails[0]->Office->Name);

								?>
                            </td>
                        </tr>
					<?php }}else{?>
                        <p class="text-align-center">
                            <b class="error">Sorry Could not find any results</b>
                        </p>
					<?php }}else{?>
                        <p class="text-align-center">
                            <b>Search Address Or Street to start.</b>
                        </p>
					<?php }?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row topadd">
			<ul id="listings_pagination" class="pagination pull-right<?php if ($_SESSION['webkits-view'] == 'map') { ?> hide<?php } ?>">
				<?php echo renderNavigation(3, $listings->totals->Found / $listingPerPage, $CurrentPage); ?>
			</ul>
		</div>
	</div>
</div>


<script>

    var Is_Search = <?php if(isset($Is_Search) && $Is_Search == true){echo $Is_Search;} else{ ?>false<?php } ?>;
    <?php if(!isset($_SESSION['User_Logged']) || (isset($_SESSION['User_Logged']) && $_SESSION['User_Logged'] != true)){?>
        var IsUserLogged = false;
    jQuery('#modal-popup-login').modal({backdrop: 'static', keyboard: false});
    jQuery('#modal-popup-signup').modal({backdrop: 'static', keyboard: false});
    jQuery('#modal-popup-success').modal({backdrop: 'static', keyboard: false});
    jQuery('#modal-popup-signup').modal("hide");
    jQuery("#modal-popup-login").modal("hide");
    jQuery("#modal-popup-success").modal("show");
    jQuery("#property-listings").addClass('blur');
    jQuery("#search").addClass('blur');
    <?php if((isset($_GET['success']) && $_GET['success'] == true)){ ?>
    jQuery("#modal-popup-success").modal("show");
    jQuery("#modal-popup-login").modal("hide");
    jQuery('#success').html('Thank You For Registering. Please Check Your Email For Your Username and Password.');
    <?php } else{?>
    jQuery("#modal-popup-success").modal("hide");
    jQuery("#modal-popup-login").modal("show");
    <?php }
?>
    <?php if(isset($_GET['error']) && $_GET['error'] == true){ ?>
	    jQuery('#success').html('Your account is already activated.');
    <?php } } ?>

    realurl = '<?php echo get_post($options['webkits_listing_page'])->guid; ?>';

    listing = '<?php  if($_POST['onlyshow'] && $_POST['onlyshow'] != ''){ echo 'grid'; }else { echo 'btn-map-sold'; } ?>';
    onlyshow = '<?php  if($_POST['onlyshow'] && $_POST['onlyshow'] != ''){ echo $_POST['onlyshow']; }else { false;} ?>';

    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

    markers = <?php echo json_encode($listings->markers) . ";";?>
	<?php
	if (isset($options['webkits_map_style']) && $options['webkits_map_style'] != '') {
		echo "var styler = " . str_replace('\"', '"', $options['webkits_map_style']) . ";
";
	} else {
		echo "var styler = '';
";
	}

	if (!isset($options['webkits_latlng'])) {
		echo "var dlatlng ='45.420297,-75.692362';
";
	} else {

		echo "var dlatlng ='{$options['webkits_latlng']}';";
	}

	if(isset($_POST['input_main']) && !empty($_POST['input_main']))
		echo "var searched = true;";
	else echo "var searched = false;";

	if (!isset($options['webkits_map_zoom2']) || $options['webkits_map_zoom2'] == 0) {
		echo "var mzoom = 6;
        var mbound = true;
";
	} else {
		echo "var mzoom ={$options['webkits_map_zoom2']};
        var mbound = false;
";
	}
	?>
</script>

