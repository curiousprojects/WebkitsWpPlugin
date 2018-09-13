<?php

?>

<div class="wrap">
    <div id="icon-plugins" class="icon32"></div>
    <h2>WebKits Options</h2>

    <?php if (isset($update_feed_now_result)) { ?>
    <div id="message" class="updated">
        <h4>We updated the feed successfully!</h4>
    </div>
    <?php } ?>

    <form method="post" action="">

        <input type="hidden" name="webkits_form_submitted" value="Y">

        <table class="form-table">
            <tbody>

            <tr>
                <th scope="row"><label for="webkits_list_id">CREA Client ID<br/><em>(No listings will appear if this field isn't filled by March 1, 2018)</em></label></th>
                <td><input name="webkits_crea_clientid" id="webkits_crea_clientid" value="<?php echo $webkits_crea_clientid; ?>" class="regular-text" type="text"></td>
            </tr>

            <tr>
                <th scope="row"><label for="listing_page">Site Type</label></th>
                <td>
                    <select name="webkits_site_type" id="webkits_site_type">
                        <option <?php if ($options['webkits_site_type'] == 'broker') { ?>selected="selected"<?php } ?> value="broker">Broker Firm</option>
                        <option <?php if ($options['webkits_site_type'] == 'agent') { ?>selected="selected"<?php } ?> value="agent">Agents</option>
                        <option <?php if ($options['webkits_site_type'] == 'both') { ?>selected="selected"<?php } ?> value="both">Both</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_list_id">List IDs<br/><em>(Seperate Multiple with Commas or Brokerage/Agents)</em></label></th>
                <td><input name="webkits_list_id" id="webkits_list_id" value="<?php echo $webkits_list_id; ?>" class="regular-text" type="text"></td>
            </tr>

            <hr/>
            <tr>
                <th scope="row"><label for="listing_page">Search</label></th>
                <td>
                    <select name="webkits_ssite_type" id="webkits_ssite_type">
                        <option <?php if ($options['webkits_ssite_type'] == 'broker') { ?>selected="selected"<?php } ?> value="broker">Broker Firm</option>
                        <option <?php if ($options['webkits_ssite_type'] == 'agent') { ?>selected="selected"<?php } ?> value="agent">Agents</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_slist_id">Search IDs<br/><em>(Seperate Multiple with Commas)</em></label></th>
                <td><input name="webkits_slist_id" id="webkits_slist_id" value="<?php echo $webkits_slist_id; ?>" class="regular-text" type="text"></td>
            </tr>

            <tr>
                <th scope="row"><label for="listing_page">No Listing Fallback</label></th>
                <td>
                    <select name="webkits_zerofall" id="webkits_zerofall">
                        <option <?php if (isset($options['webkits_zerofall']) && $options['webkits_zerofall'] == '0') { ?>selected="selected"<?php } ?> value="0">Don't Show Listings</option>
                        <option <?php if (!isset($options['webkits_zerofall']) || $options['webkits_zerofall'] == '1') { ?>selected="selected"<?php } ?> value="1">Show "Search" Listings</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_listing_default">Listings Default View</label></th>
                <td>
                    <select name="webkits_listing_default" id="webkits_listing_default">
                        <option <?php if ($options['webkits_listing_default'] == 'grid') { ?>selected="selected"<?php } ?> value="grid">Grid</option>
                        <option <?php if ($options['webkits_listing_default'] == 'list') { ?>selected="selected"<?php } ?> value="list">List</option>
                        <option <?php if ($options['webkits_listing_default'] == 'table') { ?>selected="selected"<?php } ?> value="table">Table</option>
                        <option <?php if ($options['webkits_listing_default'] == 'map') { ?>selected="selected"<?php } ?> value="map">Map</option>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_slist_id">Listings Per Page<br/></label></th>
                <td><input name="webkits_listing_perpage" id="webkits_listing_perpage" value="<?php echo $webkits_listing_perpage; ?>" class="regular-text" type="number"></td>
            </tr>


                        <tr>
                <th scope="row"><label for="listing_page">CREA Agreement Message</label></th>
                <td>
                    <select name="webkits_agree_msg" id="webkits_agree_msg">
                        <option <?php if ($options['webkits_agree_msg'] == '1') { ?>selected="selected"<?php } ?> value="1">Display</option>
                        <option <?php if ($options['webkits_agree_msg'] == '0') { ?>selected="selected"<?php } ?> value="0">Hide</option>
                    </select>
                </td>
            </tr>


            <tr>
                <td colspan="2"><hr/></td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_latlng">Map Default Coordinates<br/><em>(Lat,Lng)</em></label></th>
                <td><input name="webkits_latlng" id="webkits_latlng" value="<?php if (!isset($webkits_latlng)) echo '45.420297,-75.692362'; else echo $webkits_latlng; ?>" class="regular-text" type="text"></td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_map_zoom">Listings Details Map Zoom Level<br/><em>(15-1) - 0 will zoom to cover all</em></label></th>
                <td><input name="webkits_map_zoom" id="webkits_map_zoom" value="<?php if (!isset($webkits_map_zoom)) echo '10'; else echo $webkits_map_zoom; ?>" class="regular-text" type="text"></td>
            </tr>
            <tr>
                <th scope="row"><label for="webkits_map_zoom2">All Listings Map Zoom Level<br/><em>(15-1) - 0 will zoom to cover all</em></label></th>
                <td><input name="webkits_map_zoom2" id="webkits_map_zoom2" value="<?php if (!isset($webkits_map_zoom2)) echo '5'; else echo $webkits_map_zoom2; ?>" class="regular-text" type="text"></td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_hide_agents">Hide Agent Name<br/><em></em></label></th>
                <td><input name="webkits_hide_agents" id="webkits_hide_agents" value="1" class="regular-text" type="checkbox" <?php echo $webkits_hide_agents; ?> ></td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_bc_agent">BC Agent?<br/><em></em></label></th>
                <td><input name="webkits_bc_agent" id="webkits_bc_agent" value="1" class="regular-text" type="checkbox" <?php echo $webkits_bc_agent; ?> ></td>
            </tr>

            <tr>
                <td colspan="2"><hr/></td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_listings_page">Select Listings Page</label></th>
                <td>
                    <select name="webkits_listings_page" id="webkits_listings_page">
                        <?php foreach ($pages as $p) { ?>

                            <option value="<?php echo $p->ID; ?>" <?php if ($options['webkits_listings_page'] == $p->ID) { ?>selected="selected"<?php } ?> ><?php echo $p->post_title; ?></option>';

                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_list_id">Select Listing's Details Page</label></th>
                <td>
                    <select name="webkits_listing_page" id="webkits_listing_page">
                        <?php foreach ($pages as $p) { ?>

                            <option value="<?php echo $p->ID; ?>" <?php if ($options['webkits_listing_page'] == $p->ID) { ?>selected="selected"<?php } ?> ><?php echo $p->post_title; ?></option>';

                        <?php } ?>
                    </select>
                </td>
            </tr>


            <tr>
                <th scope="row"><label for="webkits_list_id">Select Agent's Details Page</label></th>
                <td>
                    <select name="webkits_agent_page" id="webkits_agent_page">
                        <?php foreach ($pages as $p) { ?>

                            <option value="<?php echo $p->ID; ?>" <?php if ($options['webkits_agent_page'] == $p->ID) { ?>selected="selected"<?php } ?> ><?php echo $p->post_title; ?></option>';

                        <?php } ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_map_style">Snazzy Map Code</label></th>
                <td>
                    <textarea name="webkits_map_style" id="webkits_map_style" cols="50" rows="8"><?php echo $webkits_map_style; ?></textarea>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_feature_template">Featured Listings Template</label></th>
                <td>
                    <textarea name="webkits_feature_template" id="webkits_feature_template" cols="50" rows="8"><?php echo $webkits_feature_template; ?></textarea>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_rss_feed">List IDs<br/></label></th>
                <td>
                    <input name="webkits_rss_feed" id="webkits_rss_feed" value="<?php echo $webkits_rss_feed; ?>" class="regular-text" type="text" placeholder='http://teamrealty.ca'>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_update_feed_now">Update feed now</label></th>
                <td>
                    <input name="webkits_update_feed_now" type="checkbox" value="Y"/>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="webkits_officemlsid">Office MLSID#</label></th>
                <td>
                    <input name="webkits_officemlsid" type="text" value="<?php echo $webkits_officemlsid; ?>"/>
                </td>
            </tr>

            </tbody>
        </table>


        <?php submit_button(); ?>
    </form>
</div>
