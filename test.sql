# Host: localhost  (Version 5.5.5-10.4.27-MariaDB)
# Date: 2023-09-07 01:42:33
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "estudiantes"
#

DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE `estudiantes` (
  `idEstudiante` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `primerApellido` varchar(255) DEFAULT NULL,
  `segundoApellido` varchar(255) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEstudiante`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

#
# Data for table "estudiantes"
#

INSERT INTO `estudiantes` VALUES (1,'Roberto','Aramayo','Colque',61),(2,'Augusto','Perez','Bustamante',80),(3,'Julio','Quispe','Contreras',90),(4,'Eliana','Carbajal','Arroyo',61),(5,'Erika','Bustamante','Carrillo',45);
