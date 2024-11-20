<?php
session_start();
include_once '../includes/config.php';

if (!isLoggedIn()) {
    redirect('/pages/login.php');
}

// Sepet işlemleri
echo "<h1>Sepetiniz</h1>";
