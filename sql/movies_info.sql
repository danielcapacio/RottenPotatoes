CREATE DATABASE IF NOT EXISTS potatoes;

USE potatoes;

DROP TABLE IF EXISTS movies_info;

CREATE TABLE IF NOT EXISTS movies_info(
    movie VARCHAR(100) PRIMARY KEY NOT NULL,
    movie_year CHAR(4) NOT NULL,
    director VARCHAR(100) NOT NULL
);
