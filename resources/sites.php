<?php

// Check for site parameter
$td = $_GET['site'] ?? null;
if(!$td){
	http_response_code(400);
	die('Error: site parameter is missing');
}

// Get site information
$site_data = json_decode(file_get_contents('../resources/site_data.json'), true);
$sites = $site_data['sites'];
$site_found = false;
foreach($site_data['sites'] as $index => $site){
	if($site['id'] == $td){
		$site_data = $site_data['sites'][$index];
		$site_found = true;
		break;
	}
}
// Check that site was found
if(!$site_found){
	http_response_code(404);
	die('Error: Invalid site ID');
}

// Generate side navigation menu links
function side_menu_links(){
	global $sites, $td;

	foreach($sites as $site){
		echo '<a href="?site=' . $site['id'] . '"' . ($site['id'] == $td ? ' class="current"' : '') . ">{$site['name']}</a>";
	}

}