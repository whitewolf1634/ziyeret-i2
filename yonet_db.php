
<?php
try {
     $baglanti = new PDO('mysql:host=94.73.148.10;dbname=u2152678_cinemagorsel;charset=utf8', 'u2152678_cinemagorsel', 'KararGah1028*-');
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>