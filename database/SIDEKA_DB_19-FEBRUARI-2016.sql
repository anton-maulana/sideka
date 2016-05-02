/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.7.9-log : Database - sideka2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sideka2` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `sideka8`;

/*Table structure for table `ref_agama` */

DROP TABLE IF EXISTS `ref_agama`;

CREATE TABLE `ref_agama` (
  `id_agama` int(5) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  `is_diakui` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_agama`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `ref_agama` */

insert  into `ref_agama`(`id_agama`,`deskripsi`,`is_diakui`) values (0,'Tidak Diketahui','Y'),(1,'Islam','Y'),(2,'Kristen','Y'),(3,'Katholik','Y'),(4,'Hindu','Y'),(5,'Budha','Y'),(6,'Konghucu','Y'),(7,'Aliran Kepercayaan Kepada Tuhan YME','N'),(8,'Aliran Kepercayaan Lainnya','N');

/*Table structure for table `ref_alasan_pindah` */

DROP TABLE IF EXISTS `ref_alasan_pindah`;

CREATE TABLE `ref_alasan_pindah` (
  `id_alasan_pindah` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_alasan_pindah`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `ref_alasan_pindah` */

insert  into `ref_alasan_pindah`(`id_alasan_pindah`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Tidak Diketahui');

/*Table structure for table `ref_asal_aset` */

DROP TABLE IF EXISTS `ref_asal_aset`;

CREATE TABLE `ref_asal_aset` (
  `id_asal_aset` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(30) NOT NULL,
  PRIMARY KEY (`id_asal_aset`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ref_asal_aset` */

insert  into `ref_asal_aset`(`id_asal_aset`,`deskripsi`) values (1,'Pembelian'),(2,'Hibah / Wakaf');

/*Table structure for table `ref_desa` */

DROP TABLE IF EXISTS `ref_desa`;

CREATE TABLE `ref_desa` (
  `id_desa` int(10) NOT NULL AUTO_INCREMENT,
  `kode_desa_bps` char(20) NOT NULL,
  `kode_desa_kemendagri` char(20) NOT NULL,
  `nama_desa` varchar(50) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_kecamatan` int(10) NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  `alamat_desa` text,
  `kode_pos` char(6) NOT NULL,
  PRIMARY KEY (`id_desa`),
  KEY `id_kecamatan` (`id_kecamatan`),
  KEY `id_penduduk` (`id_penduduk`),
  CONSTRAINT `ref_desa_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `ref_kecamatan` (`id_kecamatan`),
  CONSTRAINT `ref_desa_ibfk_2` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ref_desa` */

insert  into `ref_desa`(`id_desa`,`kode_desa_bps`,`kode_desa_kemendagri`,`nama_desa`,`luas_wilayah`,`id_kecamatan`,`id_penduduk`,`alamat_desa`,`kode_pos`) values (0,'0','0','Tidak Diketahui',0,0,NULL,'0','0'),(1,'34.03.03.31','34.03.03.31','Ngawun',97.5,1,NULL,'Jl. Merdeka No 45','97'),(2,'02.38.01.01','02.38.01.01','Kiarajangkung',0,2,NULL,'l Jl Merdeka','0');

/*Table structure for table `ref_difabilitas` */

DROP TABLE IF EXISTS `ref_difabilitas`;

CREATE TABLE `ref_difabilitas` (
  `id_difabilitas` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_difabilitas`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `ref_difabilitas` */

insert  into `ref_difabilitas`(`id_difabilitas`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Tidak Cacat'),(2,'Cacat Fisik'),(3,'Cacat Netra / Buta'),(4,'Cacat Rungu / Wicara'),(5,'Cacat Mental / Jiwa'),(6,'Cacat Lainnya');

/*Table structure for table `ref_dusun` */

DROP TABLE IF EXISTS `ref_dusun`;

CREATE TABLE `ref_dusun` (
  `id_dusun` int(10) NOT NULL AUTO_INCREMENT,
  `kode_dusun_bps` char(20) NOT NULL,
  `kode_dusun_kemendagri` char(20) NOT NULL,
  `nama_dusun` varchar(50) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_desa` int(10) NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_dusun`),
  KEY `id_desa` (`id_desa`),
  KEY `id_penduduk` (`id_penduduk`),
  CONSTRAINT `ref_dusun_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `ref_desa` (`id_desa`),
  CONSTRAINT `ref_dusun_ibfk_2` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `ref_dusun` */

insert  into `ref_dusun`(`id_dusun`,`kode_dusun_bps`,`kode_dusun_kemendagri`,`nama_dusun`,`luas_wilayah`,`id_desa`,`id_penduduk`) values (0,'0','0','Tidak Diketahui',0,0,NULL),(1,'121','121','Sumberjo',5000,1,NULL);

/*Table structure for table `ref_goldar` */

DROP TABLE IF EXISTS `ref_goldar`;

CREATE TABLE `ref_goldar` (
  `id_goldar` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(75) NOT NULL,
  PRIMARY KEY (`id_goldar`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `ref_goldar` */

insert  into `ref_goldar`(`id_goldar`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'A'),(2,'A+'),(3,'A-'),(4,'B'),(5,'B+'),(6,'B-'),(7,'AB'),(8,'AB+'),(9,'AB-'),(10,'O'),(11,'O+'),(12,'O-');

/*Table structure for table `ref_jabatan` */

DROP TABLE IF EXISTS `ref_jabatan`;

CREATE TABLE `ref_jabatan` (
  `id_jabatan` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `ref_jabatan` */

insert  into `ref_jabatan`(`id_jabatan`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Kepala Desa'),(3,'Sekretaris Desa'),(5,'Bendahara Desa'),(6,'Kaur Kesejahteraan Rakyat'),(7,'Kaur Pemerintahan');

/*Table structure for table `ref_jen_kel` */

DROP TABLE IF EXISTS `ref_jen_kel`;

CREATE TABLE `ref_jen_kel` (
  `id_jen_kel` int(2) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(20) NOT NULL,
  PRIMARY KEY (`id_jen_kel`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ref_jen_kel` */

insert  into `ref_jen_kel`(`id_jen_kel`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Laki - laki'),(2,'Perempuan');

/*Table structure for table `ref_jenis_pindah` */

DROP TABLE IF EXISTS `ref_jenis_pindah`;

CREATE TABLE `ref_jenis_pindah` (
  `id_jenis_pindah` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_jenis_pindah`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `ref_jenis_pindah` */

insert  into `ref_jenis_pindah`(`id_jenis_pindah`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Tidak Diketahui');

/*Table structure for table `ref_kab_kota` */

DROP TABLE IF EXISTS `ref_kab_kota`;

CREATE TABLE `ref_kab_kota` (
  `id_kab_kota` int(10) NOT NULL AUTO_INCREMENT,
  `kode_kab_kota_bps` char(10) NOT NULL,
  `kode_kab_kota_kemendagri` char(10) NOT NULL,
  `nama_kab_kota` varchar(50) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_provinsi` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_kab_kota`),
  KEY `id_provinsi` (`id_provinsi`),
  CONSTRAINT `ref_kab_kota_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `ref_provinsi` (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ref_kab_kota` */

insert  into `ref_kab_kota`(`id_kab_kota`,`kode_kab_kota_bps`,`kode_kab_kota_kemendagri`,`nama_kab_kota`,`luas_wilayah`,`id_provinsi`) values (0,'0','0','Tidak Diketahui',0,0),(1,'34.03','34.03','Gunungkidul',1485.36,1),(2,'02.38','02.38','Kab. Tasikmalaya',9345,2);

/*Table structure for table `ref_kategori_aset` */

DROP TABLE IF EXISTS `ref_kategori_aset`;

CREATE TABLE `ref_kategori_aset` (
  `id_kategori_aset` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kategori_aset`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `ref_kategori_aset` */

insert  into `ref_kategori_aset`(`id_kategori_aset`,`deskripsi`) values (1,'Peralatan Pendukung'),(2,'Furniture'),(3,'Operasional Kantor'),(4,'Peralatan Pendukung Kegiatan'),(5,'Alat Transportasi'),(6,'Alat Komunikasi'),(7,'Peralatan Lain');

/*Table structure for table `ref_kecamatan` */

DROP TABLE IF EXISTS `ref_kecamatan`;

CREATE TABLE `ref_kecamatan` (
  `id_kecamatan` int(10) NOT NULL AUTO_INCREMENT,
  `kode_kecamatan_bps` char(10) NOT NULL,
  `kode_kecamatan_kemendagri` char(10) NOT NULL,
  `nama_kecamatan` varchar(50) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_kab_kota` int(10) NOT NULL,
  PRIMARY KEY (`id_kecamatan`),
  KEY `id_kab_kota` (`id_kab_kota`),
  CONSTRAINT `ref_kecamatan_ibfk_1` FOREIGN KEY (`id_kab_kota`) REFERENCES `ref_kab_kota` (`id_kab_kota`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ref_kecamatan` */

insert  into `ref_kecamatan`(`id_kecamatan`,`kode_kecamatan_bps`,`kode_kecamatan_kemendagri`,`nama_kecamatan`,`luas_wilayah`,`id_kab_kota`) values (0,'0','0','Tidak Diketahui',0,0),(1,'34.03.03','34.03.03','Plajen',0,1),(2,'02.38.01','02.38.01','Sukahening',0,2);

/*Table structure for table `ref_kelas_sosial` */

DROP TABLE IF EXISTS `ref_kelas_sosial`;

CREATE TABLE `ref_kelas_sosial` (
  `id_kelas_sosial` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kelas_sosial`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ref_kelas_sosial` */

insert  into `ref_kelas_sosial`(`id_kelas_sosial`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Kaya'),(2,'Sedang'),(3,'Miskin'),(4,'Sangat Miskin');

/*Table structure for table `ref_kepemilikan_aset` */

DROP TABLE IF EXISTS `ref_kepemilikan_aset`;

CREATE TABLE `ref_kepemilikan_aset` (
  `id_kepemilikan_aset` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kepemilikan_aset`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `ref_kepemilikan_aset` */

insert  into `ref_kepemilikan_aset`(`id_kepemilikan_aset`,`deskripsi`) values (1,'Milik Sendiri'),(2,'Sewa'),(3,'Sedang Sengketa');

/*Table structure for table `ref_kewarganegaraan` */

DROP TABLE IF EXISTS `ref_kewarganegaraan`;

CREATE TABLE `ref_kewarganegaraan` (
  `id_kewarganegaraan` int(15) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kewarganegaraan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `ref_kewarganegaraan` */

insert  into `ref_kewarganegaraan`(`id_kewarganegaraan`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'WNI'),(2,'WNA'),(3,'DWIKEWARGANEGARAAN');

/*Table structure for table `ref_klasifikasi_pindah` */

DROP TABLE IF EXISTS `ref_klasifikasi_pindah`;

CREATE TABLE `ref_klasifikasi_pindah` (
  `id_klasifikasi_pindah` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_klasifikasi_pindah`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `ref_klasifikasi_pindah` */

insert  into `ref_klasifikasi_pindah`(`id_klasifikasi_pindah`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Tidak Diketahui');

/*Table structure for table `ref_kode_surat` */

DROP TABLE IF EXISTS `ref_kode_surat`;

CREATE TABLE `ref_kode_surat` (
  `kode_surat` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  `supra_kode` varchar(10) NOT NULL,
  PRIMARY KEY (`kode_surat`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `ref_kode_surat` */

insert  into `ref_kode_surat`(`kode_surat`,`deskripsi`,`supra_kode`) values (1,'Umum','0'),(2,'Pemerintah','100'),(3,'Politik','200'),(4,'Keamanan / Ketertiban','300'),(5,'Kesejahteraan Rakyat','400'),(6,'Perekonomian','500'),(7,'Pekerjaan Umum dan Ketenagakerjaan','600'),(8,'Pengawasan','700'),(9,'Kepegawaian','800'),(10,'Keuangan','900'),(11,'Kelahiran','1000'),(13,'Kematian','1100');

/*Table structure for table `ref_kompetensi` */

DROP TABLE IF EXISTS `ref_kompetensi`;

CREATE TABLE `ref_kompetensi` (
  `id_kompetensi` int(5) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kompetensi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ref_kompetensi` */

insert  into `ref_kompetensi`(`id_kompetensi`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Kesehatan'),(2,'Profesional Bangunan'),(3,'Profesional Kelistrikan'),(4,'Profesional Pendidikan');

/*Table structure for table `ref_kontrasepsi` */

DROP TABLE IF EXISTS `ref_kontrasepsi`;

CREATE TABLE `ref_kontrasepsi` (
  `id_kontrasepsi` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kontrasepsi`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `ref_kontrasepsi` */

insert  into `ref_kontrasepsi`(`id_kontrasepsi`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Pil'),(2,'Suntik'),(3,'IUD'),(4,'Kondom'),(5,'Implant'),(6,'MOP'),(7,'MOW');

/*Table structure for table `ref_pangkat_gol` */

DROP TABLE IF EXISTS `ref_pangkat_gol`;

CREATE TABLE `ref_pangkat_gol` (
  `id_pangkat_gol` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(10) NOT NULL,
  PRIMARY KEY (`id_pangkat_gol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ref_pangkat_gol` */

insert  into `ref_pangkat_gol`(`id_pangkat_gol`,`deskripsi`) values (0,'-'),(1,'3A'),(2,'3B');

/*Table structure for table `ref_ped_kategori` */

DROP TABLE IF EXISTS `ref_ped_kategori`;

CREATE TABLE `ref_ped_kategori` (
  `id_ped_kategori` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_ped_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ref_ped_kategori` */

insert  into `ref_ped_kategori`(`id_ped_kategori`,`deskripsi`) values (1,'Pertanian'),(2,'Pertambangan'),(3,'Perkebunan'),(4,'Pembangkit Listrik'),(5,'Pariwisata');

/*Table structure for table `ref_ped_sub` */

DROP TABLE IF EXISTS `ref_ped_sub`;

CREATE TABLE `ref_ped_sub` (
  `id_ped_sub` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  `monetize` float NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `id_ped_kategori` int(3) NOT NULL,
  `warna_peta` varchar(7) NOT NULL DEFAULT '#FADA23',
  PRIMARY KEY (`id_ped_sub`),
  KEY `id_ped_kategori` (`id_ped_kategori`),
  CONSTRAINT `ref_ped_sub_ibfk_1` FOREIGN KEY (`id_ped_kategori`) REFERENCES `ref_ped_kategori` (`id_ped_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ref_ped_sub` */

/*Table structure for table `ref_pekerjaan` */

DROP TABLE IF EXISTS `ref_pekerjaan`;

CREATE TABLE `ref_pekerjaan` (
  `id_pekerjaan` int(15) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(75) NOT NULL,
  `deskripsi_singkat` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_pekerjaan`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

/*Data for the table `ref_pekerjaan` */

insert  into `ref_pekerjaan`(`id_pekerjaan`,`deskripsi`,`deskripsi_singkat`) values (0,'Tidak Diketahui',NULL),(1,'BELUM/TIDAK BEKERJA',''),(2,'MENGURUS RUMAH TANGGA',''),(3,'PELAJAR/MAHASISWA',''),(4,'PENSIUNAN',''),(5,'PEGAWAI NEGERI SIPIL (PNS)',''),(6,'TENTARA NASIONAL INDONESIA (TNI)',''),(7,'KEPOLISIAN RI ',''),(8,'PERDAGANGAN',''),(9,'PETANI/PEKEBUN',''),(10,'PETERNAK',''),(11,'NELAYAN/PERIKANAN',''),(12,'INDUSTRI',''),(13,'KONSTRUKSI',''),(14,'TRANSPORTASI',''),(15,'KARYAWAN SWASTA',''),(16,'KARYAWAN BUMN',''),(17,'KARYAWAN HONORER',''),(18,'BURUH HARIAN LEPAS',''),(19,'BURUH TANI/PERKEBUNAN',''),(20,'BURUH NELAYAN/PERIKANAN',''),(21,'BURUH PETERNAKAN',''),(22,'PEMBANTU RUMAH TANGGA',''),(23,'TUKANG CUKUR',''),(24,'TUKANG BATU',''),(25,'TUKANG LISTRIK',''),(26,'TUKANG KAYU',''),(27,'TUKANG SOL SEPATU',''),(28,'TUKANG LAS/PANDAI BESI',''),(29,'TUKANG JAIT',''),(30,'TUKANG GIGI',''),(31,'PENATA RIAS',''),(32,'PENATA BUSANA',''),(33,'PENATA RAMBUT',''),(34,'MEKANIK',''),(35,'SENIMAN',''),(36,'TABIB',''),(37,'PARAJI',''),(38,'PERANCANG BUSANA',''),(39,'PENTERJEMAH',''),(40,'IMAM MASJID',''),(41,'PENDETA',''),(42,'PASTOR',''),(43,'WARTAWAN',''),(44,'USTADZ/MUBALIGH',''),(45,'JURU MASAK',''),(46,'PROMOTOR ACARA',''),(47,'ANGGOTA DPR RI',''),(48,'ANGGOTA DPD',''),(49,'ANGGOTA BPK',''),(50,'PRESIDEN',''),(51,'WAKIL PRESIDEN',''),(52,'ANGGOTA MAHKAMAH KONSTITUSI',''),(53,'DUTA BESAR',''),(54,'GUBERNUR',''),(55,'WAKIL GUBERNUR',''),(56,'BUPATI',''),(57,'WAKIL BUPATI',''),(58,'WALIKOTA',''),(59,'WAKIL WALIKOTA',''),(60,'ANGGOTA DPRD PROP',''),(61,'ANGGOTA DPRD KAB. KOTA',''),(62,'DOSEN',''),(63,'GURU',''),(64,'PILOT',''),(65,'PENGACARA',''),(66,'NOTARIS',''),(67,'ARSITEK',''),(68,'AKUNTAN',''),(69,'KONSULTAN',''),(70,'DOKTER',''),(71,'BIDAN',''),(72,'PERAWAT',''),(73,'APOTEKER',''),(74,'PSIKIATER/PSIKOLOG',''),(75,'PENYIAR TELEVISI',''),(76,'PENYIAR RADIO',''),(77,'PELAUT',''),(78,'PENELITI',''),(79,'SOPIR',''),(80,'PIALANG',''),(81,'PARANORMAL',''),(82,'PEDAGANG',''),(83,'PERANGKAT DESA',''),(84,'KEPALA DESA',''),(85,'BIARAWATI',''),(86,'WIRASWASTA',''),(87,'BURUH MIGRAN','');

/*Table structure for table `ref_pekerjaan_ped` */

DROP TABLE IF EXISTS `ref_pekerjaan_ped`;

CREATE TABLE `ref_pekerjaan_ped` (
  `id_pekerjaan_ped` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(75) NOT NULL,
  PRIMARY KEY (`id_pekerjaan_ped`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `ref_pekerjaan_ped` */

insert  into `ref_pekerjaan_ped`(`id_pekerjaan_ped`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Tidak Diketahui'),(2,'Petani'),(3,'Pedagang'),(4,'Petani Kebun'),(5,'Tukang Batu / Jasa Lainnya'),(6,'Seniman');

/*Table structure for table `ref_pelapor` */

DROP TABLE IF EXISTS `ref_pelapor`;

CREATE TABLE `ref_pelapor` (
  `id_pelapor` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pelapor`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `ref_pelapor` */

insert  into `ref_pelapor`(`id_pelapor`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Ayah'),(2,'Ibu'),(3,'Kakak'),(4,'Adik'),(5,'Kakek'),(6,'Nenek'),(7,'Paman'),(8,'Tante'),(9,'Keponakan'),(10,'Sepupu'),(11,'Kerabat');

/*Table structure for table `ref_pendidikan` */

DROP TABLE IF EXISTS `ref_pendidikan`;

CREATE TABLE `ref_pendidikan` (
  `id_pendidikan` int(15) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(75) NOT NULL,
  `is_bsm` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_pendidikan`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `ref_pendidikan` */

insert  into `ref_pendidikan`(`id_pendidikan`,`deskripsi`,`is_bsm`) values (0,'Tidak Diketahui','N'),(1,'Tidak dapat membaca','N'),(2,'Tidak Pernah Sekolah','N'),(3,'Tidak Tamat SD/Sederajat','N'),(4,'Tamat SD/Sederajat','N'),(5,'Tamat SMP/Sederajat','N'),(6,'Tamat SMA/Sederajat','N'),(7,'Tamat D-3/Sederajat','N'),(8,'Tamat S-1/Sederajat','N'),(9,'Tamat S-2/Sederajat','N'),(10,'Tamat S-3/Sederajat','N'),(11,'Belum Masuk TK/PAUD ','N'),(12,'Sedang TK/PAUD','N'),(13,'Sedang SD/Sederajat','Y'),(14,'Sedang SMP/Sederajat','Y'),(15,'Sedang SMA/Sederajat','Y'),(16,'Sedang D-3/Sederajat','N'),(17,'Sedang S-1/Sederajat','N'),(18,'Sedang S-2/Sederajat','N'),(19,'Sedang S-3/Sederajat','N'),(20,'Putus Sekolah','N');

/*Table structure for table `ref_provinsi` */

DROP TABLE IF EXISTS `ref_provinsi`;

CREATE TABLE `ref_provinsi` (
  `id_provinsi` int(10) NOT NULL AUTO_INCREMENT,
  `kode_provinsi_bps` char(10) NOT NULL,
  `kode_provinsi_kemendagri` char(10) NOT NULL,
  `nama_provinsi` varchar(50) NOT NULL,
  `luas_wilayah` float NOT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ref_provinsi` */

insert  into `ref_provinsi`(`id_provinsi`,`kode_provinsi_bps`,`kode_provinsi_kemendagri`,`nama_provinsi`,`luas_wilayah`) values (0,'0','0','Tidak Diketahui',0),(1,'34','34','Daerah Istimewa Yogyakarta',3185),(2,'02','02','Jawa Barat',74747);

/*Table structure for table `ref_rp_bidang` */

DROP TABLE IF EXISTS `ref_rp_bidang`;

CREATE TABLE `ref_rp_bidang` (
  `id_bidang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bidang` varchar(15) DEFAULT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `level` int(2) NOT NULL,
  `id_parent_bidang` int(11) DEFAULT NULL,
  `id_top_bidang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_bidang`),
  KEY `id_parent_bidang` (`id_parent_bidang`),
  KEY `id_parent_bidang_2` (`id_parent_bidang`),
  KEY `id_top_bidang` (`id_top_bidang`),
  CONSTRAINT `ref_rp_bidang_ibfk_1` FOREIGN KEY (`id_parent_bidang`) REFERENCES `ref_rp_bidang` (`id_bidang`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Data for the table `ref_rp_bidang` */

insert  into `ref_rp_bidang`(`id_bidang`,`kode_bidang`,`deskripsi`,`level`,`id_parent_bidang`,`id_top_bidang`) values (21,'1','PENYELENGGARAAN PEMERINTAH DESA',1,NULL,NULL),(22,'2','PELAKSANAAN PEMBANGUNAN DESA',1,NULL,NULL),(23,'3','PEMBINAAN KEMASYARAKATAN DESA',1,NULL,NULL),(24,'4','PEMBERDAYAAN MASYARAKAT DESA',1,NULL,NULL),(29,'1.1','Urusan Penyelenggaraan Pemerintah Desa',2,21,21),(30,'1.1.1','Program Pelayanan Administrasi Perkantoran',3,29,21),(31,'1.1.1.1','Penyediaan Jasa Administrasi Perkantoran',4,30,21),(32,'1.1.1.2','Penyediaan Jasa Pemeliharaan sarana prasarana Kantor',4,30,21),(33,'1.1.1.3','Penyediaan Jasa langganan Kantor',4,30,21),(34,'1.1.1.4','Penyediaan sarana rapat kantor',4,30,21),(36,'1.1.1.5','Lain lain',4,30,21),(37,'2.1','Pembangunan Inftastruktur',2,22,22),(38,'2.1.1','Pembangunan Inftastruktur Jalan',3,37,22);

/*Table structure for table `ref_rp_coa` */

DROP TABLE IF EXISTS `ref_rp_coa`;

CREATE TABLE `ref_rp_coa` (
  `id_coa` int(11) NOT NULL AUTO_INCREMENT,
  `kode_rekening` varchar(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `id_parent_coa` int(11) DEFAULT NULL,
  `id_top_coa` int(11) DEFAULT NULL,
  `level` int(2) NOT NULL,
  PRIMARY KEY (`id_coa`),
  KEY `id_parent_coa` (`id_parent_coa`),
  KEY `id_parent_coa_2` (`id_parent_coa`),
  CONSTRAINT `ref_rp_coa_ibfk_1` FOREIGN KEY (`id_parent_coa`) REFERENCES `ref_rp_coa` (`id_coa`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `ref_rp_coa` */

insert  into `ref_rp_coa`(`id_coa`,`kode_rekening`,`deskripsi`,`id_parent_coa`,`id_top_coa`,`level`) values (3,'1','PENDAPATAN',NULL,NULL,1),(6,'1.1','Pendapatan Asli Desa',3,3,2),(7,'1.1.1','Hasil Usaha',6,3,3),(8,'1.1.2','Swadaya, Partisipasi dan Gotong Royong',6,3,3),(10,'2','BELANJA',NULL,NULL,1),(19,'1.1.3','Lain-lain Pendapatan Asli Desa yang sah',6,3,3),(20,'1.2','Pendapatan Transfer',3,3,2),(21,'1.2.1','Dana Desa',20,3,3),(22,'1.2.2','Bagian dari hasil pajak & retribusi daerah kabupaten / kota',20,3,3),(23,'1.2.3','Alokasi Dana Desa',20,3,3),(24,'1.2.4','Bantuan Keuangan',20,3,3),(25,'1.2.4.1','Bantuan Provinsi',24,3,4),(26,'1.2.4.2','Bantuan Kabupaten / Kota',24,3,4),(27,'3','PEMBIAYAAN',NULL,NULL,1),(28,'3.1','Penerimaan Pembiayaan',27,27,2),(29,'3.2','Pengeluaran Pembiayaan',27,27,2),(30,'3.1.1','SILPA',28,27,3),(31,'3.1.2','Pencairan Dana Cadangan',28,27,3),(32,'3.1.3','Hasil Kekayaan Desa Yang dipisahkan',28,27,3),(33,'3.2.1','Pembentukan Dana Cadangan',29,27,3),(34,'3.2.2','Penyertaan Modal Desa',29,27,3),(35,'2.1','Bidang Penyelenggaraan Pemerintahan Desa',10,10,2),(36,'2.1.1','Penghasilan Tetap dan Tunjangan',35,10,3),(37,'2.1.1.1','Belanja Pegawai',36,10,4),(38,'2.1.2','Operasional Perkantoran',35,10,3),(39,'2.1.2.2','Belanja Barang dan Jasa',38,10,4),(40,'2.1.2.3','Belanja Modal',38,10,4),(41,'2.1.3','Operasional BPD',35,10,3),(42,'2.1.4','Operasional RT/ RW',35,10,3),(43,'2.1.3.2','Belanja Barang dan Jasa',41,10,4),(44,'2.1.4.2','Belanja Barang dan Jasa',42,10,4),(45,'2.2','Bidang Pelaksanaan Pembangunan Desa',10,10,2),(46,'2.3','Bidang Pembinaan Kemasyarakatan',10,10,2),(47,'2.4','Bidang Pemberdayaan Masyarakat',10,10,2),(48,'2.5','Bidang Tak Terduga',10,10,2);

/*Table structure for table `ref_rp_periode` */

DROP TABLE IF EXISTS `ref_rp_periode`;

CREATE TABLE `ref_rp_periode` (
  `id_periode` int(11) NOT NULL AUTO_INCREMENT,
  `periode_awal` int(5) NOT NULL,
  `periode_akhir` int(5) NOT NULL,
  `is_current` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_periode`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ref_rp_periode` */

insert  into `ref_rp_periode`(`id_periode`,`periode_awal`,`periode_akhir`,`is_current`) values (1,2010,2014,'2015-06-30 22:13:48'),(4,2015,2019,'2015-06-30 22:13:58'),(5,2020,2024,'2015-06-30 23:58:03');

/*Table structure for table `ref_rp_sumber_dana` */

DROP TABLE IF EXISTS `ref_rp_sumber_dana`;

CREATE TABLE `ref_rp_sumber_dana` (
  `id_sumber_dana` int(11) NOT NULL AUTO_INCREMENT,
  `sumber` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `nominal` int(20) NOT NULL,
  `id_tahun_anggaran` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sumber_dana`),
  KEY `id_tahun_anggaran` (`id_tahun_anggaran`),
  CONSTRAINT `ref_rp_sumber_dana_ibfk_1` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `ref_rp_tahun_anggaran` (`id_tahun_anggaran`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `ref_rp_sumber_dana` */

insert  into `ref_rp_sumber_dana`(`id_sumber_dana`,`sumber`,`deskripsi`,`nominal`,`id_tahun_anggaran`) values (1,'PEMKAB GUNUNGKIDUL','Pemerintah Kabupaten Gunungkidul',14946000,4),(2,'PEMPROV DIY','Pemerintah Provinsi Daerah Istimewa Yogyakarta',45700000,4),(3,'PEMDA WONOSARI','Pemerintah Daerah Wonosari',37997800,17);

/*Table structure for table `ref_rp_sumber_dana_desa` */

DROP TABLE IF EXISTS `ref_rp_sumber_dana_desa`;

CREATE TABLE `ref_rp_sumber_dana_desa` (
  `id_sumber_dana_desa` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(100) DEFAULT NULL,
  `keyword` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_sumber_dana_desa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `ref_rp_sumber_dana_desa` */

insert  into `ref_rp_sumber_dana_desa`(`id_sumber_dana_desa`,`deskripsi`,`keyword`) values (1,'APB Desa','Dana Desa, APBDes, APBDESA'),(2,'APBD Kabupaten',NULL),(3,'APBD Provinsi',NULL),(5,'APBN',NULL);

/*Table structure for table `ref_rp_tahun_anggaran` */

DROP TABLE IF EXISTS `ref_rp_tahun_anggaran`;

CREATE TABLE `ref_rp_tahun_anggaran` (
  `id_tahun_anggaran` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(25) NOT NULL,
  `regulasi` varchar(50) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `tahun` int(4) DEFAULT NULL,
  `id_periode` int(11) NOT NULL,
  `is_current` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tahun_anggaran`),
  KEY `id_tahun` (`id_tahun_anggaran`),
  KEY `id_tahun_2` (`id_tahun_anggaran`),
  KEY `id_periode` (`id_periode`),
  CONSTRAINT `ref_rp_tahun_anggaran_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `ref_rp_periode` (`id_periode`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `ref_rp_tahun_anggaran` */

insert  into `ref_rp_tahun_anggaran`(`id_tahun_anggaran`,`deskripsi`,`regulasi`,`keterangan`,`tahun`,`id_periode`,`is_current`) values (4,'deskripsi','regulasi','keterangan    ',2015,4,'2015-06-30 23:55:20'),(5,'desc','regul','ket',2016,4,'2015-06-30 23:54:32'),(6,'desc','reg','ket',2017,4,'2015-06-30 23:55:35'),(7,'desc','reg','ket',2018,4,'2015-06-30 23:55:42'),(8,'desc','reg','ket',2019,4,'2015-06-30 23:55:47'),(9,'deskripsi','regulasi','keterangan',2020,5,'2015-06-30 23:58:32'),(10,'desc','reg','ket',2021,5,'2015-07-06 23:56:08'),(11,'desc','reg','ket',2022,5,'2015-07-06 23:56:14'),(12,'desc','reg','ket',2023,5,'2015-07-06 23:56:18'),(13,'desc','reg','ket',2024,5,'2015-07-06 23:56:24'),(14,'desc','reg','ket',2010,1,'2015-07-27 06:37:07'),(15,'desc','reg','ket',2011,1,'2015-07-27 06:37:12'),(16,'desc','reg','ket',2012,1,'2015-07-27 06:37:16'),(17,'desc','reg','ket',2013,1,'2015-07-27 06:37:20'),(18,'desc','reg','ket',2014,1,'2015-07-27 06:37:23');

/*Table structure for table `ref_rt` */

DROP TABLE IF EXISTS `ref_rt`;

CREATE TABLE `ref_rt` (
  `id_rt` int(10) NOT NULL AUTO_INCREMENT,
  `nomor_rt` char(10) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_rw` int(10) NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_rt`),
  KEY `id_penduduk` (`id_penduduk`),
  KEY `id_rw` (`id_rw`),
  KEY `id_penduduk_2` (`id_penduduk`),
  CONSTRAINT `ref_rt_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`),
  CONSTRAINT `ref_rt_ibfk_2` FOREIGN KEY (`id_rw`) REFERENCES `ref_rw` (`id_rw`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `ref_rt` */

insert  into `ref_rt`(`id_rt`,`nomor_rt`,`luas_wilayah`,`id_rw`,`id_penduduk`) values (0,'-',0,0,NULL),(1,'01',500,1,NULL);

/*Table structure for table `ref_rw` */

DROP TABLE IF EXISTS `ref_rw`;

CREATE TABLE `ref_rw` (
  `id_rw` int(10) NOT NULL AUTO_INCREMENT,
  `nomor_rw` char(10) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_dusun` int(10) NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_rw`),
  KEY `id_dusun` (`id_dusun`),
  KEY `id_penduduk` (`id_penduduk`),
  CONSTRAINT `ref_rw_ibfk_1` FOREIGN KEY (`id_dusun`) REFERENCES `ref_dusun` (`id_dusun`),
  CONSTRAINT `ref_rw_ibfk_2` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ref_rw` */

insert  into `ref_rw`(`id_rw`,`nomor_rw`,`luas_wilayah`,`id_dusun`,`id_penduduk`) values (0,'-',0,0,NULL),(1,'01',1000,1,NULL),(2,'02',1500,1,NULL);

/*Table structure for table `ref_status_kawin` */

DROP TABLE IF EXISTS `ref_status_kawin`;

CREATE TABLE `ref_status_kawin` (
  `id_status_kawin` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_status_kawin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ref_status_kawin` */

insert  into `ref_status_kawin`(`id_status_kawin`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Belum Kawin'),(2,'Kawin'),(3,'Cerai Hidup'),(4,'Cerai Mati');

/*Table structure for table `ref_status_keluarga` */

DROP TABLE IF EXISTS `ref_status_keluarga`;

CREATE TABLE `ref_status_keluarga` (
  `id_status_keluarga` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_status_keluarga`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `ref_status_keluarga` */

insert  into `ref_status_keluarga`(`id_status_keluarga`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Kepala Keluarga'),(2,'Suami'),(3,'Istri'),(4,'Anak'),(5,'Menantu'),(6,'Mertua'),(7,'Famili Lain');

/*Table structure for table `ref_status_penduduk` */

DROP TABLE IF EXISTS `ref_status_penduduk`;

CREATE TABLE `ref_status_penduduk` (
  `id_status_penduduk` int(5) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_status_penduduk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `ref_status_penduduk` */

insert  into `ref_status_penduduk`(`id_status_penduduk`,`deskripsi`) values (0,'Tidak diketahui'),(1,'Tinggal Tetap'),(2,'Meninggal'),(3,'Pindahan Keluar'),(4,'Pindahan Masuk');

/*Table structure for table `ref_status_tinggal` */

DROP TABLE IF EXISTS `ref_status_tinggal`;

CREATE TABLE `ref_status_tinggal` (
  `id_status_tinggal` int(10) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_status_tinggal`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ref_status_tinggal` */

insert  into `ref_status_tinggal`(`id_status_tinggal`,`deskripsi`) values (0,'Tidak Diketahui'),(1,'Tinggal Tetap'),(2,'Tinggal di luar desa (dalam 1 kab/kota)'),(3,'Tinggal di luar kota'),(4,'Tinggal di luar provinsi'),(5,'Tinggal di luar negeri');

/*Table structure for table `tbl_aset_bangunan` */

DROP TABLE IF EXISTS `tbl_aset_bangunan`;

CREATE TABLE `tbl_aset_bangunan` (
  `id_aset_bangunan` int(4) NOT NULL AUTO_INCREMENT,
  `no_imb` varchar(30) NOT NULL,
  `tgl_bangun` date NOT NULL,
  `luas` float NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` blob,
  `id_kepemilikan_aset` int(4) NOT NULL,
  `id_aset_tanah` int(4) NOT NULL,
  PRIMARY KEY (`id_aset_bangunan`),
  KEY `id_aset_tanah` (`id_aset_tanah`),
  KEY `kepemilikan` (`id_kepemilikan_aset`),
  CONSTRAINT `tbl_aset_bangunan_ibfk_1` FOREIGN KEY (`id_kepemilikan_aset`) REFERENCES `ref_kepemilikan_aset` (`id_kepemilikan_aset`),
  CONSTRAINT `tbl_aset_bangunan_ibfk_2` FOREIGN KEY (`id_aset_tanah`) REFERENCES `tbl_aset_tanah` (`id_aset_tanah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_aset_bangunan` */

/*Table structure for table `tbl_aset_master` */

DROP TABLE IF EXISTS `tbl_aset_master`;

CREATE TABLE `tbl_aset_master` (
  `id_aset_master` int(4) NOT NULL AUTO_INCREMENT,
  `no_aset` varchar(30) DEFAULT NULL,
  `nama` varchar(30) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `spesifikasi` text NOT NULL,
  `tgl_beli` date NOT NULL,
  `ketersediaan` enum('Ya','Tidak') NOT NULL,
  `kondisi` enum('Baik','Tidak Baik') NOT NULL,
  `keterangan` varchar(30) DEFAULT NULL,
  `id_aset_ruangan` int(4) NOT NULL,
  `id_kategori_aset` int(4) NOT NULL,
  `id_asal_aset` int(4) NOT NULL,
  `id_kepemilikan_aset` int(4) NOT NULL,
  PRIMARY KEY (`id_aset_master`),
  KEY `id_aset_ruang` (`id_aset_ruangan`),
  KEY `id_kategori_aset` (`id_kategori_aset`),
  KEY `id_asal_aset` (`id_asal_aset`),
  KEY `id_kepemilikan_aset` (`id_kepemilikan_aset`),
  CONSTRAINT `tbl_aset_master_ibfk_1` FOREIGN KEY (`id_aset_ruangan`) REFERENCES `tbl_aset_ruangan` (`id_aset_ruangan`),
  CONSTRAINT `tbl_aset_master_ibfk_2` FOREIGN KEY (`id_kategori_aset`) REFERENCES `ref_kategori_aset` (`id_kategori_aset`),
  CONSTRAINT `tbl_aset_master_ibfk_3` FOREIGN KEY (`id_asal_aset`) REFERENCES `ref_asal_aset` (`id_asal_aset`),
  CONSTRAINT `tbl_aset_master_ibfk_4` FOREIGN KEY (`id_kepemilikan_aset`) REFERENCES `ref_kepemilikan_aset` (`id_kepemilikan_aset`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_aset_master` */

/*Table structure for table `tbl_aset_perawatan_bgn` */

DROP TABLE IF EXISTS `tbl_aset_perawatan_bgn`;

CREATE TABLE `tbl_aset_perawatan_bgn` (
  `id_aset_perawatan_bgn` int(4) NOT NULL AUTO_INCREMENT,
  `tgl_perawatan` date NOT NULL,
  `deskripsi` text NOT NULL,
  `id_aset_bangunan` int(4) NOT NULL,
  PRIMARY KEY (`id_aset_perawatan_bgn`),
  KEY `id_aset_bangunan` (`id_aset_bangunan`),
  CONSTRAINT `tbl_aset_perawatan_bgn_ibfk_1` FOREIGN KEY (`id_aset_bangunan`) REFERENCES `tbl_aset_bangunan` (`id_aset_bangunan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_aset_perawatan_bgn` */

/*Table structure for table `tbl_aset_ruangan` */

DROP TABLE IF EXISTS `tbl_aset_ruangan`;

CREATE TABLE `tbl_aset_ruangan` (
  `id_aset_ruangan` int(4) NOT NULL AUTO_INCREMENT,
  `luas` float NOT NULL,
  `deskripsi` text NOT NULL,
  `id_aset_bangunan` int(4) NOT NULL,
  PRIMARY KEY (`id_aset_ruangan`),
  KEY `id_aset_bangunan` (`id_aset_bangunan`),
  CONSTRAINT `tbl_aset_ruangan_ibfk_1` FOREIGN KEY (`id_aset_bangunan`) REFERENCES `tbl_aset_bangunan` (`id_aset_bangunan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_aset_ruangan` */

/*Table structure for table `tbl_aset_tanah` */

DROP TABLE IF EXISTS `tbl_aset_tanah`;

CREATE TABLE `tbl_aset_tanah` (
  `id_aset_tanah` int(4) NOT NULL AUTO_INCREMENT,
  `no_sertifikat` varchar(30) NOT NULL,
  `luas` float NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` blob,
  `id_kepemilikan_aset` int(4) NOT NULL,
  PRIMARY KEY (`id_aset_tanah`),
  KEY `id_kepemilikan_aset` (`id_kepemilikan_aset`),
  CONSTRAINT `tbl_aset_tanah_ibfk_1` FOREIGN KEY (`id_kepemilikan_aset`) REFERENCES `ref_kepemilikan_aset` (`id_kepemilikan_aset`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_aset_tanah` */

/*Table structure for table `tbl_berita` */

DROP TABLE IF EXISTS `tbl_berita`;

CREATE TABLE `tbl_berita` (
  `id_berita` int(10) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(10) NOT NULL,
  `penulis` varchar(30) DEFAULT NULL,
  `gambar` text NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `isi_berita` blob NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_publish` enum('Ya','Tidak') NOT NULL DEFAULT 'Ya',
  `is_masyarakat` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak',
  PRIMARY KEY (`id_berita`),
  KEY `id_pengguna` (`id_pengguna`),
  CONSTRAINT `tbl_berita_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pengguna` (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_berita` */

insert  into `tbl_berita`(`id_berita`,`id_pengguna`,`penulis`,`gambar`,`judul_berita`,`isi_berita`,`waktu`,`is_publish`,`is_masyarakat`) values (25,2,'','uploads/berita/1c63014d966ff0e499fba1f4769a450ba3843792.jpg','Konsorsium Hijau Diminta Kontribusi Wujudkan Green Buleleng','<p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Pelaksanaan program Pengetahuan Hijau di Kabupaten Buleleng Provinsi Bali oleh Konsorsium Hijau mulai bergulir. Dimulainya program pengetahuan hijau tersebut seiring dilaksanakannya Rapat Koordinasi Pelaksanaan Program Hibah Pengetahuan Hijau antara Konsorsium Hijau dengan Pemerintah Kabupaten Buleleng. Kegiatan tersebut dilaksanakan pada Kamis, 5 November 2015 di Kantor Badan Perencanaan Pembangunan Daerah (Bappeda) Kabupaten Buleleng.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Dalam rapat koordinasi tersebut hadir I Agung Putri Astrid, MA,&nbsp; Co Team Leader Program Pengetahuan Hijau dari Konsorsium Hijau, Irya Wisnubadhra, ST, MT, IT Officer, Ir. Putu Gde Yasa Sekretaris Bappeda Kab. Buleleng, Drs. Dewa Made Sudiarta Kabid Sosial Budaya Bappeda, serta SKPD-SKPD terkait di Kab. Buleleng.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Dalam Rapat Koordinasi tersebut, I Agung Putri Astrid atau yang biasa disapa Gung Tri menyampaikan presentasi mengenai pelaksanaan program pengetahuan hijau di Kab. Buleleng. “Program pengetahuan hijau bertujuan untuk meningkatkan pemahaman masyarakat desa mengenai pembangunan rendah karbon,” jelas Gung Tri.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Berbagai aktivitas akan dilaksanakan dalam skema program pengetahuan hijau, antara lain penelitian untuk menggali pengetahuan lokal, peningkatan kapasitas masyarakat desa serta mendorong pengetahuan yang dihasilkan masuk dalam proses pengembilan kebijakan di desa, kabupaten, provinsi maupun nasional.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">“Yang menjadi fokus kami kedepan adalah adanya anak-anak muda yang memiliki kapasitas atau pengetahuan yang hijau, sehingga menjadi aktor-aktor pembaru di desa, maupun di luar desanya sendiri,” ujar Gung Tri.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Sedangkan Putu Gde Yasa, mengapresiasi upaya dari Konsorsium Hijau untuk mengembangkan masyarakat desa terutama dalam bidang lingkungan. Menurut Sekretaris Bappeda kab. Buleleng tersebut Provinsi Bali juga sudah mencanangkan sebagai Green Province. “Saya berharap dengan kontribusi dari Konsorsium Hijau kita bisa menjadi Green Buleleng,” ujarnya.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Oleh sebab itu kita harus melawan semakin meningkatnya polusi CO2. Baik dari kendaraan bermotor, pembakaran sampah maupun lainnya. Alih fungsi lahan pun semestinya semakin dikurangi karena lahan terbuka yang semakin sedikit.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Selain Kabupaten Buleleng, Konsorsium Hijau juga melaksanakan program Pengetahuan Hijau di delapan kabupaten, antara lain Kabupaten Lombok Timur, Lombok Tengah di Provinsi NTB, Sumba Timur, Sumba Tengah di provinsi NTT, Muaro Jambi, Tanjung Jabung Timur di Provinsi Jambi, dan Mamuju di Provinsi Sulawesi Barat.**(et)</p>','2015-11-09 17:27:42','Ya','Tidak'),(26,2,'','uploads/berita/9625b75b5e2aec702c4abec26d19c0574cfd5ff3.jpg','Konsorsium Hijau Periksa Krisis Sosial Ekologi Desa di 8 Kabupaten','<p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Konsorsium Hijau telah memulai kerja lapangan implementasi program pengetahuan hijau. Kerja lapangan dimulai dengan melakukan Rapid Assesmen terhadap 16 desa di delapan kabupaten lokasi program, pada awal hingga pertengahan November ini. Untuk tahap pertama, Rapid Assesmen dilakukan di Kabupaten Lombok Timur, lombok Tengah, Sumba Timur, Sumba Tengah dan Mamuju. Sedangkan Kabupaten Muaro Jambi, Tanjung Jabung Timur dan Buleleng akan dilaksanakan dalam waktu dekat.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Tujuan dari proses pemeriksaan ini mendorong kemandirian desa khususnya yang menjadi wilayah kegiatan pemeriksaan, serta mendorong lahirnya para pemimpin masa depan di desa, dari kalangan generasi muda baik laki-laki maupun perempuan. Pemeriksaan ini hanya alat untuk mencapai dua visi kegiatan Konsorsium Hijau. Kerangka utama dalam rapid assesmen ini ialah krisis sosial ekologis di desa-desa di Indonesia. Yang dimaksud krisis sosial ekologis adalah penurunan fungsi ekologis dan alam yang pada gilirannya berdampak pada kehidupan sosial. Krisis ini bukan sebatas kerusakan fisik belaka tapi telah menjangkau aspek sosial dan telah mempengaruhi manusia yang tinggal di daerah krisis. Kesadaran warga desa misalnya telah dibentuk oleh krisis ini. Warga bahkan telah hidup bersama krisis dan menajadi bagian dan penopang utama bagi kerusakan alam yang berkelanjutan.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Dengan kata lain, krisis sosial ekologis dapat dipahami sebagai “payung” kegiatan pemeriksaan ini. Untuk dapat memahami krisis sosial ekologis di atas, telah dipilih “pintu” yang menjadi titik masuk, yakni pertanian yang terintegrasi (integrated farming/IF), energi yang terbarukan (renewableenergy/RE), kewirausahaan berbasis nilai lingkungan (green entrepreneurship/GE), dan perencanaan berbasis spasial (spatial planning/SP). Bidang terakhir, spatial planning (SP), akan menjadi kerangka pikir dalam melihat ketiga bidang yang lain.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Selain sebagai “pintu masuk” memahami krisis, keempat bidang ini akan menjadi titik mencari “pintu keluar” dari krisis sosial ekologis. Saat memikirkan tawaran jalan keluar di desa terkait krisis ini, ketiga bidang ini adalah materi yang akan didorong dalam rangka memperkuat kemandirian dan ketahanan desa dengan prinsip yang bersahabat pada lingkungan hidup. Ketiga bidang inilah yang akan menjadi aspek mendorong ekonomi desa. Rapid Assesment akan dilangsungkan selama dua belas hari. Ada 16 peneliti muda Konsorsium Hijau yang akan tinggal bersama masyarakat di 16 desa lokasi penelitian.*** (ET)</p>','2015-11-09 17:30:10','Ya','Tidak'),(27,0,'Irya Wisnubhadra','uploads/berita/ec9c6b44d83744a0d3bfdcb037f7448b33fba105.jpg','Kerangka Acuan Implementasi Sistem Informasi Desa dan Kawasan (SIDEKA) - Hijau sebagai sumber data','Management Information System &#40;MIS&#41; dalam bahasa Indonesia disebut dengan Sistem Informasi Manajemen (SIM), adalah sistem informasi yang membantu manajemen dalam merencanakan strategis bisnis, dan memecahkan masalah bisnis seperti biasa produk dan layanan. SIM dibedakan dengan sistem informasi biasa/transaksional (SI) karena SIM digunakan untuk menganalisis SI lain yang diterapkan pada aktivitas operasional organisasi. SIM pada umumnya digunakan untuk merujuk pada kelompok manajemen informasi yang bertalian dengan otomasi dan dukungan terhadap pengambilan keputusan berdasar data yang akurat. Pada konteks pemerintahan dalam mengelola kelestarian alam maka MIS akan dapat digunakan untuk memonitor secara online, mengevaluasi secara online, yang pada akhirnya digunakan sebagai dasar pengambilan keputusan\n\nSyarat utama berjalannya MIS yang baik adalah terimplementasikannya Sistem Informasi Transaksional yang baik pula. Sistem Informasi transaksional menjadi sumber data bagi MIS sehingga implementasi SI menjadi syarat mutlak bekerjanya MIS.\n\nSistem Informasi Desa dan Kawasan (SIDeKa) merupakan sebuah sistem informasi transaksional yang mampu mengumpulkan, mengolah maupun menyajikan data sesuai dengan kebutuhan Pemerintah Desa.  SIDeKa di desain dalam hal akurasi data, pemanfaatan data serta kecepatan dalam memanggil data yang akan membuka banyak kemungkinan bagi desa untuk ambil bagian dalam mengurus rumah tangganya yang pada saat bersamaan menjadi langkah kontribusi desa dalam ikut menyelesaikan masalah-masalah bangsa.\n\nSistem informasi ini dikembangkan dengan prinsip-prinsip partisipasi, transparansi dan akuntabilitas dalam upaya mendorong pemberdayaan masyarakat serta mewujudkan nilai-nilai demokratisasi di tingkat desa. Dimulai dari tahap perencanaan, penggumpulan data, pengolahan hingga pemanfaatan data, semua dilakukan oleh pemdes bersama dengan masyarakat secara terbuka. Dalam hal penyelenggaraannya, SIDeKa dirancang sebagai sebuah sistem informasi yang tumbuh dari bawah dan dibantu dengan pengaturan kelembagaan dan kebijakan dari atas. \nSIDEKA saat ini telah diimplementasikan secara online di lebih dari 8 kabupaten dan 400 desa. Masing masing desa selanjutnya mempunyai web site dengan domain desa.id yang dapat digunakan untuk mengelola data transaksional di level desa. \n\nKonsorsium Hijau pada Quarter ke-2 bulan Januari, akan melaksanakan analisis kebutuhan (Need assessment / requirement analysis) untuk pengembangan Management Information System &#40;MIS&#41; di tingkat kabupaten. Karena MIS harus mempunyai sumber data yang akurat yang berasal dari sistem informasi transaksional maka implementasi/instalasi Sistem Informasi Desa dan Kawasan menjadi sangat penting dan diperlukan. \n\n Dalam proses implementasi/instalasi SIDeKa, dibutuhkan dukungan tenaga ahli teknik informatika (TI). Dukungan tenaga ahli yang bisa berasal dari mahasiswa ini dimaksudkan untuk melakukan pendampingan pemerintah desa dalam proses instalasi SIDEKA yang berbentuk website dan aplikasi dengan basis data desa. Dalam proses ini mahasiswa juga diharapkan dapat melakukan transfer pengetahuan kepada pengelola SIDeKa. \n','2015-11-09 17:35:08','Ya','Ya'),(28,0,'Jepriadi','uploads/berita/c85311da0336616d8edf910371abb39b8d4428b2.jpg','Kemenkominfo Kembali Meng-online-kan Desa-Desa Terdepan','Jakarta - Kementerian Komunikasi dan Informatika Republik Indonesia (Kominfo) Bekerjasama dengan Universitas Indonesia, ILEAD UI, Prakarsa Desa dan Desa Broadband Terpadu menyelenggarakan Program Pelatihan dan Pendampingan SDM di Desa pada senin hingga jum\'at (2-6/11) di Hotel Acacia Jakarta Pusat. \n\nSebanyak 50 Perwakilan Masyarakat Desa dari Perbatasan Indonesia datang untuk mengikuti kegiatan tersebut. Dari 50 Desa tersebut, mereka mewakili 7 Provinsi yang tersebar di Indonesia antara lain, Papua, Kalimantan Barat, Kalimantan Utara, Nusa Tenggara Timur (NTT), Maluku, Kepulauan Riau dan Riau. \n\nProgram Desa Broadband Terpadu yang diusung oleh Kominfo ini sengaja diperuntukkan bagi Desa Desa Perbatasan di Indonesia yang menjadi Beranda Negara. Karena memang selama ini keberadaan Negara di Daerah Perbatasan masih sangat kurang dirasakan. \n\n\"Kehadiran Program Desa Broadband Terpadu bagi 50 Desa Perbatasan ini adalah saebagai pilot project di tahun 2015 untuk menghadirkan Negara di Batas Indonesia. Jika hal ini dinilai baik, maka kedepan akan ada sekitar 1000 desa yang akan didampingi. Tujuannya adalah untuk meningkatkan produktifitas masyarakat melalui Informatika,\" tegas Mas Dia Febriansyah (Plt. BP3TI Kominfo), Rabu (4/11).\n\nJepriadi\nPendamping Desa Kaliau\' Kec. Sajingan Besar Kab. Sambas - Kalimantan Barat','2015-11-09 21:05:50','Ya','Ya'),(29,2,'','uploads/berita/027b557339eb87caf213fc8b905d7ddead0390b7.jpg','Watimpres Dukung Konsorsium Hijau Majukan Desa','<p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Krisis sosial-ekologi yang melanda Indonesia dalam beberapa dekade terakhir memperlihatkan bahwa pembangunan tidak lagi dapat berpijak pada paradigma dan cara yang lama. Salah satu terobosan penting yang berkembang beberapa tahun terakhir ini adalah konsep pembangunan ekonomi dengan karbon rendah (low-carbon economic development) yang bersandar pada gugus pemikiran dan pendekatan yang untuk mudahnya disebut Pengetahuan Hijau (Green Knowledge).</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Dalam beberapa tahun terakhir Pengetahuan Hijau mulai berkembang pesat di berbagai belahan dunia berpijak pada keragaman tradisi dan kebudayaan, pemikiran dan praktek di tingkat lokal. Konsorsium Hijau membawa Pengetahuan Hijau di level desa, yang digunakan untuk meningkatkan kesejahteraan masyarakat desa namun tetap melestarikan alam.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Untuk itulah Konsorsium Hijau melakukan sejumlah pertemuan dalam mempromosikan konsep Pengetahuan Hijau, salah satunya dengan Dewan Pertimbangan Presiden (Watimpres), yang dilaksanakan di Kantor Watimpres Jakarta, pada Jum’at, 30 Oktober lalu. Pertemuan ini dihadiri langsung Prof. Dr. Sri Adiningsih Ketua Dewan Pertimbangan Presiden serta Sidarto Danusubroto Anggota Dewan Pertimbangan Presiden.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Dalam pertemuan ini Konsorsium Hijau memaparkan agenda-agenda yang dilakukan dalam program Pengetahuan Hijau di desa. Dr. Maryatmo, MA Team Leader Konsorsium Hijau mengatakan bahwa saat ini lembaganya telah melakukan pendampingan di 16 desa di 8 Kabupaten di 5 provinsi untuk meningkatkan kapasitas anak-anak muda dalam pengelolaan sumber daya alamnya. “Hal ini penting agar para pemuda bisa meningkatkan kesejahteraan tetapi tidak dengan merusak alam,” ujar Maryatmo.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Sri Adiningsih, menyambut baik atas inisiatif untuk memajukan desa. Hal tersebut sesuai dengan semangat dari Nawacita yang dicanangkan Presiden Joko Widodo. “Pembangunan desa merupakan prioritas pembangunan. Sesuai dengan Nawacita, membangun dari pinggiran,” jelas Adiningsih.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Wantimpres, lanjut Adiningsih, terbuka lebar bagi siapapun untuk bersinergi melaksanakan pembangunan demi kemajuan bangsa dan negara. “Kami pun berkeinginan untuk bisa melihat langsung di lapangan apa yang sudah dilakukan oleh teman-teman,” tandas Guru Besar Fakultas Ekonomi UGM tersebut.** (ET)</p>','2015-11-11 09:21:36','Ya','Tidak');

/*Table structure for table `tbl_demografi` */

DROP TABLE IF EXISTS `tbl_demografi`;

CREATE TABLE `tbl_demografi` (
  `id_demografi` int(10) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(10) NOT NULL,
  `isi_demografi` blob NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto_banner` varchar(50) NOT NULL,
  PRIMARY KEY (`id_demografi`),
  KEY `id_pengguna` (`id_pengguna`),
  CONSTRAINT `tbl_demografi_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pengguna` (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_demografi` */

insert  into `tbl_demografi`(`id_demografi`,`id_pengguna`,`isi_demografi`,`waktu`,`foto_banner`) values (1,2,'','2015-11-18 00:35:24','uploads/web/foto_banner_demografi.jpg');

/*Table structure for table `tbl_gizi_buruk` */

DROP TABLE IF EXISTS `tbl_gizi_buruk`;

CREATE TABLE `tbl_gizi_buruk` (
  `id_gizi_buruk` int(10) NOT NULL AUTO_INCREMENT,
  `berat_badan` int(10) NOT NULL,
  `tinggi_badan` int(10) NOT NULL,
  `tgl_timbang` datetime NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_gizi_buruk`),
  KEY `id_penduduk` (`id_penduduk`),
  CONSTRAINT `tbl_gizi_buruk_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_gizi_buruk` */

/*Table structure for table `tbl_hub_kel` */

DROP TABLE IF EXISTS `tbl_hub_kel`;

CREATE TABLE `tbl_hub_kel` (
  `id_hub_kel` int(10) NOT NULL AUTO_INCREMENT,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `id_penduduk` int(10) NOT NULL,
  `id_keluarga` int(10) NOT NULL,
  `id_status_keluarga` int(10) NOT NULL,
  `is_delete` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_hub_kel`),
  KEY `id_penduduk` (`id_penduduk`),
  KEY `id_keluarga` (`id_keluarga`),
  KEY `id_status_keluarga` (`id_status_keluarga`),
  CONSTRAINT `tbl_hub_kel_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`),
  CONSTRAINT `tbl_hub_kel_ibfk_2` FOREIGN KEY (`id_keluarga`) REFERENCES `tbl_keluarga` (`id_keluarga`),
  CONSTRAINT `tbl_hub_kel_ibfk_3` FOREIGN KEY (`id_status_keluarga`) REFERENCES `ref_status_keluarga` (`id_status_keluarga`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_hub_kel` */

/*Table structure for table `tbl_ikut_pindah_keluar` */

DROP TABLE IF EXISTS `tbl_ikut_pindah_keluar`;

CREATE TABLE `tbl_ikut_pindah_keluar` (
  `id_ikut_pindah_keluar` int(10) NOT NULL AUTO_INCREMENT,
  `id_penduduk` int(10) NOT NULL,
  `id_pindah_keluar` int(10) NOT NULL,
  PRIMARY KEY (`id_ikut_pindah_keluar`),
  KEY `id_penduduk` (`id_penduduk`),
  CONSTRAINT `tbl_ikut_pindah_keluar_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ikut_pindah_keluar` */

/*Table structure for table `tbl_ikut_pindah_masuk` */

DROP TABLE IF EXISTS `tbl_ikut_pindah_masuk`;

CREATE TABLE `tbl_ikut_pindah_masuk` (
  `id_ikut_pindah_masuk` int(10) NOT NULL AUTO_INCREMENT,
  `id_penduduk` int(10) NOT NULL,
  `id_keluarga` int(10) NOT NULL,
  PRIMARY KEY (`id_ikut_pindah_masuk`),
  KEY `id_penduduk` (`id_penduduk`),
  CONSTRAINT `tbl_ikut_pindah_masuk_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ikut_pindah_masuk` */

/*Table structure for table `tbl_kelahiran` */

DROP TABLE IF EXISTS `tbl_kelahiran`;

CREATE TABLE `tbl_kelahiran` (
  `id_kelahiran` int(10) NOT NULL AUTO_INCREMENT,
  `tgl_kelahiran` datetime NOT NULL,
  `nama_bayi` varchar(50) NOT NULL,
  `id_jen_kel` int(10) NOT NULL DEFAULT '0',
  `berat_bayi` varchar(10) DEFAULT NULL,
  `panjang_bayi` int(10) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `is_kembar` enum('Y','N') DEFAULT 'N',
  `lokasi_lahir` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `penolong` varchar(100) DEFAULT NULL,
  `id_keluarga` int(10) DEFAULT NULL,
  `nama_pelapor` varchar(100) DEFAULT NULL,
  `id_pelapor` int(10) DEFAULT NULL,
  `id_penduduk` int(4) DEFAULT NULL,
  `id_surat` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_kelahiran`),
  KEY `id_ayah` (`id_keluarga`),
  KEY `id_pelapor` (`id_pelapor`),
  KEY `id_penduduk` (`id_penduduk`),
  KEY `id_surat` (`id_surat`),
  CONSTRAINT `tbl_kelahiran_ibfk_2` FOREIGN KEY (`id_keluarga`) REFERENCES `tbl_keluarga` (`id_keluarga`),
  CONSTRAINT `tbl_kelahiran_ibfk_3` FOREIGN KEY (`id_pelapor`) REFERENCES `ref_pelapor` (`id_pelapor`),
  CONSTRAINT `tbl_kelahiran_ibfk_4` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`),
  CONSTRAINT `tbl_kelahiran_ibfk_5` FOREIGN KEY (`id_surat`) REFERENCES `tbl_surat` (`id_surat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kelahiran` */

/*Table structure for table `tbl_keluarga` */

DROP TABLE IF EXISTS `tbl_keluarga`;

CREATE TABLE `tbl_keluarga` (
  `id_keluarga` int(10) NOT NULL AUTO_INCREMENT,
  `no_kk` varchar(25) NOT NULL,
  `alamat_jalan` varchar(50) NOT NULL,
  `is_sementara` enum('Y','N') NOT NULL DEFAULT 'N',
  `is_raskin` enum('Y','N') NOT NULL DEFAULT 'N',
  `is_jamkesmas` enum('Y','N') NOT NULL DEFAULT 'N',
  `is_pkh` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_kelas_sosial` int(10) DEFAULT NULL,
  `id_kepala_keluarga` int(10) DEFAULT NULL,
  `id_rt` int(10) DEFAULT NULL,
  `id_rw` int(10) DEFAULT NULL,
  `id_dusun` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_keluarga`),
  KEY `FK_keluarga_penduduk` (`id_kepala_keluarga`),
  KEY `id_kelas_sosial` (`id_kelas_sosial`),
  KEY `id_kepala_keluarga` (`id_kepala_keluarga`),
  KEY `id_rt` (`id_rt`),
  KEY `id_rw` (`id_rw`),
  KEY `id_dusun` (`id_dusun`),
  CONSTRAINT `tbl_keluarga_ibfk_1` FOREIGN KEY (`id_kelas_sosial`) REFERENCES `ref_kelas_sosial` (`id_kelas_sosial`),
  CONSTRAINT `tbl_keluarga_ibfk_2` FOREIGN KEY (`id_rt`) REFERENCES `ref_rt` (`id_rt`),
  CONSTRAINT `tbl_keluarga_ibfk_3` FOREIGN KEY (`id_rw`) REFERENCES `ref_rw` (`id_rw`),
  CONSTRAINT `tbl_keluarga_ibfk_4` FOREIGN KEY (`id_dusun`) REFERENCES `ref_dusun` (`id_dusun`),
  CONSTRAINT `tbl_keluarga_ibfk_5` FOREIGN KEY (`id_kepala_keluarga`) REFERENCES `tbl_penduduk` (`id_penduduk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_keluarga` */

/*Table structure for table `tbl_kondisi_kehamilan` */

DROP TABLE IF EXISTS `tbl_kondisi_kehamilan`;

CREATE TABLE `tbl_kondisi_kehamilan` (
  `id_kondisi_kehamilan` int(10) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(20) NOT NULL,
  `tgl_hpl` datetime NOT NULL,
  `is_resti` enum('Y','N') NOT NULL,
  `id_penduduk` int(10) NOT NULL,
  PRIMARY KEY (`id_kondisi_kehamilan`),
  KEY `id_penduduk` (`id_penduduk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kondisi_kehamilan` */

/*Table structure for table `tbl_kontak` */

DROP TABLE IF EXISTS `tbl_kontak`;

CREATE TABLE `tbl_kontak` (
  `id_kontak` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pesan` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kontak`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kontak` */

/*Table structure for table `tbl_lembaga_desa` */

DROP TABLE IF EXISTS `tbl_lembaga_desa`;

CREATE TABLE `tbl_lembaga_desa` (
  `id_lembaga_desa` int(10) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(10) NOT NULL,
  `isi_lembaga_desa` blob NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_lembaga_desa`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_lembaga_desa` */

insert  into `tbl_lembaga_desa`(`id_lembaga_desa`,`id_pengguna`,`isi_lembaga_desa`,`waktu`) values (1,2,'','2015-04-11 17:02:49');

/*Table structure for table `tbl_log` */

DROP TABLE IF EXISTS `tbl_log`;

CREATE TABLE `tbl_log` (
  `id_log` int(20) NOT NULL AUTO_INCREMENT,
  `fungsi` varchar(50) NOT NULL,
  `kegiatan` text NOT NULL,
  `kegiatan_rinci` text NOT NULL,
  `table` varchar(50) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(50) NOT NULL,
  `user_agent` text NOT NULL,
  `id_pengguna` int(10) NOT NULL,
  PRIMARY KEY (`id_log`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_log` */

/*Table structure for table `tbl_logo` */

DROP TABLE IF EXISTS `tbl_logo`;

CREATE TABLE `tbl_logo` (
  `id_logo` int(11) NOT NULL AUTO_INCREMENT,
  `konten_logo_desa` varchar(50) NOT NULL,
  `konten_logo_kabupaten` varchar(50) NOT NULL,
  `path_css` varchar(50) NOT NULL,
  PRIMARY KEY (`id_logo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_logo` */

insert  into `tbl_logo`(`id_logo`,`konten_logo_desa`,`konten_logo_kabupaten`,`path_css`) values (1,'uploads/web/logo_desa.png','uploads/web/logo_kabupaten.jpg','assetku/css/style.css');

/*Table structure for table `tbl_meninggal` */

DROP TABLE IF EXISTS `tbl_meninggal`;

CREATE TABLE `tbl_meninggal` (
  `id_meninggal` int(10) NOT NULL AUTO_INCREMENT,
  `tgl_meninggal` datetime NOT NULL,
  `nama` varchar(50) NOT NULL,
  `sebab` varchar(50) DEFAULT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  `penentu_kematian` varchar(50) DEFAULT NULL,
  `tempat_kematian` varchar(100) DEFAULT NULL,
  `id_pelapor` int(10) DEFAULT NULL,
  `nama_pelapor` varchar(100) DEFAULT NULL,
  `hubungan_pelapor` varchar(100) DEFAULT NULL,
  `id_surat` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_meninggal`),
  KEY `id_penduduk` (`id_penduduk`),
  KEY `id_pelapor` (`id_pelapor`),
  KEY `id_surat` (`id_surat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_meninggal` */

/*Table structure for table `tbl_pages` */

DROP TABLE IF EXISTS `tbl_pages`;

CREATE TABLE `tbl_pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `title` text NOT NULL,
  `content` blob NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pages` */

insert  into `tbl_pages`(`id`,`url`,`title`,`content`,`updated`) values (5,'web/c_sejarah','Sejarah Desa','','2015-05-01 01:45:43'),(6,'web/c_demografi','Demografi Desa','','2015-11-18 00:35:24'),(7,'web/c_visimisi','Visi Misi Desa','','2015-05-01 01:47:23'),(13,'web/c_home/get_detail_berita/10','tes lagi','asdwqeq','2015-06-12 01:04:20'),(14,'web/c_home/get_detail_berita/11','asd','ads','2015-11-08 22:04:06'),(15,'web/c_home/get_detail_berita/12','abc','abc','2015-11-08 22:07:45'),(16,'web/c_home/get_detail_berita/13','bayi ajaib','bayi ajaib','2015-11-08 22:16:56'),(28,'web/c_home/get_detail_berita/25','Konsorsium Hijau Diminta Kontribusi Wujudkan Green Buleleng','<p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Pelaksanaan program Pengetahuan Hijau di Kabupaten Buleleng Provinsi Bali oleh Konsorsium Hijau mulai bergulir. Dimulainya program pengetahuan hijau tersebut seiring dilaksanakannya Rapat Koordinasi Pelaksanaan Program Hibah Pengetahuan Hijau antara Konsorsium Hijau dengan Pemerintah Kabupaten Buleleng. Kegiatan tersebut dilaksanakan pada Kamis, 5 November 2015 di Kantor Badan Perencanaan Pembangunan Daerah (Bappeda) Kabupaten Buleleng.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Dalam rapat koordinasi tersebut hadir I Agung Putri Astrid, MA,&nbsp; Co Team Leader Program Pengetahuan Hijau dari Konsorsium Hijau, Irya Wisnubadhra, ST, MT, IT Officer, Ir. Putu Gde Yasa Sekretaris Bappeda Kab. Buleleng, Drs. Dewa Made Sudiarta Kabid Sosial Budaya Bappeda, serta SKPD-SKPD terkait di Kab. Buleleng.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Dalam Rapat Koordinasi tersebut, I Agung Putri Astrid atau yang biasa disapa Gung Tri menyampaikan presentasi mengenai pelaksanaan program pengetahuan hijau di Kab. Buleleng. “Program pengetahuan hijau bertujuan untuk meningkatkan pemahaman masyarakat desa mengenai pembangunan rendah karbon,” jelas Gung Tri.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Berbagai aktivitas akan dilaksanakan dalam skema program pengetahuan hijau, antara lain penelitian untuk menggali pengetahuan lokal, peningkatan kapasitas masyarakat desa serta mendorong pengetahuan yang dihasilkan masuk dalam proses pengembilan kebijakan di desa, kabupaten, provinsi maupun nasional.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">“Yang menjadi fokus kami kedepan adalah adanya anak-anak muda yang memiliki kapasitas atau pengetahuan yang hijau, sehingga menjadi aktor-aktor pembaru di desa, maupun di luar desanya sendiri,” ujar Gung Tri.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Sedangkan Putu Gde Yasa, mengapresiasi upaya dari Konsorsium Hijau untuk mengembangkan masyarakat desa terutama dalam bidang lingkungan. Menurut Sekretaris Bappeda kab. Buleleng tersebut Provinsi Bali juga sudah mencanangkan sebagai Green Province. “Saya berharap dengan kontribusi dari Konsorsium Hijau kita bisa menjadi Green Buleleng,” ujarnya.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Oleh sebab itu kita harus melawan semakin meningkatnya polusi CO2. Baik dari kendaraan bermotor, pembakaran sampah maupun lainnya. Alih fungsi lahan pun semestinya semakin dikurangi karena lahan terbuka yang semakin sedikit.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Selain Kabupaten Buleleng, Konsorsium Hijau juga melaksanakan program Pengetahuan Hijau di delapan kabupaten, antara lain Kabupaten Lombok Timur, Lombok Tengah di Provinsi NTB, Sumba Timur, Sumba Tengah di provinsi NTT, Muaro Jambi, Tanjung Jabung Timur di Provinsi Jambi, dan Mamuju di Provinsi Sulawesi Barat.**(et)</p>','2015-11-09 17:27:42'),(29,'web/c_home/get_detail_berita/26','Konsorsium Hijau Periksa Krisis Sosial Ekologi Desa di 8 Kabupaten','<p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Konsorsium Hijau telah memulai kerja lapangan implementasi program pengetahuan hijau. Kerja lapangan dimulai dengan melakukan Rapid Assesmen terhadap 16 desa di delapan kabupaten lokasi program, pada awal hingga pertengahan November ini. Untuk tahap pertama, Rapid Assesmen dilakukan di Kabupaten Lombok Timur, lombok Tengah, Sumba Timur, Sumba Tengah dan Mamuju. Sedangkan Kabupaten Muaro Jambi, Tanjung Jabung Timur dan Buleleng akan dilaksanakan dalam waktu dekat.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Tujuan dari proses pemeriksaan ini mendorong kemandirian desa khususnya yang menjadi wilayah kegiatan pemeriksaan, serta mendorong lahirnya para pemimpin masa depan di desa, dari kalangan generasi muda baik laki-laki maupun perempuan. Pemeriksaan ini hanya alat untuk mencapai dua visi kegiatan Konsorsium Hijau. Kerangka utama dalam rapid assesmen ini ialah krisis sosial ekologis di desa-desa di Indonesia. Yang dimaksud krisis sosial ekologis adalah penurunan fungsi ekologis dan alam yang pada gilirannya berdampak pada kehidupan sosial. Krisis ini bukan sebatas kerusakan fisik belaka tapi telah menjangkau aspek sosial dan telah mempengaruhi manusia yang tinggal di daerah krisis. Kesadaran warga desa misalnya telah dibentuk oleh krisis ini. Warga bahkan telah hidup bersama krisis dan menajadi bagian dan penopang utama bagi kerusakan alam yang berkelanjutan.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Dengan kata lain, krisis sosial ekologis dapat dipahami sebagai “payung” kegiatan pemeriksaan ini. Untuk dapat memahami krisis sosial ekologis di atas, telah dipilih “pintu” yang menjadi titik masuk, yakni pertanian yang terintegrasi (integrated farming/IF), energi yang terbarukan (renewableenergy/RE), kewirausahaan berbasis nilai lingkungan (green entrepreneurship/GE), dan perencanaan berbasis spasial (spatial planning/SP). Bidang terakhir, spatial planning (SP), akan menjadi kerangka pikir dalam melihat ketiga bidang yang lain.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Selain sebagai “pintu masuk” memahami krisis, keempat bidang ini akan menjadi titik mencari “pintu keluar” dari krisis sosial ekologis. Saat memikirkan tawaran jalan keluar di desa terkait krisis ini, ketiga bidang ini adalah materi yang akan didorong dalam rangka memperkuat kemandirian dan ketahanan desa dengan prinsip yang bersahabat pada lingkungan hidup. Ketiga bidang inilah yang akan menjadi aspek mendorong ekonomi desa. Rapid Assesment akan dilangsungkan selama dua belas hari. Ada 16 peneliti muda Konsorsium Hijau yang akan tinggal bersama masyarakat di 16 desa lokasi penelitian.*** (ET)</p>','2015-11-09 17:30:11'),(30,'web/c_home/get_detail_berita/27','Kerangka Acuan Implementasi Sistem Informasi Desa dan Kawasan (SIDEKA) - Hijau sebagai sumber data','Management Information System &#40;MIS&#41; dalam bahasa Indonesia disebut dengan Sistem Informasi Manajemen (SIM), adalah sistem informasi yang membantu manajemen dalam merencanakan strategis bisnis, dan memecahkan masalah bisnis seperti biasa produk dan layanan. SIM dibedakan dengan sistem informasi biasa/transaksional (SI) karena SIM digunakan untuk menganalisis SI lain yang diterapkan pada aktivitas operasional organisasi. SIM pada umumnya digunakan untuk merujuk pada kelompok manajemen informasi yang bertalian dengan otomasi dan dukungan terhadap pengambilan keputusan berdasar data yang akurat. Pada konteks pemerintahan dalam mengelola kelestarian alam maka MIS akan dapat digunakan untuk memonitor secara online, mengevaluasi secara online, yang pada akhirnya digunakan sebagai dasar pengambilan keputusan\n\nSyarat utama berjalannya MIS yang baik adalah terimplementasikannya Sistem Informasi Transaksional yang baik pula. Sistem Informasi transaksional menjadi sumber data bagi MIS sehingga implementasi SI menjadi syarat mutlak bekerjanya MIS.\n\nSistem Informasi Desa dan Kawasan (SIDeKa) merupakan sebuah sistem informasi transaksional yang mampu mengumpulkan, mengolah maupun menyajikan data sesuai dengan kebutuhan Pemerintah Desa.  SIDeKa di desain dalam hal akurasi data, pemanfaatan data serta kecepatan dalam memanggil data yang akan membuka banyak kemungkinan bagi desa untuk ambil bagian dalam mengurus rumah tangganya yang pada saat bersamaan menjadi langkah kontribusi desa dalam ikut menyelesaikan masalah-masalah bangsa.\n\nSistem informasi ini dikembangkan dengan prinsip-prinsip partisipasi, transparansi dan akuntabilitas dalam upaya mendorong pemberdayaan masyarakat serta mewujudkan nilai-nilai demokratisasi di tingkat desa. Dimulai dari tahap perencanaan, penggumpulan data, pengolahan hingga pemanfaatan data, semua dilakukan oleh pemdes bersama dengan masyarakat secara terbuka. Dalam hal penyelenggaraannya, SIDeKa dirancang sebagai sebuah sistem informasi yang tumbuh dari bawah dan dibantu dengan pengaturan kelembagaan dan kebijakan dari atas. \nSIDEKA saat ini telah diimplementasikan secara online di lebih dari 8 kabupaten dan 400 desa. Masing masing desa selanjutnya mempunyai web site dengan domain desa.id yang dapat digunakan untuk mengelola data transaksional di level desa. \n\nKonsorsium Hijau pada Quarter ke-2 bulan Januari, akan melaksanakan analisis kebutuhan (Need assessment / requirement analysis) untuk pengembangan Management Information System &#40;MIS&#41; di tingkat kabupaten. Karena MIS harus mempunyai sumber data yang akurat yang berasal dari sistem informasi transaksional maka implementasi/instalasi Sistem Informasi Desa dan Kawasan menjadi sangat penting dan diperlukan. \n\n Dalam proses implementasi/instalasi SIDeKa, dibutuhkan dukungan tenaga ahli teknik informatika (TI). Dukungan tenaga ahli yang bisa berasal dari mahasiswa ini dimaksudkan untuk melakukan pendampingan pemerintah desa dalam proses instalasi SIDEKA yang berbentuk website dan aplikasi dengan basis data desa. Dalam proses ini mahasiswa juga diharapkan dapat melakukan transfer pengetahuan kepada pengelola SIDeKa. \n','2015-11-17 23:13:32'),(31,'web/c_home/get_detail_berita/28','Kemenkominfo Kembali Meng-online-kan Desa-Desa Terdepan','Jakarta - Kementerian Komunikasi dan Informatika Republik Indonesia (Kominfo) Bekerjasama dengan Universitas Indonesia, ILEAD UI, Prakarsa Desa dan Desa Broadband Terpadu menyelenggarakan Program Pelatihan dan Pendampingan SDM di Desa pada senin hingga jum\'at (2-6/11) di Hotel Acacia Jakarta Pusat. \n\nSebanyak 50 Perwakilan Masyarakat Desa dari Perbatasan Indonesia datang untuk mengikuti kegiatan tersebut. Dari 50 Desa tersebut, mereka mewakili 7 Provinsi yang tersebar di Indonesia antara lain, Papua, Kalimantan Barat, Kalimantan Utara, Nusa Tenggara Timur (NTT), Maluku, Kepulauan Riau dan Riau. \n\nProgram Desa Broadband Terpadu yang diusung oleh Kominfo ini sengaja diperuntukkan bagi Desa Desa Perbatasan di Indonesia yang menjadi Beranda Negara. Karena memang selama ini keberadaan Negara di Daerah Perbatasan masih sangat kurang dirasakan. \n\n\"Kehadiran Program Desa Broadband Terpadu bagi 50 Desa Perbatasan ini adalah saebagai pilot project di tahun 2015 untuk menghadirkan Negara di Batas Indonesia. Jika hal ini dinilai baik, maka kedepan akan ada sekitar 1000 desa yang akan didampingi. Tujuannya adalah untuk meningkatkan produktifitas masyarakat melalui Informatika,\" tegas Mas Dia Febriansyah (Plt. BP3TI Kominfo), Rabu (4/11).\n\nJepriadi\nPendamping Desa Kaliau\' Kec. Sajingan Besar Kab. Sambas - Kalimantan Barat','2015-11-09 21:05:50'),(32,'web/c_home/get_detail_berita/29','Watimpres Dukung Konsorsium Hijau Majukan Desa','<p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Krisis sosial-ekologi yang melanda Indonesia dalam beberapa dekade terakhir memperlihatkan bahwa pembangunan tidak lagi dapat berpijak pada paradigma dan cara yang lama. Salah satu terobosan penting yang berkembang beberapa tahun terakhir ini adalah konsep pembangunan ekonomi dengan karbon rendah (low-carbon economic development) yang bersandar pada gugus pemikiran dan pendekatan yang untuk mudahnya disebut Pengetahuan Hijau (Green Knowledge).</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Dalam beberapa tahun terakhir Pengetahuan Hijau mulai berkembang pesat di berbagai belahan dunia berpijak pada keragaman tradisi dan kebudayaan, pemikiran dan praktek di tingkat lokal. Konsorsium Hijau membawa Pengetahuan Hijau di level desa, yang digunakan untuk meningkatkan kesejahteraan masyarakat desa namun tetap melestarikan alam.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Untuk itulah Konsorsium Hijau melakukan sejumlah pertemuan dalam mempromosikan konsep Pengetahuan Hijau, salah satunya dengan Dewan Pertimbangan Presiden (Watimpres), yang dilaksanakan di Kantor Watimpres Jakarta, pada Jum’at, 30 Oktober lalu. Pertemuan ini dihadiri langsung Prof. Dr. Sri Adiningsih Ketua Dewan Pertimbangan Presiden serta Sidarto Danusubroto Anggota Dewan Pertimbangan Presiden.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Dalam pertemuan ini Konsorsium Hijau memaparkan agenda-agenda yang dilakukan dalam program Pengetahuan Hijau di desa. Dr. Maryatmo, MA Team Leader Konsorsium Hijau mengatakan bahwa saat ini lembaganya telah melakukan pendampingan di 16 desa di 8 Kabupaten di 5 provinsi untuk meningkatkan kapasitas anak-anak muda dalam pengelolaan sumber daya alamnya. “Hal ini penting agar para pemuda bisa meningkatkan kesejahteraan tetapi tidak dengan merusak alam,” ujar Maryatmo.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Sri Adiningsih, menyambut baik atas inisiatif untuk memajukan desa. Hal tersebut sesuai dengan semangat dari Nawacita yang dicanangkan Presiden Joko Widodo. “Pembangunan desa merupakan prioritas pembangunan. Sesuai dengan Nawacita, membangun dari pinggiran,” jelas Adiningsih.</p><p style=\"line-height: 22px; color: rgb(121, 121, 121); font-family: Lato, sans-serif;\">Wantimpres, lanjut Adiningsih, terbuka lebar bagi siapapun untuk bersinergi melaksanakan pembangunan demi kemajuan bangsa dan negara. “Kami pun berkeinginan untuk bisa melihat langsung di lapangan apa yang sudah dilakukan oleh teman-teman,” tandas Guru Besar Fakultas Ekonomi UGM tersebut.** (ET)</p>','2015-11-11 09:21:36');

/*Table structure for table `tbl_ped` */

DROP TABLE IF EXISTS `tbl_ped`;

CREATE TABLE `tbl_ped` (
  `id_ped` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  `luas` float NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  `lokasi` blob,
  `id_ped_sub` int(3) NOT NULL,
  PRIMARY KEY (`id_ped`),
  KEY `id_ped_sub` (`id_ped_sub`),
  KEY `id_ped_sub_2` (`id_ped_sub`),
  KEY `id_penduduk` (`id_penduduk`),
  KEY `id_penduduk_2` (`id_penduduk`),
  CONSTRAINT `tbl_ped_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`),
  CONSTRAINT `tbl_ped_ibfk_2` FOREIGN KEY (`id_ped_sub`) REFERENCES `ref_ped_sub` (`id_ped_sub`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ped` */

/*Table structure for table `tbl_ped_perkebunan` */

DROP TABLE IF EXISTS `tbl_ped_perkebunan`;

CREATE TABLE `tbl_ped_perkebunan` (
  `id_ped_perkebunan` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  `penggarap` varchar(20) NOT NULL,
  `jumlah_penggarap` int(4) NOT NULL,
  `luas` float NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL,
  PRIMARY KEY (`id_ped_perkebunan`),
  KEY `id_dusun` (`id_dusun`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ped_perkebunan` */

insert  into `tbl_ped_perkebunan`(`id_ped_perkebunan`,`deskripsi`,`penggarap`,`jumlah_penggarap`,`luas`,`lokasi`,`id_dusun`) values (1,'Pohon Jarak','Pribadi',10,22,'Utara Embung Tambakboyo',0),(2,'Melon','Buruh',14,33,'-',0),(3,'Salak','Buruh',20,15,'-',0),(4,'Kopi','Pribadi',20,12,'Selatan Kali Bayung',0);

/*Table structure for table `tbl_ped_pertambakan` */

DROP TABLE IF EXISTS `tbl_ped_pertambakan`;

CREATE TABLE `tbl_ped_pertambakan` (
  `id_ped_pertambakan` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  `penggarap` varchar(20) NOT NULL,
  `jumlah_penggarap` int(4) NOT NULL,
  `luas` float NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL,
  PRIMARY KEY (`id_ped_pertambakan`),
  KEY `id_dusun` (`id_dusun`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ped_pertambakan` */

insert  into `tbl_ped_pertambakan`(`id_ped_pertambakan`,`deskripsi`,`penggarap`,`jumlah_penggarap`,`luas`,`lokasi`,`id_dusun`) values (1,'Lele','Pribadi',17,2,'Belakang Rumah Pak Sukarjo',0),(2,'Gurame','Pribadi',2,5,'-',0),(3,'Nila','Buruh',55,23,'-',0);

/*Table structure for table `tbl_ped_pertanian` */

DROP TABLE IF EXISTS `tbl_ped_pertanian`;

CREATE TABLE `tbl_ped_pertanian` (
  `id_ped_pertanian` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  `penggarap` varchar(20) NOT NULL,
  `jumlah_penggarap` int(4) NOT NULL,
  `luas` float NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL,
  PRIMARY KEY (`id_ped_pertanian`),
  KEY `id_dusun` (`id_dusun`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ped_pertanian` */

insert  into `tbl_ped_pertanian`(`id_ped_pertanian`,`deskripsi`,`penggarap`,`jumlah_penggarap`,`luas`,`lokasi`,`id_dusun`) values (3,'Padi','Buruh',150,23,'Belakang Balai Desa, Utara Embung',0),(4,'Kacang Tanah','Pribadi',50,34,'Timur tanah kas desa',0),(5,'Jagung','Pribadi',100,6,'Selatan sungai Winongo',0);

/*Table structure for table `tbl_ped_potensi_wisata` */

DROP TABLE IF EXISTS `tbl_ped_potensi_wisata`;

CREATE TABLE `tbl_ped_potensi_wisata` (
  `id_ped_potensi_wisata` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL,
  PRIMARY KEY (`id_ped_potensi_wisata`),
  KEY `id_dusun` (`id_dusun`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ped_potensi_wisata` */

insert  into `tbl_ped_potensi_wisata`(`id_ped_potensi_wisata`,`deskripsi`,`lokasi`,`id_dusun`) values (1,'Pantai','-',0),(2,'Hutan Lindung','-',0),(3,'Air Terjun','-',0);

/*Table structure for table `tbl_ped_sumber_air` */

DROP TABLE IF EXISTS `tbl_ped_sumber_air`;

CREATE TABLE `tbl_ped_sumber_air` (
  `id_ped_sumber_air` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL,
  PRIMARY KEY (`id_ped_sumber_air`),
  KEY `id_dusun` (`id_dusun`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ped_sumber_air` */

insert  into `tbl_ped_sumber_air`(`id_ped_sumber_air`,`deskripsi`,`lokasi`,`id_dusun`) values (1,'Embung Sungai Winongo','Utara Kantor Lurah',0),(2,'Danau','-',0),(3,'Embung','-',0),(4,'Air Terjun Cijerah','Dekat Hutan Pinus',0),(5,'Water torrent utama dusun','Utara Kantor PKK',0);

/*Table structure for table `tbl_ped_sumber_energi` */

DROP TABLE IF EXISTS `tbl_ped_sumber_energi`;

CREATE TABLE `tbl_ped_sumber_energi` (
  `id_ped_sumber_energi` int(4) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL,
  PRIMARY KEY (`id_ped_sumber_energi`),
  KEY `id_dusun` (`id_dusun`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_ped_sumber_energi` */

insert  into `tbl_ped_sumber_energi`(`id_ped_sumber_energi`,`deskripsi`,`lokasi`,`id_dusun`) values (1,'Pembangkit Listrik Tenaga Matahari','Utara Sungai Winongo',0),(2,'Pembangkit Listrik Kincir Angin','-',0),(3,'Pembangkit Listrik Mikrohidro','-',0),(4,'Pembangkit Listrik Tenaga Air Laut','-',0);

/*Table structure for table `tbl_penduduk` */

DROP TABLE IF EXISTS `tbl_penduduk`;

CREATE TABLE `tbl_penduduk` (
  `id_penduduk` int(10) NOT NULL AUTO_INCREMENT,
  `nik` varchar(25) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(25) DEFAULT NULL,
  `tanggal_lahir` datetime DEFAULT NULL,
  `foto` varchar(50) DEFAULT 'uploads/defaultFotoPenduduk.jpg',
  `no_telp` char(15) DEFAULT 'Tidak Diketahui',
  `email` varchar(50) DEFAULT 'Tidak Diketahui',
  `no_kitas` varchar(25) DEFAULT 'Tidak Diketahui',
  `no_paspor` varchar(25) DEFAULT 'Tidak Diketahui',
  `is_sementara` enum('Y','N') NOT NULL DEFAULT 'Y',
  `id_rt` int(10) DEFAULT '0',
  `id_rw` int(10) DEFAULT '0',
  `id_dusun` int(10) DEFAULT '0',
  `id_pendidikan` int(10) DEFAULT '0',
  `is_bsm` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_agama` int(10) DEFAULT '0',
  `id_goldar` int(10) DEFAULT '0',
  `id_pendidikan_terakhir` int(10) DEFAULT '0',
  `id_jen_kel` int(10) DEFAULT '0',
  `id_kewarganegaraan` int(10) DEFAULT '0',
  `id_pekerjaan` int(10) DEFAULT '0',
  `id_pekerjaan_ped` int(10) DEFAULT '0',
  `id_kompetensi` int(10) DEFAULT '0',
  `id_status_kawin` int(10) DEFAULT '0',
  `id_status_penduduk` int(10) DEFAULT '0',
  `id_status_tinggal` int(10) DEFAULT '0',
  `id_difabilitas` int(10) DEFAULT '0',
  `id_kontrasepsi` int(10) DEFAULT '0',
  `pendapatan_per_bulan` double DEFAULT '0',
  PRIMARY KEY (`id_penduduk`),
  KEY `id_rt` (`id_rt`),
  KEY `id_rw` (`id_rw`),
  KEY `id_dusun` (`id_dusun`),
  KEY `id_pendidikan` (`id_pendidikan`),
  KEY `id_agama` (`id_agama`),
  KEY `id_goldar` (`id_goldar`),
  KEY `id_pendidikan_terakhir` (`id_pendidikan_terakhir`),
  KEY `id_jen_kel` (`id_jen_kel`),
  KEY `id_kewarganegaraan` (`id_kewarganegaraan`),
  KEY `id_pekerjaan` (`id_pekerjaan`),
  KEY `id_pekerjaan_ped` (`id_pekerjaan_ped`),
  KEY `id_kompetensi` (`id_kompetensi`),
  KEY `id_status_kawin` (`id_status_kawin`),
  KEY `id_status_penduduk` (`id_status_penduduk`),
  KEY `id_status_tinggal` (`id_status_tinggal`),
  KEY `id_difabilitas` (`id_difabilitas`),
  KEY `id_kontrasepsi` (`id_kontrasepsi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_penduduk` */

/*Table structure for table `tbl_pengguna` */

DROP TABLE IF EXISTS `tbl_pengguna`;

CREATE TABLE `tbl_pengguna` (
  `id_pengguna` int(10) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `is_delete` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pengguna` */

insert  into `tbl_pengguna`(`id_pengguna`,`nik`,`nama_pengguna`,`password`,`nama`,`no_telepon`,`role`,`foto`,`is_delete`) values (0,'','helpdesk-admin','2ba1a6b1bcaf35adfcfe46a48bfddaea8f15632e','','','Administrator','','Y'),(1,'','helpdesk-pengelola','2ba1a6b1bcaf35adfcfe46a48bfddaea8f15632e','','','Pengelola Data','','Y'),(2,'','sidekaadmin','94359e74e6888e13a9a79800d418bd1aa0121c60','','','Administrator','','N'),(3,'','sidekapengelola','94359e74e6888e13a9a79800d418bd1aa0121c60','','','Pengelola Data','','N'),(4,'','sidekaaset','94359e74e6888e13a9a79800d418bd1aa0121c60','','','Pengelola Aset','','N'),(5,'','sidekapeta','94359e74e6888e13a9a79800d418bd1aa0121c60','','','Pengelola Peta','','N'),(6,'','sidekaperencana','94359e74e6888e13a9a79800d418bd1aa0121c60','','','Perencana Pembangunan','','N');

/*Table structure for table `tbl_perangkat` */

DROP TABLE IF EXISTS `tbl_perangkat`;

CREATE TABLE `tbl_perangkat` (
  `id_perangkat` int(10) NOT NULL AUTO_INCREMENT,
  `nip` varchar(25) NOT NULL,
  `niap` varchar(25) NOT NULL,
  `no_sk_angkat` varchar(50) NOT NULL,
  `tgl_angkat` datetime NOT NULL,
  `id_pangkat_gol` int(11) NOT NULL,
  `no_sk_berhenti` varchar(50) DEFAULT NULL,
  `tgl_berhenti` datetime DEFAULT NULL,
  `id_jabatan` int(10) NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  `is_aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_perangkat`),
  KEY `id_jabatan` (`id_jabatan`),
  KEY `id_penduduk` (`id_penduduk`),
  KEY `id_pangkat_gol` (`id_pangkat_gol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_perangkat` */

/*Table structure for table `tbl_peta` */

DROP TABLE IF EXISTS `tbl_peta`;

CREATE TABLE `tbl_peta` (
  `id_peta` int(4) NOT NULL AUTO_INCREMENT,
  `embed` blob NOT NULL,
  `lokasi` blob NOT NULL,
  `id_desa` int(4) NOT NULL,
  PRIMARY KEY (`id_peta`),
  KEY `id_desa` (`id_desa`),
  CONSTRAINT `tbl_peta_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `ref_desa` (`id_desa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_peta` */

insert  into `tbl_peta`(`id_peta`,`embed`,`lokasi`,`id_desa`) values (1,'{\"zoom\":\"11\",\"center\":\"-2.880119, 108.143380\",\"type\":\"ROADMAP\",\"tampil\":\"true\",\"path_overlayImage\":\"uploads\\/map\\/overlayImage.jpg\",\"point1\":\"-2.969737960601287, 108.0767424187012\",\"point2\":\"-2.8279092104520145, 108.22980548559576\"}','var myCoordinatesBatasWilayah1 = [\r\n\nnew google.maps.LatLng(-2.899153,108.078003),\r\n\nnew google.maps.LatLng(-2.897781,108.093796),\r\n\nnew google.maps.LatLng(-2.895038,108.094397),\r\n\nnew google.maps.LatLng(-2.889809,108.093152),\r\n\nnew google.maps.LatLng(-2.886466,108.101177),\r\n\nnew google.maps.LatLng(-2.874465,108.106842),\r\n\nnew google.maps.LatLng(-2.865121,108.106327),\r\n\nnew google.maps.LatLng(-2.856291,108.105039),\r\n\nnew google.maps.LatLng(-2.846005,108.107958),\r\n\nnew google.maps.LatLng(-2.833317,108.108902),\r\n\nnew google.maps.LatLng(-2.836746,108.132763),\r\n\nnew google.maps.LatLng(-2.832288,108.155336),\r\n\nnew google.maps.LatLng(-2.833831,108.174176),\r\n\nnew google.maps.LatLng(-2.850376,108.184969),\r\n\nnew google.maps.LatLng(-2.866920,108.187523),\r\n\nnew google.maps.LatLng(-2.880293,108.167009),\r\n\nnew google.maps.LatLng(-2.903267,108.171215),\r\n\nnew google.maps.LatLng(-2.919040,108.205719),\r\n\nnew google.maps.LatLng(-2.946813,108.202630),\r\n\nnew google.maps.LatLng(-2.951613,108.194733),\r\n\nnew google.maps.LatLng(-2.958813,108.183060),\r\n\nnew google.maps.LatLng(-2.960185,108.159714),\r\n\nnew google.maps.LatLng(-2.958642,108.141518),\r\n\nnew google.maps.LatLng(-2.963270,108.128815),\r\n\nnew google.maps.LatLng(-2.954013,108.118515),\r\n\nnew google.maps.LatLng(-2.952298,108.099976),\r\n\nnew google.maps.LatLng(-2.927440,108.092937),\r\n\nnew google.maps.LatLng(-2.908753,108.081779)\r\n\n];\r\n\nvar polyOptionsBatasWilayah1 = {\r\n\npath: myCoordinatesBatasWilayah1,\r\n\nstrokeColor: \"#FF0000\",\r\n\nstrokeOpacity: 1,\r\n\nstrokeWeight: 1.5,\r\n\nfillColor: \"#FF0000\",\r\n\nfillOpacity: 0.05,\r\n\nzIndex: -1,\r\n\nposition: new google.maps.LatLng(-2.899153,108.078003)\r\n\n}\r\n\nvar itBatasWilayah1 = new google.maps.Polygon(polyOptionsBatasWilayah1);\r\n\nitBatasWilayah1.setMap(map);\r\n\nvar arrayLoc = [\"-2.899153,108.078003\",\"-2.897781,108.093796\",\"-2.895038,108.094397\",\"-2.889809,108.093152\",\"-2.886466,108.101177\",\"-2.874465,108.106842\",\"-2.865121,108.106327\",\"-2.856291,108.105039\",\"-2.846005,108.107958\",\"-2.833317,108.108902\",\"-2.836746,108.132763\",\"-2.832288,108.155336\",\"-2.833831,108.174176\",\"-2.850376,108.184969\",\"-2.866920,108.187523\",\"-2.880293,108.167009\",\"-2.903267,108.171215\",\"-2.919040,108.205719\",\"-2.946813,108.202630\",\"-2.951613,108.194733\",\"-2.958813,108.183060\",\"-2.960185,108.159714\",\"-2.958642,108.141518\",\"-2.963270,108.128815\",\"-2.954013,108.118515\",\"-2.952298,108.099976\",\"-2.927440,108.092937\",\"-2.908753,108.081779\"];',1);

/*Table structure for table `tbl_pindah_keluar` */

DROP TABLE IF EXISTS `tbl_pindah_keluar`;

CREATE TABLE `tbl_pindah_keluar` (
  `id_pindah_keluar` int(10) NOT NULL AUTO_INCREMENT,
  `tgl_pindah_keluar` datetime NOT NULL,
  `no_kk` varchar(25) NOT NULL,
  `alamat_jalan` varchar(100) NOT NULL,
  `nomor_rt` varchar(5) NOT NULL,
  `nomor_rw` varchar(5) NOT NULL,
  `nama_dusun` varchar(30) NOT NULL,
  `nama_desa` varchar(30) NOT NULL,
  `nama_kecamatan` varchar(30) NOT NULL,
  `nama_kabkota` varchar(30) NOT NULL,
  `nama_provinsi` varchar(30) NOT NULL,
  `id_keluarga` int(10) NOT NULL,
  `id_penduduk` int(10) NOT NULL,
  `id_jenis_pindah` int(10) NOT NULL,
  `id_klasifikasi_pindah` int(10) NOT NULL,
  `id_alasan_pindah` int(10) NOT NULL,
  PRIMARY KEY (`id_pindah_keluar`),
  KEY `id_rt` (`nomor_rt`),
  KEY `id_rw` (`nomor_rw`),
  KEY `id_dusun` (`nama_dusun`),
  KEY `id_desa` (`nama_desa`),
  KEY `id_keluarga` (`id_keluarga`),
  KEY `id_penduduk` (`id_penduduk`),
  KEY `id_jenis_pindah` (`id_jenis_pindah`),
  KEY `id_klasifikasi_pindah` (`id_klasifikasi_pindah`),
  KEY `id_alasan_pindah` (`id_alasan_pindah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pindah_keluar` */

/*Table structure for table `tbl_pindah_masuk` */

DROP TABLE IF EXISTS `tbl_pindah_masuk`;

CREATE TABLE `tbl_pindah_masuk` (
  `id_pindah_masuk` int(10) NOT NULL,
  `tgl_pindah_masuk` datetime NOT NULL,
  `no_kk` varchar(25) NOT NULL,
  `alamat_jalan` varchar(100) NOT NULL,
  `id_rt` int(10) NOT NULL,
  `id_rw` int(10) NOT NULL,
  `id_dusun` int(10) NOT NULL,
  `id_desa` int(10) NOT NULL,
  `id_penduduk` int(10) NOT NULL,
  `id_keluarga` int(10) NOT NULL,
  `id_jenis_pindah` int(10) NOT NULL,
  `id_klasifikasi_pindah` int(10) NOT NULL,
  `id_alasan_pindah` int(10) NOT NULL,
  PRIMARY KEY (`id_pindah_masuk`),
  KEY `id_rt` (`id_rt`),
  KEY `id_rw` (`id_rw`),
  KEY `id_dusun` (`id_dusun`),
  KEY `id_desa` (`id_desa`),
  KEY `id_penduduk` (`id_penduduk`),
  KEY `id_keluarga` (`id_keluarga`),
  KEY `id_jenis_pindah` (`id_jenis_pindah`),
  KEY `id_klasifikasi_pindah` (`id_klasifikasi_pindah`),
  KEY `id_alasan_pindah` (`id_alasan_pindah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_pindah_masuk` */

/*Table structure for table `tbl_regulasi` */

DROP TABLE IF EXISTS `tbl_regulasi`;

CREATE TABLE `tbl_regulasi` (
  `id_regulasi` int(11) NOT NULL,
  `judul_regulasi` varchar(100) NOT NULL,
  `isi_regulasi` varchar(100) NOT NULL,
  `file_regulasi` varchar(100) NOT NULL,
  `id_desa` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_regulasi`),
  KEY `id_desa` (`id_desa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_regulasi` */

insert  into `tbl_regulasi`(`id_regulasi`,`judul_regulasi`,`isi_regulasi`,`file_regulasi`,`id_desa`) values (1,'UUD','Undang Undang Desa','uploads/files/UUD.zip',1),(2,'Peraturan Menteri','Peraturan Menteri Dalam Negri thn 2014','uploads/files/sample.zip',1);

/*Table structure for table `tbl_rp_apbdes` */

DROP TABLE IF EXISTS `tbl_rp_apbdes`;

CREATE TABLE `tbl_rp_apbdes` (
  `id_apbdes` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_apbdes` int(11) DEFAULT NULL,
  `id_top_coa` int(11) DEFAULT NULL,
  `id_coa` int(11) DEFAULT NULL,
  `anggaran` decimal(10,0) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id_apbdes`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_rp_apbdes` */

insert  into `tbl_rp_apbdes`(`id_apbdes`,`id_m_apbdes`,`id_top_coa`,`id_coa`,`anggaran`,`keterangan`) values (1,1,3,21,'650000000',NULL),(17,1,3,7,'200000000',NULL),(18,1,10,41,'200000',NULL);

/*Table structure for table `tbl_rp_lpj` */

DROP TABLE IF EXISTS `tbl_rp_lpj`;

CREATE TABLE `tbl_rp_lpj` (
  `id_lpj` int(11) NOT NULL AUTO_INCREMENT,
  `penerima` varchar(100) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `tgl_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_lpj`),
  KEY `id_spp` (`id_spp`),
  KEY `id_spp_2` (`id_spp`),
  CONSTRAINT `tbl_rp_lpj_ibfk_1` FOREIGN KEY (`id_spp`) REFERENCES `tbl_rp_spp` (`id_spp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rp_lpj` */

/*Table structure for table `tbl_rp_m_apbdes` */

DROP TABLE IF EXISTS `tbl_rp_m_apbdes`;

CREATE TABLE `tbl_rp_m_apbdes` (
  `id_m_apbdes` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_rkp` int(11) DEFAULT NULL,
  `total_pendapatan` decimal(10,0) DEFAULT NULL,
  `total_belanja` decimal(10,0) DEFAULT NULL,
  `total_pembiayaan` decimal(10,0) DEFAULT NULL,
  `tanggal_disetujui` date DEFAULT NULL,
  `disetujui_oleh` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id_m_apbdes`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_rp_m_apbdes` */

insert  into `tbl_rp_m_apbdes`(`id_m_apbdes`,`id_m_rkp`,`total_pendapatan`,`total_belanja`,`total_pembiayaan`,`tanggal_disetujui`,`disetujui_oleh`) values (1,1,'850000000','200000',NULL,'2016-02-10','asdf');

/*Table structure for table `tbl_rp_m_rancangan_rpjm_desa` */

DROP TABLE IF EXISTS `tbl_rp_m_rancangan_rpjm_desa`;

CREATE TABLE `tbl_rp_m_rancangan_rpjm_desa` (
  `id_m_rancangan_rpjm_desa` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_awal` smallint(5) DEFAULT NULL,
  `tahun_akhir` smallint(5) DEFAULT NULL,
  `tahun_anggaran` varchar(20) DEFAULT NULL,
  `nama_file` varchar(80) DEFAULT NULL,
  `total_bidang_1` decimal(20,0) DEFAULT NULL,
  `total_bidang_2` decimal(20,0) DEFAULT NULL,
  `total_bidang_3` decimal(20,0) DEFAULT NULL,
  `total_bidang_4` decimal(20,0) DEFAULT NULL,
  `total_keseluruhan` decimal(20,0) DEFAULT NULL,
  `tanggal_disusun` date DEFAULT NULL,
  `disusun_oleh` varchar(80) DEFAULT NULL,
  `kepala_desa` varchar(80) DEFAULT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_kab_kota` int(11) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_m_rancangan_rpjm_desa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_rp_m_rancangan_rpjm_desa` */

insert  into `tbl_rp_m_rancangan_rpjm_desa`(`id_m_rancangan_rpjm_desa`,`tahun_awal`,`tahun_akhir`,`tahun_anggaran`,`nama_file`,`total_bidang_1`,`total_bidang_2`,`total_bidang_3`,`total_bidang_4`,`total_keseluruhan`,`tanggal_disusun`,`disusun_oleh`,`kepala_desa`,`id_desa`,`id_kecamatan`,`id_kab_kota`,`id_provinsi`) values (1,2016,2021,'2016 - 2021','rpjm_rpjm_desa_contoh_format_standar15-02-2016_225732.xls','2381700000','28600900000','1845000000','3900000000','36727600000',NULL,NULL,NULL,2,2,2,2),(2,2021,2027,'2021 - 2027',NULL,NULL,NULL,NULL,NULL,'0','2016-02-16','tjokro','tjokro',2,2,2,2),(3,2027,2033,'2027 - 2033',NULL,'300201600',NULL,NULL,NULL,'300201600','2016-02-15','Hunting Sunyoto','Hunting Sunyoto',2,2,2,2);

/*Table structure for table `tbl_rp_m_rkp` */

DROP TABLE IF EXISTS `tbl_rp_m_rkp`;

CREATE TABLE `tbl_rp_m_rkp` (
  `id_m_rkp` int(11) NOT NULL AUTO_INCREMENT,
  `id_m_rancangan_rpjm_desa` int(11) DEFAULT NULL,
  `total_bidang_1` decimal(10,0) DEFAULT NULL,
  `total_bidang_2` decimal(10,0) DEFAULT NULL,
  `total_bidang_3` decimal(10,0) DEFAULT NULL,
  `total_bidang_4` decimal(10,0) DEFAULT NULL,
  `total_keseluruhan` decimal(10,0) DEFAULT NULL,
  `rkp_tahun` smallint(6) DEFAULT NULL,
  `nama_file` varchar(80) DEFAULT NULL,
  `kepala_desa` varchar(80) DEFAULT NULL,
  `disusun_oleh` varchar(80) DEFAULT NULL,
  `tanggal_disusun` date DEFAULT NULL,
  PRIMARY KEY (`id_m_rkp`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_rp_m_rkp` */

insert  into `tbl_rp_m_rkp`(`id_m_rkp`,`id_m_rancangan_rpjm_desa`,`total_bidang_1`,`total_bidang_2`,`total_bidang_3`,`total_bidang_4`,`total_keseluruhan`,`rkp_tahun`,`nama_file`,`kepala_desa`,`disusun_oleh`,`tanggal_disusun`) values (1,3,'310000',NULL,NULL,NULL,'310000',2027,NULL,'sadfas','asdf','2016-02-18');

/*Table structure for table `tbl_rp_rabdes` */

DROP TABLE IF EXISTS `tbl_rp_rabdes`;

CREATE TABLE `tbl_rp_rabdes` (
  `id_rabdes` int(11) NOT NULL AUTO_INCREMENT,
  `kegiatan` varchar(100) NOT NULL,
  `waktu_pelaksanaan_awal` date DEFAULT NULL,
  `waktu_pelaksanaan_akhir` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `id_tahun_anggaran` int(11) NOT NULL,
  `id_rkpdes` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nik` varchar(25) DEFAULT NULL,
  `id_perangkat` int(11) NOT NULL,
  `nip` varchar(25) DEFAULT NULL,
  `tgl_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rabdes`),
  KEY `id_tahun_anggaran` (`id_tahun_anggaran`),
  KEY `id_rkpdes` (`id_rkpdes`),
  KEY `id_pengguna` (`id_pengguna`),
  KEY `id_perangkat` (`id_perangkat`),
  CONSTRAINT `tbl_rp_rabdes_ibfk_1` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `ref_rp_tahun_anggaran` (`id_tahun_anggaran`),
  CONSTRAINT `tbl_rp_rabdes_ibfk_2` FOREIGN KEY (`id_rkpdes`) REFERENCES `tbl_rp_rkpdes` (`id_rkpdes`),
  CONSTRAINT `tbl_rp_rabdes_ibfk_3` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pengguna` (`id_pengguna`),
  CONSTRAINT `tbl_rp_rabdes_ibfk_4` FOREIGN KEY (`id_perangkat`) REFERENCES `tbl_perangkat` (`id_perangkat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rp_rabdes` */

/*Table structure for table `tbl_rp_rabdes_anggaran` */

DROP TABLE IF EXISTS `tbl_rp_rabdes_anggaran`;

CREATE TABLE `tbl_rp_rabdes_anggaran` (
  `id_rabdes_anggaran` int(11) NOT NULL AUTO_INCREMENT,
  `uraian` varchar(100) DEFAULT NULL,
  `volume` varchar(30) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `id_rabdes` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `tgl_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rabdes_anggaran`),
  KEY `id_rabdes` (`id_rabdes`),
  CONSTRAINT `tbl_rp_rabdes_anggaran_ibfk_1` FOREIGN KEY (`id_rabdes`) REFERENCES `tbl_rp_rabdes` (`id_rabdes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rp_rabdes_anggaran` */

/*Table structure for table `tbl_rp_rancangan_rpjm_desa` */

DROP TABLE IF EXISTS `tbl_rp_rancangan_rpjm_desa`;

CREATE TABLE `tbl_rp_rancangan_rpjm_desa` (
  `id_rancangan_rpjm_desa` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi_rt_rw` varchar(100) DEFAULT NULL,
  `prakiraan_volume` varchar(100) DEFAULT NULL,
  `sasaran_manfaat` text,
  `tahun_pelaksanaan_1` smallint(5) DEFAULT NULL,
  `tahun_pelaksanaan_2` smallint(5) DEFAULT NULL,
  `tahun_pelaksanaan_3` smallint(5) DEFAULT NULL,
  `tahun_pelaksanaan_4` smallint(5) DEFAULT NULL,
  `tahun_pelaksanaan_5` smallint(5) DEFAULT NULL,
  `tahun_pelaksanaan_6` smallint(5) DEFAULT NULL,
  `jumlah_biaya` decimal(20,0) DEFAULT NULL,
  `sumber_dana` text,
  `swakelola` tinyint(2) DEFAULT NULL,
  `kerjasama_antar_desa` tinyint(2) DEFAULT NULL,
  `kerjasama_pihak_ketiga` tinyint(2) DEFAULT NULL,
  `tahun_awal` varchar(5) DEFAULT NULL,
  `tahun_akhir` varchar(5) DEFAULT NULL,
  `id_bidang` int(11) DEFAULT NULL,
  `id_sub_bidang` int(11) DEFAULT NULL,
  `id_coa` int(11) DEFAULT NULL,
  `id_sumber_dana_desa` int(11) DEFAULT NULL,
  `id_tahun_anggaran` int(11) DEFAULT NULL,
  `id_m_rancangan_rpjm_desa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rancangan_rpjm_desa`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_rp_rancangan_rpjm_desa` */

insert  into `tbl_rp_rancangan_rpjm_desa`(`id_rancangan_rpjm_desa`,`lokasi_rt_rw`,`prakiraan_volume`,`sasaran_manfaat`,`tahun_pelaksanaan_1`,`tahun_pelaksanaan_2`,`tahun_pelaksanaan_3`,`tahun_pelaksanaan_4`,`tahun_pelaksanaan_5`,`tahun_pelaksanaan_6`,`jumlah_biaya`,`sumber_dana`,`swakelola`,`kerjasama_antar_desa`,`kerjasama_pihak_ketiga`,`tahun_awal`,`tahun_akhir`,`id_bidang`,`id_sub_bidang`,`id_coa`,`id_sumber_dana_desa`,`id_tahun_anggaran`,`id_m_rancangan_rpjm_desa`) values (1,'fasdf','asdf','asdf',0,2028,2029,0,0,0,'400','asdf',1,1,NULL,NULL,NULL,35,36,37,1,NULL,3),(2,'fasdf','asdf','asdf',0,2028,2029,0,0,0,'400','asdf',1,1,NULL,NULL,NULL,35,36,37,1,NULL,3),(3,'fasdf','asdf','asdf',0,2028,2029,0,0,0,'400','asdf',1,1,NULL,NULL,NULL,35,36,37,1,NULL,3),(4,'fasdf','asdf','asdf',0,2028,2029,0,0,0,'400','asdf',1,1,NULL,NULL,NULL,35,36,37,1,NULL,3),(5,'fasdfasdf','1asb asd','asdfasdf',2027,0,0,0,2031,2032,'300000000','asdfasdf',1,NULL,1,NULL,NULL,35,36,37,1,NULL,3),(6,'asdfa','asasdf','asdf',2027,2028,2029,0,0,0,'200000',NULL,1,1,NULL,NULL,NULL,35,36,37,1,NULL,3);

/*Table structure for table `tbl_rp_rkp` */

DROP TABLE IF EXISTS `tbl_rp_rkp`;

CREATE TABLE `tbl_rp_rkp` (
  `id_rkp` int(11) NOT NULL AUTO_INCREMENT,
  `id_rancangan_rpjm_desa` int(11) DEFAULT NULL,
  `id_bidang` int(11) DEFAULT NULL,
  `id_m_rkp` int(11) DEFAULT NULL,
  `jenis_kegiatan` varchar(200) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `volume` varchar(100) DEFAULT NULL,
  `sasaran_manfaat` text,
  `waktu_pelaksanaan` varchar(100) DEFAULT NULL,
  `jumlah_biaya` decimal(10,0) DEFAULT NULL,
  `rencana_pelaksanaan_kegiatan` text,
  `swakelola` tinyint(4) DEFAULT NULL,
  `kerjasama_antar_desa` tinyint(4) DEFAULT NULL,
  `kerjasama_pihak_ketiga` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_rkp`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_rp_rkp` */

insert  into `tbl_rp_rkp`(`id_rkp`,`id_rancangan_rpjm_desa`,`id_bidang`,`id_m_rkp`,`jenis_kegiatan`,`lokasi`,`volume`,`sasaran_manfaat`,`waktu_pelaksanaan`,`jumlah_biaya`,`rencana_pelaksanaan_kegiatan`,`swakelola`,`kerjasama_antar_desa`,`kerjasama_pihak_ketiga`) values (1,6,35,1,'Belanja Pegawai','asdfa','asasdf','asdf','Agustus 2016','100000','bersama',1,NULL,NULL),(2,5,35,1,'Belanja Pegawai','fasdfasdf','1asb asd','asdfasdf','asdf','210000',NULL,1,1,NULL);

/*Table structure for table `tbl_rp_rkpdes` */

DROP TABLE IF EXISTS `tbl_rp_rkpdes`;

CREATE TABLE `tbl_rp_rkpdes` (
  `id_rkpdes` int(11) NOT NULL AUTO_INCREMENT,
  `program` varchar(100) NOT NULL,
  `indikator` varchar(100) DEFAULT NULL,
  `kondisi_awal` varchar(100) DEFAULT NULL,
  `target` varchar(100) DEFAULT NULL,
  `volume` varchar(10) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `nominal` int(25) DEFAULT NULL,
  `id_parent_rkpdes` int(11) DEFAULT NULL,
  `id_top_rkpdes` int(11) DEFAULT NULL,
  `id_rpjmdes` int(11) NOT NULL,
  `id_tahun_anggaran` int(11) NOT NULL,
  `id_sumber_dana` int(11) DEFAULT NULL,
  `id_bidang` int(11) DEFAULT NULL,
  `id_coa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rkpdes`),
  KEY `id_parent_rkpdes` (`id_parent_rkpdes`),
  KEY `id_rpjmdes` (`id_rpjmdes`),
  KEY `id_tahun_anggaran` (`id_tahun_anggaran`,`id_sumber_dana`,`id_bidang`,`id_coa`),
  KEY `id_sumber_dana` (`id_sumber_dana`),
  KEY `id_bidang` (`id_bidang`),
  KEY `id_coa` (`id_coa`),
  CONSTRAINT `tbl_rp_rkpdes_ibfk_1` FOREIGN KEY (`id_parent_rkpdes`) REFERENCES `tbl_rp_rkpdes` (`id_rkpdes`),
  CONSTRAINT `tbl_rp_rkpdes_ibfk_2` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `ref_rp_tahun_anggaran` (`id_tahun_anggaran`),
  CONSTRAINT `tbl_rp_rkpdes_ibfk_3` FOREIGN KEY (`id_rpjmdes`) REFERENCES `tbl_rp_rpjmdes` (`id_rpjmdes`),
  CONSTRAINT `tbl_rp_rkpdes_ibfk_4` FOREIGN KEY (`id_sumber_dana`) REFERENCES `ref_rp_sumber_dana` (`id_sumber_dana`),
  CONSTRAINT `tbl_rp_rkpdes_ibfk_5` FOREIGN KEY (`id_bidang`) REFERENCES `ref_rp_bidang` (`id_bidang`),
  CONSTRAINT `tbl_rp_rkpdes_ibfk_6` FOREIGN KEY (`id_coa`) REFERENCES `ref_rp_coa` (`id_coa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rp_rkpdes` */

insert  into `tbl_rp_rkpdes`(`id_rkpdes`,`program`,`indikator`,`kondisi_awal`,`target`,`volume`,`lokasi`,`nominal`,`id_parent_rkpdes`,`id_top_rkpdes`,`id_rpjmdes`,`id_tahun_anggaran`,`id_sumber_dana`,`id_bidang`,`id_coa`) values (1,'asdf','asdf','asdf','asdf',NULL,'asdf',2000000,NULL,NULL,1,4,3,30,21);

/*Table structure for table `tbl_rp_rpjmd` */

DROP TABLE IF EXISTS `tbl_rp_rpjmd`;

CREATE TABLE `tbl_rp_rpjmd` (
  `id_rpjmd` int(11) NOT NULL AUTO_INCREMENT,
  `program` varchar(100) NOT NULL,
  `kondisi_awal` varchar(50) DEFAULT NULL,
  `target` varchar(50) DEFAULT NULL,
  `id_parent_rpjmd` int(11) DEFAULT NULL,
  `id_top_rpjmd` int(11) DEFAULT NULL,
  `id_tahun_anggaran` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_rpjmd`),
  KEY `id_rpjmd` (`id_rpjmd`),
  KEY `id_parent_rpjmd` (`id_parent_rpjmd`),
  KEY `id_tahun` (`id_tahun_anggaran`),
  KEY `id_tahun_2` (`id_tahun_anggaran`),
  KEY `id_child_rpjmd` (`id_top_rpjmd`),
  CONSTRAINT `tbl_rp_rpjmd_ibfk_1` FOREIGN KEY (`id_parent_rpjmd`) REFERENCES `tbl_rp_rpjmd` (`id_rpjmd`),
  CONSTRAINT `tbl_rp_rpjmd_ibfk_2` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `ref_rp_tahun_anggaran` (`id_tahun_anggaran`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rp_rpjmd` */

insert  into `tbl_rp_rpjmd`(`id_rpjmd`,`program`,`kondisi_awal`,`target`,`id_parent_rpjmd`,`id_top_rpjmd`,`id_tahun_anggaran`) values (1,'a','a','a',NULL,NULL,5);

/*Table structure for table `tbl_rp_rpjmdes` */

DROP TABLE IF EXISTS `tbl_rp_rpjmdes`;

CREATE TABLE `tbl_rp_rpjmdes` (
  `id_rpjmdes` int(11) NOT NULL AUTO_INCREMENT,
  `program` varchar(100) NOT NULL,
  `indikator` varchar(100) DEFAULT NULL,
  `kondisi_awal` varchar(50) DEFAULT NULL,
  `target` varchar(50) DEFAULT NULL,
  `capaian` varchar(100) DEFAULT NULL,
  `id_parent_rpjmdes` int(11) DEFAULT NULL,
  `id_top_rpjmdes` int(11) DEFAULT NULL,
  `id_rpjmd` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL,
  PRIMARY KEY (`id_rpjmdes`),
  KEY `id_parent_rpjmdes` (`id_parent_rpjmdes`),
  KEY `id_rpjmd` (`id_rpjmd`),
  KEY `id_periode` (`id_periode`),
  KEY `id_periode_2` (`id_periode`),
  KEY `id_bidang` (`id_bidang`),
  KEY `id_rpjmd_2` (`id_rpjmd`),
  KEY `id_periode_3` (`id_periode`),
  KEY `id_bidang_2` (`id_bidang`),
  KEY `id_parent_rpjmdes_2` (`id_parent_rpjmdes`),
  KEY `id_periode_4` (`id_periode`),
  CONSTRAINT `tbl_rp_rpjmdes_ibfk_1` FOREIGN KEY (`id_parent_rpjmdes`) REFERENCES `tbl_rp_rpjmdes` (`id_rpjmdes`),
  CONSTRAINT `tbl_rp_rpjmdes_ibfk_2` FOREIGN KEY (`id_rpjmd`) REFERENCES `tbl_rp_rpjmd` (`id_rpjmd`),
  CONSTRAINT `tbl_rp_rpjmdes_ibfk_3` FOREIGN KEY (`id_periode`) REFERENCES `ref_rp_periode` (`id_periode`),
  CONSTRAINT `tbl_rp_rpjmdes_ibfk_4` FOREIGN KEY (`id_bidang`) REFERENCES `ref_rp_bidang` (`id_bidang`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rp_rpjmdes` */

insert  into `tbl_rp_rpjmdes`(`id_rpjmdes`,`program`,`indikator`,`kondisi_awal`,`target`,`capaian`,`id_parent_rpjmdes`,`id_top_rpjmdes`,`id_rpjmd`,`id_periode`,`id_bidang`) values (1,'asdf','asdf','asdf','asdf','asdf',NULL,NULL,1,4,30);

/*Table structure for table `tbl_rp_rpjmdes_detail` */

DROP TABLE IF EXISTS `tbl_rp_rpjmdes_detail`;

CREATE TABLE `tbl_rp_rpjmdes_detail` (
  `id_rpjmdes_detail` int(11) NOT NULL AUTO_INCREMENT,
  `volume` varchar(10) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `nominal` double NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `id_rpjmdes` int(11) NOT NULL,
  `id_tahun_anggaran` int(11) NOT NULL,
  PRIMARY KEY (`id_rpjmdes_detail`),
  KEY `id_rpjmdes` (`id_rpjmdes`),
  KEY `id_tahun_anggaran` (`id_tahun_anggaran`),
  CONSTRAINT `tbl_rp_rpjmdes_detail_ibfk_1` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `ref_rp_tahun_anggaran` (`id_tahun_anggaran`),
  CONSTRAINT `tbl_rp_rpjmdes_detail_ibfk_2` FOREIGN KEY (`id_rpjmdes`) REFERENCES `tbl_rp_rpjmdes` (`id_rpjmdes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rp_rpjmdes_detail` */

/*Table structure for table `tbl_rp_spp` */

DROP TABLE IF EXISTS `tbl_rp_spp`;

CREATE TABLE `tbl_rp_spp` (
  `id_spp` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_ambil` date NOT NULL,
  `total` int(25) DEFAULT NULL,
  `id_rabdes` int(11) NOT NULL,
  `tgl_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_spp`),
  KEY `id_rabdes` (`id_rabdes`),
  CONSTRAINT `tbl_rp_spp_ibfk_1` FOREIGN KEY (`id_rabdes`) REFERENCES `tbl_rp_rabdes` (`id_rabdes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rp_spp` */

/*Table structure for table `tbl_rp_spp_detail` */

DROP TABLE IF EXISTS `tbl_rp_spp_detail`;

CREATE TABLE `tbl_rp_spp_detail` (
  `id_spp_detail` int(11) NOT NULL AUTO_INCREMENT,
  `pagu_anggaran` int(25) DEFAULT NULL,
  `pencairan_yg_lalu` int(25) DEFAULT '0',
  `permintaan_sekarang` int(25) DEFAULT NULL,
  `jumlah_saat_ini` int(25) DEFAULT NULL,
  `sisa_dana` int(25) DEFAULT NULL,
  `id_spp` int(11) NOT NULL,
  `id_rabdes_anggaran` int(11) NOT NULL,
  PRIMARY KEY (`id_spp_detail`),
  KEY `id_spp` (`id_spp`),
  KEY `id_rabdes_anggaran` (`id_rabdes_anggaran`),
  CONSTRAINT `tbl_rp_spp_detail_ibfk_1` FOREIGN KEY (`id_spp`) REFERENCES `tbl_rp_spp` (`id_spp`),
  CONSTRAINT `tbl_rp_spp_detail_ibfk_2` FOREIGN KEY (`id_rabdes_anggaran`) REFERENCES `tbl_rp_rabdes_anggaran` (`id_rabdes_anggaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_rp_spp_detail` */

/*Table structure for table `tbl_sejarah` */

DROP TABLE IF EXISTS `tbl_sejarah`;

CREATE TABLE `tbl_sejarah` (
  `id_sejarah` int(10) NOT NULL,
  `id_pengguna` int(10) NOT NULL,
  `isi_sejarah` blob NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto_banner` varchar(50) NOT NULL,
  PRIMARY KEY (`id_sejarah`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_sejarah` */

insert  into `tbl_sejarah`(`id_sejarah`,`id_pengguna`,`isi_sejarah`,`waktu`,`foto_banner`) values (1,2,'','2015-04-11 17:02:16','uploads/web/foto_banner_sejarah.jpg');

/*Table structure for table `tbl_slider_beranda` */

DROP TABLE IF EXISTS `tbl_slider_beranda`;

CREATE TABLE `tbl_slider_beranda` (
  `id_slider_beranda` int(11) NOT NULL AUTO_INCREMENT,
  `konten_background` varchar(100) NOT NULL,
  `konten_logo` varchar(100) NOT NULL,
  `konten_teks` varchar(100) NOT NULL,
  PRIMARY KEY (`id_slider_beranda`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_slider_beranda` */

insert  into `tbl_slider_beranda`(`id_slider_beranda`,`konten_background`,`konten_logo`,`konten_teks`) values (1,'uploads/web/slider_beranda/background_1d9.jpg','uploads/web/slider_beranda/logo_1d9.png','[SISTEM INFORMASI DESA DAN KAWASAN]'),(2,'uploads/web/slider_beranda/background_e91.jpg','uploads/web/slider_beranda/logo_e91.png','SIDeKa ver 1.6');

/*Table structure for table `tbl_sso` */

DROP TABLE IF EXISTS `tbl_sso`;

CREATE TABLE `tbl_sso` (
  `id_sso` int(4) NOT NULL,
  `app_id` varchar(50) NOT NULL,
  `token_app` varchar(50) NOT NULL,
  PRIMARY KEY (`id_sso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_sso` */

insert  into `tbl_sso`(`id_sso`,`app_id`,`token_app`) values (1,'sideka','416f1eb633f057873053d8a203eb6b92');

/*Table structure for table `tbl_surat` */

DROP TABLE IF EXISTS `tbl_surat`;

CREATE TABLE `tbl_surat` (
  `id_surat` int(10) NOT NULL,
  `nomor_surat` varchar(25) NOT NULL,
  `tgl_surat` datetime NOT NULL,
  `tgl_awal` datetime NOT NULL,
  `tgl_akhir` datetime NOT NULL,
  `nomor_registrasi` int(10) NOT NULL,
  `judul_surat` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `kata_penutup` text NOT NULL,
  `kode_surat` int(10) NOT NULL DEFAULT '0',
  `id_perangkat` int(10) NOT NULL,
  `id_penduduk` int(10) NOT NULL,
  PRIMARY KEY (`id_surat`),
  KEY `id_perangkat` (`id_perangkat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_surat` */

/*Table structure for table `tbl_visi_misi` */

DROP TABLE IF EXISTS `tbl_visi_misi`;

CREATE TABLE `tbl_visi_misi` (
  `id_visi_misi` int(10) NOT NULL,
  `id_pengguna` int(10) NOT NULL,
  `isi_visi_misi` blob NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto_banner` varchar(50) NOT NULL,
  PRIMARY KEY (`id_visi_misi`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_visi_misi` */

insert  into `tbl_visi_misi`(`id_visi_misi`,`id_pengguna`,`isi_visi_misi`,`waktu`,`foto_banner`) values (1,2,'','2015-04-11 17:02:27','uploads/web/foto_banner_visimisi.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
