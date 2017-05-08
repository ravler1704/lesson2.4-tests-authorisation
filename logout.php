<?php
require_once 'core.php';
if (!isAuthorized()) {
    location('login');
}
logout();
?>