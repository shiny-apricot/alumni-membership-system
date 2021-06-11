
--@block
USE DATABASE alumni;

--@block
CREATE TABLE Department (
  Department_Code varchar (5),
  department_name varchar (50),
  PRIMARY KEY (Department_Code)
);

--@block
CREATE TABLE Member (
  Member_ID int,
  Member_Number int,
  Gender varchar (6),
  Name varchar (20),
  Surname varchar (50),
  Workplace varchar (50),
  E_Mail varchar (50),
  Graduation_Date varchar (10),
  National_ID_Number varchar(20),
  Department varchar (50),
  Phone_Number varchar(20),
  Address varchar (50),
  Province varchar (50),
  Remaining_Fee int,
  Inform_Member_Sit varchar (150),
  Member_Regist_Date varchar (10),
  Member_Situation varchar (10),
  PRIMARY KEY (Member_ID, Member_Number, 
  National_ID_Number),
  FOREIGN KEY (Department) REFERENCES Department(Department_Code)
);

-- CREATE INDEX "Key" ON  "Member" ("Gender", "Name", "Surname", "Workplace", "E-Mail", "Graduation Date", "Department", "Phone_Number", "Address", "Province", "Remaining_Fee", "Inform_Member_Sit", "Member_Regist_Date", "Member_Situation");


--@block
CREATE TABLE Years (
  Year int,
  Annual_Fee int,
  PRIMARY KEY (Year)
);

-- CREATE INDEX "Years" ON  "Years" ("Annual Fee");

--@block
CREATE TABLE User (
  User_ID int,
  E_Mail varchar (50),
  Password varchar (50),
  PRIMARY KEY (User_ID)
);

-- CREATE INDEX "User" ON  "User" ("E-Mail", "Password");

--@block
CREATE TABLE Receipt (
  Receipt_No int,
  National_ID_Number int,
  Balance int,
  Tag varchar (50),
  Explanation varchar (100),
  Fee int,
  Date_of_Receipt varchar (10),
  PRIMARY KEY (Receipt_No)
);

-- CREATE INDEX "Receipt" ON  "Receipt" ("Balance", "Tag", "Explanation", "Fee", "Date_of_Receipt");

--@block
CREATE TABLE Payment (
  Member_ID int,
  Year int,
  Fee int,
  PRIMARY KEY (Member_ID, Year)
);

--@block
CREATE TABLE Admin (
  User_ID int,
  Password varchar (50)
);

-- CREATE INDEX Admin ON  Admin (Password);