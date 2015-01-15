select * from attivita;
select * from clienti;
select * from dettagli_attivita;
select * from personale;
select * from piante;
select * from specie;

insert into clienti(IDCliente, Cognome, Nome, Tipo, Telefono, Nick, Pwd, Email) values (0, 'Porcaro', 'Guido', 'Privato', '0541112233', 'Guich', 'guich', 'g@g.it');

SELECT IDCliente FROM clienti WHERE (email = 'g@g.it' OR nick = 'guich') and pwd = 'guich'