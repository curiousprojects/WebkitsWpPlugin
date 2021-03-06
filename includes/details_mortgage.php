<div class="with_frm_style">



    <form name="mortcal" id="mortcal" onSubmit="return MortCal(this);">

        <div id="mortgage_calculator">



            <div class="columns column-2 offset-lg-3">

                <input name="cmhc" type="checkbox" value="1" onClick="Updt(this.form);" /> Add <a href="http://www.cmhc.gc.ca/en/co/moloin/moloin_005.cfm" target="_blank">CMHC fee</a>.

            </div>


            <div class="mort-div row">
                <div class="mhalf_left ">

                    Purchase Price

                </div>

                <div class="mort_mhalf_right ">
                    <span><input type="text" name="purchaseprice" maxlength="15" size="10" value="<?php    if(isset($listing->content->mprice)) echo str_replace(",", "", $listing->content->mprice);?>" placeholder="$"/></span>
                </div>
            </div>


            <div class="mort-div row">
                <div class="mhalf_left ">

                    Down Payment or Equity

                </div>

                <div class="mort_mhalf_right ">

                    <input type="text" name="downpayment" maxlength="15" size="10" value="" placeholder="$"/></span>

                </div>
            </div>


            <div class="amt-div offset-lg-3">
                <div class="-mhalf_left">

                    Amount of Mortgage

                </div>

                <div class="mort_mhalf_right">

                    <strong><span id="mortgage">system will calculate</span></strong> <span id="cmhctext"></span>

                </div>
            </div>


            <div class="mort-div row">
                <div class="mhalf_left ">

                    Current Interest Rate

                </div>

                <div class="mort_mhalf_right ">

                    <span><input type="text" name="interestrate" maxlength="5" size="5" value="" placeholder="%"/></span>

                </div>
            </div>


            <div class="mort-div row">
                <div class="mhalf_left ">

                    Amortization Period

                </div>

                <div class="mort_mhalf_right">

                    <span class="w-50 d-block">  <input type="text" name="amortization" maxlength="5" size="5" value="35" /> years</span>

                </div>
            </div>



            <div class="mort-div row" >
                <div class="mhalf_left ">
                    Payment Schedule
                </div>
                <div class="mort_mhalf_right">
                    <div style="clear:both; width:100%;">

                        <select name="frequency" size="1">

                            <option value="12::1" selected="selected">Monthly</option>

                            <option value="24::12">Semi-monthly</option>

                            <option value="24::13">Semi-monthly accelerated</option>

                            <option value="26::12">Biweekly</option>

                            <option value="26::13">Biweekly accelerated</option>

                            <option value="52::12">Weekly</option>

                            <option value="52::13">Weekly accelerated</option>

                        </select>

                    </div>
                </div>
            </div>





            <div style="clear:both; width:100%; margin-top:15px;margin-bottom:15px;" class="amt-div offset-lg-3">

                <strong>Monthly Payment </strong> <span style="font-size:9px">(principal & interest)</span>
                <div>

                    <strong><span id="mthlypymt">system will calculate</span></strong>

                </div>
            </div>





            <div class="calc-center">

                <input type="submit" name="Submit" value="Calculate" />

            </div>

        </div>

    </form>

</div>

<div style="clear:both"></div>

<script>
   function mortagagedisplay()
   {
       console.log(jQuery('#mortcal').width());
    if(jQuery('#mortcal').width() >= 850)
    {
         jQuery("#mortcal").removeClass();
         jQuery('#mortcal').addClass('clac');
         jQuery('.mort-div').removeClass('flex-column');
         jQuery('#mortcal .amt-div, #mortcal .column-2').addClass('offset-lg-3')

    }
    else if(jQuery('#mortcal').width() < 850 && jQuery('#mortcal').width() >= 650)
    {
        jQuery("#mortcal").removeClass();
        jQuery('#mortcal').addClass('res-md-clac');
       
        jQuery('#mortcal div').removeClass('offset-lg-3')
        jQuery('.mort-div').addClass('flex-column'); 
    }
    else if(jQuery('#mortcal').width() < 414 && jQuery('#mortcal').width() > 50)
    {
        jQuery("#mortcal").removeClass();
        jQuery('#mortcal').addClass('res-sm-clac');
       
        jQuery('#mortcal div').removeClass('offset-lg-3')
        jQuery('.mort-div').addClass('flex-column'); 
    }
    else
    {
      
       jQuery("#mortcal").removeClass();
        jQuery('#mortcal').addClass('res-clac');
        jQuery('#mortcal div').removeClass('offset-lg-3')
        jQuery('.mort-div').addClass('flex-column'); 

    }
   }
   mortagagedisplay();
   jQuery(window).resize(function(){
       
     mortagagedisplay();
       
   });
</script>