<?php

$td = $_GET['td'] ?? null;

$title = $_POST['title'] ?? null;
$description = $_POST['description'] ?? '';
$categories = $_POST['category'] ?? [];

// Set the proper Content-Type header for a JSON response
header('Content-Type: application/json');

// Check for missing td parameter
if(!$td){
	http_response_code(400);
	die(json_encode(['error' => 'Missing td parameter']));
}
// Check for missing title parameter
if(!$title){
	http_response_code(400);
	die(json_encode(['error' => 'Missing required field "title"']));
}

// Handle uploaded picture
$picture = $_FILES['picture'] ?? null;
if($picture){
	if($picture['error']){
		http_response_code(500);
		die(json_encode(['error' => 'Error uploading picture']));
	}
	$check = getimagesize($picture['tmp_name']);
	if($check !== false){
		if($check['mime'] != 'image/jpeg'){
			http_response_code(422);
			die(json_encode(['error' => 'Uploaded picture is not a JPEG']));
		}
	}else{
		http_response_code(422);
		die(json_encode(['error' => 'Uploaded picture is not an image']));
	}
}

// Connect to the database
require 'database.php';

// Insert the item into the database
try{
	// Insert prepared statements
	$item_stmt = $sql->prepare('INSERT INTO inventory_items (TechDump, Title, Description, HasPicture) VALUES (?, ?, ?, ?)');
	$category_stmt = $sql->prepare('INSERT INTO inventory_category_membership (ItemID, CategoryID) VALUES (?, ?)');

	$sql->beginTransaction();

	// Insert item into the items table
	$item_stmt->execute([
		$td, $title, $description, $picture ? true : false
	]);

	$itemID = $sql->lastInsertId();

	// Insert categories into the category membership table
	foreach($categories as $category){
		$category_stmt->execute([
			$itemID,
			$category
		]);
	}

	$sql->commit();

}catch(PDOException $e){
	http_response_code(500);
	die(json_encode(['error' => 'Failed to insert into the database']));
}

// Move the uploaded picture
$picture_path = "../resources/item_pictures/$itemID.jpg";
move_uploaded_file($picture['tmp_name'], $picture_path);

// Generate Thumbnail
$img_full = imagecreatefromjpeg($picture_path);
$new_width = 135 / $check[1] * $check[0];
$img_thumbnail = imagecreatetruecolor($new_width, 135);
imagecopyresampled($img_thumbnail, $img_full, 0, 0, 0, 0, $new_width, 135, $check[0], $check[1]);
imagedestroy($img_full);
imagejpeg($img_thumbnail, "../resources/item_pictures/thumbnails/$itemID.jpg");
imagedestroy($img_thumbnail);

header("Location: ./?site=$td");
die('Error: Failed to redirect back to the inventory page');