CREATE DATABASE cvm;
USE cvm;

CREATE TABLE data (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  text varchar(255)
);

CREATE TABLE person (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  nama varchar(255),
  alamat text,
  tanggal varchar(10),
  kelamin enum('L','P'),
  photo varchar(255)
);

CREATE TABLE users (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  username varchar(25),
  password varchar(32),
  role enum('default','admin','owner') DEFAULT 'default'
);