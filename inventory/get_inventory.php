<?php

$td = $_GET['td'] ?? null;
$deleted = isset($_GET['deleted']);

// Set the proper Content-Type header for a JSON response
header('Content-Type: application/json');

// Check for missing td parameter
if(!$td){
	http_response_code(422);
	die(json_encode(['error' => 'Missing td parameter']));
}

// Connect to the database
require 'database.php';

// Get the inventory for the specified tech dump
try{
	$items_stmt = $sql->prepare('SELECT ID, Title, Description, Date FROM inventory_items WHERE TechDump = ? AND Deleted = ? ORDER BY Date');
	$items_stmt->execute([$td, $deleted]);
	$items_rows = $items_stmt->fetchAll();
}catch(PDOException $e){
	http_response_code(500);
	die(json_encode(['error' => 'Failed to query the database']));
}

// Prepared statement for getting item categories
try{
	$categories_stmt = $sql->prepare('SELECT Name FROM inventory_categories JOIN inventory_category_membership ON inventory_categories.ID = inventory_category_membership.CategoryID WHERE inventory_category_membership.ItemID = ?');
}catch(PDOException $e){
	http_response_code(500);
	die(json_encode(['error' => 'Failed to query the database']));
}

$items = [];
foreach($items_rows as $item){

	// Get the item's categories
	$categories = [];
	try{
		$categories_stmt->execute([$item['ID']]);
		$categories_rows = $categories_stmt->fetchAll();
	}catch(PDOException $e){
		http_response_code(500);
		die(json_encode(['error' => 'Failed to query the database']));
	}
	foreach($categories_rows as $category) array_push($categories, $category['Name']);

	// Convert the timezone
	$datetime = new DateTime($item['Date']);
	$datetime->setTimezone(new DateTimeZone('America/New_York'));

	// Populate the output array
	array_push($items, [
		'id' => $item['ID'],
		'title' => $item['Title'],
		'description' => $item['Description'],
		'datetime' => $datetime->format('m/d/y H:i A'),// Output the time in the desired format
		'categories' => $categories
	]);
}

// Return the data encoded as JSON
echo json_encode($items);