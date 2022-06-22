/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `dbsip` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dbsip`;

DROP PROCEDURE IF EXISTS `agregatnakesbyprofesi`;

DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregatnakesbyprofesi`()
BEGIN
 	CREATE OR REPLACE VIEW vw_agregatnakesbyprofesi AS
	SELECT p.id AS idprofesi, COUNT(f.id) AS total
	FROM mprofesi p
	LEFT JOIN mpegawai f ON f.idprofesi = p.id
	GROUP BY (p.id);
END//
DELIMITER ;

DROP PROCEDURE IF EXISTS `agregatnakesbystatussip`;

DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `agregatnakesbystatussip`()
BEGIN

CREATE OR REPLACE VIEW vw_agregatnakesbystatussip AS
SELECT tt.*, COUNT(validstatus) AS total
FROM
(
	 SELECT -2 AS status, 'no sip' AS jenis
    UNION SELECT -1, 'expired'
    UNION SELECT 0, 'expired soon'
    UNION SELECT 1, 'valid'
) AS tt
LEFT JOIN
(
SELECT *, IF(expirydiff IS NULL, -2, IF(expirydiff<0, -1, IF(expirydiff<60, 0, 1)) )  as validstatus
 FROM (
SELECT DATEDIFF(sip.expirystr, current_date) as expirydiff
FROM `mpegawai` 
 LEFT JOIN `str` on `str`.`idpegawai` = `mpegawai`.`id`  AND `str`.`isactive` = 1 
 LEFT JOIN `sip` on `sip`.`idstr` = `str`.`id` AND 
 	sip.id = ( SELECT MAX(id) as maxid  FROM `sip` WHERE `isactive` = 1 and `idpegawai` = `mpegawai`.`id` )
) AS aa) AS nn ON tt.status = nn.validstatus
GROUP BY tt.status;

END//
DELIMITER ;

