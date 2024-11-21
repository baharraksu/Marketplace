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
    $sozlesme_onayi = isset($_POST['sozlesme_onayi']) ? 1 : 0; // Sözleşme onayı
    $rol = 'müşteri';  // Varsayılan rol

    // Sözleşme onayı varsa ve rol satıcı ise
    if ($sozlesme_onayi && isset($_POST['rol']) && $_POST['rol'] == 'satıcı') {
        $rol = 'satıcı';
    }

    // Eğer admin rolü seçildiyse
    if (isset($_POST['rol']) && $_POST['rol'] == 'admin') {
        $rol = 'admin';  // Admin rolü
    }

    try {
        // Kullanıcıyı veritabanına ekle
        $sql = "INSERT INTO Kullanıcılar (isim, email, sifre, rol, durum, sozlesme_onayi, aktivasyon_kodu) 
                VALUES (:isim, :email, :sifre, :rol, 'beklemede', :sozlesme_onayi, :aktivasyon_kodu)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':isim', $isim);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':sifre', $sifre);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':sozlesme_onayi', $sozlesme_onayi);
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
    <!-- JQuery ve Bootstrap modal için JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
            <div class="mb-3">
                <label for="rol" class="form-label">Rol Seçiniz:</label>
                <select id="rol" name="rol" class="form-control">
                    <option value="müşteri">Müşteri</option>
                    <option value="satıcı">Satıcı</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="sozlesme_onayi" class="form-label">Sözleşmeyi Okudum ve Kabul Ediyorum</label>
                <input type="checkbox" id="sozlesme_onayi" name="sozlesme_onayi" data-bs-toggle="modal" data-bs-target="#sozlesmeModal">
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Kayıt Ol</button>
            <div class="mt-3 d-flex justify-content-between">
                <a href="register.php" class="btn btn-outline-primary btn-sm">Kayıt Ol</a>
                <a href="seller-login.php" class="btn btn-outline-success btn-sm">Satıcı Girişi</a>
                <a href="admin-login.php" class="btn btn-outline-danger btn-sm">Admin Girişi</a>
            </div>
        </form>
    </div>

    <!-- Modal: Sözleşme Metni -->
    <div class="modal fade" id="sozlesmeModal" tabindex="-1" aria-labelledby="sozlesmeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sozlesmeModalLabel">Sözleşme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Lütfen aşağıdaki sözleşmeyi dikkatlice okuyun:</h5>
                    <p><strong>1. Genel Şartlar:</strong><br>
                        Bu sözleşme, Market place tarafından sağlanan hizmetleri kullanırken geçerli olan kuralları belirler. Şirketin hizmetlerini kullanarak bu şartları kabul etmiş olursunuz. Eğer kabul etmiyorsanız, hizmeti kullanmamalısınız.
                    </p>
                    <p><strong>2. Hizmet Kullanımı:</strong><br>
                        Hizmetler yalnızca yasal amaçlarla kullanılabilir. Herhangi bir yasa dışı faaliyet söz konusu olduğunda, Şirket hizmeti askıya alma hakkına sahiptir.
                    </p>
                    <p><strong>3. Kullanıcı Hesabı:</strong><br>
                        Hesap açarken verdiğiniz bilgilerin doğru ve güncel olması gerekir. Hesabınızın güvenliğinden siz sorumlusunuz.
                    </p>
                    <p><strong>4. Sözleşme Değişiklikleri:</strong><br>
                        Şirket, bu sözleşmeyi dilediği zaman değiştirebilir. Değişiklikler platformda yayımlandığında geçerli olur.
                    </p>
                    <p><strong>5. Hesap Kapatma:</strong><br>
                        Hesabınızı istediğiniz zaman kapatabilirsiniz. Şirket, sözleşme ihlali durumunda hesabınızı kapatma hakkına sahiptir.
                    </p>
                    <p><strong>6. Sorumluluk Reddi:</strong><br>
                        Şirket, platformdaki içeriklerin doğruluğu hakkında garanti vermez. Hizmetleri kullanırken karşılaşabileceğiniz sorunlardan Şirket sorumlu değildir.
                    </p>
                    <p><strong>7. Veri Koruma:</strong><br>
                        Kişisel verileriniz, gizlilik politikasına uygun şekilde korunur ve yalnızca yasal gereksinimler doğrultusunda işlenir.
                    </p>
                    <p><strong>8. Yürürlük:</strong><br>
                        Bu sözleşme, platforma kaydolduğunuz andan itibaren geçerlidir. Kullanıcı, platformu kullanmaya başladığı anda bu şartları kabul etmiş sayılır.
                    </p>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="document.getElementById('sozlesme_onayi').checked = true;">Onayla</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>