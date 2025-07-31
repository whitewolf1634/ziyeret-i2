<?php
// debug amaçlı hata göster
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Veri alınamadı']);
    exit;
}

// Gelen verileri kontrol et
if (!isset($data['id']) || !isset($data['cikis_tarih'])) {
    echo json_encode(['success' => false, 'message' => 'Eksik veri']);
    exit;
}

// Burada veritabanı bağlantısı ve güncelleme yap
require_once 'db.php';

$id = (int)$data['id'];
$cikis_tarih = $data['cikis_tarih'];

$update = $baglanti->prepare("UPDATE surec_takip SET cikis_tarih = ? WHERE id = ?");
$success = $update->execute([$cikis_tarih, $id]);

echo json_encode(['success' => $success]);
