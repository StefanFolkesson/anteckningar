-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 22 jan 2024 kl 10:56
-- Serverversion: 10.4.21-MariaDB
-- PHP-version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `ant_app`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `anteckning`
--

CREATE TABLE `anteckning` (
  `anteckning_id` int(11) NOT NULL,
  `skapad_datum` datetime NOT NULL,
  `redigerad_datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `titel` varchar(100) COLLATE utf32_swedish_ci NOT NULL,
  `text` text COLLATE utf32_swedish_ci NOT NULL,
  `raderad` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

--
-- Dumpning av Data i tabell `anteckning`
--

INSERT INTO `anteckning` (`anteckning_id`, `skapad_datum`, `redigerad_datum`, `titel`, `text`, `raderad`) VALUES
(1, '2024-01-11 15:17:55', '2024-01-11 14:19:30', 'Hej', 'Nu är det snart slut', 0),
(2, '2024-01-11 15:17:55', '2024-01-11 14:19:30', 'Trottoar', 'Pavement heter det faktiskt', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `ant_anv`
--

CREATE TABLE `ant_anv` (
  `anteckning_id` int(11) NOT NULL,
  `anvandare_id` int(11) NOT NULL,
  `agare` tinyint(4) DEFAULT NULL,
  `favorit` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

--
-- Dumpning av Data i tabell `ant_anv`
--

INSERT INTO `ant_anv` (`anteckning_id`, `anvandare_id`, `agare`, `favorit`) VALUES
(1, 1, 1, NULL),
(1, 2, NULL, NULL),
(2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `ant_tag`
--

CREATE TABLE `ant_tag` (
  `anteckning_id` int(11) NOT NULL,
  `tagg_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

--
-- Dumpning av Data i tabell `ant_tag`
--

INSERT INTO `ant_tag` (`anteckning_id`, `tagg_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `anvandare`
--

CREATE TABLE `anvandare` (
  `anvandare_id` int(11) NOT NULL,
  `installningar` text COLLATE utf32_swedish_ci DEFAULT NULL,
  `namn` varchar(100) COLLATE utf32_swedish_ci NOT NULL,
  `losen` varchar(100) COLLATE utf32_swedish_ci NOT NULL,
  `inloggning_nyckel` varchar(20) COLLATE utf32_swedish_ci NOT NULL,
  `nyckel_utgangstid` datetime NOT NULL,
  `epost` varchar(50) COLLATE utf32_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

--
-- Dumpning av Data i tabell `anvandare`
--

INSERT INTO `anvandare` (`anvandare_id`, `installningar`, `namn`, `losen`, `inloggning_nyckel`, `nyckel_utgangstid`, `epost`) VALUES
(1, NULL, 'stefan', 'stefan', 'asdasd', '2024-01-22 10:47:07', ''),
(2, NULL, 'billy', 'billy', 'ee', '2024-01-01 11:30:14', '');

-- --------------------------------------------------------

--
-- Tabellstruktur `anv_anv`
--

CREATE TABLE `anv_anv` (
  `anvandare_id_1` int(11) NOT NULL,
  `anvandare_id_2` int(11) NOT NULL,
  `ignorera` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `filer`
--

CREATE TABLE `filer` (
  `filer_id` int(11) NOT NULL,
  `anteckning_id` int(11) NOT NULL,
  `typ` enum('ljud','bild') COLLATE utf32_swedish_ci NOT NULL,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `tagg`
--

CREATE TABLE `tagg` (
  `tagg_id` int(11) NOT NULL,
  `namn` varchar(100) COLLATE utf32_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_swedish_ci;

--
-- Dumpning av Data i tabell `tagg`
--

INSERT INTO `tagg` (`tagg_id`, `namn`) VALUES
(1, 'hälsning'),
(2, 'first');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `anteckning`
--
ALTER TABLE `anteckning`
  ADD PRIMARY KEY (`anteckning_id`);

--
-- Index för tabell `ant_anv`
--
ALTER TABLE `ant_anv`
  ADD PRIMARY KEY (`anteckning_id`,`anvandare_id`),
  ADD KEY `anvandare_id` (`anvandare_id`),
  ADD KEY `anteckning_id` (`anteckning_id`);

--
-- Index för tabell `ant_tag`
--
ALTER TABLE `ant_tag`
  ADD PRIMARY KEY (`anteckning_id`,`tagg_id`),
  ADD KEY `tagg_id` (`tagg_id`),
  ADD KEY `anteckning_id` (`anteckning_id`);

--
-- Index för tabell `anvandare`
--
ALTER TABLE `anvandare`
  ADD PRIMARY KEY (`anvandare_id`),
  ADD UNIQUE KEY `namn` (`namn`);

--
-- Index för tabell `anv_anv`
--
ALTER TABLE `anv_anv`
  ADD PRIMARY KEY (`anvandare_id_1`,`anvandare_id_2`),
  ADD KEY `anvandare_id_2` (`anvandare_id_2`),
  ADD KEY `anvandare_id_1` (`anvandare_id_1`);

--
-- Index för tabell `filer`
--
ALTER TABLE `filer`
  ADD PRIMARY KEY (`filer_id`),
  ADD KEY `anteckning_id` (`anteckning_id`);

--
-- Index för tabell `tagg`
--
ALTER TABLE `tagg`
  ADD PRIMARY KEY (`tagg_id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `anteckning`
--
ALTER TABLE `anteckning`
  MODIFY `anteckning_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT för tabell `anvandare`
--
ALTER TABLE `anvandare`
  MODIFY `anvandare_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT för tabell `filer`
--
ALTER TABLE `filer`
  MODIFY `filer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `tagg`
--
ALTER TABLE `tagg`
  MODIFY `tagg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `ant_anv`
--
ALTER TABLE `ant_anv`
  ADD CONSTRAINT `ant_anv_ibfk_1` FOREIGN KEY (`anteckning_id`) REFERENCES `anteckning` (`anteckning_id`),
  ADD CONSTRAINT `ant_anv_ibfk_2` FOREIGN KEY (`anvandare_id`) REFERENCES `anvandare` (`anvandare_id`);

--
-- Restriktioner för tabell `ant_tag`
--
ALTER TABLE `ant_tag`
  ADD CONSTRAINT `ant_tag_ibfk_1` FOREIGN KEY (`anteckning_id`) REFERENCES `anteckning` (`anteckning_id`),
  ADD CONSTRAINT `ant_tag_ibfk_2` FOREIGN KEY (`tagg_id`) REFERENCES `tagg` (`tagg_id`);

--
-- Restriktioner för tabell `anv_anv`
--
ALTER TABLE `anv_anv`
  ADD CONSTRAINT `anv_anv_ibfk_1` FOREIGN KEY (`anvandare_id_1`) REFERENCES `anvandare` (`anvandare_id`),
  ADD CONSTRAINT `anv_anv_ibfk_2` FOREIGN KEY (`anvandare_id_2`) REFERENCES `anvandare` (`anvandare_id`);

--
-- Restriktioner för tabell `filer`
--
ALTER TABLE `filer`
  ADD CONSTRAINT `filer_ibfk_1` FOREIGN KEY (`anteckning_id`) REFERENCES `anteckning` (`anteckning_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
