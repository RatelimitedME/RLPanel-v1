<?php
session_start();
include __DIR__ . '/../../pgdbcreds.inc.php';
include __DIR__ . '/../libs/authLib.inc.php';

if($userIsAdmin == true){
/* Postgres queries to array all files posted by the user */
$getAllPendingSignupRequestsQuery = "SELECT * FROM signups WHERE status = 'Pending'"; 
$getAllPendingSignupRequestsExecution = pg_exec($database, $getAllPendingSignupRequestsQuery);
$getAllPendingSignupRequestsRows = pg_fetch_all($getAllPendingSignupRequestsExecution);
if($_GET['q'] == 'GetAllPending'){
	echo json_encode(array('data' => $getAllPendingSignupRequestsRows));
}
}else{
return('Will you ever learn?');
}
?>
