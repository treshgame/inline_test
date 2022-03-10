CREATE DATABASE IF NOT EXISTS testDB;
CREATE TABLE IF NOT EXISTS comments (
    id int AUTO_INCREMENT,
    postId int NOT NULL,
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    body text NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS posts (
    id int AUTO_INCREMENT,
    userId int NOT NULL,
    title  varchar(255) NOT NULL,
    body text NOT NULL,
    PRIMARY KEY (id)
);