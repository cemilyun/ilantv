-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 Haz 2021, 14:01:14
-- Sunucu sürümü: 10.4.18-MariaDB
-- PHP Sürümü: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ilantv`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

CREATE TABLE `iletisim` (
  `id` int(11) NOT NULL,
  `adres` text COLLATE utf8_turkish_ci NOT NULL,
  `gsm` bigint(13) NOT NULL,
  `mail` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `iletisim`
--

INSERT INTO `iletisim` (`id`, `adres`, `gsm`, `mail`) VALUES
(1, 'Çobançeşme, Bahçelievler / İstanbul', 5310889707, 'ggaripcem@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kart_bilgileri`
--

CREATE TABLE `kart_bilgileri` (
  `id` int(11) NOT NULL,
  `musteri_id` int(11) NOT NULL,
  `kart_sahibi` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `kart_no` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `kart_skt_ay` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `kart_skt_yil` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `kart_cvv` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kart_bilgileri`
--

INSERT INTO `kart_bilgileri` (`id`, `musteri_id`, `kart_sahibi`, `kart_no`, `kart_skt_ay`, `kart_skt_yil`, `kart_cvv`) VALUES
(1, 9, 'Garip Cem İlyün', '517041469011408', '09', '27', 393),
(4, 9, 'Garip Cem İlyün', '517041469011408', '09', '27', 393),
(5, 9, 'Garip Cem İlyün', '', '09', '27', 393),
(6, 9, 'Garip Cem İlyün', '', '', '', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `adi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `adi`, `aciklama`) VALUES
(1, 'Araba', 'Araba açıklama.'),
(2, 'Konut', 'Konut Açıklama'),
(3, 'Motorsiklet', 'Motorsiklet Açıklama'),
(4, 'Gemi', 'Gemi Açıklama'),
(5, 'Antika', 'Antika Açıklama'),
(6, 'Bilgisayar', 'Bilgisayar açıklama.'),
(7, 'Telefon', 'Telefon Açıklama'),
(8, 'Fotoğraf & Kamera', 'Fotoğraf & Kamera açıklama.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesajlar`
--

CREATE TABLE `mesajlar` (
  `id` int(11) NOT NULL,
  `adi` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `konu` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `mesaj` text COLLATE utf8_turkish_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `mesajlar`
--

INSERT INTO `mesajlar` (`id`, `adi`, `mail`, `konu`, `mesaj`, `time`) VALUES
(29, 'Cem İlyün', 'cem@info.com', 'Site içeriği hakkında', 'Sitenizde bir açık tespit ettim. Bunu bildirmek istiyorum, lütfen bana ulaşın.', '2021-06-23 10:33:01'),
(30, 'asdsda', 'cem@info.com', 'Konuasdas', 'asddadadad', '2021-06-23 10:33:01'),
(31, 'asdsda', 'cem@info.com', 'Konuasdas', 'asddadadad', '2021-06-23 10:33:01'),
(32, 'asdsda', 'cem@info.com', 'Konuasdas', 'asddadadad', '2021-06-23 10:33:01'),
(33, 'asdsda', 'cem@info.com', 'Konuasdas', 'asddadadad', '2021-06-23 10:33:01'),
(34, 'asdsda', 'cem@info.com', 'Konuasdas', 'asddadadad', '2021-06-23 10:33:01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `id` int(11) NOT NULL,
  `isim` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `soyisim` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `adres` text COLLATE utf8_turkish_ci NOT NULL,
  `ulke` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `il` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ilce` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `postakodu` int(11) NOT NULL,
  `ucret` decimal(65,2) NOT NULL,
  `odeme` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sepet` text COLLATE utf8_turkish_ci NOT NULL,
  `skey` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`id`, `isim`, `soyisim`, `email`, `telefon`, `adres`, `ulke`, `il`, `ilce`, `postakodu`, `ucret`, `odeme`, `sepet`, `skey`, `date`, `user`) VALUES
(22, 'Garip Cem', 'İlyün', 'ggaripcem@gmail.com', '05310889707', 'Cobancesme Mah. Sokullu Sok. No:19 Daire:5 Yenibosna/İstanbul', 'Türkiye', 'İstanbul', 'Bahcelievler', 34197, '455000.00', 'Kapıda ödeme', '{\"3\":\"3\",\"13\":\"13\"}', '162470640416', '2021-06-26 14:20:04', 'cem@info.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `descc` text COLLATE utf8_turkish_ci NOT NULL,
  `image` text COLLATE utf8_turkish_ci NOT NULL,
  `amount` decimal(65,2) NOT NULL,
  `yildiz` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `kategori`, `title`, `descc`, `image`, `amount`, `yildiz`, `date`) VALUES
(1, 1, 'BMW 320i', '​\r\n2014 MODEL BMW 3.20 D TECHNO PLUS 184 HP \r\n\r\nDEĞİŞENSİZ TRAMERSİZ (SOL ARKA ÇAMURLUK LOKAL VE SAĞ ÖN KAPI LOKAL BOYALI)\r\n\r\nBEYAZ / İÇİ BEJ DERİ DÖŞEME\r\n\r\n96.000 KM\r\n\r\nKASKO DEĞERİ:345.000 TL \r\n\r\nKATLANIR AYNALAR\r\n\r\nGERİ GÖRÜŞ KAMERASI\r\n\r\nANAHTARSIZ ÇALIŞTIRMA\r\n\r\nSTART STOP\r\n\r\nBİ-XENON FARLAR\r\n\r\nFONKSİYONEL DERİ DİREKSİYON\r\n\r\n3 FARKLI SÜRÜŞ MODU ( ECO-COMFORT-SPORT)\r\n\r\nÖN ARKA PARK SENSÖRÜ\r\n\r\nHIZ SABİTLEME\r\n\r\nÖN ARKA KOL DAYAMA\r\n\r\nYAĞMUR VE FAR SENSÖRÜ\r\n\r\nBLUETOOTH AUX\r\n\r\nÇİFT YÖNLÜ DİGİTAL KLİMA\r\n\r\n18 İNÇ JANTLAR', 'upload/2019_BMW_320d_xDrive_M_Sport_2.0_Front.jpg', '110000.00', 0, '2021-06-13 16:48:12'),
(2, 2, '3+1 Ev', 'acıklama', 'upload/175844WhatsApp Image 2021-06-12 at 16.06.01.jpeg', '500000.00', 0, '2021-06-13 19:17:07'),
(3, 1, 'Mercedes E250', 'Mercedes E250 Açıklama', 'upload/2c7928e680f74681bceb8c234f2561542005201518394860069_0.jpg', '125000.00', 0, '2021-06-13 16:48:12'),
(4, 1, 'Audi A6', '2018 Model\r\n\r\nDoğuş Çıkışlı\r\n\r\nAudi A6 2.0 TDI Quattro S-Tronic 190 Hp\r\n\r\nSiyah-İçi Bej\r\n\r\nTüm Bakımları Yetkili Serviste Yapılmıştır.', 'upload/30110402018_Audi_A6_TDi_Quattro_Front.jpg', '705000.00', 0, '2021-06-13 20:49:49'),
(5, 1, 'Bugatti Chiron', 'HIZ,TUTKU,ŞEVHET...', 'upload/8739216FoS20162016_0624_132444AA_(27785299372).jpg', '1789875.00', 0, '2021-06-13 20:52:34'),
(6, 1, 'BMW 320i', '​\r\n2014 MODEL BMW 3.20 D TECHNO PLUS 184 HP \r\n\r\nDEĞİŞENSİZ TRAMERSİZ (SOL ARKA ÇAMURLUK LOKAL VE SAĞ ÖN KAPI LOKAL BOYALI)\r\n\r\nBEYAZ / İÇİ BEJ DERİ DÖŞEME\r\n\r\n96.000 KM\r\n\r\nKASKO DEĞERİ:345.000 TL \r\n\r\nKATLANIR AYNALAR\r\n\r\nGERİ GÖRÜŞ KAMERASI\r\n\r\nANAHTARSIZ ÇALIŞTIRMA\r\n\r\nSTART STOP\r\n\r\nBİ-XENON FARLAR\r\n\r\nFONKSİYONEL DERİ DİREKSİYON\r\n\r\n3 FARKLI SÜRÜŞ MODU ( ECO-COMFORT-SPORT)\r\n\r\nÖN ARKA PARK SENSÖRÜ\r\n\r\nHIZ SABİTLEME\r\n\r\nÖN ARKA KOL DAYAMA\r\n\r\nYAĞMUR VE FAR SENSÖRÜ\r\n\r\nBLUETOOTH AUX\r\n\r\nÇİFT YÖNLÜ DİGİTAL KLİMA\r\n\r\n18 İNÇ JANTLAR', 'upload/2019_BMW_320d_xDrive_M_Sport_2.0_Front.jpg', '110000.00', 0, '2021-06-13 16:48:12'),
(7, 2, '3+1 Ev', 'acıklama', 'upload/175844WhatsApp Image 2021-06-12 at 16.06.01.jpeg', '500000.00', 0, '2021-06-13 19:17:07'),
(8, 1, 'Mercedes E250', 'Mercedes E250 Açıklama', 'upload/2c7928e680f74681bceb8c234f2561542005201518394860069_0.jpg', '125000.00', 0, '2021-06-13 16:48:12'),
(9, 1, 'Audi A6', '2018 Model\r\n\r\nDoğuş Çıkışlı\r\n\r\nAudi A6 2.0 TDI Quattro S-Tronic 190 Hp\r\n\r\nSiyah-İçi Bej\r\n\r\nTüm Bakımları Yetkili Serviste Yapılmıştır.', 'upload/30110402018_Audi_A6_TDi_Quattro_Front.jpg', '705000.00', 0, '2021-06-13 20:49:49'),
(10, 1, 'Bugatti Chiron', 'HIZ,TUTKU,ŞEVHET...', 'upload/8739216FoS20162016_0624_132444AA_(27785299372).jpg', '1789875.00', 0, '2021-06-13 20:52:34'),
(11, 2, 'Uygun Fiyatlı Daire', '4+1 teras dubleks dairemiz hiç kullanılmamış tüm bakımları yapılmış otoparkı yeşil alanı site içindeki dairemiz satılıktır ( kira getirisi 3000 civarıdır )', 'upload/105990980d80fa5bdd20544a654b02c20bcd2b6.jpg', '540000.00', 0, '2021-06-14 18:40:38'),
(12, 1, 'Audi Q7', 'Audi Q7 genel dinamik görünümü ile etkileyici bir araçtır. Kişiselleştirilmiş, hatta daha sportif bir görünüm için, opsiyonel S line dış görünüm paketini seçebilirsiniz​.', 'upload/45579271920x1080_exterior_AQ7_191002.jpg', '235000.00', 0, '2021-06-23 14:11:21'),
(13, 1, 'Toyota Corolla', 'Yeni Toyota Corolla Sedan Hibrit artık daha da çekici. Toyota Corolla Hibrit\'in donanım ve teknik özelliklerini incelemek için hemen tıklayın.\r\n', 'upload/8207665thumbs_b_c_a9fe1f2e0880e902abf75b30c328b4d5.jpg', '330000.00', 0, '2021-06-23 14:12:15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL,
  `adi` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `soyadi` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `telefon` bigint(13) NOT NULL,
  `adres_baslik` varchar(25) COLLATE utf8_turkish_ci NOT NULL,
  `adres` text COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `adi`, `soyadi`, `mail`, `telefon`, `adres_baslik`, `adres`, `password`, `status`, `date`) VALUES
(1, 'Aslan', 'İlyün', 'cemc@info.com', 5310889707, '', '', '040bd08a4290267535cd247b8ba2eca129d9fe9f', 0, '2021-05-02 15:25:28'),
(2, 'Aslan', 'İlyün', 'cemb@info.com', 5310889707, '', '', '040bd08a4290267535cd247b8ba2eca129d9fe9f', 0, '2021-05-02 15:30:40'),
(3, 'Aslan', 'İlyün', 'cema@info.com', 5310889707, '', '', '040bd08a4290267535cd247b8ba2eca129d9fe9f', 0, '2021-05-02 15:31:24'),
(4, 'Aslan', 'İlyün', 'cemd@info.com', 5310889707, '', '', '040bd08a4290267535cd247b8ba2eca129d9fe9f', 0, '2021-05-02 15:31:36'),
(5, 'Cem', 'İlyün', 'cems@info.com', 5310889707, '', '', '040bd08a4290267535cd247b8ba2eca129d9fe9f', 0, '2021-05-02 15:32:27'),
(6, 'Cem', 'İlyün', 'sdasdadd@gmail.com', 5310889707, '', '', '10470c3b4b1fed12c3baac014be15fac67c6e815', 0, '2021-05-02 15:37:09'),
(7, 'Cem', 'İlyün', 'ggaripcem@gmail.com', 5310889707, '', '', '4bad499982ef9b74f7b5c9c2e6f044bcbb603214', 0, '2021-05-04 20:40:21'),
(8, 'Cem', 'İlyün', 'ggaripcem@gmail.com', 5310889707, '', '', '10470c3b4b1fed12c3baac014be15fac67c6e815', 0, '2021-05-04 20:42:10'),
(9, 'Cem', 'İlyün', 'cem@info.com', 5310889707, 'Ev', 'Çobançeşme Mah. Sokullu Sok. No:19 Daire:5 Yenibosna/İstanbul', '4bad499982ef9b74f7b5c9c2e6f044bcbb603214', 1, '2021-05-04 21:03:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `stars` tinyint(4) NOT NULL,
  `comment` text COLLATE utf8_turkish_ci NOT NULL,
  `time` timestamp NULL DEFAULT current_timestamp(),
  `urunid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `name`, `email`, `stars`, `comment`, `time`, `urunid`) VALUES
(5, 'iptv', 'cem@info.com', 2, 'asdasdadds', '2021-06-14 18:26:42', 3),
(6, 'Cem İlyün', 'cem@info.com', 3, 'sadasdsds', '2021-06-14 18:26:42', 3),
(7, 'Can Özdemir', 'canozdmr@gmail.com', 5, 'Harika!', '2021-06-14 18:33:15', 3),
(8, 'Emre Sizer', 'info@emresizer.com', 5, 'Harika abi ya.', '2021-06-22 16:06:11', 10);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `iletisim`
--
ALTER TABLE `iletisim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kart_bilgileri`
--
ALTER TABLE `kart_bilgileri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `mesajlar`
--
ALTER TABLE `mesajlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `iletisim`
--
ALTER TABLE `iletisim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `kart_bilgileri`
--
ALTER TABLE `kart_bilgileri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `mesajlar`
--
ALTER TABLE `mesajlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
