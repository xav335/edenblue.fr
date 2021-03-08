<?php

if ($_SERVER[ "SERVER_NAME" ] == "edenblue.localxav.lan") {
    define("DBHOST", "localhost");
    define("DBNAME", "edenblue");
    define("DBUSER", "edenblue");
    define("DBPASSWD", "edenblue33");
} elseif ($_SERVER[ "SERVER_NAME" ] == "edenblue.iconeo.fr") {
    define("DBHOST", "localhost");
    define("DBNAME", "edenblue");
    define("DBUSER", "edenblue");
    define("DBPASSWD", "edenblue33");
} else {
    define("DBHOST", "localhost");
    define("DBNAME", "edenblue");
    define("DBUSER", "edenblue");
    define("DBPASSWD", "edenblue33");
}



// CONSTANTES CONSTANTES CONSTANTES CONSTANTES CONSTANTES CONSTANTES CONSTANTES CONSTANTES
$tva = 0.2;
// Frais de livraison par defaut
$totalLiv = 10; //frais de livraison TTC

$mailCustomer = "fjavi.gonzalez@gmail.com";
$mailNameCustomer = "EdenBlue";
$urlSiteDefault = "http://www.edenblue.fr/";
$facebookLink = "https://www.facebook.com/edenbluepiscine";

//mail d'envoi
//$mailContact = "fjavi.gonzalez@gmail.com";
$mailContact = "fjavi.gonzalez@gmail.com";
$mailBcc = "fjavi.gonzalez@gmail.com,xav335@hotmail.com,xavier.gonzalez@laposte.net,jav_gonz@yahoo.com";
//$mailBcc = "edenblue33@gmail.com,fjavi.gonzalez@gmail.com";
