

  <!-- /.navbar -->
  <?php 

session_start();  // Session başlatılır
require_once "db.php";  // Veritabanı bağlantısı yapılır

// Kullanıcı giriş yapmamışsa yönlendirilir
if (!isset($_SESSION['username'])) {
    header("Location: giris.php");  // Giriş sayfasına yönlendirilir
    exit();  // Çıkış yapılır, diğer kodların çalışmasını engeller
}

// Ayar sorgusunu çalıştırma
/*
$galerisor = $baglanti->prepare("SELECT * FROM gorsel ORDER BY gorsel_sira ASC");



// Sorguyu çalıştırma ve parametreyi bind etme
$galerisor->execute(array());
*/


$kayit_sorgu = $baglanti->prepare("
    SELECT sk.*, st.giris_tarih, st.cikis_tarih 
    FROM surec_kayit sk
    LEFT JOIN surec_takip st ON sk.tckimlik = st.tckimlik
    ORDER BY sk.kayit_tarihi DESC
");
$kayit_sorgu->execute();




///DÜREC TAKİP LİSTELEME

$surec_takip_sor = $baglanti->prepare("SELECT * FROM surec_takip ");



// Sorguyu çalıştırma ve parametreyi bind etme
$surec_takip_sor->execute(array())












?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sineme görsel</title>
    <link rel="stylesheet" href="bootstrap/assets/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container-fluid main">
    <div class="row">

<div class="col-md-2 menu fixed-top">

<div class="col-md-10 menu_header">
<img src="images/logo.png" class="img-fluid" style="width:5rem; height: auto !important;" alt="">
<h5>VİAPORT MARİNA</h5>
</div>
<div class="col">
    
    <ul>
   <li><h3>Hızlı Menü</h3></li>

   <li><a href="index.php">Görsel Ekle</a></li>


   <li><a href="index.php?sayfa=liste">Görsel Listele</a></li>
 <li><a href="index.php?sayfa=is_takib">İş Girişi </a></li>



  
      
        <li> <button class="btn btn-light" ><a href="" style="background-color:#fafafa important;">Siteye Git</a></button> </li>
    </ul>
    <a  class="btn btn-danger" href="cikis.php">ÇIKIŞ YAP</a>
</div>



</div>



<div class="col-md-10 content">


<?php if (!isset($_GET['sayfa'])) { ?>
<!---form işlem başlangıç--->
<div class="form_islem">
<form action="gonder.php" method="POST" enctype="multipart/form-data">
    <h1 class="text-center mt-5">Ziyaretçi Kayıt Formu</h1>

    <div class="mb-3">
        <label for="salonAdi" class="form-label">Tc Kimlik </label>
        <input type="text" name="tckimlik" class="form-control" id="tc"  placeholder="Tc kimlik numarası giriniz">
    </div>

    <div class="mb-3">
        <label for="siraBilgisi" class="form-label">Ad Soyad Bilgisi</label>
        <input type="text" name="adsoyad" class="form-control" id="adsoyad"  placeholder="Ad Soyad Bilgisini giriniz">
    </div>



    <div class="mb-3">
        <label for="siraBilgisi" class="form-label">Frima Adı</label>
        <input type="text" name="firma_adi" class="form-control" id="firma"  placeholder="Firma bilgisi giriniz">
    </div>
 <div class="mb-3">
        <label for="siraBilgisi" class="form-label">Telefon Numarası</label>
        <input type="number" name="telefon" class="form-control" id="tel"  placeholder="Telefon bilgisi giriniz">
    </div>
    <select class="form-select" name="ziyaretci_tipi" aria-label="Ziyaretçi tipi">
      <option selected>Ziyaretçi Tipi</option>
      <option value="Usta"  name= >Usta</option>
      <option value="Tekne Personeli">Tekne Personeli</option>
      <option value="Tekne Sahibi">Tekne Sahibi</option>
      <option value="Kaptan">Kaptan</option>
    </select> <br>



<div class="belge_alan">


      <div class="card_akitif_pasif">
        <div class="card-title">
          <h5>Aktif/Pasif Durumu</h5>
        </div>
        <div class="card-body p-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox"  name="aktif" value="1" id="aktif_pasif">
            <label class="form-check-label" for="aktif_pasif">Aktif</label>
          </div>



          
          <div class="form-floating p-2">
            <textarea class="form-control" placeholder="Leave a comment here" id="ban_sebebi" name="ban_sebebi" style="height: 20dvh; width:100%"></textarea>
            <label for="ban_sebebi">Ban sebebini giriniz...</label>
          </div>
        </div>
      </div>

<div class="belge_alan_icerik">
    <div class="card">
<div class="card-title">
    <h5>Sorumluluk Yazısı</h5>
</div>
<div class="card-body">
   <div class="form-check ">
  <input class="form-check-input" type="checkbox" name="sorumluluk" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Belge Alındı
  </label>
</div>



<div class="mb-3 mt-3" style="display: flex;  flex-direction:column ">
           <label for="tarih">Belge Geçerlilik Tarihi</label> <br>
  <input type="date" id="tarih" name="sorumluluk_tarih" class="form-control">
    </div>










</div>
</div>

<!--card bitiş-->
 

<!--card bitiş-->
    <div class="card">
<div class="card-title">
    <h5>SGK Hizmet Dökümü</h5>
</div>
<div class="card-body">
   <div class="form-check ">
  <input class="form-check-input" type="checkbox" name="sgk_ok" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Belge Alındı
  </label>
</div>



<div class="mb-3 mt-3" style="display: flex;  flex-direction:column ">
           <label for="tarih">Belge Geçerlilik Tarihi</label> <br>
  <input type="date" id="tarih" name="sgk_tarih" class="form-control">
    </div>





</div>
</div>

<!--card bitiş-->
    <div class="card">
<div class="card-title">
    <h5>İSG Eğitim Belgesi</h5>
</div>
<div class="card-body">
   <div class="form-check ">
  <input class="form-check-input" type="checkbox" name="isg_ok" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Belge Alındı
  </label>
</div>



<div class="mb-3 mt-3" style="display: flex;  flex-direction:column ">
           <label for="tarih">Belge Geçerlilik Tarihi</label> <br>
  <input type="date" id="tarih" name="isg_tarih" class="form-control">
    </div>



</div>
</div>

<!--card bitiş-->
    <div class="card">
<div class="card-title">
    <h5>Sağlık Raporu</h5>
</div>
<div class="card-body">
   <div class="form-check ">
  <input class="form-check-input" type="checkbox" name="saglik_rapor"  value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Belge Alındı
  </label>
</div>



<div class="mb-3 mt-3" style="display: flex;  flex-direction:column ">
           <label for="tarih">Belge Geçerlilik Tarihi</label> <br>
  <input type="date" id="tarih" name="saglik_rapor_tarih" class="form-control">
    </div>




</div>
</div>

<!--card bitiş-->
    <div class="card">
<div class="card-title">
    <h5>Görevlendirme Yazısı</h5>
</div>
<div class="card-body">
   <div class="form-check ">
  <input class="form-check-input" type="checkbox"  name="gorev_belgesi" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Belge Alındı
  </label>
</div>


<div class="mb-3 mt-3" style="display: flex;  flex-direction:column ">
           <label for="tarih">Belge Geçerlilik Tarihi</label> <br>
  <input type="date" id="tarih" name="gorev_belgesi_tarih" class="form-control">
    </div>




</div>
</div>

<!--card bitiş-->


  <div class="card">
<div class="card-title">
    <h5>Mesleki Yet. Sertifikası</h5>
</div>
<div class="card-body">
   <div class="form-check ">
  <input class="form-check-input" type="checkbox" name="mes_yet_belgesi" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Belge Alındı
  </label>
</div>


<div class="mb-3 mt-3" style="display: flex;  flex-direction:column ">
           <label for="tarih">Belge Geçerlilik Tarihi</label> <br>
  <input type="date" id="mes_yet_belgesi_tarih" name="tarih" class="form-control">
    </div>




</div>
</div>

<!--card bitiş-->
  <div class="card">
<div class="card-title">
    <h5>Yüksekte Çalışma Blegesi</h5>
</div>
<div class="card-body">
   <div class="form-check ">
  <input class="form-check-input" type="checkbox" name="yuksek_belgesi" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Belge Alındı
  </label>
</div>


<div class="mb-3 mt-3" style="display: flex;  flex-direction:column ">
           <label for="tarih">Belge Geçerlilik Tarihi</label> <br>
  <input type="date" id="tarih" name="yuksek_belgesi_tarih" class="form-control">
    </div>




</div>
</div>

<!--card bitiş-->
  <div class="card">
<div class="card-title">
    <h5>Adli Sicil Kaydı</h5>
</div>
<div class="card-body">
   <div class="form-check ">
  <input class="form-check-input" type="checkbox" name="sicil_kaydi" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Belge Alındı
  </label>
</div>


<div class="mb-3 mt-3" style="display: flex;  flex-direction:column ">
           <label for="tarih">Belge Geçerlilik Tarihi</label> <br>
  <input type="date" id="tarih" name="sicil_kaydi_tarih" class="form-control">
    </div>




</div>
</div>

<!--card bitiş-->
  <div class="card">
<div class="card-title">
    <h5>KKD Zimmet Formu</h5>
</div>
<div class="card-body">
   <div class="form-check ">
  <input class="form-check-input" type="checkbox"  name="kdd_zimmet" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Belge Alındı
  </label>
</div>


<div class="mb-3 mt-3" style="display: flex;  flex-direction:column ">
           <label for="tarih">Belge Geçerlilik Tarihi</label> <br>
  <input type="date" id="tarih" name="kdd_zimmet_tarih" class="form-control">
    </div>




</div>
</div>

<!--card bitiş-->
  <div class="card">
<div class="card-title">
    <h5>İskele Kurma Belgesi</h5>
</div>
<div class="card-body">
   <div class="form-check ">
  <input class="form-check-input" type="checkbox" name="iskele_okey" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Belge Alındı
  </label>
</div>


<div class="mb-3 mt-3" style="display: flex;  flex-direction:column ">
           <label for="tarih">Belge Geçerlilik Tarihi</label> <br>
  <input type="date" id="tarih" name="tarih" class="form-control">
    </div>




</div>
</div>

<!--card bitiş-->



</div>





</div> <br>


<div class="mb-3">
  <label for="not" class="form-label" style="width: 100%;">Not</label>
  <textarea name="not" id="not" class="form-control" rows="4" placeholder="Varsa not giriniz..."></textarea>
</div>




















    <button class="btn" name="gonder" id="gonder" style="background-color: #D4C9BE;">KAYDET</button>
</form>
</div>

<script>
document.getElementById('gorselYukle').onchange = function (event) {
    const [file] = event.target.files;
    if (file) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
};
</script>
<!---form işlem bitiş--->
<?php } ?>

<!---alan2 başlangıç--->
<?php if (isset($_GET['sayfa']) && $_GET['sayfa'] == "liste") { ?>
<div class="liste container-fluid">
    <table class="table table-bordered table-striped">
        <h2 class="text-center p-3" style="position: relative; left: 20%;">SİNEMA GÖRSEL LİSTELE</h2>
        <thead>
            <tr>
                <th scope="col">Kayıt Tarihi</th>
                <th scope="col">Ad Soyad</th>
                <th scope="col">Firma Adı</th>
                <th scope="col">Ziyaretçi Tipi</th>
                 <th scope="col">Aktif Durumu</th>
                  <th scope="col">Ban-Engel Durumu</th>
                <th scope="col">İşlemler</th>
            </tr>
        </thead>
    <?php while($kayit_sorgu_cek = $kayit_sorgu->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?php echo htmlspecialchars($kayit_sorgu_cek['kayit_tarihi']); ?></td>
        <td><?php echo htmlspecialchars($kayit_sorgu_cek['adsoyad']); ?></td>
        <td><?php echo htmlspecialchars($kayit_sorgu_cek['firma_adi']); ?></td>
        <td><?php echo htmlspecialchars($kayit_sorgu_cek['ziyaretci_tipi']); ?></td>

         <td><?php echo htmlspecialchars($kayit_sorgu_cek['aktif']); ?></td>
         
         <td><?php echo htmlspecialchars($kayit_sorgu_cek['ban_sebebi']); ?></td>
        <td class="duzenle_btn">

            <?php 
            // cikis_tarih var mı kontrol et
            $cikis_var_mi = !empty($kayit_sorgu_cek['cikis_tarih']);
            ?>

            <a class="btn btn-success <?php echo $cikis_var_mi ? 'disabled' : ''; ?>" 
               href="<?php echo $cikis_var_mi ? '#' : 'index.php?sayfa=isgiris&id=' . $kayit_sorgu_cek['id']; ?>">
               Süreç Gir
            </a>

            <!-- Silme butonu -->
            <form action="gonder.php" method="post" style="display:inline-block;">
                <input type="hidden" name="galeri_id" value="<?php echo $kayit_sorgu_cek['id']; ?>">
                <button type="submit" name="galeri_sil" class="btn btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</button>
            </form>
        </td>
    </tr>
<?php } ?>

</tbody>

    </table>
</div>


<?php } else if(isset($_GET['sayfa']) && $_GET['sayfa'] == "isgiris") { 

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $is_sorgu = $baglanti->prepare("SELECT * FROM surec_kayit WHERE id = ?");
        $is_sorgu->execute([$id]);
        $is_sorgu_cek = $is_sorgu->fetch(PDO::FETCH_ASSOC);

        if (!$is_sorgu_cek) {
            echo "<div class='alert alert-danger'>Kayıt bulunamadı.</div>";
        } else {
            ?>
            <div class="liste container-fluid">
                <h1 class="text-center mt-5">Ziyaretçi Süreç Başlatma Formu</h1>

                <form action="gonder.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($is_sorgu_cek['id']); ?>">

                    <div class="mb-3">
                        <label for="tc" class="form-label">Tc Kimlik</label>
                        <input type="text" name="tckimlik" class="form-control" id="tc" 
                               value="<?php echo htmlspecialchars($is_sorgu_cek['tckimlik']); ?>" 
                               placeholder="Tc kimlik numarası giriniz">
                    </div>

                    <div class="mb-3">
                        <label for="adsoyad" class="form-label">Ad Soyad Bilgisi</label>
                        <input type="text" name="adsoyad" class="form-control" id="adsoyad" 
                               value="<?php echo htmlspecialchars($is_sorgu_cek['adsoyad']); ?>" 
                               placeholder="Ad Soyad Bilgisini giriniz">
                    </div>

                    <div class="mb-3">
                        <label for="firma" class="form-label">Firma Adı</label>
                        <input type="text" name="firma_adi" class="form-control" id="firma" 
                               value="<?php echo htmlspecialchars($is_sorgu_cek['firma_adi']); ?>" 
                               placeholder="Firma bilgisi giriniz">
                    </div>

                    <div class="mb-3">
                        <label for="tel" class="form-label">Telefon Numarası</label>
                        <input type="number" name="telefon" class="form-control" id="tel" 
                               value="<?php echo htmlspecialchars($is_sorgu_cek['telefon']); ?>" 
                               placeholder="Telefon bilgisi giriniz">
                    </div>

                    <select class="form-select" name="ziyaretci_tipi" aria-label="Ziyaretçi tipi">
                      <option value="" <?php echo empty($is_sorgu_cek['ziyaretci_tipi']) ? 'selected' : ''; ?>>Ziyaretçi Tipi</option>
                      <option value="Usta" <?php echo ($is_sorgu_cek['ziyaretci_tipi'] ?? '') === 'Usta' ? 'selected' : ''; ?>>Usta</option>
                      <option value="Tekne Personeli" <?php echo ($is_sorgu_cek['ziyaretci_tipi'] ?? '') === 'Tekne Personeli' ? 'selected' : ''; ?>>Tekne Personeli</option>
                      <option value="Tekne Sahibi" <?php echo ($is_sorgu_cek['ziyaretci_tipi'] ?? '') === 'Tekne Sahibi' ? 'selected' : ''; ?>>Tekne Sahibi</option>
                      <option value="Kaptan" <?php echo ($is_sorgu_cek['ziyaretci_tipi'] ?? '') === 'Kaptan' ? 'selected' : ''; ?>>Kaptan</option>
                    </select> <br>



               <!--- süre hesaplama--->
<div class="mb-3">
  <label for="giris" class="form-label">Giriş Tarihi</label>
  <input type="datetime-local" name="giris_tarih" class="form-control" id="giris">
</div>

<div class="mb-3 d-none" id="cikis_alani">
  <label for="cikis" class="form-label">Çıkış Tarihi</label>
  <input type="datetime-local" name="cikis_tarih" class="form-control" id="cikis" readonly>
</div>

<div class="mb-3">
  <button type="button" class="btn btn-danger" id="cikisYapBtn">Çıkış Yap</button>
</div>

<div id="mesaj" name="durum" class="alert alert-info">Giriş tarihi seçilmedi.</div>
<h5>
  Durumu
</h5>
<div>

<p id="mesaj_2" class="alert alert-success">Belirsiz</p>

</div>

<script>
  const girisInput = document.getElementById('giris');
  const cikisInput = document.getElementById('cikis');
  const cikisAlani = document.getElementById('cikis_alani');
  const cikisBtn = document.getElementById('cikisYapBtn');
  const mesajDiv = document.getElementById('mesaj');
  const mesajDiv_2 = document.getElementById('mesaj_2');

  // Sayfa yüklendiğinde çıkış butonunu pasif yap
  cikisBtn.disabled = true;
  cikisBtn.classList.add('disabled'); // eğer CSS ile görünümde pasif görünmesini istiyorsan

  // Giriş tarihi değiştiğinde çalışır
  girisInput.addEventListener('change', () => {
    if (girisInput.value) {
      mesajDiv.innerText = "Çıkış yapılmadı";
      mesajDiv.classList.remove('d-none');
      mesajDiv_2.innerText = "İçeride";
      cikisAlani.classList.add('d-none');
      cikisInput.value = ""; // çıkış tarihi sıfırla

      // çıkış butonunu aktif et
      cikisBtn.disabled = false;
      cikisBtn.classList.remove('disabled');
    } else {
      mesajDiv.innerText = "Giriş tarihi seçilmedi.";
      mesajDiv_2.innerText = "İçeride";
      cikisAlani.classList.add('d-none');

      // çıkış butonunu tekrar pasif yap
      cikisBtn.disabled = true;
      cikisBtn.classList.add('disabled');
    }
  });

  cikisBtn.addEventListener('click', () => {
    if (!girisInput.value) {
      mesajDiv.innerText = "Lütfen önce giriş tarihi seçin.";
      return;
    }

    const girisTarihi = new Date(girisInput.value);
    const cikisTarihi = new Date();

    // çıkış tarihini input'a yaz
    cikisInput.value = cikisTarihi.toISOString().slice(0, 16); // yyyy-MM-ddTHH:mm

    // süre hesapla
    const farkMs = cikisTarihi - girisTarihi;
    const dakika = Math.floor(farkMs / 60000);
    const saat = Math.floor(dakika / 60);
    const kalanDakika = dakika % 60;

    mesajDiv.innerText = `Süre: ${saat} saat ${kalanDakika} dakika`;
    mesajDiv_2.innerText = "Dışarıda";
    cikisAlani.classList.remove('d-none');

    // çıkış yapıldıktan sonra butonu tekrar pasif yapabilirsin (isteğe bağlı)
    cikisBtn.disabled = true;
    cikisBtn.classList.add('disabled');
  });
</script>










                    <!-- Diğer checkbox ve tarih alanlarını da benzer şekilde buraya ekleyebilirsin -->

                    <div class="mb-3">
                      <label for="not" class="form-label" style="width: 100%;">Not</label>
                      <textarea name="not" id="not" class="form-control" rows="4" placeholder="Varsa not giriniz..."><?php echo htmlspecialchars($is_sorgu_cek['not'] ?? ''); ?></textarea>
                    </div>

                    <button class="btn btn-success" name="is_takibi" id="is_takibi" style="">KAYDET</button> <br>
                </form>
            </div>

            <?php
        }
    }
    // Burada dıştaki else if bloğunu kapatıyoruz:
}  else if(isset($_GET['sayfa']) && $_GET['sayfa'] == "is_takib") {  ?>
<div class="liste container-fluid">
 <table class="table table-bordered table-striped">
        <h2 class="text-center p-3" style="position: relative; left: 20%;">GİRİŞ TAKİP</h2>
        <thead>
            <tr>
              
                <th scope="col">Ad Soyad</th>
                <th scope="col">Firma Adı</th>
                <th scope="col">Telefon</th>
                  <th scope="col">Ziayretçi Tipi</th>
                    <th scope="col">Durum</th>
                <th scope="col">Kayıt Tarihi</th>
                <th scope="col">İşlemler</th>
            </tr>
        </thead>
    <?php while($surec_takip_sor_cek = $surec_takip_sor->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td><?php echo htmlspecialchars($surec_takip_sor_cek['adsoyad']); ?></td>
        <td><?php echo htmlspecialchars($surec_takip_sor_cek['firma_adi']); ?></td>
        <td><?php echo htmlspecialchars($surec_takip_sor_cek['telefon']); ?></td>
        <td><?php echo htmlspecialchars($surec_takip_sor_cek['ziyaretci_tipi']); ?></td>
         <td><?php echo htmlspecialchars($surec_takip_sor_cek['durum']); ?></td>
                <td><?php echo htmlspecialchars($surec_takip_sor_cek['kayit_tarihi']); ?></td>
        <td class="duzenle_btn">

            <?php 
            // cikis_tarih var mı kontrol et
            $cikis_var_mi = !empty($kayit_sorgu_cek['cikis_tarih']);
            ?>
<!---
            <a class="btn btn-success <?php echo $cikis_var_mi ? 'disabled' : ''; ?>" 
               href="<?php echo $cikis_var_mi ? '#' : 'index.php?sayfa=is_takib&id=' . $kayit_sorgu_cek['id']; ?>">
               Süreç Gir
            </a>--->

            <!-- Silme butonu -->
            <form action="gonder.php" method="post" style="display:inline-block;">
                <input type="hidden" name="galeri_id" value="<?php echo $kayit_sorgu_cek['id']; ?>">
                <button type="submit" name="galeri_sil" class="btn btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</button>
            </form>
        </td>
    </tr>
<?php } ?>

</tbody>

    </table>


</div>
<?php }?>
























<!----------------istakbii-------->





















</body>
</html>