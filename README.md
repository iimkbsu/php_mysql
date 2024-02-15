mysql -u root -p
show databases;
use opentutorials;
show tables;

CREATE TABLE topic (id INT(11) NOT NULL AUTO_INCREMENT title VARCHAR(45) NOT NULL description TEXT NULL created DATETIME NOT NULL author_id INT(11) PRIMARY KEY(id) );

CREATE TABLE author (id INT(11) NOT NULL AUTO_INCREMENT name VARCHAR(30) NOT NULL profile VARCHAR(200) NULL PRIMARY KEY(id));

INSERT INTO topic () VALUES ();
INSERT INTO author () VALUES ();

SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id ORDER BY topic.id ASC;
