-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Mei 2015 pada 04.55
-- Versi Server: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `parkir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karcis`
--

CREATE TABLE IF NOT EXISTS `karcis` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `plat` text NOT NULL,
  `kendaraan` varchar(6) NOT NULL,
  `masuk` text NOT NULL,
  `keluar` text NOT NULL,
  `harga` int(11) NOT NULL,
  `petugas` text NOT NULL,
  `pegutas_keluar` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27051 ;

--
-- Dumping data untuk tabel `karcis`
--

INSERT INTO `karcis` (`id`, `plat`, `kendaraan`, `masuk`, `keluar`, `harga`, `petugas`, `pegutas_keluar`) VALUES
(5559, 'L 6484 NO', 'Motor', '16:04:20 18/05/2015', '', 3000, '', ''),
(5560, 'asd asdas', 'Motor', '16:17:32 18/05/2015', '', 3000, 'P_Masuk', ''),
(5561, 'asdasd', 'Motor', '21:18:35 18/05/2015', '', 3000, 'P_Masuk', ''),
(5562, 'asasd', 'Motor', '21:20:31 18/05/2015', '', 3000, 'P_Masuk', ''),
(18989, 'L 9887 NS', 'Mobil', '21:33:42 18/05/2015', '', 5000, 'P_Masuk', ''),
(27050, 'L 2312 JA', 'Motor', '21:26:15 18/05/2015', '', 3000, 'P_Masuk', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `level` enum('admin','P_Masuk','P_Keluar','') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(2, 'Daniii', 'DAdasd', 'a8f5f167f44f4964e6c998dee827110c', 'admin'),
(3, 'dadada', 'dadada', '7627cb9027e713e301e83a8f13057055', 'admin'),
(4, 'Dani', 'Dani', '03d38a905878a76704542d49a8407635', 'admin'),
(5, 'asdas', 'asda', 'a8f5f167f44f4964e6c998dee827110c', 'admin'),
(7, 'Danime', 'Danime', '974d9f2decbf17a3fba4efeb94010969', 'admin'),
(10, 'Petugas Masuk', 'P_Masuk', 'd68e29539888c53139c6be193fd1c155', 'P_Masuk'),
(11, 'coba', 'coba', 'c3ec0f7b054e729c5a716c8125839829', 'admin'),
(15, 'P_Keluar', 'P_Keluar', 'a94f592dbcb7286045713377c638b74b', 'P_Keluar');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
