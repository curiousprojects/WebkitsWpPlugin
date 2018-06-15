<div class="with_frm_style">
<p class="mortgage_title">Mortgage Calculator</p>
<form name="mortcal" id="mortcal" onSubmit="return MortCal(this);">
<div id="mortgage_calculator">
 
 <div class="columns column-2">
  <input name="cmhc" type="checkbox" value="1" onClick="Updt(this.form);" /> Add <a href="http://www.cmhc.gc.ca/en/co/moloin/moloin_005.cfm" target="_blank">CMHC fee</a>.
 </div>

 <div class="mhalf_left">
  Purchase Price
 </div>
 <div class="mhalf_right">
  $<input type="text" name="purchaseprice" maxlength="15" size="10" value="<?php    if(isset($listing->content->mprice)) echo str_replace(",", "", $listing->content->mprice);?>" />
 </div>

<div class="mhalf_left">
  Down Payment or Equity
 </div>
 <div class="mhalf_right">
  $<input type="text" name="downpayment" maxlength="15" size="10" value="" />
 </div>

<div class="mhalf_left">
  Amount of Mortgage
 </div>
<div class="mhalf_right">
  <strong><span id="mortgage">system will calculate</span></strong> <span id="cmhctext"></span>
 </div>

<div class="mhalf_left">
  Current Interest Rate
 </div>
<div class="halfwidth">
  <input type="text" name="interestrate" maxlength="5" size="5" value="" /> %
 </div>

 <div class="mhalf_left">
  Amortization Period
 </div>
<div class="mhalf_right">
  <input type="text" name="amortization" maxlength="5" size="5" value="35" /> years
 </div>

 <div class="columns column-2" >
  Payment Schedule
 </div>
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

 <div style="clear:both; width:100%; margin-top:15px;">
  <strong>Monthly Payment </strong> <span style="font-size:9px">(principal & interest)</span>
 </div>
 <div>
  <strong><span id="mthlypymt">system will calculate</span></strong>
 </div>

 <div class="columns column-2">
  <input type="submit" name="Submit" value="Calculate" />
 </div>
</div>
</form>
</div>
<div style="clear:both"></div>
