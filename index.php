<?php

if (!isset($_GET['hostname'])) { exit(); }

$hostname = $_GET['hostname'];
$logfile = $_GET['log'];
$logfile = "logs/" . $logfile . ".log";

if (!file_exists('logs')) { mkdir('logs'); }
if (!file_exists($logfile)) { touch($logfile); }

$timestamp = time() . " " . date("Y-m-d_H:i:s");

$logentry = $timestamp . " " . $hostname . "\n";

file_put_contents($logfile, $logentry, FILE_APPEND | LOCK_EX);
