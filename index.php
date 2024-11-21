<?php
session_start();
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kooperatif E-Ticaret</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts for better typography -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <!-- Custom CSS for more styling -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Kooperatif E-Ticaret</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Ana Sayfa</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">Hakkında</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Giriş Yap
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="pages/admin-login.php">Giriş Yap</a></li>
                            <li><a class="dropdown-item" href="pages/register.php">Kayıt Ol</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/profile.php">Hesap</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-light position-relative" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Sepetim
                        <span class="cart-badge position-absolute top-0 start-100 translate-middle">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center">
                <h1 class="display-4 fw-bolder">Alışverişin Keyfini Çıkar!</h1>
                <p class="lead fw-normal text-white-50 mb-0">E-Ticaret Mağazamızda %50'ye varan indirim fırsatları seni bekliyor!</p>
            </div>
        </div>
    </header>

    <!-- Ürün Kartları -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Popüler Ürünler</h2>
        <div class="row">
            <!-- Ürün Kartları (6 adet) -->
            <?php for ($i = 0; $i < 6; $i++) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Ürün <?php echo $i + 1; ?>">
                        <div class="card-body">
                            <h5 class="card-title product-title">Ürün Başlığı <?php echo $i + 1; ?></h5>
                            <p class="card-text">Açıklama kısmı burada yer alacak. Ürün hakkında kısa bilgiler içerir.</p>
                            <p class="product-price"><strong>₺<?php echo 100 + $i * 50; ?>,00</strong></p>
                            <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Kooperatif E-Ticaret - Tüm Hakları Saklıdır</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>