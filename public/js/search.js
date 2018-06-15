
/*
jQuery(".ex2").slider({});
*/

 jQuery("#advanced-form").toggle()

jQuery("#advanced-search").click(
  function() {
    jQuery("#advanced-search").toggleClass("advanced-black")
  jQuery("#advanced-form").toggleClass("hide")
	hiddenField = jQuery('#advancedValue');
     val = hiddenField.val();
    hiddenField.val(val === "1" ? "0" : "1");
  });

if(jQuery('#advancedValue').val() === "1") jQuery("#advanced-search").trigger("click")

jQuery(window).bind('load resize', function(){
	var search_listing = jQuery('.search-listing').outerWidth();
	var form_element_width = 0;
	jQuery('.width-element').each(function(){
		form_element_width += jQuery(this).outerWidth();
	});
	jQuery('.flexible-text').width(search_listing - form_element_width - 30 + 'px');
});

jQuery('.search-input--what').click(function(){
	jQuery('.search-input--what-content').toggleClass("hide");
});