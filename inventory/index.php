<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Tech Dump Inventory</title>
		<link rel="stylesheet" href="../resources/inventory.css">
	</head>
	<body>
		<div id="header">
			<h1>Inventory</h1>
		</div>
		<div id="inventory">
			<div id="new-item">
				<button>+ New Item</button>
				<form>
					<label>
						Item Name:
						<input type="text" name="itemname" required>
					</label><br>
					<label>
						Description<br>
						<textarea name="description"></textarea><br>
					</label>
					Categories:<br>
					<label class="item-category">
						<input type="checkbox" name="category" value="junk">
						Junk
					</label>
					<label class="item-category">
						<input type="checkbox" name="category" value="computers">
						Computers
					</label><br>
					<label>
						Picture:
						<input type="file" name="picture">
					</label><br>
					<input type="submit" value="Submit">
					<input type="button" value="Cancel">
				</form>
			</div>
			<div class="item">
				<button class="item-delete">&cross;</button>
				<img class="item-image" src="" width="240" height="135">
				<div class="item-information">
					<h3 class="item-title">Title</h3>
					<div class="item-categories">
						<div class="item-category">Junk</div>
						<div class="item-category">Computers</div>
					</div>
					<p class="item-description">Description</p>
				</div>
			</div>
			<div class="item">
				<button class="item-delete">&cross;</button>
				<img class="item-image" src="" width="240" height="135">
				<div class="item-information">
					<h3 class="item-title">Title</h3>
					<div class="item-categories">
						<div class="item-category">Junk</div>
						<div class="item-category">Computers</div>
					</div>
					<p class="item-description">Description</p>
				</div>
			</div>
		</div>
	</body>
</html>