<?php
/* Requirements 

TODO: change 'include' to 'require' after deploying into production.

*/

include __DIR__ . '/../../pgdbcreds.inc.php';
include __DIR__ . '/../libs/authLib.inc.php';
/* User Totals */

$usersTotalQuery = pg_query($database, "SELECT * FROM users");
$usersTotalRowCount = pg_num_rows($usersTotalQuery);

$getRegisteredUsersCount = $usersTotalRowCount;

$signupsPendingQuery =  pg_query($database, "SELECT * FROM signups WHERE status='Pending'");
$signupsPendingRowCount = pg_num_rows($signupsPendingQuery);

$getSignupsPendingCount = $signupsPendingRowCount;
/* File Upload Totals */

$filesTotalQuery = pg_query($database, "SELECT * FROM logs");
$filesTotalRowCount = pg_num_rows($filesTotalQuery);

$getTotalFilesUploadedCount = $filesTotalRowCount;

/* File Upload Totals by User */
$filesTotalByUserQuery = pg_query($database, "SELECT * FROM logs WHERE token='" . $_SESSION['userToken'] . "'");
$filesTotalByUserRowCount = pg_num_rows($filesTotalByUserQuery);

$getTotalFilesUploadedByUserCount = $filesTotalByUserRowCount;
?>
