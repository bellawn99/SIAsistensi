-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Sep 2020 pada 13.27
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `selesai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `user_id`, `nip`, `created_at`, `updated_at`) VALUES
('A2006240509740', '2006244563', '123456', '2020-06-23 22:09:07', '2020-07-06 09:41:30'),
('A2007051146921', '2007055633', '123464', NULL, NULL),
('A2007051543743', '2007056274', '123343', NULL, NULL),
('A2007051543844', '2007053369', '123455', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `admin_id`, `judul`, `isi`, `foto`, `created_at`, `updated_at`) VALUES
('B2006240509407', 'A2006240509740', 'Pengumuman Penerimaan Asisten Praktikum Semester Ganjil TA 2019/2020', 'Assalamualaikum Wr Wb\r\nSalam sejahtera bagi kita semua.\r\n            \r\nKami dari Admin Asistensi memberitahukan kepada seluruh calon Asisten Praktikum Semester Genap Tahun Akademik2019/2020, ingin menginformasikan bahwa sudah ada daftar nama Asisten Praktikum Tahun Ajaran ini. Untuk lebih lengkapnya silahkan login dengan akun masing-masing.', 'terima.png', '2020-07-03 12:14:45', NULL),
('B2007041135723', 'A2006240509740', 'Pendaftaran Asistensi Semester Genap TA 2019/2020', 'PERSIAPKAN DIRIMU !\r\n            \r\nKami dari Admin Asistensi menyelenggarakan Open Recruitment Asisten Praktikum Semester Genap Tahun Akademik 2020/2021.\r\n                        \r\nCatat tanggalnya :\r\nPendaftaran : 2020-06-29-2020-08-10\r\n                        \r\nInformasi lebih lanjut\r\nCP : 088-888-888-888\r\nDaftarkan segera dan jadilah bagian dari kami.', 'daftar.png', '2020-08-09 05:31:23', NULL),
('B2007161736901', 'A2006240509740', 'Pengumuman Penerimaan Asisten Praktikum Semester Genap TA 2021/2022', 'Assalamualaikum Wr Wb\r\nSalam sejahtera bagi kita semua.\r\n            \r\nKami dari Admin Asistensi memberitahukan kepada seluruh calon Asisten Praktikum Semester Genap Tahun Akademik2021/2022, ingin menginformasikan bahwa sudah ada daftar nama Asisten Praktikum Tahun Ajaran ini. Untuk lebih lengkapnya silahkan login dengan akun masing-masing.', 'terima.png', '2020-07-16 10:36:37', NULL),
('B2007261332240', 'A2006240509740', 'Pengumuman Penerimaan Asisten Praktikum Semester Genap TA 2022/2023', 'Assalamualaikum Wr Wb\r\nSalam sejahtera bagi kita semua.\r\n            \r\nKami dari Admin Asistensi memberitahukan kepada seluruh calon Asisten Praktikum Semester Genap Tahun Akademik2022/2023, ingin menginformasikan bahwa sudah ada daftar nama Asisten Praktikum Tahun Ajaran ini. Untuk lebih lengkapnya silahkan login dengan akun masing-masing.', 'terima.png', '2020-07-26 06:32:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar`
--

