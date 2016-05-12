-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Mei 2016 pada 10.06
-- Versi Server: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sideka9`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_agama`
--

CREATE TABLE `ref_agama` (
  `id_agama` int(5) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `is_diakui` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_agama`
--

INSERT INTO `ref_agama` (`id_agama`, `deskripsi`, `is_diakui`) VALUES
(0, 'Tidak Diketahui', 'Y'),
(1, 'Islam', 'Y'),
(2, 'Kristen', 'Y'),
(3, 'Katholik', 'Y'),
(4, 'Hindu', 'Y'),
(5, 'Budha', 'Y'),
(6, 'Konghucu', 'Y'),
(7, 'Aliran Kepercayaan Kepada Tuhan YME', 'N'),
(8, 'Aliran Kepercayaan Lainnya', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_alasan_pindah`
--

CREATE TABLE `ref_alasan_pindah` (
  `id_alasan_pindah` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_alasan_pindah`
--

INSERT INTO `ref_alasan_pindah` (`id_alasan_pindah`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Tidak Diketahui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_asal_aset`
--

CREATE TABLE `ref_asal_aset` (
  `id_asal_aset` int(4) NOT NULL,
  `deskripsi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_asal_aset`
--

INSERT INTO `ref_asal_aset` (`id_asal_aset`, `deskripsi`) VALUES
(1, 'Pembelian'),
(2, 'Hibah / Wakaf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_desa`
--

CREATE TABLE `ref_desa` (
  `id_desa` int(10) NOT NULL,
  `kode_desa_bps` char(20) NOT NULL,
  `kode_desa_kemendagri` char(20) NOT NULL,
  `nama_desa` varchar(50) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_kecamatan` int(10) NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  `alamat_desa` text,
  `kode_pos` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_desa`
--

INSERT INTO `ref_desa` (`id_desa`, `kode_desa_bps`, `kode_desa_kemendagri`, `nama_desa`, `luas_wilayah`, `id_kecamatan`, `id_penduduk`, `alamat_desa`, `kode_pos`) VALUES
(0, '0', '0', 'Tidak Diketahui', 0, 0, NULL, '0', '0'),
(1, '34.03.03.31', '34.03.03.31', 'Ngawun', 97.5, 1, NULL, 'Jl. Merdeka No 45', '97'),
(2, '02.38.01.01', '02.38.01.01', 'Kiarajangkung', 0, 2, NULL, 'l Jl Merdeka', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_difabilitas`
--

CREATE TABLE `ref_difabilitas` (
  `id_difabilitas` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_difabilitas`
--

INSERT INTO `ref_difabilitas` (`id_difabilitas`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Tidak Cacat'),
(2, 'Cacat Fisik'),
(3, 'Cacat Netra / Buta'),
(4, 'Cacat Rungu / Wicara'),
(5, 'Cacat Mental / Jiwa'),
(6, 'Cacat Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_dusun`
--

CREATE TABLE `ref_dusun` (
  `id_dusun` int(10) NOT NULL,
  `kode_dusun_bps` char(20) NOT NULL,
  `kode_dusun_kemendagri` char(20) NOT NULL,
  `nama_dusun` varchar(50) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_desa` int(10) NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_dusun`
--

INSERT INTO `ref_dusun` (`id_dusun`, `kode_dusun_bps`, `kode_dusun_kemendagri`, `nama_dusun`, `luas_wilayah`, `id_desa`, `id_penduduk`) VALUES
(0, '0', '0', 'Tidak Diketahui', 0, 0, NULL),
(1, '121', '121', 'Sumberjo', 5000, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_goldar`
--

CREATE TABLE `ref_goldar` (
  `id_goldar` int(10) NOT NULL,
  `deskripsi` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_goldar`
--

INSERT INTO `ref_goldar` (`id_goldar`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'A'),
(2, 'A+'),
(3, 'A-'),
(4, 'B'),
(5, 'B+'),
(6, 'B-'),
(7, 'AB'),
(8, 'AB+'),
(9, 'AB-'),
(10, 'O'),
(11, 'O+'),
(12, 'O-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_jabatan`
--

CREATE TABLE `ref_jabatan` (
  `id_jabatan` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_jabatan`
--

INSERT INTO `ref_jabatan` (`id_jabatan`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Kepala Desa'),
(3, 'Sekretaris Desa'),
(5, 'Bendahara Desa'),
(6, 'Kaur Kesejahteraan Rakyat'),
(7, 'Kaur Pemerintahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_jenis_pindah`
--

CREATE TABLE `ref_jenis_pindah` (
  `id_jenis_pindah` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_jenis_pindah`
--

INSERT INTO `ref_jenis_pindah` (`id_jenis_pindah`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Tidak Diketahui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_jen_kel`
--

CREATE TABLE `ref_jen_kel` (
  `id_jen_kel` int(2) NOT NULL,
  `deskripsi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_jen_kel`
--

INSERT INTO `ref_jen_kel` (`id_jen_kel`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Laki - laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kab_kota`
--

CREATE TABLE `ref_kab_kota` (
  `id_kab_kota` int(10) NOT NULL,
  `kode_kab_kota_bps` char(10) NOT NULL,
  `kode_kab_kota_kemendagri` char(10) NOT NULL,
  `nama_kab_kota` varchar(50) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_provinsi` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_kab_kota`
--

INSERT INTO `ref_kab_kota` (`id_kab_kota`, `kode_kab_kota_bps`, `kode_kab_kota_kemendagri`, `nama_kab_kota`, `luas_wilayah`, `id_provinsi`) VALUES
(0, '0', '0', 'Tidak Diketahui', 0, 0),
(1, '34.03', '34.03', 'Gunungkidul', 1485.36, 1),
(2, '02.38', '02.38', 'Kab. Tasikmalaya', 9345, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kategori_aset`
--

CREATE TABLE `ref_kategori_aset` (
  `id_kategori_aset` int(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_kategori_aset`
--

INSERT INTO `ref_kategori_aset` (`id_kategori_aset`, `deskripsi`) VALUES
(1, 'Peralatan Pendukung'),
(2, 'Furniture'),
(3, 'Operasional Kantor'),
(4, 'Peralatan Pendukung Kegiatan'),
(5, 'Alat Transportasi'),
(6, 'Alat Komunikasi'),
(7, 'Peralatan Lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kecamatan`
--

CREATE TABLE `ref_kecamatan` (
  `id_kecamatan` int(10) NOT NULL,
  `kode_kecamatan_bps` char(10) NOT NULL,
  `kode_kecamatan_kemendagri` char(10) NOT NULL,
  `nama_kecamatan` varchar(50) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_kab_kota` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_kecamatan`
--

INSERT INTO `ref_kecamatan` (`id_kecamatan`, `kode_kecamatan_bps`, `kode_kecamatan_kemendagri`, `nama_kecamatan`, `luas_wilayah`, `id_kab_kota`) VALUES
(0, '0', '0', 'Tidak Diketahui', 0, 0),
(1, '34.03.03', '34.03.03', 'Plajen', 0, 1),
(2, '02.38.01', '02.38.01', 'Sukahening', 0, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kelas_sosial`
--

CREATE TABLE `ref_kelas_sosial` (
  `id_kelas_sosial` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_kelas_sosial`
--

INSERT INTO `ref_kelas_sosial` (`id_kelas_sosial`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Kaya'),
(2, 'Sedang'),
(3, 'Miskin'),
(4, 'Sangat Miskin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kepemilikan_aset`
--

CREATE TABLE `ref_kepemilikan_aset` (
  `id_kepemilikan_aset` int(4) NOT NULL,
  `deskripsi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_kepemilikan_aset`
--

INSERT INTO `ref_kepemilikan_aset` (`id_kepemilikan_aset`, `deskripsi`) VALUES
(1, 'Milik Sendiri'),
(2, 'Sewa'),
(3, 'Sedang Sengketa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kewarganegaraan`
--

CREATE TABLE `ref_kewarganegaraan` (
  `id_kewarganegaraan` int(15) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_kewarganegaraan`
--

INSERT INTO `ref_kewarganegaraan` (`id_kewarganegaraan`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'WNI'),
(2, 'WNA'),
(3, 'DWIKEWARGANEGARAAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_klasifikasi_pindah`
--

CREATE TABLE `ref_klasifikasi_pindah` (
  `id_klasifikasi_pindah` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_klasifikasi_pindah`
--

INSERT INTO `ref_klasifikasi_pindah` (`id_klasifikasi_pindah`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Tidak Diketahui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kode_surat`
--

CREATE TABLE `ref_kode_surat` (
  `kode_surat` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `supra_kode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_kode_surat`
--

INSERT INTO `ref_kode_surat` (`kode_surat`, `deskripsi`, `supra_kode`) VALUES
(1, 'Umum', '0'),
(2, 'Pemerintah', '100'),
(3, 'Politik', '200'),
(4, 'Keamanan / Ketertiban', '300'),
(5, 'Kesejahteraan Rakyat', '400'),
(6, 'Perekonomian', '500'),
(7, 'Pekerjaan Umum dan Ketenagakerjaan', '600'),
(8, 'Pengawasan', '700'),
(9, 'Kepegawaian', '800'),
(10, 'Keuangan', '900'),
(11, 'Kelahiran', '1000'),
(13, 'Kematian', '1100');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kompetensi`
--

CREATE TABLE `ref_kompetensi` (
  `id_kompetensi` int(5) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_kompetensi`
--

INSERT INTO `ref_kompetensi` (`id_kompetensi`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Kesehatan'),
(2, 'Profesional Bangunan'),
(3, 'Profesional Kelistrikan'),
(4, 'Profesional Pendidikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_kontrasepsi`
--

CREATE TABLE `ref_kontrasepsi` (
  `id_kontrasepsi` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_kontrasepsi`
--

INSERT INTO `ref_kontrasepsi` (`id_kontrasepsi`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Pil'),
(2, 'Suntik'),
(3, 'IUD'),
(4, 'Kondom'),
(5, 'Implant'),
(6, 'MOP'),
(7, 'MOW');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_pangkat_gol`
--

CREATE TABLE `ref_pangkat_gol` (
  `id_pangkat_gol` int(10) NOT NULL,
  `deskripsi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_pangkat_gol`
--

INSERT INTO `ref_pangkat_gol` (`id_pangkat_gol`, `deskripsi`) VALUES
(0, '-'),
(1, '3A'),
(2, '3B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_ped_kategori`
--

CREATE TABLE `ref_ped_kategori` (
  `id_ped_kategori` int(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_ped_kategori`
--

INSERT INTO `ref_ped_kategori` (`id_ped_kategori`, `deskripsi`) VALUES
(1, 'Pertanian'),
(2, 'Pertambangan'),
(3, 'Perkebunan'),
(4, 'Pembangkit Listrik'),
(5, 'Pariwisata');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_ped_sub`
--

CREATE TABLE `ref_ped_sub` (
  `id_ped_sub` int(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `monetize` float NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `id_ped_kategori` int(3) NOT NULL,
  `warna_peta` varchar(7) NOT NULL DEFAULT '#FADA23'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_pekerjaan`
--

CREATE TABLE `ref_pekerjaan` (
  `id_pekerjaan` int(15) NOT NULL,
  `deskripsi` varchar(75) NOT NULL,
  `deskripsi_singkat` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_pekerjaan`
--

INSERT INTO `ref_pekerjaan` (`id_pekerjaan`, `deskripsi`, `deskripsi_singkat`) VALUES
(0, 'Tidak Diketahui', NULL),
(1, 'BELUM/TIDAK BEKERJA', ''),
(2, 'MENGURUS RUMAH TANGGA', ''),
(3, 'PELAJAR/MAHASISWA', ''),
(4, 'PENSIUNAN', ''),
(5, 'PEGAWAI NEGERI SIPIL (PNS)', ''),
(6, 'TENTARA NASIONAL INDONESIA (TNI)', ''),
(7, 'KEPOLISIAN RI ', ''),
(8, 'PERDAGANGAN', ''),
(9, 'PETANI/PEKEBUN', ''),
(10, 'PETERNAK', ''),
(11, 'NELAYAN/PERIKANAN', ''),
(12, 'INDUSTRI', ''),
(13, 'KONSTRUKSI', ''),
(14, 'TRANSPORTASI', ''),
(15, 'KARYAWAN SWASTA', ''),
(16, 'KARYAWAN BUMN', ''),
(17, 'KARYAWAN HONORER', ''),
(18, 'BURUH HARIAN LEPAS', ''),
(19, 'BURUH TANI/PERKEBUNAN', ''),
(20, 'BURUH NELAYAN/PERIKANAN', ''),
(21, 'BURUH PETERNAKAN', ''),
(22, 'PEMBANTU RUMAH TANGGA', ''),
(23, 'TUKANG CUKUR', ''),
(24, 'TUKANG BATU', ''),
(25, 'TUKANG LISTRIK', ''),
(26, 'TUKANG KAYU', ''),
(27, 'TUKANG SOL SEPATU', ''),
(28, 'TUKANG LAS/PANDAI BESI', ''),
(29, 'TUKANG JAIT', ''),
(30, 'TUKANG GIGI', ''),
(31, 'PENATA RIAS', ''),
(32, 'PENATA BUSANA', ''),
(33, 'PENATA RAMBUT', ''),
(34, 'MEKANIK', ''),
(35, 'SENIMAN', ''),
(36, 'TABIB', ''),
(37, 'PARAJI', ''),
(38, 'PERANCANG BUSANA', ''),
(39, 'PENTERJEMAH', ''),
(40, 'IMAM MASJID', ''),
(41, 'PENDETA', ''),
(42, 'PASTOR', ''),
(43, 'WARTAWAN', ''),
(44, 'USTADZ/MUBALIGH', ''),
(45, 'JURU MASAK', ''),
(46, 'PROMOTOR ACARA', ''),
(47, 'ANGGOTA DPR RI', ''),
(48, 'ANGGOTA DPD', ''),
(49, 'ANGGOTA BPK', ''),
(50, 'PRESIDEN', ''),
(51, 'WAKIL PRESIDEN', ''),
(52, 'ANGGOTA MAHKAMAH KONSTITUSI', ''),
(53, 'DUTA BESAR', ''),
(54, 'GUBERNUR', ''),
(55, 'WAKIL GUBERNUR', ''),
(56, 'BUPATI', ''),
(57, 'WAKIL BUPATI', ''),
(58, 'WALIKOTA', ''),
(59, 'WAKIL WALIKOTA', ''),
(60, 'ANGGOTA DPRD PROP', ''),
(61, 'ANGGOTA DPRD KAB. KOTA', ''),
(62, 'DOSEN', ''),
(63, 'GURU', ''),
(64, 'PILOT', ''),
(65, 'PENGACARA', ''),
(66, 'NOTARIS', ''),
(67, 'ARSITEK', ''),
(68, 'AKUNTAN', ''),
(69, 'KONSULTAN', ''),
(70, 'DOKTER', ''),
(71, 'BIDAN', ''),
(72, 'PERAWAT', ''),
(73, 'APOTEKER', ''),
(74, 'PSIKIATER/PSIKOLOG', ''),
(75, 'PENYIAR TELEVISI', ''),
(76, 'PENYIAR RADIO', ''),
(77, 'PELAUT', ''),
(78, 'PENELITI', ''),
(79, 'SOPIR', ''),
(80, 'PIALANG', ''),
(81, 'PARANORMAL', ''),
(82, 'PEDAGANG', ''),
(83, 'PERANGKAT DESA', ''),
(84, 'KEPALA DESA', ''),
(85, 'BIARAWATI', ''),
(86, 'WIRASWASTA', ''),
(87, 'BURUH MIGRAN', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_pekerjaan_ped`
--

CREATE TABLE `ref_pekerjaan_ped` (
  `id_pekerjaan_ped` int(10) NOT NULL,
  `deskripsi` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_pekerjaan_ped`
--

INSERT INTO `ref_pekerjaan_ped` (`id_pekerjaan_ped`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Tidak Diketahui'),
(2, 'Petani'),
(3, 'Pedagang'),
(4, 'Petani Kebun'),
(5, 'Tukang Batu / Jasa Lainnya'),
(6, 'Seniman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_pelapor`
--

CREATE TABLE `ref_pelapor` (
  `id_pelapor` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_pelapor`
--

INSERT INTO `ref_pelapor` (`id_pelapor`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Ayah'),
(2, 'Ibu'),
(3, 'Kakak'),
(4, 'Adik'),
(5, 'Kakek'),
(6, 'Nenek'),
(7, 'Paman'),
(8, 'Tante'),
(9, 'Keponakan'),
(10, 'Sepupu'),
(11, 'Kerabat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_pendidikan`
--

CREATE TABLE `ref_pendidikan` (
  `id_pendidikan` int(15) NOT NULL,
  `deskripsi` varchar(75) NOT NULL,
  `is_bsm` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_pendidikan`
--

INSERT INTO `ref_pendidikan` (`id_pendidikan`, `deskripsi`, `is_bsm`) VALUES
(0, 'Tidak Diketahui', 'N'),
(1, 'Tidak dapat membaca', 'N'),
(2, 'Tidak Pernah Sekolah', 'N'),
(3, 'Tidak Tamat SD/Sederajat', 'N'),
(4, 'Tamat SD/Sederajat', 'N'),
(5, 'Tamat SMP/Sederajat', 'N'),
(6, 'Tamat SMA/Sederajat', 'N'),
(7, 'Tamat D-3/Sederajat', 'N'),
(8, 'Tamat S-1/Sederajat', 'N'),
(9, 'Tamat S-2/Sederajat', 'N'),
(10, 'Tamat S-3/Sederajat', 'N'),
(11, 'Belum Masuk TK/PAUD ', 'N'),
(12, 'Sedang TK/PAUD', 'N'),
(13, 'Sedang SD/Sederajat', 'Y'),
(14, 'Sedang SMP/Sederajat', 'Y'),
(15, 'Sedang SMA/Sederajat', 'Y'),
(16, 'Sedang D-3/Sederajat', 'N'),
(17, 'Sedang S-1/Sederajat', 'N'),
(18, 'Sedang S-2/Sederajat', 'N'),
(19, 'Sedang S-3/Sederajat', 'N'),
(20, 'Putus Sekolah', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_provinsi`
--

CREATE TABLE `ref_provinsi` (
  `id_provinsi` int(10) NOT NULL,
  `kode_provinsi_bps` char(10) NOT NULL,
  `kode_provinsi_kemendagri` char(10) NOT NULL,
  `nama_provinsi` varchar(50) NOT NULL,
  `luas_wilayah` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_provinsi`
--

INSERT INTO `ref_provinsi` (`id_provinsi`, `kode_provinsi_bps`, `kode_provinsi_kemendagri`, `nama_provinsi`, `luas_wilayah`) VALUES
(0, '0', '0', 'Tidak Diketahui', 0),
(1, '34', '34', 'Daerah Istimewa Yogyakarta', 3185),
(2, '02', '02', 'Jawa Barat', 74747);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_rp_bidang`
--

CREATE TABLE `ref_rp_bidang` (
  `id_bidang` int(11) NOT NULL,
  `kode_bidang` varchar(15) DEFAULT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `level` int(2) NOT NULL,
  `id_parent_bidang` int(11) DEFAULT NULL,
  `id_top_bidang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_rp_bidang`
--

INSERT INTO `ref_rp_bidang` (`id_bidang`, `kode_bidang`, `deskripsi`, `level`, `id_parent_bidang`, `id_top_bidang`) VALUES
(21, '1', 'PENYELENGGARAAN PEMERINTAH DESA', 1, NULL, NULL),
(22, '2', 'PELAKSANAAN PEMBANGUNAN DESA', 1, NULL, NULL),
(23, '3', 'PEMBINAAN KEMASYARAKATAN DESA', 1, NULL, NULL),
(24, '4', 'PEMBERDAYAAN MASYARAKAT DESA', 1, NULL, NULL),
(29, '1.1', 'Urusan Penyelenggaraan Pemerintah Desa', 2, 21, 21),
(30, '1.1.1', 'Program Pelayanan Administrasi Perkantoran', 3, 29, 21),
(31, '1.1.1.1', 'Penyediaan Jasa Administrasi Perkantoran', 4, 30, 21),
(32, '1.1.1.2', 'Penyediaan Jasa Pemeliharaan sarana prasarana Kantor', 4, 30, 21),
(33, '1.1.1.3', 'Penyediaan Jasa langganan Kantor', 4, 30, 21),
(34, '1.1.1.4', 'Penyediaan sarana rapat kantor', 4, 30, 21),
(36, '1.1.1.5', 'Lain lain', 4, 30, 21),
(37, '2.1', 'Pembangunan Inftastruktur', 2, 22, 22),
(38, '2.1.1', 'Pembangunan Inftastruktur Jalan', 3, 37, 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_rp_coa`
--

CREATE TABLE `ref_rp_coa` (
  `id_coa` int(11) NOT NULL,
  `kode_rekening` varchar(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `id_parent_coa` int(11) DEFAULT NULL,
  `id_top_coa` int(11) DEFAULT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_rp_coa`
--

INSERT INTO `ref_rp_coa` (`id_coa`, `kode_rekening`, `deskripsi`, `id_parent_coa`, `id_top_coa`, `level`) VALUES
(3, '1', 'PENDAPATAN', NULL, NULL, 1),
(6, '1.1', 'Pendapatan Asli Desa', 3, 3, 2),
(7, '1.1.1', 'Hasil Usaha', 6, 3, 3),
(8, '1.1.2', 'Swadaya, Partisipasi dan Gotong Royong', 6, 3, 3),
(10, '2', 'BELANJA', NULL, NULL, 1),
(19, '1.1.3', 'Lain-lain Pendapatan Asli Desa yang sah', 6, 3, 3),
(20, '1.2', 'Pendapatan Transfer', 3, 3, 2),
(21, '1.2.1', 'Dana Desa', 20, 3, 3),
(22, '1.2.2', 'Bagian dari hasil pajak & retribusi daerah kabupaten / kota', 20, 3, 3),
(23, '1.2.3', 'Alokasi Dana Desa', 20, 3, 3),
(24, '1.2.4', 'Bantuan Keuangan', 20, 3, 3),
(25, '1.2.4.1', 'Bantuan Provinsi', 24, 3, 4),
(26, '1.2.4.2', 'Bantuan Kabupaten / Kota', 24, 3, 4),
(27, '3', 'PEMBIAYAAN', NULL, NULL, 1),
(28, '3.1', 'Penerimaan Pembiayaan', 27, 27, 2),
(29, '3.2', 'Pengeluaran Pembiayaan', 27, 27, 2),
(30, '3.1.1', 'SILPA', 28, 27, 3),
(31, '3.1.2', 'Pencairan Dana Cadangan', 28, 27, 3),
(32, '3.1.3', 'Hasil Kekayaan Desa Yang dipisahkan', 28, 27, 3),
(33, '3.2.1', 'Pembentukan Dana Cadangan', 29, 27, 3),
(34, '3.2.2', 'Penyertaan Modal Desa', 29, 27, 3),
(35, '2.1', 'Bidang Penyelenggaraan Pemerintahan Desa', 10, 10, 2),
(36, '2.1.1', 'Penghasilan Tetap dan Tunjangan', 35, 10, 3),
(37, '2.1.1.1', 'Belanja Pegawai', 36, 10, 4),
(38, '2.1.2', 'Operasional Perkantoran', 35, 10, 3),
(39, '2.1.2.2', 'Belanja Barang dan Jasa', 38, 10, 4),
(40, '2.1.2.3', 'Belanja Modal', 38, 10, 4),
(41, '2.1.3', 'Operasional BPD', 35, 10, 3),
(42, '2.1.4', 'Operasional RT/ RW', 35, 10, 3),
(43, '2.1.3.2', 'Belanja Barang dan Jasa', 41, 10, 4),
(44, '2.1.4.2', 'Belanja Barang dan Jasa', 42, 10, 4),
(45, '2.2', 'Bidang Pelaksanaan Pembangunan Desa', 10, 10, 2),
(46, '2.3', 'Bidang Pembinaan Kemasyarakatan', 10, 10, 2),
(47, '2.4', 'Bidang Pemberdayaan Masyarakat', 10, 10, 2),
(48, '2.5', 'Bidang Tak Terduga', 10, 10, 2),
(49, '2.1.5', 'penetapan dan penegasan batas Desa', 35, 10, 3),
(50, '2.1.5.1', 'Pembangunan Gapura Desa', 49, 10, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_rp_periode`
--

CREATE TABLE `ref_rp_periode` (
  `id_periode` int(11) NOT NULL,
  `periode_awal` int(5) NOT NULL,
  `periode_akhir` int(5) NOT NULL,
  `is_current` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_rp_periode`
--

INSERT INTO `ref_rp_periode` (`id_periode`, `periode_awal`, `periode_akhir`, `is_current`) VALUES
(1, 2010, 2014, '2015-06-30 15:13:48'),
(4, 2015, 2019, '2015-06-30 15:13:58'),
(5, 2020, 2024, '2015-06-30 16:58:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_rp_sumber_dana`
--

CREATE TABLE `ref_rp_sumber_dana` (
  `id_sumber_dana` int(11) NOT NULL,
  `sumber` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `nominal` int(20) NOT NULL,
  `id_tahun_anggaran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_rp_sumber_dana`
--

INSERT INTO `ref_rp_sumber_dana` (`id_sumber_dana`, `sumber`, `deskripsi`, `nominal`, `id_tahun_anggaran`) VALUES
(1, 'PEMKAB GUNUNGKIDUL', 'Pemerintah Kabupaten Gunungkidul', 14946000, 4),
(2, 'PEMPROV DIY', 'Pemerintah Provinsi Daerah Istimewa Yogyakarta', 45700000, 4),
(3, 'PEMDA WONOSARI', 'Pemerintah Daerah Wonosari', 37997800, 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_rp_sumber_dana_desa`
--

CREATE TABLE `ref_rp_sumber_dana_desa` (
  `id_sumber_dana_desa` int(11) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `keyword` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `ref_rp_sumber_dana_desa`
--

INSERT INTO `ref_rp_sumber_dana_desa` (`id_sumber_dana_desa`, `deskripsi`, `keyword`) VALUES
(1, 'APB Desa', 'Dana Desa, APBDes, APBDESA'),
(2, 'APBD Kabupaten', NULL),
(3, 'APBD Provinsi', NULL),
(5, 'APBN', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_rp_tahun_anggaran`
--

CREATE TABLE `ref_rp_tahun_anggaran` (
  `id_tahun_anggaran` int(11) NOT NULL,
  `deskripsi` varchar(25) NOT NULL,
  `regulasi` varchar(50) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `tahun` int(4) DEFAULT NULL,
  `id_periode` int(11) NOT NULL,
  `is_current` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_rp_tahun_anggaran`
--

INSERT INTO `ref_rp_tahun_anggaran` (`id_tahun_anggaran`, `deskripsi`, `regulasi`, `keterangan`, `tahun`, `id_periode`, `is_current`) VALUES
(4, 'deskripsi', 'regulasi', 'keterangan    ', 2015, 4, '2015-06-30 16:55:20'),
(5, 'desc', 'regul', 'ket', 2016, 4, '2015-06-30 16:54:32'),
(6, 'desc', 'reg', 'ket', 2017, 4, '2015-06-30 16:55:35'),
(7, 'desc', 'reg', 'ket', 2018, 4, '2015-06-30 16:55:42'),
(8, 'desc', 'reg', 'ket', 2019, 4, '2015-06-30 16:55:47'),
(9, 'deskripsi', 'regulasi', 'keterangan', 2020, 5, '2015-06-30 16:58:32'),
(10, 'desc', 'reg', 'ket', 2021, 5, '2015-07-06 16:56:08'),
(11, 'desc', 'reg', 'ket', 2022, 5, '2015-07-06 16:56:14'),
(12, 'desc', 'reg', 'ket', 2023, 5, '2015-07-06 16:56:18'),
(13, 'desc', 'reg', 'ket', 2024, 5, '2015-07-06 16:56:24'),
(14, 'desc', 'reg', 'ket', 2010, 1, '2015-07-26 23:37:07'),
(15, 'desc', 'reg', 'ket', 2011, 1, '2015-07-26 23:37:12'),
(16, 'desc', 'reg', 'ket', 2012, 1, '2015-07-26 23:37:16'),
(17, 'desc', 'reg', 'ket', 2013, 1, '2015-07-26 23:37:20'),
(18, 'desc', 'reg', 'ket', 2014, 1, '2015-07-26 23:37:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_rt`
--

CREATE TABLE `ref_rt` (
  `id_rt` int(10) NOT NULL,
  `nomor_rt` char(10) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_rw` int(10) NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_rt`
--

INSERT INTO `ref_rt` (`id_rt`, `nomor_rt`, `luas_wilayah`, `id_rw`, `id_penduduk`) VALUES
(0, '-', 0, 0, NULL),
(1, '01', 500, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_rw`
--

CREATE TABLE `ref_rw` (
  `id_rw` int(10) NOT NULL,
  `nomor_rw` char(10) NOT NULL,
  `luas_wilayah` float NOT NULL,
  `id_dusun` int(10) NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_rw`
--

INSERT INTO `ref_rw` (`id_rw`, `nomor_rw`, `luas_wilayah`, `id_dusun`, `id_penduduk`) VALUES
(0, '-', 0, 0, NULL),
(1, '01', 1000, 1, NULL),
(2, '02', 1500, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_status_kawin`
--

CREATE TABLE `ref_status_kawin` (
  `id_status_kawin` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_status_kawin`
--

INSERT INTO `ref_status_kawin` (`id_status_kawin`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Belum Kawin'),
(2, 'Kawin'),
(3, 'Cerai Hidup'),
(4, 'Cerai Mati');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_status_keluarga`
--

CREATE TABLE `ref_status_keluarga` (
  `id_status_keluarga` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_status_keluarga`
--

INSERT INTO `ref_status_keluarga` (`id_status_keluarga`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Kepala Keluarga'),
(2, 'Suami'),
(3, 'Istri'),
(4, 'Anak'),
(5, 'Menantu'),
(6, 'Mertua'),
(7, 'Famili Lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_status_penduduk`
--

CREATE TABLE `ref_status_penduduk` (
  `id_status_penduduk` int(5) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_status_penduduk`
--

INSERT INTO `ref_status_penduduk` (`id_status_penduduk`, `deskripsi`) VALUES
(0, 'Tidak diketahui'),
(1, 'Tinggal Tetap'),
(2, 'Meninggal'),
(3, 'Pindahan Keluar'),
(4, 'Pindahan Masuk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ref_status_tinggal`
--

CREATE TABLE `ref_status_tinggal` (
  `id_status_tinggal` int(10) NOT NULL,
  `deskripsi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ref_status_tinggal`
--

INSERT INTO `ref_status_tinggal` (`id_status_tinggal`, `deskripsi`) VALUES
(0, 'Tidak Diketahui'),
(1, 'Tinggal Tetap'),
(2, 'Tinggal di luar desa (dalam 1 kab/kota)'),
(3, 'Tinggal di luar kota'),
(4, 'Tinggal di luar provinsi'),
(5, 'Tinggal di luar negeri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_aset_bangunan`
--

CREATE TABLE `tbl_aset_bangunan` (
  `id_aset_bangunan` int(4) NOT NULL,
  `no_imb` varchar(30) NOT NULL,
  `tgl_bangun` date NOT NULL,
  `luas` float NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` blob,
  `id_kepemilikan_aset` int(4) NOT NULL,
  `id_aset_tanah` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_aset_master`
--

CREATE TABLE `tbl_aset_master` (
  `id_aset_master` int(4) NOT NULL,
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
  `id_kepemilikan_aset` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_aset_perawatan_bgn`
--

CREATE TABLE `tbl_aset_perawatan_bgn` (
  `id_aset_perawatan_bgn` int(4) NOT NULL,
  `tgl_perawatan` date NOT NULL,
  `deskripsi` text NOT NULL,
  `id_aset_bangunan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_aset_ruangan`
--

CREATE TABLE `tbl_aset_ruangan` (
  `id_aset_ruangan` int(4) NOT NULL,
  `luas` float NOT NULL,
  `deskripsi` text NOT NULL,
  `id_aset_bangunan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_aset_tanah`
--

CREATE TABLE `tbl_aset_tanah` (
  `id_aset_tanah` int(4) NOT NULL,
  `no_sertifikat` varchar(30) NOT NULL,
  `luas` float NOT NULL,
  `deskripsi` text NOT NULL,
  `lokasi` blob,
  `id_kepemilikan_aset` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_berita`
--

CREATE TABLE `tbl_berita` (
  `id_berita` int(10) NOT NULL,
  `id_pengguna` int(10) NOT NULL,
  `penulis` varchar(30) DEFAULT NULL,
  `gambar` text NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `isi_berita` blob NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_publish` enum('Ya','Tidak') NOT NULL DEFAULT 'Ya',
  `is_masyarakat` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_berita`
--

INSERT INTO `tbl_berita` (`id_berita`, `id_pengguna`, `penulis`, `gambar`, `judul_berita`, `isi_berita`, `waktu`, `is_publish`, `is_masyarakat`) VALUES
(25, 2, '', 'uploads/berita/1c63014d966ff0e499fba1f4769a450ba3843792.jpg', 'Konsorsium Hijau Diminta Kontribusi Wujudkan Green Buleleng', 0x3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e50656c616b73616e61616e2070726f6772616d2050656e676574616875616e2048696a6175206469204b616275706174656e2042756c656c656e672050726f76696e73692042616c69206f6c6568204b6f6e736f727369756d2048696a6175206d756c61692062657267756c69722e2044696d756c61696e79612070726f6772616d2070656e676574616875616e2068696a61752074657273656275742073656972696e672064696c616b73616e616b616e6e7961205261706174204b6f6f7264696e6173692050656c616b73616e61616e2050726f6772616d2048696261682050656e676574616875616e2048696a617520616e74617261204b6f6e736f727369756d2048696a61752064656e67616e2050656d6572696e746168204b616275706174656e2042756c656c656e672e204b6567696174616e2074657273656275742064696c616b73616e616b616e2070616461204b616d69732c2035204e6f76656d6265722032303135206469204b616e746f7220426164616e20506572656e63616e61616e2050656d62616e67756e616e2044616572616820284261707065646129204b616275706174656e2042756c656c656e672e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e44616c616d207261706174206b6f6f7264696e6173692074657273656275742068616469722049204167756e67205075747269204173747269642c204d412c266e6273703b20436f205465616d204c65616465722050726f6772616d2050656e676574616875616e2048696a61752064617269204b6f6e736f727369756d2048696a61752c2049727961205769736e756261646872612c2053542c204d542c204954204f6666696365722c2049722e20507574752047646520596173612053656b726574617269732042617070656461204b61622e2042756c656c656e672c204472732e2044657761204d616465205375646961727461204b6162696420536f7369616c2042756461796120426170706564612c20736572746120534b50442d534b5044207465726b616974206469204b61622e2042756c656c656e672e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e44616c616d205261706174204b6f6f7264696e6173692074657273656275742c2049204167756e672050757472692041737472696420617461752079616e67206269617361206469736170612047756e6720547269206d656e79616d7061696b616e2070726573656e74617369206d656e67656e61692070656c616b73616e61616e2070726f6772616d2070656e676574616875616e2068696a6175206469204b61622e2042756c656c656e672e20e2809c50726f6772616d2070656e676574616875616e2068696a61752062657274756a75616e20756e74756b206d656e696e676b61746b616e2070656d6168616d616e206d6173796172616b61742064657361206d656e67656e61692070656d62616e67756e616e2072656e646168206b6172626f6e2ce2809d206a656c61732047756e67205472692e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e426572626167616920616b7469766974617320616b616e2064696c616b73616e616b616e2064616c616d20736b656d612070726f6772616d2070656e676574616875616e2068696a61752c20616e74617261206c61696e2070656e656c697469616e20756e74756b206d656e6767616c692070656e676574616875616e206c6f6b616c2c2070656e696e676b6174616e206b6170617369746173206d6173796172616b61742064657361207365727461206d656e646f726f6e672070656e676574616875616e2079616e67206469686173696c6b616e206d6173756b2064616c616d2070726f7365732070656e67656d62696c616e206b6562696a616b616e20646920646573612c206b616275706174656e2c2070726f76696e7369206d617570756e206e6173696f6e616c2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223ee2809c59616e67206d656e6a61646920666f6b7573206b616d69206b65646570616e206164616c6168206164616e796120616e616b2d616e616b206d7564612079616e67206d656d696c696b69206b617061736974617320617461752070656e676574616875616e2079616e672068696a61752c20736568696e676761206d656e6a61646920616b746f722d616b746f722070656d6261727520646920646573612c206d617570756e206469206c75617220646573616e79612073656e646972692ce2809d20756a61722047756e67205472692e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e536564616e676b616e20507574752047646520596173612c206d656e676170726573696173692075706179612064617269204b6f6e736f727369756d2048696a617520756e74756b206d656e67656d62616e676b616e206d6173796172616b61742064657361207465727574616d612064616c616d20626964616e67206c696e676b756e67616e2e204d656e757275742053656b726574617269732042617070656461206b61622e2042756c656c656e672074657273656275742050726f76696e73692042616c69206a756761207375646168206d656e63616e616e676b616e207365626167616920477265656e2050726f76696e63652e20e2809c536179612062657268617261702064656e67616e206b6f6e747269627573692064617269204b6f6e736f727369756d2048696a6175206b6974612062697361206d656e6a61646920477265656e2042756c656c656e672ce2809d20756a61726e79612e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e4f6c656820736562616220697475206b697461206861727573206d656c6177616e2073656d616b696e206d656e696e676b61746e796120706f6c75736920434f322e204261696b2064617269206b656e64617261616e206265726d6f746f722c2070656d62616b6172616e2073616d706168206d617570756e206c61696e6e79612e20416c69682066756e677369206c6168616e2070756e2073656d657374696e79612073656d616b696e2064696b7572616e6769206b6172656e61206c6168616e2074657262756b612079616e672073656d616b696e20736564696b69742e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e53656c61696e204b616275706174656e2042756c656c656e672c204b6f6e736f727369756d2048696a6175206a756761206d656c616b73616e616b616e2070726f6772616d2050656e676574616875616e2048696a61752064692064656c6170616e206b616275706174656e2c20616e74617261206c61696e204b616275706174656e204c6f6d626f6b2054696d75722c204c6f6d626f6b2054656e6761682064692050726f76696e7369204e54422c2053756d62612054696d75722c2053756d62612054656e6761682064692070726f76696e7369204e54542c204d7561726f204a616d62692c2054616e6a756e67204a6162756e672054696d75722064692050726f76696e7369204a616d62692c2064616e204d616d756a752064692050726f76696e73692053756c61776573692042617261742e2a2a286574293c2f703e, '2015-11-09 10:27:42', 'Ya', 'Tidak'),
(26, 2, '', 'uploads/berita/9625b75b5e2aec702c4abec26d19c0574cfd5ff3.jpg', 'Konsorsium Hijau Periksa Krisis Sosial Ekologi Desa di 8 Kabupaten', 0x3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e4b6f6e736f727369756d2048696a61752074656c6168206d656d756c6169206b65726a61206c6170616e67616e20696d706c656d656e746173692070726f6772616d2070656e676574616875616e2068696a61752e204b65726a61206c6170616e67616e2064696d756c61692064656e67616e206d656c616b756b616e2052617069642041737365736d656e20746572686164617020313620646573612064692064656c6170616e206b616275706174656e206c6f6b6173692070726f6772616d2c2070616461206177616c2068696e6767612070657274656e676168616e204e6f76656d62657220696e692e20556e74756b2074616861702070657274616d612c2052617069642041737365736d656e2064696c616b756b616e206469204b616275706174656e204c6f6d626f6b2054696d75722c206c6f6d626f6b2054656e6761682c2053756d62612054696d75722c2053756d62612054656e6761682064616e204d616d756a752e20536564616e676b616e204b616275706174656e204d7561726f204a616d62692c2054616e6a756e67204a6162756e672054696d75722064616e2042756c656c656e6720616b616e2064696c616b73616e616b616e2064616c616d2077616b74752064656b61742e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e54756a75616e20646172692070726f7365732070656d6572696b7361616e20696e69206d656e646f726f6e67206b656d616e64697269616e2064657361206b68757375736e79612079616e67206d656e6a6164692077696c61796168206b6567696174616e2070656d6572696b7361616e2c207365727461206d656e646f726f6e67206c616869726e796120706172612070656d696d70696e206d61736120646570616e20646920646573612c2064617269206b616c616e67616e2067656e6572617369206d756461206261696b206c616b692d6c616b69206d617570756e20706572656d7075616e2e2050656d6572696b7361616e20696e692068616e796120616c617420756e74756b206d656e6361706169206475612076697369206b6567696174616e204b6f6e736f727369756d2048696a61752e204b6572616e676b61207574616d612064616c616d2072617069642061737365736d656e20696e692069616c6168206b726973697320736f7369616c20656b6f6c6f67697320646920646573612d6465736120646920496e646f6e657369612e2059616e672064696d616b737564206b726973697320736f7369616c20656b6f6c6f676973206164616c61682070656e7572756e616e2066756e67736920656b6f6c6f6769732064616e20616c616d2079616e6720706164612067696c6972616e6e79612062657264616d70616b2070616461206b656869647570616e20736f7369616c2e204b726973697320696e692062756b616e2073656261746173206b65727573616b616e20666973696b2062656c616b6120746170692074656c6168206d656e6a616e676b617520617370656b20736f7369616c2064616e2074656c6168206d656d70656e676172756869206d616e757369612079616e672074696e6767616c20646920646165726168206b72697369732e204b657361646172616e2077617267612064657361206d6973616c6e79612074656c616820646962656e74756b206f6c6568206b726973697320696e692e205761726761206261686b616e2074656c61682068696475702062657273616d61206b72697369732064616e206d656e616a6164692062616769616e2064616e2070656e6f70616e67207574616d612062616769206b65727573616b616e20616c616d2079616e67206265726b656c616e6a7574616e2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e44656e67616e206b617461206c61696e2c206b726973697320736f7369616c20656b6f6c6f676973206461706174206469706168616d69207365626167616920e2809c706179756e67e2809d206b6567696174616e2070656d6572696b7361616e20696e692e20556e74756b206461706174206d656d6168616d69206b726973697320736f7369616c20656b6f6c6f67697320646920617461732c2074656c616820646970696c696820e2809c70696e7475e2809d2079616e67206d656e6a61646920746974696b206d6173756b2c2079616b6e692070657274616e69616e2079616e6720746572696e746567726173692028696e7465677261746564206661726d696e672f4946292c20656e657267692079616e6720746572626172756b616e202872656e657761626c65656e657267792f5245292c206b65776972617573616861616e206265726261736973206e696c6169206c696e676b756e67616e2028677265656e20656e7472657072656e657572736869702f4745292c2064616e20706572656e63616e61616e206265726261736973207370617369616c20287370617469616c20706c616e6e696e672f5350292e20426964616e6720746572616b6869722c207370617469616c20706c616e6e696e6720285350292c20616b616e206d656e6a616469206b6572616e676b612070696b69722064616c616d206d656c69686174206b657469676120626964616e672079616e67206c61696e2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e53656c61696e207365626167616920e2809c70696e7475206d6173756be2809d206d656d6168616d69206b72697369732c206b65656d70617420626964616e6720696e6920616b616e206d656e6a61646920746974696b206d656e6361726920e2809c70696e7475206b656c756172e2809d2064617269206b726973697320736f7369616c20656b6f6c6f6769732e2053616174206d656d696b69726b616e207461776172616e206a616c616e206b656c7561722064692064657361207465726b616974206b726973697320696e692c206b657469676120626964616e6720696e69206164616c6168206d61746572692079616e6720616b616e206469646f726f6e672064616c616d2072616e676b61206d656d7065726b756174206b656d616e64697269616e2064616e206b65746168616e616e20646573612064656e67616e207072696e7369702079616e6720626572736168616261742070616461206c696e676b756e67616e2068696475702e204b657469676120626964616e6720696e696c61682079616e6720616b616e206d656e6a61646920617370656b206d656e646f726f6e6720656b6f6e6f6d6920646573612e2052617069642041737365736d656e7420616b616e2064696c616e6773756e676b616e2073656c616d61206475612062656c617320686172692e204164612031362070656e656c697469206d756461204b6f6e736f727369756d2048696a61752079616e6720616b616e2074696e6767616c2062657273616d61206d6173796172616b61742064692031362064657361206c6f6b6173692070656e656c697469616e2e2a2a2a20284554293c2f703e, '2015-11-09 10:30:10', 'Ya', 'Tidak'),
(27, 0, 'Irya Wisnubhadra', 'uploads/berita/ec9c6b44d83744a0d3bfdcb037f7448b33fba105.jpg', 'Kerangka Acuan Implementasi Sistem Informasi Desa dan Kawasan (SIDEKA) - Hijau sebagai sumber data', 0x4d616e6167656d656e7420496e666f726d6174696f6e2053797374656d20262334303b4d4953262334313b2064616c616d2062616861736120496e646f6e6573696120646973656275742064656e67616e2053697374656d20496e666f726d617369204d616e616a656d656e202853494d292c206164616c61682073697374656d20696e666f726d6173692079616e67206d656d62616e7475206d616e616a656d656e2064616c616d206d6572656e63616e616b616e20737472617465676973206269736e69732c2064616e206d656d656361686b616e206d6173616c6168206269736e697320736570657274692062696173612070726f64756b2064616e206c6179616e616e2e2053494d206469626564616b616e2064656e67616e2073697374656d20696e666f726d6173692062696173612f7472616e73616b73696f6e616c2028534929206b6172656e612053494d20646967756e616b616e20756e74756b206d656e67616e616c69736973205349206c61696e2079616e6720646974657261706b616e207061646120616b74697669746173206f7065726173696f6e616c206f7267616e69736173692e2053494d207061646120756d756d6e796120646967756e616b616e20756e74756b206d6572756a756b2070616461206b656c6f6d706f6b206d616e616a656d656e20696e666f726d6173692079616e672062657274616c69616e2064656e67616e206f746f6d6173692064616e2064756b756e67616e2074657268616461702070656e67616d62696c616e206b657075747573616e20626572646173617220646174612079616e6720616b757261742e2050616461206b6f6e74656b732070656d6572696e746168616e2064616c616d206d656e67656c6f6c61206b656c657374617269616e20616c616d206d616b61204d495320616b616e20646170617420646967756e616b616e20756e74756b206d656d6f6e69746f7220736563617261206f6e6c696e652c206d656e676576616c7561736920736563617261206f6e6c696e652c2079616e67207061646120616b6869726e796120646967756e616b616e20736562616761692064617361722070656e67616d62696c616e206b657075747573616e0a0a537961726174207574616d61206265726a616c616e6e7961204d49532079616e67206261696b206164616c616820746572696d706c656d656e746173696b616e6e79612053697374656d20496e666f726d617369205472616e73616b73696f6e616c2079616e67206261696b2070756c612e2053697374656d20496e666f726d617369207472616e73616b73696f6e616c206d656e6a6164692073756d62657220646174612062616769204d495320736568696e67676120696d706c656d656e74617369205349206d656e6a61646920737961726174206d75746c616b2062656b65726a616e7961204d49532e0a0a53697374656d20496e666f726d61736920446573612064616e204b61776173616e2028534944654b6129206d65727570616b616e207365627561682073697374656d20696e666f726d617369207472616e73616b73696f6e616c2079616e67206d616d7075206d656e67756d70756c6b616e2c206d656e676f6c6168206d617570756e206d656e79616a696b616e2064617461207365737561692064656e67616e206b656275747568616e2050656d6572696e74616820446573612e2020534944654b612064692064657361696e2064616c616d2068616c20616b757261736920646174612c2070656d616e66616174616e2064617461207365727461206b656365706174616e2064616c616d206d656d616e6767696c20646174612079616e6720616b616e206d656d62756b612062616e79616b206b656d756e676b696e616e2062616769206465736120756e74756b20616d62696c2062616769616e2064616c616d206d656e67757275732072756d61682074616e6767616e79612079616e67207061646120736161742062657273616d61616e206d656e6a616469206c616e676b6168206b6f6e7472696275736920646573612064616c616d20696b7574206d656e79656c657361696b616e206d6173616c61682d6d6173616c61682062616e6773612e0a0a53697374656d20696e666f726d61736920696e692064696b656d62616e676b616e2064656e67616e207072696e7369702d7072696e7369702070617274697369706173692c207472616e73706172616e73692064616e20616b756e746162696c697461732064616c616d207570617961206d656e646f726f6e672070656d62657264617961616e206d6173796172616b6174207365727461206d6577756a75646b616e206e696c61692d6e696c61692064656d6f6b72617469736173692064692074696e676b617420646573612e2044696d756c6169206461726920746168617020706572656e63616e61616e2c2070656e6767756d70756c616e20646174612c2070656e676f6c6168616e2068696e6767612070656d616e66616174616e20646174612c2073656d75612064696c616b756b616e206f6c65682070656d6465732062657273616d612064656e67616e206d6173796172616b6174207365636172612074657262756b612e2044616c616d2068616c2070656e79656c656e6767617261616e6e79612c20534944654b6120646972616e63616e672073656261676169207365627561682073697374656d20696e666f726d6173692079616e672074756d62756820646172692062617761682064616e20646962616e74752064656e67616e2070656e6761747572616e206b656c656d62616761616e2064616e206b6562696a616b616e206461726920617461732e200a534944454b41207361617420696e692074656c6168206469696d706c656d656e746173696b616e20736563617261206f6e6c696e65206469206c6562696820646172692038206b616275706174656e2064616e2034303020646573612e204d6173696e67206d6173696e6720646573612073656c616e6a75746e7961206d656d70756e7961692077656220736974652064656e67616e20646f6d61696e20646573612e69642079616e6720646170617420646967756e616b616e20756e74756b206d656e67656c6f6c612064617461207472616e73616b73696f6e616c206469206c6576656c20646573612e200a0a4b6f6e736f727369756d2048696a617520706164612051756172746572206b652d322062756c616e204a616e756172692c20616b616e206d656c616b73616e616b616e20616e616c69736973206b656275747568616e20284e656564206173736573736d656e74202f20726571756972656d656e7420616e616c797369732920756e74756b2070656e67656d62616e67616e204d616e6167656d656e7420496e666f726d6174696f6e2053797374656d20262334303b4d4953262334313b2064692074696e676b6174206b616275706174656e2e204b6172656e61204d4953206861727573206d656d70756e7961692073756d62657220646174612079616e6720616b757261742079616e67206265726173616c20646172692073697374656d20696e666f726d617369207472616e73616b73696f6e616c206d616b6120696d706c656d656e746173692f696e7374616c6173692053697374656d20496e666f726d61736920446573612064616e204b61776173616e206d656e6a6164692073616e6761742070656e74696e672064616e2064697065726c756b616e2e200a0a2044616c616d2070726f73657320696d706c656d656e746173692f696e7374616c61736920534944654b612c20646962757475686b616e2064756b756e67616e2074656e6167612061686c692074656b6e696b20696e666f726d6174696b6120285449292e2044756b756e67616e2074656e6167612061686c692079616e672062697361206265726173616c2064617269206d616861736973776120696e692064696d616b7375646b616e20756e74756b206d656c616b756b616e2070656e64616d70696e67616e2070656d6572696e74616820646573612064616c616d2070726f73657320696e7374616c61736920534944454b412079616e672062657262656e74756b20776562736974652064616e2061706c696b6173692064656e67616e206261736973206461746120646573612e2044616c616d2070726f73657320696e69206d6168617369737761206a75676120646968617261706b616e206461706174206d656c616b756b616e207472616e736665722070656e676574616875616e206b65706164612070656e67656c6f6c6120534944654b612e200a, '2015-11-09 10:35:08', 'Ya', 'Ya'),
(28, 0, 'Jepriadi', 'uploads/berita/c85311da0336616d8edf910371abb39b8d4428b2.jpg', 'Kemenkominfo Kembali Meng-online-kan Desa-Desa Terdepan', 0x4a616b61727461202d204b656d656e74657269616e204b6f6d756e696b6173692064616e20496e666f726d6174696b612052657075626c696b20496e646f6e6573696120284b6f6d696e666f292042656b65726a6173616d612064656e67616e20556e69766572736974617320496e646f6e657369612c20494c4541442055492c205072616b6172736120446573612064616e20446573612042726f616462616e642054657270616475206d656e79656c656e67676172616b616e2050726f6772616d2050656c61746968616e2064616e2050656e64616d70696e67616e2053444d206469204465736120706164612073656e696e2068696e676761206a756d2761742028322d362f31312920646920486f74656c20416361636961204a616b617274612050757361742e200a0a536562616e79616b2035302050657277616b696c616e204d6173796172616b617420446573612064617269205065726261746173616e20496e646f6e6573696120646174616e6720756e74756b206d656e67696b757469206b6567696174616e2074657273656275742e204461726920353020446573612074657273656275742c206d6572656b61206d6577616b696c6920372050726f76696e73692079616e6720746572736562617220646920496e646f6e6573696120616e74617261206c61696e2c2050617075612c204b616c696d616e74616e2042617261742c204b616c696d616e74616e2055746172612c204e7573612054656e67676172612054696d757220284e5454292c204d616c756b752c204b6570756c6175616e20526961752064616e20526961752e200a0a50726f6772616d20446573612042726f616462616e6420546572706164752079616e672064697573756e67206f6c6568204b6f6d696e666f20696e692073656e67616a61206469706572756e74756b6b616e206261676920446573612044657361205065726261746173616e20646920496e646f6e657369612079616e67206d656e6a61646920426572616e6461204e65676172612e204b6172656e61206d656d616e672073656c616d6120696e69206b65626572616461616e204e656761726120646920446165726168205065726261746173616e206d617369682073616e676174206b7572616e67206469726173616b616e2e200a0a224b656861646972616e2050726f6772616d20446573612042726f616462616e64205465727061647520626167692035302044657361205065726261746173616e20696e69206164616c61682073616562616761692070696c6f742070726f6a65637420646920746168756e203230313520756e74756b206d656e6768616469726b616e204e656761726120646920426174617320496e646f6e657369612e204a696b612068616c20696e692064696e696c6169206261696b2c206d616b61206b65646570616e20616b616e206164612073656b69746172203130303020646573612079616e6720616b616e20646964616d70696e67692e2054756a75616e6e7961206164616c616820756e74756b206d656e696e676b61746b616e2070726f64756b74696669746173206d6173796172616b6174206d656c616c756920496e666f726d6174696b612c22207465676173204d617320446961204665627269616e737961682028506c742e204250335449204b6f6d696e666f292c20526162752028342f3131292e0a0a4a657072696164690a50656e64616d70696e672044657361204b616c69617527204b65632e2053616a696e67616e204265736172204b61622e2053616d626173202d204b616c696d616e74616e204261726174, '2015-11-09 14:05:50', 'Ya', 'Ya'),
(29, 2, '', 'uploads/berita/027b557339eb87caf213fc8b905d7ddead0390b7.jpg', 'Watimpres Dukung Konsorsium Hijau Majukan Desa', 0x3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e4b726973697320736f7369616c2d656b6f6c6f67692079616e67206d656c616e646120496e646f6e657369612064616c616d2062656265726170612064656b61646520746572616b686972206d656d7065726c696861746b616e2062616877612070656d62616e67756e616e20746964616b206c6167692064617061742062657270696a616b207061646120706172616469676d612064616e20636172612079616e67206c616d612e2053616c61682073617475207465726f626f73616e2070656e74696e672079616e67206265726b656d62616e6720626562657261706120746168756e20746572616b68697220696e69206164616c6168206b6f6e7365702070656d62616e67756e616e20656b6f6e6f6d692064656e67616e206b6172626f6e2072656e64616820286c6f772d636172626f6e2065636f6e6f6d696320646576656c6f706d656e74292079616e672062657273616e64617220706164612067756775732070656d696b6972616e2064616e2070656e64656b6174616e2079616e6720756e74756b206d756461686e796120646973656275742050656e676574616875616e2048696a61752028477265656e204b6e6f776c65646765292e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e44616c616d20626562657261706120746168756e20746572616b6869722050656e676574616875616e2048696a6175206d756c6169206265726b656d62616e672070657361742064692062657262616761692062656c6168616e2064756e69612062657270696a616b2070616461206b65726167616d616e20747261646973692064616e206b65627564617961616e2c2070656d696b6972616e2064616e207072616b74656b2064692074696e676b6174206c6f6b616c2e204b6f6e736f727369756d2048696a6175206d656d626177612050656e676574616875616e2048696a6175206469206c6576656c20646573612c2079616e6720646967756e616b616e20756e74756b206d656e696e676b61746b616e206b6573656a616874657261616e206d6173796172616b61742064657361206e616d756e207465746170206d656c6573746172696b616e20616c616d2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e556e74756b206974756c6168204b6f6e736f727369756d2048696a6175206d656c616b756b616e2073656a756d6c61682070657274656d75616e2064616c616d206d656d70726f6d6f73696b616e206b6f6e7365702050656e676574616875616e2048696a61752c2073616c616820736174756e79612064656e67616e20446577616e2050657274696d62616e67616e20507265736964656e2028576174696d70726573292c2079616e672064696c616b73616e616b616e206469204b616e746f7220576174696d70726573204a616b617274612c2070616461204a756de2809961742c203330204f6b746f626572206c616c752e2050657274656d75616e20696e69206469686164697269206c616e6773756e672050726f662e2044722e20537269204164696e696e67736968204b6574756120446577616e2050657274696d62616e67616e20507265736964656e207365727461205369646172746f2044616e75737562726f746f20416e67676f746120446577616e2050657274696d62616e67616e20507265736964656e2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e44616c616d2070657274656d75616e20696e69204b6f6e736f727369756d2048696a6175206d656d617061726b616e206167656e64612d6167656e64612079616e672064696c616b756b616e2064616c616d2070726f6772616d2050656e676574616875616e2048696a617520646920646573612e2044722e204d61727961746d6f2c204d41205465616d204c6561646572204b6f6e736f727369756d2048696a6175206d656e676174616b616e206261687761207361617420696e69206c656d626167616e79612074656c6168206d656c616b756b616e2070656e64616d70696e67616e20646920313620646573612064692038204b616275706174656e20646920352070726f76696e736920756e74756b206d656e696e676b61746b616e206b617061736974617320616e616b2d616e616b206d7564612064616c616d2070656e67656c6f6c61616e2073756d626572206461796120616c616d6e79612e20e2809c48616c20696e692070656e74696e67206167617220706172612070656d7564612062697361206d656e696e676b61746b616e206b6573656a616874657261616e2074657461706920746964616b2064656e67616e206d65727573616b20616c616d2ce2809d20756a6172204d61727961746d6f2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e537269204164696e696e677369682c206d656e79616d627574206261696b206174617320696e6973696174696620756e74756b206d656d616a756b616e20646573612e2048616c207465727365627574207365737561692064656e67616e2073656d616e6761742064617269204e617761636974612079616e6720646963616e616e676b616e20507265736964656e204a6f6b6f205769646f646f2e20e2809c50656d62616e67756e616e2064657361206d65727570616b616e207072696f72697461732070656d62616e67756e616e2e205365737561692064656e67616e204e617761636974612c206d656d62616e67756e20646172692070696e67676972616e2ce2809d206a656c6173204164696e696e677369682e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e57616e74696d707265732c206c616e6a7574204164696e696e677369682c2074657262756b61206c65626172206261676920736961706170756e20756e74756b2062657273696e65726769206d656c616b73616e616b616e2070656d62616e67756e616e2064656d69206b656d616a75616e2062616e6773612064616e206e65676172612e20e2809c4b616d692070756e206265726b65696e67696e616e20756e74756b2062697361206d656c69686174206c616e6773756e67206469206c6170616e67616e206170612079616e672073756461682064696c616b756b616e206f6c65682074656d616e2d74656d616e2ce2809d2074616e64617320477572752042657361722046616b756c74617320456b6f6e6f6d692055474d2074657273656275742e2a2a20284554293c2f703e, '2015-11-11 02:21:36', 'Ya', 'Tidak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_demografi`
--

CREATE TABLE `tbl_demografi` (
  `id_demografi` int(10) NOT NULL,
  `id_pengguna` int(10) NOT NULL,
  `isi_demografi` blob NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto_banner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_demografi`
--

INSERT INTO `tbl_demografi` (`id_demografi`, `id_pengguna`, `isi_demografi`, `waktu`, `foto_banner`) VALUES
(1, 2, '', '2015-11-17 17:35:24', 'uploads/web/foto_banner_demografi.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gizi_buruk`
--

CREATE TABLE `tbl_gizi_buruk` (
  `id_gizi_buruk` int(10) NOT NULL,
  `berat_badan` int(10) NOT NULL,
  `tinggi_badan` int(10) NOT NULL,
  `tgl_timbang` datetime NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hub_kel`
--

CREATE TABLE `tbl_hub_kel` (
  `id_hub_kel` int(10) NOT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `id_penduduk` int(10) NOT NULL,
  `id_keluarga` int(10) NOT NULL,
  `id_status_keluarga` int(10) NOT NULL,
  `is_delete` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ikut_pindah_keluar`
--

CREATE TABLE `tbl_ikut_pindah_keluar` (
  `id_ikut_pindah_keluar` int(10) NOT NULL,
  `id_penduduk` int(10) NOT NULL,
  `id_pindah_keluar` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ikut_pindah_masuk`
--

CREATE TABLE `tbl_ikut_pindah_masuk` (
  `id_ikut_pindah_masuk` int(10) NOT NULL,
  `id_penduduk` int(10) NOT NULL,
  `id_keluarga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelahiran`
--

CREATE TABLE `tbl_kelahiran` (
  `id_kelahiran` int(10) NOT NULL,
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
  `id_surat` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keluarga`
--

CREATE TABLE `tbl_keluarga` (
  `id_keluarga` int(10) NOT NULL,
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
  `id_dusun` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kondisi_kehamilan`
--

CREATE TABLE `tbl_kondisi_kehamilan` (
  `id_kondisi_kehamilan` int(10) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `tgl_hpl` datetime NOT NULL,
  `is_resti` enum('Y','N') NOT NULL,
  `id_penduduk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kontak`
--

CREATE TABLE `tbl_kontak` (
  `id_kontak` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pesan` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_lembaga_desa`
--

CREATE TABLE `tbl_lembaga_desa` (
  `id_lembaga_desa` int(10) NOT NULL,
  `id_pengguna` int(10) NOT NULL,
  `isi_lembaga_desa` blob NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_lembaga_desa`
--

INSERT INTO `tbl_lembaga_desa` (`id_lembaga_desa`, `id_pengguna`, `isi_lembaga_desa`, `waktu`) VALUES
(1, 2, '', '2015-04-11 10:02:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id_log` int(20) NOT NULL,
  `fungsi` varchar(50) NOT NULL,
  `kegiatan` text NOT NULL,
  `kegiatan_rinci` text NOT NULL,
  `table` varchar(50) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(50) NOT NULL,
  `user_agent` text NOT NULL,
  `id_pengguna` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_log`
--

INSERT INTO `tbl_log` (`id_log`, `fungsi`, `kegiatan`, `kegiatan_rinci`, `table`, `waktu`, `ip_address`, `user_agent`, `id_pengguna`) VALUES
(1, 'delete', 'DELETE', '{"id_penduduk":"11"}', 'tbl_penduduk', '2016-03-22 07:20:13', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0', 3),
(2, 'delete', 'DELETE', '{"id_penduduk":"10"}', 'tbl_penduduk', '2016-03-22 07:20:13', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0', 3),
(3, 'delete', 'DELETE', '{"id_penduduk":"9"}', 'tbl_penduduk', '2016-03-22 07:20:13', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0', 3),
(4, 'delete', 'DELETE', '{"id_penduduk":"8"}', 'tbl_penduduk', '2016-03-22 07:20:13', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0', 3),
(5, 'delete', 'DELETE', '{"id_keluarga":"4"}', 'tbl_keluarga', '2016-03-22 07:20:25', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0', 3),
(6, 'delete', 'DELETE', '{"id_penduduk":"7"}', 'tbl_penduduk', '2016-03-22 07:20:35', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0', 3),
(7, 'delete', 'DELETE', '{"id_penduduk":"3"}', 'tbl_penduduk', '2016-03-22 07:21:40', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0', 3),
(8, 'delete', 'DELETE', '{"id_penduduk":""}', 'tbl_penduduk', '2016-03-22 07:21:40', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0', 3),
(9, 'delete', 'DELETE', '{"id_penduduk":"17"}', 'tbl_penduduk', '2016-04-29 03:29:25', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(10, 'delete', 'DELETE', '{"id_penduduk":"16"}', 'tbl_penduduk', '2016-04-29 03:29:25', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(11, 'delete', 'DELETE', '{"id_penduduk":"15"}', 'tbl_penduduk', '2016-04-29 03:29:25', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(12, 'delete', 'DELETE', '{"id_penduduk":"14"}', 'tbl_penduduk', '2016-04-29 03:29:25', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(13, 'delete', 'DELETE', '{"id_penduduk":"16"}', 'tbl_penduduk', '2016-04-29 03:29:29', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(14, 'delete', 'DELETE', '{"id_penduduk":"15"}', 'tbl_penduduk', '2016-04-29 03:29:29', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(15, 'delete', 'DELETE', '{"id_penduduk":"14"}', 'tbl_penduduk', '2016-04-29 03:29:29', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(16, 'delete', 'DELETE', '{"id_penduduk":"16"}', 'tbl_penduduk', '2016-04-29 03:29:33', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(17, 'delete', 'DELETE', '{"id_penduduk":"14"}', 'tbl_penduduk', '2016-04-29 03:29:33', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(18, 'delete', 'DELETE', '{"id_keluarga":"5"}', 'tbl_keluarga', '2016-04-29 03:29:38', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(19, 'delete', 'DELETE', '{"id_keluarga":"3"}', 'tbl_keluarga', '2016-04-29 03:29:39', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(20, 'delete', 'DELETE', '{"id_penduduk":"13"}', 'tbl_penduduk', '2016-04-29 03:29:43', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(21, 'delete', 'DELETE', '{"id_penduduk":"12"}', 'tbl_penduduk', '2016-04-29 03:29:44', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(22, 'delete', 'DELETE', '{"id_penduduk":"6"}', 'tbl_penduduk', '2016-04-29 03:29:44', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(23, 'delete', 'DELETE', '{"id_penduduk":"12"}', 'tbl_penduduk', '2016-04-29 03:29:52', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(24, 'delete', 'DELETE', '{"id_penduduk":"6"}', 'tbl_penduduk', '2016-04-29 03:29:52', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(25, 'delete', 'DELETE', '{"id_penduduk":"4"}', 'tbl_penduduk', '2016-04-29 03:29:52', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(26, 'delete', 'DELETE', '{"id_penduduk":"2"}', 'tbl_penduduk', '2016-04-29 03:29:52', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(27, 'delete', 'DELETE', '{"id_penduduk":"12"}', 'tbl_penduduk', '2016-04-29 03:29:57', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(28, 'delete', 'DELETE', '{"id_penduduk":"4"}', 'tbl_penduduk', '2016-04-29 03:29:58', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(29, 'delete', 'DELETE', '{"id_penduduk":"2"}', 'tbl_penduduk', '2016-04-29 03:29:58', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(30, 'delete', 'DELETE', '{"id_penduduk":""}', 'tbl_penduduk', '2016-04-29 03:29:58', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(31, 'delete', 'DELETE', '{"id_keluarga":"2"}', 'tbl_keluarga', '2016-04-29 03:30:03', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(32, 'delete', 'DELETE', '{"id_keluarga":"1"}', 'tbl_keluarga', '2016-04-29 03:30:03', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(33, 'delete', 'DELETE', '{"id_keluarga":""}', 'tbl_keluarga', '2016-04-29 03:30:03', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(34, 'delete', 'DELETE', '{"id_penduduk":"5"}', 'tbl_penduduk', '2016-04-29 03:30:07', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(35, 'delete', 'DELETE', '{"id_penduduk":"1"}', 'tbl_penduduk', '2016-04-29 03:30:07', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(36, 'delete', 'DELETE', '{"id_penduduk":""}', 'tbl_penduduk', '2016-04-29 03:30:07', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.87 Safari/537.36', 3),
(37, 'delete', 'DELETE', '{"id_penduduk":"28"}', 'tbl_penduduk', '2016-05-09 06:19:38', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 3),
(38, 'delete', 'DELETE', '{"id_penduduk":"27"}', 'tbl_penduduk', '2016-05-09 06:19:38', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 3),
(39, 'delete', 'DELETE', '{"id_penduduk":"26"}', 'tbl_penduduk', '2016-05-09 06:19:38', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 3),
(40, 'delete', 'DELETE', '{"id_penduduk":"25"}', 'tbl_penduduk', '2016-05-09 06:19:38', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 3),
(41, 'delete', 'DELETE', '{"id_penduduk":"19"}', 'tbl_penduduk', '2016-05-09 06:19:50', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 3),
(42, 'delete', 'DELETE', '{"id_penduduk":""}', 'tbl_penduduk', '2016-05-09 06:19:50', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 3),
(43, 'delete', 'DELETE', '{"id_penduduk":"20"}', 'tbl_penduduk', '2016-05-09 06:20:02', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 3),
(44, 'delete', 'DELETE', '{"id_penduduk":""}', 'tbl_penduduk', '2016-05-09 06:20:02', '0.0.0.0', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_logo`
--

CREATE TABLE `tbl_logo` (
  `id_logo` int(11) NOT NULL,
  `konten_logo_desa` varchar(50) NOT NULL,
  `konten_logo_kabupaten` varchar(50) NOT NULL,
  `path_css` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_logo`
--

INSERT INTO `tbl_logo` (`id_logo`, `konten_logo_desa`, `konten_logo_kabupaten`, `path_css`) VALUES
(1, 'uploads/web/logo_desa.png', 'uploads/web/logo_kabupaten.jpg', 'assetku/css/style.css');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meninggal`
--

CREATE TABLE `tbl_meninggal` (
  `id_meninggal` int(10) NOT NULL,
  `tgl_meninggal` datetime NOT NULL,
  `nama` varchar(50) NOT NULL,
  `sebab` varchar(50) DEFAULT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  `penentu_kematian` varchar(50) DEFAULT NULL,
  `tempat_kematian` varchar(100) DEFAULT NULL,
  `id_pelapor` int(10) DEFAULT NULL,
  `nama_pelapor` varchar(100) DEFAULT NULL,
  `hubungan_pelapor` varchar(100) DEFAULT NULL,
  `id_surat` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pages`
--

CREATE TABLE `tbl_pages` (
  `id` int(10) NOT NULL,
  `url` text NOT NULL,
  `title` text NOT NULL,
  `content` blob NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pages`
--

INSERT INTO `tbl_pages` (`id`, `url`, `title`, `content`, `updated`) VALUES
(5, 'web/c_sejarah', 'Sejarah Desa', '', '2015-04-30 18:45:43'),
(6, 'web/c_demografi', 'Demografi Desa', '', '2015-11-17 17:35:24'),
(7, 'web/c_visimisi', 'Visi Misi Desa', 0x556e74756b204d656d62616e67756e206e65676572692020, '2016-03-17 05:49:49'),
(13, 'web/c_home/get_detail_berita/10', 'tes lagi', 0x61736477716571, '2015-06-11 18:04:20'),
(14, 'web/c_home/get_detail_berita/11', 'asd', 0x616473, '2015-11-08 15:04:06'),
(15, 'web/c_home/get_detail_berita/12', 'abc', 0x616263, '2015-11-08 15:07:45'),
(16, 'web/c_home/get_detail_berita/13', 'bayi ajaib', 0x6261796920616a616962, '2015-11-08 15:16:56'),
(28, 'web/c_home/get_detail_berita/25', 'Konsorsium Hijau Diminta Kontribusi Wujudkan Green Buleleng', 0x3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e50656c616b73616e61616e2070726f6772616d2050656e676574616875616e2048696a6175206469204b616275706174656e2042756c656c656e672050726f76696e73692042616c69206f6c6568204b6f6e736f727369756d2048696a6175206d756c61692062657267756c69722e2044696d756c61696e79612070726f6772616d2070656e676574616875616e2068696a61752074657273656275742073656972696e672064696c616b73616e616b616e6e7961205261706174204b6f6f7264696e6173692050656c616b73616e61616e2050726f6772616d2048696261682050656e676574616875616e2048696a617520616e74617261204b6f6e736f727369756d2048696a61752064656e67616e2050656d6572696e746168204b616275706174656e2042756c656c656e672e204b6567696174616e2074657273656275742064696c616b73616e616b616e2070616461204b616d69732c2035204e6f76656d6265722032303135206469204b616e746f7220426164616e20506572656e63616e61616e2050656d62616e67756e616e2044616572616820284261707065646129204b616275706174656e2042756c656c656e672e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e44616c616d207261706174206b6f6f7264696e6173692074657273656275742068616469722049204167756e67205075747269204173747269642c204d412c266e6273703b20436f205465616d204c65616465722050726f6772616d2050656e676574616875616e2048696a61752064617269204b6f6e736f727369756d2048696a61752c2049727961205769736e756261646872612c2053542c204d542c204954204f6666696365722c2049722e20507574752047646520596173612053656b726574617269732042617070656461204b61622e2042756c656c656e672c204472732e2044657761204d616465205375646961727461204b6162696420536f7369616c2042756461796120426170706564612c20736572746120534b50442d534b5044207465726b616974206469204b61622e2042756c656c656e672e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e44616c616d205261706174204b6f6f7264696e6173692074657273656275742c2049204167756e672050757472692041737472696420617461752079616e67206269617361206469736170612047756e6720547269206d656e79616d7061696b616e2070726573656e74617369206d656e67656e61692070656c616b73616e61616e2070726f6772616d2070656e676574616875616e2068696a6175206469204b61622e2042756c656c656e672e20e2809c50726f6772616d2070656e676574616875616e2068696a61752062657274756a75616e20756e74756b206d656e696e676b61746b616e2070656d6168616d616e206d6173796172616b61742064657361206d656e67656e61692070656d62616e67756e616e2072656e646168206b6172626f6e2ce2809d206a656c61732047756e67205472692e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e426572626167616920616b7469766974617320616b616e2064696c616b73616e616b616e2064616c616d20736b656d612070726f6772616d2070656e676574616875616e2068696a61752c20616e74617261206c61696e2070656e656c697469616e20756e74756b206d656e6767616c692070656e676574616875616e206c6f6b616c2c2070656e696e676b6174616e206b6170617369746173206d6173796172616b61742064657361207365727461206d656e646f726f6e672070656e676574616875616e2079616e67206469686173696c6b616e206d6173756b2064616c616d2070726f7365732070656e67656d62696c616e206b6562696a616b616e20646920646573612c206b616275706174656e2c2070726f76696e7369206d617570756e206e6173696f6e616c2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223ee2809c59616e67206d656e6a61646920666f6b7573206b616d69206b65646570616e206164616c6168206164616e796120616e616b2d616e616b206d7564612079616e67206d656d696c696b69206b617061736974617320617461752070656e676574616875616e2079616e672068696a61752c20736568696e676761206d656e6a61646920616b746f722d616b746f722070656d6261727520646920646573612c206d617570756e206469206c75617220646573616e79612073656e646972692ce2809d20756a61722047756e67205472692e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e536564616e676b616e20507574752047646520596173612c206d656e676170726573696173692075706179612064617269204b6f6e736f727369756d2048696a617520756e74756b206d656e67656d62616e676b616e206d6173796172616b61742064657361207465727574616d612064616c616d20626964616e67206c696e676b756e67616e2e204d656e757275742053656b726574617269732042617070656461206b61622e2042756c656c656e672074657273656275742050726f76696e73692042616c69206a756761207375646168206d656e63616e616e676b616e207365626167616920477265656e2050726f76696e63652e20e2809c536179612062657268617261702064656e67616e206b6f6e747269627573692064617269204b6f6e736f727369756d2048696a6175206b6974612062697361206d656e6a61646920477265656e2042756c656c656e672ce2809d20756a61726e79612e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e4f6c656820736562616220697475206b697461206861727573206d656c6177616e2073656d616b696e206d656e696e676b61746e796120706f6c75736920434f322e204261696b2064617269206b656e64617261616e206265726d6f746f722c2070656d62616b6172616e2073616d706168206d617570756e206c61696e6e79612e20416c69682066756e677369206c6168616e2070756e2073656d657374696e79612073656d616b696e2064696b7572616e6769206b6172656e61206c6168616e2074657262756b612079616e672073656d616b696e20736564696b69742e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e53656c61696e204b616275706174656e2042756c656c656e672c204b6f6e736f727369756d2048696a6175206a756761206d656c616b73616e616b616e2070726f6772616d2050656e676574616875616e2048696a61752064692064656c6170616e206b616275706174656e2c20616e74617261206c61696e204b616275706174656e204c6f6d626f6b2054696d75722c204c6f6d626f6b2054656e6761682064692050726f76696e7369204e54422c2053756d62612054696d75722c2053756d62612054656e6761682064692070726f76696e7369204e54542c204d7561726f204a616d62692c2054616e6a756e67204a6162756e672054696d75722064692050726f76696e7369204a616d62692c2064616e204d616d756a752064692050726f76696e73692053756c61776573692042617261742e2a2a286574293c2f703e, '2015-11-09 10:27:42'),
(29, 'web/c_home/get_detail_berita/26', 'Konsorsium Hijau Periksa Krisis Sosial Ekologi Desa di 8 Kabupaten', 0x3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e4b6f6e736f727369756d2048696a61752074656c6168206d656d756c6169206b65726a61206c6170616e67616e20696d706c656d656e746173692070726f6772616d2070656e676574616875616e2068696a61752e204b65726a61206c6170616e67616e2064696d756c61692064656e67616e206d656c616b756b616e2052617069642041737365736d656e20746572686164617020313620646573612064692064656c6170616e206b616275706174656e206c6f6b6173692070726f6772616d2c2070616461206177616c2068696e6767612070657274656e676168616e204e6f76656d62657220696e692e20556e74756b2074616861702070657274616d612c2052617069642041737365736d656e2064696c616b756b616e206469204b616275706174656e204c6f6d626f6b2054696d75722c206c6f6d626f6b2054656e6761682c2053756d62612054696d75722c2053756d62612054656e6761682064616e204d616d756a752e20536564616e676b616e204b616275706174656e204d7561726f204a616d62692c2054616e6a756e67204a6162756e672054696d75722064616e2042756c656c656e6720616b616e2064696c616b73616e616b616e2064616c616d2077616b74752064656b61742e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e54756a75616e20646172692070726f7365732070656d6572696b7361616e20696e69206d656e646f726f6e67206b656d616e64697269616e2064657361206b68757375736e79612079616e67206d656e6a6164692077696c61796168206b6567696174616e2070656d6572696b7361616e2c207365727461206d656e646f726f6e67206c616869726e796120706172612070656d696d70696e206d61736120646570616e20646920646573612c2064617269206b616c616e67616e2067656e6572617369206d756461206261696b206c616b692d6c616b69206d617570756e20706572656d7075616e2e2050656d6572696b7361616e20696e692068616e796120616c617420756e74756b206d656e6361706169206475612076697369206b6567696174616e204b6f6e736f727369756d2048696a61752e204b6572616e676b61207574616d612064616c616d2072617069642061737365736d656e20696e692069616c6168206b726973697320736f7369616c20656b6f6c6f67697320646920646573612d6465736120646920496e646f6e657369612e2059616e672064696d616b737564206b726973697320736f7369616c20656b6f6c6f676973206164616c61682070656e7572756e616e2066756e67736920656b6f6c6f6769732064616e20616c616d2079616e6720706164612067696c6972616e6e79612062657264616d70616b2070616461206b656869647570616e20736f7369616c2e204b726973697320696e692062756b616e2073656261746173206b65727573616b616e20666973696b2062656c616b6120746170692074656c6168206d656e6a616e676b617520617370656b20736f7369616c2064616e2074656c6168206d656d70656e676172756869206d616e757369612079616e672074696e6767616c20646920646165726168206b72697369732e204b657361646172616e2077617267612064657361206d6973616c6e79612074656c616820646962656e74756b206f6c6568206b726973697320696e692e205761726761206261686b616e2074656c61682068696475702062657273616d61206b72697369732064616e206d656e616a6164692062616769616e2064616e2070656e6f70616e67207574616d612062616769206b65727573616b616e20616c616d2079616e67206265726b656c616e6a7574616e2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e44656e67616e206b617461206c61696e2c206b726973697320736f7369616c20656b6f6c6f676973206461706174206469706168616d69207365626167616920e2809c706179756e67e2809d206b6567696174616e2070656d6572696b7361616e20696e692e20556e74756b206461706174206d656d6168616d69206b726973697320736f7369616c20656b6f6c6f67697320646920617461732c2074656c616820646970696c696820e2809c70696e7475e2809d2079616e67206d656e6a61646920746974696b206d6173756b2c2079616b6e692070657274616e69616e2079616e6720746572696e746567726173692028696e7465677261746564206661726d696e672f4946292c20656e657267692079616e6720746572626172756b616e202872656e657761626c65656e657267792f5245292c206b65776972617573616861616e206265726261736973206e696c6169206c696e676b756e67616e2028677265656e20656e7472657072656e657572736869702f4745292c2064616e20706572656e63616e61616e206265726261736973207370617369616c20287370617469616c20706c616e6e696e672f5350292e20426964616e6720746572616b6869722c207370617469616c20706c616e6e696e6720285350292c20616b616e206d656e6a616469206b6572616e676b612070696b69722064616c616d206d656c69686174206b657469676120626964616e672079616e67206c61696e2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e53656c61696e207365626167616920e2809c70696e7475206d6173756be2809d206d656d6168616d69206b72697369732c206b65656d70617420626964616e6720696e6920616b616e206d656e6a61646920746974696b206d656e6361726920e2809c70696e7475206b656c756172e2809d2064617269206b726973697320736f7369616c20656b6f6c6f6769732e2053616174206d656d696b69726b616e207461776172616e206a616c616e206b656c7561722064692064657361207465726b616974206b726973697320696e692c206b657469676120626964616e6720696e69206164616c6168206d61746572692079616e6720616b616e206469646f726f6e672064616c616d2072616e676b61206d656d7065726b756174206b656d616e64697269616e2064616e206b65746168616e616e20646573612064656e67616e207072696e7369702079616e6720626572736168616261742070616461206c696e676b756e67616e2068696475702e204b657469676120626964616e6720696e696c61682079616e6720616b616e206d656e6a61646920617370656b206d656e646f726f6e6720656b6f6e6f6d6920646573612e2052617069642041737365736d656e7420616b616e2064696c616e6773756e676b616e2073656c616d61206475612062656c617320686172692e204164612031362070656e656c697469206d756461204b6f6e736f727369756d2048696a61752079616e6720616b616e2074696e6767616c2062657273616d61206d6173796172616b61742064692031362064657361206c6f6b6173692070656e656c697469616e2e2a2a2a20284554293c2f703e, '2015-11-09 10:30:11'),
(30, 'web/c_home/get_detail_berita/27', 'Kerangka Acuan Implementasi Sistem Informasi Desa dan Kawasan (SIDEKA) - Hijau sebagai sumber data', 0x4d616e6167656d656e7420496e666f726d6174696f6e2053797374656d20262334303b4d4953262334313b2064616c616d2062616861736120496e646f6e6573696120646973656275742064656e67616e2053697374656d20496e666f726d617369204d616e616a656d656e202853494d292c206164616c61682073697374656d20696e666f726d6173692079616e67206d656d62616e7475206d616e616a656d656e2064616c616d206d6572656e63616e616b616e20737472617465676973206269736e69732c2064616e206d656d656361686b616e206d6173616c6168206269736e697320736570657274692062696173612070726f64756b2064616e206c6179616e616e2e2053494d206469626564616b616e2064656e67616e2073697374656d20696e666f726d6173692062696173612f7472616e73616b73696f6e616c2028534929206b6172656e612053494d20646967756e616b616e20756e74756b206d656e67616e616c69736973205349206c61696e2079616e6720646974657261706b616e207061646120616b74697669746173206f7065726173696f6e616c206f7267616e69736173692e2053494d207061646120756d756d6e796120646967756e616b616e20756e74756b206d6572756a756b2070616461206b656c6f6d706f6b206d616e616a656d656e20696e666f726d6173692079616e672062657274616c69616e2064656e67616e206f746f6d6173692064616e2064756b756e67616e2074657268616461702070656e67616d62696c616e206b657075747573616e20626572646173617220646174612079616e6720616b757261742e2050616461206b6f6e74656b732070656d6572696e746168616e2064616c616d206d656e67656c6f6c61206b656c657374617269616e20616c616d206d616b61204d495320616b616e20646170617420646967756e616b616e20756e74756b206d656d6f6e69746f7220736563617261206f6e6c696e652c206d656e676576616c7561736920736563617261206f6e6c696e652c2079616e67207061646120616b6869726e796120646967756e616b616e20736562616761692064617361722070656e67616d62696c616e206b657075747573616e0a0a537961726174207574616d61206265726a616c616e6e7961204d49532079616e67206261696b206164616c616820746572696d706c656d656e746173696b616e6e79612053697374656d20496e666f726d617369205472616e73616b73696f6e616c2079616e67206261696b2070756c612e2053697374656d20496e666f726d617369207472616e73616b73696f6e616c206d656e6a6164692073756d62657220646174612062616769204d495320736568696e67676120696d706c656d656e74617369205349206d656e6a61646920737961726174206d75746c616b2062656b65726a616e7961204d49532e0a0a53697374656d20496e666f726d61736920446573612064616e204b61776173616e2028534944654b6129206d65727570616b616e207365627561682073697374656d20696e666f726d617369207472616e73616b73696f6e616c2079616e67206d616d7075206d656e67756d70756c6b616e2c206d656e676f6c6168206d617570756e206d656e79616a696b616e2064617461207365737561692064656e67616e206b656275747568616e2050656d6572696e74616820446573612e2020534944654b612064692064657361696e2064616c616d2068616c20616b757261736920646174612c2070656d616e66616174616e2064617461207365727461206b656365706174616e2064616c616d206d656d616e6767696c20646174612079616e6720616b616e206d656d62756b612062616e79616b206b656d756e676b696e616e2062616769206465736120756e74756b20616d62696c2062616769616e2064616c616d206d656e67757275732072756d61682074616e6767616e79612079616e67207061646120736161742062657273616d61616e206d656e6a616469206c616e676b6168206b6f6e7472696275736920646573612064616c616d20696b7574206d656e79656c657361696b616e206d6173616c61682d6d6173616c61682062616e6773612e0a0a53697374656d20696e666f726d61736920696e692064696b656d62616e676b616e2064656e67616e207072696e7369702d7072696e7369702070617274697369706173692c207472616e73706172616e73692064616e20616b756e746162696c697461732064616c616d207570617961206d656e646f726f6e672070656d62657264617961616e206d6173796172616b6174207365727461206d6577756a75646b616e206e696c61692d6e696c61692064656d6f6b72617469736173692064692074696e676b617420646573612e2044696d756c6169206461726920746168617020706572656e63616e61616e2c2070656e6767756d70756c616e20646174612c2070656e676f6c6168616e2068696e6767612070656d616e66616174616e20646174612c2073656d75612064696c616b756b616e206f6c65682070656d6465732062657273616d612064656e67616e206d6173796172616b6174207365636172612074657262756b612e2044616c616d2068616c2070656e79656c656e6767617261616e6e79612c20534944654b6120646972616e63616e672073656261676169207365627561682073697374656d20696e666f726d6173692079616e672074756d62756820646172692062617761682064616e20646962616e74752064656e67616e2070656e6761747572616e206b656c656d62616761616e2064616e206b6562696a616b616e206461726920617461732e200a534944454b41207361617420696e692074656c6168206469696d706c656d656e746173696b616e20736563617261206f6e6c696e65206469206c6562696820646172692038206b616275706174656e2064616e2034303020646573612e204d6173696e67206d6173696e6720646573612073656c616e6a75746e7961206d656d70756e7961692077656220736974652064656e67616e20646f6d61696e20646573612e69642079616e6720646170617420646967756e616b616e20756e74756b206d656e67656c6f6c612064617461207472616e73616b73696f6e616c206469206c6576656c20646573612e200a0a4b6f6e736f727369756d2048696a617520706164612051756172746572206b652d322062756c616e204a616e756172692c20616b616e206d656c616b73616e616b616e20616e616c69736973206b656275747568616e20284e656564206173736573736d656e74202f20726571756972656d656e7420616e616c797369732920756e74756b2070656e67656d62616e67616e204d616e6167656d656e7420496e666f726d6174696f6e2053797374656d20262334303b4d4953262334313b2064692074696e676b6174206b616275706174656e2e204b6172656e61204d4953206861727573206d656d70756e7961692073756d62657220646174612079616e6720616b757261742079616e67206265726173616c20646172692073697374656d20696e666f726d617369207472616e73616b73696f6e616c206d616b6120696d706c656d656e746173692f696e7374616c6173692053697374656d20496e666f726d61736920446573612064616e204b61776173616e206d656e6a6164692073616e6761742070656e74696e672064616e2064697065726c756b616e2e200a0a2044616c616d2070726f73657320696d706c656d656e746173692f696e7374616c61736920534944654b612c20646962757475686b616e2064756b756e67616e2074656e6167612061686c692074656b6e696b20696e666f726d6174696b6120285449292e2044756b756e67616e2074656e6167612061686c692079616e672062697361206265726173616c2064617269206d616861736973776120696e692064696d616b7375646b616e20756e74756b206d656c616b756b616e2070656e64616d70696e67616e2070656d6572696e74616820646573612064616c616d2070726f73657320696e7374616c61736920534944454b412079616e672062657262656e74756b20776562736974652064616e2061706c696b6173692064656e67616e206261736973206461746120646573612e2044616c616d2070726f73657320696e69206d6168617369737761206a75676120646968617261706b616e206461706174206d656c616b756b616e207472616e736665722070656e676574616875616e206b65706164612070656e67656c6f6c6120534944654b612e200a, '2015-11-17 16:13:32'),
(31, 'web/c_home/get_detail_berita/28', 'Kemenkominfo Kembali Meng-online-kan Desa-Desa Terdepan', 0x4a616b61727461202d204b656d656e74657269616e204b6f6d756e696b6173692064616e20496e666f726d6174696b612052657075626c696b20496e646f6e6573696120284b6f6d696e666f292042656b65726a6173616d612064656e67616e20556e69766572736974617320496e646f6e657369612c20494c4541442055492c205072616b6172736120446573612064616e20446573612042726f616462616e642054657270616475206d656e79656c656e67676172616b616e2050726f6772616d2050656c61746968616e2064616e2050656e64616d70696e67616e2053444d206469204465736120706164612073656e696e2068696e676761206a756d2761742028322d362f31312920646920486f74656c20416361636961204a616b617274612050757361742e200a0a536562616e79616b2035302050657277616b696c616e204d6173796172616b617420446573612064617269205065726261746173616e20496e646f6e6573696120646174616e6720756e74756b206d656e67696b757469206b6567696174616e2074657273656275742e204461726920353020446573612074657273656275742c206d6572656b61206d6577616b696c6920372050726f76696e73692079616e6720746572736562617220646920496e646f6e6573696120616e74617261206c61696e2c2050617075612c204b616c696d616e74616e2042617261742c204b616c696d616e74616e2055746172612c204e7573612054656e67676172612054696d757220284e5454292c204d616c756b752c204b6570756c6175616e20526961752064616e20526961752e200a0a50726f6772616d20446573612042726f616462616e6420546572706164752079616e672064697573756e67206f6c6568204b6f6d696e666f20696e692073656e67616a61206469706572756e74756b6b616e206261676920446573612044657361205065726261746173616e20646920496e646f6e657369612079616e67206d656e6a61646920426572616e6461204e65676172612e204b6172656e61206d656d616e672073656c616d6120696e69206b65626572616461616e204e656761726120646920446165726168205065726261746173616e206d617369682073616e676174206b7572616e67206469726173616b616e2e200a0a224b656861646972616e2050726f6772616d20446573612042726f616462616e64205465727061647520626167692035302044657361205065726261746173616e20696e69206164616c61682073616562616761692070696c6f742070726f6a65637420646920746168756e203230313520756e74756b206d656e6768616469726b616e204e656761726120646920426174617320496e646f6e657369612e204a696b612068616c20696e692064696e696c6169206261696b2c206d616b61206b65646570616e20616b616e206164612073656b69746172203130303020646573612079616e6720616b616e20646964616d70696e67692e2054756a75616e6e7961206164616c616820756e74756b206d656e696e676b61746b616e2070726f64756b74696669746173206d6173796172616b6174206d656c616c756920496e666f726d6174696b612c22207465676173204d617320446961204665627269616e737961682028506c742e204250335449204b6f6d696e666f292c20526162752028342f3131292e0a0a4a657072696164690a50656e64616d70696e672044657361204b616c69617527204b65632e2053616a696e67616e204265736172204b61622e2053616d626173202d204b616c696d616e74616e204261726174, '2015-11-09 14:05:50'),
(32, 'web/c_home/get_detail_berita/29', 'Watimpres Dukung Konsorsium Hijau Majukan Desa', 0x3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e4b726973697320736f7369616c2d656b6f6c6f67692079616e67206d656c616e646120496e646f6e657369612064616c616d2062656265726170612064656b61646520746572616b686972206d656d7065726c696861746b616e2062616877612070656d62616e67756e616e20746964616b206c6167692064617061742062657270696a616b207061646120706172616469676d612064616e20636172612079616e67206c616d612e2053616c61682073617475207465726f626f73616e2070656e74696e672079616e67206265726b656d62616e6720626562657261706120746168756e20746572616b68697220696e69206164616c6168206b6f6e7365702070656d62616e67756e616e20656b6f6e6f6d692064656e67616e206b6172626f6e2072656e64616820286c6f772d636172626f6e2065636f6e6f6d696320646576656c6f706d656e74292079616e672062657273616e64617220706164612067756775732070656d696b6972616e2064616e2070656e64656b6174616e2079616e6720756e74756b206d756461686e796120646973656275742050656e676574616875616e2048696a61752028477265656e204b6e6f776c65646765292e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e44616c616d20626562657261706120746168756e20746572616b6869722050656e676574616875616e2048696a6175206d756c6169206265726b656d62616e672070657361742064692062657262616761692062656c6168616e2064756e69612062657270696a616b2070616461206b65726167616d616e20747261646973692064616e206b65627564617961616e2c2070656d696b6972616e2064616e207072616b74656b2064692074696e676b6174206c6f6b616c2e204b6f6e736f727369756d2048696a6175206d656d626177612050656e676574616875616e2048696a6175206469206c6576656c20646573612c2079616e6720646967756e616b616e20756e74756b206d656e696e676b61746b616e206b6573656a616874657261616e206d6173796172616b61742064657361206e616d756e207465746170206d656c6573746172696b616e20616c616d2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e556e74756b206974756c6168204b6f6e736f727369756d2048696a6175206d656c616b756b616e2073656a756d6c61682070657274656d75616e2064616c616d206d656d70726f6d6f73696b616e206b6f6e7365702050656e676574616875616e2048696a61752c2073616c616820736174756e79612064656e67616e20446577616e2050657274696d62616e67616e20507265736964656e2028576174696d70726573292c2079616e672064696c616b73616e616b616e206469204b616e746f7220576174696d70726573204a616b617274612c2070616461204a756de2809961742c203330204f6b746f626572206c616c752e2050657274656d75616e20696e69206469686164697269206c616e6773756e672050726f662e2044722e20537269204164696e696e67736968204b6574756120446577616e2050657274696d62616e67616e20507265736964656e207365727461205369646172746f2044616e75737562726f746f20416e67676f746120446577616e2050657274696d62616e67616e20507265736964656e2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e44616c616d2070657274656d75616e20696e69204b6f6e736f727369756d2048696a6175206d656d617061726b616e206167656e64612d6167656e64612079616e672064696c616b756b616e2064616c616d2070726f6772616d2050656e676574616875616e2048696a617520646920646573612e2044722e204d61727961746d6f2c204d41205465616d204c6561646572204b6f6e736f727369756d2048696a6175206d656e676174616b616e206261687761207361617420696e69206c656d626167616e79612074656c6168206d656c616b756b616e2070656e64616d70696e67616e20646920313620646573612064692038204b616275706174656e20646920352070726f76696e736920756e74756b206d656e696e676b61746b616e206b617061736974617320616e616b2d616e616b206d7564612064616c616d2070656e67656c6f6c61616e2073756d626572206461796120616c616d6e79612e20e2809c48616c20696e692070656e74696e67206167617220706172612070656d7564612062697361206d656e696e676b61746b616e206b6573656a616874657261616e2074657461706920746964616b2064656e67616e206d65727573616b20616c616d2ce2809d20756a6172204d61727961746d6f2e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e537269204164696e696e677369682c206d656e79616d627574206261696b206174617320696e6973696174696620756e74756b206d656d616a756b616e20646573612e2048616c207465727365627574207365737561692064656e67616e2073656d616e6761742064617269204e617761636974612079616e6720646963616e616e676b616e20507265736964656e204a6f6b6f205769646f646f2e20e2809c50656d62616e67756e616e2064657361206d65727570616b616e207072696f72697461732070656d62616e67756e616e2e205365737561692064656e67616e204e617761636974612c206d656d62616e67756e20646172692070696e67676972616e2ce2809d206a656c6173204164696e696e677369682e3c2f703e3c70207374796c653d226c696e652d6865696768743a20323270783b20636f6c6f723a20726762283132312c203132312c20313231293b20666f6e742d66616d696c793a204c61746f2c2073616e732d73657269663b223e57616e74696d707265732c206c616e6a7574204164696e696e677369682c2074657262756b61206c65626172206261676920736961706170756e20756e74756b2062657273696e65726769206d656c616b73616e616b616e2070656d62616e67756e616e2064656d69206b656d616a75616e2062616e6773612064616e206e65676172612e20e2809c4b616d692070756e206265726b65696e67696e616e20756e74756b2062697361206d656c69686174206c616e6773756e67206469206c6170616e67616e206170612079616e672073756461682064696c616b756b616e206f6c65682074656d616e2d74656d616e2ce2809d2074616e64617320477572752042657361722046616b756c74617320456b6f6e6f6d692055474d2074657273656275742e2a2a20284554293c2f703e, '2015-11-11 02:21:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ped`
--

CREATE TABLE `tbl_ped` (
  `id_ped` int(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `luas` float NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  `lokasi` blob,
  `id_ped_sub` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ped_perkebunan`
--

CREATE TABLE `tbl_ped_perkebunan` (
  `id_ped_perkebunan` int(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `penggarap` varchar(20) NOT NULL,
  `jumlah_penggarap` int(4) NOT NULL,
  `luas` float NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ped_perkebunan`
--

INSERT INTO `tbl_ped_perkebunan` (`id_ped_perkebunan`, `deskripsi`, `penggarap`, `jumlah_penggarap`, `luas`, `lokasi`, `id_dusun`) VALUES
(1, 'Pohon Jarak', 'Pribadi', 10, 22, 'Utara Embung Tambakboyo', 0),
(2, 'Melon', 'Buruh', 14, 33, '-', 0),
(3, 'Salak', 'Buruh', 20, 15, '-', 0),
(4, 'Kopi', 'Pribadi', 20, 12, 'Selatan Kali Bayung', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ped_pertambakan`
--

CREATE TABLE `tbl_ped_pertambakan` (
  `id_ped_pertambakan` int(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `penggarap` varchar(20) NOT NULL,
  `jumlah_penggarap` int(4) NOT NULL,
  `luas` float NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ped_pertambakan`
--

INSERT INTO `tbl_ped_pertambakan` (`id_ped_pertambakan`, `deskripsi`, `penggarap`, `jumlah_penggarap`, `luas`, `lokasi`, `id_dusun`) VALUES
(1, 'Lele', 'Pribadi', 17, 2, 'Belakang Rumah Pak Sukarjo', 0),
(2, 'Gurame', 'Pribadi', 2, 5, '-', 0),
(3, 'Nila', 'Buruh', 55, 23, '-', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ped_pertanian`
--

CREATE TABLE `tbl_ped_pertanian` (
  `id_ped_pertanian` int(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `penggarap` varchar(20) NOT NULL,
  `jumlah_penggarap` int(4) NOT NULL,
  `luas` float NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ped_pertanian`
--

INSERT INTO `tbl_ped_pertanian` (`id_ped_pertanian`, `deskripsi`, `penggarap`, `jumlah_penggarap`, `luas`, `lokasi`, `id_dusun`) VALUES
(3, 'Padi', 'Buruh', 150, 23, 'Belakang Balai Desa, Utara Embung', 0),
(4, 'Kacang Tanah', 'Pribadi', 50, 34, 'Timur tanah kas desa', 0),
(5, 'Jagung', 'Pribadi', 100, 6, 'Selatan sungai Winongo', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ped_potensi_wisata`
--

CREATE TABLE `tbl_ped_potensi_wisata` (
  `id_ped_potensi_wisata` int(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ped_potensi_wisata`
--

INSERT INTO `tbl_ped_potensi_wisata` (`id_ped_potensi_wisata`, `deskripsi`, `lokasi`, `id_dusun`) VALUES
(1, 'Pantai', '-', 0),
(2, 'Hutan Lindung', '-', 0),
(3, 'Air Terjun', '-', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ped_sumber_air`
--

CREATE TABLE `tbl_ped_sumber_air` (
  `id_ped_sumber_air` int(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ped_sumber_air`
--

INSERT INTO `tbl_ped_sumber_air` (`id_ped_sumber_air`, `deskripsi`, `lokasi`, `id_dusun`) VALUES
(1, 'Embung Sungai Winongo', 'Utara Kantor Lurah', 0),
(2, 'Danau', '-', 0),
(3, 'Embung', '-', 0),
(4, 'Air Terjun Cijerah', 'Dekat Hutan Pinus', 0),
(5, 'Water torrent utama dusun', 'Utara Kantor PKK', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ped_sumber_energi`
--

CREATE TABLE `tbl_ped_sumber_energi` (
  `id_ped_sumber_energi` int(4) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `id_dusun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ped_sumber_energi`
--

INSERT INTO `tbl_ped_sumber_energi` (`id_ped_sumber_energi`, `deskripsi`, `lokasi`, `id_dusun`) VALUES
(1, 'Pembangkit Listrik Tenaga Matahari', 'Utara Sungai Winongo', 0),
(2, 'Pembangkit Listrik Kincir Angin', '-', 0),
(3, 'Pembangkit Listrik Mikrohidro', '-', 0),
(4, 'Pembangkit Listrik Tenaga Air Laut', '-', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penduduk`
--

CREATE TABLE `tbl_penduduk` (
  `id_penduduk` int(10) NOT NULL,
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
  `pendapatan_per_bulan` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id_pengguna` int(10) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_pengguna` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `is_delete` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id_pengguna`, `nik`, `nama_pengguna`, `password`, `nama`, `no_telepon`, `role`, `foto`, `is_delete`) VALUES
(0, '', 'helpdesk-admin', '2ba1a6b1bcaf35adfcfe46a48bfddaea8f15632e', '', '', 'Administrator', '', 'Y'),
(1, '', 'helpdesk-pengelola', '2ba1a6b1bcaf35adfcfe46a48bfddaea8f15632e', '', '', 'Pengelola Data', '', 'Y'),
(2, '', 'sidekaadmin', '94359e74e6888e13a9a79800d418bd1aa0121c60', '', '', 'Administrator', '', 'N'),
(3, '', 'sidekapengelola', '94359e74e6888e13a9a79800d418bd1aa0121c60', '', '', 'Pengelola Data', '', 'N'),
(4, '', 'sidekaaset', '94359e74e6888e13a9a79800d418bd1aa0121c60', '', '', 'Pengelola Aset', '', 'N'),
(5, '', 'sidekapeta', '94359e74e6888e13a9a79800d418bd1aa0121c60', '', '', 'Pengelola Peta', '', 'N'),
(6, '', 'sidekaperencana', '94359e74e6888e13a9a79800d418bd1aa0121c60', '', '', 'Perencana Pembangunan', '', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_perangkat`
--

CREATE TABLE `tbl_perangkat` (
  `id_perangkat` int(10) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `niap` varchar(25) NOT NULL,
  `no_sk_angkat` varchar(50) NOT NULL,
  `tgl_angkat` datetime NOT NULL,
  `id_pangkat_gol` int(11) NOT NULL,
  `no_sk_berhenti` varchar(50) DEFAULT NULL,
  `tgl_berhenti` datetime DEFAULT NULL,
  `id_jabatan` int(10) NOT NULL,
  `id_penduduk` int(10) DEFAULT NULL,
  `is_aktif` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_perangkat`
--

INSERT INTO `tbl_perangkat` (`id_perangkat`, `nip`, `niap`, `no_sk_angkat`, `tgl_angkat`, `id_pangkat_gol`, `no_sk_berhenti`, `tgl_berhenti`, `id_jabatan`, `id_penduduk`, `is_aktif`) VALUES
(1, '121313413', '1212141', '1213131', '2016-04-22 00:00:00', 1, NULL, '2021-04-23 00:00:00', 1, 5, 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_peta`
--

CREATE TABLE `tbl_peta` (
  `id_peta` int(4) NOT NULL,
  `embed` blob NOT NULL,
  `lokasi` blob NOT NULL,
  `id_desa` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_peta`
--

INSERT INTO `tbl_peta` (`id_peta`, `embed`, `lokasi`, `id_desa`) VALUES
(1, 0x7b227a6f6f6d223a223131222c2263656e746572223a222d322e3838303131392c203130382e313433333830222c2274797065223a22524f41444d4150222c2274616d70696c223a2274727565222c22706174685f6f7665726c6179496d616765223a2275706c6f6164735c2f6d61705c2f6f7665726c6179496d6167652e6a7067222c22706f696e7431223a222d322e3936393733373936303630313238372c203130382e30373637343234313837303132222c22706f696e7432223a222d322e383237393039323130343532303134352c203130382e3232393830353438353539353736227d, 0x766172206d79436f6f7264696e61746573426174617357696c6179616831203d205b0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3839393135332c3130382e303738303033292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3839373738312c3130382e303933373936292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3839353033382c3130382e303934333937292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3838393830392c3130382e303933313532292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3838363436362c3130382e313031313737292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3837343436352c3130382e313036383432292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3836353132312c3130382e313036333237292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3835363239312c3130382e313035303339292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3834363030352c3130382e313037393538292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3833333331372c3130382e313038393032292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3833363734362c3130382e313332373633292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3833323238382c3130382e313535333336292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3833333833312c3130382e313734313736292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3835303337362c3130382e313834393639292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3836363932302c3130382e313837353233292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3838303239332c3130382e313637303039292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3930333236372c3130382e313731323135292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3931393034302c3130382e323035373139292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3934363831332c3130382e323032363330292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3935313631332c3130382e313934373333292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3935383831332c3130382e313833303630292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3936303138352c3130382e313539373134292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3935383634322c3130382e313431353138292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3936333237302c3130382e313238383135292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3935343031332c3130382e313138353135292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3935323239382c3130382e303939393736292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3932373434302c3130382e303932393337292c0d0a0a6e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3930383735332c3130382e303831373739290d0a0a5d3b0d0a0a76617220706f6c794f7074696f6e73426174617357696c6179616831203d207b0d0a0a706174683a206d79436f6f7264696e61746573426174617357696c61796168312c0d0a0a7374726f6b65436f6c6f723a202223464630303030222c0d0a0a7374726f6b654f7061636974793a20312c0d0a0a7374726f6b655765696768743a20312e352c0d0a0a66696c6c436f6c6f723a202223464630303030222c0d0a0a66696c6c4f7061636974793a20302e30352c0d0a0a7a496e6465783a202d312c0d0a0a706f736974696f6e3a206e657720676f6f676c652e6d6170732e4c61744c6e67282d322e3839393135332c3130382e303738303033290d0a0a7d0d0a0a766172206974426174617357696c6179616831203d206e657720676f6f676c652e6d6170732e506f6c79676f6e28706f6c794f7074696f6e73426174617357696c6179616831293b0d0a0a6974426174617357696c61796168312e7365744d6170286d6170293b0d0a0a7661722061727261794c6f63203d205b222d322e3839393135332c3130382e303738303033222c222d322e3839373738312c3130382e303933373936222c222d322e3839353033382c3130382e303934333937222c222d322e3838393830392c3130382e303933313532222c222d322e3838363436362c3130382e313031313737222c222d322e3837343436352c3130382e313036383432222c222d322e3836353132312c3130382e313036333237222c222d322e3835363239312c3130382e313035303339222c222d322e3834363030352c3130382e313037393538222c222d322e3833333331372c3130382e313038393032222c222d322e3833363734362c3130382e313332373633222c222d322e3833323238382c3130382e313535333336222c222d322e3833333833312c3130382e313734313736222c222d322e3835303337362c3130382e313834393639222c222d322e3836363932302c3130382e313837353233222c222d322e3838303239332c3130382e313637303039222c222d322e3930333236372c3130382e313731323135222c222d322e3931393034302c3130382e323035373139222c222d322e3934363831332c3130382e323032363330222c222d322e3935313631332c3130382e313934373333222c222d322e3935383831332c3130382e313833303630222c222d322e3936303138352c3130382e313539373134222c222d322e3935383634322c3130382e313431353138222c222d322e3936333237302c3130382e313238383135222c222d322e3935343031332c3130382e313138353135222c222d322e3935323239382c3130382e303939393736222c222d322e3932373434302c3130382e303932393337222c222d322e3930383735332c3130382e303831373739225d3b, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pindah_keluar`
--

CREATE TABLE `tbl_pindah_keluar` (
  `id_pindah_keluar` int(10) NOT NULL,
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
  `id_alasan_pindah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pindah_masuk`
--

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
  `id_alasan_pindah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_regulasi`
--

CREATE TABLE `tbl_regulasi` (
  `id_regulasi` int(11) NOT NULL,
  `judul_regulasi` varchar(100) NOT NULL,
  `isi_regulasi` varchar(100) NOT NULL,
  `file_regulasi` varchar(100) NOT NULL,
  `id_desa` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_regulasi`
--

INSERT INTO `tbl_regulasi` (`id_regulasi`, `judul_regulasi`, `isi_regulasi`, `file_regulasi`, `id_desa`) VALUES
(1, 'UUD', 'Undang Undang Desa', 'uploads/files/UUD.zip', 1),
(2, 'Peraturan Menteri', 'Peraturan Menteri Dalam Negri thn 2014', 'uploads/files/sample.zip', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_apbdes`
--

CREATE TABLE `tbl_rp_apbdes` (
  `id_apbdes` int(11) NOT NULL,
  `id_m_apbdes` int(11) DEFAULT NULL,
  `id_top_coa` int(11) DEFAULT NULL,
  `id_coa` int(11) DEFAULT NULL,
  `anggaran` decimal(10,0) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_lpj`
--

CREATE TABLE `tbl_rp_lpj` (
  `id_lpj` int(11) NOT NULL,
  `penerima` varchar(100) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `tgl_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_m_apbdes`
--

CREATE TABLE `tbl_rp_m_apbdes` (
  `id_m_apbdes` int(11) NOT NULL,
  `id_m_rkp` int(11) DEFAULT NULL,
  `total_pendapatan` decimal(10,0) DEFAULT NULL,
  `total_belanja` decimal(10,0) DEFAULT NULL,
  `total_pembiayaan` decimal(10,0) DEFAULT NULL,
  `tanggal_disetujui` date DEFAULT NULL,
  `disetujui_oleh` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_m_rancangan_rpjm_desa`
--

CREATE TABLE `tbl_rp_m_rancangan_rpjm_desa` (
  `id_m_rancangan_rpjm_desa` int(11) NOT NULL,
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
  `id_provinsi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_m_rkp`
--

CREATE TABLE `tbl_rp_m_rkp` (
  `id_m_rkp` int(11) NOT NULL,
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
  `tanggal_disusun` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_rabdes`
--

CREATE TABLE `tbl_rp_rabdes` (
  `id_rabdes` int(11) NOT NULL,
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
  `tgl_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_rabdes_anggaran`
--

CREATE TABLE `tbl_rp_rabdes_anggaran` (
  `id_rabdes_anggaran` int(11) NOT NULL,
  `uraian` varchar(100) DEFAULT NULL,
  `volume` varchar(30) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `id_rabdes` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `tgl_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_rancangan_rpjm_desa`
--

CREATE TABLE `tbl_rp_rancangan_rpjm_desa` (
  `id_rancangan_rpjm_desa` int(11) NOT NULL,
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
  `id_m_rancangan_rpjm_desa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_rkp`
--

CREATE TABLE `tbl_rp_rkp` (
  `id_rkp` int(11) NOT NULL,
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
  `kerjasama_pihak_ketiga` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_rkpdes`
--

CREATE TABLE `tbl_rp_rkpdes` (
  `id_rkpdes` int(11) NOT NULL,
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
  `id_coa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_rp_rkpdes`
--

INSERT INTO `tbl_rp_rkpdes` (`id_rkpdes`, `program`, `indikator`, `kondisi_awal`, `target`, `volume`, `lokasi`, `nominal`, `id_parent_rkpdes`, `id_top_rkpdes`, `id_rpjmdes`, `id_tahun_anggaran`, `id_sumber_dana`, `id_bidang`, `id_coa`) VALUES
(1, 'asdf', 'asdf', 'asdf', 'asdf', NULL, 'asdf', 2000000, NULL, NULL, 1, 4, 3, 30, 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_rpjmd`
--

CREATE TABLE `tbl_rp_rpjmd` (
  `id_rpjmd` int(11) NOT NULL,
  `program` varchar(100) NOT NULL,
  `kondisi_awal` varchar(50) DEFAULT NULL,
  `target` varchar(50) DEFAULT NULL,
  `id_parent_rpjmd` int(11) DEFAULT NULL,
  `id_top_rpjmd` int(11) DEFAULT NULL,
  `id_tahun_anggaran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_rp_rpjmd`
--

INSERT INTO `tbl_rp_rpjmd` (`id_rpjmd`, `program`, `kondisi_awal`, `target`, `id_parent_rpjmd`, `id_top_rpjmd`, `id_tahun_anggaran`) VALUES
(1, 'a', 'a', 'a', NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_rpjmdes`
--

CREATE TABLE `tbl_rp_rpjmdes` (
  `id_rpjmdes` int(11) NOT NULL,
  `program` varchar(100) NOT NULL,
  `indikator` varchar(100) DEFAULT NULL,
  `kondisi_awal` varchar(50) DEFAULT NULL,
  `target` varchar(50) DEFAULT NULL,
  `capaian` varchar(100) DEFAULT NULL,
  `id_parent_rpjmdes` int(11) DEFAULT NULL,
  `id_top_rpjmdes` int(11) DEFAULT NULL,
  `id_rpjmd` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_bidang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_rp_rpjmdes`
--

INSERT INTO `tbl_rp_rpjmdes` (`id_rpjmdes`, `program`, `indikator`, `kondisi_awal`, `target`, `capaian`, `id_parent_rpjmdes`, `id_top_rpjmdes`, `id_rpjmd`, `id_periode`, `id_bidang`) VALUES
(1, 'asdf', 'asdf', 'asdf', 'asdf', 'asdf', NULL, NULL, 1, 4, 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_rpjmdes_detail`
--

CREATE TABLE `tbl_rp_rpjmdes_detail` (
  `id_rpjmdes_detail` int(11) NOT NULL,
  `volume` varchar(10) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `nominal` double NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `id_rpjmdes` int(11) NOT NULL,
  `id_tahun_anggaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_spp`
--

CREATE TABLE `tbl_rp_spp` (
  `id_spp` int(11) NOT NULL,
  `tgl_ambil` date NOT NULL,
  `total` int(25) DEFAULT NULL,
  `id_rabdes` int(11) NOT NULL,
  `tgl_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_rp_spp_detail`
--

CREATE TABLE `tbl_rp_spp_detail` (
  `id_spp_detail` int(11) NOT NULL,
  `pagu_anggaran` int(25) DEFAULT NULL,
  `pencairan_yg_lalu` int(25) DEFAULT '0',
  `permintaan_sekarang` int(25) DEFAULT NULL,
  `jumlah_saat_ini` int(25) DEFAULT NULL,
  `sisa_dana` int(25) DEFAULT NULL,
  `id_spp` int(11) NOT NULL,
  `id_rabdes_anggaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sejarah`
--

CREATE TABLE `tbl_sejarah` (
  `id_sejarah` int(10) NOT NULL,
  `id_pengguna` int(10) NOT NULL,
  `isi_sejarah` blob NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto_banner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sejarah`
--

INSERT INTO `tbl_sejarah` (`id_sejarah`, `id_pengguna`, `isi_sejarah`, `waktu`, `foto_banner`) VALUES
(1, 2, '', '2015-04-11 10:02:16', 'uploads/web/foto_banner_sejarah.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_slider_beranda`
--

CREATE TABLE `tbl_slider_beranda` (
  `id_slider_beranda` int(11) NOT NULL,
  `konten_background` varchar(100) NOT NULL,
  `konten_logo` varchar(100) NOT NULL,
  `konten_teks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_slider_beranda`
--

INSERT INTO `tbl_slider_beranda` (`id_slider_beranda`, `konten_background`, `konten_logo`, `konten_teks`) VALUES
(1, 'uploads/web/slider_beranda/background_1d9.jpg', 'uploads/web/slider_beranda/logo_1d9.png', '[SISTEM INFORMASI DESA DAN KAWASAN]'),
(2, 'uploads/web/slider_beranda/background_e91.jpg', 'uploads/web/slider_beranda/logo_e91.png', 'SIDeKa ver 1.6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sso`
--

CREATE TABLE `tbl_sso` (
  `id_sso` int(4) NOT NULL,
  `app_id` varchar(50) NOT NULL,
  `token_app` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sso`
--

INSERT INTO `tbl_sso` (`id_sso`, `app_id`, `token_app`) VALUES
(1, 'sideka', '416f1eb633f057873053d8a203eb6b92');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat`
--

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
  `id_penduduk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_visi_misi`
--

CREATE TABLE `tbl_visi_misi` (
  `id_visi_misi` int(10) NOT NULL,
  `id_pengguna` int(10) NOT NULL,
  `isi_visi_misi` blob NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto_banner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_visi_misi`
--

INSERT INTO `tbl_visi_misi` (`id_visi_misi`, `id_pengguna`, `isi_visi_misi`, `waktu`, `foto_banner`) VALUES
(1, 2, 0x556e74756b204d656d62616e67756e206e65676572692020, '2016-03-16 23:49:49', 'uploads/web/foto_banner_visimisi.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ref_agama`
--
ALTER TABLE `ref_agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `ref_alasan_pindah`
--
ALTER TABLE `ref_alasan_pindah`
  ADD PRIMARY KEY (`id_alasan_pindah`);

--
-- Indexes for table `ref_asal_aset`
--
ALTER TABLE `ref_asal_aset`
  ADD PRIMARY KEY (`id_asal_aset`);

--
-- Indexes for table `ref_desa`
--
ALTER TABLE `ref_desa`
  ADD PRIMARY KEY (`id_desa`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `ref_difabilitas`
--
ALTER TABLE `ref_difabilitas`
  ADD PRIMARY KEY (`id_difabilitas`);

--
-- Indexes for table `ref_dusun`
--
ALTER TABLE `ref_dusun`
  ADD PRIMARY KEY (`id_dusun`),
  ADD KEY `id_desa` (`id_desa`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `ref_goldar`
--
ALTER TABLE `ref_goldar`
  ADD PRIMARY KEY (`id_goldar`);

--
-- Indexes for table `ref_jabatan`
--
ALTER TABLE `ref_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `ref_jenis_pindah`
--
ALTER TABLE `ref_jenis_pindah`
  ADD PRIMARY KEY (`id_jenis_pindah`);

--
-- Indexes for table `ref_jen_kel`
--
ALTER TABLE `ref_jen_kel`
  ADD PRIMARY KEY (`id_jen_kel`);

--
-- Indexes for table `ref_kab_kota`
--
ALTER TABLE `ref_kab_kota`
  ADD PRIMARY KEY (`id_kab_kota`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indexes for table `ref_kategori_aset`
--
ALTER TABLE `ref_kategori_aset`
  ADD PRIMARY KEY (`id_kategori_aset`);

--
-- Indexes for table `ref_kecamatan`
--
ALTER TABLE `ref_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`),
  ADD KEY `id_kab_kota` (`id_kab_kota`);

--
-- Indexes for table `ref_kelas_sosial`
--
ALTER TABLE `ref_kelas_sosial`
  ADD PRIMARY KEY (`id_kelas_sosial`);

--
-- Indexes for table `ref_kepemilikan_aset`
--
ALTER TABLE `ref_kepemilikan_aset`
  ADD PRIMARY KEY (`id_kepemilikan_aset`);

--
-- Indexes for table `ref_kewarganegaraan`
--
ALTER TABLE `ref_kewarganegaraan`
  ADD PRIMARY KEY (`id_kewarganegaraan`);

--
-- Indexes for table `ref_klasifikasi_pindah`
--
ALTER TABLE `ref_klasifikasi_pindah`
  ADD PRIMARY KEY (`id_klasifikasi_pindah`);

--
-- Indexes for table `ref_kode_surat`
--
ALTER TABLE `ref_kode_surat`
  ADD PRIMARY KEY (`kode_surat`);

--
-- Indexes for table `ref_kompetensi`
--
ALTER TABLE `ref_kompetensi`
  ADD PRIMARY KEY (`id_kompetensi`);

--
-- Indexes for table `ref_kontrasepsi`
--
ALTER TABLE `ref_kontrasepsi`
  ADD PRIMARY KEY (`id_kontrasepsi`);

--
-- Indexes for table `ref_pangkat_gol`
--
ALTER TABLE `ref_pangkat_gol`
  ADD PRIMARY KEY (`id_pangkat_gol`);

--
-- Indexes for table `ref_ped_kategori`
--
ALTER TABLE `ref_ped_kategori`
  ADD PRIMARY KEY (`id_ped_kategori`);

--
-- Indexes for table `ref_ped_sub`
--
ALTER TABLE `ref_ped_sub`
  ADD PRIMARY KEY (`id_ped_sub`),
  ADD KEY `id_ped_kategori` (`id_ped_kategori`);

--
-- Indexes for table `ref_pekerjaan`
--
ALTER TABLE `ref_pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `ref_pekerjaan_ped`
--
ALTER TABLE `ref_pekerjaan_ped`
  ADD PRIMARY KEY (`id_pekerjaan_ped`);

--
-- Indexes for table `ref_pelapor`
--
ALTER TABLE `ref_pelapor`
  ADD PRIMARY KEY (`id_pelapor`);

--
-- Indexes for table `ref_pendidikan`
--
ALTER TABLE `ref_pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indexes for table `ref_provinsi`
--
ALTER TABLE `ref_provinsi`
  ADD PRIMARY KEY (`id_provinsi`);

--
-- Indexes for table `ref_rp_bidang`
--
ALTER TABLE `ref_rp_bidang`
  ADD PRIMARY KEY (`id_bidang`),
  ADD KEY `id_parent_bidang` (`id_parent_bidang`),
  ADD KEY `id_parent_bidang_2` (`id_parent_bidang`),
  ADD KEY `id_top_bidang` (`id_top_bidang`);

--
-- Indexes for table `ref_rp_coa`
--
ALTER TABLE `ref_rp_coa`
  ADD PRIMARY KEY (`id_coa`),
  ADD KEY `id_parent_coa` (`id_parent_coa`),
  ADD KEY `id_parent_coa_2` (`id_parent_coa`);

--
-- Indexes for table `ref_rp_periode`
--
ALTER TABLE `ref_rp_periode`
  ADD PRIMARY KEY (`id_periode`);

--
-- Indexes for table `ref_rp_sumber_dana`
--
ALTER TABLE `ref_rp_sumber_dana`
  ADD PRIMARY KEY (`id_sumber_dana`),
  ADD KEY `id_tahun_anggaran` (`id_tahun_anggaran`);

--
-- Indexes for table `ref_rp_sumber_dana_desa`
--
ALTER TABLE `ref_rp_sumber_dana_desa`
  ADD PRIMARY KEY (`id_sumber_dana_desa`);

--
-- Indexes for table `ref_rp_tahun_anggaran`
--
ALTER TABLE `ref_rp_tahun_anggaran`
  ADD PRIMARY KEY (`id_tahun_anggaran`),
  ADD KEY `id_tahun` (`id_tahun_anggaran`),
  ADD KEY `id_tahun_2` (`id_tahun_anggaran`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indexes for table `ref_rt`
--
ALTER TABLE `ref_rt`
  ADD PRIMARY KEY (`id_rt`),
  ADD KEY `id_penduduk` (`id_penduduk`),
  ADD KEY `id_rw` (`id_rw`),
  ADD KEY `id_penduduk_2` (`id_penduduk`);

--
-- Indexes for table `ref_rw`
--
ALTER TABLE `ref_rw`
  ADD PRIMARY KEY (`id_rw`),
  ADD KEY `id_dusun` (`id_dusun`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `ref_status_kawin`
--
ALTER TABLE `ref_status_kawin`
  ADD PRIMARY KEY (`id_status_kawin`);

--
-- Indexes for table `ref_status_keluarga`
--
ALTER TABLE `ref_status_keluarga`
  ADD PRIMARY KEY (`id_status_keluarga`);

--
-- Indexes for table `ref_status_penduduk`
--
ALTER TABLE `ref_status_penduduk`
  ADD PRIMARY KEY (`id_status_penduduk`);

--
-- Indexes for table `ref_status_tinggal`
--
ALTER TABLE `ref_status_tinggal`
  ADD PRIMARY KEY (`id_status_tinggal`);

--
-- Indexes for table `tbl_aset_bangunan`
--
ALTER TABLE `tbl_aset_bangunan`
  ADD PRIMARY KEY (`id_aset_bangunan`),
  ADD KEY `id_aset_tanah` (`id_aset_tanah`),
  ADD KEY `kepemilikan` (`id_kepemilikan_aset`);

--
-- Indexes for table `tbl_aset_master`
--
ALTER TABLE `tbl_aset_master`
  ADD PRIMARY KEY (`id_aset_master`),
  ADD KEY `id_aset_ruang` (`id_aset_ruangan`),
  ADD KEY `id_kategori_aset` (`id_kategori_aset`),
  ADD KEY `id_asal_aset` (`id_asal_aset`),
  ADD KEY `id_kepemilikan_aset` (`id_kepemilikan_aset`);

--
-- Indexes for table `tbl_aset_perawatan_bgn`
--
ALTER TABLE `tbl_aset_perawatan_bgn`
  ADD PRIMARY KEY (`id_aset_perawatan_bgn`),
  ADD KEY `id_aset_bangunan` (`id_aset_bangunan`);

--
-- Indexes for table `tbl_aset_ruangan`
--
ALTER TABLE `tbl_aset_ruangan`
  ADD PRIMARY KEY (`id_aset_ruangan`),
  ADD KEY `id_aset_bangunan` (`id_aset_bangunan`);

--
-- Indexes for table `tbl_aset_tanah`
--
ALTER TABLE `tbl_aset_tanah`
  ADD PRIMARY KEY (`id_aset_tanah`),
  ADD KEY `id_kepemilikan_aset` (`id_kepemilikan_aset`);

--
-- Indexes for table `tbl_berita`
--
ALTER TABLE `tbl_berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tbl_demografi`
--
ALTER TABLE `tbl_demografi`
  ADD PRIMARY KEY (`id_demografi`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tbl_gizi_buruk`
--
ALTER TABLE `tbl_gizi_buruk`
  ADD PRIMARY KEY (`id_gizi_buruk`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `tbl_hub_kel`
--
ALTER TABLE `tbl_hub_kel`
  ADD PRIMARY KEY (`id_hub_kel`),
  ADD KEY `id_penduduk` (`id_penduduk`),
  ADD KEY `id_keluarga` (`id_keluarga`),
  ADD KEY `id_status_keluarga` (`id_status_keluarga`);

--
-- Indexes for table `tbl_ikut_pindah_keluar`
--
ALTER TABLE `tbl_ikut_pindah_keluar`
  ADD PRIMARY KEY (`id_ikut_pindah_keluar`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `tbl_ikut_pindah_masuk`
--
ALTER TABLE `tbl_ikut_pindah_masuk`
  ADD PRIMARY KEY (`id_ikut_pindah_masuk`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `tbl_kelahiran`
--
ALTER TABLE `tbl_kelahiran`
  ADD PRIMARY KEY (`id_kelahiran`),
  ADD KEY `id_ayah` (`id_keluarga`),
  ADD KEY `id_pelapor` (`id_pelapor`),
  ADD KEY `id_penduduk` (`id_penduduk`),
  ADD KEY `id_surat` (`id_surat`);

--
-- Indexes for table `tbl_keluarga`
--
ALTER TABLE `tbl_keluarga`
  ADD PRIMARY KEY (`id_keluarga`),
  ADD KEY `FK_keluarga_penduduk` (`id_kepala_keluarga`),
  ADD KEY `id_kelas_sosial` (`id_kelas_sosial`),
  ADD KEY `id_kepala_keluarga` (`id_kepala_keluarga`),
  ADD KEY `id_rt` (`id_rt`),
  ADD KEY `id_rw` (`id_rw`),
  ADD KEY `id_dusun` (`id_dusun`);

--
-- Indexes for table `tbl_kondisi_kehamilan`
--
ALTER TABLE `tbl_kondisi_kehamilan`
  ADD PRIMARY KEY (`id_kondisi_kehamilan`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `tbl_lembaga_desa`
--
ALTER TABLE `tbl_lembaga_desa`
  ADD PRIMARY KEY (`id_lembaga_desa`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tbl_logo`
--
ALTER TABLE `tbl_logo`
  ADD PRIMARY KEY (`id_logo`);

--
-- Indexes for table `tbl_meninggal`
--
ALTER TABLE `tbl_meninggal`
  ADD PRIMARY KEY (`id_meninggal`),
  ADD KEY `id_penduduk` (`id_penduduk`),
  ADD KEY `id_pelapor` (`id_pelapor`),
  ADD KEY `id_surat` (`id_surat`);

--
-- Indexes for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ped`
--
ALTER TABLE `tbl_ped`
  ADD PRIMARY KEY (`id_ped`),
  ADD KEY `id_ped_sub` (`id_ped_sub`),
  ADD KEY `id_ped_sub_2` (`id_ped_sub`),
  ADD KEY `id_penduduk` (`id_penduduk`),
  ADD KEY `id_penduduk_2` (`id_penduduk`);

--
-- Indexes for table `tbl_ped_perkebunan`
--
ALTER TABLE `tbl_ped_perkebunan`
  ADD PRIMARY KEY (`id_ped_perkebunan`),
  ADD KEY `id_dusun` (`id_dusun`);

--
-- Indexes for table `tbl_ped_pertambakan`
--
ALTER TABLE `tbl_ped_pertambakan`
  ADD PRIMARY KEY (`id_ped_pertambakan`),
  ADD KEY `id_dusun` (`id_dusun`);

--
-- Indexes for table `tbl_ped_pertanian`
--
ALTER TABLE `tbl_ped_pertanian`
  ADD PRIMARY KEY (`id_ped_pertanian`),
  ADD KEY `id_dusun` (`id_dusun`);

--
-- Indexes for table `tbl_ped_potensi_wisata`
--
ALTER TABLE `tbl_ped_potensi_wisata`
  ADD PRIMARY KEY (`id_ped_potensi_wisata`),
  ADD KEY `id_dusun` (`id_dusun`);

--
-- Indexes for table `tbl_ped_sumber_air`
--
ALTER TABLE `tbl_ped_sumber_air`
  ADD PRIMARY KEY (`id_ped_sumber_air`),
  ADD KEY `id_dusun` (`id_dusun`);

--
-- Indexes for table `tbl_ped_sumber_energi`
--
ALTER TABLE `tbl_ped_sumber_energi`
  ADD PRIMARY KEY (`id_ped_sumber_energi`),
  ADD KEY `id_dusun` (`id_dusun`);

--
-- Indexes for table `tbl_penduduk`
--
ALTER TABLE `tbl_penduduk`
  ADD PRIMARY KEY (`id_penduduk`),
  ADD KEY `id_rt` (`id_rt`),
  ADD KEY `id_rw` (`id_rw`),
  ADD KEY `id_dusun` (`id_dusun`),
  ADD KEY `id_pendidikan` (`id_pendidikan`),
  ADD KEY `id_agama` (`id_agama`),
  ADD KEY `id_goldar` (`id_goldar`),
  ADD KEY `id_pendidikan_terakhir` (`id_pendidikan_terakhir`),
  ADD KEY `id_jen_kel` (`id_jen_kel`),
  ADD KEY `id_kewarganegaraan` (`id_kewarganegaraan`),
  ADD KEY `id_pekerjaan` (`id_pekerjaan`),
  ADD KEY `id_pekerjaan_ped` (`id_pekerjaan_ped`),
  ADD KEY `id_kompetensi` (`id_kompetensi`),
  ADD KEY `id_status_kawin` (`id_status_kawin`),
  ADD KEY `id_status_penduduk` (`id_status_penduduk`),
  ADD KEY `id_status_tinggal` (`id_status_tinggal`),
  ADD KEY `id_difabilitas` (`id_difabilitas`),
  ADD KEY `id_kontrasepsi` (`id_kontrasepsi`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `tbl_perangkat`
--
ALTER TABLE `tbl_perangkat`
  ADD PRIMARY KEY (`id_perangkat`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_penduduk` (`id_penduduk`),
  ADD KEY `id_pangkat_gol` (`id_pangkat_gol`);

--
-- Indexes for table `tbl_peta`
--
ALTER TABLE `tbl_peta`
  ADD PRIMARY KEY (`id_peta`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indexes for table `tbl_pindah_keluar`
--
ALTER TABLE `tbl_pindah_keluar`
  ADD PRIMARY KEY (`id_pindah_keluar`),
  ADD KEY `id_rt` (`nomor_rt`),
  ADD KEY `id_rw` (`nomor_rw`),
  ADD KEY `id_dusun` (`nama_dusun`),
  ADD KEY `id_desa` (`nama_desa`),
  ADD KEY `id_keluarga` (`id_keluarga`),
  ADD KEY `id_penduduk` (`id_penduduk`),
  ADD KEY `id_jenis_pindah` (`id_jenis_pindah`),
  ADD KEY `id_klasifikasi_pindah` (`id_klasifikasi_pindah`),
  ADD KEY `id_alasan_pindah` (`id_alasan_pindah`);

--
-- Indexes for table `tbl_pindah_masuk`
--
ALTER TABLE `tbl_pindah_masuk`
  ADD PRIMARY KEY (`id_pindah_masuk`),
  ADD KEY `id_rt` (`id_rt`),
  ADD KEY `id_rw` (`id_rw`),
  ADD KEY `id_dusun` (`id_dusun`),
  ADD KEY `id_desa` (`id_desa`),
  ADD KEY `id_penduduk` (`id_penduduk`),
  ADD KEY `id_keluarga` (`id_keluarga`),
  ADD KEY `id_jenis_pindah` (`id_jenis_pindah`),
  ADD KEY `id_klasifikasi_pindah` (`id_klasifikasi_pindah`),
  ADD KEY `id_alasan_pindah` (`id_alasan_pindah`);

--
-- Indexes for table `tbl_regulasi`
--
ALTER TABLE `tbl_regulasi`
  ADD PRIMARY KEY (`id_regulasi`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indexes for table `tbl_rp_apbdes`
--
ALTER TABLE `tbl_rp_apbdes`
  ADD PRIMARY KEY (`id_apbdes`);

--
-- Indexes for table `tbl_rp_lpj`
--
ALTER TABLE `tbl_rp_lpj`
  ADD PRIMARY KEY (`id_lpj`),
  ADD KEY `id_spp` (`id_spp`),
  ADD KEY `id_spp_2` (`id_spp`);

--
-- Indexes for table `tbl_rp_m_apbdes`
--
ALTER TABLE `tbl_rp_m_apbdes`
  ADD PRIMARY KEY (`id_m_apbdes`);

--
-- Indexes for table `tbl_rp_m_rancangan_rpjm_desa`
--
ALTER TABLE `tbl_rp_m_rancangan_rpjm_desa`
  ADD PRIMARY KEY (`id_m_rancangan_rpjm_desa`);

--
-- Indexes for table `tbl_rp_m_rkp`
--
ALTER TABLE `tbl_rp_m_rkp`
  ADD PRIMARY KEY (`id_m_rkp`);

--
-- Indexes for table `tbl_rp_rabdes`
--
ALTER TABLE `tbl_rp_rabdes`
  ADD PRIMARY KEY (`id_rabdes`),
  ADD KEY `id_tahun_anggaran` (`id_tahun_anggaran`),
  ADD KEY `id_rkpdes` (`id_rkpdes`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_perangkat` (`id_perangkat`);

--
-- Indexes for table `tbl_rp_rabdes_anggaran`
--
ALTER TABLE `tbl_rp_rabdes_anggaran`
  ADD PRIMARY KEY (`id_rabdes_anggaran`),
  ADD KEY `id_rabdes` (`id_rabdes`);

--
-- Indexes for table `tbl_rp_rancangan_rpjm_desa`
--
ALTER TABLE `tbl_rp_rancangan_rpjm_desa`
  ADD PRIMARY KEY (`id_rancangan_rpjm_desa`);

--
-- Indexes for table `tbl_rp_rkp`
--
ALTER TABLE `tbl_rp_rkp`
  ADD PRIMARY KEY (`id_rkp`);

--
-- Indexes for table `tbl_rp_rkpdes`
--
ALTER TABLE `tbl_rp_rkpdes`
  ADD PRIMARY KEY (`id_rkpdes`),
  ADD KEY `id_parent_rkpdes` (`id_parent_rkpdes`),
  ADD KEY `id_rpjmdes` (`id_rpjmdes`),
  ADD KEY `id_tahun_anggaran` (`id_tahun_anggaran`,`id_sumber_dana`,`id_bidang`,`id_coa`),
  ADD KEY `id_sumber_dana` (`id_sumber_dana`),
  ADD KEY `id_bidang` (`id_bidang`),
  ADD KEY `id_coa` (`id_coa`);

--
-- Indexes for table `tbl_rp_rpjmd`
--
ALTER TABLE `tbl_rp_rpjmd`
  ADD PRIMARY KEY (`id_rpjmd`),
  ADD KEY `id_rpjmd` (`id_rpjmd`),
  ADD KEY `id_parent_rpjmd` (`id_parent_rpjmd`),
  ADD KEY `id_tahun` (`id_tahun_anggaran`),
  ADD KEY `id_tahun_2` (`id_tahun_anggaran`),
  ADD KEY `id_child_rpjmd` (`id_top_rpjmd`);

--
-- Indexes for table `tbl_rp_rpjmdes`
--
ALTER TABLE `tbl_rp_rpjmdes`
  ADD PRIMARY KEY (`id_rpjmdes`),
  ADD KEY `id_parent_rpjmdes` (`id_parent_rpjmdes`),
  ADD KEY `id_rpjmd` (`id_rpjmd`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_periode_2` (`id_periode`),
  ADD KEY `id_bidang` (`id_bidang`),
  ADD KEY `id_rpjmd_2` (`id_rpjmd`),
  ADD KEY `id_periode_3` (`id_periode`),
  ADD KEY `id_bidang_2` (`id_bidang`),
  ADD KEY `id_parent_rpjmdes_2` (`id_parent_rpjmdes`),
  ADD KEY `id_periode_4` (`id_periode`);

--
-- Indexes for table `tbl_rp_rpjmdes_detail`
--
ALTER TABLE `tbl_rp_rpjmdes_detail`
  ADD PRIMARY KEY (`id_rpjmdes_detail`),
  ADD KEY `id_rpjmdes` (`id_rpjmdes`),
  ADD KEY `id_tahun_anggaran` (`id_tahun_anggaran`);

--
-- Indexes for table `tbl_rp_spp`
--
ALTER TABLE `tbl_rp_spp`
  ADD PRIMARY KEY (`id_spp`),
  ADD KEY `id_rabdes` (`id_rabdes`);

--
-- Indexes for table `tbl_rp_spp_detail`
--
ALTER TABLE `tbl_rp_spp_detail`
  ADD PRIMARY KEY (`id_spp_detail`),
  ADD KEY `id_spp` (`id_spp`),
  ADD KEY `id_rabdes_anggaran` (`id_rabdes_anggaran`);

--
-- Indexes for table `tbl_sejarah`
--
ALTER TABLE `tbl_sejarah`
  ADD PRIMARY KEY (`id_sejarah`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tbl_slider_beranda`
--
ALTER TABLE `tbl_slider_beranda`
  ADD PRIMARY KEY (`id_slider_beranda`);

--
-- Indexes for table `tbl_sso`
--
ALTER TABLE `tbl_sso`
  ADD PRIMARY KEY (`id_sso`);

--
-- Indexes for table `tbl_surat`
--
ALTER TABLE `tbl_surat`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `id_perangkat` (`id_perangkat`);

--
-- Indexes for table `tbl_visi_misi`
--
ALTER TABLE `tbl_visi_misi`
  ADD PRIMARY KEY (`id_visi_misi`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ref_agama`
--
ALTER TABLE `ref_agama`
  MODIFY `id_agama` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ref_alasan_pindah`
--
ALTER TABLE `ref_alasan_pindah`
  MODIFY `id_alasan_pindah` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ref_asal_aset`
--
ALTER TABLE `ref_asal_aset`
  MODIFY `id_asal_aset` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_desa`
--
ALTER TABLE `ref_desa`
  MODIFY `id_desa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_difabilitas`
--
ALTER TABLE `ref_difabilitas`
  MODIFY `id_difabilitas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ref_dusun`
--
ALTER TABLE `ref_dusun`
  MODIFY `id_dusun` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ref_goldar`
--
ALTER TABLE `ref_goldar`
  MODIFY `id_goldar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ref_jabatan`
--
ALTER TABLE `ref_jabatan`
  MODIFY `id_jabatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ref_jenis_pindah`
--
ALTER TABLE `ref_jenis_pindah`
  MODIFY `id_jenis_pindah` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ref_jen_kel`
--
ALTER TABLE `ref_jen_kel`
  MODIFY `id_jen_kel` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_kab_kota`
--
ALTER TABLE `ref_kab_kota`
  MODIFY `id_kab_kota` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_kategori_aset`
--
ALTER TABLE `ref_kategori_aset`
  MODIFY `id_kategori_aset` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ref_kecamatan`
--
ALTER TABLE `ref_kecamatan`
  MODIFY `id_kecamatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_kelas_sosial`
--
ALTER TABLE `ref_kelas_sosial`
  MODIFY `id_kelas_sosial` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ref_kepemilikan_aset`
--
ALTER TABLE `ref_kepemilikan_aset`
  MODIFY `id_kepemilikan_aset` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ref_kewarganegaraan`
--
ALTER TABLE `ref_kewarganegaraan`
  MODIFY `id_kewarganegaraan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ref_klasifikasi_pindah`
--
ALTER TABLE `ref_klasifikasi_pindah`
  MODIFY `id_klasifikasi_pindah` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ref_kode_surat`
--
ALTER TABLE `ref_kode_surat`
  MODIFY `kode_surat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ref_kompetensi`
--
ALTER TABLE `ref_kompetensi`
  MODIFY `id_kompetensi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ref_kontrasepsi`
--
ALTER TABLE `ref_kontrasepsi`
  MODIFY `id_kontrasepsi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ref_pangkat_gol`
--
ALTER TABLE `ref_pangkat_gol`
  MODIFY `id_pangkat_gol` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_ped_kategori`
--
ALTER TABLE `ref_ped_kategori`
  MODIFY `id_ped_kategori` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ref_ped_sub`
--
ALTER TABLE `ref_ped_sub`
  MODIFY `id_ped_sub` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ref_pekerjaan`
--
ALTER TABLE `ref_pekerjaan`
  MODIFY `id_pekerjaan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `ref_pekerjaan_ped`
--
ALTER TABLE `ref_pekerjaan_ped`
  MODIFY `id_pekerjaan_ped` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ref_pelapor`
--
ALTER TABLE `ref_pelapor`
  MODIFY `id_pelapor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ref_pendidikan`
--
ALTER TABLE `ref_pendidikan`
  MODIFY `id_pendidikan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ref_provinsi`
--
ALTER TABLE `ref_provinsi`
  MODIFY `id_provinsi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_rp_bidang`
--
ALTER TABLE `ref_rp_bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `ref_rp_coa`
--
ALTER TABLE `ref_rp_coa`
  MODIFY `id_coa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `ref_rp_periode`
--
ALTER TABLE `ref_rp_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ref_rp_sumber_dana`
--
ALTER TABLE `ref_rp_sumber_dana`
  MODIFY `id_sumber_dana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ref_rp_sumber_dana_desa`
--
ALTER TABLE `ref_rp_sumber_dana_desa`
  MODIFY `id_sumber_dana_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ref_rp_tahun_anggaran`
--
ALTER TABLE `ref_rp_tahun_anggaran`
  MODIFY `id_tahun_anggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ref_rt`
--
ALTER TABLE `ref_rt`
  MODIFY `id_rt` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ref_rw`
--
ALTER TABLE `ref_rw`
  MODIFY `id_rw` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ref_status_kawin`
--
ALTER TABLE `ref_status_kawin`
  MODIFY `id_status_kawin` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ref_status_keluarga`
--
ALTER TABLE `ref_status_keluarga`
  MODIFY `id_status_keluarga` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ref_status_penduduk`
--
ALTER TABLE `ref_status_penduduk`
  MODIFY `id_status_penduduk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ref_status_tinggal`
--
ALTER TABLE `ref_status_tinggal`
  MODIFY `id_status_tinggal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_aset_bangunan`
--
ALTER TABLE `tbl_aset_bangunan`
  MODIFY `id_aset_bangunan` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_aset_master`
--
ALTER TABLE `tbl_aset_master`
  MODIFY `id_aset_master` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_aset_perawatan_bgn`
--
ALTER TABLE `tbl_aset_perawatan_bgn`
  MODIFY `id_aset_perawatan_bgn` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_aset_ruangan`
--
ALTER TABLE `tbl_aset_ruangan`
  MODIFY `id_aset_ruangan` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_aset_tanah`
--
ALTER TABLE `tbl_aset_tanah`
  MODIFY `id_aset_tanah` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_berita`
--
ALTER TABLE `tbl_berita`
  MODIFY `id_berita` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tbl_demografi`
--
ALTER TABLE `tbl_demografi`
  MODIFY `id_demografi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_gizi_buruk`
--
ALTER TABLE `tbl_gizi_buruk`
  MODIFY `id_gizi_buruk` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_hub_kel`
--
ALTER TABLE `tbl_hub_kel`
  MODIFY `id_hub_kel` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_ikut_pindah_keluar`
--
ALTER TABLE `tbl_ikut_pindah_keluar`
  MODIFY `id_ikut_pindah_keluar` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_ikut_pindah_masuk`
--
ALTER TABLE `tbl_ikut_pindah_masuk`
  MODIFY `id_ikut_pindah_masuk` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_kelahiran`
--
ALTER TABLE `tbl_kelahiran`
  MODIFY `id_kelahiran` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_keluarga`
--
ALTER TABLE `tbl_keluarga`
  MODIFY `id_keluarga` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_kondisi_kehamilan`
--
ALTER TABLE `tbl_kondisi_kehamilan`
  MODIFY `id_kondisi_kehamilan` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_kontak`
--
ALTER TABLE `tbl_kontak`
  MODIFY `id_kontak` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_lembaga_desa`
--
ALTER TABLE `tbl_lembaga_desa`
  MODIFY `id_lembaga_desa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id_log` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `tbl_logo`
--
ALTER TABLE `tbl_logo`
  MODIFY `id_logo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_meninggal`
--
ALTER TABLE `tbl_meninggal`
  MODIFY `id_meninggal` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pages`
--
ALTER TABLE `tbl_pages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `tbl_ped`
--
ALTER TABLE `tbl_ped`
  MODIFY `id_ped` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_ped_perkebunan`
--
ALTER TABLE `tbl_ped_perkebunan`
  MODIFY `id_ped_perkebunan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_ped_pertambakan`
--
ALTER TABLE `tbl_ped_pertambakan`
  MODIFY `id_ped_pertambakan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_ped_pertanian`
--
ALTER TABLE `tbl_ped_pertanian`
  MODIFY `id_ped_pertanian` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_ped_potensi_wisata`
--
ALTER TABLE `tbl_ped_potensi_wisata`
  MODIFY `id_ped_potensi_wisata` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_ped_sumber_air`
--
ALTER TABLE `tbl_ped_sumber_air`
  MODIFY `id_ped_sumber_air` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_ped_sumber_energi`
--
ALTER TABLE `tbl_ped_sumber_energi`
  MODIFY `id_ped_sumber_energi` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_penduduk`
--
ALTER TABLE `tbl_penduduk`
  MODIFY `id_penduduk` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id_pengguna` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_perangkat`
--
ALTER TABLE `tbl_perangkat`
  MODIFY `id_perangkat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_peta`
--
ALTER TABLE `tbl_peta`
  MODIFY `id_peta` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_pindah_keluar`
--
ALTER TABLE `tbl_pindah_keluar`
  MODIFY `id_pindah_keluar` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_apbdes`
--
ALTER TABLE `tbl_rp_apbdes`
  MODIFY `id_apbdes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_lpj`
--
ALTER TABLE `tbl_rp_lpj`
  MODIFY `id_lpj` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_m_apbdes`
--
ALTER TABLE `tbl_rp_m_apbdes`
  MODIFY `id_m_apbdes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_m_rancangan_rpjm_desa`
--
ALTER TABLE `tbl_rp_m_rancangan_rpjm_desa`
  MODIFY `id_m_rancangan_rpjm_desa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_m_rkp`
--
ALTER TABLE `tbl_rp_m_rkp`
  MODIFY `id_m_rkp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_rabdes`
--
ALTER TABLE `tbl_rp_rabdes`
  MODIFY `id_rabdes` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_rabdes_anggaran`
--
ALTER TABLE `tbl_rp_rabdes_anggaran`
  MODIFY `id_rabdes_anggaran` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_rancangan_rpjm_desa`
--
ALTER TABLE `tbl_rp_rancangan_rpjm_desa`
  MODIFY `id_rancangan_rpjm_desa` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_rkp`
--
ALTER TABLE `tbl_rp_rkp`
  MODIFY `id_rkp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_rkpdes`
--
ALTER TABLE `tbl_rp_rkpdes`
  MODIFY `id_rkpdes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_rp_rpjmd`
--
ALTER TABLE `tbl_rp_rpjmd`
  MODIFY `id_rpjmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_rp_rpjmdes`
--
ALTER TABLE `tbl_rp_rpjmdes`
  MODIFY `id_rpjmdes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_rp_rpjmdes_detail`
--
ALTER TABLE `tbl_rp_rpjmdes_detail`
  MODIFY `id_rpjmdes_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_spp`
--
ALTER TABLE `tbl_rp_spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_rp_spp_detail`
--
ALTER TABLE `tbl_rp_spp_detail`
  MODIFY `id_spp_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_slider_beranda`
--
ALTER TABLE `tbl_slider_beranda`
  MODIFY `id_slider_beranda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_surat`
--
ALTER TABLE `tbl_surat`
  MODIFY `id_surat` int(10) NOT NULL AUTO_INCREMENT;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ref_desa`
--
ALTER TABLE `ref_desa`
  ADD CONSTRAINT `ref_desa_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `ref_kecamatan` (`id_kecamatan`),
  ADD CONSTRAINT `ref_desa_ibfk_2` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`);

--
-- Ketidakleluasaan untuk tabel `ref_dusun`
--
ALTER TABLE `ref_dusun`
  ADD CONSTRAINT `ref_dusun_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `ref_desa` (`id_desa`),
  ADD CONSTRAINT `ref_dusun_ibfk_2` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`);

--
-- Ketidakleluasaan untuk tabel `ref_kab_kota`
--
ALTER TABLE `ref_kab_kota`
  ADD CONSTRAINT `ref_kab_kota_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `ref_provinsi` (`id_provinsi`);

--
-- Ketidakleluasaan untuk tabel `ref_kecamatan`
--
ALTER TABLE `ref_kecamatan`
  ADD CONSTRAINT `ref_kecamatan_ibfk_1` FOREIGN KEY (`id_kab_kota`) REFERENCES `ref_kab_kota` (`id_kab_kota`);

--
-- Ketidakleluasaan untuk tabel `ref_ped_sub`
--
ALTER TABLE `ref_ped_sub`
  ADD CONSTRAINT `ref_ped_sub_ibfk_1` FOREIGN KEY (`id_ped_kategori`) REFERENCES `ref_ped_kategori` (`id_ped_kategori`);

--
-- Ketidakleluasaan untuk tabel `ref_rp_bidang`
--
ALTER TABLE `ref_rp_bidang`
  ADD CONSTRAINT `ref_rp_bidang_ibfk_1` FOREIGN KEY (`id_parent_bidang`) REFERENCES `ref_rp_bidang` (`id_bidang`);

--
-- Ketidakleluasaan untuk tabel `ref_rp_coa`
--
ALTER TABLE `ref_rp_coa`
  ADD CONSTRAINT `ref_rp_coa_ibfk_1` FOREIGN KEY (`id_parent_coa`) REFERENCES `ref_rp_coa` (`id_coa`);

--
-- Ketidakleluasaan untuk tabel `ref_rp_sumber_dana`
--
ALTER TABLE `ref_rp_sumber_dana`
  ADD CONSTRAINT `ref_rp_sumber_dana_ibfk_1` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `ref_rp_tahun_anggaran` (`id_tahun_anggaran`);

--
-- Ketidakleluasaan untuk tabel `ref_rp_tahun_anggaran`
--
ALTER TABLE `ref_rp_tahun_anggaran`
  ADD CONSTRAINT `ref_rp_tahun_anggaran_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `ref_rp_periode` (`id_periode`);

--
-- Ketidakleluasaan untuk tabel `ref_rt`
--
ALTER TABLE `ref_rt`
  ADD CONSTRAINT `ref_rt_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`),
  ADD CONSTRAINT `ref_rt_ibfk_2` FOREIGN KEY (`id_rw`) REFERENCES `ref_rw` (`id_rw`);

--
-- Ketidakleluasaan untuk tabel `ref_rw`
--
ALTER TABLE `ref_rw`
  ADD CONSTRAINT `ref_rw_ibfk_1` FOREIGN KEY (`id_dusun`) REFERENCES `ref_dusun` (`id_dusun`),
  ADD CONSTRAINT `ref_rw_ibfk_2` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`);

--
-- Ketidakleluasaan untuk tabel `tbl_aset_bangunan`
--
ALTER TABLE `tbl_aset_bangunan`
  ADD CONSTRAINT `tbl_aset_bangunan_ibfk_1` FOREIGN KEY (`id_kepemilikan_aset`) REFERENCES `ref_kepemilikan_aset` (`id_kepemilikan_aset`),
  ADD CONSTRAINT `tbl_aset_bangunan_ibfk_2` FOREIGN KEY (`id_aset_tanah`) REFERENCES `tbl_aset_tanah` (`id_aset_tanah`);

--
-- Ketidakleluasaan untuk tabel `tbl_aset_master`
--
ALTER TABLE `tbl_aset_master`
  ADD CONSTRAINT `tbl_aset_master_ibfk_1` FOREIGN KEY (`id_aset_ruangan`) REFERENCES `tbl_aset_ruangan` (`id_aset_ruangan`),
  ADD CONSTRAINT `tbl_aset_master_ibfk_2` FOREIGN KEY (`id_kategori_aset`) REFERENCES `ref_kategori_aset` (`id_kategori_aset`),
  ADD CONSTRAINT `tbl_aset_master_ibfk_3` FOREIGN KEY (`id_asal_aset`) REFERENCES `ref_asal_aset` (`id_asal_aset`),
  ADD CONSTRAINT `tbl_aset_master_ibfk_4` FOREIGN KEY (`id_kepemilikan_aset`) REFERENCES `ref_kepemilikan_aset` (`id_kepemilikan_aset`);

--
-- Ketidakleluasaan untuk tabel `tbl_aset_perawatan_bgn`
--
ALTER TABLE `tbl_aset_perawatan_bgn`
  ADD CONSTRAINT `tbl_aset_perawatan_bgn_ibfk_1` FOREIGN KEY (`id_aset_bangunan`) REFERENCES `tbl_aset_bangunan` (`id_aset_bangunan`);

--
-- Ketidakleluasaan untuk tabel `tbl_aset_ruangan`
--
ALTER TABLE `tbl_aset_ruangan`
  ADD CONSTRAINT `tbl_aset_ruangan_ibfk_1` FOREIGN KEY (`id_aset_bangunan`) REFERENCES `tbl_aset_bangunan` (`id_aset_bangunan`);

--
-- Ketidakleluasaan untuk tabel `tbl_aset_tanah`
--
ALTER TABLE `tbl_aset_tanah`
  ADD CONSTRAINT `tbl_aset_tanah_ibfk_1` FOREIGN KEY (`id_kepemilikan_aset`) REFERENCES `ref_kepemilikan_aset` (`id_kepemilikan_aset`);

--
-- Ketidakleluasaan untuk tabel `tbl_berita`
--
ALTER TABLE `tbl_berita`
  ADD CONSTRAINT `tbl_berita_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `tbl_demografi`
--
ALTER TABLE `tbl_demografi`
  ADD CONSTRAINT `tbl_demografi_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `tbl_gizi_buruk`
--
ALTER TABLE `tbl_gizi_buruk`
  ADD CONSTRAINT `tbl_gizi_buruk_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`);

--
-- Ketidakleluasaan untuk tabel `tbl_hub_kel`
--
ALTER TABLE `tbl_hub_kel`
  ADD CONSTRAINT `tbl_hub_kel_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`),
  ADD CONSTRAINT `tbl_hub_kel_ibfk_2` FOREIGN KEY (`id_keluarga`) REFERENCES `tbl_keluarga` (`id_keluarga`),
  ADD CONSTRAINT `tbl_hub_kel_ibfk_3` FOREIGN KEY (`id_status_keluarga`) REFERENCES `ref_status_keluarga` (`id_status_keluarga`);

--
-- Ketidakleluasaan untuk tabel `tbl_ikut_pindah_keluar`
--
ALTER TABLE `tbl_ikut_pindah_keluar`
  ADD CONSTRAINT `tbl_ikut_pindah_keluar_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`);

--
-- Ketidakleluasaan untuk tabel `tbl_ikut_pindah_masuk`
--
ALTER TABLE `tbl_ikut_pindah_masuk`
  ADD CONSTRAINT `tbl_ikut_pindah_masuk_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`);

--
-- Ketidakleluasaan untuk tabel `tbl_kelahiran`
--
ALTER TABLE `tbl_kelahiran`
  ADD CONSTRAINT `tbl_kelahiran_ibfk_2` FOREIGN KEY (`id_keluarga`) REFERENCES `tbl_keluarga` (`id_keluarga`),
  ADD CONSTRAINT `tbl_kelahiran_ibfk_3` FOREIGN KEY (`id_pelapor`) REFERENCES `ref_pelapor` (`id_pelapor`),
  ADD CONSTRAINT `tbl_kelahiran_ibfk_4` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`),
  ADD CONSTRAINT `tbl_kelahiran_ibfk_5` FOREIGN KEY (`id_surat`) REFERENCES `tbl_surat` (`id_surat`);

--
-- Ketidakleluasaan untuk tabel `tbl_keluarga`
--
ALTER TABLE `tbl_keluarga`
  ADD CONSTRAINT `tbl_keluarga_ibfk_1` FOREIGN KEY (`id_kelas_sosial`) REFERENCES `ref_kelas_sosial` (`id_kelas_sosial`),
  ADD CONSTRAINT `tbl_keluarga_ibfk_2` FOREIGN KEY (`id_rt`) REFERENCES `ref_rt` (`id_rt`),
  ADD CONSTRAINT `tbl_keluarga_ibfk_3` FOREIGN KEY (`id_rw`) REFERENCES `ref_rw` (`id_rw`),
  ADD CONSTRAINT `tbl_keluarga_ibfk_4` FOREIGN KEY (`id_dusun`) REFERENCES `ref_dusun` (`id_dusun`),
  ADD CONSTRAINT `tbl_keluarga_ibfk_5` FOREIGN KEY (`id_kepala_keluarga`) REFERENCES `tbl_penduduk` (`id_penduduk`);

--
-- Ketidakleluasaan untuk tabel `tbl_ped`
--
ALTER TABLE `tbl_ped`
  ADD CONSTRAINT `tbl_ped_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id_penduduk`),
  ADD CONSTRAINT `tbl_ped_ibfk_2` FOREIGN KEY (`id_ped_sub`) REFERENCES `ref_ped_sub` (`id_ped_sub`);

--
-- Ketidakleluasaan untuk tabel `tbl_peta`
--
ALTER TABLE `tbl_peta`
  ADD CONSTRAINT `tbl_peta_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `ref_desa` (`id_desa`);

--
-- Ketidakleluasaan untuk tabel `tbl_rp_lpj`
--
ALTER TABLE `tbl_rp_lpj`
  ADD CONSTRAINT `tbl_rp_lpj_ibfk_1` FOREIGN KEY (`id_spp`) REFERENCES `tbl_rp_spp` (`id_spp`);

--
-- Ketidakleluasaan untuk tabel `tbl_rp_rabdes`
--
ALTER TABLE `tbl_rp_rabdes`
  ADD CONSTRAINT `tbl_rp_rabdes_ibfk_1` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `ref_rp_tahun_anggaran` (`id_tahun_anggaran`),
  ADD CONSTRAINT `tbl_rp_rabdes_ibfk_2` FOREIGN KEY (`id_rkpdes`) REFERENCES `tbl_rp_rkpdes` (`id_rkpdes`),
  ADD CONSTRAINT `tbl_rp_rabdes_ibfk_3` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pengguna` (`id_pengguna`),
  ADD CONSTRAINT `tbl_rp_rabdes_ibfk_4` FOREIGN KEY (`id_perangkat`) REFERENCES `tbl_perangkat` (`id_perangkat`);

--
-- Ketidakleluasaan untuk tabel `tbl_rp_rabdes_anggaran`
--
ALTER TABLE `tbl_rp_rabdes_anggaran`
  ADD CONSTRAINT `tbl_rp_rabdes_anggaran_ibfk_1` FOREIGN KEY (`id_rabdes`) REFERENCES `tbl_rp_rabdes` (`id_rabdes`);

--
-- Ketidakleluasaan untuk tabel `tbl_rp_rkpdes`
--
ALTER TABLE `tbl_rp_rkpdes`
  ADD CONSTRAINT `tbl_rp_rkpdes_ibfk_1` FOREIGN KEY (`id_parent_rkpdes`) REFERENCES `tbl_rp_rkpdes` (`id_rkpdes`),
  ADD CONSTRAINT `tbl_rp_rkpdes_ibfk_2` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `ref_rp_tahun_anggaran` (`id_tahun_anggaran`),
  ADD CONSTRAINT `tbl_rp_rkpdes_ibfk_3` FOREIGN KEY (`id_rpjmdes`) REFERENCES `tbl_rp_rpjmdes` (`id_rpjmdes`),
  ADD CONSTRAINT `tbl_rp_rkpdes_ibfk_4` FOREIGN KEY (`id_sumber_dana`) REFERENCES `ref_rp_sumber_dana` (`id_sumber_dana`),
  ADD CONSTRAINT `tbl_rp_rkpdes_ibfk_5` FOREIGN KEY (`id_bidang`) REFERENCES `ref_rp_bidang` (`id_bidang`),
  ADD CONSTRAINT `tbl_rp_rkpdes_ibfk_6` FOREIGN KEY (`id_coa`) REFERENCES `ref_rp_coa` (`id_coa`);

--
-- Ketidakleluasaan untuk tabel `tbl_rp_rpjmd`
--
ALTER TABLE `tbl_rp_rpjmd`
  ADD CONSTRAINT `tbl_rp_rpjmd_ibfk_1` FOREIGN KEY (`id_parent_rpjmd`) REFERENCES `tbl_rp_rpjmd` (`id_rpjmd`),
  ADD CONSTRAINT `tbl_rp_rpjmd_ibfk_2` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `ref_rp_tahun_anggaran` (`id_tahun_anggaran`);

--
-- Ketidakleluasaan untuk tabel `tbl_rp_rpjmdes`
--
ALTER TABLE `tbl_rp_rpjmdes`
  ADD CONSTRAINT `tbl_rp_rpjmdes_ibfk_1` FOREIGN KEY (`id_parent_rpjmdes`) REFERENCES `tbl_rp_rpjmdes` (`id_rpjmdes`),
  ADD CONSTRAINT `tbl_rp_rpjmdes_ibfk_2` FOREIGN KEY (`id_rpjmd`) REFERENCES `tbl_rp_rpjmd` (`id_rpjmd`),
  ADD CONSTRAINT `tbl_rp_rpjmdes_ibfk_3` FOREIGN KEY (`id_periode`) REFERENCES `ref_rp_periode` (`id_periode`),
  ADD CONSTRAINT `tbl_rp_rpjmdes_ibfk_4` FOREIGN KEY (`id_bidang`) REFERENCES `ref_rp_bidang` (`id_bidang`);

--
-- Ketidakleluasaan untuk tabel `tbl_rp_rpjmdes_detail`
--
ALTER TABLE `tbl_rp_rpjmdes_detail`
  ADD CONSTRAINT `tbl_rp_rpjmdes_detail_ibfk_1` FOREIGN KEY (`id_tahun_anggaran`) REFERENCES `ref_rp_tahun_anggaran` (`id_tahun_anggaran`),
  ADD CONSTRAINT `tbl_rp_rpjmdes_detail_ibfk_2` FOREIGN KEY (`id_rpjmdes`) REFERENCES `tbl_rp_rpjmdes` (`id_rpjmdes`);

--
-- Ketidakleluasaan untuk tabel `tbl_rp_spp`
--
ALTER TABLE `tbl_rp_spp`
  ADD CONSTRAINT `tbl_rp_spp_ibfk_1` FOREIGN KEY (`id_rabdes`) REFERENCES `tbl_rp_rabdes` (`id_rabdes`);

--
-- Ketidakleluasaan untuk tabel `tbl_rp_spp_detail`
--
ALTER TABLE `tbl_rp_spp_detail`
  ADD CONSTRAINT `tbl_rp_spp_detail_ibfk_1` FOREIGN KEY (`id_spp`) REFERENCES `tbl_rp_spp` (`id_spp`),
  ADD CONSTRAINT `tbl_rp_spp_detail_ibfk_2` FOREIGN KEY (`id_rabdes_anggaran`) REFERENCES `tbl_rp_rabdes_anggaran` (`id_rabdes_anggaran`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
