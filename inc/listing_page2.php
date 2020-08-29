
<div class="container-fluid">
              <div class="container-fluid container-pad" id="property-listings">


<div class="row buttonslisting">
        <div class="btn-group pull-right">
            <a href="#" id="grid2" class="btn btn-default btn-sm">Grid</a>
            <a href="#" id="list2" class="btn btn-default btn-sm">List</a>
            <a href="#" id="table2" class="btn btn-default btn-sm">Table</a>
            <a href="#" id="map2" class="btn btn-default btn-sm">Map</a>
        </div></div>



<div class="row listingSelection2 hide"  id="listings-grid2">
<?php
foreach ($listings->listing as $l) {
?>
  <div class="col-sm-4">
    <a href="<?php echo "/property/".$l->info->ListingKey. '/' . (str_replace(" ", "-", $l->info->UnparsedAddress)) . '/' . $l->info->City; ?>">  <div class="grid-box">
      <div class="grid-overlay">
        <?php if($l->info->ct != '') {  ?>
        <img class="grid-banner" src="https://curiouscloud.ca/assets/images/<?php echo $l->info->ct; ?>.png">
        <?php } ?>
       <div class="grid-image">
      <img src="https://curiouscloud.ca<?php echo $l->info->photo; ?>" />
      </div>
    </div>
          <div class="grid-address">
            <span><?php echo $l->info->ListPrice; ?></span>
      <?php echo strtoupper($l->info->UnparsedAddress); ?><br /><?php echo strtoupper($l->info->City); ?>
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
    </div></a>
  </div>
<?php
}
?>
</div>

<div class="row listingSelection2 hide"  id="listings-list2">
<?php
foreach ($listings->listing as $l) {
?>



   <div class="row list-row">
<a href="<?php echo "/property/".$l->info->ListingKey. '/' . (str_replace(" ", "-", $l->info->UnparsedAddress)) . '/' . $l->info->City; ?>">
     <div class="col-sm-5 list-image-box">

          <div class="list-overlay">



       <div class="list-image">
 <img src="https://curiouscloud.ca<?php echo $l->info->photo; ?>" />
       </div>
       <?php if($l->info->ct != '') {  ?>
       <img class="list-banner" src="https://curiouscloud.ca/assets/images/<?php echo $l->info->ct; ?>.png">
       <?php } ?>
    </div>

     </div>
     <div class="col-sm-7">
       <Br />
       <div class="col-sm-12">
         <div class="list-price col-sm-5"><?php echo $l->info->ListPrice; ?><br />
           <span><?php echo $l->info->beds; ?> <?php echo $l->info->baths; ?></span></div>
         <div class="list-address pull-right"> <?php echo strtoupper($l->info->UnparsedAddress); ?><br /><?php echo strtoupper($l->info->City); ?> </div>
         </div>
        <div class="col-sm-12 list-text">
          <?php echo $l->info->excerpt; ?><br />
          <div class="list-broker p-t text-center">

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


<?php
}
?>
</div>




 <div class="row listingSelection2 hide" id="listings-map2">

 <div class="item rounded dark">
         <div id="map_canvas2" class="map rounded"></div>
       </div>
        <div id="radios" class="item gradient rounded shadow" style="margin:5px;padding:5px 5px 5px 10px;"></div>
</div>

   <div class="row listingSelection2 hide list-table" id="listings-table2">


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
<?php
foreach ($listings->listing as $l) {
?>

           <tr>
             <td>

<a href="<?php echo "/property/".$l->info->ListingKey. '/' . (str_replace(" ", "-", $l->info->UnparsedAddress)) . '/' . $l->info->City; ?>">

               <div class="col-sm-5">
               <div class="listing-table-image">
 <img src="https://curiouscloud.ca<?php echo $l->info->photo; ?>" />
                </div>
               </div>

               <div class="col-sm-7 listing-table-address"> <?php echo strtoupper($l->info->UnparsedAddress); ?></div></a></td>
             <td><?php echo ($l->info->ListPrice); ?></td>
             <td><?php if(isset($l->info->Building->BedroomsTotal) && $l->info->Building->BedroomsTotal >0) echo ($l->info->Building->BedroomsTotal); else echo "-"; ?></td>
             <td><?php if(isset($l->info->Building->BathroomTotal) && $l->info->Building->BathroomTotal >0) echo ($l->info->Building->BathroomTotal); else echo "-"; ?></td>
             <td><?php echo ($l->info->Land->SizeTotalText); ?></td>
             <td><?php echo ($l->info->City); ?> </td>
             <td><?php echo ($l->info->Address->Neighbourhood);?> </td>
             <td><?php


if(isset($l->info->AgentDetails->Office->Name))
 echo ($l->info->AgentDetails->Office->Name);


if(is_array($l->info->AgentDetails))
 echo ($l->info->AgentDetails[0]->Office->Name);

            ?></td>
           </tr>

<?php
}
?>
         </tbody>
         </table>
    </div>
  </div>





      <!-- <div class="row">
                 <div class="col-sm-12"><div id="Loading" style="margin:0 auto;width:31px;"><img src="https://webkitadmin.com/assets/images/Loader.gif" /></div>
                 </div>




         <div class="col-sm-offset-4 col-sm-4">

                 <span class="btn btn-primary btn-large btn-block btn-result-filter" id="LoadMore">Load More Results</span>
                 </div>
                        </div>-->




<div class="row topadd">
<ul class="pagination pull-right">

<?php
echo renderNavigation(3,$listings->totals->Found /  $listingPerPage ,$CurrentPage);
?>

</ul>
                 </div>

                  </div>




              </div>
 <script>

  realurl = '<?php echo get_post($options['webkits_listing_page'])->guid; ?>' ;

listing2 = '<?php if(isset($_SESSION['webkits-view'])) echo $_SESSION['webkits-view'].'2';  else echo $options['webkits_listing_default'].'2'; ?>';

var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';

markers = <?php echo json_encode($listings->markers).";";?>
<?php
if(isset($options['webkits_map_style']) && $options['webkits_map_style'] != '')
  echo "var styler = ".str_replace('\"', '"', $options['webkits_map_style']).";
";
else  echo "var styler = '';
";
if(!isset($options['webkits_latlng']))  echo "var dlatlng ='45.420297,-75.692362';
 ";
else   echo "var dlatlng ='{$options['webkits_latlng']}';
";
?>

/*
window.addEventListener("resize", function(e) {
var slides = document.getElementsByClassName("grid-box");
for(var i = 0; i < slides.length; i++)
{
  slides.item(i).style.height = slides.item(i).style.width / 1.045;

}

});
*/
</script>