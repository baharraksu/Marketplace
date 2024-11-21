<?php
session_start();

// Veritabanı bağlantısı (config.php'den ya da doğrudan buraya da ekleyebilirsiniz)
include '../includes/config.php';  // Veritabanı bağlantısı yapılmalı

// Kullanıcı oturumu kontrolü
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Kullanıcı bilgilerini veritabanından al
$stmt = $pdo->prepare("SELECT * FROM Kullanıcılar WHERE id = :user_id");
$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch();

// Kullanıcı verisi boşsa giriş yapılmamış demektir
if (!$user) {
    echo "Kullanıcı bulunamadı!";
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MarketPlace - Profilim</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MarketPlace</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Profilim</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Çıkış Yap</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profil Sayfası -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Profil Bilgileriniz</h2>
        <div class="row">
            <div class="col-md-4">
                <!-- Kullanıcı Resmi (Bootstrap Icons) -->
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-person-circle" style="font-size: 100px; color: #007bff;"></i> <!-- Profil ikonu -->
                        <h5 class="card-title mt-3"><?= htmlspecialchars($user['isim']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($user['rol']) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- Kullanıcı Bilgileri -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Email</th>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                        </tr>
                        <tr>
                            <th>Durum</th>
                            <td><?= htmlspecialchars($user['durum']) ?></td>
                        </tr>
                        <tr>
                            <th>Sözleşme Onayı</th>
                            <td><?= $user['sozlesme_onayi'] ? 'Evet' : 'Hayır' ?></td>
                        </tr>
                        <tr>
                            <th>Kayıt Tarihi</th>
                            <td><?= htmlspecialchars($user['kayit_tarihi']) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>