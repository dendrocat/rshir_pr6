CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;

CREATE TABLE IF NOT EXISTS materials (
  ID INT(11) AUTO_INCREMENT,
  name VARCHAR(40) NOT NULL,
  PRIMARY KEY (ID)
);

INSERT INTO materials (name) VALUES
('Золото'), ('Серебро');


CREATE TABLE IF NOT EXISTS products (
  ID INT AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  price int NOT NULL,
  matID int not null,
  PRIMARY KEY (ID),
  FOREIGN KEY (matID) REFERENCES materials (ID)
);


INSERT INTO products (name, price, matID) VALUES
('Кольцо 1', 10000, 1), ('Колье 1', 15000, 2), 
('Серьги', 3000, 1), ('Кольцо 2', 5000, 2);

CREATE TABLE IF NOT EXISTS user_group (
    ID INT AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    PRIMARY KEY (ID)
);
INSERT INTO user_group (name) VALUES ('admin'), ('user');


CREATE TABLE IF NOT EXISTS users (
    ID INT AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    passwd VARCHAR(20) NOT NULL,
    groupID INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (groupID) REFERENCES user_group (ID)
);

INSERT INTO users (name, passwd, groupID) VALUES 
('admin', '1234', 1), ('root', 'root', 1),
('user', '1234', 2), ('user1', 'user', 2), ('user2', 'user', 2);



CREATE TABLE IF NOT EXISTS pdf_files (
  ID INT AUTO_INCREMENT,
  name TEXT NOT NULL,
  type TEXT NOT NULL,
  size INT NOT NULL,
  data longblob NOT NULL,
  PRIMARY KEY (ID)
);


CREATE TABLE IF NOT EXISTS cities (
  ID INT AUTO_INCREMENT,
  name TEXT NOT NULL,
  postcode VARCHAR(6) not null,
  number int not null,
  mayor text not null,
  country text not null,
  PRIMARY KEY(ID)
);

CREATE TABLE IF NOT EXISTS graphs (
  ID int AUTO_INCREMENT,
  name text not null,
  path text not null,
  PRIMARY key(ID)
);