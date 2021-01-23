var office;
var imgurl;
function addListing(marker) {
    //marker = marker.replace(/{{CHANGEURL}}/g, realurl);
    if (marker.firstname) {

        var a_html = "<li class='col-sm-3 agentsbox' style='height:370px;'><a href='" + realurl + "/" + marker.aid + "/" + jQuery.trim(marker.firstname.toLowerCase()) + "-" + jQuery.trim(marker.lastname.toLowerCase()) + "'><div class=''><img class='img-responsive' src='https://curiouscloud.ca/agents/" + marker.photo + "' /><br />" + marker.firstname + " <span class='last-name'>" + marker.lastname + "</span><br /><small>" + marker.title + "</small></div>";

        if (marker.award_winner.length > 0) {
            a_html += '<div class="a_info">';
            jQuery.each(marker.award_winner , function (i, award)
            {
                if(award == "National Chairman's Club")
                {
                    a_html += '<img class="img-responsive image-award lazyloaded" src="'+ imgurl +'awards/' + award +'.png">';
                }
                else{
                    a_html += '<img class="img-responsive image-award lazyloaded" src="'+ imgurl +'awards/' + award +'.jpg">';
                }

            });
            a_html +="<div class='a_year'><small>"+marker.award_year+"</small></div>";
            a_html += "</div>";

        }


        a_html += "</a></li>";
        jQuery("#listings").append(a_html);
    }
}

jQuery("#submit").click(function (event) {
    event.preventDefault();
    data2 = jQuery("#agent-search").serializeArray();
    var filterObj = {
        name: "filter",
        value: filter
    };

    var faw = {
        name: "award",
        value: award
    };
    data2.push(filterObj);
    data2.push(faw);
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
var faw = {
    name: "award",
    value: award
};
fdata.push(fObj);
fdata.push(faw);

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