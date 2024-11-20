<?php
session_start();
include '../includes/config.php'; // Veritabanı bağlantı dosyanız

if (isset($_POST['submit'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    try {
        // Kullanıcıyı veritabanında ara
        $sql = "SELECT * FROM Kullanıcılar WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kullanıcı bulunduysa ve şifre doğruysa
        if ($user && password_verify($password, $user['sifre'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['isim'];
            $_SESSION['user_role'] = $user['rol'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error_message = "E-posta veya şifre yanlış!";
        }
    } catch (PDOException $e) {
        $error_message = "Bir hata oluştu. Lütfen tekrar deneyin.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap - Kooperatif E-Ticaret</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Kooperatif E-Ticaret</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Ana Sayfa</a></li>
                    <li class="nav-item"><a class="nav-link active" href="login.php">Giriş Yap</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Ürünler</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Form -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Giriş Yap</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <form action="login.php" method="post" class="p-4 border rounded shadow">
                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger text-center"><?= $error_message; ?></div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-posta</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Şifre</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100">Giriş Yap</button>
                    <div class="mt-3 text-center">
                        <a href="#" class="text-decoration-none">Şifremi Unuttum</a>
                    </div>
                    <div class="mt-3 d-flex justify-content-between">
                        <a href="register.php" class="btn btn-outline-primary btn-sm">Kayıt Ol</a>
                        <a href="seller-login.php" class="btn btn-outline-success btn-sm">Satıcı Girişi</a>
                        <a href="admin-login.php" class="btn btn-outline-danger btn-sm">Admin Girişi</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Kooperatif E-Ticaret. Tüm hakları saklıdır.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>