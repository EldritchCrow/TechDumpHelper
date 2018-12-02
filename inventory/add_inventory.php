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

// Connect to the database
require 'database.php';

// Insert the item into the database
try{
	// Insert prepared statements
	$item_stmt = $sql->prepare('INSERT INTO inventory_items (TechDump, Title, Description) VALUES (?, ?, ?)');
	$category_stmt = $sql->prepare('INSERT INTO inventory_category_membership (ItemID, CategoryID) VALUES (?, ?)');

	$sql->beginTransaction();

	// Insert item into the items table
	$item_stmt->execute([
		$td, $title, $description
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