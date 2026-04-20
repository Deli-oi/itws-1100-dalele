-- create the tables for our movies
CREATE TABLE `movies` (
   `movieid` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `title` varchar(100) NOT NULL,
   `year` char(4) DEFAULT NULL,
   PRIMARY KEY (`movieid`)
);
-- insert data into the tables
INSERT INTO movies
VALUES (1, "Elizabeth", "1998"),
   (2, "Black Widow", "2021"),
   (3, "Oh Brother Where Art Thou?", "2000"),
   (
      4,
      "The Lord of the Rings: The Fellowship of the Ring",
      "2001"
   ),
   (5, "Up in the Air", "2009");

CREATE TABLE 'actors' (
    id INT AUTO_INCREMENT PRIMARY KEY,
   `firstNames` varchar(100) NOT NULL,
   `lastName` varchar(100) NOT NULL,
   'dob' date DEFAULT NULL,
   PRIMARY KEY (`actorid`)
)
INSERT INTO actors
VALUES (1, "Cate", "Blanchett", "1969-05-14"),
   (2, "Scarlett", "Johansson", "1984-11-22"),
   (3, "George", "Clooney", "1961-05-06"),
   (4, "Elijah", "Wood", "1981-01-28"),
   (5, "George", "Clooney", "1961-05-06");