<?php
include __DIR__ . '/../../pgdbcreds.inc.php';
$getUserDetailsQuery = "SELECT * FROM users WHERE discordid='" . $_SESSION['discordId'] . "'";
$getUserDetailsExecution = pg_exec($database, $getUserDetailsQuery);
$getUserDetailsRow = pg_fetch_array($getUserDetailsExecution);

if($getUserDetailsRow['is_blocked'] == true){
	$userIsBanned = true;
}

if($getUserDetailsRow['is_admin'] == true){
	$userIsAdmin = true;
}

if($getUserDetailsRow['is_admin'] == false || $getUserDetailsRow['is_admin'] == null){
	$userIsAdmin = false;
}

$getUserTokenQuery = "SELECT * FROM tokens WHERE user_id='" . $getUserDetailsRow['id'] . "'";
$getUserTokenExecution = pg_exec($database, $getUserTokenQuery);
$getUserTokenRow = pg_fetch_array($getUserTokenExecution);

$_SESSION['userToken'] = $getUserTokenRow['token'];
?>
