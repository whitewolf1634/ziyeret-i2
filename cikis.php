<?php
// Oturum başlat
session_start();

// Tüm oturum verilerini temizle
$_SESSION = array();

// Eğer oturum çerezi varsa, oturumu sonlandır
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Oturumu tamamen yok et
session_destroy();

// Kullanıcıyı giriş sayfasına yönlendir
header("Location: giris.php");
exit();
?>
