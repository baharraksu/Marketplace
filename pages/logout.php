<?php
session_start();

// Oturumu sonlandırma işlemi
session_unset();  // Oturum verilerini temizler
session_destroy();  // Oturumun kendisini sonlandırır

// Yönlendirme işlemi
header("Location: http://localhost:8080/%C4%B0skur/MarketPlace/index.php");  // Çıkış yapıldığında index.php sayfasına yönlendir
exit();  // Sonraki kodların çalışmasını engelle
