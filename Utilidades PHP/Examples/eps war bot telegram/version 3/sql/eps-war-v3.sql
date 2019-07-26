CREATE TABLE people(
	id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(50),
    life int DEFAULT 1
);

CREATE TABLE muertes(
	id int PRIMARY KEY AUTO_INCREMENT,
    slasher int,
    victim int,
    
    FOREIGN KEY (slasher) REFERENCES people(id),
    FOREIGN KEY (victim) REFERENCES people(id)
);

CREATE TABLE ress(
	id int PRIMARY KEY AUTO_INCREMENT,
    ress int,
    
    FOREIGN KEY (ress) REFERENCES people(id)
);

CREATE TABLE counters(
	id int PRIMARY KEY AUTO_INCREMENT,
    people1 int,
    people2 int,
    
    FOREIGN KEY (people1) REFERENCES people(id),
    FOREIGN KEY (people2) REFERENCES people(id)
);

CREATE TABLE formas(
	id int PRIMARY KEY AUTO_INCREMENT,
    people int,
    forma varchar(200),
    
    FOREIGN KEY (people) REFERENCES people(id)
);

CREATE TABLE acciones(
	id int PRIMARY KEY AUTO_INCREMENT,
    accion varchar(200)
);