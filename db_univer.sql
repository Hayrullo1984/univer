-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2020 at 12:07 PM
-- Server version: 5.7.30-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_univer`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `rm_shtat_p` (`bulim` INT(11))  BEGIN
SELECT
lavozim.NAMELAVOZIM as l_name,
unvon.NAMEUNVON as u_name,
daraja.NAMEDARAJA as d_name,
shtat.BIRLIKSONI as b_soni,
razryad.RAZRYAD as razryad,
razryad.KOEF
FROM rm_shtat as shtat
left join us_budkont as budkont on shtat.IDBUDKONT = budkont.ID
left join us_bulim as bulim on shtat.IDBULUM=bulim.ID
left join us_lavozim as lavozim on shtat.IDLAVOZIM = lavozim.ID
left join us_ilmunvon as unvon on shtat.IDUNVON = unvon.ID
left join us_ilmdaraja as daraja on shtat.IDDARAJA = daraja.ID
left join us_razryad as razryad on shtat.IDRAZRYAD = razryad.ID
left join us_org as org on shtat.IDORG = org.ID
where IDBULUM = bulim
UNION
SELECT * FROM us_razryad  ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_bulim` ()  BEGIN
select
  `usb`.`ID` AS `ID`,
  `usb`.`IDORG` AS `ORGID`,
  `uso`.`NAMEORG` AS `ORG`,
  `usb`.`IDMARKAZ` AS `MARKAZID`,
  (case
     when isnull(`usbb`.`IDMARKAZ`) then ''
     else `usbb`.`NAMEBULIM`
   end) AS `MB`,
  `usb`.`NAMEBULIM` AS `BULIM`,
  `usb`.`IDLANG` AS `LANGID`,
  `usl`.`SHORTLANG` AS `LANG`,
  `usb`.`IDALIFBO` AS `ALIFBOID`,
  `usa`.`SHORTNAMEALIF` AS `ILIFBO`
from
  ((((`us_bulim` `usb`
  left join `us_org` `uso` on ((`usb`.`IDORG` = `uso`.`ID`)))
  left join `us_bulim` `usbb` on ((`usb`.`IDMARKAZ` = `usbb`.`ID`)))
  left join `us_lang` `usl` on ((`usb`.`IDLANG` = `usl`.`ID`)))
  left join `us_alifbo` `usa` on ((`usb`.`IDALIFBO` = `usa`.`ID`)));
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_lavozim` ()  BEGIN
(select
   `usb`.`ID` AS `ID`,
   `usb`.`NAMELAVOZIM` AS `NAMELAVOZIM`,
   `usb`.`IDLANG` AS `LANGID`,
   `usl`.`SHORTLANG` AS `LANG`,
   `usb`.`IDALFAVIT` AS `ALIFBOID`,
   `usa`.`SHORTNAMEALIF` AS `ILIFBO`
 from
   ((`us_lavozim` `usb`
   left join `us_lang` `usl` on ((`usb`.`IDLANG` = `usl`.`ID`)))
   left join `us_alifbo` `usa` on ((`usb`.`IDALFAVIT` = `usa`.`ID`))));

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_shtatka` (`yil` INT(4), `orgid` INT(4), `status` INT(4))  BEGIN
select
   `rm`.`ID` AS `ID`,
   `rm`.`IDBUDKONT` AS `SHAKLID`,
   `usbk`.`NAMEBUDKONT` AS `SHAKL`,
   `rm`.`IDMARKAZ` AS `MARKAZID`,
   `rm`.`IDBULUM` AS `BULIMID`,
   `usb`.`NAMEBULIM` AS `BULIM`,
   `rm`.`IDLAVOZIM` AS `LAVOZIMID`,
   `usl`.`NAMELAVOZIM` AS `LAVOZIM`,
   `rm`.`IDUNVON` AS `UNVONID`,
   `usu`.`NAMEUNVON` AS `UNVON`,
   `rm`.`IDDARAJA` AS `DARAJAID`,
   `usd`.`NAMEDARAJA` AS `DARAJA`,
   `rm`.`BIRLIKSONI` AS `BIRLIK`,
   `rm`.`IDRAZRYAD` AS `RAZRYADID`,
   `usr`.`RAZRYAD` AS `RAZRYAD`,
   `rm`.`IDUSTAMA` as `USTAMAID`,
   `ust`.`USTAMA` as `USTAMA`,
   `usr`.`KOEF` AS `KOEFF`,
   `usr`.`OKLAD` AS `OKLAD_FIRST`,
   (SELECT sum(`oylik`.`OKLAD`)+`usr`.`OKLAD` FROM `us_oylikosh` as `oylik` where `oylik`.`IDRAZRYAD`=`rm`.`IDRAZRYAD`) 
    AS `OKLAD_LAST`,
   `usr`.`SANA` AS `SANA_FIRST`,
   (SELECT `oylik`.`SANA` FROM `us_oylikosh` as `oylik` where `oylik`.`IDRAZRYAD` = `rm`.`IDRAZRYAD` order by `oylik`.`SANA` DESC limit 1) AS `SANA_LAST`,
   `rm`.`JAMI` AS `JAMITULOV`,
   `rm`.`YNL` AS `YIL`,
   `rm`.`IDORG` AS `ORGID`,
   `uso`.`NAMEORG` AS `ORG`,
   `uso`.`GLBUXSHORT` AS `BOSHBUXG`,
   `uso`.`RAHBARSHORT` AS `RAHBAR`,
   `rm`.`IDUSER` AS `USERID`,
   `users`.`IDEMP` AS `EMPLOYERID`
 from
   `rm_shtat` `rm`
   left join `us_budkont` `usbk` on `rm`.`IDBUDKONT` = `usbk`.`ID`
   left join `us_markaz` `usm` on `rm`.`IDMARKAZ` = `usm`.`ID`
   left join `us_bulim` `usb` on `rm`.`IDBULUM` = `usb`.`ID`
   left join `us_lavozim` `usl` on `rm`.`IDLAVOZIM` = `usl`.`ID`
   left join `us_ilmunvon` `usu` on `rm`.`IDUNVON` = `usu`.`ID`
   left join `us_ilmdaraja` `usd` on `rm`.`IDDARAJA` = `usd`.`ID`
   left join `us_razryad` `usr` on `rm`.`IDRAZRYAD` = `usr`.`ID`
   left join `us_org` `uso` on `rm`.`IDORG` = `uso`.`ID`
   left join `us_users` `users` on `rm`.`IDUSER` = `users`.`ID`
   left join `us_ustama` `ust` on `rm`.`IDUSTAMA` = `ust`.`ID`
   where `rm`.`YNL` =`yil` and `rm`.`IDORG`= `orgid` and `rm`.`IDBUDKONT` = `status`
   order by `rm`.`IDBULUM` ASC;
   

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1592202791),
('m130524_201442_init', 1592202796);

