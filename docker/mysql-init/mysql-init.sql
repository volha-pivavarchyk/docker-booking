-- # create databases
CREATE DATABASE IF NOT EXISTS `db`;

-- # create db user and grant rights
CREATE USER IF NOT EXISTS 'db'@'%' IDENTIFIED BY 'db';
CREATE USER IF NOT EXISTS 'db'@'localhost' IDENTIFIED BY 'db';
GRANT ALL PRIVILEGES ON db.* TO 'db'@'%';
GRANT ALL PRIVILEGES ON db.* TO 'db'@'localhost';