<?php
include_once '../includes/config.php';

$query = "SELECT * FROM urunler WHERE durum = 'onaylı'";
$stmt = $conn->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll();

echo "<h1>Ürünler</h1>";
foreach ($products as $product) {
    echo "<div>
            <h3>" . $product['isim'] . "</h3>
            <p>" . $product['aciklama'] . "</p>
            <p>Fiyat: " . $product['fiyat'] . "</p>
            <p>Miktar: " . $product['miktar'] . "</p>
            <a href='/pages/cart.php?id=" . $product['id'] . "'>Sepete Ekle</a>
          </div>";
}
