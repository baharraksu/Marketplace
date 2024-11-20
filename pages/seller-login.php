<?php
// Veritabanı bağlantısını dahil et
include_once '../includes/config.php'; // Veritabanı bağlantı dosyanızın yolu

// Oturum başlatma
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Giriş formundan gelen veriler
    $email = trim($_POST['email']);
    $sifre = trim($_POST['password']);

    try {
        // Kullanıcıyı veritabanında arama
        $query = $pdo->prepare("SELECT * FROM Kullanıcılar WHERE email = :email AND rol = 'satıcı'");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        // Kullanıcı bulunduysa kontrol et
        if ($query->rowCount() > 0) {
            $user = $query->fetch(PDO::FETCH_ASSOC);

            // Şifre doğrulama
            if ($sifre === $user['sifre']) { // Şifreler düz metin ise (Hash kullanımı önerilir)
                // Oturum bilgilerini ayarla
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['isim'];
                $_SESSION['user_role'] = $user['rol'];

                // Başarılı giriş, yönlendirme
                header("Location: seller-dashboard.php");
                exit;
            } else {
                $error = "Şifre yanlış!";
            }
        } else {
            $error = "Bu e-posta adresi ile kayıtlı bir satıcı bulunamadı.";
        }
    } catch (PDOException $e) {
        $error = "Bir hata oluştu: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satıcı Girişi - Kooperatif E-Ticaret</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h2 class="text-center mb-4">Satıcı Girişi</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-posta</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Şifre</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="register.php">Hesabınız yok mu? Kayıt Ol</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>