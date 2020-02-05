-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2020 at 09:58 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poltek_nursery`
--

-- --------------------------------------------------------

--
-- Table structure for table `bunga`
--

CREATE TABLE `bunga` (
  `ID_BUNGA` varchar(4) NOT NULL,
  `ID_KATEGORI` varchar(4) NOT NULL,
  `NAMA_BUNGA` varchar(30) DEFAULT NULL,
  `HARGA` int(11) DEFAULT NULL,
  `STOK` int(11) DEFAULT NULL,
  `FOTO_BUNGA` varchar(20) DEFAULT NULL,
  `VIDEO_BUNGA` varchar(50) DEFAULT NULL,
  `CARA_PERAWATAN` varchar(500) DEFAULT NULL,
  `DESKRIPSI` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bunga`
--

INSERT INTO `bunga` (`ID_BUNGA`, `ID_KATEGORI`, `NAMA_BUNGA`, `HARGA`, `STOK`, `FOTO_BUNGA`, `VIDEO_BUNGA`, `CARA_PERAWATAN`, `DESKRIPSI`) VALUES
('B001', 'K001', 'krisan spray', 10000, 57, '5e3a67bb8b7fb.jpg', 'https://www.youtube.com/watch?v=4bfUx2xMpwc', '1. Pilih tanaman yang sehat. 2. Pindahkan bunga krisan ke pot yang baru. 3. Sirami bunga krisan secukupnya tetapi jangan sampai airnya menggenang.4. Jauhkan bunga krisan dari lampu jalan atau cahaya buatan di malam hari. 5. Berikan pupuk beberapa kali dalam setahun.', 'Bunga Krisan adalah sejenis tumbuhan berbunga yang sering ditanam sebagai tanaman hias pekarangan atau bunga petik. Tumbuhan berbunga ini mulai muncul pada zaman Kapur.'),
('B002', 'K004', 'Anggrek Bulan Lokal', 130000, 36, '5e3a6296aa8d2.jpg', 'https://www.youtube.com/watch?v=d2noVcc2ffI', 'Disiram 2 klai sehari, pagi dan sore', 'Anggrek adalah tumbuhan yang banyak ditemukan di Indonesia. Iklim tropis Indonesia memang cocok untuk menjadi tempat tumbuh bagi anggrek. Bagian daun dan batangnya yang tebal dan berdaging menyimpan cukup banyak air untuk dapat bertahan hidup'),
('B003', 'K003', 'Mawar Jingga', 25000, 48, '5e3a6585dbabd.jpg', 'link video.com', 'Disiram tiap pagi dan sore', 'Mawar Adalah tanaman yang memiliki duri.'),
('B004', 'K002', 'Kaktus Hias Mini', 25000, 100, '5e3a60d52c412.jpg', 'https://www.youtube.com/watch?v=f-n1BNx5AIo', 'Disiram secukupnnya', 'Kaktus Adalah Tumbuhan Yang Bisa Menyimpan Air Pada Pohonnya Sendiri.'),
('B005', 'K005', 'melati putih', 10000, 20, '5e3a681304a23.jpg', 'https://www.youtube.com/watch?v=5ggDhXk_yMw', 'siram bunga 2 kali sehari, pagi dan sore.', 'melatih putih merupakan bunga yang dapat dibuat minuman'),
('B006', 'K001', 'Krisan Standart', 15000, 7000, '5e3a5fb1a0398.jpg', 'https://www.youtube.com/watch?v=ezxjZQvH6f0', '1. Pilih tanaman yang sehat.  2. Pindahkan bunga krisan ke pot yang baru.  3. Sirami bunga krisan secukupnya tetapi jangan sampai airnya menggenang. 4. Jauhkan bunga krisan dari lampu jalan atau cahaya buatan di malam hari.  5. Berikan pupuk beberapa kali dalam setahun.', 'Bunga Krisan adalah sejenis tumbuhan berbunga yang sering ditanam sebagai tanaman hias pekarangan atau bunga petik. Tumbuhan berbunga ini mulai muncul pada zaman Kapur.'),
('B007', 'K004', 'Anggrek Bulan Taiwan', 150000, 60, '5e3a627512e6c.png', 'https://www.youtube.com/watch?v=J0LxcFs1nVM', 'siram bunga 2 kali sehari, pagi dan sore.', 'Anggrek adalah tumbuhan yang banyak ditemukan di Indonesia. Iklim tropis Indonesia memang cocok untuk menjadi tempat tumbuh bagi anggrek. Bagian daun dan batangnya yang tebal dan berdaging menyimpan cukup banyak air untuk dapat bertahan hidup'),
('B008', 'K004', 'Anggrek Cattlea', 120000, 68, '5e3a634c18bf3.jpg', 'https://www.youtube.com/watch?v=n2CRlrmwKt8', 'siram bunga 2 kali sehari, pagi dan sore.', 'Anggrek adalah tumbuhan yang banyak ditemukan di Indonesia. Iklim tropis Indonesia memang cocok untuk menjadi tempat tumbuh bagi anggrek. Bagian daun dan batangnya yang tebal dan berdaging menyimpan cukup banyak air untuk dapat bertahan hidup'),
('B009', 'K006', 'Agloenema', 46000, 50, '5e3a6508c37c8.png', 'https://www.youtube.com/watch?v=sWxQ5VilB5U', 'Penyiramanbisa dilakukansatu hari sekali dengan takaran air yang disesuaikan dengan kelembaban media tanam itu sendiri. Ingat, aglaonema ialah tanaman yang menyenangi area tidak kering namun tak terlalu basah. Jangan memakai air kaporit pada dalam merawat dan menyiram tanaman Aglaonema.', 'tanaman hias populer dari suku talas-talasan atau Araceae. Genus Aglaonema memiliki sekitar 30 spesies. Habitat asli tanaman ini adalah di bawah hutan hujan tropis, tumbuh baik pada areal dengan intensitas penyinaran rendah dan kelembaban tinggi.'),
('B010', 'K006', 'Begonia', 25000, 35, '5e3a664188cee.jpg', 'https://www.youtube.com/watch?v=jjpsRDK2YIY', 'siram bunga 2 kali sehari, pagi dan sore.', 'Begonia adalah genus dalam keluarga tanaman berbunga Begoniaceae. Satu-satunya anggota keluarga lainnya Begoniaceae adalah Hillebrandia, genus dengan spesies tunggal di Kepulauan Hawaii, dan genus Symbegonia yang baru-baru ini termasuk dalam Begonia');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `ID_DETAIL_TRANSAKSI` int(11) NOT NULL,
  `ID_TRANSAKSI` varchar(4) NOT NULL,
  `ID_BUNGA` varchar(4) NOT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `TOTAL_HARGA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`ID_DETAIL_TRANSAKSI`, `ID_TRANSAKSI`, `ID_BUNGA`, `JUMLAH`, `TOTAL_HARGA`) VALUES
(41, 'T001', 'B001', 10, 100000),
(42, 'T001', 'B001', 10, 100000),
(45, 'T002', 'B001', 10, 100000),
(46, 'T003', 'B001', 2, 20000),
(47, 'T003', 'B003', 2, 50000),
(58, 'T004', 'B001', 2, 20000),
(59, 'T002', 'B002', 1, 5000),
(60, 'T002', 'B001', 4, 40000),
(61, 'T006', 'B001', 10, 100000);

--
-- Triggers `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `Kurang_Total_Akhir` BEFORE DELETE ON `detail_transaksi` FOR EACH ROW BEGIN
	UPDATE transaksi
    SET TOTAL_AKHIR = TOTAL_AKHIR - OLD.TOTAL_HARGA
    WHERE ID_TRANSAKSI = OLD.ID_TRANSAKSI;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Tambah_Total_Akhir` AFTER INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
	UPDATE transaksi
    SET TOTAL_AKHIR = TOTAL_AKHIR + NEW.TOTAL_HARGA
    WHERE ID_TRANSAKSI = NEW.ID_TRANSAKSI;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurang_stok_bunga` AFTER UPDATE ON `detail_transaksi` FOR EACH ROW BEGIN
	UPDATE bunga
    SET STOK = STOK - NEW.JUMLAH
    WHERE ID_STATUS_TRANSAKSI = '03' AND
    bunga.ID_BUNGA = NEW.ID_BUNGA;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `ID_KATEGORI` varchar(4) NOT NULL,
  `NAMA_KATEGORI` varchar(20) DEFAULT NULL,
  `DESKRIPSI` text,
  `GAMBAR_KATEGORI` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`, `DESKRIPSI`, `GAMBAR_KATEGORI`) VALUES
('K001', 'Krisan', 'Bunga Krisan adalah sejenis tumbuhan berbunga yang sering ditanam sebagai tanaman hias pekarangan atau bunga petik. Tumbuhan berbunga ini mulai muncul pada zaman Kapur.', '4.jpg'),
('K002', 'Kaktus', 'Kaktus Adalah Tumbuhan Yang Dapat Menyimoan Air Pada Pohonnya', 'Kaktus-Hias-Fairy-Castle.jpg'),
('K003', 'Mawar', 'Mawar adalah bunga yang cantik tapi berduri', 'a118742e147d186a5e6d091dc3d2ff'),
('K004', 'Anggrek', 'Anggrek adalah salah satu katrgori dari bunga hias', 'anggrek bulan.jpg'),
('K005', 'Melati', 'Bunga yang dapat dijadikan sebagai bahan teh', 'melati.jpg'),
('K006', 'Bunga Daun', 'tanaman hias daun adalah tanaman yang keindahannya berada dibagian daunnya', '5e3a63fccdf59.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kritik`
--

