<?php

$serverProtocol = stripos($_SERVER['SERVER_PROTOCOL'], 'http') === 0 ? 'http://' : 'https://';
$serverHost = $_SERVER['HTTP_HOST'];
$path = str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$serverProtocol .= $serverHost .= $path;
define('BASE_URL', $serverProtocol);
