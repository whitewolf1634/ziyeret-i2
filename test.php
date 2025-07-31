$kayit_sorgu = $baglanti->prepare("
    SELECT sk.*, st.giris_tarih, st.cikis_tarih
FROM surec_kayit sk
LEFT JOIN (
    SELECT st1.*
    FROM surec_takip st1
    INNER JOIN (
        SELECT tckimlik, MAX(giris_tarih) AS max_giris
        FROM surec_takip
        GROUP BY tckimlik
    ) st2 ON st1.tckimlik = st2.tckimlik AND st1.giris_tarih = st2.max_giris
) st ON sk.tckimlik = st.tckimlik
ORDER BY sk.kayit_tarihi DESC
");
$kayit_sorgu->execute();