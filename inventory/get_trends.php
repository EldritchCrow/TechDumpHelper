<?php

$td = $_GET['td'] ?? null;
$days_diff = $_GET['days_diff'] ?? null;

// Set the proper Content-Type header for a JSON response
header('Content-Type: application/json');

// Check for missing td parameter
if(!$td){
	http_response_code(400);
	die(json_encode(['error' => 'Missing td parameter']));
}

if(!$days_diff){
	http_response_code(400);
	die(json_encode(['error' => 'Missing days_diff parameter']));
}

// Connect to the database
require 'database.php';

// Get the inventory for the specified tech dump
try{
	$trends_stmt = $sql->prepare("SELECT inventory_categories.Name, COUNT(inventory_categories.Name) AS quantity

   FROM inventory_category_membership
      JOIN inventory_items
          ON inventory_items.ID = inventory_category_membership.ItemID
           AND inventory_items.TechDump = ?
           AND inventory_items.Date > ?
          JOIN inventory_categories
             ON inventory_categories.ID = inventory_category_membership.CategoryID
   
   GROUP BY inventory_categories.Name
   ORDER BY COUNT(inventory_categories.Name) DESC");
   $current_date = new DateTime();
   $date_interval = new DateInterval("P{$days_diff}D");
   $current_date->sub($date_interval);
	$trends_stmt->execute([$td, $current_date->format('Y-m-d H:i:s')]);
	$trends_rows = $trends_stmt->fetchAll();
}catch(PDOException $e){
	http_response_code(500);
	die(json_encode(['error' => 'Failed to query the database']));
}

// Return the data encoded as JSON
echo json_encode($trends_rows);