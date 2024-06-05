create database users;

use users;

CREATE TABLE user (
    id integer primary key auto_increment,
    name varchar(255) not null,
    surname varchar(255) not null,
    indirizzo VARCHAR(255) DEFAULT NULL,
    telefono VARCHAR(20) DEFAULT NULL,
    username varchar(16) not null unique,
	email varchar(255) not null unique,
    password varchar(255) not null
) Engine = InnoDB;

CREATE TABLE prodotti (
	id integer primary key auto_increment,
    titolo VARCHAR(255) NOT NULL,
    descrizione TEXT,
    categoria VARCHAR(255),
    prezzo DECIMAL(10, 2) NOT NULL
);

CREATE TABLE immagini (
    prodotto_id INT,
    immagine_id INT,
    immagine_path VARCHAR(255),
    PRIMARY KEY (prodotto_id, immagine_id),
    FOREIGN KEY (prodotto_id) REFERENCES prodotti(id) ON DELETE CASCADE
);

CREATE TABLE carrello (
	id integer primary key auto_increment,
    user_id integer not null,
    foreign key (user_id) references user(id),
    prod_id varchar(255),
    content json
) Engine = InnoDB;

drop table immagini;
drop table prodotti;

SELECT p.id, p.titolo, p.prezzo, i.immagine_path
        FROM prodotti p
        LEFT JOIN immagini i ON p.id = i.prodotto_id
        GROUP BY p.id, p.titolo, p.descrizione, p.prezzo;
        
SELECT p.id, p.titolo, p.prezzo, i.immagine_path
        FROM prodotti p
        LEFT JOIN immagini i ON p.id = i.prodotto_id;
        
SELECT p.id, p.titolo, p.categoria, p.prezzo, i.immagine_path
      FROM prodotti p
      LEFT JOIN immagini i ON p.id = i.prodotto_id
      GROUP BY p.id
      LIMIT 10 OFFSET 5;
      
SELECT p.titolo, p.descrizione, i.immagine_path 
	FROM prodotti p
	JOIN immagini i ON p.id = i.prodotto_id
	WHERE p.id = 3;
    
SELECT p.id, p.titolo, p.categoria, p.prezzo, i.immagine_path
	FROM prodotti p
	LEFT JOIN immagini i ON p.id = i.prodotto_id
	WHERE p.titolo LIKE '%Scheda Video%'
	GROUP BY p.id;
    

    
