
var solved = 0;
var minpurchprice = minmortgageamt = 1000;
var maxpurchprice = maxmortgageamt = maxdownpymt = 50000000;
//var minmortgageamt = 1000;
//var maxmortgageamt = 50000000;
var mindownpymt = 0;
//var maxdownpymt = 50000000;
var minamort = 1;
var maxamort = 35;
var price,downpymt,interest,amort,intfactor,mortgageamt;

function MortCal (formobj) {
 var pymt;
 var priceok = 0;
 var downpymtok = 0;
 var interestok = 0;
 var amortok = 0;
 var valcaltext = 'system will calculate';
 price = formobj.elements['purchaseprice'].value;
 downpymt = formobj.elements['downpayment'].value;
 interest = formobj.elements['interestrate'].value;
 amort = formobj.elements['amortization'].value;
 document.getElementById('mortgage').innerHTML = valcaltext;
 document.getElementById('mthlypymt').innerHTML = valcaltext;
 var freqobj = formobj.elements['frequency'];
 var freqval = freqobj.options[freqobj.selectedIndex].value;
 var freqpymt = freqval.split('::');

 if (price != '' && downpymt != '' && interest != '' && amort != '') {
  price = price.replace(',','');
  downpymt = downpymt.replace(',','');
  if (isNaN(price) || isNaN(downpymt) || isNaN(interest) || isNaN(amort)) {
   alert('One of your entries is not a number.');
   return false;
  } else {
   if (price >= minpurchprice && price <= maxpurchprice) {
    priceok = 1;
   } else {
    alert("Please enter a valid 'Purchase price'.");
    return false;
   }
   if (downpymt >= mindownpymt && downpymt <= maxdownpymt) {
    downpymtok = 1;
   } else {
    alert("Please enter a valid 'Down payment or equity'.");
    return false;
   }
   if (amort >= minamort && amort <= maxamort) {
    amortok = 1;
   } else {
    alert("Please enter a valid 'Amortization period' between " + minamort + " and " + maxamort + " years.");
    return false;
   }
  }
 } else {
  alert('Please complete all fields.');
  return false;
 }

 var percentdown = (downpymt / price) * 100;
 var mortgageamt = parseInt(price) - parseInt(downpymt);

 var cmhcamt = 0;
 var cmhcrate = 0;
 if (price != '' && downpymt != '') {
  if (formobj.elements['cmhc'].checked) {
   if (percentdown >= 5 && percentdown < 10) {
    cmhcrate = 0.0315;// LTV up to and including 95%
   } else if (percentdown >= 10 && percentdown < 15) {
    cmhcrate = 0.024;// LTV up to and including 90%
   } else if (percentdown >= 15 && percentdown < 20) {
    cmhcrate = 0.018;// LTV up to and including 85%
   } else if (percentdown >= 20 && percentdown < 25) {
    cmhcrate = 0.0125;// LTV up to and including 80%
   } else if (percentdown >= 25 && percentdown < 35) {
    cmhcrate = 0.0075;// LTV up to and including 75%
   } else if (percentdown >= 35) {
    cmhcrate = 0.006;// LTV up to and including 65%
   //} else if (percentdown >= 30 && percentdown < 35) {
   // cmhcrate = 0.005;
   }
   
   if (amort > 25 && amort <= 30) {
    cmhcrate += 0.002;
   } else if (amort > 30 && amort <= 35) {
    cmhcrate += 0.004;
   }
   cmhcamt = cmhcrate * mortgageamt;
  }
  if (document.getElementById('cmhctext')) {
   var cmhcratepcnt = 0;
   cmhcratepcnt = cmhcrate * 100;
   cmhcratepcnt = cmhcratepcnt.toFixed(2);
   if (formobj.elements['cmhc'].checked) {
    document.getElementById('cmhctext').innerHTML = '(includes <B>' + cmhcratepcnt + '%</B> <A href="http://www.cmhc.gc.ca/en/co/moloin/moloin_005.cfm" target="_blank">CMHC fee</A>)';
   } else {
    document.getElementById('cmhctext').innerHTML = '';
   }
  }

  var finalmortamt = mortgageamt + cmhcamt;
  finalmortamt = finalmortamt.toFixed(2);
  document.getElementById('mortgage').innerHTML = '$'+finalmortamt;
  var intrate = formobj.elements['interestrate'].value;
  var amort = formobj.elements['amortization'].value;

  var ical = 1 + (intrate/200);
  var icalexp = Math.pow(ical,0.166666666666666666666667);

  var numer = icalexp - 1;

  var denomy = -12*amort;
  var denom = 1-Math.pow(icalexp,denomy);

  pymt = finalmortamt * (numer/denom);
  if (freqval == '12::1') {
   pymt = pymt;
  } else if (freqval == '24::12') {
   pymt = (pymt*12)/24;// semi-monthly
  } else if (freqval == '24::13') {
   pymt = (pymt*13)/24;// semi-monthly accelerated
  } else if (freqval == '26::12') {
   pymt = (pymt*12)/26;// bi-weekly
  } else if (freqval == '26::13') {
   pymt = (pymt*13)/26;// bi-weekly accelerated
  } else if (freqval == '52::12') {
   pymt = (pymt*12)/52;// weekly
  } else if (freqval == '52::13') {
   pymt = (pymt*13)/52;// weekly accelerated
  }
  pymt = pymt.toFixed(2);
  document.getElementById('mthlypymt').innerHTML = '$'+pymt;
  return false;
 }
}


