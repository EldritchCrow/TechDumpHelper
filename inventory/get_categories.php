<?php

// Set the proper Content-Type header for a JSON response
header('Content-Type: application/json');

// Connect to the database
require 'database.php';

// Get the categories from the database
try{
	$categories = $sql->query('SELECT ID AS id, Name AS name FROM inventory_categories ORDER BY Name')->fetchAll();
}catch(PDOException $e){
	http_response_code(500);
	die(json_encode(['error' => 'Failed to query the database']));
}

// Return the results in JSON format
echo json_encode($categories);