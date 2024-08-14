<?php
if (!isset($_SESSION['user']))
	die("<br /><br />You must be logged in to view this page! Click <a href='../index.php'>here</a> to login.");
$user = $_SESSION['user'];
?>