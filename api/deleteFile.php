<?php
/* Start The Session */
session_start();
require '../libs/authLib.inc.php';
if($_POST['Action'] == "Delete"){

	/* Mark the file as deleted in the database */
	$deleteFileQuery = "UPDATE logs SET deleted = true WHERE token = '" . $_SESSION['userToken'] . "' AND filename = '" . $_POST['fileName'] . "' AND md5hash = '" . $_POST['fileMD5Hash'] . "' AND sha1hash = '" . $_POST['fileSHA1Hash'] . "'";
	$deleteFileExecution = pg_exec($database, $deleteFileQuery);

	/* Select the file from the database to confirm that it is indeed marked as deleted */
	$deleteFileSelectQuery = "SELECT * FROM logs WHERE token = '" . $_SESSION['userToken'] . "' AND filename = '" . $_POST['fileName'] . "' AND md5hash = '" . $_POST['fileMD5Hash'] . "' AND sha1hash = '" . $_POST['fileSHA1Hash'] . "'";
	$deleteFileSelectExecution = pg_exec($database, $deleteFileSelectQuery);	
	$deleteFileSelectReturn = pg_fetch_array($deleteFileSelectExecution);

	/* If deleted, proceed to moving it to pre-delete phase */
	if($deleteFileSelectReturn['deleted'] == true){
	rename('/d2/buckets/owoapi/' . $_POST['fileName'], '/d2/RLDeletedFiles/' . $_POST['fileName']);
	$successResponseArray = array('success' => 'true', 'fileName' => $_POST['fileName'], 'status' => 'Pending Deletion');
	echo json_encode($successResponseArray);
}else{ /* Otherwise, display an error message */
	$failedResponseArray = array('success' => 'false', 'fileName' => $_POST['fileName'], 'status' => 'Unable to delete, please contact the system administrator');
	echo json_encode($failedResponseArray);
}
}
?>
