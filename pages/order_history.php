<?php
session_start();
include_once '../includes/config.php';

if (!isLoggedIn()) {
    redirect('/pages/login.php');
}

$query = "SELECT * FROM siparisler WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$orders = $stmt->fetchAll();

echo "<h1>Sipariş Geçmişi</h1>";
foreach ($orders as $order) {
    echo "<div>
            <p>Sipariş ID: " . $order['id'] . "</p>
            <p>Durum: " . $order['durum'] . "</p>
            <p>Toplam Fiyat: " . $order['toplam_fiyat'] . "</p>
          </div>";
}
