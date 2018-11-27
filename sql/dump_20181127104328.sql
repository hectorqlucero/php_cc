-- Chrome MySQL Admin version 4.6.4
--
-- Host: localhost
-- ------------------------------------------------------
-- Server version 5.7.24-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `cc`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `cc` /*!40100 DEFAULT CHARACTER SET utf8 */;

use `cc`;

--
-- Table structure for table `cartas`
--

DROP TABLE IF EXISTS `cartas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` char(1) DEFAULT NULL COMMENT 'A=Abierta,N=Novatos',
  `sexo` char(1) DEFAULT NULL COMMENT 'V=Varonil,F=Femenil',
  `bicicleta` char(1) DEFAULT NULL COMMENT 'F=Fija,S=SS,O=Otra',
  `no_participacion` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido_paterno` varchar(100) DEFAULT NULL,
  `apellido_materno` varchar(100) DEFAULT NULL,
  `equipo` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tutor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartas`
--

LOCK TABLES `cartas` WRITE;
/*!40000 ALTER TABLE `cartas` DISABLE KEYS */;
INSERT INTO `cartas` VALUES (1,'A','M','O','101','Hector','Lucero','Quihuis','Rositas','271 Islas Salmon Colonia Santa Monica','Mexico','Mexicali',NULL,'(686) 136-2245','hectorqlucero@gmail.com',NULL),(2,'A','M','O','200','MARCO','Pescador','Martinez','Road Runner','AV. COAHUILA 1197 FRACC. GUAJARDO','México','MEXICALI','(016) 861-6679','(686) 166-7959','marcopescador@hotmail.com',NULL),(3,'N','M','S','05','Victor Manuel','Ayala','Carballo','Aerobikers','Jesús torres Burciaga 2092 Fovissste','México','Mexicali','(686) 251-3101','(686) 194-5505','adrenalinesportnews@gmail.com',NULL);
/*!40000 ALTER TABLE `cartas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuadrantes`
--

DROP TABLE IF EXISTS `cuadrantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuadrantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `leader` varchar(100) DEFAULT NULL,
  `leader_phone` varchar(45) DEFAULT NULL,
  `leader_cell` varchar(45) DEFAULT NULL,
  `leader_email` varchar(100) DEFAULT NULL,
  `notes` text,
  `status` char(1) DEFAULT NULL COMMENT 'T=Active,F=Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuadrantes`
--

LOCK TABLES `cuadrantes` WRITE;
/*!40000 ALTER TABLE `cuadrantes` DISABLE KEYS */;
INSERT INTO `cuadrantes` VALUES (1,'Rositas','Rossy Rutiaga',NULL,NULL,'rossyrutiaga@rositas.com','Cuadrante ciclista con todos los niveles para el gusto del ciclista.','T'),(2,'Azules','Ana Villa',NULL,NULL,'anavilla@azules.com','Cuadrante ciclista con niveles inter y fast.','T'),(3,'Grupo Ciclista La Vid','Marco Romero',NULL,NULL,'mromeropmx@hotmail.com','Un grupo cristiano con deseos de mejorar nuestra salud...','T'),(4,'Reto Demoledor','Reto',NULL,NULL,'retodemoledor@server.com','Para mas información entra al grupo Reto Demoledor','T'),(5,'Reto Aerobiker','retoaerobiker',NULL,NULL,'retoaerobiker@server.com','Reto madrugador 5x5 mas detalles en Aerobikers (FB)','T'),(6,'Blanco','blancolider',NULL,NULL,'blancolider@server.com','','T'),(7,'Bicios@s','biciosolider',NULL,NULL,'biciosolider@server.com','','T'),(8,'AeroGreens','aerogreens',NULL,NULL,'aerogreens@server.com','','T'),(9,'Akalambrados','Frank',NULL,NULL,'frank@akalambrados.com','','T'),(10,'V-Light','vlight',NULL,NULL,'vlight@server.com','','T'),(11,'Aferreitorxs','aferreitorxslider',NULL,NULL,'aferreitorxs@server.com','','T'),(12,'Mujeres al Pedal','mujeres',NULL,NULL,'mujeres@server.com','','T'),(13,'Raptors','raptors',NULL,NULL,'raptors@server.com','','T'),(14,'Victorianos','victorianos',NULL,NULL,'victorianos@server.com','','T'),(15,'I. V. Cycling (Inter)','ivcycling',NULL,NULL,'ivcycling@server.com','','T'),(16,'NONSTOP','nonstop',NULL,NULL,'nonstop@server.com','','T');
/*!40000 ALTER TABLE `cuadrantes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rodadas`
--

DROP TABLE IF EXISTS `rodadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rodadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion_corta` varchar(100) DEFAULT NULL,
  `descripcion` varchar(3000) DEFAULT NULL,
  `punto_reunion` varchar(1000) DEFAULT NULL,
  `nivel` char(1) DEFAULT NULL COMMENT 'P=Principiantes,M=Medio,A=Avanzado,T=Todos',
  `distancia` varchar(100) DEFAULT NULL,
  `velocidad` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `leader` varchar(100) DEFAULT NULL,
  `leader_email` varchar(100) DEFAULT NULL,
  `cuadrante` int(11) DEFAULT NULL,
  `repetir` char(1) DEFAULT NULL COMMENT 'T=Si,F=No',
  `anonimo` char(1) DEFAULT 'F' COMMENT 'T=Si,F=No',
  `rodada` char(1) DEFAULT 'T' COMMENT 'T=Si,F=No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rodadas`
--

LOCK TABLES `rodadas` WRITE;
/*!40000 ALTER TABLE `rodadas` DISABLE KEYS */;
INSERT INTO `rodadas` VALUES (1,'Rositas - San Lunes','Ruta que puede variar por las calles de la ciudad. Se rodaran por lo menos 20 kilometros.  No olvidar traer casco, luces, auga y un tubo de repuesto.','Parque Hidalgo','P','20/28 Km','18-25Km/hr','2018-12-03','20:00:00','Hector Lucero','hectorqlucero@gmail.com',1,'T','F','T'),(2,'Rositas -Santa Isbl','Salimos del Parque Hidalgo hacia la Santa Isabel.  Hidratacion en la OXXO que esta en la Lazaro Cardenas.  No olividen traer casco, luces, agua y un tubo de repuesto.','Parque Hidalgo','T','30 Km','Lights: 18-25Km/hr  Intermedios: 25-35Km/hr','2018-11-27','20:00:00','Ruth','hectorqlucero@gmail.com',1,'T','F','T'),(3,'Rositas - Canalera','Salimos por el canal de la Independencia a veces hasta el aeropuerto.  No olviden traer casco, luces, agua y un tubo de repuesto.','Parque Hidalgo','M','30/50Km','25-35Km/hr','2018-12-03','20:00:00','Humberto','hectorqlucero@gmail.com',1,'T','F','T'),(4,'Rositas - Adorada','Ruta que puede variar entre el Campestre y el Panteon rumbo al aeropuerto.  No olviden traer casco, luces, agua y un tubo de repuesto.','Parque Hidalgo','P','20/28 Km','18-25Km/hr','2018-11-28','20:00:00','Martha Parada','hectorqlucero@gmail.com',1,'T','F','T'),(6,'Rositas - Circuito O','Hoy toca Circuito Ciclista Obregón los esperamos a las 8:00 PM en el punto de Reunión de Rectoría de la UABC/Biblioteca del Estado. El circuito tiene una longuitud de 3.2 Kilómetros con muy buena iluminado y el formato que se manejara para rodar será de las primeras 9 vueltas serán controladas a 30 kilómetros por hora como máximo y después se comenzara a aumentar la velocidad. Los ciclistas que lleguen más tarde se pueden acoplar al grupo o grupos. Así que a rodar con precaución y llevar sus luces si cuentan con ellas para iluminar esa mancha ciclista por toda la Av. Obregón, A Darle….','Rectoría de la UABC/Biblioteca del Estado','T','20/50 Km','10-40Km/hr','2018-11-28','20:00:00','Melissa Utsler','hectorqlucero@gmail.com',1,'T','F','T'),(7,'Rositas - Culinaria','Salimos del parque Hidalgo hacia el panteon que esta rumbo al aeropuerto. No olviden traer casco, luces, agua y un tubo de repuesto.','Parque Hidalgo','P','20/28 Km','18-25Km/hr','2018-11-29','20:00:00','Chefsito','hectorqlucero@gmail.com',1,'T','F','T'),(8,'Rositas - Intermedia','Salimos del parque Hidalgo hacia el hotel que esta despues del OXXO.  No olviden traer casco, luces, agua y un tubo de repuesto.','Parque Hidalgo','M','30 Km','25-35 km/hr','2018-11-29','20:00:00','Humberto','hectorqlucero@gmail.com',1,'T','F','T'),(9,'Rositas - Pedacera','Salimos del parque Hidalgo hacia el aeropuerto.  No olviden traer casco, luces, agua y un tubo de repuesto.','Parque Hidalgo','A','50-60 Km','30-40Km/hr','2018-11-29','20:00:00','Oscar Raul','hectorqlucero@gmail.com',1,'T','F','T'),(10,'Rositas - Familiar','Salimos del Parque Hidalgo con ruta indefinida.  No olviden traer casco, luces, agua y un tubo de repuesto.','Parque Hidalgo','P','20/28 Km','18-25Km/hr','2018-11-30','20:00:00','Jose el Pechocho','hectorqlucero@gmail.com',1,'T','F','T'),(21,'Azules - Lunes','Principiantes e intermedios.  No olviden traer casco, luces, agua y tubo de repuesto.','Soriana Anahuac','T','20/28 Km','20-32 k/hr','2018-12-03','20:00:00','Mauricio Zavala','hectorqlucero@gmail.com',2,'T','F','T'),(22,'Azules - Miercoles','Rodada para principiantes e intermedios. No olviden traer casco, luces, agua y un tubo de repuesto.','Soriana Anahuac','T','20/35 Km','20-35 K/hr','2018-11-28','20:00:00','Mauricio Zavala','hectorqlucero@gmail.com',2,'T','F','T'),(23,'Azules - Jueves','Rodada de final feliz. No olviden traer casco, luces, agua y tubo de repuesto.','Soriana Anahuac','T','20/30 Km','25-35 K/hr','2018-11-29','20:00:00','Mauricio Zavala','hectorqlucero@gmail.com',2,'T','F','T'),(24,'Akalambrados - M','Akas nos vemos hoy!! RODADA LIGHT rumbo al Aeropuerto. Mucho animo para contagiar a los nuevos integrantes!!! Quien guste unirse bienvenido.  No olviden traer casco, luces, agua y un tubo de repuesto.','VIP novena','P','30/50 Km','20-25 K/hr','2018-11-27','19:30:00','Frank Vazquez','hectorqlucero@gmail.com',9,'T','F','T'),(25,'Akalambrados - J','Ruta que puede variar.  No olviden traer casco, luces, agua y un tubo de repuesto.','VIP Novena','M','30/50 Km','20-28 K/hr','2018-11-29','19:30:00','Frank Vazquez','hectorqlucero@gmail.com',9,'T','F','T'),(26,'Akalambrados - L','Rodada que puede variar. No olviden traer casco, luces, agua y un tubo de repuesto.','VIP Novena','M','30/50 Km','25-30 K/hr','2018-12-03','19:30:00','Frank Vazquez','hectorqlucero@gmail.com',9,'T','F','T'),(27,'Akalambrados - Mie','La ruta puede variar.  No olviden traer casco, luces, agua y un tubo de repuesto.','VIP Novena','T','30/50 Km','25-30 K/hr','2018-11-28','19:30:00','Frank Vazquez','hectorqlucero@gmail.com',9,'T','F','T'),(29,'Circuito Navideño','El club de Road Runner de Mexicali en conjunto con INSTITUTO MUNICIPAL DEL DEPORTE y la CULTURA FÍSICA (IMDECUF) y con apoyo de los grupos ciclistas LA PEDACERA/PINK RAPTOR, MBC ACME y Cuadrante Rosita invitan a los ciclistas de la región y ciudades vecinas a participar en este evento ciclista denominado, "Circuito Ciclista Navideño Obregón".\nCircuito recientemente pavimentado en su totalidad y ademas estara totalmente cerrado con todos sus accesos para seguiridad de todos los ciclistas.  El circuito tiene una Longitud de 3.5 Km. Se darán 11 vueltas a paso controlado y 6 vueltas abierto el ritmo de velocidad. Verbena popular al finalizar el Evento...\nLos boletos tienen un costo de $150 pesos. Los boletos contaran con ship para checar nuestros tiempos al final del paseo.\nPlacas primero, segundo y tercer lugar de cada categoria\nPrimer Lugar: $1500 pesos\nSegundo Lugar: $1000 pesos\nTercer Lugar: $500 pesos\nVaronil, Femenil, Abierta','Avenida General Álvaro Obregón, Segunda Sección, 21100 Mexicali, BC, México','T','59.5 Km','25-45 K/hr','2018-12-02','09:00:00','Marco Antonio Pescador','hectorqlucero@gmail.com',1,'F','F','T'),(30,'Azules - 6TO Paseo C','100 KM Por Mexicali\n6TO PASEO CICLISTIA\nLa velocidad sera de 25-30 para manejar el grupo lo mas compacto posible, tendremos descansos cada 20 km.. Nos acompañara DSPM animo y cerremos el año rodando por nuestro Mexicali.','Comandancia de policia (Terán Terán)','T','100 Kilometros','25-30 K/hr','2018-12-15','08:00:00','Ana Villa','hectorqlucero@gmail.com',2,'F','F','T'),(32,'Rumorosa 3ra Edicion','La Rumorosa PracticeRide 3ra Edicion\nLa Cuesta Parador Turístico: http://blt.ly/2LaCuestaPradorTuristico, Tecate','La Cuesta Parador Turistico',NULL,NULL,NULL,'2019-04-21','09:00:00','Melissa Utsler','hectorqlucero@gmail.com',NULL,'F','F','F'),(34,'6to DesTamaleada','Están cordialmente invitados a nuestra primera rodada del año 2019, vamos a estirar las piernas después de estas fiestas Decembrinas con un pequeño paseo de 40km.\nPUNTO DE REUNION COFFEE BIKE SHOP * ROSARIO\n6to Paseo Anual DesTamaleada 2019\n* Domingo 6 de Enero\n* Salida 9 de la mañana (Carretera Libre y Km 32)\n* Rosarito * Medio Camino\n* Todos los niveles\n* Bici de Ruta - Hibrida - Montaña - Cartero o Panadera\n* Autosuficiente (Tu eres responsable por tu propia seguridad)\n* Punto de Hidratacion en Medio Camino\n* Evento familiar.\n* Asistencia mecanica gratuita\n* Evento gratuito\n* Boletos limitados\nEste evento es gratuito y todos son bienvenidos, asi mismo cada quien es RESPONSABLE POR SU PROPIA SEGURIDAD','COFFEE BIKE SHOP * ROSARITO',NULL,NULL,NULL,'2019-01-06','09:00:00','ROSARITO BIKE SHOP','hectorqlucero@gmail.com',NULL,'F','F','F'),(37,'Baja Bike Race','We are a 73 mile Granfondo | Race through the wine country of Baja California Mexico called the Valle de Guadalupe! All level of cyclist are invited to join but know there is a 6 hour cutoff time. For those racing, we do even split prize purse of $3000usd* and award all top 3 finishers in your age group a trophy mug!\n\nWe do alot of giveaways so be sure to FOLLOW US here as well:\n\nINSTAGRAM: www.instagram.com/bajabikerace\nTWITTER: www.twitter.com/bajabikerace\nFACEBOOK: www.facebook.com/bajabikerace\n\nWHAT''S INCLUDED IN MY ENTRY FEE:\n\nOfficial race shirt\nMedical /mechanical support\n5 aid stations\nCelebratory beer (18yrs+)\nFinisher medal\nLive track timing with facebook/twitter\nBeer mug for top 3 finishers in all age groups\nPost race fiesta\nFree secured (caged) bike parking\nSAG van\n\nSEE EVENT WEBSITE FOR MORE INFO: www.BajaBikeRace.com\n\n*Event details subject to change','Tecate B.C. Mexico',NULL,NULL,NULL,'2019-10-05','08:00:00','Baja Bike Race','hectorqlucero@gmail.com',NULL,'F','F','F'),(39,'Misa del Ciclista','Aquí en la misa del ciclista se repartirán los calendarios de la IMDECUF. Organizadores no falten es un día importante.','Rectoria Divina Providencia',NULL,NULL,NULL,'2019-01-13','09:00:00','todos los grupos','hectorqlucero@gmail.com',NULL,'F','T','F'),(40,'Rodada Familiar','Rodada Familiar Mujeres al pedal.','Rectoria UABC',NULL,NULL,NULL,'2019-01-13','08:00:00','Armida Velarde','hectorqlucero@gmail.com',NULL,'F','T','F'),(41,'Etapa Estatal','Etapa estatal de ciclismo','Pendiente',NULL,NULL,NULL,'2019-01-20','08:00:00','Road Runners','hectorqlucero@gmail.com',NULL,'F','T','F'),(42,'Circuito Malinda','Circuito Malinda','Gomez Morin Poniente',NULL,NULL,NULL,'2019-02-03','08:00:00','Luis Contreras','hectorqlucero@gmail.com',NULL,'F','T','F'),(43,'Rodada Mujeres/pedal','Rodada Mujeres al Pedal.','Rectoria UABC',NULL,NULL,NULL,'2019-02-10','08:00:00','Armida Velarde','hectorqlucero@gmail.com',NULL,'F','T','F'),(44,'Circuito Malinda','Circuito Malinda','Gomez Morin Poniente',NULL,NULL,NULL,'2019-03-03','07:00:00','Centinela','hectorqlucero@gmail.com',NULL,'F','T','F'),(45,'Paseo Masivo','Entrenamiento Paseo Masivo 108 Km.','COSTCO',NULL,NULL,NULL,'2019-02-24','07:00:00','Team Power V8','hectorqlucero@gmail.com',NULL,'F','T','F'),(46,'Carrera Team Power','Carrera ciclista Team Power.','KM 8 Carretera San Felipe',NULL,NULL,NULL,'2019-01-27','08:00:00','Team Power V8','hectorqlucero@gmail.com',NULL,'F','T','F'),(48,'Vuelta al Valle','Vuelta al Valle.  Evento organizado por IMDECUF.','Reforma y Calle K',NULL,NULL,NULL,'2019-03-24','07:00:00','IMDECUF','hectorqlucero@gmail.com',NULL,'F','T','F'),(49,'Mexicali-Algodones','Mexicali a Algodones y de regreso a Mexicali.','Carretera Aeropuerto',NULL,NULL,NULL,'2019-03-31','08:00:00','RoadRunners','marcopescador@hotmail.com',NULL,'F','T','F'),(50,'Circuito Obregon','Serial Circuito Obregon','Av. Obregon - Rectoria de la UABC',NULL,NULL,NULL,'2019-04-07','07:00:00','RoadRunners','marcopescador@hotmail.com',NULL,'F','T','F'),(51,'Rodada Vizcaya','Rodada Vizcaya en movimiento','Instalaciones del plantel',NULL,NULL,NULL,'2019-04-13','08:00:00','Univ. Vizcaya','hectorqlucero@gmail.com',NULL,'F','T','F'),(52,'Serial Malinda','Serial Malinda','Continuación Gomez Morin',NULL,NULL,NULL,'2019-04-28','08:00:00','Team Power V8','hectorqlucero@gmail.com',NULL,'F','T','F'),(53,'V8 Entrenamiento','Entrenamiento paseo v8','COSTCO',NULL,NULL,NULL,'2019-05-26','07:00:00','Team Power V8','hectorqlucero@gmail.com',NULL,'F','T','F'),(54,'Aniv. Prietos','Aniv Prietos Cycling','Jueventud 2000',NULL,NULL,NULL,'2019-06-09','07:00:00','Prietos Cycling','hectorqlucero@gmail.com',NULL,'F','T','F'),(55,'Paseo Masivo','Entrenamiento Paseo Masivo','COSTCO',NULL,NULL,NULL,'2019-06-30','07:00:00','Team Power V8','hectorqlucero@gmail.com',NULL,'F','T','F'),(56,'Paseo Masivo','Entrenamiento Paseo Masivo','COSTCO',NULL,NULL,NULL,'2019-07-28','07:00:00','Team Power V8','hectorqlucero@gmail.com',NULL,'F','T','F'),(57,'Paseo Masivo','Entrenamiento Paseo Masivo','COSTCO',NULL,NULL,NULL,'2019-08-25','07:00:00','Team Power V8','hectorqlucero@gmail.com',NULL,'F','T','F'),(58,'Paseo Masivo','Entrenamiento Paseo Masivo - 108 KM','COSTCO',NULL,NULL,NULL,'2019-09-29','07:00:00','Team Power V8','hectorqlucero@gmail.com',NULL,'F','T','F'),(59,'Mujeres al Pedal','Mujeres al pedal','Rectoria UABC',NULL,NULL,NULL,'2019-10-06','08:00:00','Mujeres al pedal','hectorqlucero@gmail.com',NULL,'F','T','F'),(60,'Rodada Con Sentido','Rodada Con Sentido','Reforma y Calle K',NULL,NULL,NULL,'2019-10-13','07:00:00','Raptors Cycling','hectorqlucero@gmail.com',NULL,'F','T','F'),(61,'Circuito Malinda','Circuito Malinda','Circuito Gomez Morin Poniente',NULL,NULL,NULL,'2019-10-20','07:00:00','Malinda','hectorqlucero@gmail.com',NULL,'F','T','F'),(62,'IV Mexicali-Rumorosa','4Ta Edicion Mexicali-La Rumorosa.','Macro Plaza antes Galerias del Valle',NULL,NULL,NULL,'2019-10-26','08:00:00','Martha Parada','hectorqlucero@gmail.com',NULL,'F','T','F'),(63,'Mujeres Al Pedal','Mujeres al pedal','Rectoria UABC',NULL,NULL,NULL,'2019-11-03','08:00:00','Mujeres Al Pedal','hectorqlucero@gmail.com',NULL,'F','T','F'),(64,'Carrera Contra Reloj','1Ra Carrera Contra Reloj','KM 8 Carretera San Felipe',NULL,NULL,NULL,'2019-11-10','08:00:00','Team Power V8','hectorqlucero@gmail.com',NULL,'F','T','F'),(65,'VII Gran Fondo','7MA Edicion Gran Fondo Mexicali-San Felipe','Parque Hidalgo',NULL,NULL,NULL,'2019-11-16','06:00:00','Cuadrante Rosita','rosarutiaga56@gmail.com',NULL,'F','T','F'),(66,'VII Desafio Mxli-SF','VII Desafio Mexicali-San Felipe','Zona Bike',NULL,NULL,NULL,'2019-11-23','07:00:00','Zona Bike','hectorqlucero@gmail.com',NULL,'F','T','F'),(67,'Circuito Navideño O','Circuito Navideño Obregón','Rectoria UABC',NULL,NULL,NULL,'2019-12-08','09:00:00','RoadRunners','marcopescador@hotmail.com',NULL,'F','T','F'),(68,'Paseo Masivo','Entrenamiento Paseo Masivo - 108 KM','COSTCO',NULL,NULL,NULL,'2019-12-29','07:00:00','Team Power V8','hectorqlucero@gmail.com',NULL,'F','T','F');
/*!40000 ALTER TABLE `rodadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rodadas_link`
--

DROP TABLE IF EXISTS `rodadas_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rodadas_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rodadas_id` int(11) NOT NULL,
  `user` varchar(200) DEFAULT NULL,
  `comentarios` text,
  `email` varchar(100) DEFAULT NULL,
  `asistir` char(1) DEFAULT 'T' COMMENT 'T=Si,F=No',
  PRIMARY KEY (`id`),
  KEY `rodadas_id` (`rodadas_id`),
  CONSTRAINT `rodadas_link_ibfk_1` FOREIGN KEY (`rodadas_id`) REFERENCES `rodadas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rodadas_link`
--

LOCK TABLES `rodadas_link` WRITE;
/*!40000 ALTER TABLE `rodadas_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `rodadas_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` text,
  `dob` varchar(45) DEFAULT NULL,
  `cell` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `level` char(1) DEFAULT NULL COMMENT 'A=Administrador,U=Usuario,S=Sistema',
  `active` char(1) DEFAULT NULL COMMENT 'T=Active,F=Not active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Lucero','Hector','hectorqlucero@gmail.com','$s0$e0801$ncjGTNMeskISJqDaPdBFMg==$uSfl28X2EeOd9ojK/Y/R/QdTIzuwTDZDr/Vx/SIWGuw=','1957-02-07',NULL,NULL,NULL,'hectorqlucero@gmail.com','S','T'),(2,'Hernandez','Oscar','rarome93@gmail.com','$s0$e0801$uRyprW4EP1nVzTdWuVKpeA==$MM80NBwHDRLPZ9FjgxZ87lBdNYkpLcAK9+hdezhiwAs=','1975-10-08',NULL,NULL,NULL,'rarome93@gmail.com','S','T'),(3,'Romero','Marco','mromeropmx@hotmail.com','$s0$e0801$Xa5Mfdp5J+PPwTlTuObzwg==$7LiOZw4ml7grjYCT6JBDJMvN3mU102V/IG/CsqXcqEI=','1975-03-06',NULL,NULL,NULL,'mromeropmx@hotmail.com','S','T'),(4,'Lucero','Martha','marthalucero56@gmail.com','$s0$e0801$uD4rFGJsTIcwfuwJD8i59g==$nXl7P8FpIlDjdsUH1BW29TnP79uHLk2IYL1dWsoEu98=','1956-02-23',NULL,NULL,NULL,'marthalucero56@gmail.com','U','T');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

