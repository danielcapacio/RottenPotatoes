CREATE DATABASE IF NOT EXISTS potatoes;

USE potatoes;

DROP TABLE IF EXISTS reviews;

CREATE TABLE IF NOT EXISTS reviews(
    id INT(100) PRIMARY KEY AUTO_INCREMENT,
    movie VARCHAR(45) NOT NULL,
    username VARCHAR(45) REFERENCES users(username),
    comments VARCHAR(2000) NOT NULL,
    food VARCHAR(10),
    rating CHAR(1) NOT NULL
);

/*
INSERT INTO reviews(
    username, movie, comments, food, rating)VALUES(
    'daniel',
    'The Bourne Identity',
    'Paul Greengrass and his star have upped the tech and chucked in references to Snowden, but it is basic Bourne that remains most persuasive.',
    'Hotdog',
    '1'
);
*/
