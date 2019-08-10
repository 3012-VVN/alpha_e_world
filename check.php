<?php

$allowed_hosts = array('13.235.47.117');
if (!isset($_SERVER['HTTP_HOST']) || in_array($_SERVER['HTTP_HOST'], $allowed_hosts)) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 400 Bad Request');
    exit;
}