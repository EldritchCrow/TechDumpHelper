<?php

// Check for site parameter
$td = $_GET['site'] ?? null;
if(!$td){
	http_response_code(400);
	die('Error: site parameter is missing');
}

// Get site information
$site_data = json_decode(file_get_contents('../resources/site_data.json'), true);
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

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$site_data['name']?> Tech Dump Inventory</title>
		<link rel="stylesheet" href="../resources/inventory.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>var td = '<?=$td?>';</script>
		<script src="../resources/inventory.js"></script>
	</head>
	<body>
		<div id="header">
			<h1><?=$site_data['name']?> Inventory</h1>
		</div>
		<div id="inventory">
			<div id="new-item">
				<button onclick="$('#new-item form').slideToggle();">+ New Item</button>
				<form action="add_inventory.php?td=<?=$td?>" method="post">
					<label>
						Title:
						<input type="text" name="title" required>
					</label><br>
					<label>
						Description:<br>
						<textarea name="description"></textarea><br>
					</label>
					Categories:
					<div class="item-categories"></div>
					<label>
						Picture:
						<input type="file" name="picture">
					</label><br>
					<input type="submit" value="Submit">
					<input type="button" value="Cancel" onclick="$('#new-item form').slideUp()">
				</form>
			</div>
		</div>
	</body>
</html>