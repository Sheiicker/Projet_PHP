use vm950914
-- https://dev.azure.com/
-- SHOW tables;
-- DESCRIBE user;

CREATE TABLE user (owner int(1), user int(1), pseudo CHAR(15), mdp CHAR(20), mail CHAR(35), age int(8));
ALTER TABLE user ADD CONSTRAINT PRIMARY KEY (pseudo);
CREATE TABLE sell (id CHAR(13),name CHAR(50) NOT NULL,user_pseudo CHAR(15) NOT NULL,comment TEXT(1000),PRIMARY KEY (id),INDEX user_pseudo (user_pseudo)) ENGINE=InnoDB;
ALTER TABLE sell ADD CONSTRAINT FOREIGN KEY (user_pseudo) REFERENCES user (pseudo);
CREATE TABLE bets (user_pseudo CHAR(15) NOT NULL,id_prod int(10) NOT NULL, amount float NOT NULL,INDEX user_pseudo (user_pseudo),INDEX id_prod (id_prod)) ENGINE=InnoDB;
ALTER TABLE bets ADD CONSTRAINT FOREIGN KEY (user_pseudo) REFERENCES user (pseudo);
ALTER TABLE bets ADD CONSTRAINT FOREIGN KEY (id_prod) REFERENCES sell (id);
ALTER TABLE user ADD money int(6);
UPDATE user SET money=0;
DELETE FROM sell WHERE user_pseudo=vm950914;
DELETE FROM sell WHERE name like 'some%';

-- METADONNEES
CREATE TABLE input (ordre int(2) NOT NULL, name CHAR(20), id CHAR(20), class CHAR(20), typecase CHAR(10), type CHAR(20), onchange CHAR(20), value CHAR(20), href CHAR(20), label CHAR(20), required CHAR(20), minlength int(3), maxlength int(3));
ALTER TABLE input ADD CONSTRAINT PRIMARY KEY (ordre);
select * from input order by ordre

INSERT INTO input (ordre, name, id, class, typecase, type, onchange, value, href, label, required, minlength, maxlength) VALUES (1, 'logID', 'userlog', '', 'text', 'text', '', '', '', 'User : ', 'required', 000, 020);

INSERT INTO input (ordre, name, id, class, typecase, type, onchange, value, href, label, required, minlength, maxlength) VALUES (2, 'logMDP', 'passlog', '', 'text', 'password', '', '', '', 'Password : ', 'required', 000, 040);

INSERT INTO input (ordre, name, id, class, typecase, type, onchange, value, href, label, required, minlength, maxlength) VALUES (3, '', '', '', 'text', 'submit', '', 'Submit', '', '', '', 000, 020);


INSERT INTO input (ordre, name, id, class, typecase, type, onchange, value, href, label, required, minlength, maxlength) VALUES (4, 'logID', 'userlog', '', 'text', 'text', '', '', '', 'User : ', 'required', 004, 020);

INSERT INTO input (ordre, name, id, class, typecase, type, onchange, value, href, label, required, minlength, maxlength) VALUES (5, 'logMDP', 'passlog', '', 'text', 'password', '', '', '', 'Password : ', 'required', 004, 040);

INSERT INTO input (ordre, name, id, class, typecase, type, onchange, value, href, label, required, minlength, maxlength) VALUES (6, 'logMAIL', '', '', 'text', 'email', '', '', '', 'Email : ', 'required', 000, 100);

INSERT INTO input (ordre, name, id, class, typecase, type, onchange, value, href, label, required, minlength, maxlength) VALUES (7, 'logAGE', '', '', 'text', 'date', '', '', '', 'Date of birth : ', 'required', 000, 100);

INSERT INTO input (ordre, name, id, class, typecase, type, onchange, value, href, label, required, minlength, maxlength) VALUES (8, '', '', '', 'text', 'submit', '', 'Submit', '', '', '', 000, 020);
-- METADONNEES
