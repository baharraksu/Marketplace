<?php
session_start();
include_once '../includes/config.php';

if ($_SESSION['user_role'] !== 'admin') {
    redirect('/index.php');
}

$query = "SELECT * FROM kullanicilar";
$stmt = $conn->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll();

echo "<h1>Kullanıcı Yönetimi</h1>";
foreach ($users as $user) {
    echo "<div>
            <p>" . $user['isim'] . "</p>
            <p>Email: " . $user['email'] . "</p>
            <p>Rol: " . $user['rol'] . "</p>
            <p>Durum: " . $user['durum'] . "</p>
            <a href='/admin/users.php?action=approve&id=" . $user['id'] . "'>Onayla</a>
            <a href='/admin/users.php?action=deny&id=" . $user['id'] . "'>Red Et</a>
          </div>";
}
