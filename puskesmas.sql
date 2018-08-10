-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2018 at 04:36 AM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `puskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kodebrg` varchar(10) NOT NULL,
  `namabrg` varchar(50) NOT NULL,
  `kodejen` varchar(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `kodesatuan` varchar(10) NOT NULL,
  `tglmsk` date NOT NULL,
  `kodesup` varchar(10) NOT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kodebrg`, `namabrg`, `kodejen`, `jumlah`, `harga`, `kodesatuan`, `tglmsk`, `kodesup`, `foto`) VALUES
('Asal', 'Asal', 'jen009', 5, 1000, 'sat000', '2018-08-11', '-', '38294479_2172939136270996_7714635882166222848_o.jpg'),
('brg001', 'Komix', 'jen000', 50, 30000, 'sat001', '2018-04-02', 'sup001', 'komix.jpg'),
('brg002', 'Super Pell', 'jen004', 45, 10000, 'sat000', '2018-04-02', 'sup004', 'super-pell.jpg'),
('brg003', 'Pulpen', 'jen003', 60, 4000, 'sat000', '2018-04-02', 'sup001', 'pulpen1.jpg'),
('brg004', 'Tabung Oksigen', 'jen002', 5, 1000000, 'sat016', '2018-04-02', 'sup000', 'tabungoksigen.jpg'),
('brg005', 'Buku Tulis', 'jen003', 10, 2000, 'sat000', '2018-04-02', 'sup002', 'buku1.jpg'),
('brg006', 'Sunlight', 'jen004', 40, 5000, 'sat002', '2018-04-02', 'sup003', 'sunlight.jpg'),
('brg007', 'Air Minum', 'jen002', 10, 15000, 'sat012', '2018-04-02', 'sup005', 'aquagalon.jpg'),
('brg008', 'Karet Penghapus', 'jen003', 15, 15000, 'sat001', '2018-04-02', 'sup000', 'penghapus.jpg'),
('brg009', 'Pisau Bedah', 'jen005', 50, 15000, 'sat000', '2018-04-02', 'sup003', 'pisaubedah.jpg'),
('brg010', 'Sapu', 'jen004', 10, 15000, 'sat000', '2018-04-02', 'sup001', 'sapuijuk.jpg'),
('brg011', 'Meja', 'jen009', 5, 30000, 'sat005', '2018-05-02', 'sup004', 'fluidicon.png'),
('brg012', 'Sabun Lifebuoy', 'jen004', 5, 2500, 'sat000', '2018-06-24', '-', 'stegano.png');

-- --------------------------------------------------------

--
-- Table structure for table `brgkeluar`
--

CREATE TABLE `brgkeluar` (
  `kodekeluar` varchar(10) NOT NULL,
  `kodemasuk` varchar(10) NOT NULL,
  `tglkeluar` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ket` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brgkeluar`
--

INSERT INTO `brgkeluar` (`kodekeluar`, `kodemasuk`, `tglkeluar`, `jumlah`, `ket`) VALUES
('klu000', 'msk001', '2018-07-02', 10, 'Digunakan'),
('klu001', 'msk008', '2018-07-02', 4, 'Digunakan'),
('klu002', 'msk004', '2018-07-02', 2, 'Digunakan'),
('klu003', 'msk000', '2018-07-02', 5, 'Digunakan'),
('klu004', 'msk003', '2018-07-02', 5, 'Digunakan'),
('klu005', 'msk010', '2018-07-02', 2, 'Dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `brgmasuk`
--

CREATE TABLE `brgmasuk` (
  `kodemasuk` varchar(10) NOT NULL,
  `tglmasuk` date NOT NULL,
  `kodebrg` varchar(10) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brgmasuk`
--

INSERT INTO `brgmasuk` (`kodemasuk`, `tglmasuk`, `kodebrg`, `jumlah`) VALUES
('Asal', '2018-08-11', 'Asal', 5),
('msk000', '2018-07-01', 'brg005', 5),
('msk001', '2018-07-01', 'brg009', 40),
('msk002', '2018-07-01', 'brg001', 50),
('msk003', '2018-07-01', 'brg003', 35),
('msk004', '2018-07-01', 'brg007', 8),
('msk005', '2018-07-01', 'brg006', 10),
('msk006', '2018-07-01', 'brg004', 5),
('msk007', '2018-07-01', 'brg002', 5),
('msk008', '2018-07-01', 'brg010', 6),
('msk009', '2018-07-01', 'brg008', 5),
('msk010', '2018-07-01', 'brg011', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenisbarang`
--

CREATE TABLE `jenisbarang` (
  `kodejen` varchar(10) NOT NULL,
  `namajen` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenisbarang`
--

INSERT INTO `jenisbarang` (`kodejen`, `namajen`) VALUES
('jen000', 'Obat-Obatan'),
('jen001', 'Alat Bangunan'),
('jen002', 'Perlengkapan Medis'),
('jen003', 'Alat Tulis'),
('jen004', 'Alat Kebersihan'),
('jen005', 'Alat Bedah'),
('jen006', 'Alat Perkakas'),
('jen007', 'Larutan Kimia'),
('jen008', 'Bibit Tanaman'),
('jen009', 'Peralatan Kantor');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `kodesatuan` varchar(10) NOT NULL,
  `namasatuan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`kodesatuan`, `namasatuan`) VALUES
('sat000', 'PCS'),
('sat001', 'BOX'),
('sat002', 'DOS'),
('sat003', 'BKS'),
('sat004', 'BOTOL'),
('sat005', 'BUAH'),
('sat006', 'BIJI'),
('sat007', 'LEMBAR'),
('sat008', 'ROL'),
('sat009', 'KG'),
('sat010', 'LITER'),
('sat011', 'METER'),
('sat012', 'GALON'),
('sat013', 'POTONG'),
('sat014', 'SET'),
('sat015', 'KALENG'),
('sat016', 'TABUNG'),
('sat017', 'BTG'),
('sat018', 'PAK'),
('sat019', 'GULUNG'),
('sat020', 'PASANG'),
('sat021', 'RIM'),
('sat022', 'UNIT'),
('sat023', 'ONS'),
('sat024', 'KARUNG');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kodesup` varchar(10) NOT NULL,
  `namasup` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` int(15) NOT NULL,
  `kontak` varchar(30) NOT NULL,
  `ket` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kodesup`, `namasup`, `alamat`, `telp`, `kontak`, `ket`) VALUES
('-', '-', '-', 0, '-', 'Beli Sendiri'),
('sup000', 'CV Sukar Maju', 'Sleman, Yogyakarta', 1234567890, 'Saya', 'Penyuplai'),
('sup001', 'CV Asal Bikin', 'Semarang', 987654321, 'Entah', 'Asal'),
('sup002', 'PT Karya Palsu', 'Bandung', 1357924680, 'Owner', 'Palsu'),
('sup003', 'PT Tjahaya', 'Lampung', 123455678, 'Tohir', 'Tanpa Keterangan'),
('sup004', 'CV Saksake', 'Batam', 1237894560, 'Abjad', '-'),
('sup005', 'PT Abal-Abal', 'Wakanda', 1029384756, 'TChalla', 'Tanpa Ket.'),
('sup006', 'PT Dewa', 'Asgard', 1122334455, 'Odinson', '-'),
('sup007', 'CV Ceve', 'Cimbabwe', 1249317, 'Qwerty', '-'),
('sup008', 'PT Pete', 'Puvupiland', 1249175, 'Zxcvbn', 'Ini Keterangan'),
('sup009', 'PT Abcde', 'Titan', 1029387, 'Thonaz', 'Ket.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `hakakses` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `pass`, `hakakses`) VALUES
('admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'admin'),
('mimin', '*2E8D8B1942C5057C59CA3151CCC9AA9C5A96990C', 'admin'),
('omar', '*E0741E37C73C61799F15C6D8C13645C7D515EA58', 'user'),
('user', '*D5D9F81F5542DE067FFF5FF7A4CA4BDD322C578F', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kodebrg`),
  ADD KEY `kodesup` (`kodesup`),
  ADD KEY `kodejen` (`kodejen`),
  ADD KEY `kodesatuan` (`kodesatuan`);

--
-- Indexes for table `brgkeluar`
--
ALTER TABLE `brgkeluar`
  ADD PRIMARY KEY (`kodekeluar`),
  ADD KEY `kodemasuk` (`kodemasuk`);

--
-- Indexes for table `brgmasuk`
--
ALTER TABLE `brgmasuk`
  ADD PRIMARY KEY (`kodemasuk`),
  ADD KEY `kodebrg` (`kodebrg`);

--
-- Indexes for table `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`kodejen`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`kodesatuan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kodesup`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`kodesup`) REFERENCES `supplier` (`kodesup`),
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`kodejen`) REFERENCES `jenisbarang` (`kodejen`),
  ADD CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`kodesatuan`) REFERENCES `satuan` (`kodesatuan`);

--
-- Constraints for table `brgkeluar`
--
ALTER TABLE `brgkeluar`
  ADD CONSTRAINT `brgkeluar_ibfk_1` FOREIGN KEY (`kodemasuk`) REFERENCES `brgmasuk` (`kodemasuk`);

--
-- Constraints for table `brgmasuk`
--
ALTER TABLE `brgmasuk`
  ADD CONSTRAINT `brgmasuk_ibfk_1` FOREIGN KEY (`kodebrg`) REFERENCES `barang` (`kodebrg`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
