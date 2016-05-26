DROP TABLE IF EXISTS `member`;
DROP TABLE IF EXISTS `ride`;
DROP TABLE IF EXISTS `scooter`;
DROP TABLE IF EXISTS `model`;
DROP TABLE IF EXISTS `make`;

CREATE TABLE member (
	id int AUTO_INCREMENT,
	fname varchar(255) NOT NULL,
	lname varchar(255) NOT NULL,
	join_date date,
	UNIQUE KEY (fname, lname),
	PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE ride (
	id int AUTO_INCREMENT,
	destination varchar(255) NOT NULL,
	distance int,
	ride_date date,
	PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE make (
	id int AUTO_INCREMENT,
	make_name varchar(255),
	city varchar(255),
	country varchar(225),
	PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE model (
	id int AUTO_INCREMENT,
	model_name varchar(255),
	displacement int,
	top_speed int,
	make_id int,
	PRIMARY KEY (id),

	CONSTRAINT model_ibfk_1
	FOREIGN KEY (make_id)
	REFERENCES make(id)
	ON DELETE NO ACTION
	ON UPDATE CASCADE
)ENGINE=InnoDB;

CREATE TABLE scooter (
	id int AUTO_INCREMENT,
	color varchar(255),
	year int,
	model_id int,
	member_id int,
	PRIMARY KEY (id),

	CONSTRAINT scooter_ibfk_1
	FOREIGN KEY (model_id)
	REFERENCES model(id)
	ON DELETE NO ACTION
	ON UPDATE CASCADE,
	

	CONSTRAINT scooter_ibfk_2
	FOREIGN KEY (member_id)
	REFERENCES member(id)
	ON DELETE NO ACTION
	ON UPDATE CASCADE
)ENGINE=InnoDB;

CREATE TABLE member_ride (
	id int AUTO_INCREMENT,
	member_id int,
	ride_id int,
	UNIQUE KEY (member_id, ride_id),
	PRIMARY KEY (id),

	CONSTRAINT member_ride_ibfk_1
	FOREIGN KEY (member_id)
	REFERENCES member(id)
	ON DELETE NO ACTION
	ON UPDATE CASCADE,
	

	CONSTRAINT member_ride_ibfk_2
	FOREIGN KEY (ride_id)
	REFERENCES ride(id)
	ON DELETE NO ACTION
	ON UPDATE CASCADE
)ENGINE=InnoDB;