function Updt (formobj) {
 price = formobj.elements['purchaseprice'].value;
 downpymt = formobj.elements['downpayment'].value;
 interest = formobj.elements['interestrate'].value;
 amort = formobj.elements['amortization'].value;
 if (price != '' && downpymt != '' && interest != '' && amort != '') {
  MortCal(formobj);
 } else {
 if (document.getElementById('cmhctext')) {
  if (formobj.elements['cmhc'].checked) {
   document.getElementById('cmhctext').innerHTML = '(includes <A href="http://www.cmhc.gc.ca/en/co/moloin/moloin_005.cfm" target="_blank">CMHC fee</A>)';
  } else {
   document.getElementById('cmhctext').innerHTML = '';
  }
 }
 }
}
//-- End -->


<!-- Begin
// mortgage calculator - calculates payment amount for various payment frequencies and includes amortization table
function MortCalAmort (formobj) {
 var pymt;
 var priceok = 0;
 var downpymtok = 0;
 var interestok = 0;
 var amortok = 0;
 var pymtsperyear = 12;
 var valcaltext = 'system will calculate';
 price = formobj.elements['purchaseprice'].value;
 downpymt = formobj.elements['downpayment'].value;
 interest = formobj.elements['interestrate'].value;
 amort = formobj.elements['amortization'].value;
 document.getElementById('mortgage').innerHTML = valcaltext;
 document.getElementById('mthlypymt').innerHTML = valcaltext;
 var freqobj = formobj.elements['frequency'];
 var freqval = freqobj.options[freqobj.selectedIndex].value;
 var freqpymt = freqval.split('::');

 if (price != '' && downpymt != '' && interest != '' && amort != '') {
  price = price.replace(',','');
  downpymt = downpymt.replace(',','');
  if (isNaN(price) || isNaN(downpymt) || isNaN(interest) || isNaN(amort)) {
   alert('One of your entries is not a number.');
   return false;
  } else {
   if (price >= minpurchprice && price <= maxpurchprice) {
    priceok = 1;
   } else {
    alert("Please enter a valid 'Purchase price'.");
    return false;
   }
   if (downpymt >= mindownpymt && downpymt <= maxdownpymt) {
    downpymtok = 1;
   } else {
    alert("Please enter a valid 'Down payment or equity'.");
    return false;
   }
   if (amort >= minamort && amort <= maxamort) {
    amortok = 1;
   } else {
    alert("Please enter a valid 'Amortization period'.");
    return false;
   }
  }
 } else {
  alert('Please complete all fields.');
  return false;
 }

 var percentdown = (downpymt / price) * 100;
 var mortgageamt = parseInt(price) - parseInt(downpymt);

 var cmhcamt = 0;
 var cmhcrate = 0;
 if (price != '' && downpymt != '') {
  if (formobj.elements['cmhc'].checked) {
   if (percentdown >= 0 && percentdown < 5) {
    cmhcrate = 0.029;
   } else if (percentdown >= 5 && percentdown < 10) {
    cmhcrate = 0.0275;
   } else if (percentdown >= 10 && percentdown < 15) {
    cmhcrate = 0.02;
   } else if (percentdown >= 15 && percentdown < 20) {
    cmhcrate = 0.0175;
   } else if (percentdown >= 20 && percentdown < 25) {
    cmhcrate = 0.01;
   } else if (percentdown >= 25 && percentdown < 30) {
    cmhcrate = 0.0065;
   } else if (percentdown >= 30 && percentdown < 35) {
    cmhcrate = 0.005;
   }
   
   if (amort > 25 && amort <= 30) {
    cmhcrate += 0.002;
   } else if (amort > 30 && amort <= 35) {
    cmhcrate += 0.004;
   }
   cmhcamt = cmhcrate * mortgageamt;
  }
  if (document.getElementById('cmhctext')) {
   var cmhcratepcnt = 0;
   cmhcratepcnt = cmhcrate * 100;
   var cmhcratepcntfixed = cmhcratepcnt.toFixed(2);
   if (formobj.elements['cmhc'].checked) {
    document.getElementById('cmhctext').innerHTML = '(includes <B>' + cmhcratepcntfixed + '%</B> <A href="http://www.cmhc.gc.ca/en/co/moloin/moloin_005.cfm" target="_blank">CMHC fee</A>)';
   } else {
    document.getElementById('cmhctext').innerHTML = '';
   }
  }

  var finalmortamt = mortgageamt + cmhcamt;
  var intrate = formobj.elements['interestrate'].value;
  var amort = formobj.elements['amortization'].value;

  var ical = 1 + (intrate/200);
  var icalexp = Math.pow(ical,0.166666666666666666666667);

  var numer = icalexp - 1;

//  intpymt1 = intpymt1.toFixed(2);
//  alert(intpymt1);

  var denomy = -12*amort;
  var denom = 1-Math.pow(icalexp,denomy);

  pymt = finalmortamt * (numer/denom);

  var finalmortamtfixed = finalmortamt.toFixed(2);
  document.getElementById('mortgage').innerHTML = '$'+finalmortamtfixed;

//alert('numer '+numer);
//alert('denom '+denom);
//alert('pymt '+pymt);
//alert('finalmortamt '+finalmortamt);


  if (freqval == '12::1') {
   pymt = pymt;
   pymtsperyear = 12;
//   intfactor = intpymt1;
  } else if (freqval == '24::12') {
   pymt = (pymt*12)/24;// semi-monthly
   pymtsperyear = 24;
//   intfactor = (intpymt1*12)/24;
  } else if (freqval == '24::13') {
   pymt = (pymt*13)/24;// semi-monthly accelerated
   pymtsperyear = 24;
//   intfactor = (intpymt1*13)/24;
  } else if (freqval == '26::12') {
   pymt = (pymt*12)/26;// bi-weekly
   pymtsperyear = 26;
//   intfactor = (intpymt1*12)/26;
  } else if (freqval == '26::13') {
   pymt = (pymt*13)/26;// bi-weekly accelerated
   pymtsperyear = 26;
//   intfactor = (intpymt1*13)/26;
  } else if (freqval == '52::12') {
   pymt = (pymt*12)/52;// weekly
   pymtsperyear = 52;
//   intfactor = (intpymt1*12)/52;
  } else if (freqval == '52::13') {
   pymt = (pymt*13)/52;// weekly accelerated
   pymtsperyear = 52;
//   intfactor = (intpymt1*13)/52;
  }
// ((1+i/2)^(1/6)-1)) used in excel document MORTGAGE
// ((1+(i/2))^2)^(1/12)-1 used in excel document CMTGMONT
// pymt = (finalmortamt * ((1+(intrate/2))^2)^(1/12)-1)/(1-(1+ ((1+(intrate/2))^2)^(1/12)-1 )^(-(amort*12)))
// ((1+(i/2))^2)^(7/365)-1
// ((1+i/200)^(1/6)-1))/(1-(((1+i/200)^(1/6)))^-(n*12) hughchou.org


  var pymtfixed = pymt.toFixed(2);
  document.getElementById('mthlypymt').innerHTML = '$'+pymtfixed;
//i = {(1 + R/2)^(1/6)} - 1
//In plain english, this means divide the annual interest rate (as a decimal) by 2 and then add 1. Raise the result to the 1/6th power and then subtract 1.


// r = (1+i/2)^2/n - 1, r is the effective monthly rate, n is the number of payments per year

//  var prinpymt1 = pymt - intpymt1;
//  prinpymt1 = prinpymt1.toFixed(2);
//  alert(prinpymt1);

/*
*/
  var table = '<TABLE width="550" border="0" align="center" cellspacing="0" cellpadding="5">\n';
  table += ' <TR>\n  <TD align="center" colspan="4" class="hdrrow1">Amortization Table<\/TD>\n <\/TR>\n';
  table += ' <TR>\n  <TD align="center" class="hdrrow2">Payment #<\/TD>\n  <TD align="center" class="hdrrow2">Interest Payment<\/TD>\n  <TD align="center" class="hdrrow2">Principal Payment<\/TD>\n  <TD align="center" class="hdrrow2">Balance<\/TD>\n <\/TR>\n';
  var mortbal = finalmortamt;
  var intpymt,prinpymt,halfcount,floorhalfcount,color,row,oldmortbal;
  var count = 0;
  var totalprinpymt = 0;

  while (mortbal > 0) {
   oldmortbal = mortbal;
   if (freqval == '12::1') {
    intfactor = numer;
   } else if (freqval == '24::12') {
    intfactor = ((numer*12)/24);
   } else if (freqval == '24::13') {
    intfactor = ((numer*13)/24);
   } else if (freqval == '26::12') {
    intfactor = ((numer*12)/26);
   } else if (freqval == '26::13') {
    intfactor = ((numer*13)/26);
   } else if (freqval == '52::12') {
    intfactor = ((numer*12)/52);
   } else if (freqval == '52::13') {
    intfactor = ((numer*13)/52);
   }

   intpymt = mortbal * intfactor;
   var intpymtfixed = intpymt.toFixed(2);


//   var intpymt = ;//mortbal * 
//alert('intpymt '+intpymt);
//alert('pymt in while '+pymt);
   prinpymt = pymt - intpymt;
   mortbal = mortbal - prinpymt;
   if (parseInt(mortbal) < parseInt(prinpymt)) {
    prinpymt = oldmortbal;
    mortbal = 0;
//    mortbal = mortbal - mortbal;
//   } else {
//    mortbal = mortbal - prinpymt;
   }

   totalprinpymt += prinpymt;

   var prinpymtfixed = prinpymt.toFixed(2);
//alert('prinpymt '+prinpymt);
   var mortbalfixed = mortbal.toFixed(2);
//alert('mortbal '+mortbal);

   halfcount = count / 2;
   floorhalfcount = Math.floor(halfcount);
   color = (halfcount == floorhalfcount) ? 'altrow1' : 'altrow2';


   count++;

   row = ' <TR class="'+color+'">\n';
//   row += '  <TD align="center" class="'+color+'">'+count+'<\/TD>\n'+'  <TD align="center" class="'+color+'">$'+intpymtfixed+'<\/TD>\n'+'  <TD align="center" class="'+color+'">$'+prinpymtfixed+'<\/TD>\n'+'  <TD align="center" class="'+color+'">$'+mortbalfixed+'<\/TD>\n';
   row += '  <TD align="center">'+count+'<\/TD>\n'+'  <TD align="center">$'+intpymtfixed+'<\/TD>\n'+'  <TD align="center">$'+prinpymtfixed+'<\/TD>\n'+'  <TD align="center">$'+mortbalfixed+'<\/TD>\n';
   row += ' <\/TR>\n';
   table += row;
  } // closes while (mortbal > 0)


  table += '<\/TABLE>\n';
  document.getElementById('amorttable').innerHTML = table;
  var totalprinpymtfixed = totalprinpymt.toFixed(2);
//alert(totalprinpymtfixed);
  return false;
 }
}


