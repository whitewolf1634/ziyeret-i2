<?php
try {
    // Veritabanı bağlantısı
    $baglanti = new PDO('mysql:host=localhost;dbname=cinemagorsel;charset=utf8', 'root', '');
    // Bağlantı başarılı olduğunda herhangi bir mesaj göstermemek için boş bırakıldı
} catch (Exception $e) {
    // Hata durumunda mesajı log dosyasına kaydedebiliriz (ekranda göstermemek için)
    error_log("Bağlantı hatası: " . $e->getMessage(), 3, 'error_log.txt');
}
?>
