-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2018 at 12:38 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Database: `cf`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'admin2', 'c84258e9c39059a89ab77d846ddab909');

-- --------------------------------------------------------

--
-- Table structure for table `b_pengetahuan`
--

CREATE TABLE `b_pengetahuan` (
  `id_b_pengetahuan` int(11) NOT NULL,
  `id_diagnosa` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL,
  `mb` double(2,1) NOT NULL,
  `md` double(2,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_pengetahuan`
--

INSERT INTO `b_pengetahuan` (`id_b_pengetahuan`, `id_diagnosa`, `id_gejala`, `mb`, `md`) VALUES
(1, 1, 1, 0.6, 0.4),
(2, 1, 2, 0.8, 0.2),
(3, 1, 3, 0.6, 0.4),
(4, 2, 1, 0.6, 0.4),
(5, 2, 3, 0.7, 0.3),
(6, 2, 4, 0.8, 0.2),
(7, 2, 5, 0.8, 0.2),
(8, 3, 1, 0.6, 0.4),
(9, 3, 5, 0.7, 0.3),
(10, 3, 6, 0.9, 0.1),
(11, 3, 7, 0.8, 0.2);

-- --------------------------------------------------------

--
-- Table structure for table `diagnosa`
--

CREATE TABLE `diagnosa` (
  `id_diagnosa` int(11) NOT NULL,
  `kode_diagnosa` varchar(5) NOT NULL,
  `nama_diagnosa` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diagnosa`
--

INSERT INTO `diagnosa` (`id_diagnosa`, `kode_diagnosa`, `nama_diagnosa`, `keterangan`) VALUES
(1, 'P1', 'Demam Berdarah Dengue', '- Minum banyak cairan dan istirahat yang cukup\r\n- Mengonsumsi obat penurun panas, untuk meredakan demam. Namun hindari aspirin atau obat antiinflamasi nonsteroid (OAINS), karena dapat memperparah perdarahan.'),
(2, 'P2', 'Demam Penyakit Kuning', '- Memberi tambahan oksigen.\r\n- Memberikan obat demam dan pereda rasa sakit, seperti paracetamol.\r\n- Menjaga tekanan darah tidak turun dengan infus cairan.\r\n- Transfusi darah, bila terjadi anemia akibat perdarahan.\r\n- Cuci darah jika mengalami gagal ginjal.\r\n- Pengobatan terhadap infeksi penyerta lainnya yang mungkin terjadi, seperti infeksi bakteri.'),
(3, 'P3', 'Chikungunya', '- Tidak ada pengobatan khusus untuk menyembuhkan chikungunya. Obat-obatan pereda rasa sakit dan antiradang hanya bertujuan meredakan gejala.\r\n- Di antaranya penurun demam dan analgesik untuk meredakan nyeri otot dan rasa sakit yang lain.\r\n- Pada sebagian penderita yang kekurangan cairan, misalnya akibat kehilangan nafsu makan dan malas minum, pemberian cairan oralit atau infus bisa dilakukan untuk mencegah dehidrasi.');

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL,
  `kode_gejala` varchar(5) NOT NULL,
  `nama_gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`) VALUES
(1, 'G1', 'Demam'),
(2, 'G2', 'Tubuh Terasa Sakit'),
(3, 'G3', 'Sakit Kepala'),
(4, 'G4', 'Otot Terasa Nyeri'),
(5, 'G5', 'Mual-Mual'),
(6, 'G6', 'Ngilu'),
(7, 'G7', 'Nyeri Pada Persendian');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `b_pengetahuan`
--
ALTER TABLE `b_pengetahuan`
  ADD PRIMARY KEY (`id_b_pengetahuan`),
  ADD KEY `id_penyakit` (`id_diagnosa`),
  ADD KEY `id_gejala` (`id_gejala`);

--
-- Indexes for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`id_diagnosa`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `b_pengetahuan`
--
ALTER TABLE `b_pengetahuan`
  MODIFY `id_b_pengetahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `diagnosa`
--
ALTER TABLE `diagnosa`
  MODIFY `id_diagnosa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `b_pengetahuan`
--
ALTER TABLE `b_pengetahuan`
  ADD CONSTRAINT `b_pengetahuan_ibfk_1` FOREIGN KEY (`id_diagnosa`) REFERENCES `diagnosa` (`id_diagnosa`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `b_pengetahuan_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
