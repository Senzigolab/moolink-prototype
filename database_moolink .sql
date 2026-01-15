-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_moolink
CREATE DATABASE IF NOT EXISTS `db_moolink` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_moolink`;

-- Dumping structure for table db_moolink.batches
CREATE TABLE IF NOT EXISTS `batches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `batch_code` varchar(20) DEFAULT NULL,
  `peternak` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `jam_perah` datetime DEFAULT NULL,
  `suhu_pasteurisasi` int DEFAULT NULL,
  `nutrisi_protein` varchar(50) DEFAULT 'Terjaga (>80%)',
  `status_pengiriman` varchar(50) DEFAULT 'Dalam Perjalanan',
  PRIMARY KEY (`id`),
  UNIQUE KEY `batch_code` (`batch_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_moolink.batches: ~1 rows (approximately)
INSERT INTO `batches` (`id`, `batch_code`, `peternak`, `lokasi`, `jam_perah`, `suhu_pasteurisasi`, `nutrisi_protein`, `status_pengiriman`) VALUES
	(1, 'MOO-2026-001', 'Rembulan Merapi Farm', 'Pentingsari, Cangkringan', '2026-01-14 04:30:00', 72, 'Terjaga (>80%)', 'Dalam Perjalanan');

-- Dumping structure for table db_moolink.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(50) DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `deskripsi` text,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table db_moolink.products: ~3 rows (approximately)
INSERT INTO `products` (`id`, `nama_produk`, `harga`, `deskripsi`, `gambar`) VALUES
	(1, 'MooLink 1 Liter', 15000, 'Susu Keluarga Hemat. Cocok untuk stok di kulkas.', 'susu_1l.jpg'),
	(2, 'MooLink 500 ml', 8000, 'Ukuran Pas. Cocok untuk diminum berdua.', 'susu_500ml.jpg'),
	(3, 'MooLink 250 ml', 5000, 'On-The-Go. Cocok untuk bekal atau habis gym.', 'susu_250ml.jpg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
