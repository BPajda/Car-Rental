-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Cze 2022, 15:51
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `fakecar`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `archive_rez`
--

CREATE TABLE `archive_rez` (
  `id_car` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `archive_rez`
--

INSERT INTO `archive_rez` (`id_car`, `id_user`, `start`, `end`, `id_status`) VALUES
(3, 1, '2021-12-13', '2021-12-15', 2),
(2, 1, '2021-12-13', '2021-12-15', 4),
(2, 1, '2021-12-13', '2021-12-24', 2),
(2, 1, '2021-12-14', '2021-12-17', 2),
(2, 1, '2021-12-14', '2021-12-24', 4),
(3, 6, '2021-12-01', '2021-12-03', 4),
(5, 6, '2021-12-14', '2021-12-19', 2),
(3, 6, '2021-12-01', '2021-12-03', 4),
(3, 6, '2021-12-15', '2021-12-17', 4),
(1, 5, '2021-12-14', '2021-12-31', 4),
(3, 6, '2021-12-23', '2021-12-31', 2),
(2, 1, '2021-12-15', '2021-12-30', 4),
(3, 6, '2021-12-28', '2022-01-01', 4),
(3, 6, '2022-02-23', '2022-02-27', 4),
(3, 6, '2022-02-15', '2022-02-25', 2),
(3, 6, '2022-02-25', '2022-03-04', 4),
(2, 7, '2021-12-16', '2021-12-17', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `model` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `marka` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  `kolor` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `silnik` int(11) NOT NULL,
  `przyspieszenie` float NOT NULL,
  `cena` float NOT NULL,
  `zdjecie` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `cars`
--

INSERT INTO `cars` (`id`, `model`, `marka`, `kolor`, `silnik`, `przyspieszenie`, `cena`, `zdjecie`) VALUES
(1, 'Multipla', 'Fiat', 'czerwony', 120, 16, 200, 'https://pictures.trader.pl/eurotax/pictures/c/2a/0d232e5a2c282ba52478f5c9b49a72f4.jpg'),
(2, '126P \"Maluch\" ', 'Fiat', 'żółty', 25, 37, 100, 'https://d-mf.ppstatic.pl/art/74/h3/zxf8luskg40s4kcoss8ok/51a3bc305e6e2-p.1200.jpg'),
(3, 'Corvette (C7)', 'Chevrolet ', 'czerwony', 360, 6, 3000, 'https://ramcars.pl/media/tz_portfolio_plus/article/cache/vette-c7-207-1_o.jpg'),
(5, 'Cybertruck', 'Tesla', 'srebrny', 480, 6.9, 4200, 'https://gagadget.com/media/post_big/Tesla_Cybertruck.jpeg'),
(6, 'Robin', 'Reliant', 'zielony', 50, 20, 300, 'https://upload.wikimedia.org/wikipedia/commons/e/ee/Reliant_Robin_ca_1974_green_in_Ely.jpg'),
(7, 'V8 \"Batmobil\"', 'Chevrolet', 'czarny', 560, 5.5, 6900, 'https://csn.naekranie.pl/wp-content/uploads/2021/04/batmobil_6065cc6e7f057.jpeg'),
(8, 'TG', 'Mustang', 'zielony', 430, 4, 1500, 'https://globalelitecar.pl/wp-content/uploads/2020/03/ford-mustang-01.jpg'),
(9, 'Veyron', 'Bugatti', 'czarny', 900, 2, 2000, 'https://d-mf.ppstatic.pl/art/5s/r7/ej3438kk444gwc4w8ksgs/veyron.1200.jpg'),
(10, 'Continental GT Speed', 'Bentley', 'Czarny', 500, 3.6, 1000, 'https://ireland.apollo.olxcdn.com/v1/files/eyJmbiI6Im92NjNkeGQ0NnNvcTEtT1RPTU9UT1BMIiwidyI6W3siZm4iOiJ3ZzRnbnFwNnkxZi1PVE9NT1RPUEwiLCJzIjoiMTYiLCJwIjoiMTAsLTEwIiwiYSI6IjAifV19.tCDe4Pn89R4rT0dxkdKx9362pTSEyh46oySQ6RlPfHY/image;s=1080x720'),
(11, 'Sesto Elemento', 'Lamborghini', 'czarny', 690, 2, 3000, 'https://i.wpimg.pl/1920x0/m.autokult.pl/2485033-large2-c4e8c1409b5067c1a.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `prawa`
--

CREATE TABLE `prawa` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(32) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `prawa`
--

INSERT INTO `prawa` (`id`, `nazwa`) VALUES
(1, 'Admin'),
(2, 'Mod'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rez`
--

CREATE TABLE `rez` (
  `id` int(11) NOT NULL,
  `id_car` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rez`
--

INSERT INTO `rez` (`id`, `id_car`, `id_user`, `start`, `end`, `id_status`) VALUES
(21, 5, 7, '2021-12-16', '2021-12-17', 1);

--
-- Wyzwalacze `rez`
--
DELIMITER $$
CREATE TRIGGER `ToArchive` BEFORE DELETE ON `rez` FOR EACH ROW INSERT INTO 
archive_rez(id_car, id_user, start, end, id_status)
VALUES(OLD.id_car, OLD.id_user, OLD.start, OLD.end,
       IF(OLD.id_status=1, 4, 2))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(32) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `status`
--

INSERT INTO `status` (`id`, `nazwa`) VALUES
(1, 'zaakceptowany'),
(2, 'odrzucony'),
(3, 'oczekujacy'),
(4, 'zakończony');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `aktywny` tinyint(1) NOT NULL DEFAULT 0,
  `prawa_id` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `aktywny`, `prawa_id`) VALUES
(1, '123', '202cb962ac59075b964b07152d234b70', 1, 2),
(5, 'log', 'dc1d71bbb5c4d2a5e936db79ef10c19f', 1, 3),
(6, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(7, '!@#$%^', '7815696ecbf1c96e6894b779456d330e', 1, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vars`
--

CREATE TABLE `vars` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `value` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `vars`
--

INSERT INTO `vars` (`id`, `name`, `value`) VALUES
(1, 'timestamp', 60),
(2, 'currentTime', 1644857751);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `prawa`
--
ALTER TABLE `prawa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazwa` (`nazwa`);

--
-- Indeksy dla tabeli `rez`
--
ALTER TABLE `rez`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_car` (`id_car`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_car_2` (`id_car`);

--
-- Indeksy dla tabeli `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `prawa_id` (`prawa_id`);

--
-- Indeksy dla tabeli `vars`
--
ALTER TABLE `vars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `prawa`
--
ALTER TABLE `prawa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `rez`
--
ALTER TABLE `rez`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT dla tabeli `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `vars`
--
ALTER TABLE `vars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `rez`
--
ALTER TABLE `rez`
  ADD CONSTRAINT `rez_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `rez_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rez_ibfk_3` FOREIGN KEY (`id_car`) REFERENCES `cars` (`id`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`prawa_id`) REFERENCES `prawa` (`id`);

DELIMITER $$
--
-- Zdarzenia
--
CREATE DEFINER=`root`@`localhost` EVENT `Date now` ON SCHEDULE EVERY 5 SECOND STARTS '2021-12-13 21:07:01' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN

SET @time = now() + INTERVAL (SELECT value FROM vars WHERE name = 'timestamp') DAY;

		UPDATE vars SET value=UNIX_TIMESTAMP(@time) WHERE name='currentTime';
        
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
