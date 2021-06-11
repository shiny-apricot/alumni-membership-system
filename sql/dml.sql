

--@block
INSERT INTO Member (Member_ID, Member_Number, Gender, Name, Surname, Workplace, E_Mail, Graduation_Date, National_ID_Number, Department, Phone_Number, Remaining_Fee)
VALUES (1,1,'female', 'anakin', 'skywalker', 'StarWars', 'sa@sa.com', '2023-01-01','55555555555', 'CMP' , '0542 424 42 42', 155),
       (2,2,'female', 'anakin', 'skywalker', 'StarWars', 'sa@sa.com', '2023-01-01','24215435321', 'EEE' , '0542 424 42 42', 155),
       (3,3,'female', 'anakin', 'skywalker', 'StarWars', 'sa@sa.com', '2023-01-01','43243543542', 'CVL' , '0542 424 42 42', 155),
       (4,4,'female', 'anakin', 'skywalker', 'StarWars', 'sa@sa.com', '2023-01-01','543543543', 'BSN' , '0542 424 42 42', 155),
        (5,5,'female', 'anakin', 'skywalker', 'StarWars', 'sa@sa.com', '2023-01-01','5234532524', 'BSN' , '0542 424 42 42', 155),
       (6,6,'female', 'anakin', 'skywalker', 'StarWars', 'sa@sa.com', '2023-01-01','543543543534', 'CMP' , '0542 424 42 42', 155);

--@block
INSERT INTO Department (Department_Code, department_name) VALUES
                                                                   ('CMP', 'Computer Engineering'),
                                                                   ('BSN', 'Business Administration'),
                                                                   ('MCH', 'Mechanical Engineering'),
                                                                   ('CVL', 'Civil Engineering'),
                                                                   ('EEE', 'EE Engineering');

