DROP DATABASE final_proj;
CREATE DATABASE final_proj;

USE final_proj;

CREATE TABLE IF NOT EXISTS cust_table(
  id INT UNIQUE NOT NULL,
  email VARCHAR(50) PRIMARY KEY,
  fname VARCHAR (50) NOT NULL,
  lname VARCHAR (50) NOT NULL,
  epwd VARCHAR (255) NOT NULL
);

CREATE TABLE IF NOT EXISTS admin_table(
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    uname VARCHAR(10) UNIQUE NOT NULL ,
    pwd VARCHAR (250) DEFAULT '$2y$10$W4Gk43AzjVw/8gGDdq387e.hgpwGYRcBR.u9haEYUEkqhyTqihO8i' NOT NULL,
    prof_image LONGBLOB DEFAULT NULL
);
ALTER TABLE admin_table AUTO_INCREMENT=100;

CREATE TABLE IF NOT EXISTS slot_table(
    date DATE NOT NULL,
    open_time TIME NOT NULL,
    close_time TIME  NOT NULL,
    time_interval INT DEFAULT 10 NOT NULL,
    allowed_interval INT DEFAULT 15 NOT NULL,
    slots JSON,
    description VARCHAR(255) DEFAULT NULL
);

