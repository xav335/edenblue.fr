-- MariaDB dump 10.17  Distrib 10.4.13-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: edenblue
-- ------------------------------------------------------
-- Server version	10.4.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `mdp` varchar(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','admin33335',NULL),(2,'edenblue','edenblue3355335',NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catproduct`
--

DROP TABLE IF EXISTS `catproduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catproduct` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `image` varchar(250) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `ordre` smallint(6) NOT NULL DEFAULT 100,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catproduct`
--

LOCK TABLES `catproduct` WRITE;
/*!40000 ALTER TABLE `catproduct` DISABLE KEYS */;
INSERT INTO `catproduct` VALUES (113,'Accessoires','',0,'/Capture_d_e_cran_2021_02_21_a_1.23-113.png',0,3),(114,'Robots','',0,'/Capture_d_e_cran_2021_02_21_a_1.07-114.png',0,1),(115,'Produits','',0,'/Capture_d_e_cran_2021_02_21_a_1.50-115.png',0,2),(116,'Tuyaux','',113,'',1,100),(117,'Traitement piscine',NULL,115,NULL,1,100);
/*!40000 ALTER TABLE `catproduct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catrealisation`
--

DROP TABLE IF EXISTS `catrealisation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catrealisation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `image` varchar(250) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `ordre` smallint(6) NOT NULL DEFAULT 100,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catrealisation`
--

LOCK TABLES `catrealisation` WRITE;
/*!40000 ALTER TABLE `catrealisation` DISABLE KEYS */;
INSERT INTO `catrealisation` VALUES (113,'Contemporaines','Eden Blue conçoit des piscines à votre image qui s’intègrent à votre environnement en le valorisant.\r\nLes bassins contemporains permettent d’obtenir des formes actuelles et tendances qui s’adapteront très facilement à une architecture moderne.',0,'',0,3),(115,'Intérieure','klkmk',0,'',0,1);
/*!40000 ALTER TABLE `catrealisation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catrealisation_image`
--

DROP TABLE IF EXISTS `catrealisation_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catrealisation_image` (
  `num_image` int(11) NOT NULL AUTO_INCREMENT,
  `num_produit` int(11) NOT NULL,
  `fichier` varchar(100) NOT NULL,
  `defaut` enum('oui','non') NOT NULL DEFAULT 'non',
  PRIMARY KEY (`num_image`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catrealisation_image`
--

LOCK TABLES `catrealisation_image` WRITE;
/*!40000 ALTER TABLE `catrealisation_image` DISABLE KEYS */;
INSERT INTO `catrealisation_image` VALUES (36,115,'/20160926_164757-115.jpg','oui'),(37,115,'/20170601_154216-115.jpg','non'),(42,114,'/piscine_naturelle3-114.jpg','oui'),(43,114,'/piscine_naturelle1-114.jpg','non');
/*!40000 ALTER TABLE `catrealisation_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `newsletter` tinyint(4) NOT NULL DEFAULT 0,
  `fromgoldbook` tinyint(4) NOT NULL DEFAULT 0,
  `fromcontact` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3983 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1120,'Jav','gonz','jav_gonz@yahoo.com','Tn2kj',NULL,NULL,1,0,1),(2320,'','chima','emmanuelle.braillard@gmail.com','2awXw',NULL,NULL,0,0,1),(2321,'','Javier Gonzalez','joe@free.fr','MXNhP',NULL,NULL,1,0,1),(3442,'Belin-beliet','06 44 75 04 33','pcarrasse@yahoo.com','brn90',NULL,NULL,1,0,0),(3443,'Bruges','06 08 17 87 79','lagardeclaude1@gmail.com','eHPpM',NULL,NULL,1,0,0),(3444,'','06 80 58 60 94','fredo33@gmail.com','YOowi',NULL,NULL,1,0,0),(3445,'Barriere ','685615978','raoul.vie@free.fr','j2uVI',NULL,NULL,1,0,0),(3446,'DIGNET','664933113','jeannesalinier@yahoo.fr','HvMOe',NULL,NULL,1,0,0),(3447,'H','06 80 59 71 00','arnaud.herard@orange.fr','OkhJy',NULL,NULL,1,0,0),(3448,'','06 47 75 29 98','spellerin@orange.fr','SIP6F',NULL,NULL,1,0,0),(3449,'GOCHTOVTT','06 32 83 32 31','nicolas@gochtovtt.com','N9cqn',NULL,NULL,1,0,0),(3450,'','05 58 72 62 98','krouch@wanadoo.fr','MeZ2B',NULL,NULL,1,0,0),(3451,'','06 83 10 72 64','pbonnechere@maisonsur.com','89srT',NULL,NULL,1,0,0),(3452,'','06 87 21 05 30','jeannesalinier@yahoo.fr','YYcyB',NULL,NULL,1,0,0),(3453,'','06 07 40 88 87','sebastien.chirol@yahoo.fr','hdLoK',NULL,NULL,1,0,0),(3454,'','06 23 50 61 10','cecile-maiwenn@hotmail.fr','85gN1',NULL,NULL,1,0,0),(3455,'','07 50 21 63 56','al.mayeur@gmail.com','LoYLE',NULL,NULL,1,0,0),(3456,'','06 87 86 29 10','guycapdo@gmail.com','0oJYd',NULL,NULL,1,0,0),(3457,'','06 58 79 60 58','ch.val.33@gmail.com','9Wbob',NULL,NULL,1,0,0),(3458,'','06 80 35 10 66 ','francisb.domaines@gmail.com','UdYVB',NULL,NULL,1,0,0),(3459,'','','civodul123@hotmail.com','p3CYe',NULL,NULL,1,0,0),(3460,'','06 11 53 76 29','bernard132003@yahoo.fr','cW0jx',NULL,NULL,1,0,0),(3461,'','06 71 94 03 95','lbalabaud@wanadoo.fr','XSLJu',NULL,NULL,1,0,0),(3462,'','06 62 86 06 66','brigitte.toussaint@free.fr','fIIMu',NULL,NULL,1,0,0),(3463,'','06 23 13 80 28','mariemartinechabrier@gmail.com','LKeMZ',NULL,NULL,1,0,0),(3464,'','07 82 18 61 49','figasti@hotmail.fr','gu13f',NULL,NULL,1,0,0),(3465,'','','agenceldsm.architecte@gmail.com','pf6S4',NULL,NULL,1,0,0),(3466,'Gallyc','06 74 26 95 72','contact@frais-vallon.fr','aSN8Z',NULL,NULL,1,0,0),(3467,'Denee','06 64 23 21 98','fdenee@yahoo.fr','aUIJr',NULL,NULL,1,0,0),(3468,'Dollie','05 53 84 26 21','liz@dollie.fr','3NXyp',NULL,NULL,1,0,0),(3469,'','','ebe13@voila.fr','h01kL',NULL,NULL,1,0,0),(3470,'iriart','06 18 02 08 57','levoltigeur33@gmail.com','No4Dg',NULL,NULL,1,0,0),(3471,'Legrand','','claude.legrand@outlook.com','0Sl3y',NULL,NULL,1,0,0),(3472,'urvoy','06 70 41 20 77','aladan@orange.fr','c3hQX',NULL,NULL,1,0,0),(3473,'Royer','','tomarine309@wanadoo.fr','5OFCm',NULL,NULL,1,0,0),(3474,'Meidani','','meidani.djebrin@calixo.net','WsZJQ',NULL,NULL,1,0,0),(3475,'Roux','','rouxisabelle236@aol.com','ePP3Z',NULL,NULL,1,0,0),(3476,'Gilles','06 07 48 77 44','karin.gilles@orange.fr','oFbi9',NULL,NULL,1,0,0),(3477,'Latry','','jeanmichel.latry@gmail.com','hfPq8',NULL,NULL,1,0,0),(3478,'Teillet','06 18 29 71 27','bernard.teillet0617@orange.fr','dsYi7',NULL,NULL,1,0,0),(3479,'Colle','','damien.colle@sfr.fr','JdJfD',NULL,NULL,1,0,0),(3480,'Despreaux','05 56 79 24 24','iad@mbacapital.com','VZWKz',NULL,NULL,1,0,0),(3481,'Taveaux','06 60 46 12 05','taveaux','COcgH',NULL,NULL,1,0,0),(3482,'','06 75 22 51 24','fleur.debasly@gmail.com','Zua1A',NULL,NULL,1,0,0),(3483,'Godin','','togodin@wanadoo.fr','88DMn',NULL,NULL,1,0,0),(3484,'hamelin','06 85 16 22 69','hamelinjf@orange.fr','BNDnW',NULL,NULL,1,0,0),(3485,'Caurier','06 98 87 51 94','athena.gestion.bordeaux@gmail.com','AWX82',NULL,NULL,1,0,0),(3486,'Marcillaud','06 64 24 38 56','maxifane@yahoo.fr>','qSRcs',NULL,NULL,1,0,0),(3487,'Duchesne','06 87 20 03 34','mpld79@gmail.com>','eD5gJ',NULL,NULL,1,0,0),(3488,'Brunot','06 74 26 95 72','thierry.brunot@gmail.com','z62AT',NULL,NULL,1,0,0),(3489,'Goossens','05 57 58 11 96','marcpaulgoossens@gmail.com','svQV8',NULL,NULL,1,0,0),(3490,'Merlet','06 77 48 41 51','d_merlet@orange.fr','2kIsv',NULL,NULL,1,0,0),(3491,'Denoix','06 66 99 93 80','architecte marc denoix','sSifP',NULL,NULL,1,0,0),(3492,'','06 07 89 22 42','ginieisjm@wanadoo.fr','8uvMu',NULL,NULL,1,0,0),(3493,'Frangsheng','','flin28@gmail.com','LOXGS',NULL,NULL,1,0,0),(3494,'Eslan','06 20 24 99 91','claude.eslan@orange.fr','u4Lmr',NULL,NULL,1,0,0),(3495,'Carnelli','06 58 16 98 08','camillecarnielli@hotmail.fr','uCMal',NULL,NULL,1,0,0),(3496,'Chombart','06 73 12 97 16','Guillaume.chombart@orange.fr','HZwgi',NULL,NULL,1,0,0),(3497,'Dannequin','06 84 41 25 16','ludovic.agnes.dannequin@wanadoo.fr','RyYXC',NULL,NULL,1,0,0),(3498,'Vedere','06 88 15 59 02','Vedere1@aol.com','CTWXv',NULL,NULL,1,0,0),(3499,'Labatut','06 83 06 45 45','labatut.serge@orange.fr','eza14',NULL,NULL,1,0,0),(3500,'Audoin','06 61 23 31 06','christopheaudoin@orange.fr','SkWuu',NULL,NULL,1,0,0),(3501,'Esteban','06 59 16 33 5','jean.esteban23@sfr.fr','cOWON',NULL,NULL,1,0,0),(3502,'Dubois','06 77 14 63 33','smalfamilydubois@gmail.com','7kCsq',NULL,NULL,1,0,0),(3503,'Chatelin','06 83 96 12 61','magalichatelin@hotmail.fr','I8MxT',NULL,NULL,1,0,0),(3504,'Plaire','05 46 83 34 85','jeanjacques.plaire@.fr','eZCYM',NULL,NULL,1,0,0),(3505,'Mass','09 60 07 05 36',' massejeanclaude24@orange.fr','X40VT',NULL,NULL,1,0,0),(3506,'','Mota Marcel','geraldine_mota@hotmail.com','rpbmH',NULL,NULL,0,0,1),(3507,'','Lavaud','slavaud@gfdc.fr','TDnvt',NULL,NULL,0,0,1),(3508,'','FRANC eric','eric.franc1@sfr.fr','m4Wca',NULL,NULL,1,0,1),(3509,'','BOUVET','del941@hotmail.fr','46OTV',NULL,NULL,0,0,1),(3510,'','Bonaldi ','gilles.bonaldi@gmail.com','WGgBm',NULL,NULL,0,0,1),(3511,'','MASSON','vincent.masson@yahoo.fr','U5uxL',NULL,NULL,0,0,1),(3512,'','salmon','monsterpic@wanadoo.fr','jiV5h',NULL,NULL,1,0,1),(3513,'','Drunchilova ','elena.drunchilova@gmail.com','xtTbH',NULL,NULL,0,0,1),(3514,'','ladroit','polyboat@hotmail.com','3aqbX',NULL,NULL,0,0,1),(3515,'','REY','jcrey@outlook.fr','5SJg2',NULL,NULL,1,0,1),(3516,'','MASETTI','sylvain.masetti@hotmail.fr','T62v4',NULL,NULL,0,0,1),(3517,'','Dumats Estelle','dumats.estelle@hotmail.fr','mvFAA',NULL,NULL,0,0,1),(3518,'','','bobbymonturet@gmail.com','SBPgI',NULL,NULL,1,0,1),(3519,'','fritsch','p_fritsch@hotmail.fr','XSO7J',NULL,NULL,1,0,1),(3520,'','Jamin francis','mhlodetti@gmail.com','E179M',NULL,NULL,0,0,1),(3521,'','CARRIOT','sebastien.carriot@gmail.com','TWgLM',NULL,NULL,0,0,1),(3522,'','GERIN','gerin.bernard@yahoo.fr','v9VO3',NULL,NULL,1,0,1),(3523,'','Tornier Cyril','tornier.cyril@neuf.fr','F8nZu',NULL,NULL,0,0,1),(3524,'','Dominique Grelier','jean.paul.grelier@wanadoo.fr','QfQ8Z',NULL,NULL,1,0,1),(3525,'','ROUSSEAU ERIC','eric.rousseau24@orange.fr','iKjuy',NULL,NULL,1,0,1),(3526,'','Rouviere','rouvierefrederic@yahoo.fr','9mB51',NULL,NULL,0,0,1),(3527,'','FAITROP MOREAUX','e.faitrop@gmail.com','HVIAj',NULL,NULL,1,0,1),(3528,'','Jean-Jacques Layeux','es002@mac.com','kLxcd',NULL,NULL,1,0,1),(3529,'','Duthil Pierre','pierre.duthil@gmail.com','QRkb3',NULL,NULL,1,0,1),(3530,'','baudin','y.baudin@hotmail.fr','rl6qz',NULL,NULL,0,0,1),(3531,'','BESANCON','nynous33@gmail.com','qs0f8',NULL,NULL,0,0,1),(3532,'','Minet jean-francois','j.minet530@laposte.net','a6eOS',NULL,NULL,1,0,1),(3533,'','LEWANDOWSKI','b.lewandowski40@orange.fr','YDaGx',NULL,NULL,0,0,1),(3534,'','Heble vincent','vinsh24@gmail.com','ZSi8v',NULL,NULL,0,0,1),(3535,'','RAPHALEN','valerieraphalen@hotmail.fr','qZFZ5',NULL,NULL,1,0,1),(3536,'','Gastel jacques','gasteljacques@gmail.com','zr8I2',NULL,NULL,1,0,1),(3537,'','Dubois','dubois3313@yahoo.fr','ZdoKS',NULL,NULL,0,0,1),(3538,'','guedes','guedes.estelle@orange.fr','VhD40',NULL,NULL,1,0,1),(3539,'','Gonzalez','gaelle_gonzalez@hotmail.fr','zQDSW',NULL,NULL,1,0,1),(3540,'','durte','tatiana.duret@orange.fr','AAjMw',NULL,NULL,1,0,1),(3541,'','jean claude ambrieu','jc.ambrieu@yahoo.fr','ohUdz',NULL,NULL,1,0,1),(3542,'','lebrun didier','didier59147@orange.fr','S5DTZ',NULL,NULL,1,0,1),(3543,'','Littiere ','mrubinil@orange.fr','RCUnF',NULL,NULL,1,0,1),(3544,'','Jimenez michel','micheljimenez33@gmail.com','Xm3VC',NULL,NULL,1,0,1),(3545,'','BARBOTEAU','emmanuel.barboteau@orange.fr','Rs5kQ',NULL,NULL,0,0,1),(3546,'','Patricia Augay','augay.patricia@gmail.com','Eci2S',NULL,NULL,1,0,1),(3547,'','Sisic','marielaure.sisic@gmail.com','vbS2k',NULL,NULL,1,0,1),(3548,'','Sandy','querite.sandy@gmail.com','uys5n',NULL,NULL,1,0,1),(3549,'','Sylvain Vergnes','vstp@hotmail.fr','A30x7',NULL,NULL,0,0,1),(3550,'','','','Ml5Nv',NULL,NULL,0,0,1),(3551,'','DELO Marie et Benoit','marie.leroy78@orange.fr','WuRGT',NULL,NULL,0,0,1),(3552,'','Pataille','laurentpataille@yahoo.fr','RAfTl',NULL,NULL,1,0,1),(3553,'','Badji','oumybadji@orange.fr','nYz5d',NULL,NULL,1,0,1),(3554,'','COMINARDI','bertrand.cominardi@ncnumericable.com','foXrh',NULL,NULL,1,0,1),(3555,'','GUIMARAES SYLVIE','Philippegraciet@orange.fr','UIV2J',NULL,NULL,1,0,1),(3556,'','Verdan','verdanfr@gmail.com','2MVSI',NULL,NULL,0,0,1),(3557,'','domengie','sebastien.domengie@decid-system.fr','CoRKb',NULL,NULL,0,0,1),(3558,'','bochereau nicolas','nicolasbochereau@hotmail.com','xLHeP',NULL,NULL,0,0,1),(3559,'','PORTALES DAVID','david.portales@green-lighthouse.com','NuLny',NULL,NULL,0,0,1),(3560,'','Mr et Mme Couzy','val.couzy@free.fr','yUzal',NULL,NULL,0,0,1),(3561,'','dieudonne philippe','philippe.dieudonne@inria.fr','sb6uQ',NULL,NULL,1,0,1),(3562,'','Labarre Fontan ','justinlabarrefontan','A5ZET',NULL,NULL,1,0,1),(3563,'','querite','querite.f@gmail.com','OBWS6',NULL,NULL,1,0,1),(3564,'','Chateau Perrine','c.perrine.ci@hotmail.com','SxuRQ',NULL,NULL,1,0,1),(3565,'','Benoît Debray','benpat3@wanadoo.fr','PTWkO',NULL,NULL,0,0,1),(3566,'','chambon','yeyette63@aol.com','Dge1H',NULL,NULL,0,0,1),(3567,'','FAUVARQUE','catherine.fauvarque@wanadoo.fr','yD4TT',NULL,NULL,1,0,1),(3568,'','MOREAU','gregory.moreau@fortal.fr','y7Y7M',NULL,NULL,0,0,1),(3569,'','Sarasin','sarasin.pierre@neuf.fr','8GUsM',NULL,NULL,1,0,1),(3570,'','BOURCIER','financalis@orange.fr','xrpb1',NULL,NULL,1,0,1),(3571,'','REINARD NICOLAS ','nico.vcp44@gmail.com','4X6dC',NULL,NULL,0,0,1),(3572,'','FIGLIOLINI Cédric','cfiglio@hotmail.com','keZqn',NULL,NULL,1,0,1),(3573,'','Laneau','mathieu.laneau@hotmail.fr','5cgBS',NULL,NULL,1,0,1),(3574,'','LEGRIS','guillaumelegris@wanadoo.fr','bFWC8',NULL,NULL,0,0,1),(3575,'','dehallet','fox_silver19@hotmail.com','BFzEf',NULL,NULL,0,0,1),(3576,'','FRIH','boutayna.rhourri-frih@hotmail.fr','l459r',NULL,NULL,1,0,1),(3577,'','Teule','jeremy.teule@hotmail.fr','CSojS',NULL,NULL,0,0,1),(3578,'','Abraldes','iabraldes@hotmail.fr','b7syX',NULL,NULL,0,0,1),(3579,'','Rebeyrotte','anne-laure.t@wanadoo.fr','EZ4Xk',NULL,NULL,1,0,1),(3580,'','Arrigo','sonia.arrigo47@gmail.com','r6lZd',NULL,NULL,1,0,1),(3581,'','Niquet wilfried','wil_33700@hotmail.fr','uM2vk',NULL,NULL,0,0,1),(3582,'','NINOT patrick','kenoya@wanadoo.fr','hwNGv',NULL,NULL,0,0,1),(3583,'','sylvain duport','sylvain@duport.org','30qtU',NULL,NULL,0,0,1),(3584,'','lemaire','manulemaire4@hotmail.fr','2DSOr',NULL,NULL,0,0,1),(3585,'','POVEDA','poveda.philippe@orange.fr','P72Jf',NULL,NULL,1,0,1),(3586,'','Saintamon','stephan.saintamon@sfr.fr','ez8CG',NULL,NULL,0,0,1),(3587,'','PONTALIER','ludovic.pontalier@gmail.com','KqfVn',NULL,NULL,0,0,1),(3588,'','Rajade','mrajade01@free.fr','Irl9C',NULL,NULL,1,0,1),(3589,'','daudigeos','familledaudigeos@hotmail.com','gbA7w',NULL,NULL,0,0,1),(3590,'','De castro','s.decastro@hotmail.fr','v1ZIW',NULL,NULL,0,0,1),(3591,'','DUBERNET ','laloubernet@orange.fr','oYh1e',NULL,NULL,0,0,1),(3592,'','Poullain','christine.poullain@gmail.com','dJowt',NULL,NULL,1,0,1),(3593,'','Rocha Alexia','alexia.rocha1501@gmail.com','R9aKI',NULL,NULL,1,0,1),(3594,'','MARTIN Franck','fvjc.martin@orange.fr','FOcbh',NULL,NULL,0,0,1),(3595,'','ramaud','audrey.ramaud@laposte.net','Hrjs2',NULL,NULL,0,0,1),(3596,'','vayleux','gvayleux@gmail.com','dg6yO',NULL,NULL,1,0,1),(3597,'','Moari','marc.apache@hotmail.fr','5ilwc',NULL,NULL,1,0,1),(3598,'','LANCIEN','nicolas.lancien@acteis-so.fr','eylve',NULL,NULL,0,0,1),(3599,'','Julien PONTIER','jupontier@orange.fr','zfbpE',NULL,NULL,0,0,1),(3600,'','Hervieu','fagwenfa@free.fr','mtx4k',NULL,NULL,0,0,1),(3601,'','PALLUAULT','palluault.jerome@gmail.com','2aDQY',NULL,NULL,0,0,1),(3602,'','rodriguez','rodriguezagomer@orange.fr','2kzAe',NULL,NULL,0,0,1),(3603,'','Zimmermann','camille.zim@icloud.com','fLIFB',NULL,NULL,0,0,1),(3604,'','CBC','migoudi@gmail.com','EiWDb',NULL,NULL,0,0,1),(3605,'','Mulquin','franck.mulquin@gmail.com','1pBjw',NULL,NULL,0,0,1),(3606,'','PENISSAT','anthony.penissat@yahoo.fr','9Rp7R',NULL,NULL,0,0,1),(3607,'','baux','davidbaux@hotmail.fr','Hp9wQ',NULL,NULL,0,0,1),(3608,'','ERIKA RABANIER','erab@hotmail.fr','suwiO',NULL,NULL,1,0,1),(3609,'','SELLAM ','mchristine.sellam@gmail.com','wrRUD',NULL,NULL,1,0,1),(3610,'','Wibaut','david.wibaut@orange.fr','OHgtl',NULL,NULL,0,0,1),(3611,'','KOPFF','sandrine.kopff4@orange.fr','SOzzV',NULL,NULL,0,0,1),(3612,'','NUGEYRE Michelle','mjc.nugeyre@orange.fr','cvPcI',NULL,NULL,1,0,1),(3613,'','Gregorio Gonzalez','fjavi.gonzalez@gmail.com','K6OlF',NULL,NULL,1,0,1),(3614,'','Cheftel','cheftela@hotmail.com','hc3WR',NULL,NULL,1,0,1),(3615,'',' zoccola','elodie.zoccola@nordnet.fr','UTBVJ',NULL,NULL,1,0,1),(3616,'','SAUBOBERT Jean Jacques','jj.saubobert@saubobert.fr','zExUC',NULL,NULL,1,0,1),(3617,'','MAUVILLAIN Anaïs','a.mauvillain@hotmail.fr','msgGR',NULL,NULL,0,0,1),(3618,'','LAPORTE','damien.laporte11@gmail.com','kiUyJ',NULL,NULL,0,0,1),(3619,'','Etchepare Paxkal','paxkal.etxepare@gmail.com','5mero',NULL,NULL,0,0,1),(3620,'','Fanals','pfanals@gmail.com','73CV3',NULL,NULL,0,0,1),(3621,'','Marc','kemar91080@gmail.com','Zxpoe',NULL,NULL,1,0,1),(3622,'','Jean Christophe Baldacchino','jcb94440@gmail.com','RlnX7',NULL,NULL,1,0,1),(3623,'','audiger','marieclaudeaudiger@yahoo.fr','WMIGB',NULL,NULL,1,0,1),(3624,'','Rey','nanine33@live.fr','e8Cb8',NULL,NULL,0,0,1),(3625,'','nELLY','nellyleonard@wanadoo.fr','jPPfr',NULL,NULL,1,0,1),(3626,'','saget','sagetyann@orange.fr','NZNkT',NULL,NULL,0,0,1),(3627,'','Huet','sylvainhuet33@gmail.com','eEIFB',NULL,NULL,1,0,1),(3628,'','CHAUTY Damien','damien.chauty@gmail.com','LGi2r',NULL,NULL,0,0,1),(3629,'','Dutertre','nadiadutertre@icloud.com','DewGI',NULL,NULL,0,0,1),(3630,'','Bourasseau','tidave64@gmail.com','XmW2M',NULL,NULL,0,0,1),(3631,'','roche','amanda.roche@sfr.fr','MFUGx',NULL,NULL,1,0,1),(3632,'','Le Bailly catherine','Lebailly.catherine2@gmail.com','xCBPu',NULL,NULL,1,0,1),(3633,'','Monblanc bernard','Bm@monblanc-traiteur.com','1WkM0',NULL,NULL,1,0,1),(3634,'','VIGNERON','fvigneron@telemsa.com','IvFHj',NULL,NULL,0,0,1),(3635,'','Coureau','coureau33240@gmail.com','csoOy',NULL,NULL,1,0,1),(3636,'','dorion chantal','chantaldorion@wanadoo.fr','UYiHe',NULL,NULL,1,0,1),(3637,'','D\'ARRAS GUY','guy.d-arras@orange.fr','NmVjd',NULL,NULL,1,0,1),(3638,'','Le moulec','l.lemoulec@gmail.com','75gfy',NULL,NULL,0,0,1),(3639,'','Couturier carla','couturier.carla@yahoo.fr','9BTAm',NULL,NULL,0,0,1),(3640,'','Brondel claude','brondel_claude@orange.fr','2W8lg',NULL,NULL,1,0,1),(3641,'','Soubes','hugo.soubes@sfr.fr','X5M8f',NULL,NULL,1,0,1),(3642,'','Pannier ','vavari75@gmail.com','kRHiL',NULL,NULL,0,0,1),(3643,'','Philippe Weppe','philippe.weppe@gmail.com','b6lHV',NULL,NULL,1,0,1),(3644,'','MAUREL','gilles.maurel@hotmail.fr','GNcEx',NULL,NULL,0,0,1),(3645,'','Boiné ','donatboine@yahoo.fr','VIbaR',NULL,NULL,1,0,1),(3646,'','Kris Van Rompu - Kristel Janssens','krisenkristel@skynet.be','m8aI1',NULL,NULL,1,0,1),(3647,'','MESSERSCHMIDT','eliselmmesser@gmail.com','v1czs',NULL,NULL,0,0,1),(3648,'','Bonhoure ','lisa-bonhoure@live.fr','NaaE5',NULL,NULL,1,0,1),(3649,'','Daout','emmanuel.daout@yahoo.fr','3ZVDa',NULL,NULL,1,0,1),(3650,'','lefaye','lefaye33@hotmail.fr','0SZjs',NULL,NULL,1,0,1),(3651,'','Clabaux','o.clabaux@gmail.com','LpHFI',NULL,NULL,1,0,1),(3652,'','DIARD LAURENT','l.diard@yahoo.fr','9OAyU',NULL,NULL,1,0,1),(3653,'','PATRICK WEIL','pkweil@aol.com','0USmZ',NULL,NULL,0,0,1),(3654,'','Boussard','guillaumecarole@live.fr','n2i8s',NULL,NULL,0,0,1),(3655,'','MERIDA','sebastiandelantonio@gmail.com','c219A',NULL,NULL,1,0,1),(3656,'','Laurent','karine0033@hotmail.fr','TdZ8f',NULL,NULL,1,0,1),(3657,'','laborde Frédéric ','fabienne.laborde@orange.fr','yLRtX',NULL,NULL,0,0,1),(3658,'','rischard','damienrischard@hotmail.com','QYgNR',NULL,NULL,0,0,1),(3659,'','Besse','chbesse@orange.fr','cosAw',NULL,NULL,0,0,1),(3660,'','Yoann Bergeron','yoann.bergeron@hotmail.fr','oOft4',NULL,NULL,1,0,1),(3661,'','PEYROUX jean_françois','jfp333@orange.fr','OjK4i',NULL,NULL,1,0,1),(3662,'','Guyonnet','gavardfanny@gmail.com','YpD03',NULL,NULL,0,0,1),(3663,'','artaxet','nicole.artaxet@gmail.com','6MJTy',NULL,NULL,1,0,1),(3664,'','Cherpantier','joelle14cherp@gmail.com','Je6JI',NULL,NULL,1,0,1),(3665,'','ERIC','seananalyss@gmail.com','hpJsT',NULL,NULL,0,0,1),(3666,'','Sébastien Marais','sebastien.marais@gmail.com','MGp8v',NULL,NULL,0,0,1),(3667,'','Voyer Marina ','family-zoe@hotmail.fr','oTJG9',NULL,NULL,1,0,1),(3668,'','CORNET Philippe','m.cornet@ifaid.org','ZsocS',NULL,NULL,1,0,1),(3669,'','Harribey','helene.harribey@gmail.com','ExV1Z',NULL,NULL,1,0,1),(3670,'','VIOT','jeremy.viot@hotmail.fr','Riy46',NULL,NULL,0,0,1),(3671,'','ROUSSEAU','laure.rousseau@bnpparibas.com','4haxO',NULL,NULL,1,0,1),(3672,'','meunier thierry','thmeun@yahoo.fr','A08mk',NULL,NULL,0,0,1),(3673,'','GUIOT','julienguiot33@gmail.com','nv067',NULL,NULL,0,0,1),(3674,'','Mm Susan Hubbard','susan.hubbard@orange.fr','tagLC',NULL,NULL,1,0,1),(3675,'','Coureaud','ycoureaud@yahoo.fr','8Kgey',NULL,NULL,1,0,1),(3676,'','Maxime MEIGNAN','maxime.meignan@hotmail.fr','oGAaG',NULL,NULL,0,0,1),(3677,'','ULMER Jean marie','ulmer.jeanmarie@gmail.com','VwqVp',NULL,NULL,1,0,1),(3678,'','DULCY','aureliendulcy@yahoo.fr','KlaxI',NULL,NULL,0,0,1),(3679,'','El ouarrate','sophia_bordeaux@hotmail.fr','ClyJN',NULL,NULL,1,0,1),(3680,'','picart','j.picart@kozoomcorp.com','pwMWt',NULL,NULL,0,0,1),(3681,'','Joyeux','sarah.joyeux@orange.fr','i4KA2',NULL,NULL,0,0,1),(3682,'','deveix jean christophe','33jclo@gmail.com','nrKYd',NULL,NULL,0,0,1),(3683,'','DE GOITI','stanislas.degoiti@gmail.com','3K9xR',NULL,NULL,0,0,1),(3684,'','RISPAL','loic.rispal@orange.fr','suipo',NULL,NULL,0,0,1),(3685,'','MARTEL','renaudcmartel@gmail.com','LTfOA',NULL,NULL,0,0,1),(3686,'','Martin Devaux','martindevaux.laetitia@gmail.com','ps3CP',NULL,NULL,0,0,1),(3687,'','GOURDON','adelinegourdon@wanadoo.fr','fiUyg',NULL,NULL,0,0,1),(3688,'','Pinard','yann.pnd@free.fr','EMf41',NULL,NULL,1,0,1),(3689,'','Serge Daniel Lestang','daniell-serge@orange.fr','15qJX',NULL,NULL,0,0,1),(3690,'','coulon sebastien','gwenseb@free.fr','MiLD7',NULL,NULL,0,0,1),(3691,'','pascal iriart','piriart1@gmail.com','XUVI7',NULL,NULL,0,0,1),(3692,'','KERCHBRON','dkerchbron@hotmail.com','bnchk',NULL,NULL,0,0,1),(3693,'','Rebelo','emile.rebelo@gmail.com','zwjWE',NULL,NULL,0,0,1),(3694,'','LAFOURCADE ANNE','lafourcade.anne@gmail.com','Dna04',NULL,NULL,0,0,1),(3695,'','Jérémie Knops','jeremieknops@gmail.com','wsaub',NULL,NULL,0,0,1),(3696,'','CELINE LEVEQUE','l.ink@me.com','tY5sX',NULL,NULL,0,0,1),(3697,'','Becker','alves_carole@yahoo.fr','A9uDS',NULL,NULL,0,0,1),(3698,'','ANDRE Marie odile','ericmalandre@orange.fr','HqgVU',NULL,NULL,1,0,1),(3699,'','MOTTE','laetitia.motte@gmail.com','Z3k9M',NULL,NULL,0,0,1),(3700,'','ANNE MARTINEZ LONNE','anne.martinezlonne@gmail.com','6N6tG',NULL,NULL,0,0,1),(3701,'','LAGOFUN PASCAL','P.LAGOFUN@SFR.FR','kuVrf',NULL,NULL,1,0,1),(3702,'','VERDIER DAVID','etude@bdb-tp.fr','IEj9T',NULL,NULL,1,0,1),(3703,'','baney','coraliebaney@hotmail.fr','pbsqB',NULL,NULL,0,0,1),(3704,'','Tallon','solene.tallon@hotmail.fr','1CPcA',NULL,NULL,0,0,1),(3705,'','valat','guy.valat0306@orange.fr','sGdK4',NULL,NULL,1,0,1),(3706,'','Moulinier','juliemika17@orange.fr','q42N3',NULL,NULL,0,0,1),(3707,'','Manescau Catherine','catherine.manescau@scalandes.fr','fOiFE',NULL,NULL,1,0,1),(3708,'','SMIRI ','smiri.salaheddine@gmail.com','vQmkN',NULL,NULL,0,0,1),(3709,'','Franck turmo','franck.turmo@icloud.com','F5vnK',NULL,NULL,1,0,1),(3710,'','david chabaud','chabaud.david@bbox.fr','M5rnu',NULL,NULL,0,0,1),(3711,'','LAJAUMONT','vlajaumont@vitamine-b.fr','mrJ1d',NULL,NULL,0,0,1),(3712,'','PATRICK MARINSALTI','pmarinsalti@free.fr','K3DKw',NULL,NULL,0,0,1),(3713,'','Helie ','helieflorian@hotmail.com','GZyzD',NULL,NULL,1,0,1),(3714,'','frinchaboy pierre','patricia.frinchaboy@gmail.com','cn5MZ',NULL,NULL,0,0,1),(3715,'','CONDEMINE','davidcondemine@wanadoo.fr','EOXrV',NULL,NULL,0,0,1),(3716,'','lambert','edlauchar@gmail.com','DziHk',NULL,NULL,0,0,1),(3717,'','daffis','camping-medoc@orange.fr','7HX2a',NULL,NULL,0,0,1),(3718,'','Le Floch ','magadroy@gmail.com','LmXJi',NULL,NULL,1,0,1),(3719,'','Anthony Burel','antheline76@gmail.com','L51lu',NULL,NULL,1,0,1),(3720,'','BLEYZAT Christophe','bleyzat.bci@gmail.com','i2I9y',NULL,NULL,1,0,1),(3721,'','Severine Noutary','Clarailonaseveludo@live.fr','a4KSG',NULL,NULL,1,0,1),(3722,'','Bouvier','dams40110@hotmail.fr','JEL29',NULL,NULL,0,0,1),(3723,'','SARL ZARUBA ARCHITECTES','contact@zaruba-architectes.com','nAGdG',NULL,NULL,0,0,1),(3724,'','Raphael Esteve','estevebx3@gmail.com','PNluq',NULL,NULL,0,0,1),(3725,'','lasserre','didouni@wanadoo.fr','St2ZV',NULL,NULL,0,0,1),(3726,'','alexandre lafforgue','chicodobrasil13@hotmail.fr','2BvTZ',NULL,NULL,0,0,1),(3727,'','Dejean','chris33560@hotmail.fr','fEBVU',NULL,NULL,1,0,1),(3728,'','GRANDON STEPHANE','stephane.grandon@orange.fr','BnzU7',NULL,NULL,1,0,1),(3729,'','OLLIVIER ','olliviermalika@live.fr','jbTNZ',NULL,NULL,1,0,1),(3730,'','Mouzakki Kamal','icatenne@yahoo.fr','OwjzX',NULL,NULL,0,0,1),(3731,'','Stéphane Pitous','st.pitous@gmail.com','yykOV',NULL,NULL,1,0,1),(3732,'','GRASSIES','arnaud.grassies@wanadoo.fr','TLS5M',NULL,NULL,0,0,1),(3733,'','Lemer','lemergilles.59@gmail.com','ELPJj',NULL,NULL,1,0,1),(3734,'','Mireille Dartois','mireille.dartois@gmail.com','Z9SCw',NULL,NULL,1,0,1),(3735,'','Dargazanli','n.berger33@gmail.com','VBYp7',NULL,NULL,1,0,1),(3736,'','MITRIDE MELISSA','portvila77@gmail.com','aWzsP',NULL,NULL,0,0,1),(3737,'','Fridella mario','pompeafridella@gmail.com','Oy2qh',NULL,NULL,0,0,1),(3738,'','Combes Audrey','audreycombes48@gmail.com','yYSuC',NULL,NULL,1,0,1),(3739,'','BUREL','francois.burel@gmail.com','t3zUo',NULL,NULL,0,0,1),(3740,'','Bouquillon ','serge.bouquillon@gmail.com','jELZf',NULL,NULL,0,0,1),(3741,'','violle','vincentviolle@hotmail.fr','aVOnb',NULL,NULL,0,0,1),(3742,'','Athaquet','manuel.athaquet@free.fr','pVGSK',NULL,NULL,0,0,1),(3743,'','Brulin','delphine.fierville@sfr.fr','ei3Ur',NULL,NULL,1,0,1),(3744,'','Boissard','Boissard.celine@laposte.net','UIUfC',NULL,NULL,0,0,1),(3745,'','meynardie','bxtlse@yahoo.fr','v1KjA',NULL,NULL,1,0,1),(3746,'','Swica','jeremy_swica@yahoo.fr','CaxNc',NULL,NULL,0,0,1),(3747,'','francois Wolgarten','francoiswolgarten@gmail.com','1be0b',NULL,NULL,1,0,1),(3748,'','Pierre Guy DOUYERE','pierreguydouyere@gmail.com','3cplU',NULL,NULL,1,0,1),(3749,'','Joel SONNES','joel.sonnes@accor.com','KSnyz',NULL,NULL,0,0,1),(3750,'','Malik Jewiti','mjewiti@gmail.com','ZbBo9',NULL,NULL,0,0,1),(3751,'','Delbancut','jonathan.delbancut@orange.fr','velzh',NULL,NULL,1,0,1),(3752,'','lam','matt.lam33@gmail.com','Aj0zs',NULL,NULL,0,0,1),(3753,'','RONDET','ludo_r@hotmail.fr','TbaUf',NULL,NULL,0,0,1),(3754,'','Cadet-Marthe','g.cadet-marthe@hotmail.fr','8ZoNI',NULL,NULL,0,0,1),(3755,'','Penches ','cpeyches33@gmail.com','LZKFv',NULL,NULL,0,0,1),(3756,'','Manon De almeida','manon.dealmeida@yahoo.fr','vByMj',NULL,NULL,0,0,1),(3757,'','Vergé Elsa','elsa.lucas@hotmail.fr','Ac7iU',NULL,NULL,1,0,1),(3758,'','estelle colombani','estelle.colombani@gmail.com','JbpR8',NULL,NULL,1,0,1),(3759,'','Villamaux','ciriennevillamaux@orange.fr','ed7K5',NULL,NULL,1,0,1),(3760,'','lobel','ymlobel@icloud.com','ewbd6',NULL,NULL,1,0,1),(3761,'','Bouchet','smonlezun@gmail.com','vSCnW',NULL,NULL,0,0,1),(3762,'','Martin','noreply@yoorshop.eu','4v4iJ',NULL,NULL,1,0,1),(3763,'','Richard','arnricha@yahoo.fr','MAXXS',NULL,NULL,0,0,1),(3764,'','pitet','mpitet@gmail.com','vzVHx',NULL,NULL,0,0,1),(3765,'','CIOFFI christine ','christinecioffi@orange.fr','B6ydX',NULL,NULL,1,0,1),(3766,'','Beziat','davidbeziat@yahoo.fr','E5ng8',NULL,NULL,0,0,1),(3767,'','FARAMARZI','pfaramarzi@cofigef.fr','NGP08',NULL,NULL,1,0,1),(3768,'','Mestre','myriam_ballarati@yahoo.com','3x9Lq',NULL,NULL,0,0,1),(3769,'','MAire ','cirylmaire@hotmail.com','MBlmF',NULL,NULL,0,0,1),(3770,'','MR JEGAT JULIEN','j.jegat@renaultcotedargent.fr','N2QYx',NULL,NULL,1,0,1),(3771,'','Laurent Rivetti','camping.lacacia@orange.fr','Qkbgn',NULL,NULL,0,0,1),(3772,'','CALVO','etablissements.calvo@gmail.com','gPmRp',NULL,NULL,0,0,1),(3773,'','DANDIEU','gregorydandieu@hotmail.com','BNIFY',NULL,NULL,1,0,1),(3774,'','KADJAMON','giuliabela@hotmail.fr','byIog',NULL,NULL,0,0,1),(3775,'','MAYEUR','berengeregervais@hotmail.fr','5YjzZ',NULL,NULL,1,0,1),(3776,'','NEGROBAR Olivier','olivier.neg.972@hotmail.fr','Mdps6',NULL,NULL,1,0,1),(3777,'','masip','charlottechevance@hotmail.fr','IFDNz',NULL,NULL,0,0,1),(3778,'','Raphael Payet','raphaelpytte@gmail.com','9Rmjv',NULL,NULL,1,0,1),(3779,'','Charbonnet ','Lscharbonnet@free.fr','Bt5zU',NULL,NULL,1,0,1),(3780,'','MARS','edwin.mars@wanadoo.fr','SAyLu',NULL,NULL,0,0,1),(3781,'','DUMONTIER Christophe','chr.dumontier@gmail.com','0gl3x',NULL,NULL,1,0,1),(3782,'','MARMASSE','kevin.marmasse@gmail.com','33jq4',NULL,NULL,0,0,1),(3783,'','BORDET hugo','hbnet@orange.fr','zu3dl',NULL,NULL,0,0,1),(3784,'','Fautous ','cfautous@wanadoo.fr','vd8Ef',NULL,NULL,0,0,1),(3785,'','Ahmed Chelfi','ahmed.chelfi@free.fr','Q1PgN',NULL,NULL,1,0,1),(3786,'','Yannick FABBRI','y.fabbri@arkeo-international.com','XsScB',NULL,NULL,0,0,1),(3787,'','HANITRINIAINA','laure@wholesaler-website.com','A0FTv',NULL,NULL,1,0,1),(3788,'','Guillaume ','guillaume972@msn.com','1QxGI',NULL,NULL,1,0,1),(3789,'','Anne-Sophie Amiet','annesophie.amiet@gmail.com','YioNc',NULL,NULL,1,0,1),(3790,'','Adèle PERRIN','adele.perrin@cityzen-architectes.com','2Xi2X',NULL,NULL,1,0,1),(3791,'','TALBI ','alaindz33@wanadoo.fr','jqob6',NULL,NULL,1,0,1),(3792,'','Guerin','maudboston@me.com','rYGOD',NULL,NULL,0,0,1),(3793,'','foulet','BFOULET@HOTMAIL.FR','2lGqt',NULL,NULL,1,0,1),(3794,'','Bendifallah','mageur@hotmail.com','wzUyi',NULL,NULL,1,0,1),(3795,'','marty','fmarty64@gmail.com','2cOmj',NULL,NULL,1,0,1),(3796,'','Colliot Pierre','pierre.colliot@hotmail.fr','vnplC',NULL,NULL,0,0,1),(3797,'','gasparotto','patricia_gasparotto@yahoo.fr','kH2eI',NULL,NULL,0,0,1),(3798,'','MAISTERRENA','mitxu_eloia@yahoo.fr','ssotS',NULL,NULL,0,0,1),(3799,'','Rebollar','harasmontdesir@gmail.com','oSPRl',NULL,NULL,0,0,1),(3800,'','Fernandes martins','helder33700@gmail.com','wW22k',NULL,NULL,0,0,1),(3801,'','Mme FRUCHARD Marylène','marylene.fruchard@orange.fr','55Mey',NULL,NULL,0,0,1),(3802,'','Ramon Jérôme ','ramon.jerome@orange.fr','Qbark',NULL,NULL,1,0,1),(3803,'','Ducousso','ericducousso@hotmail.com','pNE1g',NULL,NULL,1,0,1),(3804,'','coquelle','coquelle.arnaud@wanadoo.fr','leAhj',NULL,NULL,1,0,1),(3805,'','SANTAOLALLA Michel','mdsanta@wanadoo.fr','8qU8w',NULL,NULL,0,0,1),(3806,'','jouandoudet','l.jouandoudet@gmail.com','dpCNd',NULL,NULL,0,0,1),(3807,'','jacky TERRASSON','Jacky.terrasson@oenov.com','m5LiR',NULL,NULL,0,0,1),(3808,'','Jouberteix alice','lyly_33230@hotmail.fr','aqN97',NULL,NULL,1,0,1),(3809,'','Laurent coupe','lescoupe@gmail.com','AAhhZ',NULL,NULL,0,0,1),(3810,'','Pagès Gladys','gladys.gladys@icloud.com','vVNJ4',NULL,NULL,0,0,1),(3811,'','VOOGT','coach-immo@outlook.com','cDD2c',NULL,NULL,0,0,1),(3812,'','Raimbeau','marie.raimbeau@orange.fr','NlAje',NULL,NULL,1,0,1),(3813,'','JERONNE','vincentjeronne@free.fr','V8P8N',NULL,NULL,1,0,1),(3814,'','Marc Brieu','Brieumarc@gmail.com','LdMTQ',NULL,NULL,1,0,1),(3815,'','gardet','sylvain.gardet@gmail.com','TgHKn',NULL,NULL,0,0,1),(3816,'','Coiffard','depmatth@gmail.com','GDBdF',NULL,NULL,1,0,1),(3817,'','RAFFAUD ','julien.raffaud@hotmail.ff','AdZIi',NULL,NULL,1,0,1),(3818,'','Lanfry','DARTH_ANTHONY@HOTMAIL.FR','WSnAm',NULL,NULL,0,0,1),(3819,'','Lalanne','plsmarketingproducts@gmail.com','eUnIR',NULL,NULL,1,0,1),(3820,'','MARTIN DOMINIQUE ','dominique.martin33@hotmail.fr','9rc1I',NULL,NULL,1,0,1),(3821,'','ZERBIB','samuel.zerbib@free.fr','1DuX7',NULL,NULL,0,0,1),(3822,'','Eric TROESTLER','eric.troestler@finances.gouv.fr','oYUTD',NULL,NULL,0,0,1),(3823,'','APPAULE ERIC','eric.appaule@wanadoo.fr','mR5Tr',NULL,NULL,1,0,1),(3824,'','Berthalln','nberthalon@gmail.com','gpM1x',NULL,NULL,1,0,1),(3825,'','baudry','celine.baudry@carced.fr','28MT5',NULL,NULL,1,0,1),(3826,'','Julien','axel-bujade-julien@hotmail.fr','zUqki',NULL,NULL,1,0,1),(3827,'','MOULIN','JORDAN_moulin@yahoo.com','xdy1E',NULL,NULL,0,0,1),(3828,'','Sabrina Auger','sabrina_c_33@hotmail.com','R9rWU',NULL,NULL,1,0,1),(3829,'','sancerni','nadia.sancerni@orange.fr','SccMB',NULL,NULL,1,0,1),(3830,'','Martin','em@reaminvest.fr','Tp6Gi',NULL,NULL,0,0,1),(3831,'','NATHALIE COLIN ','nathalie.colin@swarovski.com','zZmYD',NULL,NULL,0,0,1),(3832,'','LASLAH','momo.1207@live.fr','Hxs8L',NULL,NULL,0,0,1),(3833,'','Pereira','amelie-et-gaetan@hotmail.fr','78YLv',NULL,NULL,1,0,1),(3834,'','beaux','elomaxfamily@gmail.com','rlph6',NULL,NULL,0,0,1),(3835,'','Beatrice Beatrice Revidi','b.ares@hotmail.fr','UDQSH',NULL,NULL,0,0,1),(3836,'','Gidonet','gidonet@orange.fr','FRgh8',NULL,NULL,0,0,1),(3837,'','Normandin ','sebnormandin@gmail.com','raIh1',NULL,NULL,0,0,1),(3838,'','Yvon Bruyez','yvon.bruyez@orange.fr','p8weh',NULL,NULL,0,0,1),(3839,'','Stéphane Crevot','s.crevot@gmail.com','zmbMX',NULL,NULL,0,0,1),(3840,'','Stanislas Bouchaud','stan.bouchaud@gmail.com','hB84y',NULL,NULL,0,0,1),(3841,'','Claudia Tierney-Hancock','tierney.claudia@orange.fr','AmeZJ',NULL,NULL,0,0,1),(3842,'','Rousselin','corwin33240@outlook.fr','OrVCf',NULL,NULL,0,0,1),(3843,'','Burret ','fabienne.burret@orange.fr','4amCl',NULL,NULL,1,0,1),(3844,'','Tony DALMOLIN','t.dalmolin@gmail.com','6rp5l',NULL,NULL,0,0,1),(3845,'','DAGES','alexandredages@gmail.com','JSznh',NULL,NULL,0,0,1),(3846,'','Beaucourt','chipoune89@free.fr','1D554',NULL,NULL,0,0,1),(3847,'','Christophe Laquey','krisangel@orange.fr','A5HMB',NULL,NULL,1,0,1),(3848,'','Beausoleil Christelle','beausoleil.christelle@orange.fr','7uxug',NULL,NULL,1,0,1),(3849,'','MILLEPIED Patricia','patricia.millepied@laposte.net','UVEU5',NULL,NULL,1,0,1),(3850,'','DOS SANTOS','zerty33100@hotmail.fr','NtOnA',NULL,NULL,1,0,1),(3851,'','SABLE','estelles33@yahoo.fr','i07S6',NULL,NULL,1,0,1),(3852,'','JEROME WEBER','jerome.wbr@gmail.com','QUoEx',NULL,NULL,0,0,1),(3853,'','valerie leclerc','valeriele1@hotmail.com','ZCu9Z',NULL,NULL,0,0,1),(3854,'','jean-maxime cacheux','cacheuxjm@gmail.com','ZXBG2',NULL,NULL,1,0,1),(3855,'','ruban','ruban.commercial01@gmail.com','NxdTS',NULL,NULL,1,0,1),(3856,'','LAMOURE','joanes.lamoure@gmail.com','Wf1Vj',NULL,NULL,0,0,1),(3857,'','lasserre','jonathan.g141@orange.fr','npMXq',NULL,NULL,1,0,1),(3858,'','schwein arnaud','arnaud.schwein@knauf.fr','aJNzQ',NULL,NULL,1,0,1),(3859,'','Stephane Exbrayat','ste27b@yahoo.com','5MHo6',NULL,NULL,1,0,1),(3860,'','GERAUDIN','vincentgrd@hotmail.com','Fk832',NULL,NULL,1,0,1),(3861,'','Arno-Pons Philippe','philippe.ap@free.fr','61FsS',NULL,NULL,0,0,1),(3862,'','Chavaneau','chavaneau.patricia@gmail.com','sQS45',NULL,NULL,1,0,1),(3863,'','Branco','jemcars.eb@gmail.com','A63Lt',NULL,NULL,1,0,1),(3864,'','VIVIANNE DE RIDDER','vivianne.deridder@gmail.com','ewf6N',NULL,NULL,0,0,1),(3865,'','Jankowiak','alexandrejanko@yahoo.fr','ew7Gt',NULL,NULL,0,0,1),(3866,'','Boch','boch.fiona@yahoo.com','uZdg3',NULL,NULL,1,0,1),(3867,'','Gabillet Éric','ristechalou@gmail.com','qp3L4',NULL,NULL,1,0,1),(3868,'','maisonneuve','nicolasmaisonneuve1@gmail.com','nnJut',NULL,NULL,1,0,1),(3869,'','Cheron','cheron.isabelle73@hotmail.com','E91rK',NULL,NULL,1,0,1),(3870,'','KHATTABI','betharram.l@gmail.com','Sp0j2',NULL,NULL,1,0,1),(3871,'','Faliere','faliere.audrey@orange.fr','6PpHi',NULL,NULL,0,0,1),(3872,'','petit cedric','cedric.petit33@orange.fr','5Cp2u',NULL,NULL,1,0,1),(3873,'','rousselle','nicolas.rousselle@gmail.com','8yXXQ',NULL,NULL,0,0,1),(3874,'','ANCELIN','ancelin.guillaume@gmail.com','JThWB',NULL,NULL,0,0,1),(3875,'','Nikolay Karailiev','nkarailiev@gmail.com','7RTI3',NULL,NULL,1,0,1),(3876,'','ANGER','tanger@naviland-cargo.com','14fbG',NULL,NULL,0,0,1),(3877,'','REY','schrey@hotmail.fr','lfnNx',NULL,NULL,0,0,1),(3878,'','frances','ced.fran@orange.fr','fvG7M',NULL,NULL,1,0,1),(3879,'','EDMOND','david.edmond57@orange.fr','0KyB1',NULL,NULL,1,0,1),(3880,'','Benoit Le Pottier','blpottier@aviagen.com','UN72Y',NULL,NULL,1,0,1),(3881,'','BARRIERE','thomas.barriere@me.com','9ZPa6',NULL,NULL,0,0,1),(3882,'','PHILIPPE MIRAMON','phil.miramon@gmail.com','ZDSnV',NULL,NULL,0,0,1),(3883,'','Hilarion','hilarionjulien@yahoo.fr','MHUxp',NULL,NULL,1,0,1),(3884,'','lavigne ','jcl33@orange.fr','V4Dru',NULL,NULL,1,0,1),(3885,'','TERPEREAU Olivier','oterpereau@free.fr','KQhUQ',NULL,NULL,0,0,1),(3886,'','Boucif','rboucif@hotmail.com','vAqhz',NULL,NULL,0,0,1),(3887,'','Colin ','zinebbx@hotmail.fr','d2BqN',NULL,NULL,1,0,1),(3888,'','claire le r','clrbernard33@gmail.com','smNm8',NULL,NULL,0,0,1),(3889,'','Yohan Roche','Yohan77178@live.fr','pAXWJ',NULL,NULL,0,0,1),(3890,'','Sophie Durand','sophie@wholesaler-website.com','eSdmw',NULL,NULL,0,0,1),(3891,'','Beaudrier','beaudrier.cc@hotmail.fr','KeiQ9',NULL,NULL,1,0,1),(3892,'','Letard','letard.vianney@laposte.net','fUNJX',NULL,NULL,0,0,1),(3893,'','Wasilewski','melaniewasilewski@free.fr','AAboR',NULL,NULL,0,0,1),(3894,'','BENOIT','i.architecture.franckbenoit@gmail.com','8Y2G4',NULL,NULL,1,0,1),(3895,'','angelique ALEXANDRE','angelique.alexandre0211@orange.fr','mbsnH',NULL,NULL,1,0,1),(3896,'','Aurelie TOLEDO','Aurelietg4@gmail.com','iPZHr',NULL,NULL,0,0,1),(3897,'','Reverra ','kukai33450@hotmail.fr','RGaDa',NULL,NULL,0,0,1),(3898,'','TROUILH','scidusoleil33@gmail.com','goxXS',NULL,NULL,0,0,1),(3899,'','Tellus','thierry.tel@gmail.com','MLA08',NULL,NULL,1,0,1),(3900,'','pierrick grou','pierrick.grou@gmail.com','zmwPF',NULL,NULL,1,0,1),(3901,'','Dabadie ','Golhiat33333@yahoo.com','FkL0D',NULL,NULL,0,0,1),(3902,'','Bornazeau','anthonybornazeau@gmail.com','xYFKL',NULL,NULL,0,0,1),(3903,'','Christophe Legrand','kris.legrand@gmail.com','Vkf8z',NULL,NULL,0,0,1),(3904,'','MEUNIER','patsg57@gmail.com','0od20',NULL,NULL,0,0,1),(3905,'','AVILA','al1312@msn.com','YZn3a',NULL,NULL,1,0,1),(3906,'','Haddad','celinou459@hotmail.com','eadUR',NULL,NULL,1,0,1),(3907,'','RHARBI ','rajaerharbi@hotmail.fr','zVqJS',NULL,NULL,0,0,1),(3908,'','Boiteux Jean jacques ','jjboiteux@gmail.com','GvgxK',NULL,NULL,0,0,1),(3909,'','HENNEQUIN Audrey','hennequin.audrey@gmail.com','S00pe',NULL,NULL,0,0,1),(3910,'','seureau nicolas','nseureau@yahoo.fr','6fUoV',NULL,NULL,0,0,1),(3911,'','Laronze','nolwenn421@hotmail.fr','pnxqv',NULL,NULL,0,0,1),(3912,'','SAYOUS Yoann','sayous.yoann@laposte.net','8Vy9O',NULL,NULL,0,0,1),(3913,'','LOBATO FORT','CALIFORNIE1964@GMAIL.COM','XLa4G',NULL,NULL,0,0,1),(3914,'','Michel Cecile','cecile.michel86@gmail.com','0SZbR',NULL,NULL,0,0,1),(3915,'','JACQUETON  Philippe','philippe.jacqueton@orange.fr','DjkuJ',NULL,NULL,1,0,1),(3916,'','VANDEWALLE','davan1754@gmail.com','26JUd',NULL,NULL,1,0,1),(3917,'','Palmeiro','elena.palmeiro@yahoo.fr','Cw0l1',NULL,NULL,1,0,1),(3918,'','Nassera Essafi','nassessafi1973@gmail.com','POM23',NULL,NULL,1,0,1),(3919,'','Pitoux','jerome.pitoux@orange.fr','CARsp',NULL,NULL,0,0,1),(3920,'','stephane lalande','lalande4@yahoo.fr','o1NYy',NULL,NULL,1,0,1),(3921,'','Rivoire alain','rivoire.alain@wanadoo.fr','lctsx',NULL,NULL,0,0,1),(3922,'','Leroy ','jjchleroy@aol.com','1SAB2',NULL,NULL,1,0,1),(3923,'','peret','julien.rodela@gmail.com','b1arh',NULL,NULL,0,0,1),(3924,'','JOSEPH','karynjoseph@yahoo.fr','w0bj7',NULL,NULL,0,0,1),(3925,'','Nennig','nennig.j@hotmail.fr','Yl70t',NULL,NULL,0,0,1),(3926,'','mercier','mamercier78@gmail.com','H197d',NULL,NULL,0,0,1),(3927,'','Trabut-Cussac Catherine ','catherinelescoul@gmail.com','4oxJk',NULL,NULL,0,0,1),(3928,'','Gwénaelle cudennec','gwenaellecudennec@laposte.net','LNxDd',NULL,NULL,0,0,1),(3929,'','Joelle Leyat Wicki','jleyat@hotmail.com','LFOlu',NULL,NULL,0,0,1),(3930,'','Lafuente','lafuente.lydia@orange.fr','4g9uz',NULL,NULL,1,0,1),(3931,'','pascal gauvin','gauvinpascal33@live.fr','9XMaU',NULL,NULL,1,0,1),(3932,'','virginie laulhere','virginie@laulhere.com','wQthc',NULL,NULL,0,0,1),(3933,'','LEDRU ','thledru@yahoo.fr','cbi1N',NULL,NULL,1,0,1),(3934,'','Laurence Blanchard-Pelletier','blanchardpelletier@orange.fr','KHupQ',NULL,NULL,0,0,1),(3935,'','Blachon Aurelie','aurelieb0412@yahoo.fr','fqnDn',NULL,NULL,1,0,1),(3936,'','Mistral ','amistralbernard@yahoo.fr','ZHz6H',NULL,NULL,0,0,1),(3937,'','ROLLAND','privilege33@gmail.com','WhMya',NULL,NULL,1,0,1),(3938,'','bastien raiton','bastien.raiton@gmail.com','KDScI',NULL,NULL,1,0,1),(3939,'','Vigneaud','s.vigneaud@hotmail.fr','oTP8r',NULL,NULL,1,0,1),(3940,'','DIAS','kleverton08@hotmail.fr','dyzjl',NULL,NULL,0,0,1),(3941,'','GUILLEMIN','guillemin.cedric6433@gmail.com','8T6Fv',NULL,NULL,0,0,1),(3942,'','Jean Claude MASSONNET','jc.massonnet@gmail.com','gqU4k',NULL,NULL,0,0,1),(3943,'','Rodolphe Lombard','rodolphe.lombard@free.fr','vFTc8',NULL,NULL,1,0,1),(3944,'','Marie','marie.modesty@gmail.com','yr1ED',NULL,NULL,0,0,1),(3945,'','simone Gélin','simone.gelin33@gmail.com','q8663',NULL,NULL,0,0,1),(3946,'','Lavaud','emc13@hotmail.fr','ykr43',NULL,NULL,0,0,1),(3947,'','GHIRARD','ghirard.mp@orange.fr','0TkFL',NULL,NULL,1,0,1),(3948,'','Jean-Pierre ROUXEL','jean-pierre.rouxel0633@orange.fr','Ngek8',NULL,NULL,1,0,1),(3949,'','Eric Lussiez','elussiez@yahoo.fr','TO3A9',NULL,NULL,1,0,1),(3950,'','Facao','contact@oquatic.fr','iRYAd',NULL,NULL,0,0,1),(3951,'','LEONARD STÉPHANIE','elwest@orange.fr','fOsXf',NULL,NULL,0,0,1),(3952,'','Larroze charly','teodhen@gmail.com','dAo4m',NULL,NULL,1,0,1),(3953,'','Perrine GUICHOUX AUROUSSEAU','perrine.aurousseau@hotmail.fr','dSFxu',NULL,NULL,0,0,1),(3954,'','Despaux','guilotela@orange.fr','nmnJD',NULL,NULL,1,0,1),(3955,'','PATRICIA GAUTIER','plac.gautier@laposte.net','RWFKo',NULL,NULL,0,0,1),(3956,'','Pepin Martine ou Thierry Philipperon','martinepepin42@gmail.com','eJHCE',NULL,NULL,1,0,1),(3957,'','hemmerlin','hemmerlinmel@gmail.com','rb35X',NULL,NULL,1,0,1),(3958,'','DE malet','demalet.guillaume@sfr.fr','DvGaa',NULL,NULL,1,0,1),(3959,'','Mario GUEDES','zemario.guedes@gmail.com','gLOHb',NULL,NULL,1,0,1),(3960,'','MAXIME SERRI','maxime_serri@hotmail.fr','n2R8j',NULL,NULL,1,0,1),(3961,'','baeza','didier.baeza@spiebatignolles.fr','T8JuT',NULL,NULL,1,0,1),(3962,'','Bertrand LOUPY','bertrand.loupy@gmail.com','zhdqh',NULL,NULL,0,0,1),(3963,'','Launois ','launois.v@gmail.com','uXwYD',NULL,NULL,1,0,1),(3964,'','Babin ','babinsy@wanadoo.fr','gjoVF',NULL,NULL,1,0,1),(3965,'','Metayer','f.metayer@numericable.fr','CCewe',NULL,NULL,1,0,1),(3966,'','boudout','smillyfr@gmail.com','oudsS',NULL,NULL,1,0,1),(3967,'','Pomier','lileau17@gmail.com','jh2to',NULL,NULL,1,0,1),(3968,'','guillerminet guillaume','guillaume.guillerminet@yahoo.fr','sc798',NULL,NULL,0,0,1),(3969,'','RATTAT','jerome.rattat@gmail.com','607Qx',NULL,NULL,1,0,1),(3970,'','Carlier','carlierjy@yahoo.fr','McVHB',NULL,NULL,0,0,1),(3971,'','Georges Attal','gattal@publipole.fr','l2pu5',NULL,NULL,0,0,1),(3972,'','fontenaud','ericfontenaud@corpsetames.fr','RXx1o',NULL,NULL,1,0,1),(3973,'','lamoise','jeremy.lamoise@gmail.com','4xhBi',NULL,NULL,1,0,1),(3974,'','LABAT','brunolabat33@gmail.com','b8H3p',NULL,NULL,0,0,1),(3975,'','MEUNIER','jezab5560@gmail.com','JjfSy',NULL,NULL,1,0,1),(3976,'','BAZAS Patrice','marieetpat.bazas@orange.fr','dOGFW',NULL,NULL,1,0,1),(3977,'','AZEMA','bernard_azema@orange.fr','ERVgg',NULL,NULL,1,0,1),(3978,'','PINOCHAPITO','sebpinault@sfr.fr','TZeG3',NULL,NULL,1,0,1),(3979,'','Puyo','b.puyo@avenir-renovations.fr','0jxpc',NULL,NULL,1,0,1),(3980,'','DUBO Damien','divyxe@gmail.com','bYXGm',NULL,NULL,1,0,1),(3981,'','OEUVRAY','cyril_oeuvray@keysight.com','CYUJV',NULL,NULL,0,0,1),(3982,'','Valdre Julie','julie.valdre@gmail.com','QYG5h',NULL,NULL,0,0,1);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goldbook`
--

DROP TABLE IF EXISTS `goldbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goldbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `nom` varchar(250) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `online` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goldbook`
--

LOCK TABLES `goldbook` WRITE;
/*!40000 ALTER TABLE `goldbook` DISABLE KEYS */;
INSERT INTO `goldbook` VALUES (13,'2021-02-20 00:00:00','XAVIER GONZALEZ','zalez@gmail.com','Très sérieux très compétant je recommande !',1);
/*!40000 ALTER TABLE `goldbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `date_news` datetime NOT NULL,
  `titre` varchar(250) NOT NULL,
  `accroche` text DEFAULT NULL,
  `contenu` text DEFAULT NULL,
  `image1` varchar(250) DEFAULT NULL,
  `online` varchar(30) NOT NULL DEFAULT 'bleu',
  PRIMARY KEY (`id_news`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (2,'2015-10-02 00:00:00','Dordogne (24)','http://edenblue.fr/piscine-naturelle-bordeaux-gironde-dordogne-cezac-eden-blue-piscine-a-debordement-2/index.html','Piscine Miroir\r\nL’eau d’une piscine miroir déborde sur les côtés du bassin pour un effet visuel surprenant :\r\nla surface de l’eau et la plage de piscine sont au même niveau.','/21-2.jpg','1'),(3,'2015-10-02 00:00:00',' Dordogne (24)','','Voici l\'une de nos dernières réalisations (DORDOGNE)\r\n-Piscine miroir de 11.50 m  x 5.00 m avec un escalier Roman et plage Californienne.','/22-3.jpg','1'),(5,'2015-10-15 00:00:00','Saint Marie de Ré','http://edenblue.fr/piscine-naturelle-bordeaux-gironde-dordogne-cezac-eden-blue-piscine-a-debordement-2/index.html','Réalisation d\'un revêtement intérieur en enduit.','/Gautier-.jpg','1'),(6,'2015-10-15 00:00:00','Saint Marie de Ré','','Réalisation d\'un revêtement intérieur en enduit.','/gautier_1-.jpg','1'),(7,'2015-09-08 00:00:00','Blaye (33)','','Réalisation d\'une Piscine forme libre avec un revêtement intérieur en enduit.','/piscine_naturelle2-.jpg','1'),(8,'2015-12-01 00:00:00','Piscine couloir de nage ','http://edenblue.fr/piscine-beton-bordeaux-gironde-dordogne-cezac-eden-blue-couloir-de-nage-5/index.html','Labenne Océan (40)\r\n-Réalisation d\'une  couloir de nage de 20m x 3m.\r\n-Revêtement intérieur de la piscine en enduit. \r\n ','/couloir_de_nage_3-.jpg','1'),(9,'2015-12-01 00:00:00','Labenne Océan (40)','','-Réalisation d\'une  couloir de nage de 20m x 3m.\r\n-Revêtement intérieur de la piscine en enduit. ','/couloir_de_nage_4-.jpg','1'),(10,'2015-06-02 00:00:00','Medoc ( 33)','http://edenblue.fr/piscine-naturelle-bordeaux-gironde-dordogne-cezac-eden-blue-piscine-a-debordement-2/index.html','-Piscine de forme libre avec revêtement interieur en mosaïque et nettoyage intégré.','/piscine_en_forme_libre0-.jpg','0'),(12,'2015-03-02 00:00:00','Blaye (33)','','','/lolo_photos_031-.jpg','0'),(14,'2016-05-24 00:00:00','Magasin de produits Piscine et Spa  sur la commune de PEUJARD (33240)','https://www.facebook.com/edenbluepiscine/?ref=aymt_homepage_panel','Notre équipe est à votre disposition pour tous vos projets de construction de piscine \r\nainsi que le conseil et la vente de produits de traitements des eaux et d\'entretien de votre piscine.\r\n\r\n','/adresse_eden_blue2_copie-14.jpg','0'),(15,'2016-12-12 00:00:00','Dernière réalisation Piscine à débordement ( Latresne)','http://edenblue.fr/piscine-a-debordement-bordeaux-gironde-dordogne-cezac-eden-blue-construction-piscine-3/index.html','Construction d\'une piscine à débordement au Château Gassie sur la commune de LATRESNE 33360\r\nRéalisation d\'un revêtement intérieur en mosaïque.','/20160926_164757-.jpg','0'),(16,'2016-12-12 00:00:00','Dernière réalisation Piscine à débordement ( Latresne)','http://edenblue.fr/piscine-a-debordement-bordeaux-gironde-dordogne-cezac-eden-blue-construction-piscine-3/index.htm','Construction d\'une piscine à débordement au Château Gassie sur la commune de LATRESNE 33360\r\nRéalisation d\'un revêtement intérieur en mosaïque.','/Constructeur_de_piscine_d_bo-.jpg','1'),(17,'2016-12-12 00:00:00','Construction d\'une piscine à débordement ( Latresne ) 33000','http://edenblue.fr/piscine-a-debordement-bordeaux-gironde-dordogne-cezac-eden-blue-construction-piscine-3/index.htm','Construction d\'une piscine à débordement au Château Gassie sur la commune de LATRESNE 33360 Réalisation d\'un revêtement intérieur en mosaïque.','/construction_piscine_luxe_rev_t-.jpg','1'),(18,'2016-12-12 00:00:00','Construction d\'une piscine à débordement ( Latresne ) 33000','http://edenblue.fr/piscine-a-debordement-bordeaux-gironde-dordogne-cezac-eden-blue-construction-piscine-3/index.htm','Construction d\'une piscine à débordement au Château Gassie sur la commune de LATRESNE 33360 Réalisation d\'un revêtement intérieur en mosaïque.','/Construction_piscine_de_luxe_-.jpg','1'),(19,'2017-09-04 00:00:00','Dernière réalisation Piscine à débordement ( Latresne)','http://edenblue.fr/piscine-a-debordement-bordeaux-gironde-dordogne-cezac-eden-blue-construction-piscine-3/index.html','Construction d\'une piscine à débordement au Château Gassie sur la commune de LATRESNE 33360\r\nRéalisation d\'un revêtement intérieur en mosaïque.','/20170601_154216-.jpg','1'),(20,'2017-09-04 00:00:00','Dernière réalisation Piscine en béton armé monobloc ( Bordeaux)','http://edenblue.fr/piscine-a-debordement-bordeaux-gironde-dordogne-cezac-eden-blue-construction-piscine-3/index.html','','/Resized_20170811_141549_1_-.jpg','1'),(21,'2017-11-28 00:00:00','Piscine en béton armée monobloc','','','/piscine beton gironde-.jpg','1'),(22,'2019-02-01 00:00:00','Piscine interieur','','','/piscine interieur -.jpg','1'),(23,'2019-05-22 00:00:00','Venez decouvrir notre nouvelle gamme de SPAS ','','SHOWROOM DE 200M²\r\nNotre équipe est à votre disposition pour tous vos projets de construction de piscine & spa ainsi que le conseil et la vente de produits de traitements des eaux et d\'entretien.\r\n','/carte_vsite_copie - Copy 1-23.jpg','1');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `titre` varchar(250) DEFAULT NULL,
  `bas_page` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter`
--

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
INSERT INTO `newsletter` VALUES (1,'2015-05-27 00:00:00','Démarrez l\'été en fraicheur',' ');
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_detail`
--

DROP TABLE IF EXISTS `newsletter_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_newsletter` int(10) unsigned NOT NULL,
  `titre` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `texte` text DEFAULT NULL,
  `online` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`,`id_newsletter`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_detail`
--

LOCK TABLES `newsletter_detail` WRITE;
/*!40000 ALTER TABLE `newsletter_detail` DISABLE KEYS */;
INSERT INTO `newsletter_detail` VALUES (15,1,'La plage à la maison','/piscine_miroir-1.jpg','http://www.iconeo.fr/','Super construction en PROMO cet été !!\r\n\r\nfxfxhxvhx\r\nhxfhxhvx\r\nvxhxh\r\nxh\r\nvxhxvhxhxxvhxvfxfxxhx',NULL),(16,1,'','/www.edenblue.fr_23-1.jpg','http://www.edenblue.fr/','',NULL);
/*!40000 ALTER TABLE `newsletter_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_journal`
--

DROP TABLE IF EXISTS `newsletter_journal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_journal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_envoi` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_newsletter` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_journal`
--

LOCK TABLES `newsletter_journal` WRITE;
/*!40000 ALTER TABLE `newsletter_journal` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_journal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_journal_detail`
--

DROP TABLE IF EXISTS `newsletter_journal_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_journal_detail` (
  `id_newsletter_journal` int(11) unsigned NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `read` tinyint(4) NOT NULL DEFAULT 0,
  `coderandom` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `error` varchar(250) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_journal_detail`
--

LOCK TABLES `newsletter_journal_detail` WRITE;
/*!40000 ALTER TABLE `newsletter_journal_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_journal_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test` varchar(244) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-28 12:06:49