CREATE TABLE `kritik` (
  `ID_KRITIK` varchar(4) NOT NULL,
  `USERNAME` varchar(15) NOT NULL,
  `ID_STATUS_KRITIK` int(11) NOT NULL,
  `ISI_KRITIK` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kritik`
--

INSERT INTO `kritik` (`ID_KRITIK`, `USERNAME`, `ID_STATUS_KRITIK`, `ISI_KRITIK`) VALUES
('KR01', 'adit', 2, 'pelayanannya sangat bagus dan cepat.'),
('KR02', 'idris', 1, 'pengirimannya cepat dan sesuai pesanan');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `ID_PEMBAYARAN` varchar(4) NOT NULL,
  `JENIS_PEMBAYARAN` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`ID_PEMBAYARAN`, `JENIS_PEMBAYARAN`) VALUES
('01', 'transfer'),
('02', 'ambil di tempat'),
('03', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `ID_STATUS` varchar(4) NOT NULL,
  `NAMA_STATUS` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`ID_STATUS`, `NAMA_STATUS`) VALUES
('01', 'ADMIN'),
('02', 'KARYAWAN'),
('03', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `status_kritik`
--

CREATE TABLE `status_kritik` (
  `ID_STATUS_KRITIK` int(11) NOT NULL,
  `STATUS_KRITIK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_kritik`
--

INSERT INTO `status_kritik` (`ID_STATUS_KRITIK`, `STATUS_KRITIK`) VALUES
(1, 'Belum Dibaca'),
(2, 'Sudah Dibaca');

-- --------------------------------------------------------

--
-- Table structure for table `status_transaksi`
--

CREATE TABLE `status_transaksi` (
  `ID_STATUS_TRANSAKSI` varchar(4) NOT NULL,
  `STATUS_TRANSAKSI` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_transaksi`
--

INSERT INTO `status_transaksi` (`ID_STATUS_TRANSAKSI`, `STATUS_TRANSAKSI`) VALUES
('01', 'keranjang'),
('02', 'tagihan'),
('03', 'dikemas'),
('04', 'dikirim'),
('05', 'diterima');

-- --------------------------------------------------------

--
-- Table structure for table `tranfer`
--

CREATE TABLE `tranfer` (
  `ID_TRANSAKSI` varchar(4) NOT NULL,
  `NAMA_BANK` varchar(15) DEFAULT NULL,
  `STATUS_TRANSFER` varchar(20) DEFAULT NULL,
  `BUKTI_PEMBAYARAN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_TRANSAKSI` varchar(4) NOT NULL,
  `ID_PEMBAYARAN` varchar(4) NOT NULL,
  `ID_STATUS_TRANSAKSI` varchar(4) NOT NULL,
  `USERNAME` varchar(15) NOT NULL,
  `TGL_TRANSAKSI` date DEFAULT NULL,
  `DETAIL_ALAMAT` varchar(100) DEFAULT NULL,
  `TOTAL_AKHIR` int(11) DEFAULT NULL,
  `BUKTI_PEMBAYARAN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`ID_TRANSAKSI`, `ID_PEMBAYARAN`, `ID_STATUS_TRANSAKSI`, `USERNAME`, `TGL_TRANSAKSI`, `DETAIL_ALAMAT`, `TOTAL_AKHIR`, `BUKTI_PEMBAYARAN`) VALUES
('T001', '03', '05', 'idris', '2020-01-15', '', 200000, ''),
('T002', '01', '02', 'idris', '2020-01-15', 'Tawang Alun', 145000, 'IMG_0833 (FILEminimizer).JPG'),
('T003', '01', '04', 'adit', '2020-01-15', 'Probolinggo', 70000, ''),
('T004', '01', '02', 'adit', '2020-02-01', 'Jember', 20000, '5e363742d21ec.jpg'),
('T005', '03', '01', 'idris', '2020-01-15', '', 0, ''),
('T006', '01', '04', 'adit', '2020-02-02', 'Jember', 100000, '5e37bf5ab6b55.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `USERNAME` varchar(15) NOT NULL,
  `ID_STATUS` varchar(4) NOT NULL,
  `NAMA_USER` varchar(25) DEFAULT NULL,
  `ALAMAT` varchar(30) DEFAULT NULL,
  `NO_TELEPON` varchar(13) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(15) DEFAULT NULL,
  `FOTO_USER` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USERNAME`, `ID_STATUS`, `NAMA_USER`, `ALAMAT`, `NO_TELEPON`, `EMAIL`, `PASSWORD`, `FOTO_USER`) VALUES
('adit', '03', 'adit', 'probolinggo', '085335490201', '10tkj2hendry.madritista@gmail.com', 'adit1', '5e3a7dcba6caf.jpg'),
('Fansoni', '02', 'Fansoni', 'Probolinggo', '085746155112', 'sayyid@gmail.com', 'fansoni', '5e3a427eec181.png'),
('idris', '03', 'idris', 'probolinggo', '085257461375', 'hendrytifa@gmail.com', 'idris', '5e3a799112b51.jpg'),
('ridho', '03', 'ridho', 'Jember', '082384888993', 'rihdoan@gmail.com', 'ridho', '5e3a7a1a608d0.jpeg'),
('sayyid', '03', 'sayyid', 'probolinggo', '082335539827', 'idulidul36@gmail.com', 'sayyid', '5e3a785e07ef0.jpeg'),
('syifa', '03', 'syifa', 'Madura', '085349932222', 'syifausr8@gmail.com', 'syifa', '5e3a7ab7ddd2e.jpeg'),
('Ujang', '01', 'Ujang', 'Jember', '08532388888', 'sayyidmusthofa89@gmail.com', 'ujang', '5e3a7f69c2895.jpg'),
('yuli', '02', 'Yuli', 'Balung', '085898989555', 'yuliath9@gmail.com', 'yuli', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bunga`
--
ALTER TABLE `bunga`
  ADD PRIMARY KEY (`ID_BUNGA`),
  ADD KEY `FK_MEMILIKI1` (`ID_KATEGORI`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`ID_DETAIL_TRANSAKSI`),
  ADD KEY `FK_MEMILIKI3` (`ID_TRANSAKSI`),
  ADD KEY `FK_MEMILIKI4` (`ID_BUNGA`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID_KATEGORI`);

--
-- Indexes for table `kritik`
--
ALTER TABLE `kritik`
  ADD PRIMARY KEY (`ID_KRITIK`),
  ADD KEY `FK_MENGKRITIK` (`USERNAME`),
  ADD KEY `MEMILIKI20` (`ID_STATUS_KRITIK`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_PEMBAYARAN`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID_STATUS`);

--
-- Indexes for table `status_kritik`
--
ALTER TABLE `status_kritik`
  ADD PRIMARY KEY (`ID_STATUS_KRITIK`);

--
-- Indexes for table `status_transaksi`
--
ALTER TABLE `status_transaksi`
  ADD PRIMARY KEY (`ID_STATUS_TRANSAKSI`);

--
-- Indexes for table `tranfer`
--
ALTER TABLE `tranfer`
  ADD KEY `FK_MENTRANFER` (`ID_TRANSAKSI`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_TRANSAKSI`),
  ADD KEY `FK_MEMBAYAR` (`ID_PEMBAYARAN`),
  ADD KEY `FK_MEMILIKI2` (`ID_STATUS_TRANSAKSI`),
  ADD KEY `FK_MEMPUNYAI` (`USERNAME`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USERNAME`),
  ADD KEY `FK_MEMILIKI` (`ID_STATUS`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `ID_DETAIL_TRANSAKSI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `status_kritik`
--
ALTER TABLE `status_kritik`
  MODIFY `ID_STATUS_KRITIK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bunga`
--
ALTER TABLE `bunga`
  ADD CONSTRAINT `FK_MEMILIKI1` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `kategori` (`ID_KATEGORI`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `FK_MEMILIKI3` FOREIGN KEY (`ID_TRANSAKSI`) REFERENCES `transaksi` (`ID_TRANSAKSI`),
  ADD CONSTRAINT `FK_MEMILIKI4` FOREIGN KEY (`ID_BUNGA`) REFERENCES `bunga` (`ID_BUNGA`);

--
-- Constraints for table `kritik`
--
ALTER TABLE `kritik`
  ADD CONSTRAINT `FK_MENGKRITIK` FOREIGN KEY (`USERNAME`) REFERENCES `user` (`USERNAME`),
  ADD CONSTRAINT `kritik_ibfk_1` FOREIGN KEY (`ID_STATUS_KRITIK`) REFERENCES `status_kritik` (`ID_STATUS_KRITIK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tranfer`
--
ALTER TABLE `tranfer`
  ADD CONSTRAINT `FK_MENTRANFER` FOREIGN KEY (`ID_TRANSAKSI`) REFERENCES `transaksi` (`ID_TRANSAKSI`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_MEMBAYAR` FOREIGN KEY (`ID_PEMBAYARAN`) REFERENCES `pembayaran` (`ID_PEMBAYARAN`),
  ADD CONSTRAINT `FK_MEMILIKI2` FOREIGN KEY (`ID_STATUS_TRANSAKSI`) REFERENCES `status_transaksi` (`ID_STATUS_TRANSAKSI`),
  ADD CONSTRAINT `FK_MEMPUNYAI` FOREIGN KEY (`USERNAME`) REFERENCES `user` (`USERNAME`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_STATUS`) REFERENCES `status` (`ID_STATUS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
