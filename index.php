<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kooperatif E-Ticaret</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Kooperatif E-Ticaret</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ürünler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sepet <i class="fas fa-shopping-cart"></i></a>
                    </li>
                    <!-- Giriş Yap Dropdown Menüsü -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Giriş Yap
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="pages/admin-login.php">Admin Girişi</a></li>
                            <li><a class="dropdown-item" href="pages/seller-login.php">Satıcı Girişi</a></li>
                            <li><a class="dropdown-item" href="pages/login.php">Müşteri Girişi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hesap</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div id="infoCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="d-flex justify-content-center align-items-center" style="height: 200px; background-color: #FF7F00; color: white;">
                    <h5>Bize Katılmak İster Misiniz?</h5>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-center" style="height: 200px; background-color: #6c757d; color: white;">
                    <h5>Mağazanızı Oluşturun!</h5>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex justify-content-center align-items-center" style="height: 200px; background-color: #28a745; color: white;">
                    <h5>Güncel Kampanyalarımızı Kaçırmayın!</h5>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#infoCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Önceki</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#infoCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Sonraki</span>
        </button>
    </div>

    <!-- Ürün Kartları -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Popüler Ürünler</h2>
        <div class="row">
            <!-- Ürün Kartı 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Ürün 1">
                    <div class="card-body">
                        <h5 class="card-title">Kışlık Mont</h5>
                        <p class="card-text">Şık ve sıcak tutan kışlık mont. Sadece bugün %20 indirimli!</p>
                        <p class="text-primary"><strong>₺349,99</strong></p>
                        <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
                    </div>
                </div>
            </div>

            <!-- Ürün Kartı 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Ürün 2">
                    <div class="card-body">
                        <h5 class="card-title">Sneaker Ayakkabı</h5>
                        <p class="card-text">Rahat ve şık sneaker ayakkabı. En son trend!</p>
                        <p class="text-primary"><strong>₺299,99</strong></p>
                        <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
                    </div>
                </div>
            </div>

            <!-- Ürün Kartı 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Ürün 3">
                    <div class="card-body">
                        <h5 class="card-title">Lüks Saat</h5>
                        <p class="card-text">Zarif tasarıma sahip lüks saat. Her anı değerli kılacak.</p>
                        <p class="text-primary"><strong>₺1.199,99</strong></p>
                        <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
                    </div>
                </div>
            </div>

            <!-- Ürün Kartı 4 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Ürün 4">
                    <div class="card-body">
                        <h5 class="card-title">Kadın Elbise</h5>
                        <p class="card-text">Rahat ve şık yazlık elbise. Kombin yapmaya hazır!</p>
                        <p class="text-primary"><strong>₺199,99</strong></p>
                        <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
                    </div>
                </div>
            </div>

            <!-- Ürün Kartı 5 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Ürün 5">
                    <div class="card-body">
                        <h5 class="card-title">Erkek T-Shirt</h5>
                        <p class="card-text">Klasik ve şık erkek t-shirt. Her mevsime uygun.</p>
                        <p class="text-primary"><strong>₺149,99</strong></p>
                        <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
                    </div>
                </div>
            </div>

            <!-- Ürün Kartı 6 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Ürün 6">
                    <div class="card-body">
                        <h5 class="card-title">Kadın Botu</h5>
                        <p class="card-text">Şık ve rahat kadın botu. Kış sezonu için mükemmel seçenek.</p>
                        <p class="text-primary"><strong>₺249,99</strong></p>
                        <a href="#" class="btn btn-primary w-100">Sepete Ekle</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Kooperatif Proje. Tüm hakları saklıdır.</p>
    </footer>
</body>

</html>