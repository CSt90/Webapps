-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 27 Ιαν 2019 στις 18:31:25
-- Έκδοση διακομιστή: 10.1.31-MariaDB
-- Έκδοση PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `systemdb`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `bus`
--

CREATE TABLE `bus` (
  `idBus` int(11) NOT NULL,
  `BName` varchar(6) NOT NULL,
  `Seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `bus`
--

INSERT INTO `bus` (`idBus`, `BName`, `Seats`) VALUES
(103, '55', 55),
(104, '50', 50),
(105, '55(2)', 55),
(113, '49', 49),
(114, '55(3)', 55),
(115, '49(2)', 49),
(116, '75', 75),
(120, '30', 30),
(121, '40', 40);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `bus_assignment`
--

CREATE TABLE `bus_assignment` (
  `AssignmentID` int(11) NOT NULL,
  `ExcursionID` int(5) NOT NULL,
  `ExcursionDate` date NOT NULL,
  `BusID` int(11) NOT NULL,
  `Drivers` varchar(60) DEFAULT NULL,
  `Guides` varchar(60) DEFAULT NULL,
  `BANotes` text,
  `Assigned` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `bus_assignment`
--

INSERT INTO `bus_assignment` (`AssignmentID`, `ExcursionID`, `ExcursionDate`, `BusID`, `Drivers`, `Guides`, `BANotes`, `Assigned`) VALUES
(13, 9, '2016-11-30', 107, NULL, NULL, NULL, 0),
(14, 1, '2016-11-23', 107, NULL, NULL, NULL, 0),
(29, 1, '2017-05-31', 106, NULL, NULL, NULL, 0),
(33, 6, '2017-05-26', 106, NULL, NULL, NULL, 0),
(40, 8, '2017-06-08', 105, NULL, NULL, NULL, 0),
(41, 8, '2017-06-08', 113, NULL, NULL, NULL, 0),
(42, 5, '2017-06-08', 113, NULL, NULL, NULL, 0),
(43, 14, '2017-06-06', 105, 'Mike', 'Lisa, George', 'Stop at the gas station', 0),
(44, 3, '2017-07-16', 118, NULL, NULL, NULL, 0),
(45, 16, '2017-07-16', 113, NULL, NULL, NULL, 0),
(46, 3, '2017-10-18', 105, NULL, NULL, NULL, 0),
(48, 16, '2017-10-18', 105, NULL, NULL, NULL, 0),
(52, 13, '2017-10-20', 113, 'κλκσ', 'jkjjslla', 'j', 0),
(65, 16, '2017-10-20', 0, 'κξκδδδδ', 'jkjjslla', 'nnmkalkklaa', 0),
(66, 13, '2017-10-27', 0, NULL, 'nmm', NULL, 0),
(67, 16, '2017-10-27', 0, NULL, 'mcnxxm', NULL, 0),
(68, 14, '2017-10-28', 0, NULL, 'jjkks', NULL, 0),
(70, 16, '2017-10-20', 105, NULL, NULL, NULL, 0),
(72, 14, '2017-06-20', 104, NULL, NULL, NULL, 0),
(73, 20, '2017-06-20', 104, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `driver`
--

CREATE TABLE `driver` (
  `idDriver` int(11) NOT NULL,
  `DName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `driver`
--

INSERT INTO `driver` (`idDriver`, `DName`) VALUES
(1, 'Driver 1'),
(2, 'Driver 2'),
(3, 'Driver 3'),
(4, 'Drv 6');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `excursion`
--

CREATE TABLE `excursion` (
  `idExcursion` int(11) NOT NULL,
  `EName` varchar(45) DEFAULT NULL,
  `Edate` date DEFAULT NULL,
  `Mon` int(11) NOT NULL DEFAULT '0',
  `Tue` int(11) NOT NULL DEFAULT '0',
  `Wed` int(11) NOT NULL DEFAULT '0',
  `Thu` int(11) NOT NULL DEFAULT '0',
  `Fri` int(11) NOT NULL DEFAULT '0',
  `Sat` int(11) NOT NULL DEFAULT '0',
  `Sun` int(11) NOT NULL DEFAULT '0',
  `StartTime` time DEFAULT '00:00:00',
  `EndTime` time DEFAULT '00:00:00',
  `EPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `excursion`
--

INSERT INTO `excursion` (`idExcursion`, `EName`, `Edate`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`, `Sun`, `StartTime`, `EndTime`, `EPrice`) VALUES
(3, 'Excursion 1', '0000-00-00', 0, 0, 1, 0, 0, 0, 1, '07:30:00', '20:30:00', '29.00'),
(5, '}_Excursion 2 Res_{', '0000-00-00', 0, 0, 0, 1, 0, 0, 0, '09:00:00', '18:00:00', '26.00'),
(8, 'Excursion 3', '0000-00-00', 1, 0, 0, 1, 0, 0, 0, '08:00:00', '17:00:00', '30.00'),
(13, 'Excursion 13', '0000-00-00', 0, 0, 0, 0, 1, 0, 0, '17:30:00', '23:00:00', '18.00'),
(14, 'Excursion 5 Res', '0000-00-00', 0, 1, 0, 0, 0, 1, 0, '07:30:00', '18:15:00', '30.00'),
(17, 'Margarites - Matala - Ag. Galini', NULL, 0, 0, 1, 0, 0, 0, 0, '00:00:00', '00:00:00', '20.00'),
(18, 'Excursion 55', NULL, 0, 1, 0, 0, 0, 1, 0, '07:00:00', '20:00:00', '30.00'),
(19, 'Excursion 555', NULL, 1, 0, 0, 0, 0, 0, 0, '08:00:00', '18:00:00', '20.00');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `guide`
--

CREATE TABLE `guide` (
  `idGuide` int(11) NOT NULL,
  `GName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `guide`
--

INSERT INTO `guide` (`idGuide`, `GName`) VALUES
(1, 'Guide1'),
(2, 'Guide2');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `hotel`
--

CREATE TABLE `hotel` (
  `idHotel` int(11) NOT NULL,
  `HArea` varchar(40) DEFAULT NULL,
  `HName` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `HPhone` varchar(18) DEFAULT NULL,
  `HRow` int(11) DEFAULT NULL,
  `HTime` varchar(8) NOT NULL,
  `HTqueue` int(11) NOT NULL,
  `PPWest` int(11) DEFAULT NULL,
  `PPEast` int(11) DEFAULT NULL,
  `notes` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `hotel`
--

INSERT INTO `hotel` (`idHotel`, `HArea`, `HName`, `HPhone`, `HRow`, `HTime`, `HTqueue`, `PPWest`, `PPEast`, `notes`) VALUES
(25400, 'ΡΕΘΥΜΝΟ', 'Private (City)', '', 134, '', 3, 0, 0, ''),
(25500, 'ΡΕΘΥΜΝΟ', 'Private (Outside)', '', 135, '', 3, 0, 0, ''),
(530003, 'ΜΠΑΛΙ', 'Bali Beach & Village', '2834094210', 1, '5:30:00', 3, 50, 50, ''),
(530005, 'Ρέθυμνο', 'New Hotel 1', '', 0, '5:35:00', 5, 50, 50, 'Some note'),
(530013, 'ΜΠΑΛΙ', 'Bali Mare', '2834094375', 1, '5:30:01', 3, 50, 50, ''),
(530023, 'ΜΠΑΛΙ', 'Ormos Atalia Aparthotel', '2834094401', 1, '5:30:02', 3, 50, 50, ''),
(530033, 'ΜΠΑΛΙ', 'Bali Paradise', '2834094253', 1, '5:30:03', 3, 50, 50, ''),
(530043, 'ΜΠΑΛΙ', 'Bali Star', '2834094212', 1, '5:30:04', 3, 20, 20, ''),
(530053, 'ΜΠΑΛΙ', 'Amalia Apartments', '2834094212', 1, '5:30:05', 3, 50, 50, ''),
(530063, 'ΜΠΑΛΙ', 'Lisa Mari Beach', '2834094073', 1, '5:30:06', 3, 30, 30, ''),
(530073, 'ΜΠΑΛΙ', 'Talea Beach', '', 1, '5:30:07', 3, 40, 40, ''),
(530083, 'ΜΠΑΛΙ', 'Aparthotel Sofia - Mythos Beach', '2834094450', 1, '5:30:08', 3, 50, 50, ''),
(530093, 'ΜΠΑΛΙ', 'Xidas Garden', '2834094269', 1, '5:30:09', 3, 50, 50, ''),
(530103, 'ΜΠΑΛΙ', 'Bella Vista', '2834094032', 1, '5:30:10', 3, 50, 50, ''),
(530113, 'ΜΠΑΛΙ', 'Blue Horizon', '2834094004', 1, '5:30:11', 3, 50, 50, ''),
(530123, 'ΜΠΑΛΙ', 'Carpe Diem', '2834022491', 1, '5:30:12', 3, 50, 50, ''),
(530133, 'ΜΠΑΛΙ', 'Elpis Studios & Apartments', '2834094444', 1, '5:30:13', 3, 50, 50, ''),
(530143, 'ΜΠΑΛΙ', 'Troulis', '2834094289', 1, '5:30:14', 3, 50, 50, ''),
(550003, 'ΠΑΝΟΡΜΟΣ', 'Iliana Hotel Apartments', '2834051447', 2, '5:50:00', 3, 60, 60, ''),
(550013, 'ΠΑΝΟΡΜΟΣ', 'Kirki Village', '2834051225', 2, '5:50:01', 3, 60, 60, ''),
(550023, 'ΠΑΝΟΡΜΟΣ', 'Panormo Beach', '2834051209', 2, '5:50:02', 3, 60, 60, ''),
(550033, 'ΠΑΝΟΡΜΟΣ', 'Philoxenia Apartments', '2834051481', 2, '5:50:03', 3, 60, 60, ''),
(550043, 'ΠΑΝΟΡΜΟΣ', 'Stella Beach', '2834051481', 2, '5:50:04', 3, 60, 60, ''),
(550053, 'ΠΑΝΟΡΜΟΣ', 'Marine Palace', '2834051610', 4, '5:50:05', 3, 70, 70, ''),
(550063, 'ΠΑΝΟΡΜΟΣ', 'Europa Resort', '2834020200', 5, '5:50:06', 3, 70, 70, ''),
(550073, 'ΠΑΝΟΡΜΟΣ', 'Sensimar Royal Blue Resort & Spa', '2834055000', 6, '5:50:07', 3, 70, 70, ''),
(550083, 'ΠΑΝΟΡΜΟΣ', 'Creta Marine', '2834051290', 7, '5:50:08', 3, 80, 80, ''),
(550093, 'ΠΑΝΟΡΜΟΣ', 'Creta Panorama', '2834051502', 7, '5:50:09', 3, 90, 90, ''),
(600003, 'ΣΚΑΛΕΤΑ', 'Oasis', '2831071774', 8, '6:00:00', 3, 100, 105, ''),
(600013, 'ΣΚΑΛΕΤΑ', 'Begeti Bay', '2831071909', 8, '6:00:01', 3, 100, 105, ''),
(600023, 'ΣΚΑΛΕΤΑ', 'Prinos Resort', '2831072414', 9, '6:00:02', 3, 100, 105, ''),
(600033, 'ΣΚΑΛΕΤΑ', 'Rethymno Mare Royal', '2831071703', 9, '6:00:03', 3, 100, 105, ''),
(600043, 'ΣΚΑΛΕΤΑ', 'Babis', '2831071193', 10, '6:00:04', 3, 100, 105, ''),
(600053, 'ΣΚΑΛΕΤΑ', 'Scaleta Beach', '2831071702', 11, '6:00:05', 3, 100, 105, ''),
(600063, 'ΣΚΑΛΕΤΑ', 'Creta Royal', '2831071812', 11, '6:00:06', 3, 110, 110, ''),
(600073, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Stavromenos Villas', '2831071053', 11, '6:00:07', 3, 110, 110, ''),
(600083, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Creta Star', '2831071812', 11, '6:00:08', 3, 110, 110, ''),
(600093, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Corali Beach', '2831071967', 11, '6:00:09', 3, 120, 120, ''),
(600103, 'ΣΦΑΚΑΚΙ', 'Krini Beach', '2831072903', 11, '6:00:10', 3, 120, 120, ''),
(600113, 'ΣΚΑΛΕΤΑ', 'Gortyna', '2831071846', 12, '6:00:11', 3, 120, 120, ''),
(600123, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Yannis Aparthotel', '', 13, '6:00:12', 3, 120, 120, ''),
(600133, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Thalassi', '2831071990', 14, '6:00:13', 3, 120, 120, ''),
(600143, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Nautica', '2831055577', 14, '6:00:14', 3, 120, 120, ''),
(600153, 'ΠΑΓΚΑΛΟΧΩΡΙ', 'Alkionis', '2831071584', 15, '6:00:15', 3, 120, 120, ''),
(600163, 'ΠΑΓΚΑΛΟΧΩΡΙ', 'Almyra Apartments', '2831074675', 15, '6:00:16', 3, 120, 120, ''),
(600173, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Agelia Beach', '2831072032', 16, '6:00:17', 3, 130, 130, ''),
(600183, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Ekavi Beach', '2831071896', 16, '6:00:18', 3, 130, 130, ''),
(600193, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Dedalos Beach', '2831073035', 16, '6:00:19', 3, 130, 130, ''),
(600203, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Golden Sand Boutique', '2831072032', 16, '6:00:20', 3, 130, 130, ''),
(600213, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Danaos Beach', '2831073025', 17, '6:00:21', 3, 130, 130, ''),
(600223, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Rosebay Apartments', '2831054413', 17, '6:00:22', 3, 130, 130, ''),
(600233, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Chrisanna Apartments & Studios', '2831071195', 17, '6:00:23', 3, 130, 130, ''),
(600243, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Sunrise Hotel Apartments', '2834022791', 17, '6:00:24', 3, 130, 130, ''),
(600253, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Radamanthys Apartments', '2931072691', 17, '6:00:25', 3, 130, 130, ''),
(610003, 'ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ', 'Amnissos', '2831072460', 18, '6:10:00', 3, 140, 140, ''),
(610013, 'ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ', 'White Palace', '2831071102', 19, '6:10:01', 3, 150, 150, ''),
(610023, 'ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ', 'Limas', '2831072257', 19, '6:10:02', 3, 150, 150, ''),
(610033, 'ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ', 'Keti (Kaiti) Apartments', '2831051480', 19, '6:10:03', 3, 150, 150, ''),
(610043, 'ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ', 'Alkyon', '2831071136', 19, '6:10:04', 3, 150, 150, ''),
(610053, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Maravel', '2831072916', 21, '6:10:05', 3, 160, 160, ''),
(610063, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Dias', '2831071017', 22, '6:10:06', 3, 170, 170, ''),
(610073, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Solimar Dias', '2831071177', 22, '6:10:07', 3, 170, 170, ''),
(610083, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Blue sky', '2831057560', 23, '6:10:08', 3, 170, 170, ''),
(610093, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Rethymno Palace', '2831072418', 24, '6:10:09', 3, 180, 180, ''),
(610103, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Jo An Beach', '2831024241', 25, '6:10:10', 3, 200, 200, ''),
(610113, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Seafront Apartments', '2831072600', 25, '6:10:11', 3, 190, 190, ''),
(610123, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Stella Katrin', '2831021690', 26, '6:10:12', 3, 190, 190, ''),
(610133, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Maravel Land', '2831071063', 27, '6:10:13', 3, 210, 210, ''),
(610143, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Caramel', '2831071803', 28, '6:10:14', 3, 220, 220, ''),
(610153, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Rethymno Residence', '2831072633', 29, '6:10:15', 3, 230, 230, ''),
(615003, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Rithymna Beach', '2831071002', 30, '6:15:00', 3, 240, 240, ''),
(615013, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Orion', '2831071471', 31, '6:15:01', 3, 250, 250, ''),
(615023, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Eva Bay', '2831020760', 32, '6:15:02', 3, 270, 270, ''),
(615033, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Adele Beach', '2831071081', 33, '6:15:03', 3, 280, 280, ''),
(615043, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Christina Apartments', '', 34, '6:15:04', 3, 300, 300, ''),
(615053, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Galeana Mare', '2831073006', 34, '6:15:05', 3, 290, 290, ''),
(615063, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Palladion', '2831028976', 35, '6:15:06', 3, 310, 310, ''),
(615073, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Golden Beach', '2831071012', 36, '6:15:07', 3, 320, 320, ''),
(615083, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Kathrin Beach', '2831071757', 37, '6:15:08', 3, 330, 330, ''),
(615093, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Edem Beach', '2831073963', 38, '6:15:09', 3, 350, 350, ''),
(620003, 'ΠΛΑΤΑΝΕΣ', 'Rethymno Village', '2831025523', 39, '6:20:00', 3, 360, 360, ''),
(620013, 'ΠΛΑΤΑΝΕΣ', 'Leoniki Residence', '2831029232', 40, '6:20:01', 3, 370, 370, ''),
(620023, 'ΠΛΑΤΑΝΕΣ', 'Cretan Sun', '2831027077', 41, '6:20:02', 3, 370, 370, ''),
(620033, 'ΠΛΑΤΑΝΕΣ', 'Marinos Beach', '2831027840', 42, '6:20:03', 3, 390, 390, ''),
(620043, 'ΠΛΑΤΑΝΕΣ', 'Galeana Beach', '2831051141', 43, '6:20:04', 3, 380, 380, ''),
(620053, 'ΠΛΑΤΑΝΕΣ', 'Axos', '2831020472', 44, '6:20:05', 3, 400, 400, ''),
(620063, 'ΠΛΑΤΑΝΕΣ', 'Castello Bianco', '831020029', 45, '6:20:06', 3, 410, 410, ''),
(620073, 'ΠΛΑΤΑΝΙΑΣ', 'Apollon', '2831050300', 46, '6:20:07', 3, 410, 410, ''),
(620083, 'ΠΛΑΤΑΝΙΑΣ', 'Creta Residence', '', 47, '6:20:08', 3, 440, 440, ''),
(620093, 'ΠΛΑΤΑΝΙΑΣ', 'Minos Mare', '', 47, '6:20:09', 3, 440, 440, ''),
(620103, 'ΠΛΑΤΑΝΕΣ', 'Nefeli', '2831055321', 47, '6:20:10', 3, 410, 410, ''),
(620113, 'ΠΛΑΤΑΝΕΣ', 'La Stella', '2831027545', 49, '6:20:11', 3, 440, 440, ''),
(620123, 'ΠΛΑΤΑΝΕΣ', 'Evelin', '', 49, '6:20:12', 3, 440, 440, ''),
(620133, 'ΠΛΑΤΑΝΕΣ', 'Creta Sun', '', 49, '6:20:13', 3, 440, 440, ''),
(620143, 'ΠΛΑΤΑΝΕΣ', 'Trefon', '2831024772', 50, '6:20:14', 3, 420, 420, ''),
(620153, 'ΠΛΑΤΑΝΕΣ', 'Bella Casita', '2831025552', 48, '6:20:15', 3, 420, 420, ''),
(620163, 'ΠΛΑΤΑΝΕΣ', 'Amaril', '2831056665', 50, '6:20:16', 3, 420, 420, ''),
(620173, 'ΠΛΑΤΑΝΕΣ', 'Varvaras Diamond', '2831035474', 50, '6:20:17', 3, 420, 420, ''),
(620183, 'ΠΛΑΤΑΝΕΣ', 'Bueno', '2831025554', 50, '6:20:18', 3, 420, 420, ''),
(620193, 'ΠΛΑΤΑΝΕΣ', 'Mary Hotel', '2831021402', 51, '6:20:19', 3, 440, 440, ''),
(620203, 'ΠΛΑΤΑΝΙΑΣ', 'Julia Apartments', '2831025566', 52, '6:20:20', 3, 440, 440, ''),
(620213, 'ΠΛΑΤΑΝΙΑΣ', 'Minos Mare Royal', '2831050388', 53, '6:20:21', 3, 420, 420, ''),
(620223, 'ΠΛΑΤΑΝΙΑΣ', 'Marianthi Apartments', '2831055625', 54, '6:20:22', 3, 440, 440, ''),
(625003, 'ΡΕΘΥΜΝΟ', 'Mantenia', '283155169', 55, '6:25:00', 3, 450, 450, ''),
(625013, 'ΜΥΣΣΙΡΙΑ', 'May', '2831055745', 55, '6:25:01', 3, 460, 460, ''),
(625023, 'ΜΥΣΣΙΡΙΑ', 'Creta Palace', '2831021181', 56, '6:25:02', 3, 470, 470, 'main road'),
(625033, 'ΜΥΣΣΙΡΙΑ', 'Chrissas Apartments', '2831023372', 57, '6:25:03', 3, 470, 470, 'main road'),
(625043, 'ΜΥΣΣΙΡΙΑ', 'Athina Rent Rooms Restaurant', '2831024717', 58, '6:25:04', 3, 480, 480, ''),
(625053, 'ΜΥΣΣΙΡΙΑ', 'Camping Elizabeth', '2831028694', 59, '6:25:05', 3, 480, 480, ''),
(625063, 'ΜΥΣΣΙΡΙΑ', 'Missiria Apartments', '2831025576', 60, '6:25:06', 3, 500, 500, ''),
(625073, 'ΜΥΣΣΙΡΙΑ', 'Anna Apartments', '', 61, '6:25:07', 3, 490, 490, ''),
(625083, 'ΜΥΣΣΙΡΙΑ', 'Dimitrios Village', '2831025647', 62, '6:25:08', 3, 510, 510, ''),
(625093, 'ΜΥΣΣΙΡΙΑ', 'Odyssia Beach', '2831027874', 62, '6:25:09', 3, 510, 510, ''),
(625103, 'ΜΥΣΣΙΡΙΑ', 'Omiros Boutique', '2831027874', 63, '6:25:10', 3, 510, 510, ''),
(625113, 'ΜΥΣΣΙΡΙΑ', 'Ilian Beach', '2831027205', 64, '6:25:11', 3, 510, 510, ''),
(625123, 'ΜΥΣΣΙΡΙΑ', 'Domenica', '2831027362', 64, '6:25:12', 3, 510, 510, ''),
(625133, 'ΡΕΘΥΜΝΟ', 'Aristea', '2831035358', 65, '6:25:13', 3, 510, 510, ''),
(630003, 'ΠΕΡΙΒΟΛΙΑ', 'Dimitrios Beach', '2831056660', 66, '6:30:00', 3, 520, 515, ''),
(630013, 'ΡΕΘΥΜΝΟ', 'Anita Beach', '', 66, '6:30:01', 3, 530, 515, ''),
(630023, 'ΡΕΘΥΜΝΟ', 'Iperion Beach', '2831053765', 67, '6:30:02', 3, 540, 565, ''),
(630033, 'ΠΕΡΙΒΟΛΙΑ', 'Pearl Beach', '2831020891', 67, '6:30:03', 3, 540, 565, ''),
(630043, 'ΜΥΣΣΙΡΙΑ', 'Esperia', '2831021271', 68, '6:30:04', 3, 540, 565, ''),
(630053, 'ΠΕΡΙΒΟΛΙΑ', 'Aegean Pearl', '2831023733', 69, '6:30:05', 3, 540, 565, ''),
(630063, 'ΠΕΡΙΒΟΛΙΑ', 'Plaza Spa', '2831051505', 70, '6:30:06', 3, 550, 550, ''),
(630073, 'ΠΕΡΙΒΟΛΙΑ', 'Yacinthos', '2831023635', 71, '6:30:07', 3, 550, 550, ''),
(630083, 'ΠΕΡΙΒΟΛΙΑ', 'Olympic II', '2831024761', 72, '6:30:08', 3, 560, 560, ''),
(630093, 'ΠΕΡΙΒΟΛΙΑ', 'Summer Dream', '2831051174', 73, '6:30:09', 3, 580, 580, ''),
(630103, 'ΠΕΡΙΒΟΛΙΑ', 'Melitti', '2831056696', 73, '6:30:10', 3, 570, 570, ''),
(630113, 'ΠΕΡΙΒΟΛΙΑ', 'Golden Coast', '2831021444', 74, '6:30:11', 3, 580, 580, ''),
(630123, 'ΠΕΡΙΒΟΛΙΑ', 'Flisvos Beach', '2831026784', 75, '6:30:12', 3, 570, 570, ''),
(630133, 'ΠΕΡΙΒΟΛΙΑ', 'Erato Hotel Apartments', '2831026913', 75, '6:30:13', 3, 580, 580, ''),
(630143, 'ΠΕΡΙΒΟΛΙΑ', 'Marilyn Apartments', '2831055247', 76, '6:30:14', 3, 580, 580, ''),
(630153, 'ΠΕΡΙΒΟΛΙΑ', 'Zannis', '2831035363', 76, '6:30:15', 3, 580, 580, ''),
(630163, 'ΠΕΡΙΒΟΛΙΑ', 'Daisy', '2831050001', 77, '6:30:16', 3, 610, 610, ''),
(630173, 'ΠΕΡΙΒΟΛΙΑ', 'Olympia', '2831029815', 77, '6:30:17', 3, 610, 610, ''),
(630183, 'ΠΕΡΙΒΟΛΙΑ', 'Fouli Studios & Apartments', '2831026956', 77, '6:30:18', 3, 610, 610, ''),
(630193, 'ΠΕΡΙΒΟΛΙΑ', 'Blue Sky Apartments', '2831057560', 78, '6:30:19', 3, 610, 610, ''),
(630203, 'ΡΕΘΥΜΝΟ', 'Atlantis Beach', '2831051002', 79, '6:30:20', 3, 618, 618, ''),
(630213, 'ΡΕΘΥΜΝΟ', 'Marel', '2831053463', 80, '6:30:21', 3, 600, 600, ''),
(630223, 'ΡΕΘΥΜΝΟ', 'Eltina', '2831055231', 81, '6:30:22', 3, 660, 660, ''),
(630233, 'ΡΕΘΥΜΝΟ', 'Family Homes Zaharias', '2831028584', 82, '6:30:23', 3, 630, 630, ''),
(630243, 'ΡΕΘΥΜΝΟ', 'Aris Apartments', '2831025867', 83, '6:30:24', 3, 630, 630, ''),
(630253, 'ΠΕΡΙΒΟΛΙΑ', 'Blue Sea Apartments', '2831054804', 83, '6:30:25', 3, 630, 630, ''),
(630263, 'ΠΕΡΙΒΟΛΙΑ', 'Melmar', '2831054908', 83, '6:30:26', 3, 660, 648, ''),
(630273, 'ΠΕΡΙΒΟΛΙΑ', 'Ibiscos Garden', '2831051112', 83, '6:30:27', 3, 660, 648, ''),
(630283, 'ΠΕΡΙΒΟΛΙΑ', 'Zantina', '2831024863', 84, '6:30:28', 3, 620, 620, ''),
(630293, 'ΡΕΘΥΜΝΟ', 'Batis', '2831050558', 85, '6:30:29', 3, 640, 640, ''),
(630303, 'ΡΕΘΥΜΝΟ', 'Ammos Studios', '2831036123', 86, '6:30:30', 3, 620, 620, ''),
(635003, 'ΡΕΘΥΜΝΟ', 'Ostria', '2831027705', 87, '6:35:00', 3, 650, 650, ''),
(635013, 'ΡΕΘΥΜΝΟ', 'Medusa', '2831027937', 88, '6:35:01', 3, 650, 650, ''),
(635023, 'ΠΕΡΙΒΟΛΙΑ', 'Minos', '2831053921', 89, '6:35:02', 3, 660, 648, ''),
(635033, 'ΡΕΘΥΜΝΟ', 'Atrium', '2831057601', 90, '6:35:03', 3, 670, 646, ''),
(635043, 'ΡΕΘΥΜΝΟ', 'Lefkoniko Bay', '2831025495', 90, '6:35:04', 3, 680, 643, ''),
(635053, 'ΚΑΛΛΙΘΕΑ', 'Lefkoniko Beach', '2831055326', 90, '6:35:05', 3, 680, 643, ''),
(635063, 'ΡΕΘΥΜΝΟ', 'Theartemis Palace', '2831053991', 90, '6:35:06', 3, 670, 646, ''),
(635073, 'ΡΕΘΥΜΝΟ', 'Bella Mare', '2831035494', 91, '6:35:07', 3, 680, 643, ''),
(635083, 'ΡΕΘΥΜΝΟ', 'Kleoniki Mare', '2831040699', 91, '6:35:08', 3, 680, 643, ''),
(640003, 'ΡΕΘΥΜΝΟ', 'Swell Boutique', '2831050110', 91, '6:40:00', 3, 690, 690, ''),
(640013, 'ΡΕΘΥΜΝΟ', 'Palm Beach Hotel Apartments', '2831025597', 92, '6:40:01', 3, 720, 720, ''),
(640023, 'ΡΕΘΥΜΝΟ', 'Aloe Apartments', '2831025450', 92, '6:40:02', 3, 720, 720, ''),
(640033, 'ΡΕΘΥΜΝΟ', 'Steris Beach', '2831028303', 93, '6:40:03', 3, 720, 720, ''),
(640043, 'ΡΕΘΥΜΝΟ', 'Leonidas Hotel & Apartments', '2831051754', 94, '6:40:04', 3, 720, 720, ''),
(640053, 'ΡΕΘΥΜΝΟ', 'Birais', '2831055529', 94, '6:40:05', 3, 720, 720, ''),
(640063, 'ΡΕΘΥΜΝΟ', 'Theo', '2831050187', 95, '6:40:06', 3, 700, 700, ''),
(640073, 'ΡΕΘΥΜΝΟ', 'Poseidon', '2831023795', 95, '6:40:07', 3, 700, 700, ''),
(640083, 'ΡΕΘΥΜΝΟ', 'Pegasus', '2831025530', 96, '6:40:08', 3, 700, 700, ''),
(640093, 'ΡΕΘΥΜΝΟ', 'Bio Suites', '283158403', 97, '6:40:09', 3, 730, 730, ''),
(640103, 'ΡΕΘΥΜΝΟ', 'Porto Rethymno', '2831050432', 97, '6:40:10', 3, 730, 730, ''),
(640113, 'ΡΕΘΥΜΝΟ', 'Ilios Beach Hotel Apartments', '2831055672', 98, '6:40:11', 3, 730, 730, ''),
(640123, 'ΡΕΘΥΜΝΟ', 'Kriti Beach', '2831027401', 99, '6:40:12', 3, 750, 750, ''),
(640133, 'ΡΕΘΥΜΝΟ', 'The Sea View Apartments', '2831024533', 100, '6:40:13', 3, 750, 750, ''),
(640143, 'ΡΕΘΥΜΝΟ', 'Cosmos', '2831052244', 100, '6:40:14', 3, 760, 760, ''),
(640153, 'ΡΕΘΥΜΝΟ', 'Aqua Marina', '2831035340', 100, '6:40:15', 3, 760, 760, ''),
(640163, 'ΡΕΘΥΜΝΟ', 'Astali', '2831024721', 101, '6:40:16', 3, 770, 770, ''),
(640173, 'ΡΕΘΥΜΝΟ', 'Elina Hotel Apartments', '2831027395', 101, '6:40:17', 3, 770, 770, ''),
(640183, 'ΡΕΘΥΜΝΟ', 'Achillion Palace', '2831051502', 102, '6:40:18', 3, 770, 770, ''),
(640193, 'ΡΕΘΥΜΝΟ', 'Jason', '2831022542', 102, '6:40:19', 3, 760, 760, ''),
(640203, 'ΡΕΘΥΜΝΟ', 'Constantin', '2831020221', 102, '6:40:20', 3, 760, 760, ''),
(640213, 'ΡΕΘΥΜΝΟ', 'Kyma Beach', '2831055503', 103, '6:40:21', 3, 760, 760, ''),
(645003, 'ΕΥΛΗΓΙΑ', 'Forest Park', '2831051778', 101, '6:45:00', 3, 760, 760, ''),
(645013, 'ΡΕΘΥΜΝΟ', 'Liberty', '2831055851', 104, '6:45:01', 3, 790, 795, ''),
(645023, 'ΡΕΘΥΜΝΟ', 'Olympic Palladium', '2831024762', 104, '6:45:02', 3, 790, 795, ''),
(645033, 'ΡΕΘΥΜΝΟ', 'Brascos', '2831023721', 105, '6:45:03', 3, 800, 805, ''),
(645043, 'ΡΕΘΥΜΝΟ', 'Jo-An', '2831024241', 106, '6:45:04', 3, 800, 805, ''),
(645053, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Afroditi Suites', '2831022246', 107, '6:45:05', 3, 800, 805, ''),
(645063, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Casa De Delfini', '2831055120', 107, '6:45:06', 3, 800, 805, ''),
(645073, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Casa Vitae', '2831035058', 107, '6:45:07', 3, 800, 805, ''),
(645083, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Leo Hotel', '2831026197', 107, '6:45:08', 3, 800, 805, ''),
(645093, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Vetera Suites', '2831023844', 107, '6:45:09', 3, 800, 805, ''),
(645103, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Youth Hostel', '2831022848', 107, '6:45:10', 3, 800, 805, ''),
(645113, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Bellagio Luxury Boutique', '2831055777', 107, '6:45:11', 3, 800, 805, ''),
(645123, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Civitas Boutique', '2831035127', 107, '6:45:12', 3, 800, 805, ''),
(645133, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Mythos Suites', '2831053917', 107, '6:45:13', 3, 800, 805, ''),
(645143, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Rethymno House', '2831023924', 107, '6:45:14', 3, 800, 805, ''),
(645153, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Pepi Studios', '2831026428', 107, '6:45:15', 3, 800, 805, ''),
(645163, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Anna\\\'s Apartments (Old Town)', '2831052951', 107, '6:45:16', 3, 800, 805, ''),
(645173, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Rimondi Boutique', '2831051289', 107, '6:45:17', 3, 800, 805, ''),
(645183, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Palazzo Rimondi', '2831051001', 108, '6:45:18', 3, 800, 805, ''),
(645193, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Palazzino Di Corina', '2831021205', 108, '6:45:19', 3, 800, 805, ''),
(645203, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Palazzo Vecchio', '2831035351', 108, '6:45:20', 3, 800, 805, ''),
(645213, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'VECCHIO', '2831054985', 108, '6:45:21', 3, 800, 805, ''),
(645223, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Fortezza', '2831055551', 108, '6:45:22', 3, 800, 805, ''),
(645233, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Ideon', '2831028667', 108, '6:45:23', 3, 800, 805, ''),
(645243, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Barbara Studios', '2831022607', 108, '6:45:24', 3, 800, 805, ''),
(645253, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Sohora Boutique Hotel', '2831300913', 108, '6:45:25', 3, 800, 805, ''),
(645263, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Avli Lounge Apartments', '2831058250', 108, '6:45:26', 3, 800, 805, ''),
(645273, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Private (Old Town)', '', 108, '6:45:27', 3, 800, 805, ''),
(650003, 'ΡΕΘΥΜΝΟ', 'Belvedere', '2831026898', 109, '6:50:00', 3, 810, 810, ''),
(650013, 'ΡΕΘΥΜΝΟ', 'Archipelagos Residence', '2831054754', 110, '6:50:01', 3, 820, 820, ''),
(650023, 'ΡΕΘΥΜΝΟ', 'Macaris Suites & Spa', '2831054757', 110, '6:50:02', 3, 810, 810, ''),
(650033, 'ΡΕΘΥΜΝΟ', 'Creta Seafront Residences', '2831022208', 111, '6:50:03', 3, 830, 830, ''),
(650043, 'ΡΕΘΥΜΝΟ', 'Rethymno Hills', '2831057040', 112, '6:50:04', 3, 830, 830, ''),
(650053, 'ΡΕΘΥΜΝΟ', 'Filoxenia Beach', '2831055325', 113, '6:50:05', 3, 830, 830, ''),
(650063, 'ΡΕΘΥΜΝΟ', 'Petradi Beach Lounge', '2831055325', 114, '6:50:06', 3, 830, 830, ''),
(650073, 'ΚΟΥΜΠΕΣ', 'Delfini Beach (Koumpes)', '2831035245', 115, '6:50:07', 3, 840, 840, ''),
(650083, 'ΑΤΣΙΠΟΠΟΥΛΟ', 'Rethymno Panorama', '2831026250', 116, '6:50:08', 3, 850, 850, ''),
(650093, 'ΑΤΣΙΠΟΠΟΥΛΟ', 'Pantheon', '2831054914', 116, '6:50:09', 3, 850, 850, ''),
(705003, 'ΝΕΒΕΛΟ', 'Camari Garden', '2831031272', 117, '7:05:00', 3, 860, 860, ''),
(705013, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Hydramis Palace', '2831061000', 118, '7:05:01', 3, 870, 870, ''),
(705023, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Ermioni Beach', '2831061678', 119, '7:05:02', 3, 870, 870, ''),
(705033, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Poledas Apartments', '2831061062', 119, '7:05:03', 3, 870, 870, ''),
(705043, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Palladion (Kavros)', '2831061720', 119, '7:05:04', 3, 870, 870, ''),
(705053, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Anatoli Beach (Kavros)', '2825061001', 120, '7:05:05', 3, 880, 880, ''),
(705063, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Kavros Beach (Kavros)', '', 120, '7:05:06', 3, 880, 880, ''),
(705073, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Aquamar Beach (Kavros)', '2825061332', 120, '7:05:07', 3, 880, 880, ''),
(705083, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Silver Beach (Kavros)', '2825083078', 121, '7:05:08', 3, 890, 890, ''),
(705093, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Kournas Village (Kavros)', '2825061416', 121, '7:05:09', 3, 890, 890, ''),
(705103, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Happy Days (Kavros)', '2825061201', 122, '7:05:10', 3, 900, 900, ''),
(705113, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Sandy Beach (Kavros)', '2825061201', 122, '7:05:11', 3, 900, 900, ''),
(705123, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Orpheas Resort (Kavros)', '2825061218', 122, '7:05:12', 3, 900, 900, ''),
(705133, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Vantaris Beach (Kavros)', '2825061231', 123, '7:05:13', 3, 910, 910, ''),
(705143, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Delfina Art Resort (Kavros)', '2825061272', 123, '7:05:14', 3, 910, 910, ''),
(705153, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Apollo (Kavros)', '2825061100', 123, '7:05:15', 3, 910, 910, ''),
(705163, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Eliros Mare (Kavros)', '2825061181', 124, '7:05:16', 3, 910, 910, ''),
(705173, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Vantaris Palace (Kavros)', '2825061783', 125, '7:05:17', 3, 910, 910, ''),
(705183, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Delfina Beach (Kavros)', '2825061272', 126, '7:05:18', 3, 910, 910, ''),
(705193, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Mythos Palace Resort & Spa (Kavros)', '2825061713', 127, '7:05:19', 3, 910, 910, ''),
(705203, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Georgioupolis Resort (Kavros)', '2825061126', 128, '7:05:20', 3, 920, 920, ''),
(705213, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Anemos Luxury Grand Resort (Kavros)', '2825062550', 129, '7:05:21', 3, 920, 920, ''),
(705223, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Posidon Studios(Kavros)', '2825061160', 130, '7:05:22', 3, 920, 920, ''),
(705233, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Pilot Beach Resort (Kavros)', '2825061002', 131, '7:05:23', 3, 930, 930, ''),
(705243, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Mare Monte Beach (Kavros)', '2825061390', 132, '7:05:24', 3, 930, 930, ''),
(705253, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Kokalas Resort', '2825061293', 133, '7:05:25', 3, 940, 940, ''),
(705263, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Fereniki Resort & Spa', '2825061297', 133, '7:05:26', 3, 940, 940, ''),
(705273, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Corissia Princess', '2825083010', 133, '7:05:27', 3, 940, 940, ''),
(705283, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Corissia Beach', '2825083010', 133, '7:05:28', 3, 940, 940, ''),
(705293, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Georgioupolis Beach', '2825061056', 133, '7:05:29', 3, 940, 940, ''),
(705393, '', 'Erivolos', '', 0, '', 0, 0, 0, ''),
(705493, 'ΜΠΑΛΙ', 'Gold Apartments', '', 0, '5:30:00', 4, 50, 20, ''),
(705593, '', 'Ermis Apartments', '', 0, '', 0, 0, 0, ''),
(705693, '', 'Michael Apartments', '', 0, '', 0, 0, 0, ''),
(705793, '', 'Byzantine', '', 0, '', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `nationality`
--

CREATE TABLE `nationality` (
  `idNationality` int(11) NOT NULL,
  `Country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nat` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `nationality`
--

INSERT INTO `nationality` (`idNationality`, `Country`, `Nat`) VALUES
(1, 'Great Britain / United Kingdom', 'GBR'),
(2, 'Germany', 'GER'),
(3, 'France', 'FRA'),
(4, 'Russia', 'RUS'),
(5, 'Netherlands', 'NLD'),
(6, 'Austria', 'AUT'),
(7, 'Switzerland', 'CHE'),
(8, 'Norway', 'NOR'),
(9, 'Belgium', 'BEL'),
(10, 'Denmark', 'DNK'),
(11, 'Finland', 'FIN'),
(12, 'Sweden', 'SWE'),
(13, 'Hungary', 'HUN'),
(14, 'Italy', 'ITA'),
(15, 'Spain', 'ESP'),
(16, 'Poland', 'POL'),
(17, 'Portugal', 'PRT'),
(18, 'Afghanistan', 'AFG'),
(19, 'Aland Islands', 'ALA'),
(20, 'Albania', 'ALB'),
(21, 'Algeria', 'DZA'),
(22, 'American Samoa', 'ASM'),
(23, 'Andorra', 'AND'),
(24, 'Angola', 'AGO'),
(25, 'Anguilla', 'AIA'),
(26, 'Antigua and Barbuda', 'ATG'),
(27, 'Argentina', 'ARG'),
(28, 'Argentina', 'ARM'),
(29, 'Aruba', 'ABW'),
(30, 'Australia', 'AUS'),
(31, 'Azerbaijan', 'AZE'),
(32, 'Bahamas', 'BHS'),
(33, 'Bahrain', 'BHR'),
(34, 'Bangladesh', 'BGD'),
(35, 'Barbados', 'BRB'),
(36, 'Belarus', 'BLR'),
(37, 'Belize', 'BLZ'),
(38, 'Benin', 'BEN'),
(39, 'Bermuda', 'BMU'),
(40, 'Bhutan', 'BTN'),
(41, 'Bolivia', 'BOL'),
(42, 'Bosnia and Herzegovina', 'BIH'),
(43, 'Botswana', 'BWA'),
(44, 'Brazil', 'BRA'),
(45, 'British Virgin Islands', 'VGB'),
(46, 'Brunei Darussalam', 'BRN'),
(47, 'Bulgaria', 'BGR'),
(48, 'Burkina Faso', 'BFA'),
(49, 'Burundi', 'BDI'),
(50, 'Cambodia', 'KHM'),
(51, 'Cameroon', 'CMR'),
(52, 'Canada', 'CAN'),
(53, 'Cape Verde', 'CPV'),
(54, 'Cayman Islands', 'CYM'),
(55, 'Central African Republic', 'CAF'),
(56, 'Chad', 'TCD'),
(57, 'Chile', 'CHL'),
(58, 'China', 'CHN'),
(59, 'Hong Kong Special Administrati', 'HKG'),
(60, 'Macao Special Administrative R', 'MAC'),
(61, 'Colombia', 'COL'),
(62, 'Comoros', 'COM'),
(63, 'Congo', 'COG'),
(64, 'Cook Islands', 'COK'),
(65, 'Costa Rica', 'CRI'),
(66, 'Cote d\\\'Ivoire', 'CIV'),
(67, 'Croatia', 'HRV'),
(68, 'Cuba', 'CUB'),
(69, 'Cyprus', 'CYP'),
(70, 'Czech Republic', 'CZE'),
(71, 'Democratic People\\\'s Republic ', 'PRK'),
(72, 'Democratic Republic of the Con', 'COD'),
(73, 'Djibouti', 'DJI'),
(74, 'Dominica', 'DMA'),
(75, 'Dominican Republic', 'DOM'),
(76, 'Ecuador', 'ECU'),
(77, 'Egypt', 'EGY'),
(78, 'El Salvador', 'SLV'),
(79, 'Equatorial Guinea', 'GNQ'),
(80, 'Eritrea', 'ERI'),
(81, 'Estonia', 'EST'),
(82, 'Ethiopia', 'ETH'),
(83, 'Faeroe Islands', 'FRO'),
(84, 'Falkland Islands (Malvinas)', 'FLK'),
(85, 'Fiji', 'FJI'),
(86, 'French Guiana', 'GUF'),
(87, 'French Polynesia', 'PYF'),
(88, 'Gabon', 'GAB'),
(89, 'Gambia', 'GMB'),
(90, 'Georgia', 'GEO'),
(91, 'Ghana', 'GHA'),
(92, 'Gibraltar', 'GIB'),
(93, 'Greece', 'GRC'),
(94, 'Greenland', 'GRL'),
(95, 'Grenada', 'GRD'),
(96, 'Guadeloupe', 'GLP'),
(97, 'Guam', 'GUM'),
(98, 'Guatemala', 'GTM'),
(99, 'Guernsey', 'GGY'),
(100, 'Guinea', 'GIN'),
(101, 'Guinea-Bissau', 'GNB'),
(102, 'Guyana', 'GUY'),
(103, 'Haiti', 'HTI'),
(104, 'Holy See', 'VAT'),
(105, 'Honduras', 'HND'),
(106, 'Iceland', 'ISL'),
(107, 'India', 'IND'),
(108, 'Indonesia', 'IDN'),
(109, 'Iran, Islamic Republic of', 'IRN'),
(110, 'Iraq', 'IRQ'),
(111, 'Ireland', 'IRL'),
(112, 'Isle of Man', 'IMN'),
(113, 'Israel', 'ISR'),
(114, 'Jamaica', 'JAM'),
(115, 'Japan', 'JPN'),
(116, 'Jersey', 'JEY'),
(117, 'Jordan', 'JOR'),
(118, 'Kazakhstan', 'KAZ'),
(119, 'Kenya', 'KEN'),
(120, 'Kiribati', 'KIR'),
(121, 'Kuwait', 'KWT'),
(122, 'Kyrgyzstan', 'KGZ'),
(123, 'Lao People\\\'s Democratic Repub', 'LAO'),
(124, 'Latvia', 'LVA'),
(125, 'Lebanon', 'LBN'),
(126, 'Lesotho', 'LSO'),
(127, 'Liberia', 'LBR'),
(128, 'Libyan Arab Jamahiriya', 'LBY'),
(129, 'Liechtenstein', 'LIE'),
(130, 'Lithuania', 'LTU'),
(131, 'Luxembourg', 'LUX'),
(132, 'Madagascar', 'MDG'),
(133, 'Malawi', 'MWI'),
(134, 'Malaysia', 'MYS'),
(135, 'Maldives', 'MDV'),
(136, 'Mali', 'MLI'),
(137, 'Malta', 'MLT'),
(138, 'Marshall Islands', 'MHL'),
(139, 'Martinique', 'MTQ'),
(140, 'Mauritania', 'MRT'),
(141, 'Mauritius', 'MUS'),
(142, 'Mayotte', 'MYT'),
(143, 'Mexico', 'MEX'),
(144, 'Micronesia, Federated States o', 'FSM'),
(145, 'Moldova', 'MDA'),
(146, 'Monaco', 'MCO'),
(147, 'Mongolia', 'MNG'),
(148, 'Montenegro', 'MNE'),
(149, 'Montserrat', 'MSR'),
(150, 'Morocco', 'MAR'),
(151, 'Mozambique', 'MOZ'),
(152, 'Myanmar', 'MMR'),
(153, 'Namibia', 'NAM'),
(154, 'Nauru', 'NRU'),
(155, 'Nepal', 'NPL'),
(156, 'Netherlands Antilles', 'ANT'),
(157, 'New Caledonia', 'NCL'),
(158, 'New Zealand', 'NZL'),
(159, 'Nicaragua', 'NIC'),
(160, 'Niger', 'NER'),
(161, 'Nigeria', 'NGA'),
(162, 'Niue', 'NIU'),
(163, 'Norfolk Island', 'NFK'),
(164, 'Northern Mariana Islands', 'MNP'),
(165, 'Occupied Palestinian Territory', 'PSE'),
(166, 'Oman', 'OMN'),
(167, 'Pakistan', 'PAK'),
(168, 'Palau', 'PLW'),
(169, 'Panama', 'PAN'),
(170, 'Papua New Guinea', 'PNG'),
(171, 'Paraguay', 'PRY'),
(172, 'Peru', 'PER'),
(173, 'Philippines', 'PHL'),
(174, 'Pitcairn', 'PCN'),
(175, 'Puerto Rico', 'PRI'),
(176, 'Qatar', 'QAT'),
(177, 'Republic of Korea', 'KOR'),
(178, 'R_union', 'REU'),
(179, 'Romania', 'ROU'),
(180, 'Rwanda', 'RWA'),
(181, 'Saint-Barth?elemy', 'BLM'),
(182, 'Saint Helena', 'SHN'),
(183, 'Saint Kitts and Nevis', 'KNA'),
(184, 'Saint Lucia', 'LCA'),
(185, 'Saint-Martin (French part)', 'MAF'),
(186, 'Saint Pierre and Miquelon', 'SPM'),
(187, 'Saint Vincent and the Grenadin', 'VCT'),
(188, 'Samoa', 'WSM'),
(189, 'San Marino', 'SMR'),
(190, 'Sao Tome and Principe', 'STP'),
(191, 'Saudi Arabia', 'SAU'),
(192, 'Senegal', 'SEN'),
(193, 'Serbia', 'SRB'),
(194, 'Seychelles', 'SYC'),
(195, 'Sierra Leone', 'SLE'),
(196, 'Singapore', 'SGP'),
(197, 'Slovakia', 'SVK'),
(198, 'Slovenia', 'SVN'),
(199, 'Solomon Islands', 'SLB'),
(200, 'Somalia', 'SOM'),
(201, 'South Africa', 'ZAF'),
(202, 'Sri Lanka', 'LKA'),
(203, 'Sudan', 'SDN'),
(204, 'Suriname', 'SUR'),
(205, 'Svalbard and Jan Mayen Islands', 'SJM'),
(206, 'Swaziland', 'SWZ'),
(207, 'Syrian Arab Republic', 'SYR'),
(208, 'Tajikistan', 'TJK'),
(209, 'Thailand', 'THA'),
(210, 'The former Yugoslav Republic o', 'MKD'),
(211, 'Timor-Leste', 'TLS'),
(212, 'Togo', 'TGO'),
(213, 'Tokelau', 'TKL'),
(214, 'Tonga', 'TON'),
(215, 'Trinidad and Tobago', 'TTO'),
(216, 'Tunisia', 'TUN'),
(217, 'Turkey', 'TUR'),
(218, 'Turkmenistan', 'TKM'),
(219, 'Turks and Caicos Islands', 'TCA'),
(220, 'Tuvalu', 'TUV'),
(221, 'Uganda', 'UGA'),
(222, 'Ukraine', 'UKR'),
(223, 'United Arab Emirates', 'ARE'),
(224, 'United Republic of Tanzania', 'TZA'),
(225, 'United States of America', 'USA'),
(226, 'United States Virgin Islands', 'VIR'),
(227, 'Uruguay', 'URY'),
(228, 'Uzbekistan', 'UZB'),
(229, 'Vanuatu', 'VUT'),
(230, 'Venezuela (Bolivarian Republic', 'VEN'),
(231, 'Viet Nam', 'VNM'),
(232, 'Wallis and Futuna Islands', 'WLF'),
(233, 'Western Sahara', 'ESH'),
(234, 'Yemen', 'YEM'),
(235, 'Zambia', 'ZMB'),
(236, 'Zimbabwe', 'ZWE'),
(237, 'UNKNOWN', '-');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `office`
--

CREATE TABLE `office` (
  `idOffice` int(11) NOT NULL,
  `OName` varchar(45) DEFAULT NULL,
  `Commission` decimal(10,2) NOT NULL,
  `CType` varchar(1) CHARACTER SET utf8mb4 DEFAULT NULL,
  `Excursion 1` decimal(10,2) DEFAULT NULL,
  `}_Excursion 2 Res_{` decimal(10,2) DEFAULT NULL,
  `Excursion 3` decimal(10,2) DEFAULT NULL,
  `Excursion 13` decimal(10,2) DEFAULT NULL,
  `Excursion 5 Res` decimal(10,2) DEFAULT NULL,
  `Margarites - Matala - Ag. Galini` decimal(10,2) DEFAULT NULL,
  `Excursion 55` decimal(10,2) DEFAULT NULL,
  `Excursion 555` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `office`
--

INSERT INTO `office` (`idOffice`, `OName`, `Commission`, `CType`, `Excursion 1`, `}_Excursion 2 Res_{`, `Excursion 3`, `Excursion 13`, `Excursion 5 Res`, `Margarites - Matala - Ag. Galini`, `Excursion 55`, `Excursion 555`) VALUES
(1, 'Office 1', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', NULL, '0.00', '0.00'),
(2, 'Office 2', '0.00', '%', '0.00', '16.00', '0.00', '40.00', '40.00', NULL, '0.00', '0.00'),
(3, 'Office 3', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', NULL, '0.00', '0.00'),
(4, 'Office 4', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', NULL, '0.00', '0.00'),
(5, 'Office 5', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', NULL, '0.00', '0.00'),
(6, 'Office 6', '0.00', NULL, '0.00', '0.00', '0.00', '0.00', '0.00', NULL, '0.00', '0.00'),
(7, 'Business Partner 1', '20.00', '€', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, '0.00', '0.00'),
(8, 'Business Partner 2', '0.00', '€', '0.00', '18.00', '0.00', '2.50', '21.50', NULL, '0.00', '0.00'),
(9, 'Business Partner 3', '0.00', '€', '0.00', '4.50', '0.00', '0.00', '7.20', NULL, '0.00', '0.00');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `pickup`
--

CREATE TABLE `pickup` (
  `idPickup` int(11) NOT NULL,
  `PPoint` varchar(45) DEFAULT NULL,
  `PPointGroup` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `pickup`
--

INSERT INTO `pickup` (`idPickup`, `PPoint`, `PPointGroup`) VALUES
(10, 'Bali church', 1),
(20, 'Bali Star', 1),
(30, 'Lisa Mari Beach', 1),
(40, 'Talea Beach', 1),
(50, 'Bali (National Road)', 1),
(60, 'Panormo (National Road)', 2),
(70, 'Marine Palace', 2),
(80, 'Creta Marine', 2),
(90, 'Creta Panorama', 2),
(100, 'Taverna Ilios', 3),
(105, 'Rethymno Mare (HER)', 3),
(110, 'Creta Star', 3),
(115, 'Gortyna Hotel (HER)', 3),
(120, 'Thalassi Hotel', 3),
(130, 'Taverna Dimitrios', 3),
(140, 'Amnissos', 4),
(150, 'White Palace', 4),
(155, 'Emerald', 4),
(160, 'Maravel Apartments', 4),
(170, 'Dias', 4),
(180, 'Seafront', 4),
(190, 'Rethymno Palace', 4),
(200, 'Jo-An Beach', 4),
(210, 'Maravel Land', 4),
(220, 'Caramel', 4),
(230, 'Rethymno Residence', 4),
(240, 'Rithymna Beach', 5),
(250, 'Orion', 5),
(260, 'Office 5', 5),
(270, 'Eva Bay', 5),
(280, 'Adele Beach', 5),
(290, 'Christina Apartments', 5),
(300, 'Galeana Mare', 5),
(310, 'Palladion', 5),
(320, 'Golden Beach', 5),
(330, 'Kathrin Beach', 5),
(340, 'Office 4', 5),
(350, 'Edem Beach', 5),
(360, 'Rethymno Village', 6),
(365, 'Akti Hara', 6),
(370, 'Leoniki Residence', 6),
(380, 'Galeana Beach', 6),
(390, 'Marinos Beach', 6),
(400, 'Axos', 6),
(410, 'Nefeli', 6),
(420, 'Pavlakis S/M Platanias', 6),
(430, 'Office 6', 6),
(440, 'BP Platanias', 6),
(450, 'Mantenia', 7),
(460, 'May', 7),
(470, 'Creta Palace', 7),
(480, 'Missiria church', 7),
(490, 'Anna Apartments', 7),
(500, 'Missiria Apartments', 7),
(510, 'Pavlakis S/M Missiria', 7),
(515, 'Grigoris Bakery (HER)', 7),
(520, 'Dimitrios Beach', 8),
(530, 'Anita Beach', 8),
(540, 'Pearl Beach', 8),
(550, 'Plaza Spa', 8),
(560, 'Olympic Suites', 8),
(565, 'Irini Bar (HER)', 8),
(570, 'Flisvos Beach', 8),
(580, 'Golden Coast', 8),
(600, 'Marel', 8),
(605, 'Manoli\\\'s Place', 8),
(610, 'Bora Bora', 8),
(615, 'Blue sky', 8),
(618, 'Atlantis Beach', 8),
(620, 'Zantina', 8),
(630, 'Blue Sea', 8),
(640, 'Batis', 8),
(643, 'Lefkoniko Beach (HER)', 9),
(646, 'Theartemis Palace (HER)', 9),
(648, 'Minos (HER)', 9),
(650, 'Office 2', 9),
(660, 'Minos', 9),
(670, 'Theartemis Palace', 9),
(680, 'Lefkoniko Beach', 9),
(690, 'Nereas Taverna', 9),
(700, 'Poseidon', 9),
(720, 'Steris Beach', 10),
(725, 'Theo', 10),
(730, 'Porto Rethymno', 10),
(740, 'Ilios Beach', 10),
(750, 'Kriti Beach', 10),
(760, 'Delphini', 10),
(770, 'Astali', 10),
(790, 'Town Hall', 11),
(795, 'Olympic Palladium (HER)', 11),
(800, '4 Martyrs Church', 11),
(805, 'Brascos (HER)', 11),
(810, 'Macaris', 12),
(820, 'Archipelagos', 12),
(830, 'Petradi Beach', 12),
(840, 'Delfini Apartments', 12),
(850, 'LIDL', 12),
(860, 'Camari Garden', 12),
(863, 'Petres bus stop', 12),
(865, 'Episkopi bus stop', 12),
(870, 'Ermioni', 13),
(880, 'Kavros Beach', 13),
(890, 'Kournas Village', 13),
(900, 'Happy Days', 13),
(910, 'Vantaris Beach', 13),
(920, 'Georgioupolis Resort', 14),
(930, 'Pilot Beach', 14),
(940, 'Grigoris Bakery bus stop', 14),
(950, 'Vrisses bus stop (national road)', 14);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `ptime`
--

CREATE TABLE `ptime` (
  `PTimeID` int(11) NOT NULL,
  `PPointGroup` int(11) NOT NULL,
  `Excursion 1` varchar(5) DEFAULT NULL,
  `}_Excursion 2 Res_{` varchar(5) DEFAULT NULL,
  `Margarites - Matala - Ag. Galini` varchar(5) NOT NULL,
  `Excursion 3` varchar(5) DEFAULT NULL,
  `Excursion 13` varchar(5) DEFAULT NULL,
  `Excursion 5 Res` varchar(5) DEFAULT NULL,
  `Excursion 15` varchar(5) DEFAULT NULL,
  `Excursion 55` varchar(5) DEFAULT NULL,
  `Excursion 555` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `ptime`
--

INSERT INTO `ptime` (`PTimeID`, `PPointGroup`, `Excursion 1`, `}_Excursion 2 Res_{`, `Margarites - Matala - Ag. Galini`, `Excursion 3`, `Excursion 13`, `Excursion 5 Res`, `Excursion 15`, `Excursion 55`, `Excursion 555`) VALUES
(0, 0, '1', '1', '0', '0', '1', '1', '-1', '-1', '-1'),
(1, 1, '07:00', '07:30', '07:55', '09:20', '16:00', '06:45', '00:00', NULL, NULL),
(2, 2, '07:20', '07:50', '08:15', '09:00', '16:20', '07:05', '00:00', NULL, NULL),
(3, 3, '07:30', '08:00', '08:05', '08:50', '16:30', '07:15', '00:00', NULL, NULL),
(4, 4, '07:40', '08:10', '07:55', '08:40', '16:40', '07:25', '00:00', NULL, NULL),
(5, 5, '07:45', '08:15', '07:50', '08:35', '16:45', '07:30', '00:00', NULL, NULL),
(6, 6, '07:50', '08:20', '07:45', '08:30', '16:50', '07:35', '00:00', NULL, NULL),
(7, 7, '07:55', '08:25', '07:40', '08:25', '16:55', '07:40', '00:00', NULL, NULL),
(8, 8, '08:00', '08:30', '07:35', '08:20', '17:00', '07:45', '00:00', NULL, NULL),
(9, 9, '08:05', '08:35', '07:30', '08:15', '17:05', '07:50', '00:00', NULL, NULL),
(10, 10, '08:10', '08:40', '07:25', '08:10', '17:10', '07:55', '00:00', NULL, NULL),
(11, 11, '08:15', '08:45', '07:20', '08:05', '17:15', '08:00', '00:00', NULL, NULL),
(12, 12, '08:20', '08:50', '07:15', '08:00', '17:20', '08:05', '00:00', NULL, NULL),
(13, 13, '08:30', '9:00', '07:05', '07:50', '17:30', '08:15', '00:00', NULL, NULL),
(14, 14, '08:35', '9:05', '07:00', '07:45', '17:35', '08:20', '00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `reservations`
--

CREATE TABLE `reservations` (
  `idReservations` int(11) NOT NULL,
  `ExcursionID` int(11) NOT NULL,
  `ExDate` date NOT NULL,
  `Pickup` int(11) DEFAULT NULL,
  `PTime` varchar(5) NOT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `Phone` varchar(16) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `Adults` int(11) NOT NULL,
  `AdultPrice` decimal(10,2) NOT NULL,
  `Kids` int(11) DEFAULT NULL,
  `KidPrice` decimal(10,2) DEFAULT NULL,
  `Infants` int(11) DEFAULT NULL,
  `Language` varchar(3) DEFAULT NULL,
  `Nationality` varchar(3) DEFAULT NULL,
  `VoucherNo` varchar(45) DEFAULT NULL,
  `ResDate` datetime NOT NULL,
  `HotelID` int(11) DEFAULT NULL,
  `HotelName` varchar(60) NOT NULL,
  `RoomNo` varchar(50) DEFAULT NULL,
  `ReservationOfficeID` int(11) DEFAULT NULL,
  `SellerID` varchar(30) DEFAULT NULL,
  `POB` int(11) NOT NULL,
  `POBamt` decimal(10,2) DEFAULT NULL,
  `Noshow` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `reservations`
--

INSERT INTO `reservations` (`idReservations`, `ExcursionID`, `ExDate`, `Pickup`, `PTime`, `LastName`, `Phone`, `Email`, `Adults`, `AdultPrice`, `Kids`, `KidPrice`, `Infants`, `Language`, `Nationality`, `VoucherNo`, `ResDate`, `HotelID`, `HotelName`, `RoomNo`, `ReservationOfficeID`, `SellerID`, `POB`, `POBamt`, `Noshow`) VALUES
(121, 14, '2017-06-06', 410, '07:35', 'Res 6', '', '', 2, '30.00', 0, '0.00', 0, 'D', 'GER', '1071', '2017-06-04 00:00:00', 620103, 'Nefeli', '240', 6, '', 0, '0.00', ''),
(122, 14, '2017-06-06', 100, '07:15', 'Res 7', '', '', 4, '30.00', 0, '0.00', 0, 'D', 'GER', '1002', '2017-06-04 00:00:00', 600013, 'Begeti Bay', '410', 2, '', 0, '0.00', ''),
(123, 14, '2017-06-06', 730, '07:55', 'Res 8', '', '', 2, '30.00', 1, '15.00', 0, 'E', 'GRC', '1020', '2017-06-04 00:00:00', 25400, 'Private (City)', '10', 3, '', 0, '0.00', '0'),
(124, 14, '2017-06-06', 670, '07:50', 'Res 9', '', '', 2, '30.00', 0, '0.00', 0, 'D', 'GER', '1004', '2017-06-04 00:00:00', 635033, 'Atrium', '420', 9, '', 0, '0.00', ''),
(141, 14, '2017-06-06', 510, '07:40', 'Res 10', '', '', 2, '30.00', 0, '0.00', 0, 'D', 'GER', '934', '2017-06-05 00:00:00', 625093, 'Odyssia Beach', '805', 8, '', 0, '0.00', ''),
(153, 14, '2017-06-13', 660, '07:50', 'Res 11', '', 'res11@email.com', 2, '30.00', 0, '0.00', 0, 'E', 'LTU', '1005', '2017-06-05 00:00:00', 635023, 'Minos', '359', 2, '', 0, '0.00', ''),
(154, 14, '2017-06-06', 240, '07:30', 'Res 12', '', '', 2, '30.00', 0, '0.00', 0, 'F', 'FRA', '1924', '2017-06-05 00:00:00', 615003, 'Rithymna Beach', '916', 5, '', 0, '0.00', '1'),
(163, 5, '2017-06-08', 760, '08:40', 'Res 1', '(+49)109 2289171', 'res1@email.com', 2, '26.00', 0, '0.00', 0, 'D', 'GER', '1001', '2017-06-05 00:00:00', 640213, 'Kyma Beach', '406', 1, '', 0, '0.00', ''),
(164, 5, '2017-06-08', 730, '08:40', 'Res 2', '', '', 2, '26.00', 0, '0.00', 0, 'E', 'GBR', '1002', '2017-06-05 00:00:00', 640103, 'Porto Rethymno', '314', 9, '', 0, '0.00', ''),
(165, 5, '2017-06-08', 660, '08:35', 'Res 3', '', '', 2, '26.00', 0, '0.00', 0, 'E', 'GBR', '1003', '2017-06-05 00:00:00', 635023, 'Minos', '215', 2, '', 0, '0.00', ''),
(166, 5, '2017-06-08', 520, '08:30', 'Res 4', '', '', 2, '26.00', 0, '0.00', 0, 'E', 'GBR', '937', '2017-06-05 00:00:00', 630003, 'Dimitrios Beach', '511', 3, '', 0, '0.00', ''),
(173, 14, '2017-06-06', 340, '07:30', 'Res 13', '', '', 2, '30.00', 0, '0.00', 0, 'E', 'GBR', '1430', '2017-06-05 00:00:00', 615063, 'Palladion', '248', 8, '', 0, '0.00', ''),
(180, 14, '2017-06-06', 760, '07:55', 'Res 14', '', '', 2, '30.00', 0, '0.00', 0, 'E', 'SWE', '1006', '2017-06-05 00:00:00', 640183, 'Achillion Palace', '407', 1, '', 0, '0.00', '1'),
(182, 5, '2017-06-08', 430, '08:20', 'Res 5', '', '', 3, '26.00', 0, '0.00', 0, 'E', 'GBR', '1004', '2017-06-05 00:00:00', 25500, 'Private (Outside)', '-', 8, '', 0, '0.00', ''),
(211, 14, '2017-06-06', 10, '06:45', 'Res 16', '(+49) 129001912', 'res15@email.com', 2, '30.00', 0, '15.00', 1, 'R', 'POL', '1785ap99', '2017-07-15 00:00:00', 530005, 'New Hotel 1', '127b', 8, '', 1, '10.00', '0'),
(213, 14, '2017-06-13', 670, '07:50', 'res10', '', '', 3, '30.00', 0, '0.00', 0, 'E', 'GBR', '1008', '2017-10-25 00:00:00', 635063, 'Theartemis Palace', '80', 3, NULL, 0, '0.00', NULL),
(214, 8, '2018-03-15', 105, '08:50', 'LastName1', '', '', 3, '30.00', 1, '15.00', 0, 'D', 'GER', '10012', '2018-03-17 00:00:00', 600033, 'Rethymno Mare Royal', '125', 3, NULL, 0, '0.00', NULL),
(215, 14, '2017-06-06', 400, '07:35', 'res8', '', '', 3, '30.00', 2, '15.00', 1, 'D', 'GER', '1290', '2018-04-17 00:00:00', 620053, 'Axos', '90jj', 8, NULL, 1, '20.00', '1');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `seller`
--

CREATE TABLE `seller` (
  `idSeller` int(11) NOT NULL,
  `SName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `seller`
--

INSERT INTO `seller` (`idSeller`, `SName`) VALUES
(1, 'Seller 1'),
(2, 'Seller 2'),
(4, 'Seller 3');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `testhotel`
--

CREATE TABLE `testhotel` (
  `Hid` int(11) NOT NULL,
  `HArea` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `HName` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HPhone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `HRow` int(11) DEFAULT NULL,
  `HTime` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `HTqueue` int(11) DEFAULT NULL,
  `PPWest` int(11) DEFAULT NULL,
  `PPEast` int(11) DEFAULT NULL,
  `notes` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `testhotel`
--

INSERT INTO `testhotel` (`Hid`, `HArea`, `HName`, `HPhone`, `HRow`, `HTime`, `HTqueue`, `PPWest`, `PPEast`, `notes`) VALUES
(1000, 'ΜΠΑΛΙ', 'Bali Beach & Village', '2834094210', 1, '5:30:00', 3, 50, 50, ''),
(1100, 'ΜΠΑΛΙ', 'Bali Mare', '2834094375', 1, '5:30:01', 3, 50, 50, ''),
(1200, 'ΜΠΑΛΙ', 'Ormos Atalia Aparthotel', '2834094401', 1, '5:30:02', 3, 50, 50, ''),
(1300, 'ΜΠΑΛΙ', 'Bali Paradise', '2834094253', 1, '5:30:03', 3, 50, 50, ''),
(1400, 'ΜΠΑΛΙ', 'Bali Star', '2834094212', 1, '5:30:04', 3, 20, 20, ''),
(1500, 'ΜΠΑΛΙ', 'Amalia Apartments', '2834094212', 1, '5:30:05', 3, 50, 50, ''),
(1600, 'ΜΠΑΛΙ', 'Lisa Mari Beach', '2834094073', 1, '5:30:06', 3, 30, 30, ''),
(1700, 'ΜΠΑΛΙ', 'Talea Beach', '', 1, '5:30:07', 3, 40, 40, ''),
(1800, 'ΜΠΑΛΙ', 'Aparthotel Sofia - Mythos Beach', '2834094450', 1, '5:30:08', 3, 50, 50, ''),
(1900, 'ΜΠΑΛΙ', 'Xidas Garden', '2834094269', 1, '5:30:09', 3, 50, 50, ''),
(2000, 'ΜΠΑΛΙ', 'Bella Vista', '2834094032', 1, '5:30:10', 3, 50, 50, ''),
(2100, 'ΜΠΑΛΙ', 'Blue Horizon', '2834094004', 1, '5:30:11', 3, 50, 50, ''),
(2200, 'ΜΠΑΛΙ', 'Carpe Diem', '2834022491', 1, '5:30:12', 3, 50, 50, ''),
(2300, 'ΜΠΑΛΙ', 'Elpis Studios & Apartments', '2834094444', 1, '5:30:13', 3, 50, 50, ''),
(2400, 'ΜΠΑΛΙ', 'Troulis', '2834094289', 1, '5:30:14', 3, 50, 50, ''),
(2500, 'ΠΑΝΟΡΜΟΣ', 'Iliana Hotel Apartments', '2834051447', 2, '5:50:00', 3, 60, 60, ''),
(2600, 'ΠΑΝΟΡΜΟΣ', 'Kirki Village', '2834051225', 2, '5:50:01', 3, 60, 60, ''),
(2700, 'ΠΑΝΟΡΜΟΣ', 'Panormo Beach', '2834051209', 2, '5:50:02', 3, 60, 60, ''),
(2800, 'ΠΑΝΟΡΜΟΣ', 'Philoxenia Apartments', '2834051481', 2, '5:50:03', 3, 60, 60, ''),
(2900, 'ΠΑΝΟΡΜΟΣ', 'Stella Beach', '2834051481', 2, '5:50:04', 3, 60, 60, ''),
(3000, 'ΠΑΝΟΡΜΟΣ', 'Grecotel Club Marine Palace & Suites', '2834051610', 4, '5:50:05', 3, 70, 70, ''),
(3100, 'ΠΑΝΟΡΜΟΣ', 'Europa Resort', '2834020200', 5, '5:50:06', 3, 70, 70, ''),
(3200, 'ΠΑΝΟΡΜΟΣ', 'Sensimar Royal Blue Resort & Spa', '2834055000', 6, '5:50:07', 3, 70, 70, ''),
(3300, 'ΠΑΝΟΡΜΟΣ', 'Iberostar Creta Marine', '2834051290', 7, '5:50:08', 3, 80, 80, ''),
(3400, 'ΠΑΝΟΡΜΟΣ', 'Iberostar Creta Panorama & Mare', '2834051502', 7, '5:50:09', 3, 90, 90, ''),
(3500, 'ΣΚΑΛΕΤΑ', 'Oasis', '2831071774', 8, '6:00:00', 3, 100, 101, ''),
(3600, 'ΣΚΑΛΕΤΑ', 'Begeti Bay', '2831071909', 8, '6:00:01', 3, 100, 101, ''),
(3700, 'ΣΚΑΛΕΤΑ', 'Prinos Resort', '2831072414', 9, '6:00:02', 3, 100, 101, ''),
(3800, 'ΣΚΑΛΕΤΑ', 'Rethymno Mare Royal', '2831071703', 9, '6:00:03', 3, 100, 101, ''),
(3900, 'ΣΚΑΛΕΤΑ', 'Babis', '2831071193', 10, '6:00:04', 3, 100, 101, ''),
(4000, 'ΣΚΑΛΕΤΑ', 'Scaleta Beach', '2831071702', 11, '6:00:05', 3, 100, 101, ''),
(4100, 'ΣΚΑΛΕΤΑ', 'Creta Royal', '2831071812', 11, '6:00:06', 3, 110, 110, ''),
(4200, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Stavromenos Villas', '2831071053', 11, '6:00:07', 3, 110, 110, ''),
(4300, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Creta Star', '2831071812', 11, '6:00:08', 3, 110, 110, ''),
(4400, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Corali Beach', '2831071967', 11, '6:00:09', 3, 120, 120, ''),
(4500, 'ΣΦΑΚΑΚΙ', 'Krini Beach', '2831072903', 11, '6:00:10', 3, 120, 120, ''),
(4600, 'ΣΚΑΛΕΤΑ', 'Gortyna', '2831071846', 12, '6:00:11', 3, 120, 120, ''),
(4700, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Yannis Aparthotel', '', 13, '6:00:12', 3, 120, 120, ''),
(4800, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Thalassi', '2831071990', 14, '6:00:13', 3, 120, 120, ''),
(4900, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Nautica', '2831055577', 14, '6:00:14', 3, 120, 120, ''),
(5000, 'ΠΑΓΚΑΛΟΧΩΡΙ', 'Alkionis', '2831071584', 15, '6:00:15', 3, 120, 120, ''),
(5100, 'ΠΑΓΚΑΛΟΧΩΡΙ', 'Almyra Apartments', '2831074675', 15, '6:00:16', 3, 120, 120, ''),
(5200, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Agelia Beach', '2831072032', 16, '6:00:17', 3, 130, 130, ''),
(5300, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Ekavi Beach', '2831071896', 16, '6:00:18', 3, 130, 130, ''),
(5400, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Dedalos Beach', '2831073035', 16, '6:00:19', 3, 130, 130, ''),
(5500, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Golden Sand Boutique', '2831072032', 16, '6:00:20', 3, 130, 130, ''),
(5600, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Danaos Beach', '2831073025', 17, '6:00:21', 3, 130, 130, ''),
(5700, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Rosebay Apartments', '2831054413', 17, '6:00:22', 3, 130, 130, ''),
(5800, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Chrisanna Apartments & Studios', '2831071195', 17, '6:00:23', 3, 130, 130, ''),
(5900, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Sunrise Hotel Apartments', '2834022791', 17, '6:00:24', 3, 130, 130, ''),
(6000, 'ΣΤΑΥΡΩΜΕΝΟΣ', 'Radamanthys Apartments', '2931072691', 17, '6:00:25', 3, 130, 130, ''),
(6100, 'ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ', 'Amnissos', '2831072460', 18, '6:10:00', 3, 140, 140, ''),
(6200, 'ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ', 'White Palace El Greco Luxury Resort', '2831071102', 19, '6:10:01', 3, 150, 150, ''),
(6300, 'ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ', 'Limas', '2831072257', 19, '6:10:02', 3, 150, 150, ''),
(6400, 'ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ', 'Keti (Kaiti) Apartments', '2831051480', 19, '6:10:03', 3, 150, 150, ''),
(6500, 'ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ', 'Alkyon', '2831071136', 19, '6:10:04', 3, 150, 150, ''),
(6600, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Maravel', '2831072916', 21, '6:10:05', 3, 160, 160, ''),
(6700, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Dias', '2831071017', 22, '6:10:06', 3, 170, 170, ''),
(6800, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Solimar Dias', '2831071177', 22, '6:10:07', 3, 170, 170, ''),
(6900, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Blue sky', '2831057560', 23, '6:10:08', 3, 170, 170, ''),
(7000, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Rethymno Palace', '2831072418', 24, '6:10:09', 3, 180, 180, ''),
(7100, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Jo An Beach', '2831024241', 25, '6:10:10', 3, 200, 200, ''),
(7200, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Seafront Apartments', '2831072600', 25, '6:10:11', 3, 190, 190, ''),
(7300, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Stella Katrin', '2831021690', 26, '6:10:12', 3, 190, 190, ''),
(7400, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Maravel Land', '2831071063', 27, '6:10:13', 3, 210, 210, ''),
(7500, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Caramel', '2831071803', 28, '6:10:14', 3, 220, 220, ''),
(7600, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Rethymno Residence', '2831072633', 29, '6:10:15', 3, 230, 230, ''),
(7700, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Aquila Rithimna Beach', '2831071002', 30, '6:15:00', 3, 240, 240, ''),
(7800, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Orion', '2831071471', 31, '6:15:01', 3, 250, 250, ''),
(7900, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Eva Bay', '2831020760', 32, '6:15:02', 3, 270, 270, ''),
(8000, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Adele Beach', '2831071081', 33, '6:15:03', 3, 280, 280, ''),
(8100, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Christina Apartments', '', 34, '6:15:04', 3, 300, 300, ''),
(8200, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Galeana Mare', '2831073006', 34, '6:15:05', 3, 290, 290, ''),
(8300, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Palladion', '2831028976', 35, '6:15:06', 3, 310, 310, ''),
(8400, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Golden Beach', '2831071012', 36, '6:15:07', 3, 320, 320, ''),
(8500, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Kathrin Beach', '2831071757', 37, '6:15:08', 3, 330, 330, ''),
(8600, 'ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ', 'Edem Beach', '2831073963', 38, '6:15:09', 3, 350, 350, ''),
(8700, 'ΠΛΑΤΑΝΕΣ', 'Rethymno Village', '2831025523', 39, '6:20:00', 3, 360, 360, ''),
(8800, 'ΠΛΑΤΑΝΕΣ', 'Grand Leoniki Residence', '2831029232', 40, '6:20:01', 3, 370, 370, ''),
(8900, 'ΠΛΑΤΑΝΕΣ', 'Cretan Sun', '2831027077', 41, '6:20:02', 3, 370, 370, ''),
(9000, 'ΠΛΑΤΑΝΕΣ', 'Marinos Beach', '2831027840', 42, '6:20:03', 3, 390, 390, ''),
(9100, 'ΠΛΑΤΑΝΕΣ', 'Galeana Beach', '2831051141', 43, '6:20:04', 3, 380, 380, ''),
(9200, 'ΠΛΑΤΑΝΕΣ', 'Axos', '2831020472', 44, '6:20:05', 3, 400, 400, ''),
(9300, 'ΠΛΑΤΑΝΕΣ', 'Nefeli', '2831055321', 47, '6:20:10', 3, 410, 410, ''),
(9400, 'ΠΛΑΤΑΝΕΣ', 'Castello Bianco', '831020029', 45, '6:20:06', 3, 410, 410, ''),
(9500, 'ΠΛΑΤΑΝΙΑΣ', 'Apollon Hotel Apartments', '2831050300', 46, '6:20:07', 3, 410, 410, ''),
(9600, 'ΠΛΑΤΑΝΙΑΣ', 'Creta Residence', '', 47, '6:20:08', 3, 440, 440, ''),
(9700, 'ΠΛΑΤΑΝΙΑΣ', 'Minos Mare', '', 47, '6:20:09', 3, 440, 440, ''),
(9800, 'ΠΛΑΤΑΝΕΣ', 'La Stella', '2831027545', 49, '6:20:11', 3, 440, 440, ''),
(9900, 'ΠΛΑΤΑΝΕΣ', 'Evelin', '', 49, '6:20:12', 3, 440, 440, ''),
(10000, 'ΠΛΑΤΑΝΕΣ', 'Creta Sun', '', 49, '6:20:13', 3, 440, 440, ''),
(10100, 'ΠΛΑΤΑΝΕΣ', 'Trefon Apartments', '2831024772', 50, '6:20:14', 3, 420, 420, ''),
(10200, 'ΠΛΑΤΑΝΕΣ', 'Bella Casita Family Apartments', '2831025552', 48, '6:20:15', 3, 420, 420, ''),
(10300, 'ΠΛΑΤΑΝΕΣ', 'Amaril', '2831056665', 50, '6:20:16', 3, 420, 420, ''),
(10400, 'ΠΛΑΤΑΝΕΣ', 'Varvaras Diamond', '2831035474', 50, '6:20:17', 3, 420, 420, ''),
(10500, 'ΠΛΑΤΑΝΕΣ', 'Bueno', '2831025554', 50, '6:20:18', 3, 420, 420, ''),
(10600, 'ΠΛΑΤΑΝΕΣ', 'Mary Hotel', '2831021402', 51, '6:20:19', 3, 440, 440, ''),
(10700, 'ΠΛΑΤΑΝΙΑΣ', 'Julia Apartments', '2831025566', 52, '6:20:20', 3, 440, 440, ''),
(10800, 'ΠΛΑΤΑΝΙΑΣ', 'Minos Mare Royal', '2831050388', 53, '6:20:21', 3, 420, 420, ''),
(10900, 'ΠΛΑΤΑΝΙΑΣ', 'Marianthi Apartments', '2831055625', 54, '6:20:22', 3, 440, 440, ''),
(11000, 'ΡΕΘΥΜΝΟ', 'Mantenia', '283155169', 55, '6:25:00', 3, 450, 450, ''),
(11100, 'ΜΥΣΣΙΡΙΑ', 'May', '2831055745', 55, '6:25:01', 3, 460, 460, ''),
(11200, 'ΜΥΣΣΙΡΙΑ', 'Grecotel Creta Palace', '2831021181', 56, '6:25:02', 3, 470, 470, 'main road'),
(11300, 'ΜΥΣΣΙΡΙΑ', 'Chrissas Apartments', '2831023372', 57, '6:25:03', 3, 470, 470, 'main road'),
(11400, 'ΜΥΣΣΙΡΙΑ', 'Athina Rent Rooms Restaurant', '2831024717', 58, '6:25:04', 3, 480, 480, ''),
(11500, 'ΜΥΣΣΙΡΙΑ', 'Camping Elizabeth', '2831028694', 59, '6:25:05', 3, 480, 480, ''),
(11600, 'ΜΥΣΣΙΡΙΑ', 'Missiria Apartments', '2831025576', 60, '6:25:06', 3, 500, 500, ''),
(11700, 'ΜΥΣΣΙΡΙΑ', 'Anna Apartments', '', 61, '6:25:07', 3, 490, 490, ''),
(11800, 'ΜΥΣΣΙΡΙΑ', 'Dimitrios Village', '2831025647', 62, '6:25:08', 3, 510, 510, ''),
(11900, 'ΜΥΣΣΙΡΙΑ', 'Odyssia Beach', '2831027874', 62, '6:25:09', 3, 510, 510, ''),
(12000, 'ΜΥΣΣΙΡΙΑ', 'Omiros Boutique Apartments', '2831027874', 63, '6:25:10', 3, 510, 510, ''),
(12100, 'ΜΥΣΣΙΡΙΑ', 'Ilian Beach Apartments', '2831027205', 64, '6:25:11', 3, 510, 510, ''),
(12200, 'ΜΥΣΣΙΡΙΑ', 'Domenica Apartments', '2831027362', 64, '6:25:12', 3, 510, 510, ''),
(12300, 'ΡΕΘΥΜΝΟ', 'Aristea', '2831035358', 65, '6:25:13', 3, 510, 510, ''),
(12400, 'ΠΕΡΙΒΟΛΙΑ', 'Dimitrios Beach', '2831056660', 66, '6:30:00', 3, 530, 511, ''),
(12500, 'ΡΕΘΥΜΝΟ', 'Anita Beach', '', 0, '6:30:01', 3, 520, 511, ''),
(12600, 'ΡΕΘΥΜΝΟ', 'Iperion Beach', '2831053765', 65, '6:30:02', 3, 540, 541, ''),
(12700, 'ΠΕΡΙΒΟΛΙΑ', 'Pearl Beach', '2831020891', 67, '6:30:03', 3, 540, 541, ''),
(12800, 'ΜΥΣΣΙΡΙΑ', 'Esperia', '2831021271', 68, '6:30:04', 3, 540, 541, ''),
(12900, 'ΠΕΡΙΒΟΛΙΑ', 'Aegean Pearl', '2831023733', 69, '6:30:05', 3, 540, 541, ''),
(13000, 'ΠΕΡΙΒΟΛΙΑ', 'Plaza Spa Apartments', '2831051505', 70, '6:30:06', 3, 550, 550, ''),
(13100, 'ΠΕΡΙΒΟΛΙΑ', 'Yacinthos Hotel Apartments', '2831023635', 71, '6:30:07', 3, 550, 550, ''),
(13200, 'ΠΕΡΙΒΟΛΙΑ', 'Olympic II Apartments', '2831024761', 72, '6:30:08', 3, 560, 560, ''),
(13300, 'ΠΕΡΙΒΟΛΙΑ', 'Summer Dream', '2831051174', 73, '6:30:09', 3, 580, 580, ''),
(13400, 'ΠΕΡΙΒΟΛΙΑ', 'Melitti', '2831056696', 73, '6:30:10', 3, 570, 570, ''),
(13500, 'ΠΕΡΙΒΟΛΙΑ', 'Golden Coast Apartments', '2831021444', 74, '6:30:11', 3, 580, 580, ''),
(13600, 'ΠΕΡΙΒΟΛΙΑ', 'Flisvos Beach', '2831026784', 75, '6:30:12', 3, 570, 570, ''),
(13700, 'ΠΕΡΙΒΟΛΙΑ', 'Erato Hotel Apartments', '2831026913', 75, '6:30:13', 3, 580, 580, ''),
(13800, 'ΠΕΡΙΒΟΛΙΑ', 'Marilyn Apartments', '2831055247', 76, '6:30:14', 3, 580, 580, ''),
(13900, 'ΠΕΡΙΒΟΛΙΑ', 'Zannis', '2831035363', 76, '6:30:15', 3, 580, 580, ''),
(14000, 'ΠΕΡΙΒΟΛΙΑ', 'Daisy Hotel Apartments', '2831050001', 77, '6:30:16', 3, 610, 610, ''),
(14100, 'ΠΕΡΙΒΟΛΙΑ', 'Olympia', '2831029815', 77, '6:30:17', 3, 610, 610, ''),
(14200, 'ΠΕΡΙΒΟΛΙΑ', 'Fouli Studios & Apartments', '2831026956', 77, '6:30:18', 3, 610, 610, ''),
(14300, 'ΠΕΡΙΒΟΛΙΑ', 'Blue Sky Apartments', '2831057560', 78, '6:30:19', 3, 610, 610, ''),
(14400, 'ΡΕΘΥΜΝΟ', 'Atlantis Beach', '2831051002', 79, '6:30:20', 3, 590, 590, ''),
(14500, 'ΡΕΘΥΜΝΟ', 'Mar El Furnished Apartments', '2831053463', 80, '6:30:21', 3, 600, 600, ''),
(14600, 'ΡΕΘΥΜΝΟ', 'Eltina', '2831055231', 81, '6:30:22', 3, 660, 660, ''),
(14700, 'ΡΕΘΥΜΝΟ', 'Family Homes Zaharias', '2831028584', 82, '6:30:23', 3, 630, 630, ''),
(14800, 'ΡΕΘΥΜΝΟ', 'Aris Apartments', '2831025867', 83, '6:30:24', 3, 630, 630, ''),
(14900, 'ΠΕΡΙΒΟΛΙΑ', 'Blue Sea Apartments', '2831054804', 83, '6:30:25', 3, 630, 630, ''),
(15000, 'ΠΕΡΙΒΟΛΙΑ', 'Melmar', '2831054908', 83, '6:30:26', 3, 660, 660, ''),
(15100, 'ΠΕΡΙΒΟΛΙΑ', 'Ibiscos Garden', '2831051112', 83, '6:30:27', 3, 660, 660, ''),
(15200, 'ΠΕΡΙΒΟΛΙΑ', 'Zantina', '2831024863', 84, '6:30:28', 3, 620, 620, ''),
(15300, 'ΡΕΘΥΜΝΟ', 'Batis', '2831050558', 85, '6:30:29', 3, 640, 640, ''),
(15400, 'ΡΕΘΥΜΝΟ', 'Ammos Studios', '2831036123', 86, '6:30:30', 3, 620, 620, ''),
(15500, 'ΡΕΘΥΜΝΟ', 'Ostria', '2831027705', 87, '6:35:00', 3, 650, 650, ''),
(15600, 'ΡΕΘΥΜΝΟ', 'Medusa', '2831027937', 88, '6:35:01', 3, 650, 650, ''),
(15700, 'ΠΕΡΙΒΟΛΙΑ', 'Minos', '2831053921', 89, '6:35:02', 3, 660, 660, ''),
(15800, 'ΡΕΘΥΜΝΟ', 'Atrium', '2831057601', 90, '6:35:03', 3, 670, 670, ''),
(15900, 'ΡΕΘΥΜΝΟ', 'Lefkoniko Bay', '2831025495', 90, '6:35:04', 3, 680, 680, ''),
(16000, 'ΚΑΛΛΙΘΕΑ', 'Lefkoniko Beach', '2831055326', 90, '6:35:05', 3, 680, 680, ''),
(16100, 'ΡΕΘΥΜΝΟ', 'Theartemis Palace', '2831053991', 90, '6:35:06', 3, 670, 670, ''),
(16200, 'ΡΕΘΥΜΝΟ', 'Bella Mare', '2831035494', 91, '6:35:07', 3, 680, 680, ''),
(16300, 'ΡΕΘΥΜΝΟ', 'Kleoniki Mare', '2831040699', 91, '6:35:08', 3, 680, 680, ''),
(16400, 'ΡΕΘΥΜΝΟ', 'Swell Boutique', '2831050110', 91, '6:40:00', 3, 690, 690, ''),
(16500, 'ΡΕΘΥΜΝΟ', 'Palm Beach Hotel Apartments', '2831025597', 92, '6:40:01', 3, 720, 720, ''),
(16600, 'ΡΕΘΥΜΝΟ', 'Aloe Apartments', '2831025450', 92, '6:40:02', 3, 720, 720, ''),
(16700, 'ΡΕΘΥΜΝΟ', 'Steris Beach', '2831028303', 93, '6:40:03', 3, 720, 720, ''),
(16800, 'ΡΕΘΥΜΝΟ', 'Leonidas Hotel & Apartments', '2831051754', 94, '6:40:04', 3, 720, 720, ''),
(16900, 'ΡΕΘΥΜΝΟ', 'Birais', '2831055529', 94, '6:40:05', 3, 720, 720, ''),
(17000, 'ΡΕΘΥΜΝΟ', 'Theo', '2831050187', 95, '6:40:06', 3, 700, 700, ''),
(17100, 'ΡΕΘΥΜΝΟ', 'Poseidon', '2831023795', 95, '6:40:07', 3, 700, 700, ''),
(17200, 'ΡΕΘΥΜΝΟ', 'Pegasus', '2831025530', 96, '6:40:08', 3, 700, 700, ''),
(17300, 'ΡΕΘΥΜΝΟ', 'Bio Suites', '283158403', 97, '6:40:09', 3, 730, 730, ''),
(17400, 'ΡΕΘΥΜΝΟ', 'Aquila Porto Rethymno', '2831050432', 97, '6:40:10', 3, 730, 730, ''),
(17500, 'ΡΕΘΥΜΝΟ', 'Ilios Beach Hotel Apartments', '2831055672', 98, '6:40:11', 3, 730, 730, ''),
(17600, 'ΡΕΘΥΜΝΟ', 'Kriti Beach', '2831027401', 99, '6:40:12', 3, 750, 750, ''),
(17700, 'ΡΕΘΥΜΝΟ', 'The Sea View Apartments', '2831024533', 100, '6:40:13', 3, 750, 750, ''),
(17800, 'ΡΕΘΥΜΝΟ', 'Cosmos', '2831052244', 100, '6:40:14', 3, 760, 760, ''),
(17900, 'ΡΕΘΥΜΝΟ', 'Aqua Marina', '2831035340', 100, '6:40:15', 3, 760, 760, ''),
(18000, 'ΡΕΘΥΜΝΟ', 'Astali', '2831024721', 101, '6:40:16', 3, 770, 770, ''),
(18100, 'ΡΕΘΥΜΝΟ', 'Elina Hotel Apartments', '2831027395', 101, '6:40:17', 3, 770, 770, ''),
(18200, 'ΡΕΘΥΜΝΟ', 'Achillion Palace', '2831051502', 102, '6:40:18', 3, 770, 770, ''),
(18300, 'ΡΕΘΥΜΝΟ', 'Jason', '2831022542', 102, '6:40:19', 3, 760, 760, ''),
(18400, 'ΡΕΘΥΜΝΟ', 'Constantin', '2831020221', 102, '6:40:20', 3, 760, 760, ''),
(18500, 'ΡΕΘΥΜΝΟ', 'Kyma Beach', '2831055503', 103, '6:40:21', 3, 760, 760, ''),
(18600, 'ΕΥΛΗΓΙΑ', 'Forest Park', '2831051778', 101, '6:45:00', 3, 760, 760, ''),
(18700, 'ΡΕΘΥΜΝΟ', 'Liberty', '2831055851', 104, '6:45:01', 3, 790, 791, ''),
(18800, 'ΡΕΘΥΜΝΟ', 'Olympic Palladium', '2831024762', 104, '6:45:02', 3, 790, 791, ''),
(18900, 'ΡΕΘΥΜΝΟ', 'Brascos', '2831023721', 105, '6:45:03', 3, 800, 801, ''),
(19000, 'ΡΕΘΥΜΝΟ', 'Jo-An', '2831024241', 106, '6:45:04', 3, 800, 801, ''),
(19100, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Afroditi Suites', '2831022246', 107, '6:45:05', 3, 800, 801, ''),
(19200, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Casa De Delfini', '2831055120', 107, '6:45:06', 3, 800, 801, ''),
(19300, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Casa Vitae', '2831035058', 107, '6:45:07', 3, 800, 801, ''),
(19400, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Leo Hotel', '2831026197', 107, '6:45:08', 3, 800, 801, ''),
(19500, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Vetera Suites', '2831023844', 107, '6:45:09', 3, 800, 801, ''),
(19600, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Youth Hostel', '2831022848', 107, '6:45:10', 3, 800, 801, ''),
(19700, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Bellagio Luxury Boutique', '2831055777', 107, '6:45:11', 3, 800, 801, ''),
(19800, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Civitas Boutique', '2831035127', 107, '6:45:12', 3, 800, 801, ''),
(19900, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Mythos Suites', '2831053917', 107, '6:45:13', 3, 800, 801, ''),
(20000, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Rethymno House', '2831023924', 107, '6:45:14', 3, 800, 801, ''),
(20100, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Pepi Studios', '2831026428', 107, '6:45:15', 3, 800, 801, ''),
(20200, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Anna\\\'s Apartments (Old Town)', '2831052951', 107, '6:45:16', 3, 800, 801, ''),
(20300, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Rimondi Boutique', '2831051289', 107, '6:45:17', 3, 800, 801, ''),
(20400, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Palazzo Rimondi', '2831051001', 108, '6:45:18', 3, 800, 801, ''),
(20500, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Palazzino Di Corina', '2831021205', 108, '6:45:19', 3, 800, 801, ''),
(20600, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Palazzo Vecchio', '2831035351', 108, '6:45:20', 3, 800, 801, ''),
(20700, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'VECCHIO-ΒΕΚΙΟ', '2831054985', 108, '6:45:21', 3, 800, 801, ''),
(20800, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Fortezza', '2831055551', 108, '6:45:22', 3, 800, 801, ''),
(20900, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Ideon', '2831028667', 108, '6:45:23', 3, 800, 801, ''),
(21000, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Barbara Studios', '2831022607', 108, '6:45:24', 3, 800, 801, ''),
(21100, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Sohora Boutique Hotel', '2831300913', 108, '6:45:25', 3, 800, 801, ''),
(21200, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Avli Lounge Apartments', '2831058250', 108, '6:45:26', 3, 800, 801, ''),
(21300, 'ΡΕΘΥΜΝΟ (Παλιά Πόλη)', 'Private (Old Town)', '', 108, '6:45:27', 3, 800, 801, ''),
(21400, 'ΡΕΘΥΜΝΟ', 'Belvedere', '2831026898', 109, '6:50:00', 3, 810, 810, ''),
(21500, 'ΡΕΘΥΜΝΟ', 'Archipelagos Residence', '2831054754', 110, '6:50:01', 3, 820, 820, ''),
(21600, 'ΡΕΘΥΜΝΟ', 'Macaris Suites & Spa', '2831054757', 110, '6:50:02', 3, 810, 810, ''),
(21700, 'ΡΕΘΥΜΝΟ', 'Creta Seafront Residences', '2831022208', 111, '6:50:03', 3, 830, 830, ''),
(21800, 'ΡΕΘΥΜΝΟ', 'Rehtymno Hills', '2831057040', 112, '6:50:04', 3, 830, 830, ''),
(21900, 'ΡΕΘΥΜΝΟ', 'Filoxenia Beach', '2831055325', 113, '6:50:05', 3, 830, 830, ''),
(22000, 'ΡΕΘΥΜΝΟ', 'Petradi Beach Lounge', '2831055325', 114, '6:50:06', 3, 830, 830, ''),
(22100, 'ΚΟΥΜΠΕΣ', 'Delfini Beach (Koumpes)', '2831035245', 115, '6:50:07', 3, 840, 840, ''),
(22200, 'ΑΤΣΙΠΟΠΟΥΛΟ', 'Rethymno Panorama', '2831026250', 116, '6:50:08', 3, 850, 850, ''),
(22300, 'ΑΤΣΙΠΟΠΟΥΛΟ', 'Pantheon', '2831054914', 116, '6:50:09', 3, 850, 850, ''),
(22400, 'ΝΕΒΕΛΟ', 'Camari Garden', '2831031272', 117, '7:05:00', 3, 860, 860, ''),
(22500, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Hydramis Palace', '2831061000', 118, '7:05:01', 3, 870, 870, ''),
(22600, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Ermioni Beach', '2831061678', 119, '7:05:02', 3, 870, 870, ''),
(22700, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Poledas Apartments', '2831061062', 119, '7:05:03', 3, 870, 870, ''),
(22800, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Palladion (Kavros)', '2831061720', 119, '7:05:04', 3, 870, 870, ''),
(22900, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Anatoli Beach (Kavros)', '2825061001', 120, '7:05:05', 3, 880, 880, ''),
(23000, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Kavros Beach (Kavros)', '', 120, '7:05:06', 3, 880, 880, ''),
(23100, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Aquamar Beach (Kavros)', '2825061332', 120, '7:05:07', 3, 880, 880, ''),
(23200, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Silver Beach (Kavros)', '2825083078', 121, '7:05:08', 3, 890, 890, ''),
(23300, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Kournas Village (Kavros)', '2825061416', 121, '7:05:09', 3, 890, 890, ''),
(23400, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Happy Days (Kavros)', '2825061201', 122, '7:05:10', 3, 900, 900, ''),
(23500, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Sandy Beach (Kavros)', '2825061201', 122, '7:05:11', 3, 900, 900, ''),
(23600, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Orpheas Resort (Kavros)', '2825061218', 122, '7:05:12', 3, 900, 900, ''),
(23700, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Vantaris Beach (Kavros)', '2825061231', 123, '7:05:13', 3, 910, 910, ''),
(23800, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Delfina Art Resort (Kavros)', '2825061272', 123, '7:05:14', 3, 910, 910, ''),
(23900, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Apollo (Kavros)', '2825061100', 123, '7:05:15', 3, 910, 910, ''),
(24000, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Eliros Mare (Kavros)', '2825061181', 124, '7:05:16', 3, 910, 910, ''),
(24100, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Vantaris Palace (Kavros)', '2825061783', 125, '7:05:17', 3, 910, 910, ''),
(24200, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Delfina Beach (Kavros)', '2825061272', 126, '7:05:18', 3, 910, 910, ''),
(24300, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Mythos Palace Resort & Spa (Kavros)', '2825061713', 127, '7:05:19', 3, 910, 910, ''),
(24400, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Georgioupolis Resort (Kavros)', '2825061126', 128, '7:05:20', 3, 920, 920, ''),
(24500, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Anemos Luxury Grand Resort (Kavros)', '2825062550', 129, '7:05:21', 3, 920, 920, ''),
(24600, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Posidon Studios(Kavros)', '2825061160', 130, '7:05:22', 3, 920, 920, ''),
(24700, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Pilot Beach Resort (Kavros)', '2825061002', 131, '7:05:23', 3, 930, 930, ''),
(24800, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Mare Monte Beach (Kavros)', '2825061390', 132, '7:05:24', 3, 930, 930, ''),
(24900, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Kokalas Resort', '2825061293', 133, '7:05:25', 3, 940, 940, ''),
(25000, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Fereniki Resort & Spa', '2825061297', 133, '7:05:26', 3, 940, 940, ''),
(25100, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Corissia Princess', '2825083010', 133, '7:05:27', 3, 940, 940, ''),
(25200, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Corissia Beach', '2825083010', 133, '7:05:28', 3, 940, 940, ''),
(25300, 'ΓΕΩΡΓΙΟΥΠΟΛΗ', 'Georgioupolis Beach', '2825061056', 133, '7:05:29', 3, 940, 940, ''),
(25400, 'ΡΕΘΥΜΝΟ', 'Private (City)', '', 134, '', 3, 0, 0, ''),
(25500, 'ΡΕΘΥΜΝΟ', 'Private (Outside)', '', 135, '', 3, 0, 0, '');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `uName` varchar(30) CHARACTER SET utf8 NOT NULL,
  `uPass` varchar(40) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`uid`, `uName`, `uPass`) VALUES
(0, 'administrator', '4922bb438526bc4e875ebf5569250231'),
(1, 'Boss', '652da4fcc91c3291ded0c1cc38a22c41'),
(3, 'test', '9999');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`idBus`);

--
-- Ευρετήρια για πίνακα `bus_assignment`
--
ALTER TABLE `bus_assignment`
  ADD PRIMARY KEY (`AssignmentID`);

--
-- Ευρετήρια για πίνακα `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`idDriver`);

--
-- Ευρετήρια για πίνακα `excursion`
--
ALTER TABLE `excursion`
  ADD PRIMARY KEY (`idExcursion`);

--
-- Ευρετήρια για πίνακα `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`idGuide`);

--
-- Ευρετήρια για πίνακα `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`idHotel`),
  ADD KEY `PPWest` (`PPWest`),
  ADD KEY `PPEast` (`PPEast`);

--
-- Ευρετήρια για πίνακα `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`idNationality`),
  ADD UNIQUE KEY `idNationality` (`idNationality`);

--
-- Ευρετήρια για πίνακα `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`idOffice`);

--
-- Ευρετήρια για πίνακα `pickup`
--
ALTER TABLE `pickup`
  ADD PRIMARY KEY (`idPickup`),
  ADD KEY `PPointGroup_fkey` (`PPointGroup`);

--
-- Ευρετήρια για πίνακα `ptime`
--
ALTER TABLE `ptime`
  ADD PRIMARY KEY (`PPointGroup`);

--
-- Ευρετήρια για πίνακα `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`idReservations`),
  ADD KEY `fk_Reservations_1_idx` (`ExcursionID`),
  ADD KEY `fk_Reservations_2_idx` (`Pickup`),
  ADD KEY `fk_Reservations_3_idx` (`HotelID`),
  ADD KEY `fk_Reservations_4_idx` (`ReservationOfficeID`);

--
-- Ευρετήρια για πίνακα `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`idSeller`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `bus`
--
ALTER TABLE `bus`
  MODIFY `idBus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT για πίνακα `bus_assignment`
--
ALTER TABLE `bus_assignment`
  MODIFY `AssignmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT για πίνακα `nationality`
--
ALTER TABLE `nationality`
  MODIFY `idNationality` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT για πίνακα `reservations`
--
ALTER TABLE `reservations`
  MODIFY `idReservations` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `pickup`
--
ALTER TABLE `pickup`
  ADD CONSTRAINT `PPointGroup_fkey` FOREIGN KEY (`PPointGroup`) REFERENCES `ptime` (`PPointGroup`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_Reservations_1` FOREIGN KEY (`ExcursionID`) REFERENCES `excursion` (`idExcursion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Reservations_2` FOREIGN KEY (`Pickup`) REFERENCES `pickup` (`idPickup`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Reservations_3` FOREIGN KEY (`HotelID`) REFERENCES `hotel` (`idHotel`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Reservations_4` FOREIGN KEY (`ReservationOfficeID`) REFERENCES `office` (`idOffice`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
