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
                <a href="#" id="grid" class="grid btn btn-default btn-sm">Grid</a>
                <a href="#" id="list" class="list btn btn-default btn-sm">List</a>
                <a href="#" id="table" class="btn-table btn btn-default btn-sm">Table</a>
                <a href="#" id="map" class="btn-map btn btn-default btn-sm">Map</a>
                    <?php if($options['webkits_enable_sold'] == SOLD_PASSWORD){?>
	            <?php if(isset($_SESSION['User_Logged']) && $_SESSION['User_Logged'] == true){?>
                    <a href="/<?php echo get_post($options['webkits_sold_listings_page'])->post_name ?>" id="sold" class="btn btn-default btn-sm" >SEARCH RECENT SOLDS</a>
	            <?php }else{ ?>
                    <a href="javascript:void(0)" id="sold" class="btn btn-default btn-sm popup-modal-sm" data-url="register.php" data-target="login">SEARCH RECENT SOLDS</a>
	            <?php }}?>

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

        <div class="row listingSelection listings-grid" id="listings-grid">
	        <?php
		        session_start();

				if(isset($_POST['advanced'])){
					//print_r($_POST);
					$_SESSION['webkit-search'] = $_POST;
					//print_r($_SESSION['webkit-search']);
				}

				//print_r($_SESSION['webkit-searcha']);


	        ?>

            <?php foreach ($listings->listing as $l) { ?>
            <?php //if($l->info->Building->Type != 'Apartment') continue; ?>
            <?php //echo '>>' . $l->info->PropertyType; ?>

                <div class="col-sm-4">
                    <a href="<?php
                        $link = ($l->info->UnparsedAddress == '') ? 'none' : (str_replace(" ", "-", $l->info->UnparsedAddress));
                    echo "/property/" . $l->info->ListingKey . '/' . $link . '/' . $l->info->City; ?>">
                        <div class="grid-box">
                            <div class="grid-overlay">
                               <!-- <?php /*if ($l->info->ct != ''){ */?>
                                    <img class="grid-banner" src="https://curiouscloud.ca/assets/images/<?php /*echo $l->info->ct; */?>.png">
                                <?php /*} */?>
                                <div class="grid-image">
                                <img class="grid-banner" src="https://curiouscloud.ca<?php /*echo $l->info->photo; */?>"/>
                                </div>-->

                                <?php if (is_array($l->info->Photo->PropertyPhoto) && isset($l->info->Photo->PropertyPhoto[0]->LargePhotoURL) && $l->info->Photo->PropertyPhoto[0]->LargePhotoURL != ''){ ?>
                                    <div class="grid-image">
                                        <img class="grid-banner" src="<?php echo $l->info->Photo->PropertyPhoto[0]->LargePhotoURL; ?>"/>
                                    </div>
                                <?php }elseif (!is_array($l->info->Photo->PropertyPhoto) && isset($l->info->Photo->PropertyPhoto->LargePhotoURL) && $l->info->Photo->PropertyPhoto->LargePhotoURL != ''){ ?>
                                    <div class="grid-image">
                                        <img class="grid-banner" src="<?php echo $l->info->Photo->PropertyPhoto->LargePhotoURL; ?>"/>
                                    </div>
                                <?php }else{ ?>
                                    <div class="grid-image">
<!--                                        <img class="grid-banner" src="https://curiouscloud.ca--><?php //echo $l->info->photo; ?><!--"/>-->
                                        <img class="grid-banner" src="<?php echo $l->info->photo; ?>"/>
                                    </div>
                                <?php } ?>



                            </div>
                            <div class="grid-address">
                                <span><?php if($l->info->ShowPrice == 1) {echo $l->info->ListPrice;} ?></span>
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

                            <div class="grid-broker">
                                <?php if (!$hideAgent) echo $l->info->agent; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>

        <div class="row listingSelection hide" id="listings-list">
            <?php foreach ($listings->listing as $l) { ?>
                <div class="row list-row">
                <a href="<?php
                        $link = ($l->info->UnparsedAddress == '') ? 'none' : (str_replace(" ", "-", $l->info->UnparsedAddress));
                    echo "/property/" . $l->info->ListingKey . '/' . $link . '/' . $l->info->City; ?>">
                                            <div class="col-sm-5 list-image-box">
                            <div class="list-overlay">
                                <?php if (is_array($l->info->Photo->PropertyPhoto) && isset($l->info->Photo->PropertyPhoto[0]->LargePhotoURL) && $l->info->Photo->PropertyPhoto[0]->LargePhotoURL != ''){ ?>
                                    <div class="list-image">
                                        <img class="list-banner" src="<?php echo $l->info->Photo->PropertyPhoto[0]->LargePhotoURL; ?>"/>
                                    </div>
                                <?php }elseif (!is_array($l->info->Photo->PropertyPhoto) && isset($l->info->Photo->PropertyPhoto->LargePhotoURL) && $l->info->Photo->PropertyPhoto->LargePhotoURL != ''){ ?>
                                    <div class="list-image">
                                        <img class="list-banner" src="<?php echo $l->info->Photo->PropertyPhoto->LargePhotoURL; ?>"/>
                                    </div>
                                <?php }else{ ?>
                                    <div class="list-image">
                                        <!--<img class="grid-banner" src="https://curiouscloud.ca--><?php //echo $l->info->photo; ?><!--"/>-->
                                        <img src="<?php echo $l->info->photo; ?>"/>
                                    </div>
                                <?php } ?>

                                <!--<div class="list-image">
                                    <img src="https://curiouscloud.ca<?php /*echo $l->info->photo; */?>"/>
                                </div>
                                <?php /*if ($l->info->ct != '') { */?>
                                <div class="list-banner"><img src="https://curiouscloud.ca/assets/images/<?php /*echo $l->info->ct; */?>.png" /> </div>
                                --><?php /*} */?>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <br/>
                            <div class="col-sm-12">
                                <div class="list-price col-sm-5"><?php echo $l->info->ListPrice; ?><br/>
                                    <span><?php echo $l->info->beds; ?><?php echo $l->info->baths; ?></span></div>
                                <div class="list-address pull-right"> <?php echo strtoupper($l->info->UnparsedAddress); ?>
                                    <br/><?php echo strtoupper($l->info->City); ?> </div>
                            </div>
                            <div class="col-sm-12 list-text">
                                <?php echo $l->info->excerpt; ?><br/>
                                <div class="list-broker">
                                    <?php if (!$hideAgent) echo $l->info->agent; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>

        <div class="row listingSelection hide" id="listings-map">
            <div class="item rounded dark">
                <div id="map_canvas_1" class="map rounded map_canvas"></div>
                <div class="progress" id="map-loading">

                <div class="progress-bar progress-bar-striped active" role="progressbar"
                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">

                </div>
                </div>
            </div>
        </div>
        <div id="radios" class="item radios gradient rounded shadow" style=""></div>

        <div class="row listingSelection hide list-table" id="listings-table">
            <div class="col-sm-12">
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
                                        <?php if (is_array($l->info->Photo->PropertyPhoto) && isset($l->info->Photo->PropertyPhoto[0]->LargePhotoURL) && $l->info->Photo->PropertyPhoto[0]->LargePhotoURL != ''){ ?>
                                            <div class="listing-table-image">
                                                <img src="<?php echo $l->info->Photo->PropertyPhoto[0]->LargePhotoURL; ?>"/>
                                            </div>
                                        <?php }elseif (!is_array($l->info->Photo->PropertyPhoto) && isset($l->info->Photo->PropertyPhoto->LargePhotoURL) && $l->info->Photo->PropertyPhoto->LargePhotoURL != ''){ ?>
                                            <div class="listing-table-image">
                                                <img src="<?php echo $l->info->Photo->PropertyPhoto->LargePhotoURL; ?>"/>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="listing-table-image">
                                                <!--<img class="grid-banner" src="https://curiouscloud.ca--><?php //echo $l->info->photo; ?><!--"/>-->
                                                <img src="<?php echo $l->info->photo; ?>"/>
                                            </div>
                                        <?php } ?>
                                        <!--<div class="listing-table-image">
                                            <img src="https://curiouscloud.ca<?php /*echo $l->info->photo; */?>"/>
                                        </div>-->
                                    </div>

                                    <div class="col-sm-7 listing-table-address"> <?php echo strtoupper($l->info->UnparsedAddress); ?></div>
                                </a></td>
                            <td><?php echo($l->info->ListPrice); ?></td>
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
                    <?php } ?>
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

    realurl = '<?php echo get_post($options['webkits_listing_page'])->guid; ?>';

    listing = '<?php if (isset($_SESSION['webkits-view'])) echo $_SESSION['webkits-view']; else echo $options['webkits_listing_default']; ?>';

    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

    markers = <?php echo json_encode($listings->markers) . ";";?>
    <?php
    if ($options['webkits_map_style'] != '') {
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
<?php if($creb == true && $ll_apikey != '')
    {?>
        <script type="text/javascript">
            var searchWidget;
            var selected ;
            function initLocallogic () {
                searchWidget = new locallogic.LocalSearch('local-search',{
                    displayAs: 'grid',
                    locale: 'en',
                    color: '#ff0000',
                });


            }
            setTimeout(function(){ setcount(); }, 2000);
            function setcount(){
                jQuery('#llcount').html(searchWidget.selection().length);

            }
            jQuery('#local-lifestyle').unbind('click');
            jQuery('#local-lifestyle').on('click',function () {
                if(jQuery('#local-search').hasClass('d-none'))
                {
                    jQuery('.ll-grid-score').unbind('click');
                    jQuery('.ll-grid-score').click(function () {

                        if(jQuery(this).hasClass('ll-selected'))
                        {
                            jQuery('#llcount').html(searchWidget.selection().length-1);
                        }
                        else{jQuery('#llcount').html(searchWidget.selection().length+1);}



                    });

                    jQuery('#local-search').removeClass('d-none');
                }else{

                    jQuery('#local-search').addClass('d-none');
                }

            });


        </script>
        <?php if($creb == true && $ll_apikey != ''){   ?>
        <script
                src="https://cdn.locallogic.co/sdk/?token=<?php echo $ll_apikey ?>&callback=initLocallogic">
        </script>
     <?php }?>

    <?php }?>
