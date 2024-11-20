<?php
// Kullanıcı giriş kontrolü
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

// Yönlendirme fonksiyonu
function redirect($url)
{
    header("Location: $url");
    exit();
}

// Şifre doğrulama fonksiyonu
function verifyPassword($password, $hash)
{
    return password_verify($password, $hash);
}
