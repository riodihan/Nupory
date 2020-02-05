-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jan 2020 pada 12.34
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

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
-- Struktur dari tabel `bunga`
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
-- Dumping data untuk tabel `bunga`
--

INSERT INTO `bunga` (`ID_BUNGA`, `ID_KATEGORI`, `NAMA_BUNGA`, `HARGA`, `STOK`, `FOTO_BUNGA`, `VIDEO_BUNGA`, `CARA_PERAWATAN`, `DESKRIPSI`) VALUES
('B001', 'K001', 'krisan spray', 10000, 57, 'bunga 1.jpeg', '-', '-', 'Bunga Krisan adalah sejenis tumbuhan berbunga yang sering ditanam sebagai tanaman hias pekarangan atau bunga petik. Tumbuhan berbunga ini mulai muncul pada zaman Kapur.'),
('B002', 'K004', 'Anggrek Bulan Lokal', 5000, 36, '', '', 'Disiram 10x', 'Anggrek Adalah Bunga'),
('B003', 'K003', 'Mawar Jingga', 25000, 48, '', 'link video.com', 'Disiram tiap pagi dan sore', 'Cantik'),
('B004', 'K002', 'Kaktus Hias Mini', 25000, 100, '', 'link video.com', 'Disiram tiap pagi dan sore', 'Kaktus Adalah Tumbuhan Yang Bisa Menyimpan Air Pada Pohonnya Sendiri.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `ID_DETAIL_TRANSAKSI` int(11) NOT NULL,
  `ID_TRANSAKSI` varchar(4) NOT NULL,
  `ID_STATUS_TRANSAKSI` varchar(4) NOT NULL,
  `ID_BUNGA` varchar(4) NOT NULL,
  `JUMLAH` int(11) DEFAULT NULL,
  `TOTAL_HARGA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`ID_DETAIL_TRANSAKSI`, `ID_TRANSAKSI`, `ID_STATUS_TRANSAKSI`, `ID_BUNGA`, `JUMLAH`, `TOTAL_HARGA`) VALUES
(41, 'T001', '05', 'B001', 10, 100000),
(42, 'T001', '05', 'B001', 10, 100000),
(45, 'T002', '01', 'B001', 10, 100000),
(46, 'T003', '03', 'B001', 2, 20000),
(47, 'T003', '03', 'B003', 2, 50000),
(58, 'T004', '01', 'B001', 2, 20000),
(59, 'T002', '01', 'B002', 1, 5000);

--
-- Trigger `detail_transaksi`
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
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `ID_KATEGORI` varchar(4) NOT NULL,
  `NAMA_KATEGORI` varchar(20) DEFAULT NULL,
  `DESKRIPSI` text,
  `GAMBAR_KATEGORI` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`, `DESKRIPSI`, `GAMBAR_KATEGORI`) VALUES
