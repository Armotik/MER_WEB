DROP TABLE IF EXISTS `art-category`;

CREATE TABLE `art-category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `art-category` (`id`, `name`, `description`)
VALUES
    (1,'Université',"Articles en rapport avec l\'université"),
    (2,'Vie étudiante','Articles en rapport avec la vie étudiante'),
    (3,'Vie associative','Articles en rapport avec la vie associative'),
    (4,'Vie culturelle','Articles en rapport avec la vie culturelle'),
    (5,'Vie sportive','Articles en rapport avec la vie sportive'),
    (6,'Politique','Articles en rapport avec la politique universitaire'),
    (7,'Résidences', "Articles en rapport avec les résidences étudiantes"),
    (8,'Autres','Autres articles');