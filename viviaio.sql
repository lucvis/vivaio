create database if not exists vivaio;
use vivaio;

create table if not exists personale(
	IDPersona INT (11) NOT NULL AUTO_INCREMENT,
	Categoria CHAR (20) NOT NULL,
	Cognome CHAR (30) NOT NULL,
	Nome CHAR (30) NOT NULL,
	DataNascita DATE NOT NULL,
	Qualifica CHAR (15) NOT NULL,
	CostoOrario DOUBLE PRECISION,
    Nick CHAR(45) NOT NULL,
	Pwd CHAR(45) NOT NULL,
	Email CHAR(45) NOT NULL,
	PRIMARY KEY (IDPersona),
	CHECK (Categoria IN ('Agronomo','Operaio','Amministrativo'))
);

create table if not exists specie(
	IDSpecie INT (11) NOT NULL AUTO_INCREMENT,
	IDPersona INT (11) NOT NULL,
	ModoColtivazione CHAR (20),
	CaratteristicheEsposizione CHAR (20),
	PRIMARY KEY (IDSpecie),
	CHECK (IDSpecie LIKE 'CS___'),
	FOREIGN KEY (IDPersona) 
	REFERENCES personale(IDPersona)
);

create table if not exists piante(
	IDPianta INT (11) NOT NULL AUTO_INCREMENT,
	IDSpecie INT (11) NOT NULL,
	Nome CHAR (50) NOT NULL,
	Descrizione CHAR (50) NOT NULL,
	Immagine CHAR (20),
	Tipo CHAR (10) NOT NULL,
	Numero INTEGER NOT NULL,
	StagioneFioritura CHAR (9) NOT NULL,
	PrezzoVendita DOUBLE PRECISION NOT NULL,
	PRIMARY KEY (IDPianta),
	CHECK (StagioneFioritura IN ('Primavera','Estate','Autunno', 'Inverno') ),
	CHECK (Tipo IN ('Interno', 'Esterno') ),
	FOREIGN KEY (IDSpecie) REFERENCES specie(IDSpecie)
);

create table if not exists clienti(
	IDCliente INT (11) NOT NULL AUTO_INCREMENT,
	Cognome CHAR (20) NOT NULL,
	Nome CHAR (20) NOT NULL,
	Tipo CHAR (7) NOT NULL,
	Telefono CHAR (11) NOT NULL,
    Nick CHAR(45) NOT NULL,
	Pwd CHAR(45) NOT NULL,
	Email CHAR(45) NOT NULL,
	PRIMARY KEY (IDCliente),
	CHECK (Tipo IN ('Privati','Aziende') )
);

create table if not exists attivita(
	IDAttivita INT (11) NOT NULL,
	Tipo CHAR (20) NOT NULL,
	IDCliente INT (11) NOT NULL,
	Nome CHAR (50),
	DataPrenotazione DATE NOT NULL,
	DataEffetuazione DATE,
	NecessitaPiante BIT NOT NULL,
	Evaso BIT NOT NULL,
	PRIMARY KEY (IDAttivita),
	CHECK (IDAttivita LIKE 'CA___'),
	FOREIGN KEY (IDCliente)
	REFERENCES clienti(IDCliente)
);

create table if not exists dettagli_attivita(
	 IDAttivita INT (11) NOT NULL,
	 IDPersona INT (11) NOT NULL,
	 PRIMARY KEY (IDAttivita, IDPersona),
	 FOREIGN KEY (IDAttivita)
	 REFERENCES attivita(IDAttivita),
	 FOREIGN KEY (IDPersona)
	 REFERENCES personale(IDPersona)
);
 