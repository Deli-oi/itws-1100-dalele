-- Quiz3: Flower Facts Quiz
-- Run this against the iitF23 database in phpMyAdmin

CREATE TABLE `quiz3_questions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` VARCHAR(255) NOT NULL,
  `correct_answer` VARCHAR(255) NOT NULL,
  `wrong1` VARCHAR(255) NOT NULL,
  `wrong2` VARCHAR(255) NOT NULL,
  `wrong3` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `quiz3_scores` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `player_name` VARCHAR(100) NOT NULL,
  `score` INT NOT NULL,
  `total` INT NOT NULL,
  `played_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `quiz3_questions` (question, correct_answer, wrong1, wrong2, wrong3) VALUES
('What is the world\'s largest flower by individual bloom size?', 'Rafflesia arnoldii', 'Titan Arum', 'Giant Water Lily', 'Bird of Paradise'),
('Which flower is harvested to make saffron, the world\'s most expensive spice?', 'Saffron Crocus', 'Marigold', 'Lotus', 'Chrysanthemum'),
('What is the national flower of India?', 'Lotus', 'Marigold', 'Jasmine', 'Rose'),
('Young sunflowers track the movement of the sun. This behavior is called:', 'Heliotropism', 'Photosynthesis', 'Geotropism', 'Osmosis'),
('Which part of the flower produces pollen?', 'Anther', 'Stigma', 'Sepal', 'Ovary'),
('What part of the flower receives pollen during pollination?', 'Stigma', 'Anther', 'Petal', 'Sepal'),
('Which flower famously caused "Tulip Mania," an economic bubble in 1630s Netherlands?', 'Tulip', 'Daffodil', 'Iris', 'Lily'),
('What color rose traditionally symbolizes friendship?', 'Yellow', 'Pink', 'White', 'Orange'),
('Which plant family has the most species, making it one of the largest on Earth?', 'Orchid family (Orchidaceae)', 'Rose family (Rosaceae)', 'Daisy family (Asteraceae)', 'Lily family (Liliaceae)'),
('What sweet substance do flowers produce to attract pollinators like bees?', 'Nectar', 'Sap', 'Resin', 'Honey'),
('Which flower is worn as a symbol of remembrance on Veterans Day?', 'Red Poppy', 'White Lily', 'Red Rose', 'Yellow Daffodil'),
('Which flower is celebrated each spring in festivals across Japan?', 'Cherry Blossom (Sakura)', 'Plum Blossom', 'Wisteria', 'Chrysanthemum'),
('How many petals does a standard tulip have?', '6', '4', '5', '8'),
('What is the Corpse Flower (Titan Arum) famous for?', 'Smelling like rotting flesh to attract pollinators', 'Only growing underwater', 'Having no leaves', 'Blooming every day'),
('Which flower\'s seeds are pressed to make a widely used cooking oil?', 'Sunflower', 'Daisy', 'Marigold', 'Chrysanthemum');