('K001', 'Krisan', '-', 'anggrek bulan.jpg'),
('K002', 'Kaktus', 'Kaktus Adalah Tumbuhan Yang Dapat Menyimoan Air Pada Pohonnya', ''),
('K003', 'Mawar', 'Mawar adalah bunga yang cantik tapi berduri', ''),
('K004', 'Anggrek', 'Anggrek adalah salah satu katori dari bunga hias', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kritik`
--

CREATE TABLE `kritik` (
  `ID_KRITIK` varchar(4) NOT NULL,
  `USERNAME` varchar(15) NOT NULL,
  `ID_STATUS_KRITIK` int(11) NOT NULL,
  `ISI_KRITIK` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `ID_PEMBAYARAN` varchar(4) NOT NULL,
  `JENIS_PEMBAYARAN` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`ID_PEMBAYARAN`, `JENIS_PEMBAYARAN`) VALUES
('01', 'transfer'),
('02', 'ambil di tempat'),
('03', 'null');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `ID_STATUS` varchar(4) NOT NULL,
  `NAMA_STATUS` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`ID_STATUS`, `NAMA_STATUS`) VALUES
('01', 'ADMIN'),
('02', 'KARYAWAN'),
('03', 'USER');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_kritik`
--

CREATE TABLE `status_kritik` (
  `ID_STATUS_KRITIK` int(11) NOT NULL,
  `STATUS_KRITIK` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_kritik`
--

INSERT INTO `status_kritik` (`ID_STATUS_KRITIK`, `STATUS_KRITIK`) VALUES
(1, 'Belum Dibaca'),
(2, 'Sudah Dibaca');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_transaksi`
--

CREATE TABLE `status_transaksi` (
  `ID_STATUS_TRANSAKSI` varchar(4) NOT NULL,
  `STATUS_TRANSAKSI` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `status_transaksi`
--

INSERT INTO `status_transaksi` (`ID_STATUS_TRANSAKSI`, `STATUS_TRANSAKSI`) VALUES
('01', 'keranjang'),
('02', 'tagihan'),
('03', 'dikemas'),
('04', 'dikirim'),
('05', 'diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tranfer`
--

CREATE TABLE `tranfer` (
  `ID_TRANSAKSI` varchar(4) NOT NULL,
  `NAMA_BANK` varchar(15) DEFAULT NULL,
  `STATUS_TRANSFER` varchar(20) DEFAULT NULL,
  `BUKTI_PEMBAYARAN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
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
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`ID_TRANSAKSI`, `ID_PEMBAYARAN`, `ID_STATUS_TRANSAKSI`, `USERNAME`, `TGL_TRANSAKSI`, `DETAIL_ALAMAT`, `TOTAL_AKHIR`, `BUKTI_PEMBAYARAN`) VALUES
('T001', '03', '05', 'idris', '2020-01-15', '', 200000, ''),
('T002', '03', '01', 'idris', '2020-01-15', '', 105000, ''),
('T003', '01', '03', 'adit', '2020-01-15', 'Probolinggo', 70000, ''),
('T004', '01', '01', 'adit', '2020-01-15', 'Probolinggo\r\n', 20000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`USERNAME`, `ID_STATUS`, `NAMA_USER`, `ALAMAT`, `NO_TELEPON`, `EMAIL`, `PASSWORD`, `FOTO_USER`) VALUES
('adit', '03', 'adit', 'probolinggo', '09876666', '10tkj2hendry.madritista@gmail.com', 'adit', ''),
('idris', '03', 'idris', 'probolinggo', '085257461375', 'hendrytifa@gmail.com', 'idris', ''),
('indah', '01', 'Indah', 'jember', '08232328888', 'pdimas1711@gmail.com', 'indah', NULL),
('sayid', '02', 'Sayyid', 'Probolinggo', '085746155112', 'sayyid@gmail.com', 'sayid', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bunga`
--
ALTER TABLE `bunga`
  ADD PRIMARY KEY (`ID_BUNGA`),
  ADD KEY `FK_MEMILIKI1` (`ID_KATEGORI`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`ID_DETAIL_TRANSAKSI`),
  ADD KEY `FK_MEMILIKI3` (`ID_TRANSAKSI`),
  ADD KEY `FK_MEMILIKI4` (`ID_BUNGA`),
  ADD KEY `MEMILIKI11` (`ID_STATUS_TRANSAKSI`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`ID_KATEGORI`);

--
-- Indeks untuk tabel `kritik`
--
ALTER TABLE `kritik`
  ADD PRIMARY KEY (`ID_KRITIK`),
  ADD KEY `FK_MENGKRITIK` (`USERNAME`),
  ADD KEY `MEMILIKI20` (`ID_STATUS_KRITIK`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_PEMBAYARAN`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID_STATUS`);

--
-- Indeks untuk tabel `status_kritik`
--
ALTER TABLE `status_kritik`
  ADD PRIMARY KEY (`ID_STATUS_KRITIK`);

--
-- Indeks untuk tabel `status_transaksi`
--
ALTER TABLE `status_transaksi`
  ADD PRIMARY KEY (`ID_STATUS_TRANSAKSI`);

--
-- Indeks untuk tabel `tranfer`
--
ALTER TABLE `tranfer`
  ADD KEY `FK_MENTRANFER` (`ID_TRANSAKSI`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_TRANSAKSI`),
  ADD KEY `FK_MEMBAYAR` (`ID_PEMBAYARAN`),
  ADD KEY `FK_MEMILIKI2` (`ID_STATUS_TRANSAKSI`),
  ADD KEY `FK_MEMPUNYAI` (`USERNAME`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USERNAME`),
  ADD KEY `FK_MEMILIKI` (`ID_STATUS`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `ID_DETAIL_TRANSAKSI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `status_kritik`
--
ALTER TABLE `status_kritik`
  MODIFY `ID_STATUS_KRITIK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bunga`
--
ALTER TABLE `bunga`
  ADD CONSTRAINT `FK_MEMILIKI1` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `kategori` (`ID_KATEGORI`);

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `FK_MEMILIKI3` FOREIGN KEY (`ID_TRANSAKSI`) REFERENCES `transaksi` (`ID_TRANSAKSI`),
  ADD CONSTRAINT `FK_MEMILIKI4` FOREIGN KEY (`ID_BUNGA`) REFERENCES `bunga` (`ID_BUNGA`),
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`ID_STATUS_TRANSAKSI`) REFERENCES `status_transaksi` (`ID_STATUS_TRANSAKSI`);

--
-- Ketidakleluasaan untuk tabel `kritik`
--
ALTER TABLE `kritik`
  ADD CONSTRAINT `FK_MENGKRITIK` FOREIGN KEY (`USERNAME`) REFERENCES `user` (`USERNAME`),
  ADD CONSTRAINT `kritik_ibfk_1` FOREIGN KEY (`ID_STATUS_KRITIK`) REFERENCES `status_kritik` (`ID_STATUS_KRITIK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tranfer`
--
ALTER TABLE `tranfer`
  ADD CONSTRAINT `FK_MENTRANFER` FOREIGN KEY (`ID_TRANSAKSI`) REFERENCES `transaksi` (`ID_TRANSAKSI`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_MEMBAYAR` FOREIGN KEY (`ID_PEMBAYARAN`) REFERENCES `pembayaran` (`ID_PEMBAYARAN`),
  ADD CONSTRAINT `FK_MEMILIKI2` FOREIGN KEY (`ID_STATUS_TRANSAKSI`) REFERENCES `status_transaksi` (`ID_STATUS_TRANSAKSI`),
  ADD CONSTRAINT `FK_MEMPUNYAI` FOREIGN KEY (`USERNAME`) REFERENCES `user` (`USERNAME`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_MEMILIKI` FOREIGN KEY (`ID_STATUS`) REFERENCES `status` (`ID_STATUS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
