<?php 

session_start();  // Session başlatılır
require_once "db.php";  // Veritabanı bağlantısı yapılır

// Kullanıcı giriş yapmamışsa yönlendirilir
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");  // Giriş sayfasına yönlendirilir
    exit();  // Çıkış yapılır, diğer kodların çalışmasını engeller
}


/*

if (isset($_POST['gonder'])) {

    $uploads_dir = 'images';  // Resimlerin kaydedileceği klasör
    
    // İzin verilen resim uzantıları
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif','webp'];
    
    // Resmin uzantısını almak
    $tmp_name = $_FILES['resim']["tmp_name"];
    $name = $_FILES['resim']["name"];
    $file_extension = pathinfo($name, PATHINFO_EXTENSION);  // Dosya uzantısını al

    // Eğer dosya uzantısı izin verilen uzantılardan biriyse işlemi yap
    if (in_array(strtolower($file_extension), $allowed_extensions)) {

        $sayi1 = rand(1, 10000000);  // Rastgele sayı
        $sayi2 = rand(1, 10000000);  // Rastgele sayı
        $sayi3 = rand(1, 10000000);  // Rastgele sayı
        $sayilar = $sayi1 . $sayi2 . $sayi3;
        $resimadi = $sayilar . $name;

        // Dosyayı yükle
        move_uploaded_file($tmp_name, "$uploads_dir/$resimadi");

        // Güncelleme sorgusu
        $kaydet = $baglanti->prepare("INSERT INTO gorsel SET
            resim = :resim,
            gorsel_sira = :gorsel_sira,
            gorsel_aciklama = :gorsel_aciklama,

            film_adi = :film_adi
 ");

        // Sorguyu çalıştırma
        $insert = $kaydet->execute([
            'gorsel_sira' => htmlspecialchars($_POST['gorsel_sira']),
            'gorsel_aciklama' => htmlspecialchars($_POST['gorsel_aciklama']),

            'film_adi' => htmlspecialchars($_POST['film_adi']),
            'resim' => $resimadi,  // Resim adını güncelliyoruz
        ]);

        // Sonuç kontrolü
        if ($insert) {
            header("Location: index.php?sayfa=liste&durum=okey");
        } else {
            header("Location: index.php?sayfa=liste&durum=okey");
        }

    } else {
        // Eğer resim uzantısı geçerli değilse hata mesajı
        echo "Geçersiz dosya formatı. Sadece .jpg, .jpeg, .png veya .gif  .webp uzantılı dosyalar kabul edilir.";
    }
}


*/

//surec kayıt



