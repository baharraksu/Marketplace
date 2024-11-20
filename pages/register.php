<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

require 'vendor/autoload.php';  // Eğer Composer kullanıyorsanız
include '../includes/config.php'; // Veritabanı bağlantı dosyanız

// Form gönderildiyse işlem başlasın
if (isset($_POST['submit'])) {
    $isim = htmlspecialchars($_POST['isim']);
    $email = htmlspecialchars($_POST['email']);
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT); // Şifreyi hashle
    $aktivasyon_kodu = bin2hex(random_bytes(16)); // Benzersiz kod üret

    try {
        // Kullanıcıyı veritabanına ekle
        $sql = "INSERT INTO Kullanıcılar (isim, email, sifre, rol, durum, sozlesme_onayi, aktivasyon_kodu) 
                VALUES (:isim, :email, :sifre, 'müşteri', 'beklemede', 0, :aktivasyon_kodu)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':isim', $isim);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':sifre', $sifre);
        $stmt->bindParam(':aktivasyon_kodu', $aktivasyon_kodu);
        $stmt->execute();

        // Aktivasyon linki oluştur
        $aktivasyon_linki = "http://localhost:8080/İskur/marketplace/pages/aktivasyon.php?kod=" . $aktivasyon_kodu;

        // PHPMailer ile e-posta gönderimi
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'mail.trtur.org'; // SMTP sunucusu
            $mail->SMTPAuth = true;
            $mail->Username = 'info@trtur.org'; // E-posta adresiniz
            $mail->Password = 'iNfo_61'; // E-posta şifreniz
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // E-posta ayarları
            $mail->setFrom('info@trtur.org', 'MarketPlace');
            $mail->addAddress($email, $isim); // Gönderilecek kullanıcı

            // E-posta içeriği
            $mail->isHTML(true);
            $mail->Subject = 'Hesap Aktivasyonu';
            $mail->Body = '
                Merhaba ' . $isim . ',<br><br>
                Hesabınızı aktifleştirmek için aşağıdaki bağlantıya tıklayın:<br><br>
                <a href="' . $aktivasyon_linki . '">Aktivasyon Linki</a><br><br>
                İyi günler dileriz.
            ';
            $mail->AltBody = 'Merhaba ' . $isim . ',\nHesabınızı aktifleştirmek için aşağıdaki bağlantıya tıklayın:\n' . $aktivasyon_linki;

            $mail->send();

            // Başarılı mesaj ve yönlendirme
            echo "<p>Hesabınız başarıyla oluşturuldu. Aktivasyon e-postası gönderildi. Lütfen e-posta adresinizi kontrol edin.</p>";
        } catch (Exception $e) {
            echo "E-posta gönderim hatası: {$mail->ErrorInfo}";
        }
    } catch (PDOException $e) {
        die("Hata: " . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Kayıt Ol</h2>
        <form action="" method="post" class="w-50 mx-auto p-4 border rounded shadow">
            <div class="mb-3">
                <label for="isim" class="form-label">İsim:</label>
                <input type="text" id="isim" name="isim" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-posta:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="sifre" class="form-label">Şifre:</label>
                <input type="password" id="sifre" name="sifre" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Kayıt Ol</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>