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
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="login.html">Giriş Yap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ürünler</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Giriş Yap</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-posta</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Şifre</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Giriş Yap</button>
                    </div>
                    <div class="mb-3 text-center">
                        <a href="#">Şifremi Unuttum</a>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="login.php" class="btn btn-outline-primary btn-sm">Müşteri Girişi</a>
                        <a href="seller-login.php" class="btn btn-outline-success btn-sm">Satıcı Girişi</a>
                        <a href="admin-login.php" class="btn btn-outline-danger btn-sm">Admin Girişi</a>
                    </div>
                    <div class="mt-3 text-center">
                        <p>Hesabınız yok mu? <a href="register.php">Kayıt Ol</a></p>
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