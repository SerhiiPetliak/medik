-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 25 2016 г., 15:06
-- Версия сервера: 5.6.26
-- Версия PHP: 5.4.44

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `medSys`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chronicDiseases`
--

CREATE TABLE IF NOT EXISTS `chronicDiseases` (
  `chronicDiseasesId` int(5) NOT NULL AUTO_INCREMENT,
  `chronicDiseasesName` varchar(255) NOT NULL,
  PRIMARY KEY (`chronicDiseasesId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `chronicDiseases`
--

INSERT INTO `chronicDiseases` (`chronicDiseasesId`, `chronicDiseasesName`) VALUES
(1, 'б1'),
(2, 'б2');

-- --------------------------------------------------------

--
-- Структура таблицы `chronicDiseasesPeoples`
--

CREATE TABLE IF NOT EXISTS `chronicDiseasesPeoples` (
  `chronicDiseasesId` int(5) NOT NULL,
  `peopleId` int(5) NOT NULL,
  KEY `chronicDiseasesId` (`chronicDiseasesId`),
  KEY `peopleId` (`peopleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chronicDiseasesPeoples`
--

INSERT INTO `chronicDiseasesPeoples` (`chronicDiseasesId`, `peopleId`) VALUES
(1, 7),
(2, 7),
(1, 6),
(1, 3),
(2, 3),
(1, 4),
(2, 8),
(1, 9),
(2, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `grafts`
--

CREATE TABLE IF NOT EXISTS `grafts` (
  `graftId` int(5) NOT NULL AUTO_INCREMENT,
  `graftName` varchar(255) NOT NULL,
  PRIMARY KEY (`graftId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `grafts`
--

INSERT INTO `grafts` (`graftId`, `graftName`) VALUES
(1, 'п1'),
(2, 'п2');

-- --------------------------------------------------------

--
-- Структура таблицы `graftsPeoples`
--

CREATE TABLE IF NOT EXISTS `graftsPeoples` (
  `graftId` int(5) NOT NULL,
  `peopleId` int(5) NOT NULL,
  KEY `graftId` (`graftId`),
  KEY `peopleId` (`peopleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `graftsPeoples`
--

INSERT INTO `graftsPeoples` (`graftId`, `peopleId`) VALUES
(1, 7),
(2, 7),
(2, 6),
(1, 3),
(2, 4),
(1, 8),
(1, 9),
(1, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `peoples`
--

CREATE TABLE IF NOT EXISTS `peoples` (
  `peopleId` int(5) NOT NULL AUTO_INCREMENT,
  `peopleFIO` varchar(255) NOT NULL,
  `peopleBirthday` date NOT NULL,
  `peopleWorking` int(5) NOT NULL,
  `peopleFluNumber` varchar(255) NOT NULL,
  `peopleFluDate` date NOT NULL,
  `peopleFluResult` int(1) NOT NULL,
  `peopleFluTerm` int(2) NOT NULL,
  `peopleStreet` int(5) NOT NULL,
  `peopleAdress` varchar(255) NOT NULL,
  PRIMARY KEY (`peopleId`),
  KEY `peopleWorking` (`peopleWorking`),
  KEY `peopleFlu` (`peopleFluNumber`),
  KEY `peopleStreet` (`peopleStreet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `peoples`
--

INSERT INTO `peoples` (`peopleId`, `peopleFIO`, `peopleBirthday`, `peopleWorking`, `peopleFluNumber`, `peopleFluDate`, `peopleFluResult`, `peopleFluTerm`, `peopleStreet`, `peopleAdress`) VALUES
(3, 'Чувак2', '2000-11-12', 1, '123124234', '2012-11-12', 1, 4, 2, ''),
(4, 'Чувак3', '2000-11-12', 1, '123124234', '2010-11-12', 1, 6, 1, ''),
(6, 'Чувак11', '2000-11-12', 1, '123124234', '2016-11-12', 1, 0, 1, ''),
(7, 'Чувак112', '2000-11-12', 1, '123124234', '2013-11-12', 1, 3, 1, ''),
(8, 'Чувак123', '0000-00-00', 1, '123124234', '2016-01-27', 1, 0, 2, '2'),
(9, 'Чувак1', '2016-01-07', 1, '123124234', '2016-01-14', 1, 0, 1, '2'),
(10, 'Чувак1121', '2016-01-05', 2, '123124234', '2016-01-26', 0, 0, 1, '2');

-- --------------------------------------------------------

--
-- Структура таблицы `streets`
--

CREATE TABLE IF NOT EXISTS `streets` (
  `streetId` int(2) NOT NULL AUTO_INCREMENT,
  `streetName` varchar(255) NOT NULL,
  PRIMARY KEY (`streetId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `streets`
--

INSERT INTO `streets` (`streetId`, `streetName`) VALUES
(1, 'Кірова'),
(2, 'Пушкіна');

-- --------------------------------------------------------

--
-- Структура таблицы `working`
--

CREATE TABLE IF NOT EXISTS `working` (
  `workingId` int(5) NOT NULL AUTO_INCREMENT,
  `workingName` varchar(255) NOT NULL,
  PRIMARY KEY (`workingId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `working`
--

INSERT INTO `working` (`workingId`, `workingName`) VALUES
(1, 'Пенсионер'),
(2, 'Школьник');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `chronicDiseasesPeoples`
--
ALTER TABLE `chronicDiseasesPeoples`
  ADD CONSTRAINT `chd` FOREIGN KEY (`chronicDiseasesId`) REFERENCES `chronicDiseases` (`chronicDiseasesId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `chp` FOREIGN KEY (`peopleId`) REFERENCES `peoples` (`peopleId`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `graftsPeoples`
--
ALTER TABLE `graftsPeoples`
  ADD CONSTRAINT `gg` FOREIGN KEY (`graftId`) REFERENCES `grafts` (`graftId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `gp` FOREIGN KEY (`peopleId`) REFERENCES `peoples` (`peopleId`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `peoples`
--
ALTER TABLE `peoples`
  ADD CONSTRAINT `ws` FOREIGN KEY (`peopleStreet`) REFERENCES `streets` (`streetId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `www` FOREIGN KEY (`peopleWorking`) REFERENCES `working` (`workingId`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
