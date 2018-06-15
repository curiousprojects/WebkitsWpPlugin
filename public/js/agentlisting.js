
var offset = 0;
var found = 0;
var totaled = 0;
function addListing(marker){

marker = marker.replace(/{{CHANGEURL}}/g, realurl); 

jQuery("#listings").append(marker)

}


jQuery("#LoadMore").click(function() {
	 offset = offset + 50;
	jQuery("#LoadMore").hide();
	data2 = jQuery("#search").serializeArray();
	data2[data2.length] = { name: 'offset', value: offset};
	jQuery("#Loading").show()
jQuery.post( ajaxurl,{data:data2,action:actionurl},function(data) {
			jQuery.each( data.listing, function(i, marker) {
				addListing(marker.listing)
		});
	},"json").always(function() {
		jQuery("#Loading").hide()
if (totaled <= offset) jQuery("#LoadMore").hide();
 else 	jQuery("#LoadMore").show();
	});
});

	jQuery.post( ajaxurl,{data:agent,action:"webkits_get_agent_listing"},function(data) {
		//alert("1")
		//alert(data);
jQuery("#Loading").show()
found =1
jQuery.each( data.listing, function(i, marker) {
				addListing(marker.listing)

})



	},"json").always(function() {
		jQuery("#Loading").hide()

		if (totaled <= offset) jQuery("#LoadMore").hide();
		 else 	jQuery("#LoadMore").show();
if(totaled == 0) { 
jQuery('#list').hide();
jQuery('#grid').hide();
} else {
jQuery('#list').show();
jQuery('#grid').show();
}

	});;


var listing = "grid";

    jQuery('#list').click(function(event){event.preventDefault();jQuery('#listings .itemlist').addClass('list-group-item');
listing = "list"
jQuery('#listings .listimg').addClass('col-sm-4');
jQuery('#listings .caption').addClass('col-sm-8');
});
    jQuery('#grid').click(function(event){event.preventDefault();
    	listing = "grid"
jQuery('#listings .listimg').removeClass('col-sm-4');
jQuery('#listings .caption').removeClass('col-sm-8');
    	jQuery('#listings .itemlist').removeClass('list-group-item');jQuery('#listings .itemlist').addClass('grid-group-item');});


