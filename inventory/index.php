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
		</div>
		<div id="sidemenu">
			<a href="../">Home</a>
			<?php side_menu_links(); ?>
		</div>
	</body>
</html>