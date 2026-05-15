<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sonuçları</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { color: #2c3e50; text-align: center; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; width: 40%; color: #333; }
        .success-msg { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; text-align: center; border: 1px solid #c3e6cb; }
        .error-msg { background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; text-align: center; border: 1px solid #f5c6cb; }
        .back-link { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #3498db; font-weight: bold; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="container">
    <?php
    // Sadece POST isteği ile gelindiğinde çalışsın
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Verileri alıp güvenlik için htmlspecialchars ile temizliyoruz
        $fullname = isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : '-';
        $email    = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '-';
        $phone    = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '-';
        $cityCode = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '';
        $gender   = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '-';
        
        // Checkbox verisi seçiliyse 'on' değeri gelir, gelmezse seçilmemiştir
        $terms    = isset($_POST['terms']) ? 'Kabul Edildi' : 'Kabul Edilmedi';

        // Şehir kodlarını isimlere çevirmek için bir dizi oluşturuyoruz
        $cities = [
            '34' => 'İstanbul',
            '06' => 'Ankara',
            '35' => 'İzmir'
        ];
        // Eğer gelen kod dizide varsa adını al, yoksa 'Bilinmiyor' yaz
        $cityName = array_key_exists($cityCode, $cities) ? $cities[$cityCode] : 'Bilinmiyor';

        // Cinsiyet bilgisini ilk harfi büyük olacak şekilde düzenleyelim (Örn: kadin -> Kadın)
        $genderDisplay = ($gender == 'kadin') ? 'Kadın' : (($gender == 'erkek') ? 'Erkek' : '-');

        echo "<div class='success-msg'><strong>Başarılı!</strong> Form verileri sunucuya başarıyla ulaştı.</div>";
        echo "<h2>Gelen Veriler Özeti</h2>";
        
        // Verileri tablo halinde ekrana basıyoruz
        echo "<table>";
        echo "<tr><th>Ad Soyad</th><td>{$fullname}</td></tr>";
        echo "<tr><th>E-posta</th><td>{$email}</td></tr>";
        echo "<tr><th>Telefon Numarası</th><td>{$phone}</td></tr>";
        echo "<tr><th>Şehir</th><td>{$cityName} (Kod: {$cityCode})</td></tr>";
        echo "<tr><th>Cinsiyet</th><td>{$genderDisplay}</td></tr>";
        echo "<tr><th>Kullanım Koşulları</th><td>{$terms}</td></tr>";
        echo "</table>";

    } else {
        // Eğer dosyaya direkt tarayıcıdan girilmeye çalışılırsa uyarı ver
        echo "<div class='error-msg'><strong>Hata!</strong> Bu sayfaya doğrudan erişim izniniz yok. Lütfen formu doldurarak geliniz.</div>";
    }
    ?>
    
    <a href="index.html" class="back-link">← Forma Geri Dön</a>
</div>

</body>
</html>