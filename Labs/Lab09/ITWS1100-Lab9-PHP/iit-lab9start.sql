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
   (4, "The Lord of the Rings: The Fellowship of the Ring", "2001"),
   (5, "Up in the Air", "2009");

CREATE TABLE `actors` (
   `id` INT AUTO_INCREMENT,
   `firstNames` varchar(100) NOT NULL,
   `lastName` varchar(100) NOT NULL,
   `birth_year` INT DEFAULT NULL,
   PRIMARY KEY (`id`)
);

INSERT INTO actors
VALUES (1, "Cate", "Blanchett", 1969),
   (2, "Scarlett", "Johansson", 1984),
   (3, "George", "Clooney", 1961),
   (4, "Elijah", "Wood", 1981),
   (5, "Jeff", "Bridges", 1949);

CREATE TABLE `movie_actors` (
   `movie_id` INT NOT NULL,
   `actor_id` INT NOT NULL,
   PRIMARY KEY (`movie_id`, `actor_id`),
   FOREIGN KEY (`movie_id`) REFERENCES `movies`(`movieid`),
   FOREIGN KEY (`actor_id`) REFERENCES `actors`(`id`)
);

INSERT INTO movie_actors VALUES
   (1, 1),
   (2, 2),
   (3, 3),
   (4, 4),
   (5, 5);
