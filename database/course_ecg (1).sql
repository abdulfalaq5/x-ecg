-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 18 Jan 2024 pada 21.57
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course_ecg`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank_quiz`
--

CREATE TABLE `bank_quiz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `materi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title_quiz` varchar(255) DEFAULT NULL,
  `des_quiz` text DEFAULT NULL,
  `waktu_quiz` datetime DEFAULT NULL,
  `waktu_akhir_quiz` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bank_quiz`
--

INSERT INTO `bank_quiz` (`id`, `course_id`, `materi_id`, `title_quiz`, `des_quiz`, `waktu_quiz`, `waktu_akhir_quiz`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 4, 'test', '<p>teset keterangan</p>', '2023-12-25 00:00:00', '2023-12-26 00:00:00', '2023-12-25 09:48:48', '2023-12-25 09:48:48', NULL),
(2, 3, 5, 'quiz dart', '<p>teset quiz dart</p>', '2023-12-26 00:00:00', '2023-12-27 00:00:00', '2023-12-25 14:51:07', '2023-12-25 14:51:07', NULL),
(3, 6, 1, 'Quiz pertama', 'test', '2024-01-17 00:00:00', '2024-01-19 00:00:00', '2024-01-16 10:40:59', '2024-01-16 10:40:59', NULL),
(4, 6, 1, 'Quiz pertama', 'test', '2024-01-17 00:00:00', '2024-01-19 00:00:00', '2024-01-16 10:42:13', '2024-01-16 10:42:13', NULL),
(5, 6, 1, 'fff', 'test', '2024-01-17 00:00:00', '2024-01-18 00:00:00', '2024-01-16 10:42:59', '2024-01-16 10:42:59', NULL),
(6, 6, 1, 'fff', 'test', '2024-01-17 00:00:00', '2024-01-18 00:00:00', '2024-01-16 10:44:21', '2024-01-16 10:44:21', NULL),
(7, 6, 8, 'cek edit', 'scsc', '2024-01-17 00:00:00', '2024-01-20 00:00:00', '2024-01-16 10:45:27', '2024-01-16 12:56:37', NULL),
(8, 6, 10, 'awal', 'cek', '2024-01-16 00:00:00', '2024-01-17 00:00:00', '2024-01-16 12:39:46', '2024-01-16 12:39:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank_quiz_detail`
--

CREATE TABLE `bank_quiz_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `materi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bank_quiz_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `pertanyaan` text DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `option1` text DEFAULT NULL,
  `option2` text DEFAULT NULL,
  `option3` text DEFAULT NULL,
  `option4` text DEFAULT NULL,
  `bobot_nilai` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bank_quiz_detail`
--

INSERT INTO `bank_quiz_detail` (`id`, `course_id`, `materi_id`, `bank_quiz_id`, `jenis`, `pertanyaan`, `jawaban`, `created_at`, `updated_at`, `deleted_at`, `option1`, `option2`, `option3`, `option4`, `bobot_nilai`, `status`) VALUES
(4, 2, 4, 1, '1', 'pertanyaan isian', NULL, '2023-12-25 14:17:15', '2023-12-25 14:17:15', NULL, NULL, NULL, NULL, NULL, '100', ''),
(5, 2, 4, 1, '2', 'pertayaan isian ganda', 'C', '2023-12-25 14:17:58', '2023-12-25 14:17:58', NULL, NULL, NULL, NULL, NULL, '100', ''),
(6, 2, 4, 1, '3', 'pertanyaan true or false', 'true', '2023-12-25 14:18:24', '2023-12-25 14:18:24', NULL, NULL, NULL, NULL, NULL, '100', ''),
(9, 6, 8, 7, '2', 'tanya aja', 'B', '2024-01-16 11:24:48', '2024-01-17 14:47:15', NULL, 'pilihan A', 'pilihan B', 'pilihan C', 'pilihan D', '30', '1'),
(12, 6, 10, 8, '2', 'contoh pertanyaan pilihan ganda', 'B', '2024-01-16 12:39:53', '2024-01-17 14:48:43', NULL, 'pilihan A', 'pilihan B', 'pilihan C', 'pilihan B', '20', '1'),
(13, 6, 10, 8, '3', 'contoh pertanyaan true or false', '1', '2024-01-16 12:39:53', '2024-01-17 14:55:30', NULL, NULL, NULL, NULL, NULL, '30', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banner`
--

CREATE TABLE `banner` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_banner` text DEFAULT NULL,
  `des_banner` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `course`
--

CREATE TABLE `course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instruktur` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `des` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `klasifikasi_id` int(11) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `live` varchar(100) DEFAULT NULL,
  `cover` text DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `waktu_per_minggu` varchar(100) DEFAULT NULL,
  `income` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `course`
--

INSERT INTO `course` (`id`, `instruktur`, `status`, `des`, `created_at`, `updated_at`, `deleted_at`, `kategori_id`, `klasifikasi_id`, `code`, `live`, `cover`, `title`, `harga`, `waktu_per_minggu`, `income`) VALUES
(6, '12', 'Published', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">A full-stack developer is&nbsp;</span><span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">a developer or engineer who can build both the front end and the&nbsp;<span jsaction=\"click:sKUsF\" role=\"tooltip\" tabindex=\"0\" style=\"outline: 0px;\"><g-bubble jscontroller=\"QVaUhf\" data-ci=\"\" data-du=\"200\" data-tp=\"5\" jsaction=\"R9S7w:VqIRre;\" jsshadow=\"\"><span jsname=\"d6wfac\" class=\"c5aZPb\" data-enable-toggle-animation=\"true\" data-extra-container-classes=\"ZLo7Eb\" data-hover-hide-delay=\"1000\" data-hover-open-delay=\"500\" data-send-open-event=\"true\" data-theme=\"0\" data-width=\"250\" role=\"button\" tabindex=\"0\" jsaction=\"vQLyHf\" jsslot=\"\" data-ved=\"2ahUKEwjCqaHondyDAxWzyqACHQvCCS0QmpgGegQIGxAD\" style=\"outline: 0px;\"><span jsname=\"ukx3I\" class=\"JPfdse\" data-bubble-link=\"\" data-segment-text=\"back end\" style=\"border-bottom: 1px dashed rgba(4, 12, 40, 0.5);\">back end</span></span></g-bubble></span>&nbsp;of a website</span><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">. The front end (the parts of a website a user sees and interacts with) and the back end (the behind-the-scenes data storage and processing) require different skill sets.</span></p>', '2024-01-13 23:19:36', '2024-01-13 23:19:36', NULL, 1, 1, 'FSD', 'Aktif', '1705213176_fotofsd.png', 'Full Stack Develop', '0', '10', 'pelatihan, materi, diskusi'),
(7, '12', 'Published', '<p style=\"line-height: 2; color: rgb(0, 0, 0); font-family: &quot;PT Serif&quot;, serif; font-size: 18px;\">Melansir laman&nbsp;<a href=\"https://www.zdnet.com/article/how-to-become-software-engineer/#:~:text=Software%20engineers%20develop%2C%20design%2C%20and,cloud%20platforms%2C%20and%20web%20applications.\" target=\"_blank\" rel=\"noopener\" style=\"color: black;\">ZD Net</a><em>, software engineer&nbsp;</em>(SE) adalah para ahli yang berperan dalam proses analisis kebutuhan dan desain pengguna, konstruksi, serta uji perangkat lunak seperti aplikasi.</p><p style=\"line-height: 2; color: rgb(0, 0, 0); font-family: &quot;PT Serif&quot;, serif; font-size: 18px;\">Dalam melaksanakan tugasnya, mereka menggunakan bahasa pemrograman seperti C++, Java, dan Python saat merancang&nbsp;<em>software</em>&nbsp;untuk aplikasi komputer, aplikasi seluler, platform&nbsp;<em>cloud</em>, dan aplikasi web.</p>', '2024-01-13 23:23:26', '2024-01-13 23:23:26', NULL, 1, 1, 'SE', 'Aktif', '1705213406_c1.jpeg', 'Software Engineer', '0', '10', 'materi,diskusi'),
(8, '13', 'Published', '<p>test sertifikat</p>', '2024-01-13 23:25:19', '2024-01-13 23:25:19', NULL, 2, 2, 'SEO', 'Aktif', '1705213519_c2.jpeg', 'SEO', '0', '10', 'sertifikat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawab_quiz`
--

CREATE TABLE `jawab_quiz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peserta_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `materi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quiz_detail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `jawab` varchar(255) DEFAULT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jawab_quiz`
--

INSERT INTO `jawab_quiz` (`id`, `peserta_id`, `course_id`, `materi_id`, `quiz_detail_id`, `jawab`, `nilai`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 4, 6, 10, 12, 'C', '0', '2024-01-17 14:21:07', '2024-01-17 14:21:07', NULL),
(4, 4, 6, 8, 9, 'B', '1', '2024-01-17 14:47:15', '2024-01-17 14:47:15', NULL),
(5, 4, 6, 10, 12, NULL, '0', '2024-01-17 14:48:43', '2024-01-17 14:48:43', NULL),
(6, 4, 6, 10, 13, 'BENAR', '0', '2024-01-17 14:53:19', '2024-01-17 14:53:19', NULL),
(7, 4, 6, 10, 13, 'BENAR', '1', '2024-01-17 14:55:30', '2024-01-17 14:55:30', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Education', '2023-12-23 23:52:36', '2023-12-23 23:52:36', NULL),
(2, 'Contruction', '2023-12-23 23:52:36', '2023-12-23 23:52:36', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `klasifikasi`
--

CREATE TABLE `klasifikasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `klasifikasi_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `klasifikasi`
--

INSERT INTO `klasifikasi` (`id`, `klasifikasi_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Training', '2023-12-23 23:53:34', '2023-12-23 23:53:34', NULL),
(2, 'Certification', '2023-12-23 23:53:34', '2023-12-23 23:53:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konten`
--

CREATE TABLE `konten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` text DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `materi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `module_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `konten`
--

INSERT INTO `konten` (`id`, `file`, `course_id`, `materi_id`, `module_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1705437971_fotofsd.png', 6, 8, 1, '2024-01-16 13:46:11', '2024-01-16 13:46:11', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi_course`
--

CREATE TABLE `materi_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `star_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `title_materi` varchar(255) DEFAULT NULL,
  `status_materi` varchar(255) DEFAULT NULL,
  `des_materi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `file_materi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `materi_course`
--

INSERT INTO `materi_course` (`id`, `course_id`, `star_date`, `end_date`, `title_materi`, `status_materi`, `des_materi`, `created_at`, `updated_at`, `deleted_at`, `file_materi`) VALUES
(4, 2, '2023-12-25 00:00:00', '2023-12-29 00:00:00', 'web dasar', 'Publish', '<p>pertemuan ketujuah edit</p>', '2023-12-24 23:19:24', '2023-12-27 20:53:17', NULL, '1703485164_pertemuan 7.pdf'),
(5, 3, '2023-12-26 00:00:00', '2023-12-30 00:00:00', 'Bahasa Dart', 'Publish', '<p>teset keterangan materi dart dasar</p>', '2023-12-25 14:50:35', '2023-12-25 14:50:35', NULL, '1703541035_Pertemuan 38 - Presentasi Tugas Desain Kelompok.pdf'),
(6, 2, '2023-12-28 00:00:00', '2023-12-30 00:00:00', 'materi 2', 'Publish', '<p>teset</p>', '2023-12-27 20:54:15', '2023-12-27 20:54:15', NULL, '1703735655_Jadwal Present Project.pdf'),
(7, 5, '2023-12-28 00:00:00', '2023-12-31 00:00:00', 'Web Dasar', 'Publish', '<p>keterangan materi</p>', '2023-12-28 05:25:14', '2023-12-28 05:25:14', NULL, '1703766314_Pertemuan 38 - Presentasi Tugas Desain Kelompok.pdf'),
(8, 6, '2024-01-15 00:00:00', '2024-01-17 00:00:00', 'Pertemuan pertama', 'Publish', 'knknknk', '2024-01-15 06:06:58', '2024-01-15 10:27:25', NULL, '1705324018_Jadwal Present Project.pdf'),
(10, 6, '2024-01-15 00:00:00', '2024-01-18 00:00:00', 'Pertemuan kedua', 'Publish', 'cek', '2024-01-15 09:11:21', '2024-01-15 09:11:21', NULL, '1705335081_Jadwal Present Project.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `midtrans`
--

CREATE TABLE `midtrans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_order` varchar(255) DEFAULT NULL,
  `pengguna_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tagihan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_recurring` varchar(255) DEFAULT NULL,
  `cc_token_id` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `midtrans_statement` text DEFAULT NULL,
  `transaction_status` varchar(255) DEFAULT NULL,
  `fraud_status` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_bank` varchar(255) DEFAULT NULL,
  `payment_va` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `response` varchar(255) DEFAULT NULL,
  `payment_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_13_054321_create_course_table', 1),
(6, '2023_12_15_003256_create_pengguna_table', 1),
(7, '2023_12_15_010546_add_level_field_for_pengguna_table', 1),
(8, '2023_12_13_064454_create_mycourses_table', 2),
(9, '2023_12_13_054321_create_module_course_table', 3),
(10, '2023_12_13_054321_create_testimoni_course_table', 4),
(11, '2023_12_15_003256_create_kategori_table', 5),
(12, '2023_12_15_003256_create_klasifikasi_table', 5),
(13, '2023_12_13_054321_create_materi_course_table', 6),
(14, '2023_12_15_003256_create_bank_quiz_detial_table', 7),
(15, '2023_12_15_003256_create_bank_quiz_table', 7),
(16, '2023_12_13_054321_create_payment_table', 8),
(17, '2023_12_13_054321_create_tagihan_table', 8),
(18, '2023_12_13_054321_create_midtrans_table', 9),
(20, '2023_12_13_054321_create_banner_table', 10),
(21, '2023_12_15_003256_create_konten_table', 11),
(22, '2023_12_15_010546_add_status_field_for_detail_quiz_table', 12),
(23, '2023_12_15_003256_create_jawab_quiz_table', 13);

-- --------------------------------------------------------

--
-- Struktur dari tabel `module_course`
--

CREATE TABLE `module_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `instruktur` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `des` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `materi_id` int(11) DEFAULT NULL,
  `file_materi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `module_course`
--

INSERT INTO `module_course` (`id`, `course_id`, `name`, `instruktur`, `status`, `title`, `des`, `created_at`, `updated_at`, `deleted_at`, `materi_id`, `file_materi`) VALUES
(1, 6, NULL, NULL, NULL, 'hujan', 'gggg', '2024-01-15 08:20:41', '2024-01-15 08:20:41', NULL, 8, '1705332041_Jadwal Present Project.pdf'),
(3, 6, NULL, NULL, NULL, 'dcscs', 'sdcsdc', '2024-01-15 10:41:07', '2024-01-15 10:41:07', NULL, 12, '1705340467_Jadwal Present Project.pdf'),
(4, 6, NULL, NULL, NULL, 'web dasar', 'tes', '2024-01-16 09:44:55', '2024-01-16 09:44:55', NULL, 10, '1705423495_Jadwal Present Project.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mycourses`
--

CREATE TABLE `mycourses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peserta_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mycourses`
--

INSERT INTO `mycourses` (`id`, `peserta_id`, `course_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 6, '1', '2024-01-17 11:28:07', '2024-01-17 11:28:07', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pengguna_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tagihan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_order` varchar(255) DEFAULT NULL,
  `total_tagihan` varchar(255) DEFAULT NULL,
  `total_terbayar` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `name`, `username`, `email`, `phone_number`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `level`, `deleted_at`) VALUES
(1, 'member satu', 'membersatu@gmail.com', 'membersatu@gmail.com', NULL, NULL, '$2y$12$6PQBzr3AVoo39KR/q/dfTuPv40bo6VdngyJTl0rMnghbBAUK4oVf2', NULL, '2023-12-19 16:17:51', '2023-12-19 16:17:51', '3', NULL),
(2, 'member dua', 'memberdua@gmail.com', 'memberdua@gmail.com', NULL, NULL, '$2y$12$JtnDgRz0nuq3wKuk7HfmluY/JIYuDfUOlARaWTTQClqKr.zE1zBeO', NULL, '2023-12-19 16:18:28', '2023-12-19 16:18:28', '3', NULL),
(3, 'member tiga', 'membertiga@gmail.com', 'membertiga@gmail.com', NULL, NULL, '$2y$12$ms2SqyeLo0nezXhiCead5OXcrfrVuv8fmedWOWM2AJxjxGfHL9UEC', NULL, '2023-12-19 16:19:44', '2023-12-23 14:22:44', '3', '2023-12-23 14:22:44'),
(4, 'member lima', 'memberlima@gmail.com', 'memberlima@gmail.com', '097848743853', NULL, '$2y$12$qRN2.bMn6BEZc3HERcRH0.8TLibvbnmV8B0KsbmVjbVPy75T31cUe', NULL, '2023-12-19 16:26:47', '2023-12-23 14:22:35', '3', NULL),
(5, 'super admin', 'superadmin@gmail.com', 'superadmin@gmail.com', NULL, NULL, '$2y$12$fWC9uLw0A3H4wE7xktPEp.Bou7NUIang2xfFmYXcaWfP5HolW4T2K', NULL, '2023-12-20 01:32:21', '2023-12-20 01:32:21', '1', NULL),
(6, 'edit', 'bhjbhjbhj@gmail.com', 'bhjbhjbhj@gmail.com', '43543234234', NULL, '$2y$12$bDp8fkMacbhLuMBauvcE1.DPwo1OJOD8EEmj3q8IWuqbNrKbv/7fO', NULL, '2023-12-23 08:29:38', '2024-01-13 23:15:06', '2', '2024-01-13 23:15:06'),
(7, 'dedeku', 'dedeku@gmail.com', 'dedeku@gmail.com', NULL, NULL, '$2y$12$TfTV/UAT0.yn/vUXz0leFuz5k1QbdY6uCyBqtyhDje8L5wZwdgafu', NULL, '2023-12-23 08:31:57', '2024-01-13 23:15:09', '2', '2024-01-13 23:15:09'),
(8, 'gtgt', 'bsjhb@gmail.com', 'bsjhb@gmail.com', NULL, NULL, '$2y$12$/8AgM3oha5LLYok.lk.2V.0BIfYdYtnHYWroxtGqnFL/IIuQB9ZUe', NULL, '2023-12-23 08:34:14', '2024-01-13 23:15:11', '2', '2024-01-13 23:15:11'),
(9, 'jeje', 'jeje@gmail.com', 'jeje@gmail.com', NULL, NULL, '$2y$12$oIlDDk9iJ9i.OVfjEEpF6.yeVSgO2NH0pvVy/RZoebzDMB7N97eTO', NULL, '2023-12-23 14:02:44', '2024-01-13 23:15:14', '2', '2024-01-13 23:15:14'),
(10, 'member coba', 'mebercoba12@gmail.com', 'mebercoba12@gmail.com', '08826487242', NULL, '$2y$12$ajBh8Jxy6ClabbJGCnE3BOEWX6xv.Y/XYLZA79pS9BubpvvuY9qW.', NULL, '2023-12-23 14:22:24', '2023-12-23 14:22:24', '3', NULL),
(11, 'arjuna', 'arjuna@gmail.com', 'arjuna@gmail.com', NULL, NULL, '$2y$12$KDfCugQW7E9ZhJdX1JDbpO8k3JM9xQAXLcC8lZKI73w3Q7WtYcH0K', NULL, '2023-12-28 05:18:03', '2023-12-28 05:18:03', '3', NULL),
(12, 'abdul falaq', 'afalaq5@gmail.com', 'afalaq5@gmail.com', '0818764782684', NULL, '$2y$12$S0nYhuSAJZfGlFaSXHq4Qesh6tgygZT036/vfzDbM39tLUNwF.mHC', NULL, '2024-01-13 23:16:09', '2024-01-13 23:24:35', '2', NULL),
(13, 'sakti', 'sakti@gmail.com', 'sakti@gmail.com', '083876387653', NULL, '$2y$12$wObr3SKWIom0TmjWrN.4Jua.61XvbJHYVIEBWSz0elXcHhG8igKRK', NULL, '2024-01-13 23:24:25', '2024-01-13 23:24:25', '2', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pengguna_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_tagihan` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni_course`
--

CREATE TABLE `testimoni_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pengguna_id` varchar(255) DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `des` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bank_quiz`
--
ALTER TABLE `bank_quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bank_quiz_detail`
--
ALTER TABLE `bank_quiz_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jawab_quiz`
--
ALTER TABLE `jawab_quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `klasifikasi`
--
ALTER TABLE `klasifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `konten`
--
ALTER TABLE `konten`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materi_course`
--
ALTER TABLE `materi_course`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `midtrans`
--
ALTER TABLE `midtrans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `module_course`
--
ALTER TABLE `module_course`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mycourses`
--
ALTER TABLE `mycourses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengguna_username_unique` (`username`),
  ADD UNIQUE KEY `pengguna_email_unique` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimoni_course`
--
ALTER TABLE `testimoni_course`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bank_quiz`
--
ALTER TABLE `bank_quiz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `bank_quiz_detail`
--
ALTER TABLE `bank_quiz_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `banner`
--
ALTER TABLE `banner`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawab_quiz`
--
ALTER TABLE `jawab_quiz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `klasifikasi`
--
ALTER TABLE `klasifikasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `konten`
--
ALTER TABLE `konten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `materi_course`
--
ALTER TABLE `materi_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `midtrans`
--
ALTER TABLE `midtrans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `module_course`
--
ALTER TABLE `module_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `mycourses`
--
ALTER TABLE `mycourses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `testimoni_course`
--
ALTER TABLE `testimoni_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
