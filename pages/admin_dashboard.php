<?php
include '../includes/config.php';
// Veritabanı bağlantısını dahil et

// Toplam kullanıcı sayısını al
$queryUsers = "SELECT COUNT(*) AS total_users FROM Kullanıcılar";
$stmtUsers = $pdo->query($queryUsers);
$totalUsers = $stmtUsers->fetch(PDO::FETCH_ASSOC)['total_users'];

// Toplam sipariş sayısını al
$queryOrders = "SELECT COUNT(*) AS total_orders FROM Siparişler";
$stmtOrders = $pdo->query($queryOrders);
$totalOrders = $stmtOrders->fetch(PDO::FETCH_ASSOC)['total_orders'];

// Toplam ürün sayısını al
$queryProducts = "SELECT COUNT(*) AS total_products FROM Ürünler";
$stmtProducts = $pdo->query($queryProducts);
$totalProducts = $stmtProducts->fetch(PDO::FETCH_ASSOC)['total_products'];

// En son 5 siparişi al
$queryRecentOrders = "SELECT Siparişler.id, Kullanıcılar.isim AS user_name, Siparişler.siparis_tarihi, Siparişler.toplam_fiyat, Siparişler.durum
                      FROM Siparişler
                      JOIN Kullanıcılar ON Siparişler.user_id = Kullanıcılar.id
                      ORDER BY Siparişler.siparis_tarihi DESC LIMIT 5";
$stmtRecentOrders = $pdo->query($queryRecentOrders);
$recentOrders = $stmtRecentOrders->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli - Kooperatif E-Ticaret</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Kooperatif E-Ticaret Admin Paneli</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Ürünler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">Siparişler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Kullanıcılar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Çıkış Yap</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Ana İçerik Alanı -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <!-- Sidebar -->
                <div class="list-group">
                    <a href="dashboard.php" class="list-group-item list-group-item-action active">
                        Ana Sayfa
                    </a>
                    <a href="products.php" class="list-group-item list-group-item-action">
                        Ürünler
                    </a>
                    <a href="orders.php" class="list-group-item list-group-item-action">
                        Siparişler
                    </a>
                    <a href="users.php" class="list-group-item list-group-item-action">
                        Kullanıcılar
                    </a>
                    <a href="settings.php" class="list-group-item list-group-item-action">
                        Ayarlar
                    </a>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Dashboard İçeriği -->
                <div class="row">
                    <!-- Toplam Ürün Sayısı -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">Toplam Ürün</h5>
                                <p class="card-text"><?php echo $totalProducts; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Toplam Sipariş Sayısı -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Toplam Sipariş</h5>
                                <p class="card-text"><?php echo $totalOrders; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Toplam Kullanıcı Sayısı -->
                    <div class="col-md-4 mb-4">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Toplam Kullanıcı</h5>
                                <p class="card-text"><?php echo $totalUsers; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- En Son 5 Sipariş -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">En Son 5 Sipariş</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sipariş ID</th>
                                            <th>Kullanıcı</th>
                                            <th>Tarih</th>
                                            <th>Toplam Tutar</th>
                                            <th>Durum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($recentOrders as $order) : ?>
                                            <tr>
                                                <td><?php echo $order['id']; ?></td>
                                                <td><?php echo $order['user_name']; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($order['siparis_tarihi'])); ?></td>
                                                <td>₺<?php echo number_format($order['toplam_fiyat'], 2); ?></td>
                                                <td><span class="badge bg-<?php echo getBadgeClass($order['durum']); ?>"><?php echo ucfirst($order['durum']); ?></span></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

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

<?php
// Sipariş durumu için uygun badge sınıfını belirleyen fonksiyon
function getBadgeClass($status)
{
    switch ($status) {
        case 'tamamlandı':
            return 'success';
        case 'kargoya verildi':
            return 'info';
        case 'beklemede':
            return 'warning';
        default:
            return 'secondary';
    }
}
?>