-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2016 at 09:32 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `infinite-apparel`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `url` text NOT NULL,
  `series_id` varchar(6) NOT NULL,
  `harga` int(10) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah_gambar` int(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `url`, `series_id`, `harga`, `keterangan`, `jumlah_gambar`) VALUES
('INFT0001', 'Revival Now', 'revival-now', 'SRS001', 125000, 'KIS 2', 1),
('INFT0002', 'I''m Ready Rev', 'im-ready-rev', 'SRS001', 100000, 'KIS 2', 2),
('INFT0003', 'History Makers', 'history-makers', 'SRS001', 100000, 'KIS 2', 1),
('INFT0004', 'Gold Cross', 'gold-cross', 'SRS002', 125000, '1 PETER 2:24', 1),
('INFT0005', 'Silver Cross', 'silver-cross', 'SRS002', 125000, '1 PETER 2:24', 1),
('INFT0006', 'Black Cross', 'black-cross', 'SRS002', 125000, '1 PETER 2:24', 2),
('INFT0007', 'White Cross', 'white-cross', 'SRS002', 125000, '1 PETER 2:24', 2),
('INFT0008', 'Horizoline Cross', 'horizoline-cross', 'SRS002', 125000, '1 PETER 2:24', 2),
('INFT0009', 'Immanuel White', 'immanuel-white', 'SRS003', 140000, 'MATT 3:21', 1),
('INFT0010', 'Immanuel Black', 'immanuel-black', 'SRS003', 140000, 'MATT 3:21', 1),
('INFT0011', 'God With Us White', 'god-with-us-white', 'SRS003', 125000, 'MATT 3:21', 1),
('INFT0012', 'God With Us Black', 'god-with-us-black', 'SRS003', 125000, 'MATT 3:21', 1),
('INFT0013', 'Hoody Jumper Immanuel', 'hoody-jumper-immanuel', 'SRS003', 240000, 'MAT 3:21', 1),
('INFT0014', '180 Degree', '180-degree', 'SRS004', 100000, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `blogpost`
--

CREATE TABLE `blogpost` (
  `id` varchar(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jumlah_gambar` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `custom_detail`
--