function UpdtAmort (formobj) {
 price = formobj.elements['purchaseprice'].value;
 downpymt = formobj.elements['downpayment'].value;
 interest = formobj.elements['interestrate'].value;
 amort = formobj.elements['amortization'].value;
 if (price != '' && downpymt != '' && interest != '' && amort != '') {
  MortCalAmort(formobj);
 } else {
 if (document.getElementById('cmhctext')) {
  if (formobj.elements['cmhc'].checked) {
   document.getElementById('cmhctext').innerHTML = '(includes <A href="http://www.cmhc.gc.ca/en/co/moloin/moloin_005.cfm" target="_blank">CMHC fee</A>)';
  } else {
   document.getElementById('cmhctext').innerHTML = '';
  }
 }
 }
}
//-- End -->


<!-- Begin
// mortgage calculator - calculates payment amount for various payment frequencies without purchase price or downpayment fields
function MortCal2 (formobj) {
 var pymt;
 var mortgageamtok = 0;
 var amortok = 0;
 var valcaltext = 'system will calculate';
 mortgageamt = formobj.elements['mortgageamt'].value;
 interest = formobj.elements['interestrate'].value;
 amort = formobj.elements['amortization'].value;
 document.getElementById('mthlypymt').innerHTML = valcaltext;
 var freqobj = formobj.elements['frequency'];
 var freqval = freqobj.options[freqobj.selectedIndex].value;
 var freqpymt = freqval.split('::');

 if (mortgageamt != '' && interest != '' && amort != '') {
  mortgageamt = mortgageamt.replace(',','');
  if (isNaN(mortgageamt) || isNaN(interest) || isNaN(amort)) {
   alert('One of your entries is not a number.');
   return false;
  } else {
   if (mortgageamt >= minmortgageamt && mortgageamt <= maxmortgageamt) {
    mortgageamtok = 1;
   } else {
    alert("Please enter a valid 'Mortgage Amount'.");
    return false;
   }
   if (amort >= minamort && amort <= maxamort) {
    amortok = 1;
   } else {
    alert("Please enter a valid 'Amortization period'.");
    return false;
   }
  }
 } else {
  alert('Please complete all fields.');
  return false;
 }

  var finalmortamt = mortgageamt;
  var intrate = formobj.elements['interestrate'].value;
  var amort = formobj.elements['amortization'].value;

  var ical = 1 + (intrate/200);
  var icalexp = Math.pow(ical,0.166666666666666666666667);

  var numer = icalexp - 1;

  var denomy = -12*amort;
  var denom = 1-Math.pow(icalexp,denomy);

  pymt = finalmortamt * (numer/denom);
  if (freqval == '12::1') {
   pymt = pymt;
  } else if (freqval == '24::12') {
   pymt = (pymt*12)/24;// semi-monthly
  } else if (freqval == '24::13') {
   pymt = (pymt*13)/24;// semi-monthly accelerated
  } else if (freqval == '26::12') {
   pymt = (pymt*12)/26;// bi-weekly
  } else if (freqval == '26::13') {
   pymt = (pymt*13)/26;// bi-weekly accelerated
  } else if (freqval == '52::12') {
   pymt = (pymt*12)/52;// weekly
  } else if (freqval == '52::13') {
   pymt = (pymt*13)/52;// weekly accelerated
  }
  pymt = pymt.toFixed(2);
  document.getElementById('mthlypymt').innerHTML = '$'+pymt;
  return false;
}


