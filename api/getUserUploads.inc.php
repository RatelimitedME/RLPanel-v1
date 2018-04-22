<?php
session_start();
include __DIR__ . '/../../pgdbcreds.inc.php';
include __DIR__ . '/../libs/authLib.inc.php';

if($_GET['q'] == 'GetAllUploadsByToken'){
	$getUserUploadsQuery = "SELECT * FROM logs WHERE token = '" . $_SESSION['userToken'] . "' AND (deleted IS NULL OR deleted IS FALSE)";
	$getUserUploadsExecution = pg_exec($database, $getUserUploadsQuery);
	$getUserUploadsRows = pg_fetch_all($getUserUploadsExecution);
	echo json_encode(array('data' => $getUserUploadsRows));
}
?>