CREATE TABLE `custom_detail` (
  `id` varchar(10) NOT NULL,
  `user` varchar(20) NOT NULL,
  `kaos_id` varchar(6) NOT NULL,
  `design_id` varchar(6) NOT NULL,
  `harga` int(8) NOT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_detail`
--

INSERT INTO `custom_detail` (`id`, `user`, `kaos_id`, `design_id`, `harga`, `message`) VALUES
('C135575512', 'asdasd', 'KAOS15', 'CSD006', 0, NULL),
('C185476548', 'asdasd', 'KAOS19', 'CSD005', 0, NULL),
('C337587630', 'asdasd', 'KAOS14', 'CSD006', 0, NULL),
('C674750735', 'asdasd', 'KAOS01', 'CSD001', 0, NULL),
('C758894833', 'asdasd', 'KAOS02', 'CSD011', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dcart`
--

CREATE TABLE `dcart` (
  `id` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `nama` text NOT NULL,
  `size` varchar(3) NOT NULL,
  `harga` int(8) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `subtotal` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dcart`
--

INSERT INTO `dcart` (`id`, `username`, `id_barang`, `nama`, `size`, `harga`, `jumlah`, `subtotal`) VALUES
('2703310861', 'asdasd', 'INFT0011', 'God With Us White', 'm', 125000, 1, 125000),
('8749592662', 'asdasd', 'INFT0012', 'God With Us Black', 'm', 125000, 1, 125000),
('9905667212', 'asdasd', 'INFT0013', 'Hoody Jumper Immanuel', 'm', 240000, 1, 240000);

-- --------------------------------------------------------

--
-- Table structure for table `design`
--

CREATE TABLE `design` (
  `id` varchar(6) NOT NULL,
  `nama_id` varchar(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `warna_hex` varchar(6) NOT NULL,
  `harga` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `design`
--

INSERT INTO `design` (`id`, `nama_id`, `nama`, `warna`, `warna_hex`, `harga`) VALUES
('CSD001', 'DES001', 'Cross', 'Black', '000000', 0),
('CSD002', 'DES001', 'Cross', 'Gold', 'bb9b38', 0),
('CSD003', 'DES001', 'Cross', 'Red', 'da2d22', 0),
('CSD004', 'DES001', 'Cross', 'Silver', 'cecece', 0),
('CSD005', 'DES001', 'Cross', 'White', 'ffffff', 0),
('CSD006', 'DES002', 'Horizoline Cross', 'Black', '000000', 0),
('CSD007', 'DES002', 'Horizoline Cross', 'Gold', 'bb9b38', 0),
('CSD008', 'DES002', 'Horizoline Cross', 'Red', 'da2d22', 0),
('CSD009', 'DES002', 'Horizoline Cross', 'Silver', 'cecece', 0),
('CSD010', 'DES002', 'Horizoline Cross', 'White', 'ffffff', 0),
('CSD011', 'DES003', 'Revival Now!', 'Black', '000000', 0),
('CSD012', 'DES003', 'Revival Now!', 'White', 'ffffff', 0),
('CSD013', 'DES003', 'Revival Now!', 'Gold', 'bb9b38', 0),
('CSD014', 'DES004', 'I''m Redeemed', 'Silver', '8c8c8f', 0),
('CSD015', 'DES004', 'I''m Redeemed', 'Gold', 'bb9b38', 0),
('CSD016', 'DES004', 'I''m Redeemed', 'Black', '000000', 0),
('CSD017', 'DES004', 'I''m Redeemed', 'White', 'ffffff', 0),
('CSD018', 'DES005', 'IRF Revival', 'White', 'ffffff', 0),
('CSD019', 'DES005', 'IRF Revival', 'Red', 'da2d22', 0),
('CSD020', 'DES005', 'IRF Revival', 'Black', '000000', 0),
('CSD021', 'DES005', 'IRF Revival', 'Gold', 'bb9b38', 0),
('CSD022', 'DES006', 'History Makers', 'White', 'ffffff', 0),
('CSD023', 'DES006', 'History Makers', 'Black', '000000', 0),
('CSD024', 'DES006', 'History Makers', 'Gold', 'bb9b38', 0),
('CSD025', 'DES006', 'History Makers', 'Red', 'da2d22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `djual`
--

CREATE TABLE `djual` (
  `id` varchar(10) NOT NULL,
  `id_pemesanan` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga` int(8) NOT NULL,
  `size` varchar(3) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `subtotal` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dpemesanan`
--

CREATE TABLE `dpemesanan` (
  `id` varchar(10) NOT NULL,
  `id_pemesanan` varchar(10) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga` int(8) DEFAULT NULL,
  `size` varchar(3) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `subtotal` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hcart`
--

CREATE TABLE `hcart` (
  `username` varchar(20) NOT NULL,
  `total` bigint(10) NOT NULL,
  `total_qty` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hcart`
--

INSERT INTO `hcart` (`username`, `total`, `total_qty`) VALUES
('asd', 0, 0),
('asdasd', 490000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hjual`
--

CREATE TABLE `hjual` (
  `id_pemesanan` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `shipping_cost` int(7) DEFAULT '0',
  `total` bigint(11) NOT NULL,
  `tanggal_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hpemesanan`
--

CREATE TABLE `hpemesanan` (
  `id_pemesanan` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `first_name` text,
  `last_name` text,
  `kota_id` varchar(6) NOT NULL,
  `alamat` text NOT NULL,
  `hp` varchar(15) NOT NULL,
  `shipping_cost` int(7) NOT NULL DEFAULT '0',
  `total` bigint(10) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'waiting payment',
  `nomor_resi` varchar(20) DEFAULT NULL,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kaos`
--

CREATE TABLE `kaos` (
  `id` varchar(6) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `warna_hex` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kaos`
--

INSERT INTO `kaos` (`id`, `warna`, `warna_hex`) VALUES
('KAOS01', 'Black', '000000'),
('KAOS02', 'White', 'E7EAF3'),
('KAOS03', 'Red', 'd9161c'),
('KAOS04', 'Grey', '828280'),
('KAOS05', 'Ocean Blue', '2b3155');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id` varchar(6) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `nama`) VALUES
('KO001', 'ABU DHABI, DUBAI, SHARJAH'),
('KO002', 'ACCRA, GHANA KOTOKA'),
('KO003', 'ADDIS ABABA, ETHIOPIA'),
('KO004', 'ALGERIA, ALL CITY'),
('KO005', 'ALMATY, KAZAKHSTAN'),
('KO006', 'AMBON'),
('KO007', 'AMERICAN SAMOA'),
('KO008', 'AMMAN, JORDAN'),
('KO009', 'AMSTERDAM, NETHERLANDS'),
('KO010', 'ANDORRA'),
('KO011', 'ANGOLA'),
('KO012', 'ANGUILA, ALL CITY, CARIBBEAN'),
('KO013', 'ANTIGUA, ALL CITY, CARIBBEAN'),
('KO014', 'ARUBA, ALL CITY, CARIBBEAN'),
('KO015', 'ASMARA, ERITREA ASMARA INT''L'),
('KO016', 'ASUNCION, PARAGUAY'),
('KO017', 'ATHENS, GREECE'),
('KO018', 'AUCKLAND, NEW ZEALAND'),
('KO019', 'BAGHDAD, IRAQ'),
('KO020', 'BAHRAIN, ALL CITY'),
('KO021', 'BAKU, AZERBAIJAN'),
('KO022', 'BALIKPAPAN'),
('KO023', 'BANDAACEH'),
('KO024', 'BANDARLAMPUNG'),
('KO025', 'BANDUNG'),
('KO026', 'BANGUI, CENTRAL AFRICAN REP.'),
('KO027', 'BANJARMASIN'),
('KO028', 'BANJUL, GAMBIA'),
('KO029', 'BATAM'),
('KO030', 'BEIJING, CHINA'),
('KO031', 'BEIRUT, LEBANON'),
('KO032', 'BEKASI'),
('KO033', 'BELIZE'),
('KO034', 'BENGKULU'),
('KO035', 'BEOGRAD, YUGOSLAVIA'),
('KO036', 'BERMUDA, HAMILTON, ATLANTIC'),
('KO037', 'BOGOR'),
('KO038', 'BOGOTA, COLOMBIA'),
('KO039', 'BONARIE'),
('KO040', 'BONTANG'),
('KO041', 'BRIDGE TOWN, BARBADOS'),
('KO042', 'BURKINA FASO'),
('KO043', 'CAIRO, EGYPT'),
('KO044', 'CAMEROON'),
('KO045', 'CANADA, TORONTO'),
('KO046', 'CAYANNE, FRENCH GUIANA'),
('KO047', 'CAYMAN ISLANDS, CARIBBEAN'),
('KO048', 'CILACAP'),
('KO049', 'CILEGON'),
('KO050', 'CIREBON'),
('KO051', 'COLOMBO, SRILANGKA'),
('KO052', 'CONGO'),
('KO053', 'COPENHAGEN, DENMARK'),
('KO054', 'COTONOU, BENIN'),
('KO055', 'CROATIA'),
('KO056', 'DAKAR, SENEGAL'),
('KO057', 'DAMASCUS, SYRIA'),
('KO058', 'DENPASAR'),
('KO059', 'DEPOK'),
('KO060', 'DHAKA, BANGLADESH'),
('KO061', 'DILLI'),
('KO062', 'DJIBOUTI, DJIBOUTI ABOULI'),
('KO063', 'DOHA, QATAR'),
('KO064', 'DOMINICAN REP., CARIBBEAN'),
('KO065', 'DUBAI, UAE'),
('KO066', 'DUBLIN, IRELAND'),
('KO067', 'EL SALVADOR'),
('KO068', 'FIJI ISLAND, SEVENOAK, PACIFIC'),
('KO069', 'FRANKFRUT, GERMANY'),
('KO070', 'FREEPORT, BAHAMAS, CARIBBEAN'),
('KO071', 'GEORGETOWN, GUYANA TIMEHRI'),
('KO072', 'GIBRALTAR'),
('KO073', 'GORONTALO'),
('KO074', 'GRAND CANARIA, CANARY ISLAND'),
('KO075', 'GUAM, GUAM AB WONPAT INTL'),
('KO076', 'GUATEMALA, ALL CITY'),
('KO077', 'GUERNSEY, CHANNEL ISLANDS'),
('KO078', 'HAMBURG, GERMANY'),
('KO079', 'HAVANA, CUBA'),
('KO080', 'HELSINKI, FINLAND'),
('KO081', 'HO CHI MINH CITY, VIETNAM'),
('KO082', 'HONGKONG, HONGKONG'),
('KO083', 'HONOLULU, HAWAII USA'),
('KO084', 'ILULISSAT, GREENLAND'),
('KO085', 'JAKARTA'),
('KO086', 'JAMBI'),
('KO087', 'JAPAN, TOKYO'),
('KO088', 'JAYAPURA'),
('KO089', 'JEDDAH, SAUDI ARABIA'),
('KO090', 'JEMBER'),
('KO091', 'JERSEY, CHANNEL ISLANDS'),
('KO092', 'JERUSALEM, ISRAEL'),
('KO093', 'JOHANNESBURG, SOUTH AFRICA'),
('KO094', 'KABUL, AFGHANISTAN'),
('KO095', 'KARACHI, PAKISTAN'),
('KO096', 'KARAWANG'),
('KO097', 'KATMANDU, NEPAL'),
('KO098', 'KEDIRI'),
('KO099', 'KENDARI'),
('KO100', 'KEP. MAURITIUS, INDIAN OCEAN'),
('KO101', 'KHARTOUM, SUDAN'),
('KO102', 'KINGSTONE, JAMAICA, CARIBBEAN'),
('KO103', 'KINSHASA, ZAIRE'),
('KO104', 'KUALA LUMPUR, MALAYSIA'),
('KO105', 'KUPANG'),
('KO106', 'KUWAIT CITY, KUWAIT'),
('KO107', 'LAGOS, NIGER'),
('KO108', 'LARNACA, CYPRUS'),
('KO109', 'LIBERIA, COSTA RICA'),
('KO110', 'LIBREVILLE, GABON'),
('KO111', 'LIMA, PERU'),
('KO112', 'LISBON, PORTUGAL'),
('KO113', 'LONDON, UNITED KINGDOM'),
('KO114', 'LUSAKA, ZAMBIA'),
('KO115', 'LUXEMBOURG'),
('KO116', 'MACAU, ALL CITY'),
('KO117', 'MACEDONIA'),
('KO118', 'MADAGASKAR, ANTANARIVO'),
('KO119', 'MADIUN'),
('KO120', 'MADRID, SPAIN'),
('KO121', 'MAGELANG'),
('KO122', 'MAKASAR'),
('KO123', 'MALABO, EQUATORIAL GUINEA'),
('KO124', 'MALANG'),
('KO125', 'MALE, MALDIVES, INDIAN OCEAN'),
('KO126', 'MALTA'),
('KO127', 'MAMUJU'),
('KO128', 'MANADO'),
('KO129', 'MANILA, PHILIPPINES'),
('KO130', 'MASERU, LESOTHO'),
('KO131', 'MATARAM'),
('KO132', 'MAUN, BOTSWANA'),
('KO133', 'MEDAN'),
('KO134', 'MELBOURNE, AUSTRALIA'),
('KO135', 'MEXICO CITY, MEXICO'),
('KO136', 'MOJOKERTO'),
('KO137', 'NAIROBI, KENYA'),
('KO138', 'OSLO, NORWAY'),
('KO139', 'PADANG'),
('KO140', 'PALANGKARAYA'),
('KO141', 'PALEMBANG'),
('KO142', 'PALU'),
('KO143', 'PANAMA CITY, PANAMA'),
('KO144', 'PANDAAN'),
('KO145', 'PANGKALPINANG'),
('KO146', 'PAPUA NEW GUINEA'),
('KO147', 'PARIS, FRANCE'),
('KO148', 'PEKANBARU'),
('KO149', 'PERTH, AUSTRALIA'),
('KO150', 'PHNOM PENH, CAMBODIA'),
('KO151', 'PONTIANAK'),
('KO152', 'PORT AU PRINCE, HAITI'),
('KO153', 'PRAHA, CEKOSLOWAKIA'),
('KO154', 'PROBOLINGGO'),
('KO155', 'QUITO, EQUADOR'),
('KO156', 'RABAT, MAROCCO'),
('KO157', 'RANGON, MYANMAR'),
('KO158', 'RAROTONGA, COOK ISLAND'),
('KO159', 'REP. CZEHCH'),
('KO160', 'REYKJAVIK, ICELAND, ATLANTIC'),
('KO161', 'RIAU'),
('KO162', 'RIGA, LATVIA'),
('KO163', 'RIO DE JENERIO, BRAZIL'),
('KO164', 'ROMANIA'),
('KO165', 'ROME, ITALY'),
('KO166', 'SAL, CAPE VERDE'),
('KO167', 'SAMARINDA'),
('KO168', 'SAN JOSE, COSTARICA'),
('KO169', 'SAN JUAN, PUERTO RICO'),
('KO170', 'SANTIAGO, CHILE'),
('KO171', 'SARAJEVO, BOSNIA HEZERGOVINA'),
('KO172', 'SEMARANG'),
('KO173', 'SEOUL, SOUTH KOREA'),
('KO174', 'SINGAPORE'),
('KO175', 'SLOVAKIA'),
('KO176', 'SLOVENIA'),
('KO177', 'SOFIA, BULGARIA'),
('KO178', 'SOLO'),
('KO179', 'SORONG'),
('KO180', 'ST. THOMAS, VIRGIN ISLANDS'),
('KO181', 'STOCKHOLM, SWEDEN'),
('KO182', 'SUKABUMI'),
('KO183', 'SURABAYA'),
('KO184', 'SYDNEY, NS AUSTRALIA'),
('KO185', 'TAIPEI, TAIWAN'),
('KO186', 'TALLINN, ESTONIA'),
('KO187', 'TANGERANG'),
('KO188', 'TANJUNGPANDAN'),
('KO189', 'TANJUNGPINANG'),
('KO190', 'TANZANIA, DAR ES SALAAM'),
('KO191', 'TARAKAN'),
('KO192', 'TBILISI, GEORGIA NOVO'),
('KO193', 'TEGUCIGALPA, HONDURAS'),
('KO194', 'TEHERAN, IRAN'),
('KO195', 'TERNATE'),
('KO196', 'THAILAND, BANGKOK'),
('KO197', 'TIMIKA'),
('KO198', 'TIRANA, ALBANIA'),
('KO199', 'TUNIS, TUNISIA'),
('KO200', 'TURKEY, ISTAMBUL'),
('KO201', 'UKRAINE'),
('KO202', 'UNITED STATES, ALL CITY'),
('KO203', 'URUGUAY, MONTEVIDEO'),
('KO204', 'VANUATU, PORT VILLA, PACIFIC'),
('KO205', 'VATICAN, ALL CITY'),
('KO206', 'VENEZUELA, SANTA BARBAR'),
('KO207', 'VIENNA, AUSTRIA'),
('KO208', 'VIENTIANE, LAO P.D.R.'),
('KO209', 'WARSAWA, POLAND'),
('KO210', 'WILLEMSTAD, CURACAO ISLAND'),
('KO211', 'YEMEN, ARAB REP.'),
('KO212', 'YEREVAN, ARMENIA'),
('KO213', 'YOGYAKARTA'),
('KO214', 'ZIMBABWE, HARARE'),
('KO215', 'ZURICH, SWITZERLAN');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `dari` varchar(20) NOT NULL,
  `ke` varchar(20) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `statusbaca` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pemesanan` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `no_rekening` varchar(12) NOT NULL,
  `atasnama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` varchar(6) NOT NULL,
  `nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `nama`) VALUES
('SRS001', 'REVIVAL'),
('SRS002', 'THE CROSS'),
('SRS003', 'MESSIAH'),
('SRS004', 'TRANSFORMED LIFES');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `first_name` text,
  `last_name` text,
  `kota_id` varchar(5) DEFAULT NULL,
  `alamat` text,
  `hp` varchar(15) DEFAULT NULL,
  `confirmed` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `first_name`, `last_name`, `kota_id`, `alamat`, `hp`, `confirmed`) VALUES
('asdasd', 'bfd59291e825b5f2bbf1eb76569f8fe7', 'christianlimanto95@gmail.com', 'Budi', 'Sutej', 'KO010', 'Pakuwon Indah 225', '08785523344', '0');

-- --------------------------------------------------------

--
-- Table structure for table `verifikasi`
--

CREATE TABLE `verifikasi` (
  `id` varchar(32) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verifikasi`
--

INSERT INTO `verifikasi` (`id`, `email`) VALUES
('9f421fd929947b53831377d5ab4af5a8', 'christianlimanto95@gmail.com'),
('b5e3253e1fdac9ad83e82c989a6d3c23', 'christianlimanto95@gmail.com'),
('dfff3c19585ee28dd64c64b09edc3e9e', 'christianlimanto95@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `series_id` (`series_id`);

--
-- Indexes for table `blogpost`
--
ALTER TABLE `blogpost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_detail`
--
ALTER TABLE `custom_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcart`
--
ALTER TABLE `dcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `design`
--
ALTER TABLE `design`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `djual`
--
ALTER TABLE `djual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dpemesanan`
--
ALTER TABLE `dpemesanan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `hcart`
--
ALTER TABLE `hcart`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `hjual`
--
ALTER TABLE `hjual`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `hpemesanan`
--
ALTER TABLE `hpemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `kaos`
--
ALTER TABLE `kaos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- Indexes for table `verifikasi`
--
ALTER TABLE `verifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_series_barang_series_id` FOREIGN KEY (`series_id`) REFERENCES `series` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
