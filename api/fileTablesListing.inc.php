<?php
include __DIR__ . '/../../pgdbcreds.inc.php';

/* Postgres queries to array all files posted by the user */
$getAllFilesByUserQuery = "SELECT * FROM logs WHERE token='" . $_SESSION['userToken'] . "'"; 
$getAllFilesByUserExecution = pg_exec($database, $getAllFilesByUserQuery);
$getAllFilesByUserRows = pg_fetch_all($getAllFilesByUserExecution);
?>