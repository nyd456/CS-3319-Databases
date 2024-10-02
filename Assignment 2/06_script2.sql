
USE assign2db;

-- Part 1 SQL Updates

SELECT * FROM hospital;
UPDATE hospital SET headdoc = "GD56", headdocstartdate = "2010-12-19" WHERE hoscode = "BBC";
UPDATE hospital SET headdoc = "SE66", headdocstartdate = "2004-05-30" WHERE hoscode = "ABC";
UPDATE hospital SET headdoc = "YT67", headdocstartdate = "2001-06-01" WHERE hoscode = "DDE";
SELECT * FROM hospital;


-- Part 2 SQL Inserts

-- Insert a doctor 
INSERT INTO doctor VALUES ('AC39','Alan', 'Alda','1989-09-09', '1963-03-06','ABC','Pediatrics');

-- Insert a patient
INSERT INTO patient VALUES ('963369693','Steve','Carell','1962-08-16');

-- Insert the looksafter
INSERT INTO looksafter VALUES ('AC39','963369693');

-- Insert a new hospital
INSERT INTO hospital VALUES ('XYZ','Mount Sinai', 'Toronto', 'ON', 442, 'AC39', '2022-10-05');

-- Show updated tables
SELECT * FROM doctor;
SELECT * FROM patient;
SELECT * FROM looksafter;
SELECT * FROM hospital;

-- Part 3 SQL Queries

-- Query 1
SELECT lastname FROM patient;

-- Query 2
SELECT DISTINCT lastname FROM patient;

-- Query 3
SELECT * FROM doctor ORDER BY lastname ASC;

-- Query 4
SELECT hosname, hoscode FROM hospital WHERE numofbed > 1500;

-- Query 5
SELECT doctor.firstname, doctor.lastname FROM doctor INNER JOIN hospital ON doctor.hosworksat = hospital.hoscode WHERE hospital.hosname = "St. Joseph";

-- Query 6
SELECT firstname, lastname FROM patient WHERE lastname LIKE "G%";

-- Query 7
SELECT firstname,lastname FROM patient WHERE ohipnum IN (SELECT ohipnum FROM looksafter WHERE licensenum IN (SELECT licensenum FROM doctor WHERE lastname = "Webster"));

-- Query 8
SELECT hosname, city, doctor.lastname FROM hospital, doctor WHERE hospital.headdoc = doctor.licensenum;

-- Query 9
SELECT SUM(numofbed) AS "Total Number of Beds" FROM hospital;

-- Query 10
SELECT patient.firstname, patient.lastname, doctor.firstname, doctor.lastname FROM patient, doctor WHERE (ohipnum, licensenum) IN (SELECT ohipnum, licensenum FROM looksafter WHERE licensenum IN (SELECT headdoc FROM hospital));

-- Query 11
SELECT doctor.lastname, doctor.firstname, hospital.prov FROM doctor, hospital WHERE doctor.hosworksat =  hospital.hoscode AND  doctor.speciality = "Surgeon" AND hospital.hosname = "Victoria";

-- Query 12
SELECT firstname FROM doctor WHERE licensenum NOT IN (SELECT licensenum FROM looksafter);

-- Query 13
SELECT lastname,firstname, COUNT(looksafter.ohipnum) AS "Number of Patients",hospital.hosname  FROM doctor,hospital,looksafter WHERE doctor.licensenum = looksafter.licensenum  AND doctor.hosworksat =  hospital.hoscode GROUP BY looksafter.licensenum HAVING (COUNT(looksafter.licensenum)>1);

-- Query 14
SELECT firstname AS "Doctor First Name", lastname AS "Doctor Last Name",t1.hosname AS "Head of Hospital Name", t2.hosname AS "Works at Hospital Name" FROM doctor, hospital t1, hospital t2 WHERE t1.headdoc = doctor.licensenum AND t1.hoscode <> doctor.hosworksat AND hosworksat = t2.hoscode;

-- Query 15 - My Query - Display first name,last name,and works at hospital name of all the doctors who work at Ontario hospital and has licened before year 1985

SELECT firstname AS "Doctor First Name", lastname AS "Doctor Last Name", hosname AS "Works at Hospital Name" FROM doctor, hospital WHERE doctor.hosworksat = hospital.hoscode AND hospital.prov = "ON" AND licensedate < '1985-01-01';

-- Part 4 SQL Views/Deletes

-- Create a view, dpview represents doctor patient view
CREATE VIEW dpview AS SELECT doctor.firstname AS dfirst, doctor.lastname AS dlast, doctor.birthdate AS dbirth, patient.firstname AS pfirst, patient.lastname AS plast, patient.birthdate AS pbirth FROM doctor, patient WHERE (doctor.licensenum, patient.ohipnum) IN (SELECT licensenum, ohipnum FROM looksafter);

SELECT * FROM dpview;

SELECT dlast, dbirth, plast, pbirth FROM dpview WHERE dbirth > pbirth;

SELECT * FROM patient;

SELECT * FROM looksafter;

DELETE FROM patient WHERE firstname = "Steve" AND lastname = "Carell";

SELECT * FROM patient;

SELECT * FROM looksafter;

SELECT * FROM doctor;

DELETE FROM doctor WHERE firstname = "Bernie";

SELECT * FROM doctor;

DELETE FROM doctor WHERE firstname = "Alan" AND lastname = "Alda";
-- Cannot delete the new doctor since this doctor is the head of the new hospital(XYZ); so it will cause a foreign key constraint fail.
