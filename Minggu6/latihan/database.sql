CREATE DATABASE modul_latihan;
USE modul_latihan;

CREATE TABLE `posts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `judul` VARCHAR(100) NOT NULL,
  `konten` VARCHAR(1000) NOT NULL,
  PRIMARY KEY (`id`)
);