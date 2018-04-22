<?php
/* Start The Session */
session_start();
require '../libs/authLib.inc.php';
if($_POST['Action'] == "Delete"){
	/* Remove all possible SQL injection characters from the POST segment (Thanks, omega12) */
	
	$removeFromStr[] = "'";
	$removeFromStr[] = "=";
	$removeFromStr[] = "(";
	$removeFromStr[] = ")";
	$removeFromStr[] = '"';
	$SQLPreventedFileName = str_replace( $removeFromStr, "", implode($_POST['fileName']) );
	$SQLPreventedMD5Hash = str_replace( $removeFromStr, "", implode($_POST['fileMD5Hash']) );
	$SQLPreventedSHA1Hash = str_replace( $removeFromStr, "", implode($_POST['fileSHA1Hash']) );
	
	/* Mark the file as deleted in the database */
	$deleteFileQuery = "UPDATE logs SET deleted = true WHERE token = '" . $_SESSION['userToken'] . "' AND filename = '" . $SQLPreventedFileName . "' AND md5hash = '" . $SQLPreventedMD5Hash . "' AND sha1hash = '" . $SQLPreventedSHA1Hash . "'";
	$deleteFileExecution = pg_exec($database, $deleteFileQuery);

	/* Select the file from the database to confirm that it is indeed marked as deleted */
	$deleteFileSelectQuery = "SELECT * FROM logs WHERE token = '" . $_SESSION['userToken'] . "' AND filename = '" . $SQLPreventedFileName . "' AND md5hash = '" . $SQLPreventedMD5Hash . "' AND sha1hash = '" . $SQLPreventedSHA1Hash . "'";
	$deleteFileSelectExecution = pg_exec($database, $deleteFileSelectQuery);	
	$deleteFileSelectReturn = pg_fetch_array($deleteFileSelectExecution);

	/* If deleted, proceed to moving it to pre-delete phase */
	if($deleteFileSelectReturn['deleted'] == true){
	rename('/d2/buckets/owoapi/' . $_POST['fileName'], '/d2/RLDeletedFiles/' . $_POST['fileName']);
	$successResponseArray = array('success' => 'true', 'fileName' => $SQLPreventedFileName, 'status' => 'Pending Deletion');
	echo json_encode($successResponseArray);
}else{ /* Otherwise, display an error message */
	$failedResponseArray = array('success' => 'false', 'fileName' => $SQLPreventedFileName, 'status' => 'Unable to delete, please contact the system administrator');
	echo json_encode($failedResponseArray);
}
}
?>
