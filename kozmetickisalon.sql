-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2022 at 04:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kozmetickisalon`
--

-- --------------------------------------------------------

--
-- Table structure for table `kozmeticar`
--

CREATE TABLE `kozmeticar` (
  `idK` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lozinka` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kozmeticar`
--

INSERT INTO `kozmeticar` (`idK`, `ime`, `prezime`, `email`, `lozinka`) VALUES
(1, 'Ivana', 'Petrović', 'ivana@gmail.com', 'ivana'),
(2, 'Nevena', 'Fundup', 'nevena@gmail.com', 'nevena'),
(3, 'Neda', 'Marković', 'neda@gmail.com', 'neda');

-- --------------------------------------------------------

--
-- Table structure for table `termin`
--

CREATE TABLE `termin` (
  `id` int(11) NOT NULL,
  `datumVreme` date NOT NULL,
  `kozmeticar` int(11) NOT NULL,
  `tretman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `termin`
--

INSERT INTO `termin` (`id`, `datumVreme`, `kozmeticar`, `tretman`) VALUES
(1, '2022-09-26', 3, 6),
(2, '2022-09-27', 1, 3),
(5, '2022-09-29', 2, 2),
(6, '2022-09-23', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tretman`
--

CREATE TABLE `tretman` (
  `idT` int(11) NOT NULL,
  `naziv` varchar(50) NOT NULL,
  `opis` varchar(300) NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tretman`
--

INSERT INTO `tretman` (`idT`, `naziv`, `opis`, `adresa`, `cena`) VALUES
(1, 'Higijenski tretman lica', 'Higijenski tretman lica je osnova higijene svakog našeg klijenta. Podrazumeva uklanjanje mitisera, uklanjanje bubuljica, čišćenje pora i nanošenje vitaminske maske.', 'Glavna 21, Zemun', 4500),
(2, 'Laserski tretman lica', 'Akne i bubuljice predstavljaju veliki problem većine ljudi. Bilo da se radi o tinejdžerima ili starijim osobama, akne i bubuljice su jednako mučne. Pravilna nega je izuzetno važna u ovom slučaju.', 'Jovana Subotića 10, Zemun', 6000),
(3, 'Masaža', 'Masaža predstavlja plansko i repetitivno ponavljanje određenih pokreta ruku koji imaju trenutno ili odloženo pozitivno dejstvo na ljudsko lice i telo, u zavisnosti od vrste primenjene tehnike i regije koja se tretira na ovaj način.', 'Bačka 13, Zemun', 2500),
(4, 'Anticelulit tretman', 'Najstarija metoda tretiranja celulita i uvek prva asocijacija za borbu sa njim je anticelulit masaža. Tradicionalno i potvrđeno rešenje upornog celulita.', 'Bulevar maršala Tolbuhina 46, Novi Beograd', 5000),
(5, 'Depilacija hladnim voskom', 'Depilacija je tretman privremenog otklanjanja neželjenih dlačica sa površine kože. Na taj način koža postaje glatka i nežna. Efekat ove procedure traje 10-30 dana, u zavisnosti od brzine rasta i jačine dlake.', 'Dr Petra Markovića 10, Zemun', 1200),
(6, 'Depilacija toplim voskom', 'Depilacija je tretman privremenog otklanjanja neželjenih dlačica sa površine kože. Na taj način koža postaje glatka i nežna. Efekat ove procedure traje 10-30 dana, u zavisnosti od brzine rasta i jačine dlake. ', 'Filipa Višnjića 22, Zemun', 1400);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kozmeticar`
--
ALTER TABLE `kozmeticar`
  ADD PRIMARY KEY (`idK`);

--
-- Indexes for table `termin`
--
ALTER TABLE `termin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kozmeticar` (`kozmeticar`),
  ADD KEY `tretman` (`tretman`);

--
-- Indexes for table `tretman`
--
ALTER TABLE `tretman`
  ADD PRIMARY KEY (`idT`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kozmeticar`
--
ALTER TABLE `kozmeticar`
  MODIFY `idK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `termin`
--
ALTER TABLE `termin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tretman`
--
ALTER TABLE `tretman`
  MODIFY `idT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `termin`
--
ALTER TABLE `termin`
  ADD CONSTRAINT `termin_ibfk_1` FOREIGN KEY (`tretman`) REFERENCES `tretman` (`idT`),
  ADD CONSTRAINT `termin_ibfk_2` FOREIGN KEY (`kozmeticar`) REFERENCES `kozmeticar` (`idK`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
