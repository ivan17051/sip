/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `dbsip2` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dbsip2`;

CREATE TABLE IF NOT EXISTS `berkassip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idsip` int(11) NOT NULL,
  `url` varchar(500) NOT NULL DEFAULT '',
  `keterangan` varchar(100) DEFAULT NULL,
  `doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `dom` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `debug` (
  `proc_id` varchar(100) DEFAULT NULL,
  `debug_output` text DEFAULT NULL,
  `line_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`line_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE IF NOT EXISTS `mjenispermohonan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idprofesi` int(10) unsigned NOT NULL,
  `nama` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_mjenispermohonan_mprofesi` (`idprofesi`),
  CONSTRAINT `FK_mjenispermohonan_mprofesi` FOREIGN KEY (`idprofesi`) REFERENCES `mprofesi` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `mkategori` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE IF NOT EXISTS `mprofesi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `kode` varchar(10) NOT NULL DEFAULT '',
  `isparent` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `mspesialisasi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idprofesi` int(10) unsigned NOT NULL DEFAULT 0,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;

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
  `nomor` varchar(50) NOT NULL,
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
  CONSTRAINT `FK_STR` FOREIGN KEY (`idstr`) REFERENCES `str` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_sip_mpegawai` FOREIGN KEY (`idpegawai`, `nomorregis`, `idprofesi`, `idspesialisasi`) REFERENCES `mpegawai` (`id`, `nomorregis`, `idprofesi`, `idspesialisasi`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_faskes` FOREIGN KEY (`idfaskes`) REFERENCES `mfaskes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `str` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idpegawai` int(10) unsigned NOT NULL,
  `nomorregis` int(4) unsigned zerofill NOT NULL,
  `idprofesi` int(10) unsigned NOT NULL,
  `idspesialisasi` int(10) unsigned DEFAULT NULL,
  `nomor` varchar(22) NOT NULL,
  `since` date NOT NULL COMMENT 'tanggal awal berlaku str',
  `expiry` date NOT NULL COMMENT 'tanggal expired str',
  `tanggal` date NOT NULL COMMENT 'tanggal penetapan',
  `idc` int(10) unsigned NOT NULL,
  `doc` timestamp NOT NULL DEFAULT current_timestamp(),
  `idm` int(10) unsigned NOT NULL,
  `dom` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isactive` tinyint(1) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_str_mpegawai` (`idpegawai`,`nomorregis`,`idprofesi`,`idspesialisasi`),
  CONSTRAINT `FK_str_mpegawai` FOREIGN KEY (`idpegawai`, `nomorregis`, `idprofesi`, `idspesialisasi`) REFERENCES `mpegawai` (`id`, `nomorregis`, `idprofesi`, `idspesialisasi`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

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

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