function Updt2 (formobj) {
 mortgageamt = formobj.elements['mortgageamt'].value;
 interest = formobj.elements['interestrate'].value;
 amort = formobj.elements['amortization'].value;
 if (mortgageamt != '' && interest != '' && amort != '') {
  MortCal2(formobj);
 } else {
  alert('Please complete all fields.');
  return false;
 }
}
//-- End -->


<!-- Begin
// mortgage calculator - calculates payment amount for various payment frequencies without purchase price or downpayment fields with amortization table
function MortCal2Amort (formobj) {
 var pymt;
 var mortgageamtok = 0;
 var amortok = 0;
 var valcaltext = 'system will calculate';
 mortgageamt = formobj.elements['mortgageamt'].value;
 interest = formobj.elements['interestrate'].value;
 amort = formobj.elements['amortization'].value;
 document.getElementById('mthlypymt').innerHTML = valcaltext;
 var freqobj = formobj.elements['frequency'];
 var freqval = freqobj.options[freqobj.selectedIndex].value;
 var freqpymt = freqval.split('::');

 if (mortgageamt != '' && interest != '' && amort != '') {
  mortgageamt = mortgageamt.replace(',','');
  if (isNaN(mortgageamt) || isNaN(interest) || isNaN(amort)) {
   alert('One of your entries is not a number.');
   return false;
  } else {
   if (mortgageamt >= minmortgageamt && mortgageamt <= maxmortgageamt) {
    mortgageamtok = 1;
   } else {
    alert("Please enter a valid 'Mortgage Amount'.");
    return false;
   }
   if (amort >= minamort && amort <= maxamort) {
    amortok = 1;
   } else {
    alert("Please enter a valid 'Amortization period'.");
    return false;
   }
  }
 } else {
  alert('Please complete all fields.');
  return false;
 }

  var finalmortamt = mortgageamt;
  var intrate = formobj.elements['interestrate'].value;
  var amort = formobj.elements['amortization'].value;

  var ical = 1 + (intrate/200);
  var icalexp = Math.pow(ical,0.166666666666666666666667);

  var numer = icalexp - 1;

  var denomy = -12*amort;
  var denom = 1-Math.pow(icalexp,denomy);

  pymt = finalmortamt * (numer/denom);

  if (freqval == '12::1') {
   pymt = pymt;
   pymtsperyear = 12;
  } else if (freqval == '24::12') {
   pymt = (pymt*12)/24;// semi-monthly
   pymtsperyear = 24;
  } else if (freqval == '24::13') {
   pymt = (pymt*13)/24;// semi-monthly accelerated
   pymtsperyear = 24;
  } else if (freqval == '26::12') {
   pymt = (pymt*12)/26;// bi-weekly
   pymtsperyear = 26;
  } else if (freqval == '26::13') {
   pymt = (pymt*13)/26;// bi-weekly accelerated
   pymtsperyear = 26;
  } else if (freqval == '52::12') {
   pymt = (pymt*12)/52;// weekly
   pymtsperyear = 52;
  } else if (freqval == '52::13') {
   pymt = (pymt*13)/52;// weekly accelerated
   pymtsperyear = 52;
  }

  pymt = pymt.toFixed(2);
  document.getElementById('mthlypymt').innerHTML = '$'+pymt;

  var table = '<TABLE width="550" border="0" align="center" cellspacing="0" cellpadding="5">\n';
  table += ' <TR>\n  <TD align="center" colspan="4" class="hdrrow1">Amortization Table<\/TD>\n <\/TR>\n';
  table += ' <TR>\n  <TD align="center" class="hdrrow2">Payment #<\/TD>\n  <TD align="center" class="hdrrow2">Interest Payment<\/TD>\n  <TD align="center" class="hdrrow2">Principal Payment<\/TD>\n  <TD align="center" class="hdrrow2">Balance<\/TD>\n <\/TR>\n';
  var mortbal = finalmortamt;
  var intpymt,prinpymt,halfcount,floorhalfcount,color,row,oldmortbal;
  var count = 0;
  var totalprinpymt = 0;
  var intpymttotal = 0;
  var intpymttotalfixed;

  while (mortbal > 0) {
   oldmortbal = mortbal;
   if (freqval == '12::1') {
    intfactor = numer;
   } else if (freqval == '24::12') {
    intfactor = ((numer*12)/24);
   } else if (freqval == '24::13') {
    intfactor = ((numer*13)/24);
   } else if (freqval == '26::12') {
    intfactor = ((numer*12)/26);
   } else if (freqval == '26::13') {
    intfactor = ((numer*13)/26);
   } else if (freqval == '52::12') {
    intfactor = ((numer*12)/52);
   } else if (freqval == '52::13') {
    intfactor = ((numer*13)/52);
   }

   intpymt = mortbal * intfactor;
   var intpymtfixed = intpymt.toFixed(2);

   intpymttotal += parseInt(intpymtfixed);
//   intpymttotalfixed = intpymttotal.toFixed(2);

   prinpymt = pymt - intpymt;
   mortbal = mortbal - prinpymt;
   if (parseInt(mortbal) < parseInt(prinpymt)) {
    prinpymt = oldmortbal;
    mortbal = 0;
   }

   totalprinpymt += prinpymt;

   var prinpymtfixed = prinpymt.toFixed(2);
   var mortbalfixed = mortbal.toFixed(2);

   halfcount = count / 2;
   floorhalfcount = Math.floor(halfcount);
   color = (halfcount == floorhalfcount) ? 'altrow1' : 'altrow2';

   count++;

   row = ' <TR class="'+color+'">\n';
   row += '  <TD align="center">'+count+'<\/TD>\n'+'  <TD title="'+intpymttotal+'" align="center">$'+intpymtfixed+'<\/TD>\n'+'  <TD align="center">$'+prinpymtfixed+'<\/TD>\n'+'  <TD align="center">$'+mortbalfixed+'<\/TD>\n';
   row += ' <\/TR>\n';
   table += row;
  } // closes while (mortbal > 0)


  table += '<\/TABLE>\n';
  document.getElementById('amorttable').innerHTML = table;
  var totalprinpymtfixed = totalprinpymt.toFixed(2);

  return false;
}
//-- End -->