CREATE TABLE IF NOT EXISTS `berkassip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idsip` int(11) NOT NULL,
  `url` varchar(500) NOT NULL DEFAULT '',
  `keterangan` varchar(100) DEFAULT NULL,
  `doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `dom` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DELETE FROM `berkassip`;
/*!40000 ALTER TABLE `berkassip` DISABLE KEYS */;
/*!40000 ALTER TABLE `berkassip` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `debug` (
  `proc_id` varchar(100) DEFAULT NULL,
  `debug_output` text DEFAULT NULL,
  `line_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`line_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

DELETE FROM `debug`;
/*!40000 ALTER TABLE `debug` DISABLE KEYS */;
/*!40000 ALTER TABLE `debug` ENABLE KEYS */;

DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `debug_insert`(in p_proc_id varchar(100),in p_debug_info text)
begin
  insert into debug (proc_id,debug_output)
  values (p_proc_id,p_debug_info);
end//
DELIMITER ;

DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `debug_off`(in p_proc_id varchar(100))
begin
  call debug_insert(p_proc_id,concat('Debug Ended :',now()));
  select debug_output from debug where proc_id = p_proc_id order by line_id;
  delete from debug where proc_id = p_proc_id;
end//
DELIMITER ;

DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `debug_on`(in p_proc_id varchar(100))
begin
  call debug_insert(p_proc_id,concat('Debug Started :',now()));
end//
DELIMITER ;

CREATE TABLE IF NOT EXISTS `mfaskes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `idkategori` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_kategori` (`idkategori`),
  CONSTRAINT `fk_kategori` FOREIGN KEY (`idkategori`) REFERENCES `mkategori` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=453 DEFAULT CHARSET=utf8mb4;

DELETE FROM `mfaskes`;
/*!40000 ALTER TABLE `mfaskes` DISABLE KEYS */;
INSERT INTO `mfaskes` (`id`, `nama`, `alamat`, `idkategori`) VALUES
	(1, 'RSUD. Dr. SOETOMO SURABAYA', 'Jl. Mayjen Prof. Dr. Moestopo No. 6-8 Surabaya', 9),
	(2, 'RS. ADI HUSADA UNDAAN WETAN', 'Jl. Undaan Wetan No. 40 - 44 Surabaya', 9),
	(3, 'RS. BHAYANGKARA TK II HS. SAMSOERI MERTOJOSO', 'Jl. A. Yani No. 116 Surabaya', 9),
	(4, 'RS. HUSADA UTAMA', 'Jl. Mayjen. Prof. Dr.Moestopo  No. 31 - 33 -35  Surabaya', 9),
	(5, 'RS. ISLAM DARUS SYIFA SURABAYA', 'Jl. Raya Benowo No. 5 Surabaya', 9),
	(6, 'RS. ISLAM JEMURSARI SURABAYA', 'Jl. Jemursari No. 51 - 57 Surabaya', 9),
	(7, 'RS. ISLAM SURABAYA', 'Jl. Jend. A Yani No. 2 - 4 Surabaya', 9),
	(8, 'RS. JIWA MENUR SURABAYA', 'Jl. Menur No. 120 Surabaya', 9),
	(9, 'RS. KATOLIK ST. VINCENTIUS A. PAULO', 'Jl. Diponegoro  No. 51  Surabaya', 9),
	(10, 'RS. KHUSUS GIGI DAN MULUT UNIVERSITAS AIRLANGGA', 'Jl. Mayjen. Prof. Dr.Moestopo  No. 47  Surabaya', 9),
	(11, 'RS. KHUSUS MATA MASYARAKAT JAWA TIMUR', 'Jl. Gayung Kebonsari Timur No. 49 Surabaya', 9),
	(12, 'RS. MANYAR MEDICAL CENTRE', 'Jl. Raya Manyar No. 9 Surabaya', 9),
	(13, 'RS. MATA UNDAAN', 'Jl. Undaan Kulon  No. 17 - 19 Surabaya', 9),
	(14, 'RS. MAYAPADA HOSPITAL SURABAYA', 'Jl. Mayjend Sungkono No. 16 - 20 Surabaya', 9),
	(15, 'RS. MITRA KELUARGA SURABAYA', 'Jl. Satelit Indah II, Darmo Satelit  Surabaya', 9),
	(16, 'RS. NATIONAL HOSPITAL', 'Jl. Boulevard Famili Selatan Kav. 1 Graha Famili Surabaya', 9),
	(17, 'RS. PRIMASATYA HUSADA CITRA ( PHC ) SURABAYA', 'Jl. Prapat Kurung Selatan No. 1 Surabaya', 9),
	(18, 'RS. ROYAL SURABAYA', 'Jl. Rungkut Industri I No.  1 Surabaya', 9),
	(19, 'RS. UNIVERSITAS AIRLANGGA SURABAYA', 'Kampus C Universitas Airlangga, Mulyorejo Surabaya', 9),
	(20, 'RSU. HAJI SURABAYA', 'Jl. Manyar Kertoadi Surabaya', 9),
	(21, 'RSUD HUSADA PRIMA', 'Jl. Karang Tembok No. 39 - A Surabaya', 9),
	(22, 'RSUD. BHAKTI DHARMA HUSADA', 'Jl. Raya Kendung No 115 - 117 Surabaya', 9),
	(23, 'RSUD. dr. MOHAMAD SOEWANDHIE', 'Jl. Tambak Rejo No. 45 - 47 Surabaya', 9),
	(24, 'RUMAH SAKIT IBU DAN ANAK BANTUAN 05.08.05 SURABAYA', 'Jl. Gubeng Pojok No. 21 Surabaya', 9),
	(25, 'RUMAH SAKIT IBU DAN ANAK FERINA', 'Jl. Irian Barat No. 7 - 11 Surabaya', 9),
	(26, 'RUMAH SAKIT IBU DAN ANAK KENDANGSARI', 'Jl. Raya Kendangsari  No. 38  Surabaya', 9),
	(27, 'RUMAH SAKIT IBU DAN ANAK KENDANGSARI MERR', 'Jl. Dr.Ir. H.Soekarno No. 2 Surabaya', 9),
	(28, 'RUMAH SAKIT IBU DAN ANAK PURA RAHARJA', 'Jl. Pucang Adi No 12 - 14 & Jl. Pucang Arjo No. 1, 3 Surabaya', 9),
	(29, 'RUMAH SAKIT IBU DAN ANAK PUTRI SURABAYA', 'Jl. Arief Rahman Hakim No. 122 Surabaya', 9),
	(30, 'RUMAH SAKIT KHUSUS IBU DAN ANAK LOMBOK DUA - DUA', 'Jl. Flores No. 12, & Jl. Lombok No 45 Surabaya', 9),
	(31, 'RUMAH SAKIT KHUSUS IBU DAN ANAK CEMPAKA PUTIH PERM', 'Jl. Jambangan Kebon Agung No. 8 Surabaya', 9),
	(32, 'RUMAH SAKIT KHUSUS IBU DAN ANAK GRAHA MEDIKA', 'Graha Sampurna Indah E-3-6-8-10-12-14-16-18-20-22 Surabaya', 9),
	(33, 'RUMAH SAKIT KHUSUS IBU DAN ANAK IBI SURABAYA', 'Jl. Dupak  No.15 A  Surabaya', 9),
	(34, 'RUMAH SAKIT KHUSUS IBU DAN ANAK LOMBOK DUA DUA LON', 'Jl. Raya Lontar No. 109 Surabaya', 9),
	(35, 'RUMAH SAKIT KHUSUS IBU DAN ANAK NUR UMMI NUMBI', 'Jl. Manukan Tengah Blok 51 J / 4 - 6 Surabaya', 9),
	(36, 'RUMAH SAKIT KHUSUS IBU DAN ANAK PERDANA MEDICA', 'Jl. Raya Kutisari No. 6 Surabaya', 9),
	(37, 'RUMAH SAKIT KHUSUS ONKOLOGI SURABAYA', 'Jl. Arif Rachman Hakim No. 184 Surabaya', 9),
	(38, 'RUMAH SAKIT KHUSUS ORTHOPEDI & TRAUMATOLOGI SURABA', 'Komp Perum Citraland Surya Emerald Mansion Utara Blok TX Kav. 10', 9),
	(39, 'RUMAH SAKIT MUJI RAHAYU', 'Jl. Raya Manukan Wetan No. 68 - 68 A Surabaya', 9),
	(40, 'RUMAH SAKIT PKU MUHAMMADIYAH SURABAYA', 'Jl. KH.Mas Mansyur No. 180 - 182 Surabaya', 9),
	(41, 'RUMAH SAKIT RUMKITAL DR. OEPOMO', 'Jl. Laksda M . Nasir No 56 Surabaya', 9),
	(42, 'RUMAH SAKIT TNI ANGKATAN LAUT Dr. RAMELAN SURABAYA', 'Jl. Gadung No. 1 Surabaya', 9),
	(43, 'RUMAH SAKIT UMUM ADI HUSADA KAPASARI', 'Jl. Kapasari No. 97-101 Surabaya', 9),
	(44, 'RUMAH SAKIT UMUM AL - IRSYAD', 'Jl. KHM. Mansyur No. 210 - 214 Surabaya', 9),
	(45, 'RUMAH SAKIT UMUM BHAKTI RAHAYU', 'Jl. Ketintang Madya I / 16 Surabaya', 9),
	(46, 'RUMAH SAKIT UMUM BUNDA', 'Jl. Raya Kandangan No 23 - 24 Surabaya', 9),
	(47, 'RUMAH SAKIT UMUM DARMO', 'Jl. Raya Darmo No. 90 Surabaya', 9),
	(48, 'RUMAH SAKIT UMUM GOTONG ROYONG', 'Jl. Medokan Semampir No 97 Surabaya', 9),
	(49, 'RUMAH SAKIT UMUM MITRA KELUARGA KENJERAN', 'Jl. Kenjeran No. 506 Surabaya', 9),
	(50, 'RUMAH SAKIT UMUM PREMIER SURABAYA', 'Jl. Nginden Intan Barat Blok B Surabaya', 9),
	(51, 'RUMAH SAKIT UMUM RUMKITALMAR EWA PANGALILA', 'Jl. Golf I No.1 Surabaya', 9),
	(52, 'RUMAH SAKIT UMUM SURABAYA MEDICAL SERVICE', 'Jl. Kapuas No. 2 Surabaya', 9),
	(53, 'RUMAH SAKIT UMUM TINGKAT III BRAWIJAYA', 'Jl. Kesatrian No 17 Surabaya', 9),
	(54, 'RUMAH SAKIT UMUM TNI AU SOEMITRO LANUD MULJONO', 'Jl. Serayu No. 17 Surabaya', 9),
	(55, 'RUMAH SAKIT UMUM WIJAYA', 'Jl. Raya Menganti 398 Surabaya', 9),
	(56, 'RUMAH SAKIT UMUM WIYUNG SEJAHTERA', 'Jl. Karangan PDAM No. 1 - 3 Surabaya', 9),
	(57, 'RUMAH SAKIT WILLIAM BOOTH SURABAYA', 'Jl. Diponegoro No 34 Surabaya', 9),
	(58, 'SILOAM HOSPITALS SURABAYA', 'Jl. Raya Gubeng  No. 70  Surabaya', 9),
	(59, 'PUSKESMAS ASEMROWO', 'Jl. Asemraya No. 8 Surabaya', 1),
	(60, 'PUSKESMAS BALAS KLUMPRIK', 'Jl. Raya Balas Klumprik Surabaya', 1),
	(61, 'PUSKESMAS BALONGSARI', 'Jl. Balongsari Tama No. 1 Surabaya', 1),
	(62, 'PUSKESMAS GADING', 'Jl. Kapas Lor I No. 1 Surabaya', 1),
	(63, 'PUSKESMAS BANGKINGAN', 'Jl. Bangkingan Pesarean No. 3 dan 4 Surabaya', 1),
	(64, 'PUSKESMAS BANYU URIP', 'Jl. Banyu Urip Kidul VI No. 8 Surabaya', 1),
	(65, 'PUSKESMAS BENOWO', 'Jl. Raya Benowo No. 48 (Lama : Jl. Raya Benowo No. 7) Surabaya', 1),
	(66, 'PUSKESMAS BULAK BANTENG', 'Jl. Dukuh Bulak Banteng Perintis Gg. Lebar No. 35 Surabaya', 1),
	(67, 'PUSKESMAS Dr. SOETOMO', 'Jl. Pandegiling No. 223 A Surabaya', 1),
	(68, 'PUSKESMAS DUKUH KUPANG', 'Jl. Dukuh Kupang Raya XXV No. 48 Surabaya', 1),
	(69, 'PUSKESMAS DUPAK', 'Jl. Dupak Bangunrejo Gg. Poli No. 6 Surabaya', 1),
	(70, 'PUSKESMAS GAYUNGAN', 'Jl. Gayungsari Barat No. 124 Surabaya', 1),
	(71, 'PUSKESMAS GUNDIH', 'Jl. Margodadi No. 36-38 Surabaya', 1),
	(72, 'PUSKESMAS GUNUNG ANYAR', 'Jl. Gunung Anyar Timur No. 70 Surabaya', 1),
	(73, 'PUSKESMAS JAGIR', 'Jl. Bendul Merisi No. 1 Surabaya', 1),
	(74, 'PUSKESMAS JEMURSARI', 'Jl. Jemursari Selatan IV/5 Surabaya', 1),
	(75, 'PUSKESMAS JERUK', 'Jl. Raya Menganti Jeruk No. 277 A Surabaya', 1),
	(76, 'PUSKESMAS KALIJUDAN', 'Jl. Kalijudan No. 123 Surabaya', 1),
	(77, 'PUSKESMAS KALIRUNGKUT', 'Jl. Rungkut Puskesmas No. 1 (Lama : Jl. Kalirungkut Puskesmas No. 1) Surabaya', 1),
	(78, 'PUSKESMAS KEBONSARI', 'Jl. Kebonsari Manunggal No. 30-32 Surabaya', 1),
	(79, 'PUSKESMAS KEDUNGDORO', 'Jl. Kaliasin Pompa No. 79-81 Surabaya', 1),
	(80, 'PUSKESMAS KEDURUS', 'Jl. Raya Mastrip No. 116 (Lama : Jl. Raya Mastrip Kedurus No. 46) Surabaya', 1),
	(81, 'PUSKESMAS KENJERAN', 'Jl. Tambak Deres No. 2 Surabaya', 1),
	(82, 'PUSKESMAS KEPUTIH', 'Jl. Keputih Tegal No. 19 Surabaya', 1),
	(83, 'PUSKESMAS KETABANG', 'Jl. Jaksa Agung Suprapto No. 10 Surabaya', 1),
	(84, 'PUSKESMAS KLAMPIS NGASEM', 'Jl. Arief Rahman Hakim No. 99 B Surabaya', 1),
	(85, 'PUSKESMAS KREMBANGAN SELATAN', 'Jl. Pesapen Selatan No. 70 Surabaya', 1),
	(86, 'PUSKESMAS LIDAH KULON', 'Jl. Menganti No. 1111 A (Lama : Jl. Menganti Lidah Kulon No. 5) Surabaya', 1),
	(87, 'PUSKESMAS LONTAR', 'Jl. Lontar Lidah Kulon No. 26 (Lama : Jl. Raya Lontar No. 26) Surabaya', 1),
	(88, 'PUSKESMAS MADE', 'Jl. Raya Made RT.01 RW.04 Surabaya', 1),
	(89, 'PUSKESMAS MANUKAN KULON', 'Jl. Manukan Dalam No. 18 Surabaya', 1),
	(90, 'PUSKESMAS MEDOKAN AYU', 'Jl. Medokan Asri Utara IV No. 31 Surabaya', 1),
	(91, 'PUSKESMAS MENUR', 'Jl. Manyar Rejo I No. 35 Surabaya', 1),
	(92, 'PUSKESMAS MOJO', 'Jl. Mojo Klanggru Wetan II No. 2 Surabaya', 1),
	(93, 'PUSKESMAS MOROKREMBANGAN', 'Jl. Tambak Asri XIII No. 7 Surabaya', 1),
	(94, 'PUSKESMAS MULYOREJO', 'Jl. Mulyorejo Utara No. 201 Belakang Surabaya', 1),
	(95, 'PUSKESMAS NGAGEL REJO', 'Jl. Ngagel Dadi III/17 Surabaya', 1),
	(96, 'PUSKESMAS PACARKELING', 'Jl. Jolotundo Baru III No. 16 Surabaya', 1),
	(97, 'PUSKESMAS PAKIS', 'Jl. Kembang Kuning No. 2 (Lama : Jl. Kembang Kuning Makam No. 6) Surabaya', 1),
	(98, 'PUSKESMAS PEGIRIAN', 'Jl. Karang Tembok No. 39 Surabaya', 1),
	(99, 'PUSKESMAS PENELEH', 'Jl. Makam Peneleh No. 35 Surabaya', 1),
	(100, 'PUSKESMAS PERAK TIMUR', 'Jl. Jakarta No. 9 Surabaya', 1),
	(101, 'PUSKESMAS PUCANG SEWU', 'Jl. Pucang Anom Timur No. 72 Surabaya', 1),
	(102, 'PUSKESMAS PUTAT JAYA', 'Jl. Kupang Gunung V No. 16 Surabaya', 1),
	(103, 'PUSKESMAS RANGKAH', 'Jl. Rangkah VII No. 94 Surabaya', 1),
	(104, 'PUSKESMAS SAWAH PULO', 'Jl. Sawah Pulo Lapangan No. 2 Surabaya', 1),
	(105, 'PUSKESMAS SAWAHAN', 'Jl. Raya Arjuna No. 119 Surabaya', 1),
	(106, 'PUSKESMAS SEMEMI', 'Jl. Kendung No. 37 (Lama: Raya Kedung) Surabaya', 1),
	(107, 'PUSKESMAS SIDOSERMO', 'Jl. Sidosermo Gg. Damri No. 51 Surabaya', 1),
	(108, 'PUSKESMAS SIDOTOPO', 'Jl. Pegirian No. 236 Surabaya', 1),
	(109, 'PUSKESMAS SIDOTOPO WETAN', 'Jl. Randu No. 102 Surabaya', 1),
	(110, 'PUSKESMAS SIMOLAWANG', 'Jl. Simolawang II Barat 45 A Surabaya', 1),
	(111, 'PUSKESMAS SIMOMULYO', 'Jl. Gumuk Bogo VI No. 1 Surabaya', 1),
	(112, 'PUSKESMAS SIWALANKERTO', 'Jl. Siwalankerto No. 134 Surabaya', 1),
	(113, 'PUSKESMAS TAMBAK WEDI', 'Jl. Tambak Wedi Baru No. 96 Surabaya', 1),
	(114, 'PUSKESMAS TAMBAKREJO', 'Jl. Ngaglik No. 87-A Surabaya', 1),
	(115, 'PUSKESMAS TANAH KALIKEDINDING', 'Jl. Kedung Cowek No. 226 Surabaya', 1),
	(116, 'PUSKESMAS TANJUNGSARI', 'Jl. Tandes No. 54 (Lama : Jl. Tanjungsari No. 116) Surabaya', 1),
	(117, 'PUSKESMAS TEMBOK DUKUH', 'Jl. Kalibutuh No. 26 Surabaya', 1),
	(118, 'PUSKESMAS TENGGILIS', 'Jl. Rungkut Mejoyo Selatan IV/P-48 Surabaya', 1),
	(119, 'PUSKESMAS WIYUNG', 'Jl. Menganti Wiyung Pasar No. 1 (Lama : Jl. Menganti Wiyung Pasar No. 20) Surabaya', 1),
	(120, 'PUSKESMAS WONOKROMO', 'Jl. Karangrejo VI No. 4 Surabaya', 1),
	(121, 'PUSKESMAS WONOKUSUMO', 'Jl. Wonokusumo Tengah No. 55 Surabaya', 1),
	(122, 'ERHA CLINIC', 'Jl. Kombes M. Duryat No. 18 - 20 I', 3),
	(123, 'PUSURA RUNGKUT', 'Jl. Rungkut Asri Tengah No. 2', 2),
	(124, 'USADA BUANA', 'Jl. Dukuh Menanggal XII No. 4', 2),
	(125, 'ADI GUNA', 'Jl. Alun - alun Rangkah No. 1 - 3', 2),
	(126, 'IDAF HUSADA', 'Ruko Wisata Bukit Mas II Blok RF No. 11', 2),
	(127, 'SRI HARTI SOEROSO', 'Jl. M. Noer No. 224', 2),
	(128, 'ERHA CLINIC CABANG JEMURSARI', 'Jl. Jemursari No. 329 - 331 A', 3),
	(129, 'ESTETIKA DR. AFFANDI', 'Jl. Diponegoro No. 144', 3),
	(130, 'ESTHER', 'Jl. Darmo Permai Selatan XIV / 24', 3),
	(131, 'ESTHER', 'JL. WR. Supratman No. 22', 3),
	(132, 'HAFIRA SKIN CARE', 'Jl. Ketintang Timur PTT III / 46', 3),
	(133, 'KANANI', 'Jl. Ngagel Jaya Tengah No. 125', 3),
	(134, 'L\'VIORS', 'Jl. Embong Ploso No. 29', 3),
	(135, 'MELANIA', 'JL.Kartini 106 - 108', 3),
	(136, 'MIRACLE', 'Jl. MH. Thamrin No. 40-42', 3),
	(137, 'MIRACLE AESTHETIC CLINIC', 'Jl. Emerald Mansion Blok TN 1 Kav 17', 3),
	(138, 'MIRACLE AESTHETIC CLINIC', 'Jl. Raya Kertajaya Indah No. 81 Blok: O-123', 3),
	(139, 'PROFIRA', 'Jl. HR. Muhammad Kav. 41', 3),
	(140, 'SKIN A', 'JL. MAYJEND YONO SOEWOYO NO. 88', 3),
	(141, 'SURABAYA SKIN CENTRE', 'Jl. May. Jen. Prof. Dr. Moestopo No. 175', 3),
	(142, 'ERHA APOTHECARY GALAXY MALL', 'Galaxy Mall Lt. 3 No. 322', 3),
	(143, 'ANARE', 'Jl. Rungkut Asri Utara XIX No. 6A', 3),
	(144, 'PROFIRA', 'Jl. Manyar Kertoarjo No. 72', 3),
	(145, 'J-GLOW', 'Jl. Bogowonto No. 25 B', 3),
	(146, 'DINA', 'Jl. Kutisari Selatan No. 128', 3),
	(147, 'TETA', 'Jl. Dr. Ir. H. Soekarno No. 87C', 3),
	(148, 'ZAP BLAMBANGAN (KHUSUS WANITA & ANAK)', 'Jl. Blambangan No. 35', 3),
	(149, 'ABDI MULIA', 'Jl. HR. Muhammad Kav 401 - 403', 3),
	(150, 'WALUYO JATI', 'Jl. Ambengan No. 68', 3),
	(151, 'SENTRA REHABILITASI MEDIK MERIDIAN', 'Jl. Manyar Tirtomoyo III No. 59', 3),
	(152, 'JOYOBOYO', 'Jl. Joyoboyo No. 49 - 51', 3),
	(153, 'BAWEAN ORTHOPAEDIC AND REHABILITATION MEDICINE CEN', 'Jl. Bawean 40', 3),
	(154, 'RUSTIADJI', 'Jl. Banyu Urip Kidul V / 19', 3),
	(155, 'TOTAL LIFE CLINIC', 'Jl. Bogowonto No  16', 3),
	(156, 'DIALISA', 'Jl. Jemur Andayani 50 Blok D No. 33 - 35', 3),
	(157, 'MEDIKA UTAMA', 'Jl. Ciliwung No. 50', 3),
	(158, 'OPTIMA', 'Jl. Rungkut Mapan FA No. 7', 3),
	(159, 'LESTARI', 'JL. GEBANG KIDUL NO. 15', 3),
	(160, 'KASIH KARUNIA', 'Jl. Raya Satelit Barat AS No. 1', 3),
	(161, 'WIDJAJA ASTHMA CENTRE', 'Jl. Dharmahusada Indah Timur No. 7', 3),
	(162, 'ROYAL CLINIC', 'Jl. Raya Darmo Permai 2 / No. 26', 3),
	(163, 'SAHABAT MEDIKA', 'Jl. Ploso Baru No. 165', 3),
	(164, 'ABDI MULIA', 'Jl Darmo Permai Timur No. 19 D - E', 3),
	(165, 'EMBARKASI HAJI SURABAYA', 'Jl. Manyar Kertoadi No. 1 - 6', 3),
	(166, 'SENTRA MEDIKA SURABYA', 'J. Raya Tenggilis 135 B', 3),
	(167, 'REJUVA', 'Jl. Mayjend Sungkono No. 151 J7-J8', 3),
	(168, 'UNTAG', 'Jl. Semolowaru 45', 3),
	(169, 'KAYOON', 'Jl. Kayoon No. 3', 3),
	(170, 'MEDIKA UTAMA 2', 'Jl. Pakuwon Town Square Blok AA I / 3 - 5', 3),
	(171, 'ELIZABETH MEDICAL CENTER', 'Jl. Sulawesi No. 36', 3),
	(172, 'SANODOC', 'Jl. Ciliwung No. 54', 3),
	(173, 'WIJAYA KUSUMA', 'Jl. Dukuh Kupang Barat 3 - 31', 3),
	(174, 'LINA LICA', 'Jl. Gapura Lontar Barat No. 40', 3),
	(175, 'DHARMAHUSADA PREMIER', 'Jl. Dharmahusada Indah No. 2', 3),
	(176, 'VINCENTIUS KRISTUS RAJA', 'Jl. Residen Sudirman No. 3', 3),
	(177, 'MEDICELLE', 'Jl. Raya Gubeng No. 11', 3),
	(178, 'PKBI JAWA TIMUR', 'Jl. Indragiri No. 24', 3),
	(179, 'NUSANTARA MEDIKA', 'Jl. Kertajaya No. 66 (H-109)', 3),
	(180, 'dr. MAKMURI (KHUSUS WANITA DAN ANAK)', 'Jl. Bratang Binangun VI No. 17', 3),
	(181, 'DERMAGICAL (KHUSUS WANITA DAN ANAK)', 'Jl. Ngagel Jaya Utara No. 94', 3),
	(182, 'BENINGS', 'Jl. Raya Darmo No. 143', 3),
	(183, 'IMPROVE', 'Jl. Trunojoyo No. 59', 3),
	(184, 'ULTRA MEDICA', 'Jl. Nias No. 26', 3),
	(185, 'CITRA MEDICAL CENTRE', 'Jl. Ketintang Baru III No. 56', 3),
	(186, 'E - TIRTA MEDICAL CENTER', 'Jl. Raya Jemursari No. 329 - 331', 3),
	(187, 'OILIA MEDICAL CENTER', 'Jl. Perak Timur No. 42', 3),
	(188, 'BIOTEST', 'Jl. RA. Kartini No. 76 - 78', 3),
	(189, 'SAYANG DIAGNOSTIC CENTER', 'Jl. Raya Sutorejo Prima PX 32', 3),
	(190, 'PARAHITA DIAGNOSTIC CENTER', 'Jl. Darmo Permai I No. 56', 3),
	(191, 'PRODIA HEALTH CLINIC', 'JL. Diponegoro 149 - 151', 3),
	(192, 'INDOSEHAT 2003', 'Jl. Iskandar Muda No. 12 - 14', 3),
	(193, 'PRODIA PWHC', 'Jl. Mayjen Yono Soewoyo 6F - 6G', 3),
	(194, 'PRODIA', 'Jl. Jemursari No. 39', 3),
	(195, 'PARAHITA DIAGNOSTIC CENTER', 'Jl. Dharmawangsa  IX No. 3', 3),
	(196, 'PRAMITA', 'Jl. Raya Mulyosari No. 48 - 50 - 52', 3),
	(197, 'PRAMITA', 'Jl. HR Muhammad No. 128 Kav 354', 3),
	(198, 'PRAMITA', 'Jl. Jemur Andayani No. 67', 3),
	(199, 'BIOTEST DARMO', 'Jl. Mayjend Yono Soewoyo No. 9B 23 - 24 (Bukit Darmo Bouelevard Office Park II B2 No. 26 - 27)', 3),
	(200, 'PRODIA SENIOR HEALTH CARE (PSHC)', 'Ruko Megah Galaxy Jl. Ir. Dr. Soekarno No. 190 B-5 (Lama: Jl. Kertajaya Indah Timur 14C / 5-6', 3),
	(201, 'PROSPEK', 'Jl. Wonosari Lor No. 4D (Lama: Jl. Wonosari Lor No. 4)', 3),
	(202, 'PROSPEK', 'Jl. Dukuh Kupang XXV No. 16', 3),
	(203, 'WESTERINDO', 'Jl. Rungkut Industri I C', 3),
	(204, 'GLENEAGLES', 'Jl. TAIS Nasution No. 5', 3),
	(205, 'PRIMA', 'Jl. Undaan Kulon No. 37', 3),
	(206, 'EAGLES HEAD MEDICAL CENTER', 'Jl. Seruni 38', 3),
	(207, 'PRAMITA', 'Jl. Ngagel Jaya 71 - 73', 3),
	(208, 'PRAMITA', 'Jl. Parang Kusuma No. 2 - 2 A', 3),
	(209, 'PARAHITA DIAGNOSTIC CENTER', 'Jl. Raya Mulyosari No. 105-105 A', 3),
	(210, 'PRIMED', 'Jl. Tanjungsari Baru No. 4', 3),
	(211, 'PRAMITA', 'Jl. Adityawarman No. 69 A', 3),
	(212, 'MITRA HUSADA', 'Jl. Manyar Kertoadi No. 19-19 A', 3),
	(213, 'PADMA BAHTERA', 'Jl. JA Suprapto No. 83-85', 3),
	(214, 'CT KLINIK', 'Jl. Dr. Ir. H. Soekarno No. 105', 3),
	(215, 'SPEKTRUM', 'Jl. Perak Barat No. 87', 3),
	(216, 'DR. SJAMSU', 'Jl. Arief Rahman Hakim No. 40', 3),
	(217, 'SURABAYA EYE CLINIC', 'Jl. Raya Jemursari No. 108', 3),
	(218, 'TRITYA', 'Jl. Baratajaya 59 Blok A - 3', 3),
	(219, 'JEC-JAVA @ SURABAYA', 'Jl. Raya Darmo No. 123 - 127', 3),
	(220, 'ILHAN EYE CENTER', 'Jl. Bawean No. 28', 3),
	(221, 'CIPUTRA SMG LASIK', 'Skyloft SOHO Lt. 8, Jl. Mayjend Sungkono 87', 3),
	(222, 'dr. HARYO Eye Care', 'Jl. Rungkut Asri Utara XIII / 10 (lama : RL II-J / 24)', 3),
	(223, 'National Eye Centre', 'Jl. Dharmahusada Indah Utara No. 41', 3),
	(224, 'Vision Eye Clinic', 'Jl. Mulyosari Mapan No. 6 (BC-2)', 3),
	(225, '3D CLINIC', 'Jl. Bhaskara Sari No. 15', 3),
	(226, '3D CLINIC', 'Jl. Raya Pakal Madya No. 39', 3),
	(227, 'INDENTAL', 'Jl. Barata Jaya XIX No. 54 A', 3),
	(228, 'SHINY SMILE DENTAL CLINIC', 'Jl. Wisma Permai Barat I No. 33 (Blok LL - 24 )', 3),
	(229, 'GIGI SEHAT', 'Jl. Mayjend Yono Soewoyo Office Park 2 Blok B2 No. 28', 3),
	(230, 'EZMO DENTAL CLINIC', 'Jl. Internasional Village C1 No. 5', 3),
	(231, 'DENTAL POINT', 'Jl. Raya Darmo Permai No. 78', 3),
	(232, 'GIGI SEHAT EAST', 'Jl. Kalasan No. 9', 3),
	(233, 'D-ARTS EMERGENCY AESTHETICS & PREVENTIVE DENTAL CA', 'Jl. Kertajaya Indah Timur 16 C / 26', 3),
	(234, 'METRODENT', 'Jl. Tenggilis No. 127', 3),
	(235, 'TEETH TOOTH', 'Jl. Niaga Puspa Sambikerep III No. 48', 3),
	(236, 'INDAH DENTAL CARE', 'Jl. Bawean No. 14', 3),
	(237, 'ORTHOPLUS', 'Jl. Mulyosari 123', 3),
	(238, 'WIBOWO DENTAL CLINIC', 'Jl. Sisimangaraja XII No. 5C', 3),
	(239, 'WIBOWO DENTAL CLINIC', 'Jl. Sedap Malam No. 16', 3),
	(240, 'FDC', 'Jl. HR Muhammad No. 84 D', 3),
	(241, 'DENTALAND', 'Jl. Darmo Permai I No. 47 A1, A7 B3', 3),
	(242, 'M2C DENTAL', 'Jl. Kapuas No. 12', 3),
	(243, 'CONFIDENTS DENTAL HOUSE', 'Jl. Ketintang Madya No. 8F', 3),
	(244, 'PUTRI RAHAYU', 'Jl. Mastrip IX  No. 9 (Lama : Jl. Warugunung RT. 4 RW. 3) Surabaya', 4),
	(245, 'YAYUK ISMAIL', 'Jl. Pandugo 203 (Lama : Jl. Wisma Indah A-2)', 4),
	(246, 'WISMA HUSADA', 'Jl. Dukuh Setro 7A Kav. 2', 4),
	(247, 'dr. IDRIS P. SIREGAR', 'Jl. Pati Unus No.70-B (Lama : Jl. Patiunus Ujung Dinkes Armatim)', 4),
	(248, 'MEDISKA SIDOTOPO', 'Jl. Sidotopo Lor No. 8', 4),
	(249, 'BDS PACUAN KUDA', 'Jl. Pacuan Kuda No. 15', 4),
	(250, 'CITA SEHAT', 'Jl. Sidosermo II Kav. 321', 4),
	(251, 'INDOSEHAT 2003', 'Jl. Sidorame No.75', 5),
	(252, 'RAJAWALI', 'Jl. Krembangan Barat 26D', 5),
	(253, 'SARTIKA 44', 'Jl. Mastrip No.32', 5),
	(254, 'PLK - UA KAMPUS C UNAIR', 'Jl. Dharmahusada Indah Utara No.6 Blok V Kampus C Unair (lama: Jl. Mulyorejo)', 5),
	(255, 'PT. GELORA DJAJA', 'Jl. Buntaran No. 9', 5),
	(256, 'MEDICO SIER', 'Jl. Rungkut Industri III No. 7 G - H', 5),
	(257, 'WACHID HASYIM', 'Jl. Sidotopo Wetan Baru No. 27', 5),
	(258, 'PONDOK KASIH', 'Jl. Gayungan PTT No. 68', 5),
	(259, 'dr. EKO', 'Jl. Medayu Selatan IV No. 15', 5),
	(260, 'PLK - UA KAMPUS B UNAIR', 'Jl. Dharmawangsa No. 3', 5),
	(261, 'SANTA ANNA', 'Jl. Babadan Rukun VII / 32', 5),
	(262, 'KELSAPA', 'Jl. Kepanjen 4-6', 5),
	(263, 'PERDANA HUSADA', 'Jl. Manukan Krajan 32Q No. 2', 5),
	(264, 'SARTIKA 59', 'Jl. Manukan Tengah 9K / 10', 5),
	(265, 'AL FITHRAH', 'Jl. Kedinding Lor 110A (Lama : Jl. Tanah Merah X No.37)', 5),
	(266, 'NAYAKA HUSADA 02', 'Jl. Raya Mastrip No. 396', 5),
	(267, 'NURANI JAYA 83', 'Jl. Kyai Abdul Karim No. 30', 5),
	(268, 'KARYA MEDIKA 111', 'Jl. Bukit Citra Klakah Rejo I / 20 (Jl. Bukit Citra Klakah Rejo I Blok C-30)', 5),
	(269, 'ALAMANDA', 'Jl. Dinoyo No. 20 B (lama : Jl. Dinoyo No. 20 - II)', 5),
	(270, 'NAYAKA HUSADA TANDES', 'Jl. Tandes Asri No. 64', 5),
	(271, 'NAYAKA HUSADA 01', 'Jl. Cendrawasih No : 28 - B', 5),
	(272, 'STIESIA', 'Jl. Manyar Kartika VIII / 36', 5),
	(273, 'AT - TAUFIQ', 'Jl. Rungkut Menanggal I No. 6 (lama : Jl. Rungkut Menanggal I /JA-9)', 5),
	(274, 'NURANI JAYA 37', 'Jl. Kendangsari III / 20', 5),
	(275, 'KLINIK DOKTER AYOMAN KELUARGA MULYOSARI', 'Jl. Sutorejo Prima Utara PDD - 1', 5),
	(276, 'TABITA', 'Jl. Lebak Jaya III No. 41', 5),
	(277, 'FAIZAH MEDIKA', 'Jl. Simorejo Sari B No. 54', 5),
	(278, 'ST. VINCENTIUS A PAULO (KARAH)', 'Jl. Karah No. 200', 5),
	(279, 'POLY "PT. PAKUWON PERMAI"', 'Jl. Puncak Indah Lontar No. 2', 5),
	(280, '65 (LXV)', 'Jl. Gubeng Kertajaya XI No. 34', 5),
	(281, 'DINAYLA UTAMA 84', 'Jl. Simo Pomahan III / 14', 5),
	(282, 'ABDI MULIA', 'Jl. Wisma Permai Barat III / 88 (Lama : Jl. Wisma Permai Barat III / Blok FP 12)', 5),
	(283, 'QUALITA MEDIKA', 'Jl.Pucang Sewu No 41', 5),
	(284, 'dr. Subur Prajitno', 'Jl.Raya Mulyosari 286', 5),
	(285, 'Yakes Telkom', 'Jl. Kanwa No. 15', 5),
	(286, 'Anugerah Karya Medika 102', 'Jl.Demak 375', 5),
	(287, 'KESAYANGAN', 'Jl.Rungkut Asri Utara IV / 10 ( lama : Jl. Rungkut Asri Utara Blok RL.1.H-5 )', 5),
	(288, 'YAYASAN SOSIAL ABDIHUSADA UTAMA', 'Jl. Raya Mulyosari 42-D  (Lama : Jl. Mulyosari Blok PDD-37)', 5),
	(289, 'CITA HUSADA', 'Jl. Rungkut Alang-Alang No. 100 (Lama : Jl. Rungkut Alang-Alang No. 145-B)', 5),
	(290, 'PT.HM Sampoerna Tbk', 'Jl. Rungkut Industri Raya No 18', 5),
	(291, 'DON BOSCO', 'Jl. Tidar No. 113', 5),
	(292, 'NAYAKA HUSADA 03', 'Jl. Asemrowo Kali No. 42 (Lama : Jl. Asemrowo Kali No.1) Surabaya', 5),
	(293, 'dr. EKO', 'Jl. Manukan Lor III - K No. 8', 5),
	(294, 'BULAN SABIT MERAH INDONESIA', 'Jl. Mojo III No. 33  (Lama : Jl. Mojo III) Surabaya', 5),
	(295, 'BNN PROVINSI JAWA TIMUR', 'Jl. Sukomanunggal No. 55', 5),
	(296, 'Anugerah Karya Medika 103', 'Jl. Gunungsari No. 124', 5),
	(297, 'SURYA GIRI JAYA 122', 'Jl. Kenjeran No. 189 A (Lama : Jl. Kenjeran No. 189) Surabaya', 5),
	(298, 'AL - AZHAR', 'Jl. Dupak Bandarejo No. 23', 5),
	(299, 'DINAYLA UTAMA 105', 'Jl. Manukan Wetan No. 36 (Lama : Jl.  Raya Bibis No. 36)', 5),
	(300, 'KESEJAHTERAAN 11', 'Jl. Rungkut Mapan Utara No. 8', 5),
	(301, 'DINAYLA UTAMA 81', 'Jl. Margorejo Baru No. 32 (Lama : Jl. Wonocolo V / 8 )', 5),
	(302, 'ADI HAYATI', 'Jl. Ketintang Baru Selatan I / 56', 5),
	(303, 'KEBANGKITAN', 'Jl. Manukan Madya No. 141', 5),
	(304, 'MITRA SEHAT', 'Jl. Raya Menganti Wiyung No. 411', 5),
	(305, 'SAMARIA', 'Jl. Penghela No. 42', 5),
	(306, 'ANUGERAH MULIA ( GKI )', 'Jl. Pregolan Bunder No. 34', 5),
	(307, 'UBAYA', 'Jl. Kalirungkut No.58 (Lama : Jl. Raya Tenggilis Mejoyo Blok AN-20)', 5),
	(308, 'SARTIKA 36', 'Jl. Bratang Binangun VI No. 47', 5),
	(309, 'JEMURSARI EMPAT', 'Jl. Jemursari No. 4', 5),
	(310, 'GOTONG ROYONG I', 'Jl. Manyar Kartika IV / 2,4,6', 5),
	(311, 'POLTEKBANG SURABAYA', 'Jl. Jemur Andayani Komp. Penerbangan III No.14 (Lama : Jl. Jemur Andayani I)', 5),
	(312, 'Q - LIFE', 'Jl. Abdul Wahab Siamin No. 78 (Lama : Komp. PT. Inti Insan Lestari Blok RE Kav. 8)', 5),
	(313, 'UK PETRA', 'Jl. Siwalankerto No. 103 -105', 5),
	(314, 'SENTUHAN KASIH BANGSA', 'Jl. Kedondong Lor V / 4', 5),
	(315, 'ELYON', 'Jl. Tanjungsari Baru No. 46', 5),
	(316, 'MEDICAL CENTER ITS', 'Jl. Arief Rahman Hakim No. 213 Kampus ITS', 5),
	(317, 'KARYA MEDIKA 41', 'Jl. Ngaglik No. 47', 5),
	(318, 'PALANG MERAH INDONESIA', 'Jl. Tambaksari No. 49', 5),
	(319, 'MEDPOINT', 'Jl. Lontar No. 229 (Lama : Jl. Lontar No. 86) Surabaya', 5),
	(320, 'PERTAMINA JAGIR', 'Jl. Jagir Wonokromo No. 88', 5),
	(321, 'PHC KEBRAON', 'Jl. Griya Kebraon Selatan FA No. 37 - 38', 5),
	(322, 'PT. UNILEVER INDONESIA Tbk', 'Jl. Rungkut Industri IV No. 5 - 11', 5),
	(323, 'YAKES TELKOM', 'Jl. Ketintang No. 152 A', 5),
	(324, 'OPTIMA', 'Jl. Rungkut Mapan Utara CA No. 20', 5),
	(325, 'MIFTACHUL MUNIR MEDIKA', 'Jl. Raya Lontar No. 117 (lama Jl. Raya Lontar No. 190)', 5),
	(326, 'PRAMESWARI', 'Jl. Gubeng Kertajaya V C No. 24', 5),
	(327, 'WIDYA MANDIRI', 'Jl. Kalirungkut 27 D - 18', 5),
	(328, 'MITRA MEDICARE', 'Jl. Dharmahusada Utara 36 - 38 Blok G - J', 5),
	(329, 'ALBA MEDIKA', 'Jl. Ploso Baru No. 73A', 5),
	(330, 'GUNUNGSARI', 'Jl. Jogoloyo No. 177 (Jl. Golf I No. 1 A)', 5),
	(331, 'PARADISE', 'Jl. Rungkut Menanggal Harapan J / 9', 5),
	(332, 'AMANINA MEDIKA', 'Jl. Mojo Kidul 113 B (d/h III Kav. 3)', 5),
	(333, 'SILOAM SURABAYA', 'Jl. Nginden Semolo No.91 (Lama : Jl. Nginden Semolowaru No.101 / 01 Ruko Manyar Garden)', 5),
	(334, 'KLINIK KERTAJAYA', 'Jl. Kertajaya No. 160', 5),
	(335, 'NAYAKA HUSADA 42', 'Jl. Rungkut No. 5J - 17 (Lama : Jl. Raya Rungkut (KO. Rungkut Mega Raya Blok J-17) Surabaya', 5),
	(336, 'KAPAS MADYA', 'Jl. Kapas Madya II No. 29 Surabaya', 5),
	(337, 'GLOBAL SEJAHTERA ABADA', 'Jl. Kutisari Indah Utara IV No. 17', 5),
	(338, 'MEDIKA PRADHANA', 'Jl.. Rungkut Asri Timur XVIII / 24 (lama : Jl. Rungkut Kidul RK.V.K-19)', 5),
	(339, 'SIER', 'Jl. Rungkut Industri Raya No. 10 Surabaya', 5),
	(340, 'ROYAL CLINIC MERR', 'Jl. Pandugo No. 31B (Lama : Jl. Pandugo No.13)', 5),
	(341, 'HIDAYAH', 'Jl. Pakis Tirtosari VI / 44', 5),
	(342, 'KIMIA FARMA DARMO', 'JL. RAYA DArmo No. 6', 5),
	(343, 'KIMIA FARMA BANYU URIP', 'Jl. Banyu Urip No. 213 (Lama : Jl. Simo Katrungan Kidul I No. 16 & 3 ) Surabaya', 5),
	(344, 'KIMIA FARMA SEBELAS MEDIKA', 'Jl. Bung Tomo No. 5 - 7', 5),
	(345, 'POLRESTABES SURABAYA', 'Jl. Rajawali No. 43', 5),
	(346, 'PUSDIKLAT HANUDNAS', 'Jl. Wiratno No. 2 (Lama : Jl. Wiratno No.1)', 5),
	(347, 'SUTEDI SENAPUTRA', 'Jl. Ksatria No. 28', 5),
	(348, 'JALA HUSADA', 'Jl. Gadung No. 25', 5),
	(349, 'AMPEL', 'Jl. Hang Tuah', 5),
	(350, 'SATKES KODIKLATAL', 'Jl. Komplek TNIAL Kodiklatal - Morokrembangan', 5),
	(351, 'POLKES 05.09.04 SURABAYA', 'Jl. Gubeng Pojok No. 27', 5),
	(352, 'BIDDOKES AHMAD YANI', 'Jl. Achmad Yani No. 116 (Lama : Jl. Komplek Rumdis Polda Jatim)', 5),
	(353, 'SUBDITKES AAL', 'Jl. Komplek AAL Bumimoro Morokrembangan', 5),
	(354, 'SATBRIMOB POLDA JATIM', 'Jl. Gresik No. 39', 5),
	(355, 'KENJERAN DISKES LANTAMAL V', 'Jl. Wiranto No. 55', 5),
	(356, 'KENCANA MEDIKA', 'Jl. Raya Kendangsari No. 78', 5),
	(357, 'BRI MEDIKA SURABAYA', 'Jl. A. Yani No. 169', 5),
	(358, 'BHAYANGKARA M. DAHLAN', 'Jl. Sriti No. 2', 5),
	(359, 'POLRES PELABUHAN TANJUNG PERAK', 'Jl. Kalianget No. 1', 5),
	(360, 'WONOSARI', 'Jl. Naga Banda II No. 14', 5),
	(361, 'ANUGRAH', 'Jl. Dukuh Kupang XIX / 39-39 A', 5),
	(362, 'CAHAYA DAMAI', 'Jl. Bulu No. 2A (Lama : Jl. Pradah Indah No. 9)', 5),
	(363, 'INDRAGIRI', 'Jl. Indragiri No. 7', 5),
	(364, 'PUSURA BALONGSARI', 'Jl. Balong Sari Tama Utara I No. 6-8 (Lama : Jl. Balongsari Tama B8-B9)', 5),
	(365, 'DOKTER ANANG SURABAYA', 'Jl. Jurang Kuping No. 5', 5),
	(366, 'BNN KOTA SURABAYA', 'Jl. Ngagel Madya V No. 22', 5),
	(367, 'ADHYAKSA KEJAKSAAN TINGGI JAWA TIMUR', 'Jl. A. Yani No. 54 - 56', 5),
	(368, 'PUSURA SUNGKONO', 'Jl. Mayjend Sungkono No. 58', 5),
	(369, 'ADINA MEDIKA', 'Jl. Kusuma Bangsa No. 67', 5),
	(370, 'BK - 10', 'Jl. Bibis Karah No. 10', 5),
	(371, 'GLOBAL SEJAHTERA ABADA 3', 'Jl. Menganti No. 1647 (Lama : Jl. Lakarsantri No. 61)', 5),
	(372, 'LAZARUS', 'Jl. Widodaren No. 15', 5),
	(373, 'LORIS', 'Jl. Sidosermo Selatan No. 10 F (Lama : Jl. Sidosermo Airdas I Blok C No.63)', 5),
	(374, 'KELUARGA PINTAR', 'Jl. Kanginan No. 55', 5),
	(375, 'POLAIRUD', 'Jl. Intan No. 1 Tanjung Perak', 5),
	(376, 'SATLINLAMIL 2', 'Jl. Hang Tuah No. 1', 5),
	(377, 'EMDEE', 'Jl. Nginden Semolo No.91 (Lama : Jl. Nginden Semolowaru No.101 / 01 Ruko Manyar Garden)', 5),
	(378, 'ERHA APOTHECARY', 'Pakuwon Mall LG 41 LG 42, Jl. Puncak Indah Lontar No.2', 5),
	(379, 'DELOVELY', 'Jl. Pasar Kembang No. 4-Q (Lama : Jl. Pasar Kembang No. 4 C-1)', 5),
	(380, 'L\'VIORS', 'Jl. HR. Muhammad 49-55 Kav. R10-R11 Surabaya (Lama : Jl. HR. Muhammad No. 49-55 Blok R10-R11 (Ruko Beverly))', 5),
	(381, 'ESTETIKA LARISSA', 'Jl. Residen Sudirman No. 25-27', 5),
	(382, 'MIRACLE TP', 'Jl. Embong Malang No. 21-31 (Lama : Jl. Basuki Rahmat No. 8-12)', 5),
	(383, 'LAURENT\'S', 'Jl. Achmad Jais No. 4B (Lama : Jl. Achmad Jais No. 6A) Surabaya', 5),
	(384, 'NAAVAGREEN NATURAL SKINCARE', 'Jl. Tidar No. 69 - 69 A (Lama : Jl. Tidar No. 69 A - 69 B)', 5),
	(385, 'DELOVELY', 'Jl. Manukan Lor No. 40 A (Lama : Jl. Manukan Lor 3K/7) Surabaya', 5),
	(386, 'MS GLOW AESTHETIC CLINIC', 'Jl. Biliton No. 1 Kec. Gubeng Kel. Gubeng Surabaya', 5),
	(387, 'MAXINE AESTHETIC CLINIC', 'Jl. Mastrip No. 46D (lama : Jl. Mastrip No. 175-176)', 5),
	(388, 'DERMASENSE', 'Jl. Ngagel Madya No. 74', 5),
	(389, 'dr. RETNAWATI', 'Jl. Manyar Jaya IV-B / 19 A (Lama : Jl. Manyar Jaya IV / 31 (IV A - 19 A)', 5),
	(390, 'FRESH FACE SKIN CARE CLINIC', 'Jl. Ronggolawe No. 15 Surabaya', 5),
	(391, 'THE EMDEE SKIN CLINIC', 'Jl. Puncak Indah Lontar No. 2', 5),
	(392, 'HOUSE OF DERMALOVE SCIENCE OF BEAUTY', 'Jl. Manyar No. 22 Surabaya', 5),
	(393, 'GRAHA dr. YANTI', 'Jl. Ambengan No. 55', 5),
	(394, 'ERHA APOTHECARY', 'Jl. Embong Malang No. 21 -31 (Lama : Jl. Basuki Rahmat No. 8 - 12)', 5),
	(395, 'SKIDENT AESTHETIC CENTER', 'Jl. Mulyosari No. 308', 5),
	(396, 'ANF', 'JL. KALISARI PERMAI NO. 60 (LAMA : JL. KALISARI PERMAI BLOK  MP2-2)', 5),
	(397, 'MARIA ELIZABETH', 'Jl. Ambengan No. 21 -23', 5),
	(398, 'ERNADE', 'Jl. Dukuh Kupang VI No. 1-3', 5),
	(399, 'PROFIRA', 'Jl. Trunojoyo No. 39', 5),
	(400, 'D\'ESTHETICO', 'Jl. Tenggilis Mejoyo Blok KH - 13', 5),
	(401, 'HAYYU SYAR\'I', 'Ruko Sentra Kencana Jl. Bung Tomo No. 8L Kav. 26', 5),
	(402, 'ESTINE', 'Jl. Manyar No. 84B', 5),
	(403, 'ZAP GALAKSI', 'Jl. Dharmahusada Indah Timur No. 35 - 37', 5),
	(404, 'LARISSA AESTHETIC TENGGILIS', 'Jl. Tenggilis No. 85', 5),
	(405, 'dr. J HEALTH AND BEAUTY CLINIC', 'Jl. Ngagel Jaya Selatan 15A', 5),
	(406, 'MAHARVA', 'Jl. Mayjen Yono Soewoyo No. 39 Blok D-25 (Jl. Kompleks Ruko Plaza Graha Family Blok D No.25)', 5),
	(407, 'ROYAL DIAMOND', 'Ruko Waterplace C-25, Jl. Pakuwon Indah Lontar Timur No. 3-5(Lama : Jl. Pakuwon Indah Lontar Timur)', 5),
	(408, 'SKIN INNOVATION', 'Jl. Embong Kemiri No. 6', 5),
	(409, 'ZAP TUNJUNGAN PLAZA', 'Jl. Embong Malang No. 21-31  (Tunjungan Plaza 6 Unit TP 6-04 08)', 5),
	(410, 'ALAMANDA', 'Jl. Menganti No. 20 (lama : Jl. Taman Pondok Indah A-33 / Jl. Raya Menganti 203 Blok A-33)', 5),
	(411, 'deLovely', 'Jl. Dharmahusada Utara No. 40 B (lama : Jl. Kaliwaron No. 122)', 5),
	(412, 'VIV CLINIC', 'Jl. Dharmahusada Indah Barat III No. 85', 5),
	(413, 'CLARICE', 'Jl. Pasar Kembang No. 4-P (Lama : Jl. Pasar Kembang No. 4-6 / B14) Surabaya', 5),
	(414, 'ORISKIN', 'Jl. Imam Bonjol No. 93 Surabaya', 5),
	(415, 'HOUSE OF HEALTHY LIVING CENTER (H2LC)', 'Jl. Pucang Anom No. 83 Surabaya', 5),
	(416, 'LIGHT HOUSE', 'Jl. WR Supratman No.55', 5),
	(417, 'DERMASTER', 'Jl. HR. Mohammad No. 134 C', 5),
	(418, 'MICHELLE', 'Jl. Rungkut Madya No.125', 5),
	(419, 'SUPER SKIN', 'Jl. Rungkut No. 145 (Lama : Jl. Rungkut Kidul No.21)', 5),
	(420, 'DELOVELY RUNGKUT', 'Jl. Rungkut No. 202 (Lama : Jl. Kalirungkut No. 70B)', 5),
	(421, 'ID BEAUTY CLINIC', 'Jl. Darmo Permai II No. 22', 5),
	(422, 'NEW LIFE', 'Komp. Perum Citraland Surya Puri Widya Kencana Blok J-1 Kav. 27', 5),
	(423, 'FACENA', 'Jl. Manyar Jaya II No. 4 A', 5),
	(424, 'FLORA HOUSE OF BEAUTY', 'Jl. Sukosemolo No. 135 (Galaxy Bumi Permai Blok H-5/1)', 5),
	(425, 'dr. MF', 'Jl. Mayjend Sungkono No. 75 B-12 (Kompleks Ruko Galeria)', 5),
	(426, 'CANTIK', 'Jl. Barata Jaya XII No. 38', 5),
	(427, 'ANNABELLE\'S SKIN CARE', 'Jl. Ciliwung No. 74 B', 5),
	(428, 'KEELA', 'Jl. Putro Agung Timur No. 58 A (Lama : Jl. Putro Agung Timur Blok D-2) Surabaya', 5),
	(429, 'DIANDRA', 'Jl. Mayjend Jono Soewojo No. 39 Blok D-9 (Lama : Komp. Plaza Graha Family Blok D No.9) Surabaya', 5),
	(430, 'dr. NICE', 'Jl. Pandugo 69 A3 Surabaya', 5),
	(431, 'GLOSKIN AESTHETIC CLINIC', 'Jl. Mayjend Sungkono No. 176 (Lama : Blok A-8)', 5),
	(432, 'DERMALOVE SCIENCE OF BEAUTY', 'Jl. Tidar 308 A-6', 5),
	(433, 'THE EMDEE SKIN CLINIC', 'Jl. Biliton No. 40 F', 5),
	(434, 'TANATA', 'Jl. H. Abdul Wahab Siamin No. 227', 5),
	(435, 'HAYYU SYAR\'I', 'Jl. Taman Niaga Sambikerep No. 25', 5),
	(436, 'ATHENA', 'Jl. Dr. Wahidin No. 3', 5),
	(437, 'B-CLINIC', 'Jl. Putat Gede Timur No. 19', 5),
	(438, 'KECANTIKAN NATURA', 'Jl. Rungkut Tengah No. 8', 5),
	(439, 'EVINE', 'Jl. Manyar Indah No. 11', 5),
	(440, 'NOVATIC', 'Jl. Ketintang No. 209 B', 5),
	(441, 'ERHA SKIN MENGANTI', 'Jl. Menganti No. 886 A', 5),
	(442, 'NAAVAGREEN NATURAL SKINCARE', 'Jl. Bali No. 9', 5),
	(443, 'SUPER SKIN', 'Jl. Menganti No. 1572 (Jl. Lakarsantri No. 39)', 5),
	(444, 'LUMINAIRE', 'Jl. Royal Lidah Kulon 34 (Lama : Perum Citraland Surya Villa Taman Telaga Blok TJ-1 No. 35 F)', 5),
	(445, 'DNY SKIN CARE (KUTAI)', 'Jl. Kutai No. 38', 5),
	(446, 'DNY SKIN CARE (KUTISARI)', 'Jl. Kutisari Indah No. 71', 5),
	(447, 'LABORATORIUM KESEHATAN DAERAH KOTA SURABAYA', 'Jl. Gayungsari Barat No.124 A Surabaya', 6),
	(448, 'LABORATORIUM KLINIK OMEGA', 'Jl. Dharmahusada Indah No. 45 F', 6),
	(449, 'LABORATORIUM KLINIK PRATAMA LARISSA', 'Jl. Raya Rungkut Asri XII No. 15 Surabaya', 6),
	(450, 'LABORATORIUM KLINIK PRATAMA PRODIA', 'Jl. Wiyung Indah I No 207 Surabaya', 6),
	(451, 'LABORATORIUM KLINIK UTAMA KEDUNGDORO KEDUNGSARI SU', 'Jl. Kedungsari No. 84 A Surabaya', 6),
	(452, 'UTD PMI KOTA SURABAYA', 'Jl. Embong Ploso No. 7 - 15 Surabaya', 7);
/*!40000 ALTER TABLE `mfaskes` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `mjenispermohonan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idprofesi` int(10) unsigned NOT NULL,
  `nama` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_mjenispermohonan_mprofesi` (`idprofesi`),
  CONSTRAINT `FK_mjenispermohonan_mprofesi` FOREIGN KEY (`idprofesi`) REFERENCES `mprofesi` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=utf8mb4;

