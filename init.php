<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config/BaseUrlConfig.php';
require_once __DIR__ . '/config/DatabaseConfig.php';

?>