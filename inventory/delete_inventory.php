<?php

$itemID = $_GET['itemid'] ?? null;

// Check for missing itemid parameter
if(!$itemID){
	http_response_code(400);
	header('Content-Type: application/json');
	die(json_encode(['error' => 'Missing itemid parameter']));
}

// Connect to the database
require 'database.php';

// Mark the item as deleted in the items table
try{
	$delete_stmt = $sql->prepare('UPDATE inventory_items SET Deleted = 1, DeletedDate = CURRENT_TIMESTAMP WHERE ID = ?');
	$delete_stmt->execute([$itemID]);
}catch(PDOException $e){
	http_response_code(500);
	header('Content-Type: application/json');
	die(json_encode(['error' => 'Failed to insert into the database']));
}