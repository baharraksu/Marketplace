<?php
// Oturum başlat
session_start();

// Kullanıcı giriş yapmış mı ve rolü "satıcı" mı kontrol et
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'satıcı') {
    header("Location: seller-login.php");
    exit;
}

// Kullanıcı bilgileri
$user_name = $_SESSION['user_name'];
$user_id = $_SESSION['user_id'];

// Veritabanı bağlantısını dahil et
include '../includes/config.php';

$error = '';
$success = '';

// Ürün ekleme işlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isim = $_POST['isim'];
    $aciklama = $_POST['aciklama'];
    $fiyat = $_POST['fiyat'];
    $miktar = $_POST['miktar'];
    $foto = $_FILES['foto'];

    // Fotoğraf işleme
    $foto_yol = '';
    if ($foto['error'] === 0) {
        $foto_ad = time() . '-' . basename($foto['name']);
        $foto_yol = 'uploads/' . $foto_ad;
        move_uploaded_file($foto['tmp_name'], $foto_yol);
    }

    try {
        $query = $pdo->prepare("INSERT INTO Ürünler (user_id, isim, aciklama, fiyat, miktar, foto) 
                                VALUES (:user_id, :isim, :aciklama, :fiyat, :miktar, :foto)");
        $query->execute([
            ':user_id' => $user_id,
            ':isim' => $isim,
            ':aciklama' => $aciklama,
            ':fiyat' => $fiyat,
            ':miktar' => $miktar,
            ':foto' => $foto_yol
        ]);
        $success = "Ürün başarıyla eklendi!";
    } catch (PDOException $e) {
        $error = "Ürün eklenirken bir hata oluştu: " . $e->getMessage();
    }
}

// Kullanıcının ürünlerini çekme
try {
    $query = $pdo->prepare("SELECT * FROM Ürünler WHERE user_id = :user_id");
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $query->execute();
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Ürünler alınırken bir hata oluştu: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satıcı Paneli - Kooperatif E-Ticaret</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link" href="logout.php">Çıkış Yap</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="container my-5">
        <h2 class="text-center">Merhaba, <?= htmlspecialchars($user_name); ?>!</h2>
        <p class="text-center">Satıcı panelinize hoş geldiniz.</p>

        <!-- Başarı veya Hata Mesajı -->
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <!-- Ürün Listesi -->
        <div class="mt-4">
            <h4>Ürünleriniz</h4>
            <?php if (!empty($products)): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ürün Adı</th>
                            <th>Fiyat</th>
                            <th>Miktar</th>
                            <th>Fotoğraf</th>
                            <th>Durum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $index => $product): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($product['isim']) ?></td>
                                <td><?= htmlspecialchars($product['fiyat']) ?> TL</td>
                                <td><?= htmlspecialchars($product['miktar']) ?></td>
                                <td><img src="<?= htmlspecialchars($product['foto']) ?>" alt="Ürün Fotoğrafı" width="100"></td>
                                <td><?= htmlspecialchars($product['durum']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Henüz bir ürün eklemediniz.</p>
            <?php endif; ?>
        </div>

        <!-- Ürün Ekleme -->
        <div class="mt-4">
            <h4>Yeni Ürün Ekle</h4>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="isim" class="form-label">Ürün Adı</label>
                    <input type="text" class="form-control" id="isim" name="isim" required>
                </div>
                <div class="mb-3">
                    <label for="aciklama" class="form-label">Ürün Açıklaması</label>
                    <textarea class="form-control" id="aciklama" name="aciklama" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="fiyat" class="form-label">Fiyat (TL)</label>
                    <input type="number" class="form-control" id="fiyat" name="fiyat" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="miktar" class="form-label">Miktar</label>
                    <input type="number" class="form-control" id="miktar" name="miktar" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Ürün Fotoğrafı</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-success">Ürün Ekle</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>