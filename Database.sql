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


CREATE TABLE input (ordre int(2),name CHAR(20),id CHAR(20),type CHAR(20),condition CHAR(20),value CHAR(20),href CHAR(20),label CHAR(20),required CHAR(20),minlength int(3),maxlength int(3));



select * from input order by ordre

while (fetch_obj{
  if ($type=="text"){
    echo "<p>"$label"<input id="$id" required type="$text" name="$logID"/></p>"



  }
  if ($type=="textarea"){



  }
  if ($type=="a"){


  }
}
