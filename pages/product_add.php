<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Ekle</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Ürün Ekle</h2>
        <form action="product_add.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="isim" class="form-label">Ürün İsmi</label>
                <input type="text" class="form-control" id="isim" name="isim" required>
            </div>
            <div class="mb-3">
                <label for="aciklama" class="form-label">Açıklama</label>
                <textarea class="form-control" id="aciklama" name="aciklama" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="fiyat" class="form-label">Fiyat</label>
                <input type="number" step="0.01" class="form-control" id="fiyat" name="fiyat" required>
            </div>
            <div class="mb-3">
                <label for="miktar" class="form-label">Miktar</label>
                <input type="number" class="form-control" id="miktar" name="miktar" required>
            </div>
            <div class="mb-3">
                <label for="fotograf" class="form-label">Ürün Fotoğrafı</label>
                <input type="file" class="form-control" id="fotograf" name="fotograf" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Ürün Ekle</button>
        </form>
    </div>
</body>

</html>
<?php
include '../includes/config.php';
session_start(); // Oturumu başlat

// Giriş yapan kullanıcının ID'sini oturumdan alın
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    die("Kullanıcı oturumu bulunamadı. Ürün eklemek için giriş yapın.");
}

// Fotoğraf yükleme işlemi
if (isset($_FILES['fotograf']) && $_FILES['fotograf']['error'] == 0) {
    $foto_adi = $_FILES['fotograf']['name'];
    $foto_tmp = $_FILES['fotograf']['tmp_name'];

    // Benzersiz bir dosya adı oluştur
    $benzersiz_ad = uniqid() . "_" . $foto_adi;

    // Fotoğrafın kaydedileceği tam dizin
    $upload_dizin = 'C:\\xampp\\htdocs\\İskur\\MarketPlace\\uploads\\';
    $hedef_yol = $upload_dizin . $benzersiz_ad;

    // Dosyayı hedef dizine taşı
    if (move_uploaded_file($foto_tmp, $hedef_yol)) {
        echo "Fotoğraf başarıyla yüklendi: " . $benzersiz_ad;

        // Veritabanına fotoğraf yolunu kaydetme işlemi
        $sql = "INSERT INTO Ürünler (user_id, isim, aciklama, fiyat, miktar, fotograf, durum) 
                VALUES (:user_id, :isim, :aciklama, :fiyat, :miktar, :fotograf, 'beklemede')";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id); // Oturumdan alınan user_id
        $stmt->bindParam(':isim', $urun_adi);
        $stmt->bindParam(':aciklama', $aciklama);
        $stmt->bindParam(':fiyat', $fiyat);
        $stmt->bindParam(':miktar', $miktar);
        $stmt->bindParam(':fotograf', $benzersiz_ad); // Sadece dosya adını kaydediyoruz
        $stmt->execute();

        echo "Ürün başarıyla eklendi.";
    } else {
        echo "Fotoğraf yüklenirken bir hata oluştu.";
    }
} else {
    echo "Geçerli bir fotoğraf yüklenmedi.";
}
?>