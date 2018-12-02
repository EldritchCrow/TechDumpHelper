<?php

require '../resources/sites.php';

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$site_data['name']?> Tech Dump Inventory</title>
		<link rel="stylesheet" href="../resources/sites.css">
		<link rel="stylesheet" href="../resources/inventory.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>var td = '<?=$td?>';</script>
		<script src="../resources/inventory.js"></script>
		<script src="../resources/sites.js"></script>
	</head>
	<body>
		<div id="header">
			<div id="sidemenu-toggle">
				<div class="hamburger">
					<div></div>
					<div></div>
					<div></div>
				</div>
			</div>
			<h1><?=$site_data['name']?></h1>
			<div id="header-navigation">
				<a href="../guide/?site=<?=$td?>">Guide</a>
				<a href="../inventory/?site=<?=$td?>" class="current">Inventory</a>
				<a href="../trends/?site=<?=$td?>">Trends</a>
			</div>
		</div>
		<div id="content" class="menupadding">
			<div id="inventory">
				<div id="new-item">
					<button id="new-item-button" onclick="$('#new-item form').slideDown();$(this).slideUp();$('#new-item-form-title').focus();">+ New Item</button>
					<form action="add_inventory.php?td=<?=$td?>" method="post" enctype="multipart/form-data">
						<label>
							Title:<br>
							<input id="new-item-form-title" type="text" name="title" required>
						</label><br>
						<br>
						<label>
							Description:<br>
							<textarea name="description" rows="3"></textarea><br>
						</label><br>
						Categories:
						<div class="item-categories"></div>
						<br>
						<label>
							Picture:
							<input type="file" name="picture" value="Open Camera/File">
						</label><br>
						<br>
						<input type="submit" value="Submit">
						<input type="button" value="Cancel" onclick="$('#new-item form').slideUp();$('#new-item-button').slideDown();">
					</form>
				</div>
			</div>
		</div>
		<div id="sidemenu">
			<a href="../">Home</a>
			<?php side_menu_links(); ?>
		</div>
	</body>
</html>