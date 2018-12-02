<?php

$credentials = json_decode(file_get_contents('../../techdumpsdb.json'), true);

try{
	$sql = new PDO($credentials['dsn'], $credentials['username'], $credentials['password'], [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	]);
}catch(PDOException $e){
	http_response_code(500);
	die(json_encode(['error' => 'Failed to connect to database']));
}