SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE DATABASE OwnQuiz
DEFAULT CHARACTER SET utf8
COLLATE utf8_unicode_ci;

USE OwnQuiz;

CREATE TABLE questions (
   id int AUTO_INCREMENT, PRIMARY KEY (id),
   frage varchar(50) NOT NULL,
   antwort1 varchar(50) NOT NULL,
   antwort2 varchar(50) NOT NULL,
   antwort3 varchar(50) NOT NULL,
   antwort4 varchar(50) NOT NULL,
   richtig enum('1', '2', '3', '4') NOT NULL);

CREATE TABLE games (
   id int AUTO_INCREMENT, PRIMARY KEY (id),
   name varchar(50) NOT NULL,
   antworten int,
   hoechst int);

INSERT INTO games (name, antworten, hoechst) VALUES
('Ralf','3', '1'),
('John Doe', '1', '10'),
('Hurz','23', '100');

INSERT INTO questions (frage, antwort1, antwort2, antwort3, antwort4, richtig) VALUES
('Wie viele Einwohner hat Darmstadt (Stand 2017)?', '155.000', '205.000', '75.000', '10', '1'),
('Was bedeutet das html-Tag <td>?', 'test data', 'test dummy', 'table data', 'table doof', '3'),
('Wie viele Einwohner hat Mainz (Stand 2017)?', '155.000', '210.000', '295.000', '200', '2');
