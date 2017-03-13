CREATE DATABASE IF NOT EXISTS potatoes;

USE potatoes;

DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users(
    username VARCHAR(45) PRIMARY KEY NOT NULL,
    password VARCHAR(45) NOT NULL,
    firstname VARCHAR(45),
    lastname VARCHAR(45),
    emailaddress VARCHAR(200)
);

INSERT INTO users(
    username, password)VALUES(
    'daniel', 'password'
);