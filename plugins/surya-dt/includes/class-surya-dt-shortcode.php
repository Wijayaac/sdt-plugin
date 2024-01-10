<?php
// TODO: create custom WP Shortcode for displaying the Google Maps and Form
function sdt_map_shortcode()
{
	$opt_name = 'sdt_test';

	$kmlUrl = Redux::get_option($opt_name, 'opt-kml-url');
	$apiKey = Redux::get_option($opt_name, 'opt-api-key');

	if ($kmlUrl == '' || $apiKey == '') {
		return "<p>Please set the API Key and KML URL in the admin panel</p>";
	}


	$ctaLinkInside = Redux::get_option($opt_name, 'opt-cta-link-inside');
	$ctaLinkOutside = Redux::get_option($opt_name, 'opt-cta-link-outside');
	$latitude = Redux::get_option($opt_name, 'opt-latitude');
	$longitude = Redux::get_option($opt_name, 'opt-longitude');

	return "
			<p>
				<label>Address Search</label>
				<input type='text' size='60' id='sdt-address' name='address' value='90/130 Swanston St, Melbourne VIC 3000, Australia' class='address'>
				<button type='button' id='sdt-submit-btn'>Search</button>
			</p>
			<p id='status-message'></p>
			<div id='map_canvas' class='sdt-map' data-latitude='$latitude' data-longitude='$longitude' data-kml='$kmlUrl'>
			</div>
			<div>
				<p>Useful link</p>
				<ul>
					<li>
						<a href='$ctaLinkOutside' target='_blank' id='outside-cta'>Outside location Partner</a>
					</li>
					<li>
						<a href='$ctaLinkInside' target='_blank' id='inside-cta'>Inside location Partner</a>
					</li>
				</ul>
			</div>
	";
}

add_shortcode('sdt_shortcode', 'sdt_map_shortcode');
