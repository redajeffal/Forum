-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Création :  jeudi 04 Octobre 2018
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `sujets`
--

CREATE TABLE IF NOT EXISTS `sujets` (
    `idSujet`       int(10) unsigned NOT NULL AUTO_INCREMENT,
    `titre`         varchar(250) NOT NULL,
    `texte`         text NOT NULL,
    `dateCreation`  datetime NOT NULL,
    `User`          varchar(30) NOT NULL,
    PRIMARY KEY  (`idSujet`),
    KEY `User` (`User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `sujets`
--

INSERT INTO `sujets` (`idSujet`, `titre`, `texte`, `dateCreation`, `User`) VALUES
(1, 
 "Javascript - aide afficher/masquer des champs de formulaire", 
 "Je bloque sur une fonctionnalité plutôt basique que je n\'arrive pas à faire fonctionner : j\'ai un formulaire html qui propose de laisser ses coordonnées grâce à un choix par boutons radio Je n\'arrive pas à masquer les champs quand on clique sur NON et à les faire apparaître quand on clique sur OUI.", 
 "2018-10-01 10:12:24", 
 "sylvainp61"),

(2, 
 "installation easy 12 ok et rien à l\'écran", 
 "j\'ai installé 'Devserver 17' ...install ok ...pas de réaction !!! j\'ai installé 'easyPHP 12.1' ...instal ok ...pas de réaction !!!  rien ne s\'affiche !!!", 
 "2018-09-25 21:34:17", 
 "redaj82"),

(3, 
 "Tutoriel pour apprendre le langage Java en vidéo", 
 "Un nouveau tutoriel pour apprendre la programmation Java en vidéo vous est proposé à l\'adresse suivante : http://koor.developpez.com/tutoriels...re_java_video/",
 "2018-09-12 13:56:41", 
 "sylvainp61"),

(4, 
 "Comment gérer 2 projets ?", 
 "Je m\'occupe de 2 clubs de plongées. Globalement, ils ont les mêmes fonctionnalités et bien sûr quelques spécificités. Ils ne sont pas sur la même base (2 fournisseurs d\'accès différents). Comment puis-je faire, en local, pour avoir les mêmes sources mais 2 projets différents ?", 
 "2018-09-26 12:34:28", 
 "marieob80"),

(5, 
 "lorem ipsum", 
 "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here", 
 "2018-10-04 12:35:43", 
 "dianec56");

-- --------------------------------------------------------


--
-- Structure de la table `reponses`
--

CREATE TABLE IF NOT EXISTS `reponses` (
    `idReponse`     int(10) unsigned NOT NULL AUTO_INCREMENT,
    `titre`         varchar(250) NOT NULL,   
    `texte`         text NOT NULL,
    `dateCreation`  datetime NOT NULL,
    `User`          varchar(30) NOT NULL,
    `idSujet`       int(10) unsigned NOT NULL,
  
    PRIMARY KEY (`idReponse`),
    KEY `User` (`User`),
    KEY `idSujet` (`idSujet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
/*   en référence à l'exercice MVC  filmsDB.sql, comment déterminer */
/*	 le AUTO_INCREMENT dans le CREATE s'appliquant à la table ??    */

--
-- Contenu de la table `reponses`
--

INSERT INTO `reponses` (`idReponse`, `titre`,`texte`, `dateCreation`, `User`, `idSujet`) VALUES
(1, 
 "Javascript - aide afficher/masquer des champs de formulaire", 
 "C\'est un exercice assez facile normalement. Le plus simple est de détecter le onchange sur les radio",
 "2018-10-01 11:02:26", 
 "redaj82", 
 1),
(2, 
 "Javascript - aide afficher/masquer des champs de formulaire", 
 "Ca serait a peine plus subtil.Deja il faudrait définir les champs obligatoires avec un attribut data-obligatoire='Y' ex : <div class='champ' data-obligatoire='Y'>champ input</div> Ensuite la fonction showDiv() est a peine plus complexe", 
 "2017-10-05 23:01:35", 
 "marieob80", 
 1),
(3, 
 "Tutoriel pour apprendre le langage Java en vidéo", "Trois nouvelles vidéos ont été ajoutées ; elles traitent de : 
VI.F Aspects avancés sur la définition d\'interfaces Java
VII.A Introduction au mécanisme d\'exceptions en Java
VII.B Mise en œuvre d\'une classe d\'exception", 
 "2018-10-01 11:12:03", 
 "redaj82", 
 3),
(4, 
 "Tutoriel pour apprendre le langage Java en vidéo", 
 "Je viens de suivre la video I.A pour l\'installation de la JDK (j\'avais déjà installé openjdk 1.8 sur mon Linux Ubuntu) et Eclipse (que je n\'avais pas installé, ayant DRJava à la place) : c\'est très clair, très pédagogique. J\'ai installé eclipse du coup pour pouvoir suivre les cours suivants. Cette video est parfaite à mon avis.",
 "2018-10-02 08:31:10", 
 "michelp57", 
 3),
(5,
 "Comment gérer 2 projets ?", 
 "Vous pouvez faire un fichier configuration.php avec les différences entre les 2 sites. Comme ça, quand vous mettez les modifications en ligne, vous envoyez tous sauf ce fichier.",
 "2018-09-27 19:38:55",
 "dianec56", 
 4),
(6, 
 "Comment gérer 2 projets ?", 
 "je pense que je me suis mal expliqué. Sur mon serveur local, comment faire pour tester le club 1 et le club 2 à partir des mêmes sources mais sur 2 URL différentes", 
 "2018-09-28 09:38:55", 
 "marieob80", 
 4),
(7, 
 "Comment gérer 2 projets ?", 
 "essayez peut-être de définir 2 domaines manuellement dans le fichier hosts comme expliqué là : https://www.wistee.fr/configuration-...ier-hosts.html
Ensuite dans le code, vous testez le nom de domaine qui peut être 'local1' ou 'local2'en local et 'www.club1.fr' et 'club2.com' pour les sites en lignes",
 "2018-09-28 14:18:25",
 "dianec56",
 4);
-- --------------------------------------------------------

--
-- Structure de la table `usagers`
--

CREATE TABLE IF NOT EXISTS `usagers` (
    `username`  varchar(30) NOT NULL,
    `nom`       varchar(30) NOT NULL,
    `prenom`    varchar(30) NOT NULL,
    `password`  varchar(30) NOT NULL,
    `admin`     tinyint(1)  NOT NULL,
    `banni`     tinyint(1)  NOT NULL,
    PRIMARY KEY (`username`),
    UNIQUE (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `usagers`
--

INSERT INTO `usagers` (`username`, `nom`, `prenom`, `password`, `admin`, `banni`) VALUES
('sylvainp61', 'Pelletier', 'Sylvain', '123456', 1, 0),
('marieob80', 'Blanchette', 'Marie-Ôde', '123456', 0, 1),
('redaj82', 'Jeffal', 'Reda', '123456', 0, 0),
('michelp57', 'Pelletier', 'Michel', '123456', 0, 0),
('dianec56', 'Clement', 'Diane', '123456', 0, 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
    ADD CONSTRAINT `reponses_ibfk_1` FOREIGN KEY (`User`) REFERENCES `usagers` (`username`),
    ADD CONSTRAINT `reponses_ibfk_2` FOREIGN KEY (`idSujet`) REFERENCES `sujets` (`idSujet`);

--
-- Contraintes pour la table `sujets`
--
ALTER TABLE `sujets`
    ADD CONSTRAINT `sujets_ibfk_1` FOREIGN KEY (`User`) REFERENCES `usagers` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