CREATE TABLE `daftar` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mahasiswa_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `praktikum_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('daftar','diterima','ditolak') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `daftar`
--

INSERT INTO `daftar` (`id`, `periode_id`, `mahasiswa_id`, `praktikum_id`, `status`, `created_at`, `updated_at`) VALUES
('3', 'P2006240509454', 'M2006300528223', 9, 'daftar', '2020-07-01 17:00:00', '2020-08-05 17:00:00'),
('4', 'P2006240509454', 'M2007051549521', 6, 'diterima', '2020-08-06 17:00:00', '2020-08-05 17:00:00'),
('D2007061318424', 'P2006240509454', 'M2006240509354', 9, 'diterima', '2020-07-05 17:00:00', '2020-07-05 17:00:00'),
('D2008070300781', 'P2006240509454', 'M2007051549521', 9, 'diterima', '2020-08-06 17:00:00', '2020-08-06 17:00:00'),
('D2008070344267', 'P2006240509454', 'M2006240509354', 4, 'daftar', '2020-08-06 17:00:00', NULL),
('D2008070345825', 'P2006240509454', 'M2006240509354', 6, 'diterima', '2020-08-06 17:00:00', '2020-08-06 17:00:00'),
('D2008091234749', 'P2006240509454', '2008094703', 4, 'daftar', '2020-08-08 17:00:00', NULL),
('D2008091234850', 'P2006240509454', '2008094703', 9, 'daftar', '2020-08-08 17:00:00', NULL),
('D2008140454130', 'P2006240509454', '2008147248', 9, 'daftar', '2020-08-13 17:00:00', NULL),
('D2008140454594', 'P2006240509454', '2008147248', 4, 'daftar', '2020-08-13 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nidn` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id`, `nidn`, `nama`, `created_at`, `updated_at`) VALUES
('D2006240509185', '0012018803', 'Imam Fahrurrozi', '2020-06-23 22:09:07', '2020-07-02 09:24:36'),
('D2006240509783', '0005058902', 'Irkham Huda', '2020-06-23 22:09:07', '2020-06-30 12:10:01'),
('D2007011126707', '0891212', 'Amanda', NULL, '2020-07-01 06:22:37'),
('D2007060549755', '089124643', 'Agus', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE `jadwal` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id`, `hari`, `jam_mulai`, `jam_akhir`, `created_at`, `updated_at`) VALUES
('J2006240509290', 'Rabu', '12:00:00', '13:40:00', '2020-06-23 22:09:08', NULL),
('J2006240509339', 'Kamis', '09:00:00', '10:40:00', '2020-06-23 22:09:08', NULL),
('J2007031818346', 'Senin', '10:00:00', '12:30:00', NULL, '2020-07-09 21:57:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `created_at`, `updated_at`) VALUES
('K2006240509534', 'AB', '2020-06-23 22:09:08', NULL),
('K2006240509908', 'BB', '2020-06-23 22:09:08', NULL),
('K2007030410129', 'B', '2020-07-02 21:10:01', NULL),
('K2007051516844', 'A', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ketentuan`
--

CREATE TABLE `ketentuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `ketentuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ketentuan`
--

INSERT INTO `ketentuan` (`id`, `ketentuan`, `created_at`, `updated_at`) VALUES
(3, 'Mahasiswa aktif Universitas Gadjah Mada', '2020-06-23 22:09:09', '2020-07-03 10:18:38'),
(4, 'IPK minimal 3.00', '2020-06-23 22:09:09', '2020-07-03 10:18:54'),
(5, 'Minimal memperoleh nilai B pada matakuliah yang sama atau disetarakan', '2020-06-23 22:09:09', '2020-07-03 10:19:18'),
(10, 'Tidak sedang mengambil matakuliah yang diasistensi', '2020-07-03 10:21:00', '2020-07-03 10:21:38'),
(11, 'Setiap mahasiswa diperbolehkan memilih 2 matakuliah untuk diasistensi', '2020-07-03 10:21:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kontak`
--

INSERT INTO `kontak` (`id`, `nama`, `email`, `no_hp`, `pesan`, `created_at`, `updated_at`) VALUES
(1, 'aku', 'akukamu@aku.com', NULL, 'apa ya', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nim` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `npwp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jk` enum('P','L') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prodi` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `khs` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipk` decimal(10,2) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `nama_bank` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rekening` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_rekening` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `user_id`, `nim`, `nik`, `npwp`, `jk`, `tempat`, `tgl_lahir`, `alamat`, `prodi`, `khs`, `ipk`, `semester`, `nama_bank`, `no_rekening`, `nama_rekening`, `created_at`, `updated_at`) VALUES
('2008073732', '2008073732', '41399', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2008093677', '2008093677', '321321', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2008094703', '2008094703', '312345', '2323232', NULL, 'P', 'Bantul', '2020-08-08', 'bantul jogja', 'KOMSI', '2008094703.pdf', NULL, 6, 'BNI', '34567', 'bmi', NULL, '2020-08-09 05:34:06'),
('2008147248', '2008147248', '654321', '312312312', NULL, 'P', 'bantul', '2020-08-14', 'bantul jogja', 'KOMSI', '2008147248.pdf', '3.99', 6, 'BNI', '23132', 'yasiapa', NULL, '2020-08-13 21:53:07'),
('M2006240509354', '2006242306', '410828', '3402100031199001', NULL, 'P', 'Bantul', '1999-11-03', 'Bantul', 'Komsi', '2006242306.pdf', '3.99', 6, 'BNI', '00123', 'Mahasiswa', '2020-06-23 22:09:07', '2020-07-22 07:14:07'),
('M2006300528223', '2006304164', '17/410888/SV/12755', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2006242306.pdf', '3.99', NULL, NULL, NULL, NULL, '2020-06-29 22:28:02', NULL),
('M2007051549521', '2007058294', '17/416361/SV/14099', '21020102312', NULL, 'P', 'Bantul', '2020-08-07', 'bantul jogja', 'KOMSI', '2007058294.pdf', '3.96', 6, 'BNI', '999', 'ini', NULL, '2020-08-06 19:59:16'),
('M2007051549609', '2007058409', '17/415509/SV/13374', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('M2007051549667', '2007058327', '17/410831/SV/12758', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `matkul`
--

CREATE TABLE `matkul` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_vmk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_matkul` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `matkul`
--

INSERT INTO `matkul` (`id`, `kode_vmk`, `nama_matkul`, `sks`, `created_at`, `updated_at`) VALUES
('M2006240509139', 'VMK 1204', 'KL Pemrograman Web I', 2, '2020-06-23 22:09:08', '2020-06-30 20:58:31'),
('M2006240509219', 'V3KI2212', 'Praktikum Pemrograman Aplikasi Perangkat Bergerak 2', 2, '2020-06-23 22:09:07', NULL),
('M2008070249382', 'vmk123', 'pap 3', 1, '2020-08-06 17:00:00', NULL),
('M2008070249628', 'VMK 1201', 'Pengantar Teknologi Informasi', 2, NULL, NULL),
('M2008070249810', 'VMK 1203', 'KL Pengolahan Instalasi Komputer', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_03_13_051132_create_mahasiswa_table', 1),
(4, '2020_03_18_155044_create_dosens_table', 1),
(5, '2020_03_18_155128_create_matkuls_table', 1),
(6, '2020_03_18_161037_create_ruangans_table', 1),
(7, '2020_03_18_161427_create_jadwals_table', 1),
(8, '2020_03_29_060452_create_kelass_table', 1),
(9, '2020_03_30_135625_create_admins_table', 1),
(10, '2020_03_31_161924_create_ketentuans_table', 1),
(11, '2020_04_07_043455_create_semesters_table', 1),
(12, '2020_04_20_104309_create_praktikums_table', 1),
(13, '2020_04_22_071818_create_beritas_table', 1),
(14, '2020_04_24_041245_create_periodes_table', 1),
(15, '2020_05_01_150353_create_kontaks_table', 1),
(16, '2020_05_15_234806_create_daftars_table', 1),
(17, '2020_06_11_044115_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('07c1430c-85f0-4efd-8d0a-8611244693d4', 'App\\Notifications\\Pengumuman', 'App\\User', 2007058294, '{\"id\":[{\"created_at\":\"2020-07-26 13:26:27\"}]}', NULL, '2020-07-26 06:26:46', '2020-07-26 06:26:46'),
('105109ee-33d0-44a3-81db-bb04607e02d2', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 17:25:27', '2020-07-02 17:25:27'),
('12ec4229-a04a-40f0-95e6-2478437ef480', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 17:36:57', '2020-07-02 17:36:57'),
('13269450-1f5b-4a48-a4ee-2e843753d82a', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-06-26\"}]}', NULL, '2020-06-28 04:21:05', '2020-06-28 04:21:05'),
('156fc4d9-d226-43ff-a20a-6f70bfd3c2a4', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304829, '{\"id\":[{\"tgl_mulai\":\"2020-06-29\"}]}', NULL, '2020-07-03 12:18:12', '2020-07-03 12:18:12'),
('24028530-3032-4d31-a13f-e35cb3b3539e', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-03 04:58:36', '2020-07-03 04:58:36'),
('266a3713-b1f1-4c07-ac33-12763a7e3d83', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304829, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 08:51:02', '2020-07-02 08:51:02'),
('2d369f10-6e96-4e47-837b-9233261d7d15', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304829, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 23:40:30', '2020-07-02 23:40:30'),
('32aee3d3-59af-430e-bdea-b095722e80c2', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 08:50:58', '2020-07-02 08:50:58'),
('335a0c3f-00c3-473c-9cd7-46325c484df4', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-03 04:58:13', '2020-07-03 04:58:13'),
('33933807-b6bc-4414-b5b7-d30b66ba4740', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-06-24\"}]}', NULL, '2020-06-24 06:01:05', '2020-06-24 06:01:05'),
('34e89b3e-8706-4dac-968d-1978fa33ea50', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-03 04:57:04', '2020-07-03 04:57:04'),
('35842628-bd12-4815-8300-52e0d574643d', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"created_at\":\"2020-07-16 17:36:37\"}]}', NULL, '2020-07-16 10:36:50', '2020-07-16 10:36:50'),
('38673eb8-0ddc-454b-9386-ae34665b7ccb', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"created_at\":\"2020-07-16 17:36:37\"}]}', NULL, '2020-07-16 10:36:54', '2020-07-16 10:36:54'),
('448b3a3f-9622-4ea4-99d1-4927ebd0e3a5', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"created_at\":\"2020-07-26 13:26:27\"}]}', NULL, '2020-07-26 06:26:45', '2020-07-26 06:26:45'),
('52fb11e8-8ebc-49c5-aab1-70500134ede2', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"created_at\":\"2020-07-26 13:26:27\"}]}', NULL, '2020-07-26 06:26:40', '2020-07-26 06:26:40'),
('53ae36a8-edd8-4170-8bf8-dbafd222e7e2', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304829, '{\"id\":[{\"tgl_mulai\":\"2020-06-29\"}]}', NULL, '2020-07-03 21:10:14', '2020-07-03 21:10:14'),
('5b7f273a-733b-4972-a2bc-0e666ca019c9', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"tgl_mulai\":\"2020-06-29\"}]}', NULL, '2020-07-03 12:18:07', '2020-07-03 12:18:07'),
('6616bd2e-cab3-4645-aed8-a223ec151724', 'App\\Notifications\\Pengumuman', 'App\\User', 2007232545, '{\"id\":[{\"created_at\":\"2020-07-26 13:32:13\"}]}', NULL, '2020-07-26 06:32:28', '2020-07-26 06:32:28'),
('682e17b5-d7ae-4a34-b9e5-cc9a60ceaf59', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[]}', NULL, '2020-07-03 12:02:18', '2020-07-03 12:02:18'),
('6bee1948-ecd0-4d29-a262-9c27244613c4', 'App\\Notifications\\Pengumuman', 'App\\User', 2007058409, '{\"id\":[{\"created_at\":\"2020-07-26 13:26:27\"}]}', NULL, '2020-07-26 06:26:46', '2020-07-26 06:26:46'),
('6fb4ee7f-5078-499e-8c3f-84808a71c40a', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304829, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 17:37:03', '2020-07-02 17:37:03'),
('7141bf78-f30c-423f-b21a-3bed322c8dee', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-06-24\"}]}', NULL, '2020-06-23 22:11:59', '2020-06-23 22:11:59'),
('749ab6cd-0856-45f6-86c7-46afc7cf393e', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-06-29\"}]}', NULL, '2020-07-03 12:15:54', '2020-07-03 12:15:54'),
('75d24d45-1880-490f-9127-8f954fdbf477', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 10:40:28', '2020-07-02 10:40:28'),
('76623625-78a5-416c-a9c2-f7893ec76845', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[]}', NULL, '2020-07-03 12:02:23', '2020-07-03 12:02:23'),
('7f958fb7-06f2-48b2-9523-137d6633de95', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-06-26\"}]}', NULL, '2020-06-25 19:07:56', '2020-06-25 19:07:56'),
('801f45d7-ffe4-4310-8244-4d5e53cce814', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-03 04:57:25', '2020-07-03 04:57:25'),
('82156f4b-ca14-44ef-96eb-d314ec90f5c4', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-03 04:54:03', '2020-07-03 04:54:03'),
('82e4ad8d-6302-4429-aeaa-f1a435001f9a', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 10:40:25', '2020-07-02 10:40:25'),
('89ed5f75-aefe-4446-97af-0018b7515c5f', 'App\\Notifications\\Pengumuman', 'App\\User', 2007058294, '{\"id\":[{\"created_at\":\"2020-07-26 13:32:13\"}]}', NULL, '2020-07-26 06:32:24', '2020-07-26 06:32:24'),
('8a4fe38b-200a-40aa-a34f-c2b94e1c24de', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-06-29\"}]}', NULL, '2020-07-03 21:10:00', '2020-07-03 21:10:00'),
('909d70ce-8c30-405c-a971-e0152ecf986d', 'App\\Notifications\\Pengumuman', 'App\\User', 2007058327, '{\"id\":[{\"created_at\":\"2020-07-16 17:36:37\"}]}', NULL, '2020-07-16 10:36:54', '2020-07-16 10:36:54'),
('90c5f54d-fc1a-40f6-ad1b-0f383748535d', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304829, '{\"id\":[]}', NULL, '2020-07-03 12:02:26', '2020-07-03 12:02:26'),
('94c81725-ae14-40ef-aa3b-0c89ec3c74cc', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 23:40:25', '2020-07-02 23:40:25'),
('9dbf32ac-63b1-4e34-850a-53bbe81bf7e6', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-06-26\"}]}', NULL, '2020-06-28 04:18:58', '2020-06-28 04:18:58'),
('a4614b8c-4b24-48dd-879e-10bc30e085ff', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304829, '{\"id\":[{\"tgl_mulai\":\"2020-06-29\"}]}', NULL, '2020-07-03 12:15:59', '2020-07-03 12:15:59'),
('acb73fc6-f001-479f-8113-5cd116e7d2a7', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"tgl_mulai\":\"2020-06-29\"}]}', NULL, '2020-07-03 12:15:57', '2020-07-03 12:15:57'),
('ae93a8f9-beda-4bf6-b36c-d9fdfbbf4f9d', 'App\\Notifications\\Pengumuman', 'App\\User', 2007058409, '{\"id\":[{\"created_at\":\"2020-07-16 17:36:37\"}]}', NULL, '2020-07-16 10:36:54', '2020-07-16 10:36:54'),
('b0602fbd-5dd5-4446-85e6-fa9c661ab8bb', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"created_at\":\"2020-07-26 13:32:13\"}]}', NULL, '2020-07-26 06:32:24', '2020-07-26 06:32:24'),
('bfd674fe-f594-433e-b688-32bae2bdce65', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304829, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-03 04:54:22', '2020-07-03 04:54:22'),
('c1c87e05-ba92-46e4-baca-3a38c4c53d52', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"tgl_mulai\":\"2020-06-29\"}]}', NULL, '2020-07-03 21:10:08', '2020-07-03 21:10:08'),
('c21e8108-c095-4d22-acf8-74aa8c12a9e2', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"created_at\":\"2020-07-26 13:27:55\"}]}', NULL, '2020-07-26 06:28:20', '2020-07-26 06:28:20'),
('c964af1f-92d1-4989-a3d2-69976d891700', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 17:37:00', '2020-07-02 17:37:00'),
('ca15ab52-55f2-418d-b372-c68c04c359a9', 'App\\Notifications\\Pengumuman', 'App\\User', 2007058327, '{\"id\":[{\"created_at\":\"2020-07-26 13:32:13\"}]}', NULL, '2020-07-26 06:32:24', '2020-07-26 06:32:24'),
('cb2b7cda-b671-47bd-aa17-bb0a96bdd67d', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-06-26\"}]}', NULL, '2020-06-25 18:45:17', '2020-06-25 18:45:17'),
('cd5c3dfd-9922-4b66-8e6e-a342903e9665', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 08:50:54', '2020-07-02 08:50:54'),
('cfead6ef-20b5-404f-a3c7-d9573e1e91c0', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304829, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 17:25:33', '2020-07-02 17:25:33'),
('d418aad8-cf54-4891-8274-42f05950fddc', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"created_at\":\"2020-07-26 13:32:13\"}]}', NULL, '2020-07-26 06:32:20', '2020-07-26 06:32:20'),
('d876a400-2e9f-4b6a-8327-3cacb934b242', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 17:25:30', '2020-07-02 17:25:30'),
('daf7ab87-723c-4d1e-9a4a-260b440ad9bb', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-06-29\"}]}', NULL, '2020-07-03 12:18:03', '2020-07-03 12:18:03'),
('ddb546a1-76d3-4ea1-bb6d-31185fd8dc94', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304829, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 10:40:32', '2020-07-02 10:40:32'),
('e7f0e0b5-dd7d-4294-a92f-3195373b6a75', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-02 23:40:22', '2020-07-02 23:40:22'),
('ea601d43-6624-4b13-a3a5-becddeb9076a', 'App\\Notifications\\Pengumuman', 'App\\User', 2007058327, '{\"id\":[{\"created_at\":\"2020-07-26 13:26:27\"}]}', NULL, '2020-07-26 06:26:46', '2020-07-26 06:26:46'),
('ec4b151d-68b4-4faf-bd5f-d85bb2a21950', 'App\\Notifications\\Pengumuman', 'App\\User', 2006242306, '{\"id\":[{\"tgl_mulai\":\"2020-06-26\"}]}', NULL, '2020-06-25 19:15:48', '2020-06-25 19:15:48'),
('f2fd9a87-83d5-4d05-848f-b8e5b5637e15', 'App\\Notifications\\Pengumuman', 'App\\User', 2006304164, '{\"id\":[{\"tgl_mulai\":\"2020-07-02\"}]}', NULL, '2020-07-03 04:54:15', '2020-07-03 04:54:15'),
('f566e34c-6382-4cac-8418-0d274af1b694', 'App\\Notifications\\Pengumuman', 'App\\User', 2007058294, '{\"id\":[{\"created_at\":\"2020-07-16 17:36:37\"}]}', NULL, '2020-07-16 10:36:54', '2020-07-16 10:36:54'),
('f79f0572-d4d6-44fd-ba2a-c6b0aa633fd8', 'App\\Notifications\\Pengumuman', 'App\\User', 2007058409, '{\"id\":[{\"created_at\":\"2020-07-26 13:32:13\"}]}', NULL, '2020-07-26 06:32:24', '2020-07-26 06:32:24'),
('ff6baf88-1c00-4b9e-9d7f-91e191023ea1', 'App\\Notifications\\Pengumuman', 'App\\User', 2007232545, '{\"id\":[{\"created_at\":\"2020-07-26 13:26:27\"}]}', NULL, '2020-07-26 06:26:50', '2020-07-26 06:26:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berita_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `thn_ajaran` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` enum('genap','ganjil') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('daftar','pengumuman') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id`, `berita_id`, `tgl_mulai`, `tgl_selesai`, `thn_ajaran`, `semester`, `status`, `created_at`, `updated_at`) VALUES
('2', 'B2006240509407', '2020-06-29', '2020-07-02', '2019/2020', 'ganjil', 'pengumuman', '2020-07-01 17:00:00', NULL),
('P2006240509454', 'B2007041135723', '2020-06-29', '2020-08-18', '2019/2020', 'genap', 'daftar', '2020-01-14 17:00:00', NULL),
('P2007161736689', 'B2007161736901', '2020-07-17', NULL, '2021/2022', 'genap', 'pengumuman', '2020-07-16 10:36:37', NULL),
('P2007261332981', 'B2007261332240', '2020-07-30', NULL, '2022/2023', 'genap', 'pengumuman', '2020-07-26 06:32:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `praktikum`
--

CREATE TABLE `praktikum` (
  `id` int(10) UNSIGNED NOT NULL,
  `dosen_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matkul_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jadwal_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruangan_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `semester` enum('1','2','3','4','5','6') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `praktikum`
--

INSERT INTO `praktikum` (`id`, `dosen_id`, `matkul_id`, `jadwal_id`, `ruangan_id`, `kelas_id`, `semester`, `created_at`, `updated_at`) VALUES
(4, 'D2006240509185', 'M2006240509139', 'J2006240509290', 'R2006240509278', 'K2006240509534', '3', '2020-07-02 17:37:20', NULL),
(6, 'D2006240509783', 'M2006240509219', 'J2006240509339', 'R2006240509278', 'K2006240509908', '3', '2020-07-02 17:00:00', NULL),
(9, 'D2006240509185', 'M2006240509139', 'J2006240509290', 'R2006240509278', 'K2007030410129', '1', '2020-07-02 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-06-23 22:09:06', NULL),
(2, 'mahasiswa', '2020-06-23 22:09:07', NULL),
(3, 'superadmin', '2020-08-13 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_ruangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama_ruangan`, `created_at`, `updated_at`) VALUES
('R2006240509278', 'HY Labkom 5', '2020-06-23 22:09:08', NULL),
('R2006240509737', 'HY RPL 1', '2020-06-23 22:09:08', NULL),
('R2007010658196', 'HY RPL 2', NULL, NULL),
('R2007010658579', 'LAB MULMED', NULL, '2020-07-01 00:10:22'),
('R2007010658811', 'HY RPL 3', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE `semester` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `semester`
--

INSERT INTO `semester` (`id`, `semester`, `created_at`, `updated_at`) VALUES
('S2006240509223', 1, NULL, NULL),
('S2006240509828', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'avatar.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `role_id`, `email`, `nama`, `username`, `password`, `no_hp`, `foto`, `created_at`, `updated_at`) VALUES
('2006242306', 2, 'bwulan99@gmail.com', 'Bella Wulan N', '410828', '$2y$10$ZfsVftxV5qYoH7znwgNBaeu25IfIUwMZrOak6kxJUAn2Rctxli92m', '081804007078', '410828.png', '2020-07-22 07:14:07', '2020-07-22 07:14:07'),
('2006244563', 1, 'admin@mail.com', 'Admin', '123456', '$2y$10$cYqajBGSHyfXS5UX0bD3betiLHEpFX0gTJGU6Ns8i5ovnDhnte.j2', '0877380088068', 'avatar.png', '2020-06-23 22:09:07', '2020-07-06 12:41:50'),
('2006304164', 2, 'belinda@gmail.com', 'Belinda Christabel', '410888', '$2y$10$NHwIfDD5.w1finhe0FCVi.dbxV6VhvpfJ.kyP7TLeBX5rCZ1q7HSO', NULL, '410888.png', '2020-06-29 22:28:02', '2020-07-10 00:34:38'),
('2007053369', 1, NULL, 'Admin3', '123455', '$2y$10$y2CSqHZQlV71mhLctHDZWex3Y0Flb62//MbQ0A5W5dHOdZLz4FCjW', NULL, 'avatar.png', '2020-07-05 08:43:26', '2020-07-05 08:43:26'),
('2007055633', 1, NULL, 'Admin2', '123464', '$2y$10$G49JhqpsPM9dJS7NsyyodOhDfz62f0Mq.Chijr4b.OtOwuiVcbydy', NULL, 'avatar.png', '2020-07-05 04:46:09', '2020-07-05 04:46:09'),
('2007056274', 1, NULL, 'Admin4', '123343', '$2y$10$taf2S5axAnbDiFwh/nzM3ubmc3Ej/x4g92nqSEh.psg6k3TXEDAdC', NULL, 'avatar.png', '2020-07-05 08:43:26', '2020-07-05 08:43:26'),
('2007058294', 2, 'mahasiswa@mahasiswa.com', 'Pintasari Nugraheni', '416361', '$2y$10$QtjqcG28Ski6u2W5qyds..ReIRoRQc/Ul8zwaFTHURAtDTzrC2/Qu', '081804055303', 'avatar.png', '2020-08-06 19:59:16', '2020-08-06 19:59:16'),
('2007058327', 2, NULL, 'Devi Qurnia Sari', '410831', '$2y$10$WCja.OWZnL7wWdDmK1fY.e64oYr9hOQ2Qi/zHpsA5sGHThje0tLwS', NULL, 'avatar.png', '2020-07-05 08:49:40', '2020-07-05 08:49:40'),
('2007058409', 2, NULL, 'Amalia Rizkia', '415509', '$2y$10$r3HjQoSSW6JLdhW8hEdxGuO2Q0yGth.OSOQizE1hrv2D.3IoyEI4u', NULL, 'avatar.png', '2020-07-05 08:49:39', '2020-07-05 08:49:39'),
('2007232545', 2, 'aku@aku.com', 'aku', '987654', '$2y$10$enXJ8lcOou.PfjdrthNko.XABnJX6SVMrSZcVOFK7elof4EiEAzRO', NULL, 'avatar.png', '2020-07-23 09:45:22', '2020-07-23 09:45:22'),
('2008073732', 2, 'mencoba@gmail.com', 'Mencoba', '41399', '$2y$10$2c2QFcZdKUgEb1uYyM/yceKbJPiHBdAn4QDaWpQlWzEqKCgzW0Jlm', NULL, 'avatar.png', '2020-08-06 20:39:41', '2020-08-06 20:39:41'),
('2008078223', 2, 'contoh@gmail.com', 'Contoh', '410909', '$2y$10$rSHvxddaKVzkdOegCEcT0eX/mNU9moKoyPSsptaTQK4sJ8XXLH.Fm', NULL, 'avatar.png', '2020-08-06 20:38:46', '2020-08-06 20:38:46'),
('2008078241', 2, 'melan@gmail.com', 'Melan', '410999', '$2y$10$6k8ncf2Vb4PSAYz/Ldb1l.fdUrVd3H7s9S94QhxY2UQHNN8XCYRkC', NULL, 'avatar.png', '2020-08-06 19:55:43', '2020-08-06 19:55:43'),
('2008093677', 2, 'a@a.com', 'a', '321321', '$2y$10$HLg8iNR5RNARYyhYazzciurCPV0D7oE1vlnqFdP/gDKt5QSybis6m', NULL, 'avatar.png', '2020-08-09 05:23:01', '2020-08-09 05:23:01'),
('2008094703', 3, 'super@gmail.com', 'Super1', '312345', '$2y$10$L4A4kESa96liLIn2qQzKbetPslqchCDWAskZaXNmuDu7XFfDiBiz.', '081804055311', 'avatar.png', '2020-08-09 05:34:06', '2020-08-09 05:34:06'),
('2008147248', 2, 'siapa@gmail.com', 'siapa', '654321', '$2y$10$Bm81PU3riP1tpHIFRsyuWO39jFDKOND5NgVMl7wqO4t1/k6tdqA9K', '0882828281112', 'avatar.png', '2020-08-13 21:53:07', '2020-08-13 21:53:07');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_nip_unique` (`nip`),
  ADD KEY `admin_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `berita_judul_unique` (`judul`),
  ADD KEY `berita_admin_id_foreign` (`admin_id`);

--
-- Indeks untuk tabel `daftar`
--
ALTER TABLE `daftar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daftar_periode_id_foreign` (`periode_id`),
  ADD KEY `daftar_mahasiswa_id_foreign` (`mahasiswa_id`),
  ADD KEY `daftar_praktikum_id_foreign` (`praktikum_id`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dosen_nidn_unique` (`nidn`),
  ADD UNIQUE KEY `dosen_nama_unique` (`nama`);

--
-- Indeks untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ketentuan`
--
ALTER TABLE `ketentuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswa_no_rekening_unique` (`no_rekening`),
  ADD KEY `mahasiswa_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matkul_kode_vmk_unique` (`kode_vmk`),
  ADD UNIQUE KEY `matkul_nama_matkul_unique` (`nama_matkul`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periode_berita_id_foreign` (`berita_id`);

--
-- Indeks untuk tabel `praktikum`
--
ALTER TABLE `praktikum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `praktikum_dosen_id_foreign` (`dosen_id`),
  ADD KEY `praktikum_matkul_id_foreign` (`matkul_id`),
  ADD KEY `praktikum_jadwal_id_foreign` (`jadwal_id`),
  ADD KEY `praktikum_ruangan_id_foreign` (`ruangan_id`),
  ADD KEY `praktikum_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruangan_nama_ruangan_unique` (`nama_ruangan`);

--
-- Indeks untuk tabel `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_nama_unique` (`nama`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD UNIQUE KEY `user_email_unique` (`email`),
  ADD UNIQUE KEY `user_no_hp_unique` (`no_hp`),
  ADD KEY `user_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ketentuan`
--
ALTER TABLE `ketentuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `praktikum`
--
ALTER TABLE `praktikum`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);

--
-- Ketidakleluasaan untuk tabel `daftar`
--
ALTER TABLE `daftar`
  ADD CONSTRAINT `daftar_mahasiswa_id_foreign` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`),
  ADD CONSTRAINT `daftar_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`),
  ADD CONSTRAINT `daftar_praktikum_id_foreign` FOREIGN KEY (`praktikum_id`) REFERENCES `praktikum` (`id`);

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD CONSTRAINT `periode_berita_id_foreign` FOREIGN KEY (`berita_id`) REFERENCES `berita` (`id`);

--
-- Ketidakleluasaan untuk tabel `praktikum`
--
ALTER TABLE `praktikum`
  ADD CONSTRAINT `praktikum_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`),
  ADD CONSTRAINT `praktikum_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`id`),
  ADD CONSTRAINT `praktikum_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `praktikum_matkul_id_foreign` FOREIGN KEY (`matkul_id`) REFERENCES `matkul` (`id`),
  ADD CONSTRAINT `praktikum_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
