<?php

require '../resources/sites.php';

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=$site_data['name']?> Tech Dump Guide</title>
		<link rel="stylesheet" href="../resources/sites.css">
		<link rel="stylesheet" href="../resources/guide.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>var name = '<?=$td?>';</script>
		<script src="../resources/guide.js"></script>
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
				<a href="../guide/?site=<?=$td?>" class="current">Guide</a>
				<a href="../inventory/?site=<?=$td?>">Inventory</a>
				<a href="../trends/?site=<?=$td?>">Trends</a>
			</div>
		</div>
		<div id="content" class="menupadding">

		</div>
		<div id="sidemenu">
			<a href="../">Home</a>
			<?php side_menu_links(); ?>
		</div>
	</body>
</html>