<!-- Begin
// mortgage calculator - calculates payment amount for all payment frequencies without purchase price or downpayment fields
function MortCal3 (formobj) {
 var pymt,color;
 var mortgageamtok = 0;
 var amortok = 0;
 var valcaltext = 'system will calculate';
 mortgageamt = formobj.elements['mortgageamt'].value;
 interest = formobj.elements['interestrate'].value;
 amort = formobj.elements['amortization'].value;
 document.getElementById('mthlypymt').innerHTML = valcaltext;

 if (mortgageamt != '' && interest != '' && amort != '') {
  mortgageamt = mortgageamt.replace(',','');
  if (isNaN(mortgageamt) || isNaN(interest) || isNaN(amort)) {
   alert('One of your entries is not a number.');
   return false;
  } else {
   if (mortgageamt >= minmortgageamt && mortgageamt <= maxmortgageamt) {
    mortgageamtok = 1;
   } else {
    alert("Please enter a valid 'Mortgage Amount'.");
    return false;
   }
   if (amort >= minamort && amort <= maxamort) {
    amortok = 1;
   } else {
    alert("Please enter a valid 'Amortization period'.");
    return false;
   }
  }
 } else {
  alert('Please complete all fields.');
  return false;
 }

  var finalmortamt = mortgageamt;
  var intrate = formobj.elements['interestrate'].value;
  var amort = formobj.elements['amortization'].value;

  var ical = 1 + (intrate/200);
  var icalexp = Math.pow(ical,0.166666666666666666666667);

  var numer = icalexp - 1;

  var denomy = -12*amort;
  var denom = 1-Math.pow(icalexp,denomy);


  var freqval = new Array();

  freqval[0] = new Array();
  freqval[0][0] = 'Monthly';
  freqval[0][1] = 12;
  freqval[0][2] = 12;

  freqval[1] = new Array();
  freqval[1][0] = 'Semi-monthly';
  freqval[1][1] = 12;
  freqval[1][2] = 24;

  freqval[2] = new Array();
  freqval[2][0] = 'Semi-monthly accelerated';
  freqval[2][1] = 13;
  freqval[2][2] = 24;

  freqval[3] = new Array();
  freqval[3][0] = 'Biweekly';
  freqval[3][1] = 12;
  freqval[3][2] = 26;

  freqval[4] = new Array();
  freqval[4][0] = 'Biweekly accelerated';
  freqval[4][1] = 13;
  freqval[4][2] = 26;

  freqval[5] = new Array();
  freqval[5][0] = 'Weekly';
  freqval[5][1] = 12;
  freqval[5][2] = 52;

  freqval[6] = new Array();
  freqval[6][0] = 'Weekly accelerated';
  freqval[6][1] = 13;
  freqval[6][2] = 52;

  var tablepymt = '<TABLE width="550" border="0" align="left" cellspacing="0" cellpadding="5">\n';
  tablepymt += ' <TR>\n  <TD align="center" colspan="2" class="hdrrow1">Payment Table<\/TD>\n <\/TR>\n';
  tablepymt += ' <TR>\n  <TD align="leftr" class="hdrrow2">Payment Frequency<\/TD>\n  <TD align="left" class="hdrrow2">Payment Amount (principal &amp; interest)<\/TD>\n <\/TR>\n';

  var count = 0;
  for (var i = 0; i < freqval.length; i++) {
   pymt = finalmortamt * (numer/denom);
   pymt = (pymt*freqval[i][1])/freqval[i][2];
   pymt = pymt.toFixed(2);

   halfcount = count / 2;
   floorhalfcount = Math.floor(halfcount);
   color = (halfcount == floorhalfcount) ? 'altrow1' : 'altrow2';
   count++;

   tablepymt += ' <TR class="'+color+'">\n  <TD align="left">' + freqval[i][0] + '<\/TD>\n  <TD align="left">$' + pymt + '<\/TD>\n <\/TR>\n';
  }

  tablepymt += '<\/TABLE>\n';
  document.getElementById('mthlypymt').innerHTML = tablepymt;

  return false;
}
//-- End -->