-- --------------------------------------------------------

--
-- Table structure for table `rm_shtat`
--

CREATE TABLE `rm_shtat` (
  `ID` int(11) NOT NULL,
  `IDBUDKONT` int(11) NOT NULL,
  `IDMARKAZ` int(11) NOT NULL,
  `IDBULUM` int(11) NOT NULL,
  `IDLAVOZIM` int(11) NOT NULL,
  `IDUNVON` int(11) NOT NULL,
  `IDDARAJA` int(11) NOT NULL,
  `BIRLIKSONI` double(4,2) NOT NULL,
  `IDRAZRYAD` int(11) NOT NULL,
  `IDUSTAMA` int(11) DEFAULT NULL,
  `JAMI` double(15,2) NOT NULL,
  `IZOH` varchar(255) DEFAULT NULL,
  `YNL` int(4) NOT NULL,
  `IDORG` int(4) NOT NULL,
  `IDUSER` int(4) NOT NULL,
  `INSDATE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rm_shtat`
--

INSERT INTO `rm_shtat` (`ID`, `IDBUDKONT`, `IDMARKAZ`, `IDBULUM`, `IDLAVOZIM`, `IDUNVON`, `IDDARAJA`, `BIRLIKSONI`, `IDRAZRYAD`, `IDUSTAMA`, `JAMI`, `IZOH`, `YNL`, `IDORG`, `IDUSER`, `INSDATE`) VALUES
(1, 1, 1, 2, 1, 1, 1, 1.00, 1, 1, 2111.00, NULL, 2020, 1, 1, '28.03.2020'),
(2, 1, 1, 2, 1, 5, 2, 12.00, 1, 1, 12.00, '', 2020, 1, 1, NULL),
(3, 1, 1, 3, 2, 1, 1, 10.00, 1, 1, 20000.00, '', 2020, 1, 1, NULL),
(4, 1, 1, 3, 6, 1, 1, 10.00, 6, 1, 20000000.00, '', 2020, 1, 1, NULL),
(5, 1, 1, 2, 2, 1, 1, 10.00, 6, 1, 20000.00, '', 2020, 1, 1, NULL),
(6, 1, 1, 2, 3, 1, 1, 10.00, 6, 1, 20000.00, '', 2020, 1, 1, NULL),
(7, 1, 1, 2, 1, 1, 1, 10.00, 1, 1, 20000.00, '', 2020, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ud_mainmenu`
--

CREATE TABLE `ud_mainmenu` (
  `ID` int(11) NOT NULL,
  `NAMEMMENU` varchar(20) NOT NULL,
  `POSITION` int(2) NOT NULL,
  `IDLANG` int(1) NOT NULL,
  `IDALIFBO` int(1) NOT NULL,
  `URL` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ud_mainmenu`
--

INSERT INTO `ud_mainmenu` (`ID`, `NAMEMMENU`, `POSITION`, `IDLANG`, `IDALIFBO`, `URL`) VALUES
(1, 'Bo\'limlar', 1, 1, 1, 'mainmenu/index'),
(2, 'Lavozimlar', 1, 1, 1, 'us-lavozim/index'),
(3, 'Ilmiy unvonlar', 1, 1, 1, 'us-ilmunvon/index'),
(4, 'Ilmiy darajalar', 1, 1, 2, 'us-ilmdaraja/index'),
(5, 'Razryadlar', 1, 1, 1, 'us-razryad/index'),
(6, 'Oylik Maoshlar', 1, 1, 1, 'us-oylikosh/index'),
(7, 'Reja Moliya', 1, 1, 2, 'rm-shtat/index'),
(8, 'Ustama', 1, 1, 2, 'us-ustama/index');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Abduqodir', 'FGsLi9qP8qyNyZ7wEYSPOQwBldR-AzfB', '$2y$13$ew6SsbHv.sz3FvSw5jMNAeQKjPN9TfKir3rkJ1tlAvWq0qYcqvN2e', NULL, 'Abduqodircoder@gmail.com', 10, 1592202891, 1592202891);

-- --------------------------------------------------------

--
-- Table structure for table `us_alifbo`
--

CREATE TABLE `us_alifbo` (
  `ID` int(11) NOT NULL,
  `IDLANG` int(11) NOT NULL,
  `NAMEALIFBO` varchar(20) NOT NULL,
  `SHORTNAMEALIF` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_alifbo`
--

INSERT INTO `us_alifbo` (`ID`, `IDLANG`, `NAMEALIFBO`, `SHORTNAMEALIF`) VALUES
(1, 1, 'КИРИЛ', 'KRL'),
(2, 1, 'LOTIN', 'LTN');

-- --------------------------------------------------------

--
-- Table structure for table `us_budkont`
--

CREATE TABLE `us_budkont` (
  `ID` int(11) NOT NULL,
  `NAMEBUDKONT` varchar(20) NOT NULL,
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_budkont`
--

INSERT INTO `us_budkont` (`ID`, `NAMEBUDKONT`, `IDLANG`, `IDALIFBO`) VALUES
(1, 'БЮДЖЕТ', 1, 1),
(2, 'ШАРТНОМА', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_bulim`
--

CREATE TABLE `us_bulim` (
  `ID` int(11) NOT NULL,
  `IDORG` int(11) NOT NULL,
  `IDMARKAZ` int(11) NOT NULL DEFAULT '0',
  `NAMEBULIM` varchar(255) NOT NULL,
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_bulim`
--

INSERT INTO `us_bulim` (`ID`, `IDORG`, `IDMARKAZ`, `NAMEBULIM`, `IDLANG`, `IDALIFBO`) VALUES
(2, 1, 0, 'РЕКТОРАТ', 1, 1),
(3, 1, 0, 'АХБОРОТ ТЕХНОЛОГИЯЛАРИ МАРКАЗИ', 1, 1),
(4, 1, 3, 'АХБОРОТ ТИЗИМЛАРИНИ ЖОРИЙ ЭТИШ БЎЛИМИ', 1, 1),
(5, 1, 3, 'ФВҚФ', 1, 1),
(6, 1, 0, 'Rektorat', 1, 2),
(7, 1, 0, 'TEST', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_faculity`
--

CREATE TABLE `us_faculity` (
  `ID` int(11) NOT NULL,
  `IDORG` int(11) NOT NULL,
  `NAMEFACULITY` varchar(150) NOT NULL,
  `SHORTNAMEFACULITY` varchar(20) NOT NULL,
  `IDLANG` int(1) NOT NULL,
  `IDALIFBO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `us_ilmdaraja`
--

CREATE TABLE `us_ilmdaraja` (
  `ID` int(11) NOT NULL,
  `NAMEDARAJA` varchar(70) NOT NULL,
  `SHORTNAMEDARAJA` varchar(20) NOT NULL,
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_ilmdaraja`
--

INSERT INTO `us_ilmdaraja` (`ID`, `NAMEDARAJA`, `SHORTNAMEDARAJA`, `IDLANG`, `IDALIFBO`) VALUES
(1, 'Профессор', 'проф.', 1, 1),
(2, 'Dotsent', 'dots', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `us_ilmunvon`
--

CREATE TABLE `us_ilmunvon` (
  `ID` int(11) NOT NULL,
  `NAMEUNVON` varchar(70) NOT NULL,
  `SHORTNAMEUNVON` varchar(20) NOT NULL,
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_ilmunvon`
--

INSERT INTO `us_ilmunvon` (`ID`, `NAMEUNVON`, `SHORTNAMEUNVON`, `IDLANG`, `IDALIFBO`) VALUES
(1, 'Техника фанлари доктори', 'т.ф.д.', 1, 1),
(4, 'Техника фанлари номзоди', 'т.ф.н.', 1, 1),
(5, 'Биология фанлари доктори', 'б.ф.д.', 1, 1),
(6, 'Askar', 'Ask', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_lang`
--

CREATE TABLE `us_lang` (
  `ID` int(11) NOT NULL,
  `LANG` varchar(20) NOT NULL,
  `SHORTLANG` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_lang`
--

INSERT INTO `us_lang` (`ID`, `LANG`, `SHORTLANG`) VALUES
(1, 'ЎЗБЕК', 'UZB'),
(2, 'РУС', 'RUS'),
(3, 'ENGLISH', 'ENG');

-- --------------------------------------------------------

--
-- Table structure for table `us_lavozim`
--

CREATE TABLE `us_lavozim` (
  `ID` int(11) NOT NULL,
  `IDMARKAZ` int(11) NOT NULL,
  `IDBULIM` int(11) NOT NULL,
  `NAMELAVOZIM` varchar(255) NOT NULL,
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL,
  `IDORG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_lavozim`
--

INSERT INTO `us_lavozim` (`ID`, `IDMARKAZ`, `IDBULIM`, `NAMELAVOZIM`, `IDLANG`, `IDALIFBO`, `IDORG`) VALUES
(1, 1, 2, 'РЕКТОР', 1, 1, 1),
(2, 1, 2, 'ЎҚУВ ИШЛАРИ БЎЙИЧА ПРОРЕКТОР', 1, 1, 1),
(3, 1, 2, 'ЁШЛАР БИЛАН ИШЛАШ БЎЙИЧА ПРОРЕКТОР', 1, 1, 1),
(4, 1, 2, 'ИЛМИЙ ИШЛАР ВА ИННОВАЦИЯЛАР БЎЙИЧА ПРОРЕКТОР', 1, 1, 1),
(5, 1, 2, 'МОЛИЯ-ИҚТИСОД ИШЛАРИ БЎЙИЧА ПРОРЕКТОР', 1, 1, 1),
(6, 1, 2, 'ИЛМИЙ ИШЛАР ВА ИННОВАЦИЯЛАР БЎЙИЧА ПРОРЕКТОР', 1, 1, 1),
(7, 1, 2, 'TEST', 1, 2, 1),
(9, 1, 2, 'TEST', 1, 2, 1),
(10, 1, 2, 'TEST', 1, 2, 1),
(11, 1, 2, 'TEST', 1, 2, 1),
(12, 1, 2, 'TEST', 1, 2, 1),
(13, 1, 2, 'TEST', 1, 2, 1),
(14, 1, 2, 'TEST', 1, 2, 1),
(15, 1, 2, 'TEST', 1, 2, 1),
(16, 1, 2, 'TEST', 1, 2, 1),
(17, 1, 2, 'TEST', 1, 2, 1),
(18, 1, 2, 'TEST', 1, 2, 1),
(19, 1, 2, 'TEST', 1, 2, 1),
(20, 1, 2, 'TEST', 1, 2, 1),
(21, 1, 2, 'TEST', 1, 2, 1),
(22, 1, 2, 'TEST', 1, 2, 1),
(23, 1, 2, 'TEST', 1, 2, 1),
(24, 1, 2, 'TEST', 1, 2, 1),
(25, 1, 2, 'TEST', 1, 2, 1),
(26, 1, 2, 'TEST', 1, 2, 1),
(27, 1, 2, 'TEST', 1, 2, 1),
(28, 1, 2, 'TEST', 1, 2, 1),
(29, 1, 2, 'TEST', 1, 2, 1),
(30, 1, 2, 'TEST', 1, 2, 1),
(31, 1, 2, 'TEST', 1, 2, 1),
(32, 1, 2, 'TEST', 1, 2, 1),
(33, 1, 2, 'TEST', 1, 2, 1),
(34, 1, 2, 'TEST', 1, 2, 1),
(35, 1, 2, 'TEST', 1, 2, 1),
(36, 1, 2, 'TEST', 1, 2, 1),
(37, 1, 2, 'TEST', 1, 2, 1),
(38, 1, 2, 'TEST', 1, 2, 1),
(39, 1, 2, 'TEST', 1, 2, 1),
(40, 1, 2, 'TEST', 1, 2, 1),
(41, 1, 2, 'TEST', 1, 2, 1),
(42, 1, 2, 'TEST', 1, 2, 1),
(43, 1, 2, 'TEST', 1, 2, 1),
(44, 1, 2, 'TEST', 1, 2, 1),
(45, 1, 2, 'TEST', 1, 2, 1),
(46, 1, 2, 'TEST', 1, 2, 1),
(47, 1, 2, 'TEST', 1, 2, 1),
(48, 1, 2, 'TEST', 1, 2, 1),
(49, 1, 2, 'TEST', 1, 2, 1),
(50, 1, 2, 'TEST', 1, 2, 1),
(51, 1, 2, 'TEST', 1, 2, 1),
(52, 1, 2, 'TEST', 1, 2, 1),
(53, 1, 2, 'TEST', 1, 2, 1),
(54, 1, 2, 'TEST', 1, 2, 1),
(55, 1, 2, 'TEST', 1, 2, 1),
(56, 1, 2, 'TEST', 1, 2, 1),
(57, 1, 2, 'TEST', 1, 2, 1),
(58, 1, 2, 'TEST', 1, 2, 1),
(59, 1, 2, 'TEST', 1, 2, 1),
(60, 1, 2, 'TEST', 1, 2, 1),
(61, 1, 2, 'TEST', 1, 2, 1),
(62, 1, 2, 'TEST', 1, 2, 1),
(63, 1, 2, 'TEST', 1, 2, 1),
(64, 1, 2, 'TEST', 1, 2, 1),
(65, 1, 2, 'TEST', 1, 2, 1),
(66, 1, 2, 'TEST', 1, 2, 1),
(67, 1, 2, 'TEST', 1, 2, 1),
(68, 1, 2, 'TEST', 1, 2, 1),
(69, 1, 2, 'TEST', 1, 2, 1),
(70, 1, 2, 'TEST', 1, 2, 1),
(71, 1, 2, 'TEST', 1, 2, 1),
(72, 1, 2, 'TEST', 1, 2, 1),
(73, 1, 2, 'TEST', 1, 2, 1),
(74, 1, 2, 'TEST', 1, 2, 1),
(75, 1, 2, 'TEST', 1, 2, 1),
(76, 1, 2, 'TEST', 1, 2, 1),
(77, 1, 2, 'TEST', 1, 2, 1),
(78, 1, 2, 'TEST', 1, 2, 1),
(79, 1, 2, 'TEST', 1, 2, 1),
(80, 1, 2, 'TEST', 1, 2, 1),
(81, 1, 2, 'TEST', 1, 2, 1),
(82, 1, 2, 'TEST', 1, 2, 1),
(83, 1, 2, 'TEST', 1, 2, 1),
(84, 1, 2, 'TEST', 1, 2, 1),
(85, 1, 2, 'TEST', 1, 2, 1),
(86, 1, 2, 'TEST', 1, 2, 1),
(87, 1, 2, 'TEST', 1, 2, 1),
(88, 1, 2, 'TEST', 1, 2, 1),
(89, 1, 2, 'TEST', 1, 2, 1),
(90, 1, 2, 'TEST', 1, 2, 1),
(91, 1, 2, 'TEST', 1, 2, 1),
(92, 1, 2, 'TEST', 1, 2, 1),
(93, 1, 2, 'TEST', 1, 2, 1),
(94, 1, 2, 'TEST', 1, 2, 1),
(95, 1, 2, 'TEST', 1, 2, 1),
(96, 1, 2, 'TEST', 1, 2, 1),
(97, 1, 2, 'TEST', 1, 2, 1),
(98, 1, 2, 'TEST', 1, 2, 1),
(99, 1, 2, 'TEST', 1, 2, 1),
(100, 1, 2, 'TEST', 1, 2, 1),
(101, 1, 2, 'TEST', 1, 2, 1),
(102, 1, 2, 'TEST', 1, 2, 1),
(103, 1, 2, 'TEST', 1, 2, 1),
(104, 1, 2, 'TEST', 1, 2, 1),
(105, 1, 2, 'TEST', 1, 2, 1),
(106, 1, 2, 'TEST', 1, 2, 1),
(107, 1, 2, 'TEST', 1, 2, 1),
(108, 1, 2, 'TEST', 1, 2, 1),
(109, 1, 2, 'TEST', 1, 2, 1),
(110, 1, 2, 'TEST', 1, 2, 1),
(111, 1, 2, 'TEST', 1, 2, 1),
(112, 1, 2, 'TEST', 1, 2, 1),
(113, 1, 2, 'TEST', 1, 2, 1),
(114, 1, 2, 'TEST', 1, 2, 1),
(115, 1, 2, 'TEST', 1, 2, 1),
(116, 1, 2, 'TEST', 1, 2, 1),
(117, 1, 2, 'TEST', 1, 2, 1),
(118, 1, 2, 'TEST', 1, 2, 1),
(119, 1, 2, 'TEST', 1, 2, 1),
(120, 1, 2, 'TEST', 1, 2, 1),
(121, 1, 2, 'TEST', 1, 2, 1),
(122, 1, 2, 'TEST', 1, 2, 1),
(123, 1, 2, 'TEST', 1, 2, 1),
(124, 1, 2, 'TEST', 1, 2, 1),
(125, 1, 2, 'TEST', 1, 2, 1),
(126, 1, 2, 'TEST', 1, 2, 1),
(127, 1, 2, 'TEST', 1, 2, 1),
(128, 1, 2, 'TEST', 1, 2, 1),
(129, 1, 2, 'TEST', 1, 2, 1),
(130, 1, 2, 'TEST', 1, 2, 1),
(131, 1, 2, 'TEST', 1, 2, 1),
(132, 1, 2, 'TEST', 1, 2, 1),
(133, 1, 2, 'TEST', 1, 2, 1),
(134, 1, 2, 'TEST', 1, 2, 1),
(135, 1, 2, 'TEST', 1, 2, 1),
(136, 1, 2, 'TEST', 1, 2, 1),
(137, 1, 2, 'TEST', 1, 2, 1),
(138, 1, 2, 'TEST', 1, 2, 1),
(139, 1, 2, 'TEST', 1, 2, 1),
(140, 1, 2, 'TEST', 1, 2, 1),
(141, 1, 2, 'TEST', 1, 2, 1),
(142, 1, 2, 'TEST', 1, 2, 1),
(143, 1, 2, 'TEST', 1, 2, 1),
(144, 1, 2, 'TEST', 1, 2, 1),
(145, 1, 2, 'TEST', 1, 2, 1),
(146, 1, 2, 'TEST', 1, 2, 1),
(147, 1, 2, 'TEST', 1, 2, 1),
(148, 1, 2, 'TEST', 1, 2, 1),
(149, 1, 2, 'TEST', 1, 2, 1),
(150, 1, 2, 'TEST', 1, 2, 1),
(151, 1, 2, 'TEST', 1, 2, 1),
(152, 1, 2, 'TEST', 1, 2, 1),
(153, 1, 2, 'TEST', 1, 2, 1),
(154, 1, 2, 'TEST', 1, 2, 1),
(155, 1, 2, 'TEST', 1, 2, 1),
(156, 1, 2, 'TEST', 1, 2, 1),
(157, 1, 2, 'TEST', 1, 2, 1),
(158, 1, 2, 'TEST', 1, 2, 1),
(159, 1, 2, 'TEST', 1, 2, 1),
(160, 1, 2, 'TEST', 1, 2, 1),
(161, 1, 2, 'TEST', 1, 2, 1),
(162, 1, 2, 'TEST', 1, 2, 1),
(163, 1, 2, 'TEST', 1, 2, 1),
(164, 1, 2, 'TEST', 1, 2, 1),
(165, 1, 2, 'TEST', 1, 2, 1),
(166, 1, 2, 'TEST', 1, 2, 1),
(167, 1, 2, 'TEST', 1, 2, 1),
(168, 1, 2, 'TEST', 1, 2, 1),
(169, 1, 2, 'TEST', 1, 2, 1),
(170, 1, 2, 'TEST', 1, 2, 1),
(171, 1, 2, 'TEST', 1, 2, 1),
(172, 1, 2, 'TEST', 1, 2, 1),
(173, 1, 2, 'TEST', 1, 2, 1),
(174, 1, 2, 'TEST', 1, 2, 1),
(175, 1, 2, 'TEST', 1, 2, 1),
(176, 1, 2, 'TEST', 1, 2, 1),
(177, 1, 2, 'TEST', 1, 2, 1),
(178, 1, 2, 'TEST', 1, 2, 1),
(179, 1, 2, 'TEST', 1, 2, 1),
(180, 1, 2, 'TEST', 1, 2, 1),
(181, 1, 2, 'TEST', 1, 2, 1),
(182, 1, 2, 'TEST', 1, 2, 1),
(183, 1, 2, 'TEST', 1, 2, 1),
(184, 1, 2, 'TEST', 1, 2, 1),
(185, 1, 2, 'TEST', 1, 2, 1),
(186, 1, 2, 'TEST', 1, 2, 1),
(187, 1, 2, 'TEST', 1, 2, 1),
(188, 1, 2, 'TEST', 1, 2, 1),
(189, 1, 2, 'TEST', 1, 2, 1),
(190, 1, 2, 'TEST', 1, 2, 1),
(191, 1, 2, 'TEST', 1, 2, 1),
(192, 1, 2, 'TEST', 1, 2, 1),
(193, 1, 2, 'TEST', 1, 2, 1),
(194, 1, 2, 'TEST', 1, 2, 1),
(195, 1, 2, 'TEST', 1, 2, 1),
(196, 1, 2, 'TEST', 1, 2, 1),
(197, 1, 2, 'TEST', 1, 2, 1),
(198, 1, 2, 'TEST', 1, 2, 1),
(199, 1, 2, 'TEST', 1, 2, 1),
(200, 1, 2, 'TEST', 1, 2, 1),
(201, 1, 2, 'TEST', 1, 2, 1),
(202, 1, 2, 'TEST', 1, 2, 1),
(203, 1, 2, 'TEST', 1, 2, 1),
(204, 1, 2, 'TEST', 1, 2, 1),
(205, 1, 2, 'TEST', 1, 2, 1),
(206, 1, 2, 'TEST', 1, 2, 1),
(207, 1, 2, 'TEST', 1, 2, 1),
(208, 1, 2, 'TEST', 1, 2, 1),
(209, 1, 2, 'TEST', 1, 2, 1),
(210, 1, 2, 'TEST', 1, 2, 1),
(211, 1, 2, 'TEST', 1, 2, 1),
(212, 1, 2, 'TEST', 1, 2, 1),
(213, 1, 2, 'TEST', 1, 2, 1),
(214, 1, 3, 'TEST', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_markaz`
--

CREATE TABLE `us_markaz` (
  `ID` int(11) NOT NULL,
  `NAMEMARKAZ` varchar(255) NOT NULL,
  `IDLANG` int(11) NOT NULL,
  `IDILIFBO` int(11) NOT NULL,
  `IDORG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_markaz`
--

INSERT INTO `us_markaz` (`ID`, `NAMEMARKAZ`, `IDLANG`, `IDILIFBO`, `IDORG`) VALUES
(1, 'РЕКТОРАТ', 1, 1, 1),
(2, 'ЁШЛАР БИЛАН ИШЛАШ, МАЪНАВИЯТ ВА МАЪРИФАТ БЎЛИМИ', 1, 1, 1),
(3, 'МОНИТОРИНГ ВА ИЧКИ НАЗОРАТ БЎЛИМИ', 1, 1, 1),
(4, 'БУЮРТМАЛАР ПОРТФЕЛИНИ ШАКЛЛАНТИРИШ, БИТИРУВЧИЛАРНИ ИШГА ТАҚСИМЛАШ ВА МОНИТОРИНГ БЎЛИМИ', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_ns10`
--

CREATE TABLE `us_ns10` (
  `Code` int(11) DEFAULT NULL COMMENT 'Viloyat yoki shaxar kodi',
  `IDREPUBLIC` int(11) NOT NULL DEFAULT '1' COMMENT 'Respublika kodi',
  `NAMENS10` varchar(70) DEFAULT NULL COMMENT 'Viloyat yoki shaxar nomi',
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_ns10`
--

INSERT INTO `us_ns10` (`Code`, `IDREPUBLIC`, `NAMENS10`, `IDLANG`, `IDALIFBO`) VALUES
(3, 1, 'АНДИЖОН ВИЛОЯТИ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_ns11`
--

CREATE TABLE `us_ns11` (
  `CODE` int(11) NOT NULL,
  `NS10_CODE` int(11) NOT NULL DEFAULT '3' COMMENT 'VILOYAT YOKI SHAXAR CODI',
  `NAMENS11` varchar(70) DEFAULT NULL COMMENT 'TUMAN NOMI',
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_ns11`
--

INSERT INTO `us_ns11` (`CODE`, `NS10_CODE`, `NAMENS11`, `IDLANG`, `IDALIFBO`) VALUES
(1, 3, 'АНДИЖОН ШАХАР', 1, 1),
(3, 3, 'ХОНОБОД ШАХАР', 1, 1),
(6, 3, 'ОЛТИНКЎЛ ТУМАНИ', 1, 1),
(7, 3, 'АНДИЖОН ТУМАНИ', 1, 1),
(8, 3, 'БАЛИҚЧИ ТУМАНИ', 1, 1),
(9, 3, 'БЎСТОН ТУМАНИ', 1, 1),
(10, 3, 'БУЛОҚБОШИ ТУМАНИ', 1, 1),
(11, 3, 'ЖАЛАҚУДУҚ ТУМАНИ', 1, 1),
(12, 3, 'ИЗБОСКАН ТУМАНИ', 1, 1),
(13, 3, 'УЛУҒНОР ТУМАНИ', 1, 1),
(14, 3, 'ҚЎРҒОНТЕПА ТУМАНИ', 1, 1),
(15, 3, 'АСАКА ТУМАНИ', 1, 1),
(16, 3, 'МАРХАМАТ ТУМАНИ', 1, 1),
(17, 3, 'ШАХРИХОН ТУМАНИ', 1, 1),
(18, 3, 'ПАХТАОБОД ТУМАНИ', 1, 1),
(19, 3, 'ХЎЖАОБОД ТУМАНИ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_org`
--

CREATE TABLE `us_org` (
  `ID` int(11) NOT NULL,
  `NAMEORG` varchar(255) NOT NULL,
  `STIR` int(9) NOT NULL,
  `THSHAKL` varchar(255) NOT NULL COMMENT 'TASHKILIY HUQUQIY SHAKLI',
  `IFUT` varchar(255) NOT NULL COMMENT 'FAOLIYAT TURI',
  `DBIBT` varchar(255) NOT NULL,
  `MHOBT` varchar(255) NOT NULL,
  `RAHBAR` varchar(150) NOT NULL,
  `RAHBARSHORT` varchar(50) NOT NULL,
  `GLBUX` varchar(155) NOT NULL,
  `GLBUXSHORT` varchar(50) NOT NULL,
  `MANZIL` varchar(255) NOT NULL,
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_org`
--

INSERT INTO `us_org` (`ID`, `NAMEORG`, `STIR`, `THSHAKL`, `IFUT`, `DBIBT`, `MHOBT`, `RAHBAR`, `RAHBARSHORT`, `GLBUX`, `GLBUXSHORT`, `MANZIL`, `IDLANG`, `IDALIFBO`) VALUES
(1, 'АНДИЖОН ДАВЛАТ УНИВЕРСИТЕТИ', 202217655, '270 - МУАССАСА', '85410 - ЎРТА ТАЪЛИМДАН КЕЙИНГИ ТАЪЛИМ', '03903 - ЎЗБЕКИСТОН РЕСПУБЛИКАСИ ОЛИЙ ВА ЎРТА МАХСУС ТАЪЛИМ ВАЗИРЛИГИ', '1703401 - АНДИЖОН ВИЛОЯТИ, АНДИЖОН ШАҲАР', 'ЮЛДАШЕВ АКРАМЖОН СУЛТАНМУРАДОВИЧ', 'А.С. ЮЛДАШЕВ', 'МАХМУДОВ АЛИМЖАН РАХМОНОВИЧ', 'А.Р. МАХМУДОВ', 'УНИВЕРСИТЕТ КЎЧАСИ, 129 - УЙ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_oylikosh`
--

CREATE TABLE `us_oylikosh` (
  `ID` int(11) NOT NULL,
  `IDRAZRYAD` int(11) NOT NULL,
  `OKLAD` double(15,2) NOT NULL,
  `SANA` varchar(12) NOT NULL,
  `FOIZ` double(15,2) NOT NULL,
  `NEWOKLAD` double(15,2) NOT NULL,
  `YNL` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_oylikosh`
--

INSERT INTO `us_oylikosh` (`ID`, `IDRAZRYAD`, `OKLAD`, `SANA`, `FOIZ`, `NEWOKLAD`, `YNL`) VALUES
(1, 1, 111.10, '20.06.2020', 10.00, 0.00, 2020),
(2, 1, 122.21, '21.06.2020', 10.00, 0.00, 2020),
(3, 1, 140.00, '26.06.2020', 15.00, 0.00, 2020),
(4, 6, 3000.00, '26.06.2020', 10.00, 0.00, 2020),
(5, 6, 3300.00, '27.06.2020', 10.00, 0.00, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `us_razryad`
--

CREATE TABLE `us_razryad` (
  `ID` int(11) NOT NULL,
  `RAZRYAD` double(15,2) NOT NULL,
  `SANA` varchar(12) NOT NULL,
  `KOEF` double(15,2) NOT NULL,
  `OKLAD` double NOT NULL,
  `YNL` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_razryad`
--

INSERT INTO `us_razryad` (`ID`, `RAZRYAD`, `SANA`, `KOEF`, `OKLAD`, `YNL`) VALUES
(1, 1.00, '20.03.2020', 1.00, 1111, 2020),
(4, 1.00, '22.03.2020', 1.00, 2000, 2020),
(6, 2.00, '26.06.2020', 1.00, 30000, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `us_republic`
--

CREATE TABLE `us_republic` (
  `ID` int(11) NOT NULL,
  `NAMEREPUBLIC` varchar(100) DEFAULT NULL COMMENT 'RESPUBLIKA NOMI',
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_republic`
--

INSERT INTO `us_republic` (`ID`, `NAMEREPUBLIC`, `IDLANG`, `IDALIFBO`) VALUES
(1, 'ЎЗБЕКИСТОН РЕСПУБЛИКАСИ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_status`
--

CREATE TABLE `us_status` (
  `ID` int(11) NOT NULL,
  `NAMESTATUS` varchar(100) NOT NULL,
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_status`
--

INSERT INTO `us_status` (`ID`, `NAMESTATUS`, `IDLANG`, `IDALIFBO`) VALUES
(1, 'АДМИНИСТРАТОР', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_suborg`
--

CREATE TABLE `us_suborg` (
  `ID` int(11) NOT NULL,
  `IDORG` int(11) NOT NULL,
  `NAMESUBORG` varchar(255) NOT NULL,
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_suborg`
--

INSERT INTO `us_suborg` (`ID`, `IDORG`, `NAMESUBORG`, `IDLANG`, `IDALIFBO`) VALUES
(1, 1, 'ФИЗИКА - МАТЕМАТИКА ФАКУЛЬТЕТИ', 1, 1),
(2, 1, 'ФИЛОЛОГИЯ ФАКУЛЬТЕТИ', 1, 1),
(3, 1, 'ФИЗИКА - МАТЕМАТИКА ФАКУЛЬТЕТИ', 1, 1),
(4, 1, 'ФИЛОЛОГИЯ ФАКУЛЬТЕТИ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_toifa`
--

CREATE TABLE `us_toifa` (
  `ID` int(11) NOT NULL,
  `NAMETOIFA` varchar(20) NOT NULL,
  `IDLANG` int(11) NOT NULL,
  `IDALIFBO` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_toifa`
--

INSERT INTO `us_toifa` (`ID`, `NAMETOIFA`, `IDLANG`, `IDALIFBO`) VALUES
(1, 'ТОИФАСИЗ', 1, 1),
(2, '1 - ТОИФАЛИ', 1, 1),
(3, '2 - ТОИФАЛИ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_users`
--

CREATE TABLE `us_users` (
  `ID` int(11) NOT NULL,
  `IDORG` int(11) NOT NULL,
  `LOGIN` varchar(20) NOT NULL,
  `PAROL` varchar(255) NOT NULL,
  `IDEMP` int(11) NOT NULL,
  `IDSTATUS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_users`
--

INSERT INTO `us_users` (`ID`, `IDORG`, `LOGIN`, `PAROL`, `IDEMP`, `IDSTATUS`) VALUES
(2, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1),
(3, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `us_ustama`
--

CREATE TABLE `us_ustama` (
  `ID` int(11) NOT NULL,
  `IDLAVOZIM` int(11) NOT NULL,
  `SANA` date NOT NULL,
  `USTAMA` double(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `us_ustama`
--

INSERT INTO `us_ustama` (`ID`, `IDLAVOZIM`, `SANA`, `USTAMA`) VALUES
(1, 1, '2026-02-20', 100.00);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bulim`
--
CREATE TABLE `v_bulim` (
`ID` int(11)
,`ORGID` int(11)
,`ORG` varchar(255)
,`MARKAZID` int(11)
,`MB` varchar(255)
,`BULIM` varchar(255)
,`LANGID` int(11)
,`LANG` varchar(20)
,`ALIFBOID` int(11)
,`ILIFBO` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `v_bulim`
--
DROP TABLE IF EXISTS `v_bulim`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bulim`  AS  select `usb`.`ID` AS `ID`,`usb`.`IDORG` AS `ORGID`,`uso`.`NAMEORG` AS `ORG`,`usb`.`IDMARKAZ` AS `MARKAZID`,(case when isnull(`usbb`.`IDMARKAZ`) then '' else `usbb`.`NAMEBULIM` end) AS `MB`,`usb`.`NAMEBULIM` AS `BULIM`,`usb`.`IDLANG` AS `LANGID`,`usl`.`SHORTLANG` AS `LANG`,`usb`.`IDALIFBO` AS `ALIFBOID`,`usa`.`SHORTNAMEALIF` AS `ILIFBO` from ((((`us_bulim` `usb` left join `us_org` `uso` on((`usb`.`IDORG` = `uso`.`ID`))) left join `us_bulim` `usbb` on((`usb`.`IDMARKAZ` = `usbb`.`ID`))) left join `us_lang` `usl` on((`usb`.`IDLANG` = `usl`.`ID`))) left join `us_alifbo` `usa` on((`usb`.`IDALIFBO` = `usa`.`ID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `rm_shtat`
--
ALTER TABLE `rm_shtat`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_rm_shtat_1_idx` (`IDBUDKONT`),
  ADD KEY `fk_rm_shtat_2_idx` (`IDLAVOZIM`),
  ADD KEY `fk_rm_shtat_3_idx` (`IDUNVON`),
  ADD KEY `fk_rm_shtat_4_idx` (`IDDARAJA`),
  ADD KEY `fk_rm_shtat_5_idx` (`IDBULUM`),
  ADD KEY `fk_rm_shtat_6_idx` (`IDMARKAZ`),
  ADD KEY `fk_rm_shtat_5_idx1` (`IDORG`),
  ADD KEY `fk_rm_shtat_7_idx` (`IDRAZRYAD`),
  ADD KEY `fk_rm_shtat_9_idx` (`IDUSTAMA`);

--
-- Indexes for table `ud_mainmenu`
--
ALTER TABLE `ud_mainmenu`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_ud_mainmenu_1_idx` (`IDALIFBO`),
  ADD KEY `fk_ud_mainmenu_2_idx` (`IDLANG`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `us_alifbo`
--
ALTER TABLE `us_alifbo`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `us_budkont`
--
ALTER TABLE `us_budkont`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_budkont_1_idx` (`IDALIFBO`),
  ADD KEY `fk_us_budkont_2_idx` (`IDLANG`);

--
-- Indexes for table `us_bulim`
--
ALTER TABLE `us_bulim`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_bulim_1_idx` (`IDALIFBO`),
  ADD KEY `fk_us_bulim_2_idx` (`IDLANG`),
  ADD KEY `fk_us_bulim_3_idx` (`IDORG`),
  ADD KEY `fk_us_bulim_4_idx` (`IDMARKAZ`);

--
-- Indexes for table `us_faculity`
--
ALTER TABLE `us_faculity`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_faculity_1_idx` (`IDALIFBO`),
  ADD KEY `fk_us_faculity_2_idx` (`IDLANG`),
  ADD KEY `fk_us_faculity_3_idx` (`IDORG`);

--
-- Indexes for table `us_ilmdaraja`
--
ALTER TABLE `us_ilmdaraja`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_ilmdaraja_1_idx` (`IDALIFBO`),
  ADD KEY `fk_us_ilmdaraja_2_idx` (`IDLANG`);

--
-- Indexes for table `us_ilmunvon`
--
ALTER TABLE `us_ilmunvon`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_ilmunvon_1_idx` (`IDALIFBO`),
  ADD KEY `fk_us_ilmunvon_2_idx` (`IDLANG`);

--
-- Indexes for table `us_lang`
--
ALTER TABLE `us_lang`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `us_lavozim`
--
ALTER TABLE `us_lavozim`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_lavozim_1_idx` (`IDLANG`),
  ADD KEY `fk_us_lavozim_2_idx` (`IDORG`),
  ADD KEY `fk_us_lavozim_1_idx1` (`IDALIFBO`),
  ADD KEY `fk_us_lavozim_4_idx` (`IDMARKAZ`),
  ADD KEY `fk_us_lavozim_5_idx` (`IDBULIM`);

--
-- Indexes for table `us_markaz`
--
ALTER TABLE `us_markaz`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_markaz_1_idx` (`IDILIFBO`),
  ADD KEY `fk_us_markaz_2_idx` (`IDLANG`),
  ADD KEY `fk_us_markaz_3_idx` (`IDORG`);

--
-- Indexes for table `us_ns10`
--
ALTER TABLE `us_ns10`
  ADD KEY `fk_us_ns10_1_idx` (`IDALIFBO`),
  ADD KEY `fk_us_ns10_2_idx` (`IDLANG`),
  ADD KEY `fk_us_ns10_3_idx` (`IDREPUBLIC`);

--
-- Indexes for table `us_ns11`
--
ALTER TABLE `us_ns11`
  ADD KEY `fk_us_ns11_1_idx` (`IDALIFBO`),
  ADD KEY `fk_us_ns11_2_idx` (`IDLANG`);

--
-- Indexes for table `us_org`
--
ALTER TABLE `us_org`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_org_1_idx` (`IDALIFBO`),
  ADD KEY `fk_us_org_2_idx` (`IDLANG`);

--
-- Indexes for table `us_oylikosh`
--
ALTER TABLE `us_oylikosh`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_oylikosh_1_idx` (`IDRAZRYAD`);

--
-- Indexes for table `us_razryad`
--
ALTER TABLE `us_razryad`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `us_republic`
--
ALTER TABLE `us_republic`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_republic_1_idx` (`IDALIFBO`),
  ADD KEY `fk_us_republic_2_idx` (`IDLANG`);

--
-- Indexes for table `us_status`
--
ALTER TABLE `us_status`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_status_1_idx` (`IDALIFBO`),
  ADD KEY `fk_us_status_2_idx` (`IDLANG`);

--
-- Indexes for table `us_suborg`
--
ALTER TABLE `us_suborg`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `us_toifa`
--
ALTER TABLE `us_toifa`
  ADD PRIMARY KEY (`ID`) USING BTREE,
  ADD KEY `fk_us_toifa_1_idx` (`IDALIFBO`),
  ADD KEY `fk_us_toifa_2_idx` (`IDLANG`);

--
-- Indexes for table `us_users`
--
ALTER TABLE `us_users`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `us_ustama`
--
ALTER TABLE `us_ustama`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_us_ustama_1_idx` (`IDLAVOZIM`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rm_shtat`
--
ALTER TABLE `rm_shtat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ud_mainmenu`
--
ALTER TABLE `ud_mainmenu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `us_alifbo`
--
ALTER TABLE `us_alifbo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `us_budkont`
--
ALTER TABLE `us_budkont`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `us_bulim`
--
ALTER TABLE `us_bulim`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `us_faculity`
--
ALTER TABLE `us_faculity`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `us_ilmdaraja`
--
ALTER TABLE `us_ilmdaraja`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `us_ilmunvon`
--
ALTER TABLE `us_ilmunvon`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `us_lang`
--
ALTER TABLE `us_lang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `us_lavozim`
--
ALTER TABLE `us_lavozim`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;
--
-- AUTO_INCREMENT for table `us_markaz`
--
ALTER TABLE `us_markaz`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `us_org`
--
ALTER TABLE `us_org`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `us_oylikosh`
--
ALTER TABLE `us_oylikosh`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `us_razryad`
--
ALTER TABLE `us_razryad`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `us_status`
--
ALTER TABLE `us_status`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `us_suborg`
--
ALTER TABLE `us_suborg`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `us_toifa`
--
ALTER TABLE `us_toifa`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `us_users`
--
ALTER TABLE `us_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `us_ustama`
--
ALTER TABLE `us_ustama`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `rm_shtat`
--
ALTER TABLE `rm_shtat`
  ADD CONSTRAINT `fk_rm_shtat_1` FOREIGN KEY (`IDBUDKONT`) REFERENCES `us_budkont` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rm_shtat_2` FOREIGN KEY (`IDLAVOZIM`) REFERENCES `us_lavozim` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rm_shtat_3` FOREIGN KEY (`IDUNVON`) REFERENCES `us_ilmunvon` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rm_shtat_4` FOREIGN KEY (`IDDARAJA`) REFERENCES `us_ilmdaraja` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rm_shtat_5` FOREIGN KEY (`IDORG`) REFERENCES `us_org` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rm_shtat_6` FOREIGN KEY (`IDMARKAZ`) REFERENCES `us_markaz` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rm_shtat_7` FOREIGN KEY (`IDRAZRYAD`) REFERENCES `us_razryad` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rm_shtat_8` FOREIGN KEY (`IDBULUM`) REFERENCES `us_bulim` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rm_shtat_9` FOREIGN KEY (`IDUSTAMA`) REFERENCES `us_ustama` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ud_mainmenu`
--
ALTER TABLE `ud_mainmenu`
  ADD CONSTRAINT `fk_ud_mainmenu_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ud_mainmenu_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_budkont`
--
ALTER TABLE `us_budkont`
  ADD CONSTRAINT `fk_us_budkont_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_budkont_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_bulim`
--
ALTER TABLE `us_bulim`
  ADD CONSTRAINT `fk_us_bulim_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_bulim_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_bulim_3` FOREIGN KEY (`IDORG`) REFERENCES `us_org` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_faculity`
--
ALTER TABLE `us_faculity`
  ADD CONSTRAINT `fk_us_faculity_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_faculity_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_faculity_3` FOREIGN KEY (`IDORG`) REFERENCES `us_org` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_ilmdaraja`
--
ALTER TABLE `us_ilmdaraja`
  ADD CONSTRAINT `fk_us_ilmdaraja_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_ilmdaraja_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_ilmunvon`
--
ALTER TABLE `us_ilmunvon`
  ADD CONSTRAINT `fk_us_ilmunvon_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_ilmunvon_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_lavozim`
--
ALTER TABLE `us_lavozim`
  ADD CONSTRAINT `fk_us_lavozim_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_lavozim_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_lavozim_3` FOREIGN KEY (`IDORG`) REFERENCES `us_org` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_lavozim_4` FOREIGN KEY (`IDMARKAZ`) REFERENCES `us_markaz` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_lavozim_5` FOREIGN KEY (`IDBULIM`) REFERENCES `us_bulim` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_markaz`
--
ALTER TABLE `us_markaz`
  ADD CONSTRAINT `fk_us_markaz_1` FOREIGN KEY (`IDILIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_markaz_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_markaz_3` FOREIGN KEY (`IDORG`) REFERENCES `us_org` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_ns10`
--
ALTER TABLE `us_ns10`
  ADD CONSTRAINT `fk_us_ns10_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_ns10_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_ns10_3` FOREIGN KEY (`IDREPUBLIC`) REFERENCES `us_republic` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_ns11`
--
ALTER TABLE `us_ns11`
  ADD CONSTRAINT `fk_us_ns11_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_ns11_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_org`
--
ALTER TABLE `us_org`
  ADD CONSTRAINT `fk_us_org_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_org_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_oylikosh`
--
ALTER TABLE `us_oylikosh`
  ADD CONSTRAINT `fk_us_oylikosh_1` FOREIGN KEY (`IDRAZRYAD`) REFERENCES `us_razryad` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_republic`
--
ALTER TABLE `us_republic`
  ADD CONSTRAINT `fk_us_republic_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_republic_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_status`
--
ALTER TABLE `us_status`
  ADD CONSTRAINT `fk_us_status_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_status_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_toifa`
--
ALTER TABLE `us_toifa`
  ADD CONSTRAINT `fk_us_toifa_1` FOREIGN KEY (`IDALIFBO`) REFERENCES `us_alifbo` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_us_toifa_2` FOREIGN KEY (`IDLANG`) REFERENCES `us_lang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `us_ustama`
--
ALTER TABLE `us_ustama`
  ADD CONSTRAINT `fk_us_ustama_1` FOREIGN KEY (`IDLAVOZIM`) REFERENCES `us_lavozim` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
