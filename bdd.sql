DROP TABLE IF EXISTS `art-category`, `article`, `author`;

CREATE TABLE `art-category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255)L,
  `email` varchar(255),
  `phone` varchar(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `thumbnail_url` varchar(255),
  `id_category` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `art-category` (`id`),
  CONSTRAINT `article_ibfk_2` FOREIGN KEY (`id_author`) REFERENCES `author` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `art-category` (`id`, `name`, `description`)
VALUES
    (1,'Université',"Articles en rapport avec l\'université","#2372b9"),
    (2,'Vie étudiante','Articles en rapport avec la vie étudiante',"#2ecc71"),
    (3,'Vie associative','Articles en rapport avec la vie associative',"#e67e22"),
    (4,'Vie culturelle','Articles en rapport avec la vie culturelle',"#9b59b6"),
    (5,'Vie sportive','Articles en rapport avec la vie sportive',"#e74c3c"),
    (6,'Politique','Articles en rapport avec la politique universitaire',"#f1c40f"),
    (7,'Résidences', "Articles en rapport avec les résidences étudiantes","#3498db"),
    (8,'Recherche','Articles en rapport avec la recherche universitaire',"#1abc9c"),
    (9,'Autres','Autres articles',"#95a5a6");

INSERT INTO `article` (`id`, `title`, `content`, `date`, `thumbnail_url`, `id_category`)
VALUES
    (1,'Article 1','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl eget aliquam ultricies, nunc nisl aliquet nunc, eget aliquam nisl","2016-01-01 00:00:00',NULL,1),
    (2,'Article 2','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl eget aliquam ultricies, nunc nisl aliquet nunc, eget aliquam nisl","2016-01-01 00:00:00',NULL,2),
    (3,'Article 3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl eget aliquam ultricies, nunc nisl aliquet nunc, eget aliquam nisl","2016-01-01 00:00:00',NULL,3);