CREATE DATABASE IF NOT EXISTS cod_db;
USE cod_db;

CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    harga INT NOT NULL
);

CREATE TABLE pembeli (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nomor_hp VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL
);

CREATE TABLE kurir (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nomor_hp VARCHAR(20) NOT NULL
);

INSERT INTO barang (nama, harga) VALUES
('Gergaji', 75000), ('Pulpen', 3000), ('Laptop', 7500000);

INSERT INTO pembeli (nama, nomor_hp, alamat) VALUES
('Muflih', '081234567801', 'Purwokerto'),
('Romi', '081234567802', 'Banyumas'),
('Anin', '081234567803', 'Purbalingga');

INSERT INTO kurir (nama, nomor_hp) VALUES
('Althaaf', '082111111101'),
('Irsyad', '082111111102'),
('Ilhan', '082111111103');
