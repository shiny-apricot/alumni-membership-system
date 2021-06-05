CREATE TABLE `User` (
  `User_ID` int (10),
  `E-Mail` varchar (50),
  `Password` varchar (50),
  PRIMARY KEY (`User_ID`),
  KEY `Key` (`E-Mail`, `Password`)
);

CREATE TABLE `Admin` (
  `User_ID` int (10),
  `E-Mail` varchar (50),
  `Password` varchar (50),
  KEY `Key` (`E-Mail`, `Password`)
);

CREATE TABLE `Member` (
  `Member_ID` int (10),
  `Member_Number` int,
  `Gender` varchar (6),
  `Name` varchar (20),
  `Surname` varchar (50),
  `Workplace` varchar (50),
  `E-Mail` varchar (50),
  `Graduation Date` varchar (10),
  `National_ID_Number` varchar (11),
  `Department` varchar (50),
  `Phone_Number` int (10),
  `Address` varchar (50),
  `Province` varchar (50),
  `Remaining_Fee` int (10),
  `Inform_Member_Sit` varchar (150),
  `Member_Regist_Date` varchar (10),
  `Member_Situation` varchar (10),
  PRIMARY KEY (`Member_ID`, `Member_Number`, `National_ID_Number`),
  KEY `Key` (`Gender`, `Name`, `Surname`, `Workplace`, `E-Mail`, `Graduation Date`, `Department`, `Phone_Number`, `Address`, `Province`, `Remaining_Fee`, `Inform_Member_Sit`, `Member_Regist_Date`, `Member_Situation`)
);

CREATE TABLE `Receipt` (
  `Receipt_No` int (10),
  `Balance` int (50),
  `Tag` varchar (50),
  `Explanation` varchar (100),
  `Fee` int (10),
  `Date_of_Receipt` varchar (10),
  PRIMARY KEY (`Receipt_No`),
  KEY `Key` (`Balance`, `Tag`, `Explanation`, `Fee`, `Date_of_Receipt`)
);

CREATE TABLE `Years` (
  `Member_ID` int (10),
  `Year` int (4),
  `Annual_Fee` int (4),
  `Fee` int (10),
  KEY `Key` (`Year`, `Annual_Fee`)
);

