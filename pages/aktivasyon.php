<?php

// Veritabanı bağlantısı
include '../includes/config.php';

// URL'den aktivasyon kodunu al
if (isset($_GET['kod'])) {
    $activationCode = $_GET['kod'];

    try {
        // Aktivasyon koduna göre kullanıcıyı bul
        $sql = "SELECT id, isim, email, aktif_pasif FROM Kullanıcılar WHERE aktivasyon_kodu = :aktivasyon_kodu";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':aktivasyon_kodu', $activationCode);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Kullanıcı bulundu, aktif pasif durumunu kontrol et
            if ($user['aktif_pasif'] == 'pasif') {
                // Durumu aktif yap
                $sqlUpdate = "UPDATE Kullanıcılar SET aktif_pasif = 'aktif' WHERE aktivasyon_kodu = :aktivasyon_kodu";
                $stmtUpdate = $pdo->prepare($sqlUpdate);
                $stmtUpdate->bindParam(':aktivasyon_kodu', $activationCode);
                $stmtUpdate->execute();

                echo "<p>Hesabınız başarıyla aktif hale getirildi!</p>";
            } else {
                echo "<p>Hesabınız zaten aktif.</p>";
            }
        } else {
            echo "<p>Geçersiz aktivasyon kodu. Lütfen kontrol edin.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Veritabanı hatası: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>Aktivasyon kodu eksik. Lütfen bağlantıyı doğru kullanın.</p>";
}