<!-- Begin
// mortgage calculator - calculates payment amount for all payment frequencies without purchase price or downpayment fields with amortization table
function MortCal3Amort (formobj) {
 var pymt;
 var mortgageamtok = 0;
 var amortok = 0;
 var valcaltext = 'system will calculate';
 mortgageamt = formobj.elements['mortgageamt'].value;
 interest = formobj.elements['interestrate'].value;
 amort = formobj.elements['amortization'].value;
 document.getElementById('mthlypymt').innerHTML = valcaltext;

 if (mortgageamt != '' && interest != '' && amort != '') {
  mortgageamt = mortgageamt.replace(',','');
  if (isNaN(mortgageamt) || isNaN(interest) || isNaN(amort)) {
   alert('One of your entries is not a number.');
   return false;
  } else {
   if (mortgageamt >= minmortgageamt && mortgageamt <= maxmortgageamt) {
    mortgageamtok = 1;
   } else {
    alert("Please enter a valid 'Mortgage Amount'.");
    return false;
   }
   if (amort >= minamort && amort <= maxamort) {
    amortok = 1;
   } else {
    alert("Please enter a valid 'Amortization period'.");
    return false;
   }
  }
 } else {
  alert('Please complete all fields.');
  return false;
 }

  var finalmortamt = mortgageamt;
  var intrate = formobj.elements['interestrate'].value;
  var amort = formobj.elements['amortization'].value;

  var ical = 1 + (intrate/200);
  var icalexp = Math.pow(ical,0.166666666666666666666667);

  var numer = icalexp - 1;

  var denomy = -12*amort;
  var denom = 1-Math.pow(icalexp,denomy);

  pymt = finalmortamt * (numer/denom);

  if (freqval == '12::1') {
   pymt = pymt;
   pymtsperyear = 12;
  } else if (freqval == '24::12') {
   pymt = (pymt*12)/24;// semi-monthly
   pymtsperyear = 24;
  } else if (freqval == '24::13') {
   pymt = (pymt*13)/24;// semi-monthly accelerated
   pymtsperyear = 24;
  } else if (freqval == '26::12') {
   pymt = (pymt*12)/26;// bi-weekly
   pymtsperyear = 26;
  } else if (freqval == '26::13') {
   pymt = (pymt*13)/26;// bi-weekly accelerated
   pymtsperyear = 26;
  } else if (freqval == '52::12') {
   pymt = (pymt*12)/52;// weekly
   pymtsperyear = 52;
  } else if (freqval == '52::13') {
   pymt = (pymt*13)/52;// weekly accelerated
   pymtsperyear = 52;
  }

  pymt = pymt.toFixed(2);
  document.getElementById('mthlypymt').innerHTML = '$'+pymt;

  var table = '<TABLE width="550" border="0" align="center" cellspacing="0" cellpadding="5">\n';
  table += ' <TR>\n  <TD align="center" colspan="4" class="hdrrow1">Amortization Table<\/TD>\n <\/TR>\n';
  table += ' <TR>\n  <TD align="center" class="hdrrow2">Payment #<\/TD>\n  <TD align="center" class="hdrrow2">Interest Payment<\/TD>\n  <TD align="center" class="hdrrow2">Principal Payment<\/TD>\n  <TD align="center" class="hdrrow2">Balance<\/TD>\n <\/TR>\n';
  var mortbal = finalmortamt;
  var intpymt,prinpymt,halfcount,floorhalfcount,color,row,oldmortbal;
  var count = 0;
  var totalprinpymt = 0;

  while (mortbal > 0) {
   oldmortbal = mortbal;
   if (freqval == '12::1') {
    intfactor = numer;
   } else if (freqval == '24::12') {
    intfactor = ((numer*12)/24);
   } else if (freqval == '24::13') {
    intfactor = ((numer*13)/24);
   } else if (freqval == '26::12') {
    intfactor = ((numer*12)/26);
   } else if (freqval == '26::13') {
    intfactor = ((numer*13)/26);
   } else if (freqval == '52::12') {
    intfactor = ((numer*12)/52);
   } else if (freqval == '52::13') {
    intfactor = ((numer*13)/52);
   }

   intpymt = mortbal * intfactor;
   var intpymtfixed = intpymt.toFixed(2);

   prinpymt = pymt - intpymt;
   mortbal = mortbal - prinpymt;
   if (parseInt(mortbal) < parseInt(prinpymt)) {
    prinpymt = oldmortbal;
    mortbal = 0;
   }

   totalprinpymt += prinpymt;

   var prinpymtfixed = prinpymt.toFixed(2);
   var mortbalfixed = mortbal.toFixed(2);

   halfcount = count / 2;
   floorhalfcount = Math.floor(halfcount);
   color = (halfcount == floorhalfcount) ? 'altrow1' : 'altrow2';

   count++;

   row = ' <TR class="'+color+'">\n';
   row += '  <TD align="center">'+count+'<\/TD>\n'+'  <TD align="center">$'+intpymtfixed+'<\/TD>\n'+'  <TD align="center">$'+prinpymtfixed+'<\/TD>\n'+'  <TD align="center">$'+mortbalfixed+'<\/TD>\n';
   row += ' <\/TR>\n';
   table += row;
  } // closes while (mortbal > 0)


  table += '<\/TABLE>\n';
  document.getElementById('amorttable').innerHTML = table;
  var totalprinpymtfixed = totalprinpymt.toFixed(2);

  return false;
}
//-- End -->





