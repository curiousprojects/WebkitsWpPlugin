
<div clas="row">
  <div class="panel panel-default col-sm-12">
    <div class="panel-body">
        <div class="col-sm-12">
        <span class="text-danger pull-right ">
          <span id="counted">0</span>
          <small>Active Listings</small>
        </span>
        </div>
      <form data-ajax="false" id="search" role="search" action="<?php echo get_post($options['webkits_listings_page'])->guid;?>" method="post">
        <input id="sort" name="sort" value="LastUpdated DESC" type="hidden">
        <input id="view" name="view" value="grid" type="hidden">
        <input name="input_main" id="mainsearch" value="<?php echo $main; ?>" type="hidden">
        <div class="row">
          <div class="col-sm-4">

            <div class="form-group">
              <input id="input_mls" name="input_mls" value="<?= $_POST['input_mls'];?>" class="form-control " placeholder="ID #" type="text">
            </div>
            <div class="form-group">
              <input id="input_city" name="input_street" value="<?= $_POST['input_street'];?>" class="form-control " placeholder="Search by Street Address" type="text">
            </div>


            <div class="form-group">
              <input id="input_city" name="from_city" value="<?= $_POST['from_city'];?>" class="form-control " placeholder="Search by City" type="text">
            </div>
            <div class="form-group">
              <input id="input_city" name="hood" value="<?= $_POST['hood'];?>" class="form-control " placeholder="Search by Neighbourhood" type="text">
            </div>
              <label for="input_open_house"><input name="input_open_house" id="input_open_house" value="1" type="checkbox" <?php echo $check; ?> /> Open Houses Only</label>
          </div>
          <div class="col-sm-4">
            
            <div class="range">
              <div class="row">
              <div class="col-sm-12 " style="margin-bottom:-35px;">
              <label style="text-align:center;width:100%">
              <small>Bedrooms</small>
            </label>
            </div> <div class="col-sm-12 ">
              <input type="text" name="bedroom" class="slider10" value="" />
            </div>

              </div>
            </div>

            <!-- Bathrooms -->
            
            <div class="range">
              <div class="row">
              <div class="col-sm-12 " style="margin-bottom:-35px;">
              <label  style="text-align:center;width:100%">
              <small>Bathrooms</small>
            </label>
            </div> 
              <div class="col-sm-12 ">
              <input type="text"  name="bathroom" class="slider10" value="" />
      </div>
              </div>

            </div>

   
            <div class="range">
              <div class="row">
              <div class="col-sm-12 ">
              <div class="col-sm-12 " style="margin-bottom:-35px;">
              <label style="text-align:center;width:100%">
              <small>Price</small>
            </label>
            </div> 

        <input type="text" id='range-price' name="price" value="" />
      </div>
              </div>
            </div>

          </div>

          <div class="col-sm-4 pull-right">

            <div class="form-group">
              <select name="input_property_type" id="input_property_type" class="form-control ">
                <?php $bcAgent = isset($options['webkits_bc_agent']) ? $options['webkits_bc_agent'] : 0; ?>
                <option value="0" <?php if ($_POST['input_property_type']==0 ) echo "selected"; ?> class="text">All Property Types</option>
                <option value="1" <?php if ($_POST['input_property_type']==1 ) echo "selected"; ?> class="text">Homes for Sale</option>
                <option value="2" <?php if ($_POST['input_property_type']==2 ) echo "selected"; ?> class="text">Carriage Trade</option>
                <option value="3" <?php if ($_POST['input_property_type']==3 ) echo "selected"; ?> class="text">Commercial</option>
                <option value="4" <?php if ($_POST['input_property_type']==4 ) echo "selected"; ?> class="text">Farm</option>
                <option value="5" <?php if ($_POST['input_property_type']==5 ) echo "selected"; ?> class="text">Lot</option>
                <option value="6" <?php if ($_POST['input_property_type']==6 ) echo "selected"; ?> class="text">
                  <?php echo ($bcAgent == 1 ? 'Strata' : 'Condo'); ?>
                </option>
                <option value="7" <?php if ($_POST['input_property_type']==7 ) echo "selected"; ?> class="text">Multi-family</option>
                <option value="8" <?php if ($_POST['input_property_type']==8 ) echo "selected"; ?> class="text">Recreational</option>
                <option value="9" <?php if ($_POST['input_property_type']==9 ) echo "selected"; ?> class="text">Exclusive</option>
              </select>
            </div>
            <div class="form-group">
              <select name="input_transaction_type" id="input_transaction_type" class="form-control ">
                <option value="0" <?php if ($_POST['input_transaction_type']==0 ) echo "selected"; ?> >All Transaction Types</option>
                <option value="1" <?php if ($_POST['input_transaction_type']==1 ) echo "selected"; ?> >For Lease</option>
                <option value="2" <?php if ($_POST['input_transaction_type']==2 ) echo "selected"; ?> >For Sale</option>
              </select>
            </div>
            <div class="form-group">
              <input id="input_city" name="input_agent" value="<?= $_POST['input_agent'];?>" class="form-control " placeholder="Search by Agent" type="text">
            </div>
            <div class="form-group">
              <select name="input_office" id="input_office" class="form-control ">
                <option value="">Search by Office</option>
              </select>
            </div>


          </div>

        </div>

      <div class="row">
        <div class="col-sm-offset-4 col-sm-4"><br />
          <button type="submit" value="Search" class="btn btn-primary btn-large btn-block btn-result-filter" id="submit">Search</button>
        </div>
      </div>
    </div>
  </div>
  </form>
</div>

<script>
  realurl = '<?php echo get_post($options['webkits_listing_page '])->guid; ?>';

  listing = '<?php if (isset($_SESSION['webkits-view'])) echo $_SESSION['webkits-view']; else echo $options['webkits_listing_default']; ?>';

  var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';

jQuery("#range-price").ionRangeSlider({
    type: "double",
    grid: true,
    min: 0,
    max: 1000,
    from: 0,
    to: 1000,
    prefix: "$",
    step: 50,
    max_postfix: "M+",
    prettify_enabled: true,
    prettify: function (num) {
        if(num == 1000) return 1;
        else return num+"k";
    }
});
jQuery(".slider10").ionRangeSlider({
    type: "double",
    grid: false,
    min: 0,
    max: 10,
    from: 0,
    to: 10
});

</script>