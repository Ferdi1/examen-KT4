drop database if exists toolsforever;
create database toolsforever;

use toolsforever;

SET foreign_key_checks = 0;

create table locatie (
	locatiecode varchar(3),
	locatie varchar(15),
	primary key(locatiecode)
) engine=INNODB;

create table voorraad (
	locatiecode varchar(3),
	productcode varchar(5),
	aantal int,
	foreign key(locatiecode) references locatie(locatiecode),
	foreign key(productcode) references artikel(productcode)
) engine=INNODB;

create table artikel (
	productcode varchar(5),
	product varchar(25),
	type varchar(20),
	fabriekscode varchar(5),
	inkoopsprijs decimal(10, 2),
	verkoopsprijs decimal(10,2),
	primary key(productcode),
	foreign key(fabriekscode) references fabriek(fabriekscode)
) engine=INNODB;

create table fabriek (
	fabriekscode varchar(5),
	fabrieksnaam varchar(15),
	telefoon varchar(10),
	primary key(fabriekscode)
) engine=INNODB;

create table medewerker (
	medewerkerscode varchar(5),
	voorletters varchar(10),
	voorvoegsel varchar(10),
	achternaam varchar(25),
	gebruikersnaam varchar(20),
	wachtwoord varchar(40),
	primary key(medewerkerscode)
) engine=INNODB;

insert into locatie (locatiecode, locatie)
	values	('Rtd', 'Rotterdam'),
			('ALM', 'Almere'),
			('Ein', 'Eindhoven');
			
insert into fabriek (fabriekscode, fabrieksnaam, telefoon)
	values	('worx', 'Worx', '0201234567'),
			('bed', 'Black & Dekker', '0109865321'),
			('einh', 'Einhell', '0365487329'),
			('karch', 'Karchen', '0320556644'),
			('bosch', 'Bosch', '0106745125'),
			('sency', 'Sencys', '0364433226');
			
insert into artikel (productcode, product, type, fabriekscode, inkoopsprijs, verkoopsprijs)
	values	('wx382', 'Accu boorhamer', 'WX 382', 'worx', 69.95, 111.75),
			('KA280', '4-in-1 schuurmachine', 'KA 280 K', 'bed', 55.95, 67.95),
			('BTMS2', 'Verstekzaag', 'BT-MS 2112', 'einh', 49.95, 67.49),
			('WD220', 'Alleszuiger', 'WD2.200', 'Karch', 29.95, 47.96),
			('PSR14', 'Accuboormachine', 'PSR 14.4', 'bosch', 59.95, 68.00),
			('33db', '33 delige borenset', '', 'sency',	9.95,	15.2),
			('WM536', 'Workmate', 'WM 536', 'bed', 49.95, 63.2),
			('PCL20', 'Kruislijnlaserset', 'PCL 20', 'bosch', 99.95, 122.40);

insert into voorraad (locatiecode, productcode, aantal)
	values	('Rtd', 'KA280', 15),
			('Rtd', 'BTMS2', 2),
			('Ein', 'PCL20', 11),
			('Ein', 'PSR14', 12),
			('Alm', 'WX382', 11),
			('Alm', 'PSR14', 12),
			('Rtd', 'WX382', 10),
			('Ein', 'WM536', 14),
			('Alm', 'WD220', 4),
			('Alm', '33db', 54),
			('Ein', 'WX382', 11);
			
insert into medewerker (medewerkerscode, voorletters, voorvoegsel, achternaam, gebruikersnaam, wachtwoord)
	values	('halvt', 'T.', '', 'Halvers', 'Halverst',	SHA1('Halverst')),
			('koorv', 'V. A.', '', 'Koortens', 'Koortensv',	SHA1('Koortensv')),
			('dijkb', 'B. R.', 'van', 'Dijk', 'Dijkb',	SHA1('Dijkb'));

SET foreign_key_checks = 1;