if (isset($_POST['gonder'])) {

    $tckimlik = trim($_POST['tckimlik']);

    // 1. Daha önce kayıtlı mı kontrol et
    $kontrol = $baglanti->prepare("SELECT COUNT(*) FROM surec_kayit WHERE tckimlik = ?");
    $kontrol->execute([$tckimlik]);
    $mevcutKayit = $kontrol->fetchColumn();

    if ($mevcutKayit > 0) {
        // Kayıt varsa yönlendirme
        header("Location: index.php?sayfa=liste&durum=kayit_var");
        exit;
    }

    // 2. Yeni kayıt işlemi
    $kaydet = $baglanti->prepare("INSERT INTO surec_kayit SET
        tckimlik = :tckimlik,
        adsoyad = :adsoyad,
        firma_adi = :firma_adi,
        telefon = :telefon,
        ziyaretci_tipi = :ziyaretci_tipi,
        notlar = :notlar,
        aktif = :aktif,
        ban_sebebi = :ban_sebebi,
        sorumluluk = :sorumluluk,
        sorumluluk_tarih = :sorumluluk_tarih,
        sgk_ok = :sgk_ok,
        sgk_tarih = :sgk_tarih,
        isg_ok = :isg_ok,
        isg_tarih = :isg_tarih,
        saglik_rapor = :saglik_rapor,
        saglik_rapor_tarih = :saglik_rapor_tarih,
        gorev_belgesi = :gorev_belgesi,
        gorev_belgesi_tarih = :gorev_belgesi_tarih,
        mes_yet_belgesi = :mes_yet_belgesi,
        mes_yet_belgesi_tarih = :mes_yet_belgesi_tarih,
        yuksek_belgesi = :yuksek_belgesi,
        yuksek_belgesi_tarih = :yuksek_belgesi_tarih,
        sicil_kaydi = :sicil_kaydi,
        sicil_kaydi_tarih = :sicil_kaydi_tarih,
        kdd_zimmet = :kdd_zimmet,
        kdd_zimmet_tarih = :kdd_zimmet_tarih,
        iskele_okey = :iskele_okey,
        iskele_okey_tarih = :iskele_okey_tarih
    ");

    $insert = $kaydet->execute([
        'tckimlik' => $_POST['tckimlik'],
        'adsoyad' => $_POST['adsoyad'],
        'firma_adi' => $_POST['firma_adi'],
        'telefon' => $_POST['telefon'],
        'ziyaretci_tipi' => $_POST['ziyaretci_tipi'],
        'notlar' => $_POST['not'] ?? '',
        'aktif' => isset($_POST['aktif']) ? "Aktif" : "",
        'ban_sebebi' => $_POST['ban_sebebi'] ?? '',
        'sorumluluk' => isset($_POST['sorumluluk']) ? "Belge Alındı" : "",
        'sorumluluk_tarih' => $_POST['sorumluluk_tarih'] ?? '',
        'sgk_ok' => isset($_POST['sgk_ok']) ? "Belge Alındı" : "",
        'sgk_tarih' => $_POST['sgk_tarih'] ?? '',
        'isg_ok' => isset($_POST['isg_ok']) ? "Belge Alındı" : "",
        'isg_tarih' => $_POST['isg_tarih'] ?? '',
        'saglik_rapor' => isset($_POST['saglik_rapor']) ? "Belge Alındı" : "",
        'saglik_rapor_tarih' => $_POST['saglik_rapor_tarih'] ?? '',
        'gorev_belgesi' => isset($_POST['gorev_belgesi']) ? "Belge Alındı" : "",
        'gorev_belgesi_tarih' => $_POST['gorev_belgesi_tarih'] ?? '',
        'mes_yet_belgesi' => isset($_POST['mes_yet_belgesi']) ? "Belge Alındı" : "",
        'mes_yet_belgesi_tarih' => $_POST['mes_yet_belgesi_tarih'] ?? '',
        'yuksek_belgesi' => isset($_POST['yuksek_belgesi']) ? "Belge Alındı" : "",
        'yuksek_belgesi_tarih' => $_POST['yuksek_belgesi_tarih'] ?? '',
        'sicil_kaydi' => isset($_POST['sicil_kaydi']) ? "Belge Alındı" : "",
        'sicil_kaydi_tarih' => $_POST['sicil_kaydi_tarih'] ?? '',
        'kdd_zimmet' => isset($_POST['kdd_zimmet']) ? "Belge Alındı" : "",
        'kdd_zimmet_tarih' => $_POST['kdd_zimmet_tarih'] ?? '',
        'iskele_okey' => isset($_POST['iskele_okey']) ? "Belge Alındı" : "",
        'iskele_okey_tarih' => $_POST['iskele_okey_tarih'] ?? ''
    ]);

    if ($insert) {
        header("Location: index.php?sayfa=liste&durum=ok");
    } else {
        header("Location: index.php?sayfa=liste&durum=no");
    }
    exit;
}









////////////////











if (isset($_POST['is_takibi'])) {

    $tckimlik = trim($_POST['tckimlik']);

    // 1. Aynı tckimlik ile açık süreç var mı kontrol et
    $kontrol = $baglanti->prepare("SELECT COUNT(*) FROM surec_takip 
        WHERE tckimlik = ? AND (cikis_tarih IS NULL OR cikis_tarih = '0000-00-00 00:00:00')");
    $kontrol->execute([$tckimlik]);
    $acik_say = $kontrol->fetchColumn();

    if ($acik_say > 0) {
        // Zaten açık süreç varsa, yönlendirme yap (ve uyarı göstermek için parametre ekle)
        header("Location: index.php?sayfa=liste&durum=acikvar");
        exit;
    }

    // 2. Kayıt işlemi (her şey yolundaysa)
    $sorgu = $baglanti->prepare("INSERT INTO surec_takip SET
        tckimlik         = :tckimlik,
        adsoyad          = :adsoyad,
        firma_adi        = :firma_adi,
        telefon          = :telefon,
        ziyaretci_tipi   = :ziyaretci_tipi,
        ziyaretci_sebebi = :ziyaretci_sebebi,
        giris_tarih      = :giris_tarih,
        aciklama         = :aciklama,
        durum            = 'Açık',
        kayit_tarihi     = NOW()
    ");

    $ekle = $sorgu->execute([
        'tckimlik'         => $_POST['tckimlik'],
        'adsoyad'          => $_POST['adsoyad'],
        'firma_adi'        => $_POST['firma_adi'],
        'telefon'          => $_POST['telefon'],
        'ziyaretci_tipi'   => $_POST['ziyaretci_tipi'],
        'ziyaretci_sebebi' => $_POST['ziyaretci_sebebi'],
        'giris_tarih'      => $_POST['giris_tarih'],
        'aciklama'         => $_POST['aciklama']
    ]);

    if ($ekle) {
        header("Location: index.php?sayfa=liste&durum=ok");
    } else {
        header("Location: index.php?sayfa=liste&durum=no");
    }
    exit;
}









if (isset($_POST['is_takibi_guncelle'])) {

    $guncelle = $baglanti->prepare("UPDATE surec_takip SET
        tckimlik = :tckimlik,
        adsoyad = :adsoyad,
        firma_adi = :firma_adi,
        telefon = :telefon,
        ziyaretci_tipi = :ziyaretci_tipi,
        ziyaretci_sebebi = :ziyaretci_sebebi,
        aciklama = :aciklama,
        giris_tarih = :giris_tarih,
        cikis_tarih = :cikis_tarih,
        durum = :durum
        WHERE id = :id
    ");

    $guncelleme = $guncelle->execute([
        'tckimlik' => $_POST['tckimlik'],
        'adsoyad' => $_POST['adsoyad'],
        'firma_adi' => $_POST['firma_adi'],
        'telefon' => $_POST['telefon'],
        'ziyaretci_tipi' => $_POST['ziyaretci_tipi'],
        'ziyaretci_sebebi' => $_POST['ziyaretci_sebebi'],
        'aciklama' => $_POST['not'],
        'giris_tarih' => $_POST['giris_tarih'],
        'cikis_tarih' => $_POST['cikis_tarih'],
        'durum' => $_POST['durum'],
        'id' => $_POST['id'] // Güncellenecek kaydın ID'si
    ]);

    if ($guncelleme) {
        header("Location: index.php?sayfa=liste&durum=guncellendi");
    } else {
        header("Location: index.php?sayfa=liste&durum=hatali");
    }
}












///galeri güncelleme





if (isset($_POST['galeri_edit'])) {
    // Ekip ID alınıyor
    $gorsel_id = $_POST['gorsel_id'];

    // Mevcut resim veritabanından alınıyor
    $query = $baglanti->prepare("SELECT resim FROM gorsel WHERE gorsel_id = :gorsel_id");
    $query->execute(['gorsel_id' => $gorsel_id]);
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $mevcut_resim = $result['resim'];

    $uploads_dir = 'images';

    // Yeni resim yüklendiyse işleme al
    if ($_FILES['resim']['size'] > 0) {
        $tmp_name = $_FILES['resim']["tmp_name"];
        $name = $_FILES['resim']["name"];
        $resimadi = uniqid() . "_" . $name; // Benzersiz bir dosya adı oluştur

        // Resmi yükle
        if (move_uploaded_file($tmp_name, "$uploads_dir/$resimadi")) {
            // Eski resmi sil
            if (!empty($mevcut_resim) && file_exists("$uploads_dir/$mevcut_resim")) {
                unlink("$uploads_dir/$mevcut_resim");
            }
        } else {
            $resimadi = $mevcut_resim; // Yükleme başarısızsa mevcut resmi kullan
        }
    } else {
        $resimadi = $mevcut_resim; // Eğer yeni bir görsel yüklenmediyse mevcut resmi kullan
    }

    // Güncelleme sorgusu
    $kaydet = $baglanti->prepare("UPDATE gorsel SET
        resim = :resim,
        gorsel_sira = :gorsel_sira,
        
        gorsel_aciklama = :gorsel_aciklama,
        film_adi = :film_adi
        WHERE gorsel_id = :gorsel_id");

    // Verileri güncelle
    $update = $kaydet->execute([
        'resim' => $resimadi,
        'gorsel_sira' => htmlspecialchars($_POST['gorsel_sira']),  // Sıra bilgisini doğru şekilde alıyoruz
        'gorsel_aciklama' => htmlspecialchars($_POST['gorsel_aciklama']), // Açıklamayı doğru şekilde alıyoruz
        'film_adi' => htmlspecialchars($_POST['film_adi']),
        'gorsel_id' => $gorsel_id
    ]);

    // Yönlendirme
    if ($update) {
        header("Location: index.php?sayfa=liste&durum=okey");
    } else {
        header("Location: index.php?sayfa=liste&durum=no");
    }
}



///////////ekipsil
if (isset($_POST['galeri_sil'])) {

    $eskresim = $_POST['eskiresim'];

    // Görseli silme
    if (file_exists("images/$eskresim")) {
        unlink("images/$eskresim"); // Resmi sil
    }
    
    // Veritabanı kaydını silme
    $sil = $baglanti->prepare("DELETE FROM gorsel WHERE gorsel_id = :gorsel_id");
    
    // Sorguyu çalıştırma ve parametreyi bind etme
    $sil->execute([
        'gorsel_id' => $_POST['galeri_id']
    ]);
    
    // Silme işlemi başarılı mı?
    if ($sil) {
        header("Location: index.php?sayfa=liste&durum=okey");
        exit();
    } else {
        header("Location: index.php?sayfa=liste&durum=no");
        exit();
    }
}





?>