DELETE FROM `mjenispermohonan`;
/*!40000 ALTER TABLE `mjenispermohonan` DISABLE KEYS */;
INSERT INTO `mjenispermohonan` (`id`, `idprofesi`, `nama`) VALUES
	(1, 1, 'Sarana - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(2, 1, 'Sarana - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(3, 1, 'Sarana - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(4, 1, 'Sarana - Cabut Pindah Izin - Praktek (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(5, 1, 'Surat Keterangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(6, 1, 'Perorangan - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(7, 1, 'Perorangan - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis / Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(8, 1, 'Perorangan - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(9, 1, 'Perorangan - Cabut Pindah Izin Praktek - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(10, 2, 'Sarana - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(11, 2, 'Sarana - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(12, 2, 'Sarana - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(13, 2, 'Sarana - Cabut Pindah Izin - Praktek (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(14, 2, 'Surat Keterangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(15, 2, 'Perorangan - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(16, 2, 'Perorangan - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis / Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(17, 2, 'Perorangan - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(18, 2, 'Perorangan - Cabut Pindah Izin Praktek - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(19, 3, 'Sarana - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(20, 3, 'Sarana - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(21, 3, 'Sarana - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(22, 3, 'Sarana - Cabut Pindah Izin - Praktek (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(23, 3, 'Surat Keterangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(24, 3, 'Perorangan - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(25, 3, 'Perorangan - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis / Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(26, 3, 'Perorangan - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(27, 3, 'Perorangan - Cabut Pindah Izin Praktek - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(28, 4, 'Sarana - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(29, 4, 'Sarana - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(30, 4, 'Sarana - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(31, 4, 'Sarana - Cabut Pindah Izin - Praktek (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(32, 4, 'Surat Keterangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(33, 4, 'Perorangan - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(34, 4, 'Perorangan - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis / Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(35, 4, 'Perorangan - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(36, 4, 'Perorangan - Cabut Pindah Izin Praktek - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(37, 5, 'Sarana - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(38, 5, 'Sarana - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(39, 5, 'Sarana - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(40, 5, 'Sarana - Cabut Pindah Izin - Praktek (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(41, 5, 'Surat Keterangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(42, 5, 'Perorangan - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(43, 5, 'Perorangan - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis / Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(44, 5, 'Perorangan - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(45, 5, 'Perorangan - Cabut Pindah Izin Praktek - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(46, 6, 'Sarana - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(47, 6, 'Sarana - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(48, 6, 'Sarana - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(49, 6, 'Sarana - Cabut Pindah Izin - Praktek (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(50, 6, 'Surat Keterangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(51, 6, 'Perorangan - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(52, 6, 'Perorangan - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis / Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(53, 6, 'Perorangan - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(54, 6, 'Perorangan - Cabut Pindah Izin Praktek - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(55, 7, 'Sarana - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(56, 7, 'Sarana - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(57, 7, 'Sarana - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(58, 7, 'Sarana - Cabut Pindah Izin - Praktek (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(59, 7, 'Surat Keterangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(60, 7, 'Perorangan - Izin Baru Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(61, 7, 'Perorangan - Perpanjangan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis / Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(62, 7, 'Perorangan - Pencabutan Izin Praktik - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(63, 7, 'Perorangan - Cabut Pindah Izin Praktek - (Dokter Umum/Dokter Gigi/Dokter Spesialis/Dokter Gigi Spesialis/PPDS/PPDGS)'),
	(64, 11, 'Izin Baru Praktik Tenaga Apoteker - SIPA'),
	(65, 11, 'Perpanjangan Izin Praktik Tenaga Apoteker - SIPA'),
	(66, 11, 'Cabut Izin Praktik Tenaga Apoteker - SIPA'),
	(67, 11, 'Cabut Pindah Izin Praktik Tenaga Apoteker - SIPA'),
	(68, 11, 'Surat Keterangan Perubahan Jam Tenaga Apoteker - SIPA'),
	(69, 11, 'Pergantian Izin Praktik Tenaga Apoteker - SIPA'),
	(70, 12, 'Izin Baru Praktik  Tenaga Teknis Kefarmasian - SIPTTK'),
	(71, 12, 'Perpanjangan Izin Praktik Tenaga  Teknis Kefarmasian - SIPTTK'),
	(72, 12, 'Cabut Izin Praktik Tenaga  Teknis Kefarmasian - SIPTTK'),
	(73, 12, 'Cabut Pindah Izin Praktik Tenaga Teknis Kefarmasian - SIPTTK'),
	(74, 12, 'Surat Keterangan Perubahan Jam Tenaga  Teknis Kefarmasian - SIPTTK'),
	(75, 12, 'Pergantian Izin Praktik Tenaga  Teknis Kefarmasian - SIPTTK'),
	(76, 9, 'Sarana - Izin Baru Praktik Tenaga Perawat - SIPP'),
	(77, 9, 'Sarana - Perpanjangan Izin Praktik Tenaga Perawat - SIPP'),
	(78, 9, 'Sarana - Pencabutan Izin Praktik Tenaga Perawat - SIPP'),
	(79, 9, 'Sarana - Cabut Pindah Izin Praktik Tenaga Perawat - SIPP'),
	(80, 9, 'Perorangan - Izin Baru Praktik Tenaga Perawat - SIPP'),
	(81, 9, 'Perorangan - Perpanjangan Izin Praktik Tenaga Perawat - SIPP'),
	(82, 9, 'Perorangan - Pencabutan Izin Praktik Tenaga Perawat - SIPP'),
	(83, 9, 'Perorangan - Cabut Pindah Izin Praktik Tenaga Perawat - SIPP'),
	(84, 10, 'Sarana - Izin Baru Praktik Tenaga Bidan - SIPB'),
	(85, 10, 'Sarana - Perpanjangan Izin Praktik Tenaga Bidan - SIPB'),
	(86, 10, 'Sarana - Pencabutan Izin Praktik Tenaga Bidan - SIPB'),
	(87, 10, 'Sarana - Cabut Pindah Izin Praktik Tenaga Bidan - SIPB'),
	(88, 10, 'Perorangan - Izin Baru Praktik Tenaga Bidan - SIPB'),
	(89, 10, 'Perorangan - Perpanjangan Izin Praktik Tenaga Bidan - SIPB'),
	(90, 10, 'Perorangan - Pencabutan Izin Praktik Tenaga Bidan - SIPB'),
	(91, 10, 'Perorangan - Cabut Pindah Izin Praktik Tenaga Bidan - SIPB'),
	(92, 16, 'Sarana - Izin Baru Tenaga Okupasi Terapis - SIKOP'),
	(93, 16, 'Sarana - Perpanjangan Izin Tenaga Okupasi Terapis - SIKOP'),
	(94, 16, 'Sarana - Pencabutan Izin Tenaga Okupasi Terapis - SIKOP'),
	(95, 16, 'Sarana - Cabut Pindah Izin Tenaga Okupasi Terapis - SIKOP'),
	(96, 16, 'Perorangan - Izin Baru Praktik Tenaga Okupasi Terapis - SIPOP'),
	(97, 16, 'Perorangan - Perpanjangan Praktik Izin Tenaga Okupasi Terapis - SIPOP'),
	(98, 16, 'Perorangan - Pencabutan Praktik Izin Tenaga Okupasi Terapis - SIPOP'),
	(99, 16, 'Perorangan - Cabut Pindah Praktik Izin Tenaga Okupasi Terapis - SIPOP'),
	(100, 17, 'Sarana - Izin Baru Praktik Tenaga Terapis Wicara - SIKTW'),
	(101, 17, 'Sarana - Perpanjangan Izin Tenaga Terapis Wicara - SIKTW'),
	(102, 17, 'Sarana - Pencabutan Izin Tenaga Terapis Wicara - SIKTW'),
	(103, 17, 'Sarana - Cabut Pindah Izin Tenaga Terapis Wicara - SIKTW'),
	(104, 17, 'Perorangan - Izin Baru Tenaga Terapis Wicara - SIPTW'),
	(105, 17, 'Perorangan - Perpanjangan Izin TenagaTerapis Wicara - SIPTW'),
	(106, 17, 'Perorangan - Pencabutan Izin Tenaga Terapis Wicara - SIPTW'),
	(107, 17, 'Perorangan - Cabut Pindah Izin Tenaga Terapis Wicara - SIPTW'),
	(108, 15, 'Sarana - Izin Baru Tenaga Fisioterapis - SIKF'),
	(109, 15, 'Sarana - Perpanjangan Izin Tenaga Fisioterapis - SIKF'),
	(110, 15, 'Sarana - Pencabutan Izin Tenaga Fisioterapis - SIKF'),
	(111, 15, 'Sarana - Cabut Pindah Izin Tenaga Fisioterapis - SIKF'),
	(112, 15, 'Perorangan - Izin Baru Tenaga Fisioterapis - SIPF'),
	(113, 15, 'Perorangan - Perpanjangan Izin Tenaga  Fisioterapis - SIPF'),
	(114, 15, 'Perorangan - Pencabutan Izin Tenaga  Fisioterapis - SIPF'),
	(115, 15, 'Perorangan - Cabut Pindah Izin Tenaga  Fisioterapis - SIPF'),
	(116, 18, 'Sarana - Izin Baru Praktik Tenaga Akupunktur Terapis - SIPAT'),
	(117, 18, 'Sarana - Perpanjangan Izin Praktik Tenaga Akupunktur Terapis - SIPAT'),
	(118, 18, 'Sarana - Pencabutan Izin Praktik Tenaga Akupunktur Terapis - SIPAT'),
	(119, 18, 'Sarana - Cabut Pindah Izin Praktik Tenaga Akupunktur Terapis - SIPAT'),
	(120, 18, 'Perorangan - Izin Baru Praktik Tenaga Akupunktur Terapis - SIPAT'),
	(121, 18, 'Perorangan - Perpanjangan Izin Praktik Akupunktur Terapis - SIPAT'),
	(122, 18, 'Perorangan - Pencabutan Izin Praktik Tenaga Akupunktur Terapis - SIPAT'),
	(123, 18, 'Perorangan - Cabut Pindah Izin Praktik Tenaga Akupunktur Terapis - SIPAT'),
	(124, 14, 'Sarana - Izin Baru Tenaga Gizi - SIKTGz'),
	(125, 14, 'Sarana - Perpanjangan Izin Tenaga Gizi - SIKTGz'),
	(126, 14, 'Sarana - Pencabutan Izin Tenaga Gizi - SIKTGz'),
	(127, 14, 'Sarana - Cabut Pindah Izin Tenaga Gizi - SIKTGz'),
	(128, 14, 'Perorangan - Izin Baru Tenaga Gizi - SIPTGz'),
	(129, 14, 'Perorangan - Perpanjangan Izin Tenaga Gizi - SIPTGz'),
	(130, 14, 'Perorangan - Pencabutan Izin Tenaga  Tenaga Gizi - SIPTGz'),
	(131, 14, 'Perorangan - Cabut Pindah Izin Tenaga Tenaga Gizi - SIPTGz'),
	(132, 24, 'Sarana - Izin Baru Praktik Tenaga Terapis Gigi dan Mulut - SIPTGM'),
	(133, 24, 'Sarana - Perpanjangan Izin Praktik Tenaga Terapis Gigi dan Mulut - SIPTGM'),
	(134, 24, 'Sarana - Pencabutan Izin Praktik Tenaga Terapis Gigi dan Mulut - SIPTGM'),
	(135, 24, 'Sarana - Cabut Pindah Izin Praktik Tenaga Terapis Gigi dan Mulut - SIPTGM'),
	(136, 24, 'Perorangan - Izin Baru Praktik TenagaTerapis Gigi dan Mulut - SIPTGM'),
	(137, 24, 'Perorangan - Perpanjangan Izin Praktik Terapis Gigi dan Mulut - SIPTGM'),
	(138, 24, 'Perorangan - Pencabutan Izin Praktik Tenaga Terapis Gigi dan Mulut - SIPTGM'),
	(139, 24, 'Perorangan - Cabut Pindah Izin Praktik Tenaga Terapis Gigi dan Mulut - SIPTGM'),
	(140, 28, 'Sarana - Izin Baru Tenaga Ortotis Prostetis - SIKOP'),
	(141, 28, 'Sarana - Perpanjangan Izin Tenaga Ortotis Prostetis - SIKOP'),
	(142, 28, 'Sarana - Pencabutan Izin Tenaga Ortotis Prostetis - SIKOP'),
	(143, 28, 'Sarana - Cabut Pindah Izin Tenaga Ortotis Prostetis - SIKOP'),
	(144, 28, 'Perorangan - Izin Baru Tenaga Ortotis Prostetis - SIPOP'),
	(145, 28, 'Perorangan - Perpanjangan Izin Tenaga  Ortotis Prostetis - SIPOP'),
	(146, 28, 'Perorangan - Pencabutan Izin Tenaga  Ortotis Prostetis - SIPOP'),
	(147, 28, 'Perorangan - Cabut Pindah Izin Tenaga  Ortotis Prostetis - SIPOP'),
	(148, 8, 'Sarana - Izin Baru Praktik Tenaga Psikolog Klinis - SIPPK'),
	(149, 8, 'Sarana - Perpanjangan Izin Praktik Tenaga Psikolog Klinis - SIPPK'),
	(150, 8, 'Sarana - Pencabutan Izin Praktik Tenaga Psikolog Klinis - SIPPK'),
	(151, 8, 'Sarana - Cabut Pindah Izin Praktik Tenaga Psikolog Klinis - SIPPK'),
	(152, 8, 'Perorangan - Izin Baru Praktik Tenaga Psikolog Klinis - SIPPK'),
	(153, 8, 'Perorangan - Perpanjangan Izin Praktik Psikolog Klinis - SIPPK'),
	(154, 8, 'Perorangan - Pencabutan Izin Praktik Tenaga Psikolog Klinis - SIPPK'),
	(155, 8, 'Perorangan - Cabut Pindah Izin Praktik Tenaga Psikolog Klinis - SIPPK'),
	(156, 29, 'Sarana - Izin Baru Praktik Tenaga Kesehatan Tradisional - SIPTKT'),
	(157, 29, 'Sarana - Perpanjangan Izin Praktik Tenaga Kesehatan Tradisional - SIPTKT'),
	(158, 29, 'Sarana - Pencabutan Izin Praktik Tenaga Kesehatan Tradisional - SIPTKT'),
	(159, 29, 'Sarana - Cabut Pindah Izin Praktik Tenaga Kesehatan Tradisional - SIPTKT'),
	(160, 29, 'Perorangan - Izin Baru Praktik Tenaga Kesehatan Tradisional - SIPTKT'),
	(161, 29, 'Perorangan - Perpanjangan Izin Praktik Tenaga Kesehatan Tradisional - SIPTKT'),
	(162, 29, 'Perorangan - Pencabutan Izin Praktik Tenaga Kesehatan Tradisional - SIPTKT'),
	(163, 29, 'Perorangan - Cabut Pindah Izin Praktik Tenaga Kesehatan Tradisional - SIPTKT'),
	(164, 30, 'Sarana - Izin Baru Praktik Tenaga Kesehatan Tradisional Jamu - SIPTKT Jamu'),
	(165, 30, 'Sarana - Perpanjangan Izin Praktik Tenaga Kesehatan Tradisional Jamu - SIPTKT Jamu'),
	(166, 30, 'Sarana - Pencabutan Izin Praktik Tenaga Kesehatan Tradisional Jamu - SIPTKT Jamu'),
	(167, 30, 'Sarana - Cabut Pindah Izin Praktik Tenaga Kesehatan Tradisional Jamu - SIPTKT Jamu'),
	(168, 30, 'Perorangan - Izin Baru Praktik Tenaga Kesehatan Tradisional Jamu - SIPTKT Jamu'),
	(169, 30, 'Perorangan - Perpanjangan Izin Praktik Tenaga Kesehatan Tradisional Jamu - SIPTKT Jamu'),
	(170, 30, 'Perorangan - Pencabutan Izin Praktik Tenaga Kesehatan Tradisional Jamu - SIPTKT Jamu'),
	(171, 30, 'Perorangan - Cabut Pindah Izin Praktik Tenaga Kesehatan Tradisional Jamu - SIPTKT Jamu'),
	(172, 31, 'Sarana - Izin Baru Praktik Tenaga Kesehatan Tradisional Interkontinental - SIPTKT Interkontinental'),
	(173, 31, 'Sarana - Perpanjangan Izin Praktik Tenaga Kesehatan Tradisional Interkontinental - SIPTKT Interkontinental'),
	(174, 31, 'Sarana - Pencabutan Izin Praktik Tenaga Kesehatan Tradisional Interkontinental - SIPTKT Interkontinental'),
	(175, 31, 'Sarana - Cabut Pindah Izin Praktik Tenaga Kesehatan Tradisional Interkontinental - SIPTKT Interkontinental'),
	(176, 31, 'Perorangan - Izin Baru Praktik Tenaga Kesehatan Tradisional Interkontinental - SIPTKT Interkontinental'),
	(177, 31, 'Perorangan - Perpanjangan Izin Praktik Tenaga Kesehatan Tradisional Interkontinental - SIPTKT Interkontinental'),
	(178, 31, 'Perorangan - Pencabutan Izin Praktik Tenaga Kesehatan Tradisional Interkontinental - SIPTKT Interkontinental'),
	(179, 31, 'Perorangan - Cabut Pindah Izin Praktik Tenaga Kesehatan Tradisional Interkontinental - SIPTKT Interkontinental'),
	(180, 21, 'Izin Baru Tenaga Refraksionis Optisien dan Optometris - SIKRO/SIKO'),
	(181, 21, 'Perpanjangan Tenaga Refraksionis Optisien dan Optometris - SIKRO/SIKO'),
	(182, 21, 'Cabut Izin Tenaga  Teknis Refraksionis Optisien dan Optometris - SIKRO/SIKO'),
	(183, 21, 'Cabut Pindah Izin Tenaga Teknis Refraksionis Optisien dan Optometris - SIKRO/SIKO'),
	(184, 21, 'Pergantian Izin Tenaga Refraksionis Optisien dan Optometris - SIKRO/SIKO'),
	(185, 25, 'Izin Baru Tenaga Radiografer - SIKR'),
	(186, 25, 'Perpanjangan Tenaga Radiografer - SIKR'),
	(187, 25, 'Cabut Izin Tenaga Radiografer - SIKR'),
	(188, 25, 'Cabut Pindah Izin Tenaga Radiografer - SIKR'),
	(189, 26, 'Izin Baru Praktik Tenaga Elektromedis - SIPE'),
	(190, 26, 'Perpanjangan Izin Praktik Tenaga Elektromedis - SIPE'),
	(191, 26, 'Cabut Izin Praktik Tenaga Elektromedis - SIPE'),
	(192, 26, 'Cabut Pindah Izin Praktik Tenaga Elektromedis - SIPE'),
	(193, 23, 'Izin Baru Praktik Tenaga Penata Anestesi - SIPPA'),
	(194, 23, 'Perpanjangan Izin Praktik Tenaga Penata Anestesi - SIPPA'),
	(195, 23, 'Cabut Izin Praktik Tenaga Penata Anestesi - SIPPA'),
	(196, 23, 'Cabut Pindah Izin Praktik Tenaga Penata Anestesi - SIPPA'),
	(197, 20, 'Izin Baru Praktik Tenaga Teknisi Kardiovaskuler - SIPTKV'),
	(198, 20, 'Perpanjangan Izin Praktik Tenaga Teknisi Kardiovaskuler - SIPTKV'),
	(199, 20, 'Cabut Izin Praktik Tenaga Teknisi Kardiovaskuler - SIPTKV'),
	(200, 20, 'Cabut Pindah Izin Praktik Tenaga Teknisi Kardiovaskuler - SIPTKV'),
	(201, 13, 'Izin Baru Tenaga Sanitarian - SIKTS'),
	(202, 13, 'Perpanjangan Tenaga Sanitarian - SIKTS'),
	(203, 13, 'Cabut Izin Tenaga Sanitarian - SIKTS'),
	(204, 13, 'Cabut Pindah Izin Tenaga Sanitarian - SIKTS'),
	(205, 19, 'Izin Baru Tenaga Perekam Medis - SIKPM'),
	(206, 19, 'Perpanjangan Tenaga Perekam Medis - SIKPM'),
	(207, 19, 'Cabut Izin Tenaga Perekam Medis - SIKPM'),
	(208, 19, 'Cabut Pindah Izin Tenaga Perekam Medis - SIKPM'),
	(209, 22, 'Izin Baru Tenaga Teknisi Gigi - SIKTG'),
	(210, 22, 'Perpanjangan Tenaga Teknisi Gigi - SIKTG'),
	(211, 22, 'Cabut Izin Tenaga Teknisi Gigi - SIKTG'),
	(212, 22, 'Cabut Pindah Izin Tenaga Teknisi Gigi - SIKTG'),
	(213, 32, 'Sarana - Terdaftar Baru Tenaga Penyehat Tradisional - STPT'),
	(214, 32, 'Sarana - Perpanjangan Terdaftar Tenaga Penyehat Tradisional - STPT'),
	(215, 32, 'Sarana - Pencabutan Terdaftar Tenaga Penyehat Tradisional - STPT'),
	(216, 32, 'Sarana - Cabut Pindah Terdaftar Tenaga Penyehat Tradisional - STPT'),
	(217, 32, 'Perorangan - Terdaftar Baru Tenaga Penyehat Tradisional - STPT'),
	(218, 32, 'Perorangan - Perpanjangan Terdaftar Tenaga Penyehat Tradisional - STPT'),
	(219, 32, 'Perorangan - Pencabutan  Terdaftar Tenaga Penyehat Tradisional - STPT'),
	(220, 32, 'Perorangan - Cabut Pindah Terdaftar Tenaga Penyehat Tradisional - STPT'),
	(221, 27, 'Izin Baru Praktik Tenaga Ahli Teknologi Laboratorium Medik - SIPATLM'),
	(222, 27, 'Perpanjangan Izin Praktik Tenaga Ahli Teknologi Laboratorium Medik - SIPATLM'),
	(223, 27, 'Cabut Izin Praktik Tenaga Ahli Teknologi Laboratorium Medik - SIPATLM'),
	(224, 27, 'Cabut Pindah Izin Praktik Tenaga Ahli Teknologi Laboratorium Medik - SIPATLM');
/*!40000 ALTER TABLE `mjenispermohonan` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `mkategori` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

DELETE FROM `mkategori`;
/*!40000 ALTER TABLE `mkategori` DISABLE KEYS */;
INSERT INTO `mkategori` (`id`, `nama`) VALUES
	(1, 'PUSKESMAS'),
	(2, 'KLINIK UTAMA RAWAT INAP'),
	(3, 'KLINIK UTAMA RAWAT JALAN'),
	(4, 'KLINIK PRATAMA RAWAT INAP'),
	(5, 'KLINIK PRATAMA RAWAT JALAN'),
	(6, 'LABORATORIUM'),
	(7, 'UTD'),
	(8, 'PRAKTIK MANDIRI'),
	(9, 'RUMAH SAKIT');
/*!40000 ALTER TABLE `mkategori` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `mpegawai` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nomorregis` int(4) unsigned zerofill NOT NULL,
  `idprofesi` int(10) unsigned NOT NULL,
  `kodeprofesi` varchar(10) NOT NULL,
  `idspesialisasi` int(10) unsigned DEFAULT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tempatlahir` varchar(20) DEFAULT NULL,
  `tanggallahir` date DEFAULT NULL,
  `jeniskelamin` varchar(1) DEFAULT NULL,
  `alamatktp` varchar(250) DEFAULT NULL COMMENT 'alamat ktp',
  `alamat` varchar(250) DEFAULT NULL COMMENT 'alamat domisili',
  `nohp` varchar(14) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kabkota` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kelurahan` varchar(50) DEFAULT NULL,
  `perguruantinggi` varchar(50) DEFAULT NULL,
  `tahunlulus` int(11) DEFAULT NULL,
  `profesi` varchar(50) DEFAULT NULL COMMENT 'DOKTER/ DOKTER GIGI/ PERAWAT/ APOTEKER',
  `spesialisasi` varchar(50) DEFAULT NULL,
  `foto` varchar(30) DEFAULT NULL,
  `idc` int(10) unsigned NOT NULL,
  `doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `idm` int(10) unsigned NOT NULL,
  `dom` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `nik` (`nik`) USING BTREE,
  UNIQUE KEY `nomorregis_idprofesi_u` (`nomorregis`,`idprofesi`) USING BTREE,
  KEY `fk_idprofesi` (`idprofesi`),
  KEY `fk_spesialisasi` (`idspesialisasi`),
  KEY `FK_str_mpegawai` (`id`,`nomorregis`,`idprofesi`,`idspesialisasi`),
  CONSTRAINT `fk_profesi` FOREIGN KEY (`idprofesi`) REFERENCES `mprofesi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_spesialisasi` FOREIGN KEY (`idspesialisasi`) REFERENCES `mspesialisasi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

DELETE FROM `mpegawai`;
/*!40000 ALTER TABLE `mpegawai` DISABLE KEYS */;
INSERT INTO `mpegawai` (`id`, `nomorregis`, `idprofesi`, `kodeprofesi`, `idspesialisasi`, `nik`, `nama`, `tempatlahir`, `tanggallahir`, `jeniskelamin`, `alamatktp`, `alamat`, `nohp`, `provinsi`, `kabkota`, `kecamatan`, `kelurahan`, `perguruantinggi`, `tahunlulus`, `profesi`, `spesialisasi`, `foto`, `idc`, `doc`, `idm`, `dom`) VALUES
	(1, 0001, 28, 'ort', NULL, '3515171807850003', 'VIVID PERDANANTO, AMd.OP', 'Surabaya', '1985-07-18', 'L', 'Pondok Sedati Asri L - 12 A Sidoarjo', NULL, '08562998571', NULL, NULL, NULL, NULL, NULL, NULL, 'Ortotik Prostetik', NULL, NULL, 1, '2022-06-14 15:50:17', 1, '2022-06-16 15:18:47'),
	(2, 0002, 28, 'ort', NULL, '3515130407840004', 'YULIUS ARDIYAN TEDY HERMAWAN D', 'Surabaya', '1984-07-04', 'L', 'Griya Bhayangkara Blok I 4 / 27 Sidoarjo', NULL, '08155523557', NULL, NULL, NULL, NULL, NULL, NULL, 'Ortotik Prostetik', NULL, NULL, 1, '2022-06-14 15:50:17', 1, '2022-06-16 15:18:48'),
	(3, 0003, 28, 'ort', NULL, '3504132410910002', 'GINANJAR NUR RAHIIM PRIMA, A.M', 'Tulungagung', '1991-10-24', 'L', 'Jl. Semolowaru Utara III No. 21 Surabaya', NULL, '085725607055', NULL, NULL, NULL, NULL, NULL, NULL, 'Ortotik Prostetik', NULL, NULL, 1, '2022-06-14 15:50:17', 1, '2022-06-16 15:18:49'),
	(4, 0004, 28, 'ort', NULL, '3523152810860001', 'RAMAN PERMADI, A.Md. OP', 'Tuban', '1986-10-28', 'L', 'Deltasari Indah Blok L - 25 Waru Sidoarjo', NULL, '08563342125', NULL, NULL, NULL, NULL, NULL, NULL, 'Ortotik Prostetik', NULL, NULL, 1, '2022-06-14 15:50:17', 1, '2022-06-16 15:18:50'),
	(5, 0005, 28, 'ort', NULL, '3578250401610002', 'AGUS BHARATA, A.Md. OP', 'Surakarta', '1961-01-04', 'L', 'Perum Gunung Anyar Emas Q / 4 Surabaya', NULL, '08155003772', NULL, NULL, NULL, NULL, NULL, NULL, 'Ortotik Prostetik', NULL, NULL, 1, '2022-06-14 15:50:17', 1, '2022-06-16 15:18:50'),
	(6, 0006, 28, 'ort', NULL, '3310260604930001', 'ACHMAD ZAENURI, A.Md. OP', 'Klaten', '1993-04-06', 'L', 'Jl. Gunung Anyar Tambak IV No. 34 A Surabaya', NULL, '085743194321', NULL, NULL, NULL, NULL, NULL, NULL, 'Ortotik Prostetik', NULL, NULL, 1, '2022-06-14 15:50:17', 1, '2022-06-16 15:18:51'),
	(7, 0007, 28, 'ort', NULL, '3313122203930002', 'GRAHA BUDHI TETUKO, A.Md. OP', 'Jambi', '1993-03-22', 'L', 'Perum De Java Village Blok G 4 Wagir Indah Sedati Sidoarjo', NULL, '085741515521', NULL, NULL, NULL, NULL, NULL, NULL, 'Ortotik Prostetik', NULL, NULL, 1, '2022-06-14 15:50:17', 1, '2022-06-16 15:18:52'),
	(8, 0008, 28, 'ort', NULL, '3578090807850002', 'EKKY YULIARTO NURBASKORO, A.Md', 'Surabaya', '1985-07-08', 'L', 'Jl. Gebang Kidul Sepuhan No. 18 Surabaya', NULL, '081231070888', NULL, NULL, NULL, NULL, NULL, NULL, 'Ortotik Prostetik', NULL, NULL, 1, '2022-06-14 15:50:17', 1, '2022-06-16 15:18:54'),
	(9, 0009, 28, 'ort', NULL, '3312180606950001', 'BAGUS ERYG MACHENDRA, A.Md. OP', 'Wonogiri', '1995-06-06', 'L', 'Perumahan Bumi Pratama Asri Jl. Gunung Anyar Pratama III Blok E No. 1 Surabaya', NULL, '0878822404777', NULL, NULL, NULL, NULL, NULL, NULL, 'Ortotik Prostetik', NULL, NULL, 1, '2022-06-14 15:50:17', 1, '2022-06-16 15:18:55'),
	(10, 0010, 28, 'ort', NULL, '3372010412950004', 'PRASOJO JATI, A.Md. OP', 'Surakarta', '1995-12-04', 'L', 'Jl. Karang Menjangan I No. 27 Surabaya', NULL, '081914358062', NULL, NULL, NULL, NULL, NULL, NULL, 'Ortotik Prostetik', NULL, NULL, 1, '2022-06-14 15:50:17', 1, '2022-06-16 15:18:57'),
	(11, 0001, 1, 'dru', NULL, '35782700000', 'Abdul A. B. C.', 'Surabaya', '1993-04-27', 'L', 'Jemursari no.197', NULL, '0895361609011', NULL, NULL, NULL, NULL, NULL, NULL, 'Dokter', '', NULL, 1, '0000-00-00 00:00:00', 1, '2022-06-16 15:19:01'),
	(12, 0001, 2, 'drg', NULL, '0872304093498943', 'Adit', NULL, '2022-06-16', 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dokter Gigi', NULL, NULL, 1, '2022-06-16 15:30:40', 1, '2022-06-16 15:30:40'),
	(13, 0002, 1, 'dru', NULL, '7777777777777773', 'Subur', NULL, '1999-06-16', 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dokter', NULL, NULL, 1, '2022-06-16 21:18:30', 1, '2022-06-16 21:18:30'),
	(14, 0003, 1, 'dru', NULL, '3522231510234444', 'Bambang', 'Nusantara', '1998-06-16', 'L', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Dokter', NULL, NULL, 1, '2022-06-16 21:20:19', 1, '2022-06-21 14:18:27');
/*!40000 ALTER TABLE `mpegawai` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `mpejabat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(30) DEFAULT '',
  `nama` varchar(100) DEFAULT '',
  `jabatan` varchar(50) DEFAULT '',
  `pangkat` varchar(50) DEFAULT '',
  `isactive` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

DELETE FROM `mpejabat`;
/*!40000 ALTER TABLE `mpejabat` DISABLE KEYS */;
INSERT INTO `mpejabat` (`id`, `nip`, `nama`, `jabatan`, `pangkat`, `isactive`) VALUES
	(1, '19700117 199403 2 008', 'NANIK SUKRISTINA, SKM., M. Kes.', 'Kepala Dinas', '	PEMBINA TINGKAT I/IV-B', 1),
	(2, '19650814 198803 1 012', 'HARIYANTO SKM., M.SI', 'Kepala Bidang', 'PENATA TINGKAT I/III-D', 1),
	(3, '19751107 200003 2 003', 'EMY RATMAWATI, SKM', 'Sub Koordinator', 'PENATA TINGKAT I/III-D', 1),
	(4, '', 'RM IVAN INDRAKUSUMA, S.Kom.', 'Staf', '', 1),
	(6, '', 'ANNAS NURIL IMAN, S.Kom.', 'Staf', '', 1);
/*!40000 ALTER TABLE `mpejabat` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `mprofesi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `kode` varchar(10) NOT NULL DEFAULT '',
  `isparent` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

DELETE FROM `mprofesi`;
/*!40000 ALTER TABLE `mprofesi` DISABLE KEYS */;
INSERT INTO `mprofesi` (`id`, `nama`, `kode`, `isparent`) VALUES
	(1, 'Dokter', 'dru', 0),
	(2, 'Dokter Gigi', 'drg', 0),
	(3, 'Dokter Spesialis', 'drs', 1),
	(4, 'Dokter Gigi Spesialis', 'dgs', 1),
	(5, 'PPDS (Program Pendidikan Dokter Spesialis)', 'pdr', 0),
	(6, 'PPDGS (Program Pendidikan Dokter Gig Spesialis)', 'pdg', 0),
	(7, 'Dokter Internship', 'dri', 0),
	(8, 'Psikologi Klinis', 'psi', 0),
	(9, 'Perawat', 'prw', 0),
	(10, 'Bidan', 'bid', 0),
	(11, 'Apoteker', 'apt', 0),
	(12, 'Tenaga Teknis Kefarmasian', 'ttk', 0),
	(13, 'Sanitasi Lingkungan', 'san', 0),
	(14, 'Nutrisionis/Dietisien', 'nut', 0),
	(15, 'Fisioterapis', 'fis', 0),
	(16, 'Okupasi Terapis', 'oku', 0),
	(17, 'Terapis Wicara', 'trw', 0),
	(18, 'Akupunktur Terapis', 'aku', 0),
	(19, 'Perekam Medis dan Informasi Kesehatan', 'rm', 0),
	(20, 'Teknik Kardiovaskuler', 'kar', 0),
	(21, 'Refraksionis Optisien/Optometris', 'ref', 0),
	(22, 'Teknisi Gigi', 'tkg', 0),
	(23, 'Penata Anestesi', 'ane', 0),
	(24, 'Terapis Gigi dan Mulut', 'tgm', 0),
	(25, 'Radiografer', 'rad', 0),
	(26, 'Elektromedis', 'elt', 0),
	(27, 'Ahli Teknologi Laboratorium Medik', 'lab', 0),
	(28, 'Ortotik Prostetik', 'ort', 0),
	(29, 'Tenaga Kesehata Tradisional', 'bat', 0),
	(30, 'Tenaga Kesehata Tradisional Jamu', 'baj', 0),
	(31, 'Tenaga Kesehata Tradisional Interkontinental', 'bai', 0),
	(32, 'Penyehat Tradisional', 'tra', 0);
/*!40000 ALTER TABLE `mprofesi` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `mspesialisasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idprofesi` int(10) unsigned NOT NULL DEFAULT 0,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

DELETE FROM `mspesialisasi`;
/*!40000 ALTER TABLE `mspesialisasi` DISABLE KEYS */;
INSERT INTO `mspesialisasi` (`id`, `idprofesi`, `nama`) VALUES
	(1, 3, 'Dokter Spesialis Dermatologi dan Venereologi'),
	(2, 3, 'Dokter Spesialis Radiologi'),
	(3, 3, 'Dokter Spesialis Jantung dan Pembuluh Darah'),
	(4, 3, 'Dokter Spesialis Penyakit Dalam'),
	(5, 3, 'Dokter Spesialis Mata'),
	(6, 3, 'Dokter Spesialis Neurologi'),
	(7, 3, 'Dokter Spesialis Patologi Klinik'),
	(8, 3, 'Dokter Spesialis Obstetri dan Ginekologi'),
	(9, 3, 'Dokter Spesialis Akupunktur'),
	(10, 3, 'Dokter Spesialis Telinga Hidung Tenggorok - Bedah '),
	(11, 3, 'Dokter Spesialis Mikrobiologi Klinik'),
	(12, 3, 'Dokter Spesialis Paru'),
	(13, 3, 'Dokter Spesialis Kedokteran Fisik dan Rehabilitasi'),
	(14, 3, 'Dokter Spesialis Anestesiologi'),
	(15, 3, 'Dokter Spesialis Anak'),
	(16, 3, 'Dokter Spesialis Orthopaedi dan Traumatologi'),
	(17, 3, 'Dokter Spesialis Bedah'),
	(18, 3, 'Dokter Spesialis Bedah Plastik'),
	(19, 3, 'Dokter Spesialis Urologi'),
	(20, 3, 'Dokter Spesialis Kedokteran Jiwa'),
	(21, 3, 'Dokter Spesialis Patologi Anatomi'),
	(22, 3, 'Dokter Spesialis Bedah Saraf'),
	(23, 3, 'Dokter Spesialis Farmakologi Klinik'),
	(24, 3, 'Dokter Spesialis Bedah Toraks Kardiovaskuler'),
	(25, 3, 'Dokter Spesialis Onkologi Radiasi'),
	(26, 3, 'Dokter Spesialis Forensik'),
	(27, 3, 'Dokter Spesialis Andrologi'),
	(28, 3, 'Dokter Spesialis Emergensi Medisine'),
	(29, 3, 'Dokter Spesialis Gizi Klinik'),
	(30, 3, 'Dokter Spesialis Kedokteran Kelautan'),
	(31, 3, 'Dokter Spesialis Keluarga Layanan Primer'),
	(32, 3, 'Dokter Spesialis Kedokteran Nuklir dan Teranostik '),
	(33, 3, 'Dokter Spesialis Kedokteran Okupasi'),
	(34, 3, 'Dokter Spesialis Kedokteran Olahraga'),
	(35, 3, 'Dokter Spesialis Kedokteran Penerbangan'),
	(36, 3, 'Dokter Spesialis Parasitologi Klinik'),
	(37, 4, 'Dokter Gigi Spesialis Bedah Mulut'),
	(38, 4, 'Dokter Gigi Spesialis Prostodonsia'),
	(39, 4, 'Dokter Gigi Spesialis Konservasi Gigi'),
	(40, 4, 'Dokter Gigi Spesialis Penyakit Mulut'),
	(41, 4, 'Dokter Gigi Spesialis Ortodonsia'),
	(42, 4, 'Dokter Gigi Spesialis Odontologi Forensik'),
	(43, 4, 'Dokter Gigi Spesialis Radiologi Kedokteran Gigi'),
	(44, 4, 'Dokter Gigi Spesialis Kedokteran Gigi Anak'),
	(45, 4, 'Dokter Gigi Spesialis Periodonsia');
/*!40000 ALTER TABLE `mspesialisasi` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `muser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `isactive` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `doc` timestamp NULL DEFAULT current_timestamp(),
  `dom` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `api_token` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

DELETE FROM `muser`;
/*!40000 ALTER TABLE `muser` DISABLE KEYS */;
INSERT INTO `muser` (`id`, `nama`, `username`, `password`, `token`, `isactive`, `doc`, `dom`, `api_token`) VALUES
	(1, 'Admin', 'admin', '$2y$10$9PAUT0fuC8XiNpHo0fZ0f.DcZQtxqHAk8UU5gWedHIbmufu0sR2fS', NULL, 1, '2022-04-28 11:42:21', '2022-04-28 14:10:32', NULL);
/*!40000 ALTER TABLE `muser` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `sip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance` tinyint(1) unsigned NOT NULL COMMENT 'tempat praktik ke-',
  `iterator` smallint(2) unsigned NOT NULL DEFAULT 0 COMMENT 'sip yang ke-',
  `idstr` int(10) unsigned NOT NULL,
  `idpegawai` int(10) unsigned NOT NULL,
  `nomorregis` int(4) unsigned zerofill NOT NULL,
  `idprofesi` int(10) unsigned NOT NULL,
  `idspesialisasi` int(10) unsigned DEFAULT NULL,
  `nomorstr` varchar(50) NOT NULL,
  `expirystr` date NOT NULL COMMENT 'tanggal expired str',
  `nomorrekom` varchar(60) DEFAULT NULL,
  `nomoronline` varchar(60) DEFAULT NULL,
  `nomor` varchar(70) NOT NULL,
  `idc` int(10) unsigned NOT NULL,
  `doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `idm` int(10) unsigned NOT NULL,
  `dom` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idfaskes` int(10) unsigned DEFAULT NULL,
  `saranapraktik` varchar(100) DEFAULT NULL COMMENT 'RS/PKM/Klinik/Praktik Swasta Perorangan',
  `namafaskes` varchar(50) DEFAULT NULL,
  `alamatfaskes` varchar(150) DEFAULT NULL,
  `jadwalpraktik` varchar(100) DEFAULT NULL,
  `jenispermohonan` varchar(30) DEFAULT NULL COMMENT 'baru/perpanjangan/cabut/cabutpindah',
  `idjenispermohonan` int(10) unsigned DEFAULT NULL,
  `jabatan` varchar(30) DEFAULT NULL COMMENT 'PJ / Pelaksana',
  `tglonline` date DEFAULT NULL,
  `tglmasukdinas` date DEFAULT NULL,
  `tglverif` date DEFAULT NULL,
  `tgldeactive` date DEFAULT NULL,
  `isactive` tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_faskes` (`idfaskes`),
  KEY `jenispermohonan` (`jenispermohonan`),
  KEY `FK_STR` (`idstr`),
  KEY `FK_sip_mpegawai` (`idpegawai`,`nomorregis`,`idprofesi`,`idspesialisasi`),
  KEY `FK_sip_mjenispermohonan` (`idjenispermohonan`),
  CONSTRAINT `FK_STR` FOREIGN KEY (`idstr`) REFERENCES `str` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_sip_mjenispermohonan` FOREIGN KEY (`idjenispermohonan`) REFERENCES `mjenispermohonan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_sip_mpegawai` FOREIGN KEY (`idpegawai`, `nomorregis`, `idprofesi`, `idspesialisasi`) REFERENCES `mpegawai` (`id`, `nomorregis`, `idprofesi`, `idspesialisasi`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_faskes` FOREIGN KEY (`idfaskes`) REFERENCES `mfaskes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

DELETE FROM `sip`;
/*!40000 ALTER TABLE `sip` DISABLE KEYS */;
INSERT INTO `sip` (`id`, `instance`, `iterator`, `idstr`, `idpegawai`, `nomorregis`, `idprofesi`, `idspesialisasi`, `nomorstr`, `expirystr`, `nomorrekom`, `nomoronline`, `nomor`, `idc`, `doc`, `idm`, `dom`, `idfaskes`, `saranapraktik`, `namafaskes`, `alamatfaskes`, `jadwalpraktik`, `jenispermohonan`, `idjenispermohonan`, `jabatan`, `tglonline`, `tglmasukdinas`, `tglverif`, `tgldeactive`, `isactive`) VALUES
	(7, 1, 1, 4, 14, 0003, 1, NULL, '32 1 1 100 3 19 095497', '2022-06-18', '10 29  31 2 9310', '89 / I / 23 / 19 / 06 / 2022', '503.446 / 0001 / 0003 / I / IP.DU / 436.7.2 / 2022', 1, '2022-06-19 14:42:29', 1, '2022-06-22 09:44:55', 67, 'PUSKESMAS', 'PUSKESMAS Dr. SOETOMO', 'Jl. Pandegiling No. 223 A Surabaya', 'SENIN-JUMAT 08.00-12.00\r\nSABTU 15.00-17.00', 'baru', NULL, 'Direktur Perjajanan', '2022-06-19', '2022-06-19', '2022-06-19', '2022-06-19', 0),
	(8, 1, 2, 4, 11, 0003, 1, NULL, '32 1 1 100 3 19 095497', '2022-06-18', NULL, '90 / I / 23 / 19 / 06 / 2022', '503.347 / 0001 / 0003 / I / IP.DU / 436.7.2 / 2022', 1, '2022-06-19 14:53:43', 1, '2022-06-22 09:44:59', 59, 'PUSKESMAS', 'PUSKESMAS ASEMROWO', 'Jl. Asemraya No. 8 Surabaya', NULL, 'cabutpindah', NULL, NULL, '2022-06-19', '2022-06-19', '2022-06-19', NULL, 1),
	(10, 2, 1, 4, 14, 0003, 1, NULL, '32 1 1 100 3 19 095497', '2022-06-18', NULL, '89 / II / 2 / 19 / 06 / 2022', '503.446 / 0001 / 0003 / II / IP.DU / 436.7.2 / 2022', 1, '2022-06-19 14:56:29', 1, '2022-06-22 09:45:01', 60, 'PUSKESMAS', 'PUSKESMAS BALAS KLUMPRIK', 'Jl. Raya Balas Klumprik Surabaya', NULL, 'baru', NULL, NULL, '2022-06-19', '2022-06-19', '2022-06-19', NULL, 1),
	(16, 1, 1, 6, 11, 0001, 1, NULL, '123456789', '2022-06-30', NULL, NULL, '503.446 / 0001 / 0001 / I / IP.DU / 436.7.2 / 2022', 1, '2022-06-22 08:04:42', 1, '2022-06-22 08:09:47', 59, 'PUSKESMAS', 'PUSKESMAS ASEMROWO', 'Jl. Asemraya No. 8 Surabaya', NULL, 'baru', NULL, NULL, '2022-06-22', '2022-06-22', '2022-06-22', NULL, 1),
	(17, 2, 1, 6, 11, 0001, 1, NULL, '123456789', '2022-06-30', NULL, '90 / I / 23 / 19 / 06 / 2022', '503.447 / 12 / 0001 / II / IP.DU / 436.7.2 / 2022', 1, '2022-06-22 08:13:47', 1, '2022-06-22 08:56:57', 69, 'PUSKESMAS', 'PUSKESMAS DUPAK', 'Jl. Dupak Bangunrejo Gg. Poli No. 6 Surabaya', NULL, 'baru', NULL, NULL, '2022-06-22', '2022-06-22', '2022-06-22', NULL, 1);
/*!40000 ALTER TABLE `sip` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `str` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpegawai` int(10) unsigned NOT NULL,
  `nomorregis` int(4) unsigned zerofill NOT NULL,
  `idprofesi` int(10) unsigned NOT NULL,
  `idspesialisasi` int(10) unsigned DEFAULT NULL,
  `nomor` varchar(22) NOT NULL,
  `since` date NOT NULL COMMENT 'tanggal awal berlaku str',
  `expiry` date NOT NULL COMMENT 'tanggal expired str',
  `tanggal` date DEFAULT NULL COMMENT 'tanggal penetapan',
  `idc` int(10) unsigned NOT NULL,
  `doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `idm` int(10) unsigned NOT NULL,
  `dom` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isactive` tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_str_mpegawai` (`idpegawai`,`nomorregis`,`idprofesi`,`idspesialisasi`),
  CONSTRAINT `FK_str_mpegawai` FOREIGN KEY (`idpegawai`, `nomorregis`, `idprofesi`, `idspesialisasi`) REFERENCES `mpegawai` (`id`, `nomorregis`, `idprofesi`, `idspesialisasi`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

DELETE FROM `str`;
/*!40000 ALTER TABLE `str` DISABLE KEYS */;
INSERT INTO `str` (`id`, `idpegawai`, `nomorregis`, `idprofesi`, `idspesialisasi`, `nomor`, `since`, `expiry`, `tanggal`, `idc`, `doc`, `idm`, `dom`, `isactive`) VALUES
	(2, 1, 0000, 1, 0, '9843', '2022-06-06', '2022-06-30', '2022-06-06', 1, '2022-06-06 15:55:45', 1, '2022-06-22 07:44:02', 1),
	(3, 2, 0000, 1, 0, '35 2 1 100 2 17 118633', '2022-06-18', '2022-06-09', '2022-06-02', 1, '2022-06-12 16:39:27', 1, '2022-06-15 15:58:28', 1),
	(4, 14, 0003, 1, NULL, '32 1 1 100 3 19 095497', '2022-01-02', '2022-06-18', '2022-01-07', 1, '2022-06-18 13:13:57', 1, '2022-06-18 14:33:43', 1),
	(6, 11, 0001, 1, NULL, '123456789', '2022-06-21', '2022-06-30', NULL, 1, '2022-06-22 07:56:47', 1, '2022-06-22 07:56:47', 1);
/*!40000 ALTER TABLE `str` ENABLE KEYS */;

CREATE TABLE `vw_agregatnakesbyprofesi` (
	`idprofesi` INT(10) UNSIGNED NOT NULL,
	`total` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

CREATE TABLE `vw_agregatnakesbystatussip` (
	`status` INT(2) NOT NULL,
	`jenis` VARCHAR(12) NOT NULL COLLATE 'utf8mb4_general_ci',
	`total` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `mpegawai_after_update` AFTER UPDATE ON `mpegawai` FOR EACH ROW BEGIN
  	 IF (OLD.nomorregis <> NEW.nomorregis 
			OR OLD.idprofesi <> NEW.idprofesi 
			OR OLD.idspesialisasi <> NEW.idspesialisasi ) THEN
    	
		 UPDATE str SET nomorregis=NEW.nomorregis, idprofesi=NEW.idprofesi, idspesialisasi=NEW.idspesialisasi 
		 	WHERE idpegawai=NEW.id;
		
		UPDATE sip SET nomorregis=NEW.nomorregis, idprofesi=NEW.idprofesi, idspesialisasi=NEW.idspesialisasi 
		 	WHERE idpegawai=NEW.id;
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `mpegawai_before_insert` BEFORE INSERT ON `mpegawai` FOR EACH ROW BEGIN
	DECLARE max_nomorregis integer;
	
	IF ( NEW.nomorregis IS NULL) THEN
	   SET @max_nomorregis := (SELECT coalesce(MAX(nomorregis)+1 , 1) FROM mpegawai WHERE idprofesi = NEW.idprofesi);
	   SET NEW.nomorregis = @max_nomorregis;
   END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `sync_from_faskes` AFTER UPDATE ON `mfaskes` FOR EACH ROW BEGIN
  	 IF OLD.alamat <> new.alamat OR OLD.nama <> new.nama THEN
    	UPDATE sip SET namafaskes=NEW.nama, alamatfaskes=NEW.alamat WHERE idfaskes=new.id;
    END IF;
    IF OLD.idkategori <> new.idkategori THEN
    	UPDATE sip SET saranapraktik='' WHERE idfaskes=new.id;
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `sync_from_profesi` AFTER UPDATE ON `mprofesi` FOR EACH ROW BEGIN
  	 IF OLD.nama <> new.nama THEN
    	UPDATE mpegawai SET profesi=NEW.nama WHERE idprofesi=new.id;
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `sync_from_spesialisasi` AFTER UPDATE ON `mspesialisasi` FOR EACH ROW BEGIN
  	 IF OLD.nama <> new.nama THEN
    	UPDATE mpegawai SET spesialisasi=NEW.nama WHERE idspesialisasi=new.id;
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `sync_from_str` AFTER UPDATE ON `str` FOR EACH ROW BEGIN
  	 IF OLD.nomor <> new.nomor OR OLD.expiry <> new.expiry THEN
    	UPDATE sip SET nomorstr=NEW.nomor, expirystr=NEW.expiry WHERE idstr=new.id;
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

DROP TABLE IF EXISTS `vw_agregatnakesbyprofesi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_agregatnakesbyprofesi` AS SELECT p.id AS idprofesi, COUNT(f.id) AS total
	FROM mprofesi p
	LEFT JOIN mpegawai f ON f.idprofesi = p.id
	GROUP BY (p.id); ;

DROP TABLE IF EXISTS `vw_agregatnakesbystatussip`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_agregatnakesbystatussip` AS SELECT tt.*, COUNT(validstatus) AS total
FROM
(
	 SELECT -2 AS status, 'no sip' AS jenis
    UNION SELECT -1, 'expired'
    UNION SELECT 0, 'expired soon'
    UNION SELECT 1, 'valid'
) AS tt
LEFT JOIN
(
SELECT *, IF(expirydiff IS NULL, -2, IF(expirydiff<0, -1, IF(expirydiff<60, 0, 1)) )  as validstatus
 FROM (
SELECT DATEDIFF(sip.expirystr, current_date) as expirydiff
FROM `mpegawai` 
 LEFT JOIN `str` on `str`.`idpegawai` = `mpegawai`.`id`  AND `str`.`isactive` = 1 
 LEFT JOIN `sip` on `sip`.`idstr` = `str`.`id` AND 
 	sip.id = ( SELECT MAX(id) as maxid  FROM `sip` WHERE `isactive` = 1 and `idpegawai` = `mpegawai`.`id` )
) AS aa) AS nn ON tt.status = nn.validstatus
GROUP BY tt.status; ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
