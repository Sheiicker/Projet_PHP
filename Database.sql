use vm950914
-- https://dev.azure.com/
-- SHOW tables;
-- DESCRIBE user;

CREATE TABLE user (owner int(1), user int(1), pseudo CHAR(15), mdp CHAR(20), mail CHAR(35), age int(8));
CREATE TABLE sell (id int(10),name CHAR(50) NOT NULL,user_pseudo CHAR(15) NOT NULL,comment TEXT(1000),PRIMARY KEY (id),INDEX user_pseudo (user_pseudo)) ENGINE=InnoDB;
CREATE TABLE bets (user_pseudo CHAR(15) NOT NULL,id_prod int(10) NOT NULL, amount float NOT NULL,INDEX user_pseudo (user_pseudo),INDEX id_prod (id_prod)) ENGINE=InnoDB;
ALTER TABLE user ADD CONSTRAINT PRIMARY KEY (pseudo);
ALTER TABLE sell ADD CONSTRAINT FOREIGN KEY (user_pseudo) REFERENCES user (pseudo);
ALTER TABLE bets ADD CONSTRAINT FOREIGN KEY (user_pseudo) REFERENCES user (pseudo);
ALTER TABLE bets ADD CONSTRAINT FOREIGN KEY (id_prod) REFERENCES sell (id);
ALTER TABLE user ADD money int(6);
UPDATE user SET money=0;
DELETE FROM sell WHERE user_pseudo=vm950914;
DELETE FROM sell WHERE name like 'some%';
