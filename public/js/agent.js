var office;
function addListing(marker) {
    //marker = marker.replace(/{{CHANGEURL}}/g, realurl);
    if (marker.firstname) {
        jQuery("#listings").append("<li class='col-sm-3 agentsbox' style='height:250px;'><a href='" + realurl + marker.aid + "'><img class='img-responsive' src='https://curiouscloud.ca/agents/" + marker.photo + "' /><br />" + marker.firstname + " <span class='last-name'>" + marker.lastname + "</span><br /><small>" + marker.title + "</small></a></li>")
    }
}

jQuery("#submit").click(function (event) {
    event.preventDefault();
    data2 = jQuery("#agent-search").serializeArray();
    var filterObj = {
        name: "filter",
        value: filter
    };

    data2.push(filterObj);
    jQuery("#listings").remove();
    jQuery("#ListParent").html('<ul id="listings" class="imageList"></ul>');
    jQuery.post(ajaxurl, {data: data2, action: "webkits_get_agent"}, function (data) {

        jQuery.each(data.agents, function (i, marker) {
            addListing(marker);

        });

        jQuery('#listings').listnav({
            filterSelector: '.last-name',
            includeNums: false,
            //removeDisabled: true,
            includeOther: true
        });
    }, "json");
});

var fdata = [];
var fObj = {
        name: "office",
        value: office
    };
fdata.push(fObj);

jQuery.post(ajaxurl, {filter: filter, action: "webkits_get_agent",data: fdata}, function (data) {

    jQuery.each(data.office, function (i, marker) {
        jQuery('#office').append(jQuery('<option>').text(marker.name).attr('value', marker.office));
        addListing(marker);
    });

    jQuery("#listings").toggle();
    jQuery.each(data.agents, function (i, marker) {
        addListing(marker);
    });


    jQuery('#listings').listnav({
        initLetter: 'all',
        filterSelector: '.last-name',
        includeNums: false,
        //removeDisabled: true,
        includeOther: true
    });

    jQuery("#listings").toggle();
}, "json");