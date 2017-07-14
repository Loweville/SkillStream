<?php
session_start();
ob_start();
$server = 'database.lcn.com';
$user = 'LCN350539_Admin';
$pass = 'Jlowe42';
$db = 'jensenlowe_co_uk_Job_Inventors';
$link = mysql_connect($server,$user,$pass);
if (!is_resource($link)) {
    die("Could not connect to the MySQL server at localhost.");
} else {
    mysql_select_db($db);
}
?>
