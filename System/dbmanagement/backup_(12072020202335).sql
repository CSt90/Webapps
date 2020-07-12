SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- Database: `Systemdb`
--


DROP TABLE IF EXISTS bus;

CREATE TABLE `bus` (
  `idBus` int(11) NOT NULL AUTO_INCREMENT,
  `BName` varchar(6) NOT NULL,
  `Seats` int(11) NOT NULL,
  PRIMARY KEY (`idBus`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

INSERT INTO bus VALUES("103","55","55");
INSERT INTO bus VALUES("104","50","50");
INSERT INTO bus VALUES("105","55(2)","55");
INSERT INTO bus VALUES("113","49","49");
INSERT INTO bus VALUES("114","55(3)","55");
INSERT INTO bus VALUES("115","49(2)","49");
INSERT INTO bus VALUES("116","75","75");
INSERT INTO bus VALUES("120","30","30");
INSERT INTO bus VALUES("121","40","40");



DROP TABLE IF EXISTS bus_assignment;

CREATE TABLE `bus_assignment` (
  `AssignmentID` int(11) NOT NULL AUTO_INCREMENT,
  `ExcursionID` int(5) NOT NULL,
  `ExcursionDate` date NOT NULL,
  `BusID` int(11) NOT NULL,
  `Drivers` varchar(60) DEFAULT NULL,
  `Guides` varchar(60) DEFAULT NULL,
  `BANotes` text,
  `Assigned` int(1) NOT NULL,
  PRIMARY KEY (`AssignmentID`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

INSERT INTO bus_assignment VALUES("13","9","2016-11-30","107","","","","0");
INSERT INTO bus_assignment VALUES("14","1","2016-11-23","107","","","","0");
INSERT INTO bus_assignment VALUES("29","1","2017-05-31","106","","","","0");
INSERT INTO bus_assignment VALUES("33","6","2017-05-26","106","","","","0");
INSERT INTO bus_assignment VALUES("40","8","2017-06-08","105","","","","0");
INSERT INTO bus_assignment VALUES("41","8","2017-06-08","113","","","","0");
INSERT INTO bus_assignment VALUES("42","5","2017-06-08","113","","","","0");
INSERT INTO bus_assignment VALUES("43","14","2017-06-06","105","Mike","Lisa, George","Stop at the gas station","0");
INSERT INTO bus_assignment VALUES("44","3","2017-07-16","118","","","","0");
INSERT INTO bus_assignment VALUES("45","16","2017-07-16","113","","","","0");
INSERT INTO bus_assignment VALUES("46","3","2017-10-18","105","","","","0");
INSERT INTO bus_assignment VALUES("48","16","2017-10-18","105","","","","0");
INSERT INTO bus_assignment VALUES("52","13","2017-10-20","113","κλκσ","jkjjslla","j","0");
INSERT INTO bus_assignment VALUES("65","16","2017-10-20","0","κξκδδδδ","jkjjslla","nnmkalkklaa","0");
INSERT INTO bus_assignment VALUES("66","13","2017-10-27","0","","nmm","","0");
INSERT INTO bus_assignment VALUES("67","16","2017-10-27","0","","mcnxxm","","0");
INSERT INTO bus_assignment VALUES("68","14","2017-10-28","0","","jjkks","","0");
INSERT INTO bus_assignment VALUES("70","16","2017-10-20","105","","","","0");
INSERT INTO bus_assignment VALUES("72","14","2017-06-20","104","","","","0");
INSERT INTO bus_assignment VALUES("73","20","2017-06-20","104","","","","0");
INSERT INTO bus_assignment VALUES("74","17","2019-02-20","104","Georg","Natasha","No notes","0");
INSERT INTO bus_assignment VALUES("75","14","2019-03-19","105","","","","0");
INSERT INTO bus_assignment VALUES("76","14","2019-03-19","103","","","","0");
INSERT INTO bus_assignment VALUES("77","14","2019-03-19","104","","","","0");
INSERT INTO bus_assignment VALUES("78","18","2019-03-19","114","","","","0");
INSERT INTO bus_assignment VALUES("79","18","2019-03-19","121","","","","0");
INSERT INTO bus_assignment VALUES("80","17","2019-04-10","104","","","","0");
INSERT INTO bus_assignment VALUES("81","17","2019-04-10","105","","","","0");
INSERT INTO bus_assignment VALUES("82","20","2019-04-10","104","","","","0");
INSERT INTO bus_assignment VALUES("83","20","2019-04-10","105","","","","0");
INSERT INTO bus_assignment VALUES("84","18","2019-04-09","105","","","","0");
INSERT INTO bus_assignment VALUES("85","18","2019-04-09","121","","","","0");



DROP TABLE IF EXISTS driver;

CREATE TABLE `driver` (
  `idDriver` int(11) NOT NULL,
  `DName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDriver`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO driver VALUES("1","Driver 1");
INSERT INTO driver VALUES("2","Driver 2");
INSERT INTO driver VALUES("3","Driver 3");
INSERT INTO driver VALUES("4","Drv 6");



DROP TABLE IF EXISTS excursion;

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
  `EPrice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idExcursion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO excursion VALUES("3","Excursion 1","0000-00-00","0","0","1","0","0","0","1","07:30:00","20:30:00","29.00");
INSERT INTO excursion VALUES("5","}_Excursion 2 Res_{","0000-00-00","0","0","0","1","0","0","0","09:00:00","18:00:00","26.00");
INSERT INTO excursion VALUES("8","Excursion 3","0000-00-00","1","0","0","1","0","0","0","08:00:00","17:00:00","30.00");
INSERT INTO excursion VALUES("13","Excursion 13","0000-00-00","0","0","0","0","1","0","0","17:30:00","23:00:00","18.00");
INSERT INTO excursion VALUES("14","Excursion 5 Res","0000-00-00","0","1","0","0","0","1","0","07:30:00","18:15:00","30.00");
INSERT INTO excursion VALUES("17","Margarites - Matala - Ag. Galini","","0","0","1","0","0","0","0","00:00:00","00:00:00","20.00");
INSERT INTO excursion VALUES("18","Excursion 55","","0","1","0","0","0","1","0","07:00:00","20:00:00","30.00");
INSERT INTO excursion VALUES("21","Excursion 2019","","0","1","0","0","1","0","1","07:15:00","14:55:00","21.00");



DROP TABLE IF EXISTS guide;

CREATE TABLE `guide` (
  `idGuide` int(11) NOT NULL,
  `GName` varchar(40) NOT NULL,
  PRIMARY KEY (`idGuide`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO guide VALUES("1","Guide1");
INSERT INTO guide VALUES("2","Guide2");



DROP TABLE IF EXISTS hotel;

CREATE TABLE `hotel` (
  `idHotel` int(11) NOT NULL,
  `HArea` varchar(40) DEFAULT NULL,
  `HName` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `HPhone` varchar(18) DEFAULT NULL,
  `HRow` int(11) DEFAULT NULL,
  `PPWest` int(11) DEFAULT NULL,
  `PPEast` int(11) DEFAULT NULL,
  `notes` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idHotel`),
  KEY `PPWest` (`PPWest`),
  KEY `PPEast` (`PPEast`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO hotel VALUES("25400","ΡΕΘΥΜΝΟ","Private (City)","","134","0","0","");
INSERT INTO hotel VALUES("25500","ΡΕΘΥΜΝΟ","Private (Outside)","","135","0","0","");
INSERT INTO hotel VALUES("530003","ΜΠΑΛΙ","Bali Beach & Village","2834094210","1","50","50","");
INSERT INTO hotel VALUES("530005","Ρέθυμνο","New Hotel 1","","0","760","50","Some note");
INSERT INTO hotel VALUES("530013","ΜΠΑΛΙ","Bali Mare","2834094375","1","50","50","");
INSERT INTO hotel VALUES("530023","ΜΠΑΛΙ","Ormos Atalia Aparthotel","2834094401","1","50","50","");
INSERT INTO hotel VALUES("530033","ΜΠΑΛΙ","Bali Paradise","2834094253","1","50","50","");
INSERT INTO hotel VALUES("530043","ΜΠΑΛΙ","Bali Star","2834094212","1","20","20","");
INSERT INTO hotel VALUES("530053","ΜΠΑΛΙ","Amalia Apartments","2834094212","1","50","50","");
INSERT INTO hotel VALUES("530063","ΜΠΑΛΙ","Lisa Mari Beach","2834094073","1","30","30","");
INSERT INTO hotel VALUES("530073","ΜΠΑΛΙ","Talea Beach","","1","40","40","");
INSERT INTO hotel VALUES("530083","ΜΠΑΛΙ","Aparthotel Sofia - Mythos Beach","2834094450","1","50","50","");
INSERT INTO hotel VALUES("530093","ΜΠΑΛΙ","Xidas Garden","2834094269","1","50","50","");
INSERT INTO hotel VALUES("530103","ΜΠΑΛΙ","Bella Vista","2834094032","1","50","50","");
INSERT INTO hotel VALUES("530113","ΜΠΑΛΙ","Blue Horizon","2834094004","1","50","50","");
INSERT INTO hotel VALUES("530123","ΜΠΑΛΙ","Carpe Diem","2834022491","1","50","50","");
INSERT INTO hotel VALUES("530133","ΜΠΑΛΙ","Elpis Studios & Apartments","2834094444","1","50","50","");
INSERT INTO hotel VALUES("530143","ΜΠΑΛΙ","Troulis","2834094289","1","50","50","");
INSERT INTO hotel VALUES("550003","ΠΑΝΟΡΜΟΣ","Iliana Hotel Apartments","2834051447","2","60","60","");
INSERT INTO hotel VALUES("550013","ΠΑΝΟΡΜΟΣ","Kirki Village","2834051225","2","60","60","");
INSERT INTO hotel VALUES("550023","ΠΑΝΟΡΜΟΣ","Panormo Beach","2834051209","2","60","60","");
INSERT INTO hotel VALUES("550033","ΠΑΝΟΡΜΟΣ","Philoxenia Apartments","2834051481","2","60","60","");
INSERT INTO hotel VALUES("550043","ΠΑΝΟΡΜΟΣ","Stella Beach","2834051481","2","60","60","");
INSERT INTO hotel VALUES("550053","ΠΑΝΟΡΜΟΣ","Marine Palace","2834051610","4","70","70","");
INSERT INTO hotel VALUES("550063","ΠΑΝΟΡΜΟΣ","Europa Resort","2834020200","5","70","70","");
INSERT INTO hotel VALUES("550073","ΠΑΝΟΡΜΟΣ","Sensimar Royal Blue Resort & Spa","2834055000","6","70","70","");
INSERT INTO hotel VALUES("550083","ΠΑΝΟΡΜΟΣ","Creta Marine","2834051290","7","80","80","");
INSERT INTO hotel VALUES("550093","ΠΑΝΟΡΜΟΣ","Creta Panorama","2834051502","7","90","90","");
INSERT INTO hotel VALUES("600003","ΣΚΑΛΕΤΑ","Oasis","2831071774","8","100","105","");
INSERT INTO hotel VALUES("600013","ΣΚΑΛΕΤΑ","Begeti Bay","2831071909","8","100","105","");
INSERT INTO hotel VALUES("600023","ΣΚΑΛΕΤΑ","Prinos Resort","2831072414","9","100","105","");
INSERT INTO hotel VALUES("600033","ΣΚΑΛΕΤΑ","Rethymno Mare Royal","2831071703","9","100","105","");
INSERT INTO hotel VALUES("600043","ΣΚΑΛΕΤΑ","Babis","2831071193","10","100","105","");
INSERT INTO hotel VALUES("600053","ΣΚΑΛΕΤΑ","Scaleta Beach","2831071702","11","100","105","");
INSERT INTO hotel VALUES("600063","ΣΚΑΛΕΤΑ","Creta Royal","2831071812","11","110","110","");
INSERT INTO hotel VALUES("600073","ΣΤΑΥΡΩΜΕΝΟΣ","Stavromenos Villas","2831071053","11","110","110","");
INSERT INTO hotel VALUES("600083","ΣΤΑΥΡΩΜΕΝΟΣ","Creta Star","2831071812","11","110","110","");
INSERT INTO hotel VALUES("600093","ΣΤΑΥΡΩΜΕΝΟΣ","Corali Beach","2831071967","11","120","120","");
INSERT INTO hotel VALUES("600103","ΣΦΑΚΑΚΙ","Krini Beach","2831072903","11","120","120","");
INSERT INTO hotel VALUES("600113","ΣΚΑΛΕΤΑ","Gortyna","2831071846","12","120","120","");
INSERT INTO hotel VALUES("600123","ΣΤΑΥΡΩΜΕΝΟΣ","Yannis Aparthotel","","13","120","120","");
INSERT INTO hotel VALUES("600133","ΣΤΑΥΡΩΜΕΝΟΣ","Thalassi","2831071990","14","120","120","");
INSERT INTO hotel VALUES("600143","ΣΤΑΥΡΩΜΕΝΟΣ","Nautica","2831055577","14","120","120","");
INSERT INTO hotel VALUES("600153","ΠΑΓΚΑΛΟΧΩΡΙ","Alkionis","2831071584","15","120","120","");
INSERT INTO hotel VALUES("600163","ΠΑΓΚΑΛΟΧΩΡΙ","Almyra Apartments","2831074675","15","120","120","");
INSERT INTO hotel VALUES("600173","ΣΤΑΥΡΩΜΕΝΟΣ","Agelia Beach","2831072032","16","130","130","");
INSERT INTO hotel VALUES("600183","ΣΤΑΥΡΩΜΕΝΟΣ","Ekavi Beach","2831071896","16","130","130","");
INSERT INTO hotel VALUES("600193","ΣΤΑΥΡΩΜΕΝΟΣ","Dedalos Beach","2831073035","16","130","130","");
INSERT INTO hotel VALUES("600203","ΣΤΑΥΡΩΜΕΝΟΣ","Golden Sand Boutique","2831072032","16","130","130","");
INSERT INTO hotel VALUES("600213","ΣΤΑΥΡΩΜΕΝΟΣ","Danaos Beach","2831073025","17","130","130","");
INSERT INTO hotel VALUES("600223","ΣΤΑΥΡΩΜΕΝΟΣ","Rosebay Apartments","2831054413","17","130","130","");
INSERT INTO hotel VALUES("600233","ΣΤΑΥΡΩΜΕΝΟΣ","Chrisanna Apartments & Studios","2831071195","17","130","130","");
INSERT INTO hotel VALUES("600243","ΣΤΑΥΡΩΜΕΝΟΣ","Sunrise Hotel Apartments","2834022791","17","130","130","");
INSERT INTO hotel VALUES("600253","ΣΤΑΥΡΩΜΕΝΟΣ","Radamanthys Apartments","2931072691","17","130","130","");
INSERT INTO hotel VALUES("610003","ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ","Amnissos","2831072460","18","140","140","");
INSERT INTO hotel VALUES("610013","ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ","White Palace","2831071102","19","150","150","");
INSERT INTO hotel VALUES("610023","ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ","Limas","2831072257","19","150","150","");
INSERT INTO hotel VALUES("610033","ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ","Keti (Kaiti) Apartments","2831051480","19","150","150","");
INSERT INTO hotel VALUES("610043","ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ","Alkyon","2831071136","19","150","150","");
INSERT INTO hotel VALUES("610053","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Maravel","2831072916","21","160","160","");
INSERT INTO hotel VALUES("610063","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Dias","2831071017","22","170","170","");
INSERT INTO hotel VALUES("610073","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Solimar Dias","2831071177","22","170","170","");
INSERT INTO hotel VALUES("610083","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Blue sky","2831057560","23","170","170","");
INSERT INTO hotel VALUES("610093","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Rethymno Palace","2831072418","24","180","180","");
INSERT INTO hotel VALUES("610103","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Jo An Beach","2831024241","25","200","200","");
INSERT INTO hotel VALUES("610113","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Seafront Apartments","2831072600","25","190","190","");
INSERT INTO hotel VALUES("610123","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Stella Katrin","2831021690","26","190","190","");
INSERT INTO hotel VALUES("610133","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Maravel Land","2831071063","27","210","210","");
INSERT INTO hotel VALUES("610143","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Caramel","2831071803","28","220","220","");
INSERT INTO hotel VALUES("610153","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Rethymno Residence","2831072633","29","230","230","");
INSERT INTO hotel VALUES("615003","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Rithymna Beach","2831071002","30","240","240","");
INSERT INTO hotel VALUES("615013","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Orion","2831071471","31","250","250","");
INSERT INTO hotel VALUES("615023","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Eva Bay","2831020760","32","270","270","");
INSERT INTO hotel VALUES("615033","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Adele Beach","2831071081","33","280","280","");
INSERT INTO hotel VALUES("615043","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Christina Apartments","","34","300","300","");
INSERT INTO hotel VALUES("615053","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Galeana Mare","2831073006","34","290","290","");
INSERT INTO hotel VALUES("615063","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Palladion","2831028976","35","310","310","");
INSERT INTO hotel VALUES("615073","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Golden Beach","2831071012","36","320","320","");
INSERT INTO hotel VALUES("615083","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Kathrin Beach","2831071757","37","330","330","");
INSERT INTO hotel VALUES("615093","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Edem Beach","2831073963","38","350","350","");
INSERT INTO hotel VALUES("620003","ΠΛΑΤΑΝΕΣ","Rethymno Village","2831025523","39","360","360","");
INSERT INTO hotel VALUES("620013","ΠΛΑΤΑΝΕΣ","Leoniki Residence","2831029232","40","370","370","");
INSERT INTO hotel VALUES("620023","ΠΛΑΤΑΝΕΣ","Cretan Sun","2831027077","41","370","370","");
INSERT INTO hotel VALUES("620033","ΠΛΑΤΑΝΕΣ","Marinos Beach","2831027840","42","390","390","");
INSERT INTO hotel VALUES("620043","ΠΛΑΤΑΝΕΣ","Galeana Beach","2831051141","43","380","380","");
INSERT INTO hotel VALUES("620053","ΠΛΑΤΑΝΕΣ","Axos","2831020472","44","400","400","");
INSERT INTO hotel VALUES("620063","ΠΛΑΤΑΝΕΣ","Castello Bianco","831020029","45","410","410","");
INSERT INTO hotel VALUES("620073","ΠΛΑΤΑΝΙΑΣ","Apollon","2831050300","46","410","410","");
INSERT INTO hotel VALUES("620083","ΠΛΑΤΑΝΙΑΣ","Creta Residence","","47","440","440","");
INSERT INTO hotel VALUES("620093","ΠΛΑΤΑΝΙΑΣ","Minos Mare","","47","440","440","");
INSERT INTO hotel VALUES("620103","ΠΛΑΤΑΝΕΣ","Nefeli","2831055321","47","410","410","");
INSERT INTO hotel VALUES("620113","ΠΛΑΤΑΝΕΣ","La Stella","2831027545","49","440","440","");
INSERT INTO hotel VALUES("620123","ΠΛΑΤΑΝΕΣ","Evelin","","49","440","440","");
INSERT INTO hotel VALUES("620133","ΠΛΑΤΑΝΕΣ","Creta Sun","","49","440","440","");
INSERT INTO hotel VALUES("620143","ΠΛΑΤΑΝΕΣ","Trefon","2831024772","50","420","420","");
INSERT INTO hotel VALUES("620153","ΠΛΑΤΑΝΕΣ","Bella Casita","2831025552","48","420","420","");
INSERT INTO hotel VALUES("620163","ΠΛΑΤΑΝΕΣ","Amaril","2831056665","50","420","420","");
INSERT INTO hotel VALUES("620173","ΠΛΑΤΑΝΕΣ","Varvaras Diamond","2831035474","50","420","420","");
INSERT INTO hotel VALUES("620183","ΠΛΑΤΑΝΕΣ","Bueno","2831025554","50","420","420","");
INSERT INTO hotel VALUES("620193","ΠΛΑΤΑΝΕΣ","Mary Hotel","2831021402","51","440","440","");
INSERT INTO hotel VALUES("620203","ΠΛΑΤΑΝΙΑΣ","Julia Apartments","2831025566","52","440","440","");
INSERT INTO hotel VALUES("620213","ΠΛΑΤΑΝΙΑΣ","Minos Mare Royal","2831050388","53","420","420","");
INSERT INTO hotel VALUES("620223","ΠΛΑΤΑΝΙΑΣ","Marianthi Apartments","2831055625","54","440","440","");
INSERT INTO hotel VALUES("625003","ΡΕΘΥΜΝΟ","Mantenia","283155169","55","450","450","");
INSERT INTO hotel VALUES("625013","ΜΥΣΣΙΡΙΑ","May","2831055745","55","460","460","");
INSERT INTO hotel VALUES("625023","ΜΥΣΣΙΡΙΑ","Creta Palace","2831021181","56","470","470","main road");
INSERT INTO hotel VALUES("625033","ΜΥΣΣΙΡΙΑ","Chrissas Apartments","2831023372","57","470","470","main road");
INSERT INTO hotel VALUES("625043","ΜΥΣΣΙΡΙΑ","Athina Rent Rooms Restaurant","2831024717","58","480","480","");
INSERT INTO hotel VALUES("625053","ΜΥΣΣΙΡΙΑ","Camping Elizabeth","2831028694","59","480","480","");
INSERT INTO hotel VALUES("625063","ΜΥΣΣΙΡΙΑ","Missiria Apartments","2831025576","60","500","500","");
INSERT INTO hotel VALUES("625073","ΜΥΣΣΙΡΙΑ","Anna Apartments","","61","490","490","");
INSERT INTO hotel VALUES("625083","ΜΥΣΣΙΡΙΑ","Dimitrios Village","2831025647","62","510","510","");
INSERT INTO hotel VALUES("625093","ΜΥΣΣΙΡΙΑ","Odyssia Beach","2831027874","62","510","510","");
INSERT INTO hotel VALUES("625103","ΜΥΣΣΙΡΙΑ","Omiros Boutique","2831027874","63","510","510","");
INSERT INTO hotel VALUES("625113","ΜΥΣΣΙΡΙΑ","Ilian Beach","2831027205","64","510","510","");
INSERT INTO hotel VALUES("625123","ΜΥΣΣΙΡΙΑ","Domenica","2831027362","64","510","510","");
INSERT INTO hotel VALUES("625133","ΡΕΘΥΜΝΟ","Aristea","2831035358","65","510","510","");
INSERT INTO hotel VALUES("630003","ΠΕΡΙΒΟΛΙΑ","Dimitrios Beach","2831056660","66","520","515","");
INSERT INTO hotel VALUES("630013","ΡΕΘΥΜΝΟ","Anita Beach","","66","530","515","");
INSERT INTO hotel VALUES("630023","ΡΕΘΥΜΝΟ","Iperion Beach","2831053765","67","540","565","");
INSERT INTO hotel VALUES("630033","ΠΕΡΙΒΟΛΙΑ","Pearl Beach","2831020891","67","540","565","");
INSERT INTO hotel VALUES("630043","ΜΥΣΣΙΡΙΑ","Esperia","2831021271","68","540","565","");
INSERT INTO hotel VALUES("630053","ΠΕΡΙΒΟΛΙΑ","Aegean Pearl","2831023733","69","540","565","");
INSERT INTO hotel VALUES("630063","ΠΕΡΙΒΟΛΙΑ","Plaza Spa","2831051505","70","550","550","");
INSERT INTO hotel VALUES("630073","ΠΕΡΙΒΟΛΙΑ","Yacinthos","2831023635","71","550","550","");
INSERT INTO hotel VALUES("630083","ΠΕΡΙΒΟΛΙΑ","Olympic II","2831024761","72","560","560","");
INSERT INTO hotel VALUES("630093","ΠΕΡΙΒΟΛΙΑ","Summer Dream","2831051174","73","580","580","");
INSERT INTO hotel VALUES("630103","ΠΕΡΙΒΟΛΙΑ","Melitti","2831056696","73","570","570","");
INSERT INTO hotel VALUES("630113","ΠΕΡΙΒΟΛΙΑ","Golden Coast","2831021444","74","580","580","");
INSERT INTO hotel VALUES("630123","ΠΕΡΙΒΟΛΙΑ","Flisvos Beach","2831026784","75","570","570","");
INSERT INTO hotel VALUES("630133","ΠΕΡΙΒΟΛΙΑ","Erato Hotel Apartments","2831026913","75","580","580","");
INSERT INTO hotel VALUES("630143","ΠΕΡΙΒΟΛΙΑ","Marilyn Apartments","2831055247","76","580","580","");
INSERT INTO hotel VALUES("630153","ΠΕΡΙΒΟΛΙΑ","Zannis","2831035363","76","580","580","");
INSERT INTO hotel VALUES("630163","ΠΕΡΙΒΟΛΙΑ","Daisy","2831050001","77","610","610","");
INSERT INTO hotel VALUES("630173","ΠΕΡΙΒΟΛΙΑ","Olympia","2831029815","77","610","610","");
INSERT INTO hotel VALUES("630183","ΠΕΡΙΒΟΛΙΑ","Fouli Studios & Apartments","2831026956","77","610","610","");
INSERT INTO hotel VALUES("630193","ΠΕΡΙΒΟΛΙΑ","Blue Sky Apartments","2831057560","78","610","610","");
INSERT INTO hotel VALUES("630203","ΡΕΘΥΜΝΟ","Atlantis Beach","2831051002","79","618","618","");
INSERT INTO hotel VALUES("630213","ΡΕΘΥΜΝΟ","Marel","2831053463","80","600","600","");
INSERT INTO hotel VALUES("630223","ΡΕΘΥΜΝΟ","Eltina","2831055231","81","660","660","");
INSERT INTO hotel VALUES("630233","ΡΕΘΥΜΝΟ","Family Homes Zaharias","2831028584","82","630","630","");
INSERT INTO hotel VALUES("630243","ΡΕΘΥΜΝΟ","Aris Apartments","2831025867","83","630","630","");
INSERT INTO hotel VALUES("630253","ΠΕΡΙΒΟΛΙΑ","Blue Sea Apartments","2831054804","83","630","630","");
INSERT INTO hotel VALUES("630263","ΠΕΡΙΒΟΛΙΑ","Melmar","2831054908","83","660","648","");
INSERT INTO hotel VALUES("630273","ΠΕΡΙΒΟΛΙΑ","Ibiscos Garden","2831051112","83","660","648","");
INSERT INTO hotel VALUES("630283","ΠΕΡΙΒΟΛΙΑ","Zantina","2831024863","84","620","620","");
INSERT INTO hotel VALUES("630293","ΡΕΘΥΜΝΟ","Batis","2831050558","85","640","640","");
INSERT INTO hotel VALUES("630303","ΡΕΘΥΜΝΟ","Ammos Studios","2831036123","86","620","620","");
INSERT INTO hotel VALUES("635003","ΡΕΘΥΜΝΟ","Ostria","2831027705","87","650","650","");
INSERT INTO hotel VALUES("635013","ΡΕΘΥΜΝΟ","Medusa","2831027937","88","650","650","");
INSERT INTO hotel VALUES("635023","ΠΕΡΙΒΟΛΙΑ","Minos","2831053921","89","660","648","");
INSERT INTO hotel VALUES("635033","ΡΕΘΥΜΝΟ","Atrium","2831057601","90","670","646","");
INSERT INTO hotel VALUES("635043","ΡΕΘΥΜΝΟ","Lefkoniko Bay","2831025495","90","680","643","");
INSERT INTO hotel VALUES("635053","ΚΑΛΛΙΘΕΑ","Lefkoniko Beach","2831055326","90","680","643","");
INSERT INTO hotel VALUES("635063","ΡΕΘΥΜΝΟ","Theartemis Palace","2831053991","90","670","646","");
INSERT INTO hotel VALUES("635073","ΡΕΘΥΜΝΟ","Bella Mare","2831035494","91","680","643","");
INSERT INTO hotel VALUES("635083","ΡΕΘΥΜΝΟ","Kleoniki Mare","2831040699","91","680","643","");
INSERT INTO hotel VALUES("640003","ΡΕΘΥΜΝΟ","Swell Boutique","2831050110","91","690","690","");
INSERT INTO hotel VALUES("640013","ΡΕΘΥΜΝΟ","Palm Beach Hotel Apartments","2831025597","92","720","720","");
INSERT INTO hotel VALUES("640023","ΡΕΘΥΜΝΟ","Aloe Apartments","2831025450","92","720","720","");
INSERT INTO hotel VALUES("640033","ΡΕΘΥΜΝΟ","Steris Beach","2831028303","93","720","720","");
INSERT INTO hotel VALUES("640043","ΡΕΘΥΜΝΟ","Leonidas Hotel & Apartments","2831051754","94","720","720","");
INSERT INTO hotel VALUES("640053","ΡΕΘΥΜΝΟ","Birais","2831055529","94","720","720","");
INSERT INTO hotel VALUES("640063","ΡΕΘΥΜΝΟ","Theo","2831050187","95","700","700","");
INSERT INTO hotel VALUES("640073","ΡΕΘΥΜΝΟ","Poseidon","2831023795","95","700","700","");
INSERT INTO hotel VALUES("640083","ΡΕΘΥΜΝΟ","Pegasus","2831025530","96","700","700","");
INSERT INTO hotel VALUES("640093","ΡΕΘΥΜΝΟ","Bio Suites","283158403","97","730","730","");
INSERT INTO hotel VALUES("640103","ΡΕΘΥΜΝΟ","Porto Rethymno","2831050432","97","730","730","");
INSERT INTO hotel VALUES("640113","ΡΕΘΥΜΝΟ","Ilios Beach Hotel Apartments","2831055672","98","730","730","");
INSERT INTO hotel VALUES("640123","ΡΕΘΥΜΝΟ","Kriti Beach","2831027401","99","750","750","");
INSERT INTO hotel VALUES("640133","ΡΕΘΥΜΝΟ","The Sea View Apartments","2831024533","100","750","750","");
INSERT INTO hotel VALUES("640143","ΡΕΘΥΜΝΟ","Cosmos","2831052244","100","760","760","");
INSERT INTO hotel VALUES("640153","ΡΕΘΥΜΝΟ","Aqua Marina","2831035340","100","760","760","");
INSERT INTO hotel VALUES("640163","ΡΕΘΥΜΝΟ","Astali","2831024721","101","770","770","");
INSERT INTO hotel VALUES("640173","ΡΕΘΥΜΝΟ","Elina Hotel Apartments","2831027395","101","770","770","");
INSERT INTO hotel VALUES("640183","ΡΕΘΥΜΝΟ","Achillion Palace","2831051502","102","770","770","");
INSERT INTO hotel VALUES("640193","ΡΕΘΥΜΝΟ","Jason","2831022542","102","760","760","");
INSERT INTO hotel VALUES("640203","ΡΕΘΥΜΝΟ","Constantin","2831020221","102","760","760","");
INSERT INTO hotel VALUES("640213","ΡΕΘΥΜΝΟ","Kyma Beach","2831055503","103","760","760","");
INSERT INTO hotel VALUES("645003","ΕΥΛΗΓΙΑ","Forest Park","2831051778","101","760","760","");
INSERT INTO hotel VALUES("645013","ΡΕΘΥΜΝΟ","Liberty","2831055851","104","790","795","");
INSERT INTO hotel VALUES("645023","ΡΕΘΥΜΝΟ","Olympic Palladium","2831024762","104","790","795","");
INSERT INTO hotel VALUES("645033","ΡΕΘΥΜΝΟ","Brascos","2831023721","105","800","805","");
INSERT INTO hotel VALUES("645043","ΡΕΘΥΜΝΟ","Jo-An","2831024241","106","800","805","");
INSERT INTO hotel VALUES("645053","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Afroditi Suites","2831022246","107","800","805","");
INSERT INTO hotel VALUES("645063","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Casa De Delfini","2831055120","107","800","805","");
INSERT INTO hotel VALUES("645073","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Casa Vitae","2831035058","107","800","805","");
INSERT INTO hotel VALUES("645083","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Leo Hotel","2831026197","107","800","805","");
INSERT INTO hotel VALUES("645093","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Vetera Suites","2831023844","107","800","805","");
INSERT INTO hotel VALUES("645103","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Youth Hostel","2831022848","107","800","805","");
INSERT INTO hotel VALUES("645113","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Bellagio Luxury Boutique","2831055777","107","800","805","");
INSERT INTO hotel VALUES("645123","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Civitas Boutique","2831035127","107","800","805","");
INSERT INTO hotel VALUES("645133","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Mythos Suites","2831053917","107","800","805","");
INSERT INTO hotel VALUES("645143","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Rethymno House","2831023924","107","800","805","");
INSERT INTO hotel VALUES("645153","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Pepi Studios","2831026428","107","800","805","");
INSERT INTO hotel VALUES("645163","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Anna\\\\\\\'s Apartments (Old Town)","2831052951","107","800","805","");
INSERT INTO hotel VALUES("645173","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Rimondi Boutique","2831051289","107","800","805","");
INSERT INTO hotel VALUES("645183","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Palazzo Rimondi","2831051001","108","800","805","");
INSERT INTO hotel VALUES("645193","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Palazzino Di Corina","2831021205","108","800","805","");
INSERT INTO hotel VALUES("645203","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Palazzo Vecchio","2831035351","108","800","805","");
INSERT INTO hotel VALUES("645213","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","VECCHIO","2831054985","108","800","805","");
INSERT INTO hotel VALUES("645223","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Fortezza","2831055551","108","800","805","");
INSERT INTO hotel VALUES("645233","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Ideon","2831028667","108","800","805","");
INSERT INTO hotel VALUES("645243","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Barbara Studios","2831022607","108","800","805","");
INSERT INTO hotel VALUES("645253","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Sohora Boutique Hotel","2831300913","108","800","805","");
INSERT INTO hotel VALUES("645263","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Avli Lounge Apartments","2831058250","108","800","805","");
INSERT INTO hotel VALUES("645273","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Private (Old Town)","","108","800","805","");
INSERT INTO hotel VALUES("650003","ΡΕΘΥΜΝΟ","Belvedere","2831026898","109","810","810","");
INSERT INTO hotel VALUES("650013","ΡΕΘΥΜΝΟ","Archipelagos Residence","2831054754","110","820","820","");
INSERT INTO hotel VALUES("650023","ΡΕΘΥΜΝΟ","Macaris Suites & Spa","2831054757","110","810","810","");
INSERT INTO hotel VALUES("650033","ΡΕΘΥΜΝΟ","Creta Seafront Residences","2831022208","111","830","830","");
INSERT INTO hotel VALUES("650043","ΡΕΘΥΜΝΟ","Rethymno Hills","2831057040","112","830","830","");
INSERT INTO hotel VALUES("650053","ΡΕΘΥΜΝΟ","Filoxenia Beach","2831055325","113","830","830","");
INSERT INTO hotel VALUES("650063","ΡΕΘΥΜΝΟ","Petradi Beach Lounge","2831055325","114","830","830","");
INSERT INTO hotel VALUES("650073","ΚΟΥΜΠΕΣ","Delfini Beach (Koumpes)","2831035245","115","840","840","");
INSERT INTO hotel VALUES("650083","ΑΤΣΙΠΟΠΟΥΛΟ","Rethymno Panorama","2831026250","116","850","850","");
INSERT INTO hotel VALUES("650093","ΑΤΣΙΠΟΠΟΥΛΟ","Pantheon","2831054914","116","850","850","");
INSERT INTO hotel VALUES("705003","ΝΕΒΕΛΟ","Camari Garden","2831031272","117","860","860","");
INSERT INTO hotel VALUES("705013","ΓΕΩΡΓΙΟΥΠΟΛΗ","Hydramis Palace","2831061000","118","870","870","");
INSERT INTO hotel VALUES("705023","ΓΕΩΡΓΙΟΥΠΟΛΗ","Ermioni Beach","2831061678","119","870","870","");
INSERT INTO hotel VALUES("705033","ΓΕΩΡΓΙΟΥΠΟΛΗ","Poledas Apartments","2831061062","119","870","870","");
INSERT INTO hotel VALUES("705043","ΓΕΩΡΓΙΟΥΠΟΛΗ","Palladion (Kavros)","2831061720","119","870","870","");
INSERT INTO hotel VALUES("705053","ΓΕΩΡΓΙΟΥΠΟΛΗ","Anatoli Beach (Kavros)","2825061001","120","880","880","");
INSERT INTO hotel VALUES("705063","ΓΕΩΡΓΙΟΥΠΟΛΗ","Kavros Beach (Kavros)","","120","880","880","");
INSERT INTO hotel VALUES("705073","ΓΕΩΡΓΙΟΥΠΟΛΗ","Aquamar Beach (Kavros)","2825061332","120","880","880","");
INSERT INTO hotel VALUES("705083","ΓΕΩΡΓΙΟΥΠΟΛΗ","Silver Beach (Kavros)","2825083078","121","890","890","");
INSERT INTO hotel VALUES("705093","ΓΕΩΡΓΙΟΥΠΟΛΗ","Kournas Village (Kavros)","2825061416","121","890","890","");
INSERT INTO hotel VALUES("705103","ΓΕΩΡΓΙΟΥΠΟΛΗ","Happy Days (Kavros)","2825061201","122","900","900","");
INSERT INTO hotel VALUES("705113","ΓΕΩΡΓΙΟΥΠΟΛΗ","Sandy Beach (Kavros)","2825061201","122","900","900","");
INSERT INTO hotel VALUES("705123","ΓΕΩΡΓΙΟΥΠΟΛΗ","Orpheas Resort (Kavros)","2825061218","122","900","900","");
INSERT INTO hotel VALUES("705133","ΓΕΩΡΓΙΟΥΠΟΛΗ","Vantaris Beach (Kavros)","2825061231","123","910","910","");
INSERT INTO hotel VALUES("705143","ΓΕΩΡΓΙΟΥΠΟΛΗ","Delfina Art Resort (Kavros)","2825061272","123","910","910","");
INSERT INTO hotel VALUES("705153","ΓΕΩΡΓΙΟΥΠΟΛΗ","Apollo (Kavros)","2825061100","123","910","910","");
INSERT INTO hotel VALUES("705163","ΓΕΩΡΓΙΟΥΠΟΛΗ","Eliros Mare (Kavros)","2825061181","124","910","910","");
INSERT INTO hotel VALUES("705173","ΓΕΩΡΓΙΟΥΠΟΛΗ","Vantaris Palace (Kavros)","2825061783","125","910","910","");
INSERT INTO hotel VALUES("705183","ΓΕΩΡΓΙΟΥΠΟΛΗ","Delfina Beach (Kavros)","2825061272","126","910","910","");
INSERT INTO hotel VALUES("705193","ΓΕΩΡΓΙΟΥΠΟΛΗ","Mythos Palace Resort & Spa (Kavros)","2825061713","127","910","910","");
INSERT INTO hotel VALUES("705203","ΓΕΩΡΓΙΟΥΠΟΛΗ","Georgioupolis Resort (Kavros)","2825061126","128","920","920","");
INSERT INTO hotel VALUES("705213","ΓΕΩΡΓΙΟΥΠΟΛΗ","Anemos Luxury Grand Resort (Kavros)","2825062550","129","920","920","");
INSERT INTO hotel VALUES("705223","ΓΕΩΡΓΙΟΥΠΟΛΗ","Posidon Studios(Kavros)","2825061160","130","920","920","");
INSERT INTO hotel VALUES("705233","ΓΕΩΡΓΙΟΥΠΟΛΗ","Pilot Beach Resort (Kavros)","2825061002","131","930","930","");
INSERT INTO hotel VALUES("705243","ΓΕΩΡΓΙΟΥΠΟΛΗ","Mare Monte Beach (Kavros)","2825061390","132","930","930","");
INSERT INTO hotel VALUES("705253","ΓΕΩΡΓΙΟΥΠΟΛΗ","Kokalas Resort","2825061293","133","940","940","");
INSERT INTO hotel VALUES("705263","ΓΕΩΡΓΙΟΥΠΟΛΗ","Fereniki Resort & Spa","2825061297","133","940","940","");
INSERT INTO hotel VALUES("705273","ΓΕΩΡΓΙΟΥΠΟΛΗ","Corissia Princess","2825083010","133","940","940","");
INSERT INTO hotel VALUES("705283","ΓΕΩΡΓΙΟΥΠΟΛΗ","Corissia Beach","2825083010","133","940","940","");
INSERT INTO hotel VALUES("705293","ΓΕΩΡΓΙΟΥΠΟΛΗ","Georgioupolis Beach","2825061056","133","940","940","");
INSERT INTO hotel VALUES("705393","","Perivolos","","0","0","0","");
INSERT INTO hotel VALUES("705493","ΜΠΑΛΙ","Gold Apartments","","0","50","20","");
INSERT INTO hotel VALUES("705593","","Ermis Apartments","","0","0","0","");
INSERT INTO hotel VALUES("705693","","Michael Apartments","","0","0","0","");
INSERT INTO hotel VALUES("705793","","Byzantine","","0","0","0","");



DROP TABLE IF EXISTS nationality;

CREATE TABLE `nationality` (
  `idNationality` int(11) NOT NULL AUTO_INCREMENT,
  `Country` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Nat` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idNationality`),
  UNIQUE KEY `idNationality` (`idNationality`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO nationality VALUES("1","Great Britain / United Kingdom","GBR");
INSERT INTO nationality VALUES("2","Germany","GER");
INSERT INTO nationality VALUES("3","France","FRA");
INSERT INTO nationality VALUES("4","Russia","RUS");
INSERT INTO nationality VALUES("5","Netherlands","NLD");
INSERT INTO nationality VALUES("6","Austria","AUT");
INSERT INTO nationality VALUES("7","Switzerland","CHE");
INSERT INTO nationality VALUES("8","Norway","NOR");
INSERT INTO nationality VALUES("9","Belgium","BEL");
INSERT INTO nationality VALUES("10","Denmark","DNK");
INSERT INTO nationality VALUES("11","Finland","FIN");
INSERT INTO nationality VALUES("12","Sweden","SWE");
INSERT INTO nationality VALUES("13","Hungary","HUN");
INSERT INTO nationality VALUES("14","Italy","ITA");
INSERT INTO nationality VALUES("15","Spain","ESP");
INSERT INTO nationality VALUES("16","Poland","POL");
INSERT INTO nationality VALUES("17","Portugal","PRT");
INSERT INTO nationality VALUES("18","Afghanistan","AFG");
INSERT INTO nationality VALUES("19","Aland Islands","ALA");
INSERT INTO nationality VALUES("20","Albania","ALB");
INSERT INTO nationality VALUES("21","Algeria","DZA");
INSERT INTO nationality VALUES("22","American Samoa","ASM");
INSERT INTO nationality VALUES("23","Andorra","AND");
INSERT INTO nationality VALUES("24","Angola","AGO");
INSERT INTO nationality VALUES("25","Anguilla","AIA");
INSERT INTO nationality VALUES("26","Antigua and Barbuda","ATG");
INSERT INTO nationality VALUES("27","Argentina","ARG");
INSERT INTO nationality VALUES("28","Argentina","ARM");
INSERT INTO nationality VALUES("29","Aruba","ABW");
INSERT INTO nationality VALUES("30","Australia","AUS");
INSERT INTO nationality VALUES("31","Azerbaijan","AZE");
INSERT INTO nationality VALUES("32","Bahamas","BHS");
INSERT INTO nationality VALUES("33","Bahrain","BHR");
INSERT INTO nationality VALUES("34","Bangladesh","BGD");
INSERT INTO nationality VALUES("35","Barbados","BRB");
INSERT INTO nationality VALUES("36","Belarus","BLR");
INSERT INTO nationality VALUES("37","Belize","BLZ");
INSERT INTO nationality VALUES("38","Benin","BEN");
INSERT INTO nationality VALUES("39","Bermuda","BMU");
INSERT INTO nationality VALUES("40","Bhutan","BTN");
INSERT INTO nationality VALUES("41","Bolivia","BOL");
INSERT INTO nationality VALUES("42","Bosnia and Herzegovina","BIH");
INSERT INTO nationality VALUES("43","Botswana","BWA");
INSERT INTO nationality VALUES("44","Brazil","BRA");
INSERT INTO nationality VALUES("45","British Virgin Islands","VGB");
INSERT INTO nationality VALUES("46","Brunei Darussalam","BRN");
INSERT INTO nationality VALUES("47","Bulgaria","BGR");
INSERT INTO nationality VALUES("48","Burkina Faso","BFA");
INSERT INTO nationality VALUES("49","Burundi","BDI");
INSERT INTO nationality VALUES("50","Cambodia","KHM");
INSERT INTO nationality VALUES("51","Cameroon","CMR");
INSERT INTO nationality VALUES("52","Canada","CAN");
INSERT INTO nationality VALUES("53","Cape Verde","CPV");
INSERT INTO nationality VALUES("54","Cayman Islands","CYM");
INSERT INTO nationality VALUES("55","Central African Republic","CAF");
INSERT INTO nationality VALUES("56","Chad","TCD");
INSERT INTO nationality VALUES("57","Chile","CHL");
INSERT INTO nationality VALUES("58","China","CHN");
INSERT INTO nationality VALUES("59","Hong Kong Special Administrati","HKG");
INSERT INTO nationality VALUES("60","Macao Special Administrative R","MAC");
INSERT INTO nationality VALUES("61","Colombia","COL");
INSERT INTO nationality VALUES("62","Comoros","COM");
INSERT INTO nationality VALUES("63","Congo","COG");
INSERT INTO nationality VALUES("64","Cook Islands","COK");
INSERT INTO nationality VALUES("65","Costa Rica","CRI");
INSERT INTO nationality VALUES("66","Cote d\\\\\\\'Ivoire","CIV");
INSERT INTO nationality VALUES("67","Croatia","HRV");
INSERT INTO nationality VALUES("68","Cuba","CUB");
INSERT INTO nationality VALUES("69","Cyprus","CYP");
INSERT INTO nationality VALUES("70","Czech Republic","CZE");
INSERT INTO nationality VALUES("71","Democratic People\\\\\\\'s Republic","PRK");
INSERT INTO nationality VALUES("72","Democratic Republic of the Con","COD");
INSERT INTO nationality VALUES("73","Djibouti","DJI");
INSERT INTO nationality VALUES("74","Dominica","DMA");
INSERT INTO nationality VALUES("75","Dominican Republic","DOM");
INSERT INTO nationality VALUES("76","Ecuador","ECU");
INSERT INTO nationality VALUES("77","Egypt","EGY");
INSERT INTO nationality VALUES("78","El Salvador","SLV");
INSERT INTO nationality VALUES("79","Equatorial Guinea","GNQ");
INSERT INTO nationality VALUES("80","Eritrea","ERI");
INSERT INTO nationality VALUES("81","Estonia","EST");
INSERT INTO nationality VALUES("82","Ethiopia","ETH");
INSERT INTO nationality VALUES("83","Faeroe Islands","FRO");
INSERT INTO nationality VALUES("84","Falkland Islands (Malvinas)","FLK");
INSERT INTO nationality VALUES("85","Fiji","FJI");
INSERT INTO nationality VALUES("86","French Guiana","GUF");
INSERT INTO nationality VALUES("87","French Polynesia","PYF");
INSERT INTO nationality VALUES("88","Gabon","GAB");
INSERT INTO nationality VALUES("89","Gambia","GMB");
INSERT INTO nationality VALUES("90","Georgia","GEO");
INSERT INTO nationality VALUES("91","Ghana","GHA");
INSERT INTO nationality VALUES("92","Gibraltar","GIB");
INSERT INTO nationality VALUES("93","Greece","GRC");
INSERT INTO nationality VALUES("94","Greenland","GRL");
INSERT INTO nationality VALUES("95","Grenada","GRD");
INSERT INTO nationality VALUES("96","Guadeloupe","GLP");
INSERT INTO nationality VALUES("97","Guam","GUM");
INSERT INTO nationality VALUES("98","Guatemala","GTM");
INSERT INTO nationality VALUES("99","Guernsey","GGY");
INSERT INTO nationality VALUES("100","Guinea","GIN");
INSERT INTO nationality VALUES("101","Guinea-Bissau","GNB");
INSERT INTO nationality VALUES("102","Guyana","GUY");
INSERT INTO nationality VALUES("103","Haiti","HTI");
INSERT INTO nationality VALUES("104","Holy See","VAT");
INSERT INTO nationality VALUES("105","Honduras","HND");
INSERT INTO nationality VALUES("106","Iceland","ISL");
INSERT INTO nationality VALUES("107","India","IND");
INSERT INTO nationality VALUES("108","Indonesia","IDN");
INSERT INTO nationality VALUES("109","Iran, Islamic Republic of","IRN");
INSERT INTO nationality VALUES("110","Iraq","IRQ");
INSERT INTO nationality VALUES("111","Ireland","IRL");
INSERT INTO nationality VALUES("112","Isle of Man","IMN");
INSERT INTO nationality VALUES("113","Israel","ISR");
INSERT INTO nationality VALUES("114","Jamaica","JAM");
INSERT INTO nationality VALUES("115","Japan","JPN");
INSERT INTO nationality VALUES("116","Jersey","JEY");
INSERT INTO nationality VALUES("117","Jordan","JOR");
INSERT INTO nationality VALUES("118","Kazakhstan","KAZ");
INSERT INTO nationality VALUES("119","Kenya","KEN");
INSERT INTO nationality VALUES("120","Kiribati","KIR");
INSERT INTO nationality VALUES("121","Kuwait","KWT");
INSERT INTO nationality VALUES("122","Kyrgyzstan","KGZ");
INSERT INTO nationality VALUES("123","Lao People\\\\\\\'s Democratic Repub","LAO");
INSERT INTO nationality VALUES("124","Latvia","LVA");
INSERT INTO nationality VALUES("125","Lebanon","LBN");
INSERT INTO nationality VALUES("126","Lesotho","LSO");
INSERT INTO nationality VALUES("127","Liberia","LBR");
INSERT INTO nationality VALUES("128","Libyan Arab Jamahiriya","LBY");
INSERT INTO nationality VALUES("129","Liechtenstein","LIE");
INSERT INTO nationality VALUES("130","Lithuania","LTU");
INSERT INTO nationality VALUES("131","Luxembourg","LUX");
INSERT INTO nationality VALUES("132","Madagascar","MDG");
INSERT INTO nationality VALUES("133","Malawi","MWI");
INSERT INTO nationality VALUES("134","Malaysia","MYS");
INSERT INTO nationality VALUES("135","Maldives","MDV");
INSERT INTO nationality VALUES("136","Mali","MLI");
INSERT INTO nationality VALUES("137","Malta","MLT");
INSERT INTO nationality VALUES("138","Marshall Islands","MHL");
INSERT INTO nationality VALUES("139","Martinique","MTQ");
INSERT INTO nationality VALUES("140","Mauritania","MRT");
INSERT INTO nationality VALUES("141","Mauritius","MUS");
INSERT INTO nationality VALUES("142","Mayotte","MYT");
INSERT INTO nationality VALUES("143","Mexico","MEX");
INSERT INTO nationality VALUES("144","Micronesia, Federated States o","FSM");
INSERT INTO nationality VALUES("145","Moldova","MDA");
INSERT INTO nationality VALUES("146","Monaco","MCO");
INSERT INTO nationality VALUES("147","Mongolia","MNG");
INSERT INTO nationality VALUES("148","Montenegro","MNE");
INSERT INTO nationality VALUES("149","Montserrat","MSR");
INSERT INTO nationality VALUES("150","Morocco","MAR");
INSERT INTO nationality VALUES("151","Mozambique","MOZ");
INSERT INTO nationality VALUES("152","Myanmar","MMR");
INSERT INTO nationality VALUES("153","Namibia","NAM");
INSERT INTO nationality VALUES("154","Nauru","NRU");
INSERT INTO nationality VALUES("155","Nepal","NPL");
INSERT INTO nationality VALUES("156","Netherlands Antilles","ANT");
INSERT INTO nationality VALUES("157","New Caledonia","NCL");
INSERT INTO nationality VALUES("158","New Zealand","NZL");
INSERT INTO nationality VALUES("159","Nicaragua","NIC");
INSERT INTO nationality VALUES("160","Niger","NER");
INSERT INTO nationality VALUES("161","Nigeria","NGA");
INSERT INTO nationality VALUES("162","Niue","NIU");
INSERT INTO nationality VALUES("163","Norfolk Island","NFK");
INSERT INTO nationality VALUES("164","Northern Mariana Islands","MNP");
INSERT INTO nationality VALUES("165","Occupied Palestinian Territory","PSE");
INSERT INTO nationality VALUES("166","Oman","OMN");
INSERT INTO nationality VALUES("167","Pakistan","PAK");
INSERT INTO nationality VALUES("168","Palau","PLW");
INSERT INTO nationality VALUES("169","Panama","PAN");
INSERT INTO nationality VALUES("170","Papua New Guinea","PNG");
INSERT INTO nationality VALUES("171","Paraguay","PRY");
INSERT INTO nationality VALUES("172","Peru","PER");
INSERT INTO nationality VALUES("173","Philippines","PHL");
INSERT INTO nationality VALUES("174","Pitcairn","PCN");
INSERT INTO nationality VALUES("175","Puerto Rico","PRI");
INSERT INTO nationality VALUES("176","Qatar","QAT");
INSERT INTO nationality VALUES("177","Republic of Korea","KOR");
INSERT INTO nationality VALUES("178","R_union","REU");
INSERT INTO nationality VALUES("179","Romania","ROU");
INSERT INTO nationality VALUES("180","Rwanda","RWA");
INSERT INTO nationality VALUES("181","Saint-Barth?elemy","BLM");
INSERT INTO nationality VALUES("182","Saint Helena","SHN");
INSERT INTO nationality VALUES("183","Saint Kitts and Nevis","KNA");
INSERT INTO nationality VALUES("184","Saint Lucia","LCA");
INSERT INTO nationality VALUES("185","Saint-Martin (French part)","MAF");
INSERT INTO nationality VALUES("186","Saint Pierre and Miquelon","SPM");
INSERT INTO nationality VALUES("187","Saint Vincent and the Grenadin","VCT");
INSERT INTO nationality VALUES("188","Samoa","WSM");
INSERT INTO nationality VALUES("189","San Marino","SMR");
INSERT INTO nationality VALUES("190","Sao Tome and Principe","STP");
INSERT INTO nationality VALUES("191","Saudi Arabia","SAU");
INSERT INTO nationality VALUES("192","Senegal","SEN");
INSERT INTO nationality VALUES("193","Serbia","SRB");
INSERT INTO nationality VALUES("194","Seychelles","SYC");
INSERT INTO nationality VALUES("195","Sierra Leone","SLE");
INSERT INTO nationality VALUES("196","Singapore","SGP");
INSERT INTO nationality VALUES("197","Slovakia","SVK");
INSERT INTO nationality VALUES("198","Slovenia","SVN");
INSERT INTO nationality VALUES("199","Solomon Islands","SLB");
INSERT INTO nationality VALUES("200","Somalia","SOM");
INSERT INTO nationality VALUES("201","South Africa","ZAF");
INSERT INTO nationality VALUES("202","Sri Lanka","LKA");
INSERT INTO nationality VALUES("203","Sudan","SDN");
INSERT INTO nationality VALUES("204","Suriname","SUR");
INSERT INTO nationality VALUES("205","Svalbard and Jan Mayen Islands","SJM");
INSERT INTO nationality VALUES("206","Swaziland","SWZ");
INSERT INTO nationality VALUES("207","Syrian Arab Republic","SYR");
INSERT INTO nationality VALUES("208","Tajikistan","TJK");
INSERT INTO nationality VALUES("209","Thailand","THA");
INSERT INTO nationality VALUES("210","The former Yugoslav Republic o","MKD");
INSERT INTO nationality VALUES("211","Timor-Leste","TLS");
INSERT INTO nationality VALUES("212","Togo","TGO");
INSERT INTO nationality VALUES("213","Tokelau","TKL");
INSERT INTO nationality VALUES("214","Tonga","TON");
INSERT INTO nationality VALUES("215","Trinidad and Tobago","TTO");
INSERT INTO nationality VALUES("216","Tunisia","TUN");
INSERT INTO nationality VALUES("217","Turkey","TUR");
INSERT INTO nationality VALUES("218","Turkmenistan","TKM");
INSERT INTO nationality VALUES("219","Turks and Caicos Islands","TCA");
INSERT INTO nationality VALUES("220","Tuvalu","TUV");
INSERT INTO nationality VALUES("221","Uganda","UGA");
INSERT INTO nationality VALUES("222","Ukraine","UKR");
INSERT INTO nationality VALUES("223","United Arab Emirates","ARE");
INSERT INTO nationality VALUES("224","United Republic of Tanzania","TZA");
INSERT INTO nationality VALUES("225","United States of America","USA");
INSERT INTO nationality VALUES("226","United States Virgin Islands","VIR");
INSERT INTO nationality VALUES("227","Uruguay","URY");
INSERT INTO nationality VALUES("228","Uzbekistan","UZB");
INSERT INTO nationality VALUES("229","Vanuatu","VUT");
INSERT INTO nationality VALUES("230","Venezuela (Bolivarian Republic","VEN");
INSERT INTO nationality VALUES("231","Viet Nam","VNM");
INSERT INTO nationality VALUES("232","Wallis and Futuna Islands","WLF");
INSERT INTO nationality VALUES("233","Western Sahara","ESH");
INSERT INTO nationality VALUES("234","Yemen","YEM");
INSERT INTO nationality VALUES("235","Zambia","ZMB");
INSERT INTO nationality VALUES("236","Zimbabwe","ZWE");
INSERT INTO nationality VALUES("237","UNKNOWN","-");



DROP TABLE IF EXISTS office;

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
  `Excursion 2019` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idOffice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO office VALUES("1","Office 1","0.00","","0.00","0.00","0.00","5.60","5.00","","0.00","0.00");
INSERT INTO office VALUES("2","Office 2","0.00","%","0.00","16.00","0.00","40.50","40.60","","0.00","0.00");
INSERT INTO office VALUES("3","Office 3","0.00","","0.00","0.00","0.00","0.00","5.00","","0.00","0.00");
INSERT INTO office VALUES("4","Office 4","0.00","","0.00","0.00","0.00","0.00","14.20","","0.00","0.00");
INSERT INTO office VALUES("5","Office 5","0.00","","21.00","18.00","0.00","0.00","12.70","","0.00","30.00");
INSERT INTO office VALUES("6","Office 6","0.00","","0.00","0.00","0.00","0.00","12.80","","0.00","0.00");
INSERT INTO office VALUES("7","Business Partner 1","20.00","€","10.00","0.00","0.00","0.00","9.00","","5.00","0.00");
INSERT INTO office VALUES("8","Business Partner 2","0.00","€","0.00","18.00","0.00","2.50","21.50","","0.00","0.00");
INSERT INTO office VALUES("9","Business Partner 3","0.00","€","0.00","4.50","0.00","0.00","7.20","","0.00","0.00");



DROP TABLE IF EXISTS pickup;

CREATE TABLE `pickup` (
  `idPickup` int(11) NOT NULL,
  `PPoint` varchar(45) DEFAULT NULL,
  `PPointGroup` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPickup`),
  KEY `PPointGroup_fkey` (`PPointGroup`),
  CONSTRAINT `PPointGroup_fkey` FOREIGN KEY (`PPointGroup`) REFERENCES `ptime` (`PPointGroup`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO pickup VALUES("10","Bali church","1");
INSERT INTO pickup VALUES("20","Bali Star","1");
INSERT INTO pickup VALUES("30","Lisa Mari Beach","1");
INSERT INTO pickup VALUES("40","Talea Beach","1");
INSERT INTO pickup VALUES("50","Bali (National Road)","1");
INSERT INTO pickup VALUES("60","Panormo (National Road)","2");
INSERT INTO pickup VALUES("70","Marine Palace","2");
INSERT INTO pickup VALUES("80","Creta Marine","2");
INSERT INTO pickup VALUES("90","Creta Panorama","2");
INSERT INTO pickup VALUES("100","Taverna Ilios","3");
INSERT INTO pickup VALUES("105","Rethymno Mare (HER)","3");
INSERT INTO pickup VALUES("110","Creta Star","3");
INSERT INTO pickup VALUES("115","Gortyna Hotel (HER)","3");
INSERT INTO pickup VALUES("120","Thalassi Hotel","3");
INSERT INTO pickup VALUES("130","Taverna Dimitrios","3");
INSERT INTO pickup VALUES("140","Amnissos","4");
INSERT INTO pickup VALUES("150","White Palace","4");
INSERT INTO pickup VALUES("155","Emerald","4");
INSERT INTO pickup VALUES("160","Maravel Apartments","4");
INSERT INTO pickup VALUES("170","Dias","4");
INSERT INTO pickup VALUES("180","Seafront","4");
INSERT INTO pickup VALUES("190","Rethymno Palace","4");
INSERT INTO pickup VALUES("200","Jo-An Beach","4");
INSERT INTO pickup VALUES("210","Maravel Land","4");
INSERT INTO pickup VALUES("220","Caramel","4");
INSERT INTO pickup VALUES("230","Rethymno Residence","4");
INSERT INTO pickup VALUES("240","Rithymna Beach","5");
INSERT INTO pickup VALUES("250","Orion","5");
INSERT INTO pickup VALUES("260","Office 5","5");
INSERT INTO pickup VALUES("270","Eva Bay","5");
INSERT INTO pickup VALUES("280","Adele Beach","5");
INSERT INTO pickup VALUES("290","Christina Apartments","5");
INSERT INTO pickup VALUES("300","Galeana Mare","5");
INSERT INTO pickup VALUES("310","Palladion","5");
INSERT INTO pickup VALUES("320","Golden Beach","5");
INSERT INTO pickup VALUES("330","Kathrin Beach","5");
INSERT INTO pickup VALUES("340","Office 4","5");
INSERT INTO pickup VALUES("350","Edem Beach","5");
INSERT INTO pickup VALUES("360","Rethymno Village","6");
INSERT INTO pickup VALUES("365","Akti Hara","6");
INSERT INTO pickup VALUES("370","Leoniki Residence","6");
INSERT INTO pickup VALUES("380","Galeana Beach","6");
INSERT INTO pickup VALUES("390","Marinos Beach","6");
INSERT INTO pickup VALUES("400","Axos","6");
INSERT INTO pickup VALUES("410","Nefeli","6");
INSERT INTO pickup VALUES("420","Pavlakis S/M Platanias","6");
INSERT INTO pickup VALUES("430","Office 6","6");
INSERT INTO pickup VALUES("440","BP Platanias","6");
INSERT INTO pickup VALUES("450","Mantenia","7");
INSERT INTO pickup VALUES("460","May","7");
INSERT INTO pickup VALUES("470","Creta Palace","7");
INSERT INTO pickup VALUES("480","Missiria church","7");
INSERT INTO pickup VALUES("490","Anna Apartments","7");
INSERT INTO pickup VALUES("500","Missiria Apartments","7");
INSERT INTO pickup VALUES("510","Pavlakis S/M Missiria","7");
INSERT INTO pickup VALUES("515","Grigoris Bakery (HER)","7");
INSERT INTO pickup VALUES("520","Dimitrios Beach","8");
INSERT INTO pickup VALUES("530","Anita Beach","8");
INSERT INTO pickup VALUES("540","Pearl Beach","8");
INSERT INTO pickup VALUES("550","Plaza Spa","8");
INSERT INTO pickup VALUES("560","Olympic Suites","8");
INSERT INTO pickup VALUES("565","Irini Bar (HER)","8");
INSERT INTO pickup VALUES("570","Flisvos Beach","8");
INSERT INTO pickup VALUES("580","Golden Coast","8");
INSERT INTO pickup VALUES("600","Marel","8");
INSERT INTO pickup VALUES("605","Manoli\\\\\\\'s Place","8");
INSERT INTO pickup VALUES("610","Bora Bora","8");
INSERT INTO pickup VALUES("615","Blue sky","8");
INSERT INTO pickup VALUES("618","Atlantis Beach","8");
INSERT INTO pickup VALUES("620","Zantina","8");
INSERT INTO pickup VALUES("630","Blue Sea","8");
INSERT INTO pickup VALUES("640","Batis","8");
INSERT INTO pickup VALUES("643","Lefkoniko Beach (HER)","9");
INSERT INTO pickup VALUES("646","Theartemis Palace (HER)","9");
INSERT INTO pickup VALUES("648","Minos (HER)","9");
INSERT INTO pickup VALUES("650","Office 2","9");
INSERT INTO pickup VALUES("660","Minos","9");
INSERT INTO pickup VALUES("670","Theartemis Palace","9");
INSERT INTO pickup VALUES("680","Lefkoniko Beach","9");
INSERT INTO pickup VALUES("690","Nereas Taverna","9");
INSERT INTO pickup VALUES("700","Poseidon","9");
INSERT INTO pickup VALUES("720","Steris Beach","10");
INSERT INTO pickup VALUES("725","Theo","10");
INSERT INTO pickup VALUES("730","Porto Rethymno","10");
INSERT INTO pickup VALUES("740","Ilios Beach","10");
INSERT INTO pickup VALUES("750","Kriti Beach","10");
INSERT INTO pickup VALUES("760","Delphini","10");
INSERT INTO pickup VALUES("770","Astali","10");
INSERT INTO pickup VALUES("790","Town Hall","11");
INSERT INTO pickup VALUES("795","Olympic Palladium (HER)","11");
INSERT INTO pickup VALUES("800","4 Martyrs Church","11");
INSERT INTO pickup VALUES("805","Brascos (HER)","11");
INSERT INTO pickup VALUES("810","Macaris","12");
INSERT INTO pickup VALUES("820","Archipelagos","12");
INSERT INTO pickup VALUES("830","Petradi Beach","12");
INSERT INTO pickup VALUES("840","Delfini Apartments","12");
INSERT INTO pickup VALUES("850","LIDL","12");
INSERT INTO pickup VALUES("860","Camari Garden","12");
INSERT INTO pickup VALUES("863","Petres bus stop","12");
INSERT INTO pickup VALUES("865","Episkopi bus stop","12");
INSERT INTO pickup VALUES("870","Ermioni","13");
INSERT INTO pickup VALUES("880","Kavros Beach","13");
INSERT INTO pickup VALUES("890","Kournas Village","13");
INSERT INTO pickup VALUES("900","Happy Days","13");
INSERT INTO pickup VALUES("910","Vantaris Beach","13");
INSERT INTO pickup VALUES("920","Georgioupolis Resort","14");
INSERT INTO pickup VALUES("930","Pilot Beach","14");
INSERT INTO pickup VALUES("940","Grigoris Bakery bus stop","14");
INSERT INTO pickup VALUES("950","Vrisses bus stop (national road)","14");



DROP TABLE IF EXISTS ptime;

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
  `Excursion 555` varchar(5) DEFAULT NULL,
  `Yolo` varchar(5) DEFAULT NULL,
  `Excursion 2019` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`PPointGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO ptime VALUES("0","0","1","1","0","0","1","1","-1","1","-1","1","0");
INSERT INTO ptime VALUES("1","1","07:00","07:30","07:55","09:20","16:00","06:45","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("2","2","07:20","07:50","08:15","09:00","16:20","07:05","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("3","3","07:30","08:00","08:05","08:50","16:30","07:15","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("4","4","07:40","08:10","07:55","08:40","16:40","07:25","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("5","5","07:45","08:15","07:50","08:35","16:45","07:30","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("6","6","07:50","08:20","07:45","08:30","16:50","07:35","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("7","7","07:55","08:25","07:40","08:25","16:55","07:40","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("8","8","08:00","08:30","07:35","08:20","17:00","07:45","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("9","9","08:05","08:35","07:30","08:15","17:05","07:50","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("10","10","08:10","08:40","07:25","08:10","17:10","07:55","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("11","11","08:15","08:45","07:20","08:05","17:15","08:00","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("12","12","08:20","08:50","07:15","08:00","17:20","08:05","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("13","13","08:30","9:00","07:05","07:50","17:30","08:15","00:00","00:00","","","00:00");
INSERT INTO ptime VALUES("14","14","08:35","9:05","07:00","07:45","17:35","08:20","00:00","00:00","","","00:00");



DROP TABLE IF EXISTS reservations;

CREATE TABLE `reservations` (
  `idReservations` int(11) NOT NULL AUTO_INCREMENT,
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
  `Noshow` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`idReservations`),
  KEY `fk_Reservations_1_idx` (`ExcursionID`),
  KEY `fk_Reservations_2_idx` (`Pickup`),
  KEY `fk_Reservations_3_idx` (`HotelID`),
  KEY `fk_Reservations_4_idx` (`ReservationOfficeID`),
  CONSTRAINT `fk_Reservations_1` FOREIGN KEY (`ExcursionID`) REFERENCES `excursion` (`idExcursion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_Reservations_2` FOREIGN KEY (`Pickup`) REFERENCES `pickup` (`idPickup`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_Reservations_3` FOREIGN KEY (`HotelID`) REFERENCES `hotel` (`idHotel`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_Reservations_4` FOREIGN KEY (`ReservationOfficeID`) REFERENCES `office` (`idOffice`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=219 DEFAULT CHARSET=utf8;

INSERT INTO reservations VALUES("121","14","2017-06-06","410","07:35","Res 6","","","2","30.00","0","0.00","0","D","GER","1071","2017-06-04 00:00:00","620103","Nefeli","240","6","","0","0.00","");
INSERT INTO reservations VALUES("122","14","2017-06-06","100","07:15","Res 7","","","4","30.00","0","0.00","0","D","GER","1002","2017-06-04 00:00:00","600013","Begeti Bay","410","2","","0","0.00","");
INSERT INTO reservations VALUES("123","14","2017-06-06","730","07:55","Res 8","","","2","30.00","1","15.00","0","E","GRC","1020","2017-06-04 00:00:00","25400","Private (City)","10","3","","0","0.00","0");
INSERT INTO reservations VALUES("124","14","2017-06-06","670","07:50","Res 9","","","2","30.00","0","0.00","0","D","GER","1004","2017-06-04 00:00:00","635033","Atrium","420","9","","0","0.00","");
INSERT INTO reservations VALUES("141","14","2017-06-06","510","07:40","Res 10","","","2","30.00","0","0.00","0","D","GER","934","2017-06-05 00:00:00","625093","Odyssia Beach","805","8","","0","0.00","");
INSERT INTO reservations VALUES("153","14","2017-06-13","660","07:50","Res 11","","res11@email.com","2","30.00","0","0.00","0","E","LTU","1005","2017-06-05 00:00:00","635023","Minos","359","2","","0","0.00","");
INSERT INTO reservations VALUES("154","14","2017-06-06","240","07:30","Res 12","","","2","30.00","0","0.00","0","F","FRA","1924","2017-06-05 00:00:00","615003","Rithymna Beach","916","5","","0","0.00","1");
INSERT INTO reservations VALUES("163","5","2017-06-08","760","08:40","Res 1","(+49)109 2289171","res1@email.com","2","26.00","0","0.00","0","D","GER","1001","2017-06-05 00:00:00","640213","Kyma Beach","406","1","","0","0.00","");
INSERT INTO reservations VALUES("164","5","2017-06-08","730","08:40","Res 2","","","2","26.00","0","0.00","0","E","GBR","1002","2017-06-05 00:00:00","640103","Porto Rethymno","314","9","","0","0.00","");
INSERT INTO reservations VALUES("165","5","2017-06-08","660","08:35","Res 3","","","2","26.00","0","0.00","0","E","GBR","1003","2017-06-05 00:00:00","635023","Minos","215","2","","0","0.00","");
INSERT INTO reservations VALUES("166","5","2017-06-08","520","08:30","Res 4","","","2","26.00","0","0.00","0","E","GBR","937","2017-06-05 00:00:00","630003","Dimitrios Beach","511","3","","0","0.00","");
INSERT INTO reservations VALUES("173","14","2017-06-06","340","07:30","Res 00009","","","2","30.00","0","0.00","0","E","GBR","1431","2017-06-05 00:00:00","615063","Palladion","248","8","","0","0.00","");
INSERT INTO reservations VALUES("180","14","2017-06-06","760","07:55","Res 14","","","2","30.00","0","0.00","0","E","SWE","1006","2017-06-05 00:00:00","640183","Achillion Palace","407","1","","0","0.00","1");
INSERT INTO reservations VALUES("182","5","2017-06-08","430","08:20","Res 5","","","3","26.00","0","0.00","0","E","GBR","1004","2017-06-05 00:00:00","25500","Private (Outside)","-","8","","0","0.00","");
INSERT INTO reservations VALUES("211","14","2017-06-06","10","06:45","Res 16","(+49) 129001912","res15@email.com","2","30.00","0","15.00","1","R","POL","1785ap99","2017-07-15 00:00:00","530005","New Hotel 1","127b","8","","1","10.00","0");
INSERT INTO reservations VALUES("213","14","2017-06-13","670","07:50","res10","","","3","30.00","0","0.00","0","E","GBR","1008","2017-10-25 00:00:00","635063","Theartemis Palace","80","3","","0","0.00","");
INSERT INTO reservations VALUES("214","8","2018-03-15","105","08:50","LastName1","","","3","30.00","1","15.00","0","D","GER","10012","2018-03-17 00:00:00","600033","Rethymno Mare Royal","125","3","","0","0.00","");
INSERT INTO reservations VALUES("215","14","2017-06-06","400","07:35","res8","","","3","30.00","2","15.00","1","D","GER","1290","2018-04-17 00:00:00","620053","Axos","90jj","8","","1","20.00","1");
INSERT INTO reservations VALUES("216","17","2019-02-20","120","08:05","SB1","4516351048425","","3","20.00","4","10.00","2","F","BEL","12543","2019-02-03 00:00:00","600133","Thalassi","107","5","","0","0.00","");
INSERT INTO reservations VALUES("217","17","2019-02-20","730","07:25","Lokey","56416513","","2","20.00","1","10.00","0","E","CHE","5132104","2019-02-03 00:00:00","640103","Porto Rethymno","144","5","","0","0.00","");
INSERT INTO reservations VALUES("218","14","2019-03-19","400","07:35","Lokey","4516351048425","","100","30.00","40","15.00","0","F","PRT","1561","2019-03-29 00:00:00","620053","Axos","144","5","","0","0.00","");



DROP TABLE IF EXISTS seller;

CREATE TABLE `seller` (
  `idSeller` int(11) NOT NULL,
  `SName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idSeller`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO seller VALUES("1","Seller 1");
INSERT INTO seller VALUES("2","Seller 2");
INSERT INTO seller VALUES("4","Seller 3");



DROP TABLE IF EXISTS testhotel;

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

INSERT INTO testhotel VALUES("1000","ΜΠΑΛΙ","Bali Beach & Village","2834094210","1","5:30:00","3","50","50","");
INSERT INTO testhotel VALUES("1100","ΜΠΑΛΙ","Bali Mare","2834094375","1","5:30:01","3","50","50","");
INSERT INTO testhotel VALUES("1200","ΜΠΑΛΙ","Ormos Atalia Aparthotel","2834094401","1","5:30:02","3","50","50","");
INSERT INTO testhotel VALUES("1300","ΜΠΑΛΙ","Bali Paradise","2834094253","1","5:30:03","3","50","50","");
INSERT INTO testhotel VALUES("1400","ΜΠΑΛΙ","Bali Star","2834094212","1","5:30:04","3","20","20","");
INSERT INTO testhotel VALUES("1500","ΜΠΑΛΙ","Amalia Apartments","2834094212","1","5:30:05","3","50","50","");
INSERT INTO testhotel VALUES("1600","ΜΠΑΛΙ","Lisa Mari Beach","2834094073","1","5:30:06","3","30","30","");
INSERT INTO testhotel VALUES("1700","ΜΠΑΛΙ","Talea Beach","","1","5:30:07","3","40","40","");
INSERT INTO testhotel VALUES("1800","ΜΠΑΛΙ","Aparthotel Sofia - Mythos Beach","2834094450","1","5:30:08","3","50","50","");
INSERT INTO testhotel VALUES("1900","ΜΠΑΛΙ","Xidas Garden","2834094269","1","5:30:09","3","50","50","");
INSERT INTO testhotel VALUES("2000","ΜΠΑΛΙ","Bella Vista","2834094032","1","5:30:10","3","50","50","");
INSERT INTO testhotel VALUES("2100","ΜΠΑΛΙ","Blue Horizon","2834094004","1","5:30:11","3","50","50","");
INSERT INTO testhotel VALUES("2200","ΜΠΑΛΙ","Carpe Diem","2834022491","1","5:30:12","3","50","50","");
INSERT INTO testhotel VALUES("2300","ΜΠΑΛΙ","Elpis Studios & Apartments","2834094444","1","5:30:13","3","50","50","");
INSERT INTO testhotel VALUES("2400","ΜΠΑΛΙ","Troulis","2834094289","1","5:30:14","3","50","50","");
INSERT INTO testhotel VALUES("2500","ΠΑΝΟΡΜΟΣ","Iliana Hotel Apartments","2834051447","2","5:50:00","3","60","60","");
INSERT INTO testhotel VALUES("2600","ΠΑΝΟΡΜΟΣ","Kirki Village","2834051225","2","5:50:01","3","60","60","");
INSERT INTO testhotel VALUES("2700","ΠΑΝΟΡΜΟΣ","Panormo Beach","2834051209","2","5:50:02","3","60","60","");
INSERT INTO testhotel VALUES("2800","ΠΑΝΟΡΜΟΣ","Philoxenia Apartments","2834051481","2","5:50:03","3","60","60","");
INSERT INTO testhotel VALUES("2900","ΠΑΝΟΡΜΟΣ","Stella Beach","2834051481","2","5:50:04","3","60","60","");
INSERT INTO testhotel VALUES("3000","ΠΑΝΟΡΜΟΣ","Grecotel Club Marine Palace & Suites","2834051610","4","5:50:05","3","70","70","");
INSERT INTO testhotel VALUES("3100","ΠΑΝΟΡΜΟΣ","Europa Resort","2834020200","5","5:50:06","3","70","70","");
INSERT INTO testhotel VALUES("3200","ΠΑΝΟΡΜΟΣ","Sensimar Royal Blue Resort & Spa","2834055000","6","5:50:07","3","70","70","");
INSERT INTO testhotel VALUES("3300","ΠΑΝΟΡΜΟΣ","Iberostar Creta Marine","2834051290","7","5:50:08","3","80","80","");
INSERT INTO testhotel VALUES("3400","ΠΑΝΟΡΜΟΣ","Iberostar Creta Panorama & Mare","2834051502","7","5:50:09","3","90","90","");
INSERT INTO testhotel VALUES("3500","ΣΚΑΛΕΤΑ","Oasis","2831071774","8","6:00:00","3","100","101","");
INSERT INTO testhotel VALUES("3600","ΣΚΑΛΕΤΑ","Begeti Bay","2831071909","8","6:00:01","3","100","101","");
INSERT INTO testhotel VALUES("3700","ΣΚΑΛΕΤΑ","Prinos Resort","2831072414","9","6:00:02","3","100","101","");
INSERT INTO testhotel VALUES("3800","ΣΚΑΛΕΤΑ","Rethymno Mare Royal","2831071703","9","6:00:03","3","100","101","");
INSERT INTO testhotel VALUES("3900","ΣΚΑΛΕΤΑ","Babis","2831071193","10","6:00:04","3","100","101","");
INSERT INTO testhotel VALUES("4000","ΣΚΑΛΕΤΑ","Scaleta Beach","2831071702","11","6:00:05","3","100","101","");
INSERT INTO testhotel VALUES("4100","ΣΚΑΛΕΤΑ","Creta Royal","2831071812","11","6:00:06","3","110","110","");
INSERT INTO testhotel VALUES("4200","ΣΤΑΥΡΩΜΕΝΟΣ","Stavromenos Villas","2831071053","11","6:00:07","3","110","110","");
INSERT INTO testhotel VALUES("4300","ΣΤΑΥΡΩΜΕΝΟΣ","Creta Star","2831071812","11","6:00:08","3","110","110","");
INSERT INTO testhotel VALUES("4400","ΣΤΑΥΡΩΜΕΝΟΣ","Corali Beach","2831071967","11","6:00:09","3","120","120","");
INSERT INTO testhotel VALUES("4500","ΣΦΑΚΑΚΙ","Krini Beach","2831072903","11","6:00:10","3","120","120","");
INSERT INTO testhotel VALUES("4600","ΣΚΑΛΕΤΑ","Gortyna","2831071846","12","6:00:11","3","120","120","");
INSERT INTO testhotel VALUES("4700","ΣΤΑΥΡΩΜΕΝΟΣ","Yannis Aparthotel","","13","6:00:12","3","120","120","");
INSERT INTO testhotel VALUES("4800","ΣΤΑΥΡΩΜΕΝΟΣ","Thalassi","2831071990","14","6:00:13","3","120","120","");
INSERT INTO testhotel VALUES("4900","ΣΤΑΥΡΩΜΕΝΟΣ","Nautica","2831055577","14","6:00:14","3","120","120","");
INSERT INTO testhotel VALUES("5000","ΠΑΓΚΑΛΟΧΩΡΙ","Alkionis","2831071584","15","6:00:15","3","120","120","");
INSERT INTO testhotel VALUES("5100","ΠΑΓΚΑΛΟΧΩΡΙ","Almyra Apartments","2831074675","15","6:00:16","3","120","120","");
INSERT INTO testhotel VALUES("5200","ΣΤΑΥΡΩΜΕΝΟΣ","Agelia Beach","2831072032","16","6:00:17","3","130","130","");
INSERT INTO testhotel VALUES("5300","ΣΤΑΥΡΩΜΕΝΟΣ","Ekavi Beach","2831071896","16","6:00:18","3","130","130","");
INSERT INTO testhotel VALUES("5400","ΣΤΑΥΡΩΜΕΝΟΣ","Dedalos Beach","2831073035","16","6:00:19","3","130","130","");
INSERT INTO testhotel VALUES("5500","ΣΤΑΥΡΩΜΕΝΟΣ","Golden Sand Boutique","2831072032","16","6:00:20","3","130","130","");
INSERT INTO testhotel VALUES("5600","ΣΤΑΥΡΩΜΕΝΟΣ","Danaos Beach","2831073025","17","6:00:21","3","130","130","");
INSERT INTO testhotel VALUES("5700","ΣΤΑΥΡΩΜΕΝΟΣ","Rosebay Apartments","2831054413","17","6:00:22","3","130","130","");
INSERT INTO testhotel VALUES("5800","ΣΤΑΥΡΩΜΕΝΟΣ","Chrisanna Apartments & Studios","2831071195","17","6:00:23","3","130","130","");
INSERT INTO testhotel VALUES("5900","ΣΤΑΥΡΩΜΕΝΟΣ","Sunrise Hotel Apartments","2834022791","17","6:00:24","3","130","130","");
INSERT INTO testhotel VALUES("6000","ΣΤΑΥΡΩΜΕΝΟΣ","Radamanthys Apartments","2931072691","17","6:00:25","3","130","130","");
INSERT INTO testhotel VALUES("6100","ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ","Amnissos","2831072460","18","6:10:00","3","140","140","");
INSERT INTO testhotel VALUES("6200","ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ","White Palace El Greco Luxury Resort","2831071102","19","6:10:01","3","150","150","");
INSERT INTO testhotel VALUES("6300","ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ","Limas","2831072257","19","6:10:02","3","150","150","");
INSERT INTO testhotel VALUES("6400","ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ","Keti (Kaiti) Apartments","2831051480","19","6:10:03","3","150","150","");
INSERT INTO testhotel VALUES("6500","ΠΗΓΙΑΝΟΣ ΚΑΜΠΟΣ","Alkyon","2831071136","19","6:10:04","3","150","150","");
INSERT INTO testhotel VALUES("6600","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Maravel","2831072916","21","6:10:05","3","160","160","");
INSERT INTO testhotel VALUES("6700","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Dias","2831071017","22","6:10:06","3","170","170","");
INSERT INTO testhotel VALUES("6800","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Solimar Dias","2831071177","22","6:10:07","3","170","170","");
INSERT INTO testhotel VALUES("6900","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Blue sky","2831057560","23","6:10:08","3","170","170","");
INSERT INTO testhotel VALUES("7000","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Rethymno Palace","2831072418","24","6:10:09","3","180","180","");
INSERT INTO testhotel VALUES("7100","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Jo An Beach","2831024241","25","6:10:10","3","200","200","");
INSERT INTO testhotel VALUES("7200","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Seafront Apartments","2831072600","25","6:10:11","3","190","190","");
INSERT INTO testhotel VALUES("7300","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Stella Katrin","2831021690","26","6:10:12","3","190","190","");
INSERT INTO testhotel VALUES("7400","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Maravel Land","2831071063","27","6:10:13","3","210","210","");
INSERT INTO testhotel VALUES("7500","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Caramel","2831071803","28","6:10:14","3","220","220","");
INSERT INTO testhotel VALUES("7600","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Rethymno Residence","2831072633","29","6:10:15","3","230","230","");
INSERT INTO testhotel VALUES("7700","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Aquila Rithimna Beach","2831071002","30","6:15:00","3","240","240","");
INSERT INTO testhotel VALUES("7800","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Orion","2831071471","31","6:15:01","3","250","250","");
INSERT INTO testhotel VALUES("7900","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Eva Bay","2831020760","32","6:15:02","3","270","270","");
INSERT INTO testhotel VALUES("8000","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Adele Beach","2831071081","33","6:15:03","3","280","280","");
INSERT INTO testhotel VALUES("8100","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Christina Apartments","","34","6:15:04","3","300","300","");
INSERT INTO testhotel VALUES("8200","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Galeana Mare","2831073006","34","6:15:05","3","290","290","");
INSERT INTO testhotel VALUES("8300","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Palladion","2831028976","35","6:15:06","3","310","310","");
INSERT INTO testhotel VALUES("8400","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Golden Beach","2831071012","36","6:15:07","3","320","320","");
INSERT INTO testhotel VALUES("8500","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Kathrin Beach","2831071757","37","6:15:08","3","330","330","");
INSERT INTO testhotel VALUES("8600","ΑΔΕΛΙΑΝΟΣ ΚΑΜΠΟΣ","Edem Beach","2831073963","38","6:15:09","3","350","350","");
INSERT INTO testhotel VALUES("8700","ΠΛΑΤΑΝΕΣ","Rethymno Village","2831025523","39","6:20:00","3","360","360","");
INSERT INTO testhotel VALUES("8800","ΠΛΑΤΑΝΕΣ","Grand Leoniki Residence","2831029232","40","6:20:01","3","370","370","");
INSERT INTO testhotel VALUES("8900","ΠΛΑΤΑΝΕΣ","Cretan Sun","2831027077","41","6:20:02","3","370","370","");
INSERT INTO testhotel VALUES("9000","ΠΛΑΤΑΝΕΣ","Marinos Beach","2831027840","42","6:20:03","3","390","390","");
INSERT INTO testhotel VALUES("9100","ΠΛΑΤΑΝΕΣ","Galeana Beach","2831051141","43","6:20:04","3","380","380","");
INSERT INTO testhotel VALUES("9200","ΠΛΑΤΑΝΕΣ","Axos","2831020472","44","6:20:05","3","400","400","");
INSERT INTO testhotel VALUES("9300","ΠΛΑΤΑΝΕΣ","Nefeli","2831055321","47","6:20:10","3","410","410","");
INSERT INTO testhotel VALUES("9400","ΠΛΑΤΑΝΕΣ","Castello Bianco","831020029","45","6:20:06","3","410","410","");
INSERT INTO testhotel VALUES("9500","ΠΛΑΤΑΝΙΑΣ","Apollon Hotel Apartments","2831050300","46","6:20:07","3","410","410","");
INSERT INTO testhotel VALUES("9600","ΠΛΑΤΑΝΙΑΣ","Creta Residence","","47","6:20:08","3","440","440","");
INSERT INTO testhotel VALUES("9700","ΠΛΑΤΑΝΙΑΣ","Minos Mare","","47","6:20:09","3","440","440","");
INSERT INTO testhotel VALUES("9800","ΠΛΑΤΑΝΕΣ","La Stella","2831027545","49","6:20:11","3","440","440","");
INSERT INTO testhotel VALUES("9900","ΠΛΑΤΑΝΕΣ","Evelin","","49","6:20:12","3","440","440","");
INSERT INTO testhotel VALUES("10000","ΠΛΑΤΑΝΕΣ","Creta Sun","","49","6:20:13","3","440","440","");
INSERT INTO testhotel VALUES("10100","ΠΛΑΤΑΝΕΣ","Trefon Apartments","2831024772","50","6:20:14","3","420","420","");
INSERT INTO testhotel VALUES("10200","ΠΛΑΤΑΝΕΣ","Bella Casita Family Apartments","2831025552","48","6:20:15","3","420","420","");
INSERT INTO testhotel VALUES("10300","ΠΛΑΤΑΝΕΣ","Amaril","2831056665","50","6:20:16","3","420","420","");
INSERT INTO testhotel VALUES("10400","ΠΛΑΤΑΝΕΣ","Varvaras Diamond","2831035474","50","6:20:17","3","420","420","");
INSERT INTO testhotel VALUES("10500","ΠΛΑΤΑΝΕΣ","Bueno","2831025554","50","6:20:18","3","420","420","");
INSERT INTO testhotel VALUES("10600","ΠΛΑΤΑΝΕΣ","Mary Hotel","2831021402","51","6:20:19","3","440","440","");
INSERT INTO testhotel VALUES("10700","ΠΛΑΤΑΝΙΑΣ","Julia Apartments","2831025566","52","6:20:20","3","440","440","");
INSERT INTO testhotel VALUES("10800","ΠΛΑΤΑΝΙΑΣ","Minos Mare Royal","2831050388","53","6:20:21","3","420","420","");
INSERT INTO testhotel VALUES("10900","ΠΛΑΤΑΝΙΑΣ","Marianthi Apartments","2831055625","54","6:20:22","3","440","440","");
INSERT INTO testhotel VALUES("11000","ΡΕΘΥΜΝΟ","Mantenia","283155169","55","6:25:00","3","450","450","");
INSERT INTO testhotel VALUES("11100","ΜΥΣΣΙΡΙΑ","May","2831055745","55","6:25:01","3","460","460","");
INSERT INTO testhotel VALUES("11200","ΜΥΣΣΙΡΙΑ","Grecotel Creta Palace","2831021181","56","6:25:02","3","470","470","main road");
INSERT INTO testhotel VALUES("11300","ΜΥΣΣΙΡΙΑ","Chrissas Apartments","2831023372","57","6:25:03","3","470","470","main road");
INSERT INTO testhotel VALUES("11400","ΜΥΣΣΙΡΙΑ","Athina Rent Rooms Restaurant","2831024717","58","6:25:04","3","480","480","");
INSERT INTO testhotel VALUES("11500","ΜΥΣΣΙΡΙΑ","Camping Elizabeth","2831028694","59","6:25:05","3","480","480","");
INSERT INTO testhotel VALUES("11600","ΜΥΣΣΙΡΙΑ","Missiria Apartments","2831025576","60","6:25:06","3","500","500","");
INSERT INTO testhotel VALUES("11700","ΜΥΣΣΙΡΙΑ","Anna Apartments","","61","6:25:07","3","490","490","");
INSERT INTO testhotel VALUES("11800","ΜΥΣΣΙΡΙΑ","Dimitrios Village","2831025647","62","6:25:08","3","510","510","");
INSERT INTO testhotel VALUES("11900","ΜΥΣΣΙΡΙΑ","Odyssia Beach","2831027874","62","6:25:09","3","510","510","");
INSERT INTO testhotel VALUES("12000","ΜΥΣΣΙΡΙΑ","Omiros Boutique Apartments","2831027874","63","6:25:10","3","510","510","");
INSERT INTO testhotel VALUES("12100","ΜΥΣΣΙΡΙΑ","Ilian Beach Apartments","2831027205","64","6:25:11","3","510","510","");
INSERT INTO testhotel VALUES("12200","ΜΥΣΣΙΡΙΑ","Domenica Apartments","2831027362","64","6:25:12","3","510","510","");
INSERT INTO testhotel VALUES("12300","ΡΕΘΥΜΝΟ","Aristea","2831035358","65","6:25:13","3","510","510","");
INSERT INTO testhotel VALUES("12400","ΠΕΡΙΒΟΛΙΑ","Dimitrios Beach","2831056660","66","6:30:00","3","530","511","");
INSERT INTO testhotel VALUES("12500","ΡΕΘΥΜΝΟ","Anita Beach","","0","6:30:01","3","520","511","");
INSERT INTO testhotel VALUES("12600","ΡΕΘΥΜΝΟ","Iperion Beach","2831053765","65","6:30:02","3","540","541","");
INSERT INTO testhotel VALUES("12700","ΠΕΡΙΒΟΛΙΑ","Pearl Beach","2831020891","67","6:30:03","3","540","541","");
INSERT INTO testhotel VALUES("12800","ΜΥΣΣΙΡΙΑ","Esperia","2831021271","68","6:30:04","3","540","541","");
INSERT INTO testhotel VALUES("12900","ΠΕΡΙΒΟΛΙΑ","Aegean Pearl","2831023733","69","6:30:05","3","540","541","");
INSERT INTO testhotel VALUES("13000","ΠΕΡΙΒΟΛΙΑ","Plaza Spa Apartments","2831051505","70","6:30:06","3","550","550","");
INSERT INTO testhotel VALUES("13100","ΠΕΡΙΒΟΛΙΑ","Yacinthos Hotel Apartments","2831023635","71","6:30:07","3","550","550","");
INSERT INTO testhotel VALUES("13200","ΠΕΡΙΒΟΛΙΑ","Olympic II Apartments","2831024761","72","6:30:08","3","560","560","");
INSERT INTO testhotel VALUES("13300","ΠΕΡΙΒΟΛΙΑ","Summer Dream","2831051174","73","6:30:09","3","580","580","");
INSERT INTO testhotel VALUES("13400","ΠΕΡΙΒΟΛΙΑ","Melitti","2831056696","73","6:30:10","3","570","570","");
INSERT INTO testhotel VALUES("13500","ΠΕΡΙΒΟΛΙΑ","Golden Coast Apartments","2831021444","74","6:30:11","3","580","580","");
INSERT INTO testhotel VALUES("13600","ΠΕΡΙΒΟΛΙΑ","Flisvos Beach","2831026784","75","6:30:12","3","570","570","");
INSERT INTO testhotel VALUES("13700","ΠΕΡΙΒΟΛΙΑ","Erato Hotel Apartments","2831026913","75","6:30:13","3","580","580","");
INSERT INTO testhotel VALUES("13800","ΠΕΡΙΒΟΛΙΑ","Marilyn Apartments","2831055247","76","6:30:14","3","580","580","");
INSERT INTO testhotel VALUES("13900","ΠΕΡΙΒΟΛΙΑ","Zannis","2831035363","76","6:30:15","3","580","580","");
INSERT INTO testhotel VALUES("14000","ΠΕΡΙΒΟΛΙΑ","Daisy Hotel Apartments","2831050001","77","6:30:16","3","610","610","");
INSERT INTO testhotel VALUES("14100","ΠΕΡΙΒΟΛΙΑ","Olympia","2831029815","77","6:30:17","3","610","610","");
INSERT INTO testhotel VALUES("14200","ΠΕΡΙΒΟΛΙΑ","Fouli Studios & Apartments","2831026956","77","6:30:18","3","610","610","");
INSERT INTO testhotel VALUES("14300","ΠΕΡΙΒΟΛΙΑ","Blue Sky Apartments","2831057560","78","6:30:19","3","610","610","");
INSERT INTO testhotel VALUES("14400","ΡΕΘΥΜΝΟ","Atlantis Beach","2831051002","79","6:30:20","3","590","590","");
INSERT INTO testhotel VALUES("14500","ΡΕΘΥΜΝΟ","Mar El Furnished Apartments","2831053463","80","6:30:21","3","600","600","");
INSERT INTO testhotel VALUES("14600","ΡΕΘΥΜΝΟ","Eltina","2831055231","81","6:30:22","3","660","660","");
INSERT INTO testhotel VALUES("14700","ΡΕΘΥΜΝΟ","Family Homes Zaharias","2831028584","82","6:30:23","3","630","630","");
INSERT INTO testhotel VALUES("14800","ΡΕΘΥΜΝΟ","Aris Apartments","2831025867","83","6:30:24","3","630","630","");
INSERT INTO testhotel VALUES("14900","ΠΕΡΙΒΟΛΙΑ","Blue Sea Apartments","2831054804","83","6:30:25","3","630","630","");
INSERT INTO testhotel VALUES("15000","ΠΕΡΙΒΟΛΙΑ","Melmar","2831054908","83","6:30:26","3","660","660","");
INSERT INTO testhotel VALUES("15100","ΠΕΡΙΒΟΛΙΑ","Ibiscos Garden","2831051112","83","6:30:27","3","660","660","");
INSERT INTO testhotel VALUES("15200","ΠΕΡΙΒΟΛΙΑ","Zantina","2831024863","84","6:30:28","3","620","620","");
INSERT INTO testhotel VALUES("15300","ΡΕΘΥΜΝΟ","Batis","2831050558","85","6:30:29","3","640","640","");
INSERT INTO testhotel VALUES("15400","ΡΕΘΥΜΝΟ","Ammos Studios","2831036123","86","6:30:30","3","620","620","");
INSERT INTO testhotel VALUES("15500","ΡΕΘΥΜΝΟ","Ostria","2831027705","87","6:35:00","3","650","650","");
INSERT INTO testhotel VALUES("15600","ΡΕΘΥΜΝΟ","Medusa","2831027937","88","6:35:01","3","650","650","");
INSERT INTO testhotel VALUES("15700","ΠΕΡΙΒΟΛΙΑ","Minos","2831053921","89","6:35:02","3","660","660","");
INSERT INTO testhotel VALUES("15800","ΡΕΘΥΜΝΟ","Atrium","2831057601","90","6:35:03","3","670","670","");
INSERT INTO testhotel VALUES("15900","ΡΕΘΥΜΝΟ","Lefkoniko Bay","2831025495","90","6:35:04","3","680","680","");
INSERT INTO testhotel VALUES("16000","ΚΑΛΛΙΘΕΑ","Lefkoniko Beach","2831055326","90","6:35:05","3","680","680","");
INSERT INTO testhotel VALUES("16100","ΡΕΘΥΜΝΟ","Theartemis Palace","2831053991","90","6:35:06","3","670","670","");
INSERT INTO testhotel VALUES("16200","ΡΕΘΥΜΝΟ","Bella Mare","2831035494","91","6:35:07","3","680","680","");
INSERT INTO testhotel VALUES("16300","ΡΕΘΥΜΝΟ","Kleoniki Mare","2831040699","91","6:35:08","3","680","680","");
INSERT INTO testhotel VALUES("16400","ΡΕΘΥΜΝΟ","Swell Boutique","2831050110","91","6:40:00","3","690","690","");
INSERT INTO testhotel VALUES("16500","ΡΕΘΥΜΝΟ","Palm Beach Hotel Apartments","2831025597","92","6:40:01","3","720","720","");
INSERT INTO testhotel VALUES("16600","ΡΕΘΥΜΝΟ","Aloe Apartments","2831025450","92","6:40:02","3","720","720","");
INSERT INTO testhotel VALUES("16700","ΡΕΘΥΜΝΟ","Steris Beach","2831028303","93","6:40:03","3","720","720","");
INSERT INTO testhotel VALUES("16800","ΡΕΘΥΜΝΟ","Leonidas Hotel & Apartments","2831051754","94","6:40:04","3","720","720","");
INSERT INTO testhotel VALUES("16900","ΡΕΘΥΜΝΟ","Birais","2831055529","94","6:40:05","3","720","720","");
INSERT INTO testhotel VALUES("17000","ΡΕΘΥΜΝΟ","Theo","2831050187","95","6:40:06","3","700","700","");
INSERT INTO testhotel VALUES("17100","ΡΕΘΥΜΝΟ","Poseidon","2831023795","95","6:40:07","3","700","700","");
INSERT INTO testhotel VALUES("17200","ΡΕΘΥΜΝΟ","Pegasus","2831025530","96","6:40:08","3","700","700","");
INSERT INTO testhotel VALUES("17300","ΡΕΘΥΜΝΟ","Bio Suites","283158403","97","6:40:09","3","730","730","");
INSERT INTO testhotel VALUES("17400","ΡΕΘΥΜΝΟ","Aquila Porto Rethymno","2831050432","97","6:40:10","3","730","730","");
INSERT INTO testhotel VALUES("17500","ΡΕΘΥΜΝΟ","Ilios Beach Hotel Apartments","2831055672","98","6:40:11","3","730","730","");
INSERT INTO testhotel VALUES("17600","ΡΕΘΥΜΝΟ","Kriti Beach","2831027401","99","6:40:12","3","750","750","");
INSERT INTO testhotel VALUES("17700","ΡΕΘΥΜΝΟ","The Sea View Apartments","2831024533","100","6:40:13","3","750","750","");
INSERT INTO testhotel VALUES("17800","ΡΕΘΥΜΝΟ","Cosmos","2831052244","100","6:40:14","3","760","760","");
INSERT INTO testhotel VALUES("17900","ΡΕΘΥΜΝΟ","Aqua Marina","2831035340","100","6:40:15","3","760","760","");
INSERT INTO testhotel VALUES("18000","ΡΕΘΥΜΝΟ","Astali","2831024721","101","6:40:16","3","770","770","");
INSERT INTO testhotel VALUES("18100","ΡΕΘΥΜΝΟ","Elina Hotel Apartments","2831027395","101","6:40:17","3","770","770","");
INSERT INTO testhotel VALUES("18200","ΡΕΘΥΜΝΟ","Achillion Palace","2831051502","102","6:40:18","3","770","770","");
INSERT INTO testhotel VALUES("18300","ΡΕΘΥΜΝΟ","Jason","2831022542","102","6:40:19","3","760","760","");
INSERT INTO testhotel VALUES("18400","ΡΕΘΥΜΝΟ","Constantin","2831020221","102","6:40:20","3","760","760","");
INSERT INTO testhotel VALUES("18500","ΡΕΘΥΜΝΟ","Kyma Beach","2831055503","103","6:40:21","3","760","760","");
INSERT INTO testhotel VALUES("18600","ΕΥΛΗΓΙΑ","Forest Park","2831051778","101","6:45:00","3","760","760","");
INSERT INTO testhotel VALUES("18700","ΡΕΘΥΜΝΟ","Liberty","2831055851","104","6:45:01","3","790","791","");
INSERT INTO testhotel VALUES("18800","ΡΕΘΥΜΝΟ","Olympic Palladium","2831024762","104","6:45:02","3","790","791","");
INSERT INTO testhotel VALUES("18900","ΡΕΘΥΜΝΟ","Brascos","2831023721","105","6:45:03","3","800","801","");
INSERT INTO testhotel VALUES("19000","ΡΕΘΥΜΝΟ","Jo-An","2831024241","106","6:45:04","3","800","801","");
INSERT INTO testhotel VALUES("19100","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Afroditi Suites","2831022246","107","6:45:05","3","800","801","");
INSERT INTO testhotel VALUES("19200","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Casa De Delfini","2831055120","107","6:45:06","3","800","801","");
INSERT INTO testhotel VALUES("19300","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Casa Vitae","2831035058","107","6:45:07","3","800","801","");
INSERT INTO testhotel VALUES("19400","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Leo Hotel","2831026197","107","6:45:08","3","800","801","");
INSERT INTO testhotel VALUES("19500","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Vetera Suites","2831023844","107","6:45:09","3","800","801","");
INSERT INTO testhotel VALUES("19600","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Youth Hostel","2831022848","107","6:45:10","3","800","801","");
INSERT INTO testhotel VALUES("19700","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Bellagio Luxury Boutique","2831055777","107","6:45:11","3","800","801","");
INSERT INTO testhotel VALUES("19800","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Civitas Boutique","2831035127","107","6:45:12","3","800","801","");
INSERT INTO testhotel VALUES("19900","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Mythos Suites","2831053917","107","6:45:13","3","800","801","");
INSERT INTO testhotel VALUES("20000","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Rethymno House","2831023924","107","6:45:14","3","800","801","");
INSERT INTO testhotel VALUES("20100","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Pepi Studios","2831026428","107","6:45:15","3","800","801","");
INSERT INTO testhotel VALUES("20200","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Anna\\\\\\\'s Apartments (Old Town)","2831052951","107","6:45:16","3","800","801","");
INSERT INTO testhotel VALUES("20300","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Rimondi Boutique","2831051289","107","6:45:17","3","800","801","");
INSERT INTO testhotel VALUES("20400","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Palazzo Rimondi","2831051001","108","6:45:18","3","800","801","");
INSERT INTO testhotel VALUES("20500","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Palazzino Di Corina","2831021205","108","6:45:19","3","800","801","");
INSERT INTO testhotel VALUES("20600","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Palazzo Vecchio","2831035351","108","6:45:20","3","800","801","");
INSERT INTO testhotel VALUES("20700","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","VECCHIO-ΒΕΚΙΟ","2831054985","108","6:45:21","3","800","801","");
INSERT INTO testhotel VALUES("20800","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Fortezza","2831055551","108","6:45:22","3","800","801","");
INSERT INTO testhotel VALUES("20900","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Ideon","2831028667","108","6:45:23","3","800","801","");
INSERT INTO testhotel VALUES("21000","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Barbara Studios","2831022607","108","6:45:24","3","800","801","");
INSERT INTO testhotel VALUES("21100","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Sohora Boutique Hotel","2831300913","108","6:45:25","3","800","801","");
INSERT INTO testhotel VALUES("21200","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Avli Lounge Apartments","2831058250","108","6:45:26","3","800","801","");
INSERT INTO testhotel VALUES("21300","ΡΕΘΥΜΝΟ (Παλιά Πόλη)","Private (Old Town)","","108","6:45:27","3","800","801","");
INSERT INTO testhotel VALUES("21400","ΡΕΘΥΜΝΟ","Belvedere","2831026898","109","6:50:00","3","810","810","");
INSERT INTO testhotel VALUES("21500","ΡΕΘΥΜΝΟ","Archipelagos Residence","2831054754","110","6:50:01","3","820","820","");
INSERT INTO testhotel VALUES("21600","ΡΕΘΥΜΝΟ","Macaris Suites & Spa","2831054757","110","6:50:02","3","810","810","");
INSERT INTO testhotel VALUES("21700","ΡΕΘΥΜΝΟ","Creta Seafront Residences","2831022208","111","6:50:03","3","830","830","");
INSERT INTO testhotel VALUES("21800","ΡΕΘΥΜΝΟ","Rehtymno Hills","2831057040","112","6:50:04","3","830","830","");
INSERT INTO testhotel VALUES("21900","ΡΕΘΥΜΝΟ","Filoxenia Beach","2831055325","113","6:50:05","3","830","830","");
INSERT INTO testhotel VALUES("22000","ΡΕΘΥΜΝΟ","Petradi Beach Lounge","2831055325","114","6:50:06","3","830","830","");
INSERT INTO testhotel VALUES("22100","ΚΟΥΜΠΕΣ","Delfini Beach (Koumpes)","2831035245","115","6:50:07","3","840","840","");
INSERT INTO testhotel VALUES("22200","ΑΤΣΙΠΟΠΟΥΛΟ","Rethymno Panorama","2831026250","116","6:50:08","3","850","850","");
INSERT INTO testhotel VALUES("22300","ΑΤΣΙΠΟΠΟΥΛΟ","Pantheon","2831054914","116","6:50:09","3","850","850","");
INSERT INTO testhotel VALUES("22400","ΝΕΒΕΛΟ","Camari Garden","2831031272","117","7:05:00","3","860","860","");
INSERT INTO testhotel VALUES("22500","ΓΕΩΡΓΙΟΥΠΟΛΗ","Hydramis Palace","2831061000","118","7:05:01","3","870","870","");
INSERT INTO testhotel VALUES("22600","ΓΕΩΡΓΙΟΥΠΟΛΗ","Ermioni Beach","2831061678","119","7:05:02","3","870","870","");
INSERT INTO testhotel VALUES("22700","ΓΕΩΡΓΙΟΥΠΟΛΗ","Poledas Apartments","2831061062","119","7:05:03","3","870","870","");
INSERT INTO testhotel VALUES("22800","ΓΕΩΡΓΙΟΥΠΟΛΗ","Palladion (Kavros)","2831061720","119","7:05:04","3","870","870","");
INSERT INTO testhotel VALUES("22900","ΓΕΩΡΓΙΟΥΠΟΛΗ","Anatoli Beach (Kavros)","2825061001","120","7:05:05","3","880","880","");
INSERT INTO testhotel VALUES("23000","ΓΕΩΡΓΙΟΥΠΟΛΗ","Kavros Beach (Kavros)","","120","7:05:06","3","880","880","");
INSERT INTO testhotel VALUES("23100","ΓΕΩΡΓΙΟΥΠΟΛΗ","Aquamar Beach (Kavros)","2825061332","120","7:05:07","3","880","880","");
INSERT INTO testhotel VALUES("23200","ΓΕΩΡΓΙΟΥΠΟΛΗ","Silver Beach (Kavros)","2825083078","121","7:05:08","3","890","890","");
INSERT INTO testhotel VALUES("23300","ΓΕΩΡΓΙΟΥΠΟΛΗ","Kournas Village (Kavros)","2825061416","121","7:05:09","3","890","890","");
INSERT INTO testhotel VALUES("23400","ΓΕΩΡΓΙΟΥΠΟΛΗ","Happy Days (Kavros)","2825061201","122","7:05:10","3","900","900","");
INSERT INTO testhotel VALUES("23500","ΓΕΩΡΓΙΟΥΠΟΛΗ","Sandy Beach (Kavros)","2825061201","122","7:05:11","3","900","900","");
INSERT INTO testhotel VALUES("23600","ΓΕΩΡΓΙΟΥΠΟΛΗ","Orpheas Resort (Kavros)","2825061218","122","7:05:12","3","900","900","");
INSERT INTO testhotel VALUES("23700","ΓΕΩΡΓΙΟΥΠΟΛΗ","Vantaris Beach (Kavros)","2825061231","123","7:05:13","3","910","910","");
INSERT INTO testhotel VALUES("23800","ΓΕΩΡΓΙΟΥΠΟΛΗ","Delfina Art Resort (Kavros)","2825061272","123","7:05:14","3","910","910","");
INSERT INTO testhotel VALUES("23900","ΓΕΩΡΓΙΟΥΠΟΛΗ","Apollo (Kavros)","2825061100","123","7:05:15","3","910","910","");
INSERT INTO testhotel VALUES("24000","ΓΕΩΡΓΙΟΥΠΟΛΗ","Eliros Mare (Kavros)","2825061181","124","7:05:16","3","910","910","");
INSERT INTO testhotel VALUES("24100","ΓΕΩΡΓΙΟΥΠΟΛΗ","Vantaris Palace (Kavros)","2825061783","125","7:05:17","3","910","910","");
INSERT INTO testhotel VALUES("24200","ΓΕΩΡΓΙΟΥΠΟΛΗ","Delfina Beach (Kavros)","2825061272","126","7:05:18","3","910","910","");
INSERT INTO testhotel VALUES("24300","ΓΕΩΡΓΙΟΥΠΟΛΗ","Mythos Palace Resort & Spa (Kavros)","2825061713","127","7:05:19","3","910","910","");
INSERT INTO testhotel VALUES("24400","ΓΕΩΡΓΙΟΥΠΟΛΗ","Georgioupolis Resort (Kavros)","2825061126","128","7:05:20","3","920","920","");
INSERT INTO testhotel VALUES("24500","ΓΕΩΡΓΙΟΥΠΟΛΗ","Anemos Luxury Grand Resort (Kavros)","2825062550","129","7:05:21","3","920","920","");
INSERT INTO testhotel VALUES("24600","ΓΕΩΡΓΙΟΥΠΟΛΗ","Posidon Studios(Kavros)","2825061160","130","7:05:22","3","920","920","");
INSERT INTO testhotel VALUES("24700","ΓΕΩΡΓΙΟΥΠΟΛΗ","Pilot Beach Resort (Kavros)","2825061002","131","7:05:23","3","930","930","");
INSERT INTO testhotel VALUES("24800","ΓΕΩΡΓΙΟΥΠΟΛΗ","Mare Monte Beach (Kavros)","2825061390","132","7:05:24","3","930","930","");
INSERT INTO testhotel VALUES("24900","ΓΕΩΡΓΙΟΥΠΟΛΗ","Kokalas Resort","2825061293","133","7:05:25","3","940","940","");
INSERT INTO testhotel VALUES("25000","ΓΕΩΡΓΙΟΥΠΟΛΗ","Fereniki Resort & Spa","2825061297","133","7:05:26","3","940","940","");
INSERT INTO testhotel VALUES("25100","ΓΕΩΡΓΙΟΥΠΟΛΗ","Corissia Princess","2825083010","133","7:05:27","3","940","940","");
INSERT INTO testhotel VALUES("25200","ΓΕΩΡΓΙΟΥΠΟΛΗ","Corissia Beach","2825083010","133","7:05:28","3","940","940","");
INSERT INTO testhotel VALUES("25300","ΓΕΩΡΓΙΟΥΠΟΛΗ","Georgioupolis Beach","2825061056","133","7:05:29","3","940","940","");
INSERT INTO testhotel VALUES("25400","ΡΕΘΥΜΝΟ","Private (City)","","134","","3","0","0","");
INSERT INTO testhotel VALUES("25500","ΡΕΘΥΜΝΟ","Private (Outside)","","135","","3","0","0","");



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uName` varchar(30) CHARACTER SET utf8 NOT NULL,
  `uPass` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users VALUES("0","administrator","4922bb438526bc4e875ebf5569250231");
INSERT INTO users VALUES("1","Boss","652da4fcc91c3291ded0c1cc38a22c41");
INSERT INTO users VALUES("3","test","9999");



SET FOREIGN_KEY_CHECKS=1;
COMMIT;