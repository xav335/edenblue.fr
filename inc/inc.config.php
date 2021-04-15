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

define( "MAIL_TEST", 			"" );				// Si vide alors les mails partent vers les bons destinataires!!!
define( "MAIL_CUSTOMER", 		"fjavi.gonzalez@gmail.com" ); //contact@edenblue.fr
define( "MAIL_NAME_CUSTOMER", 	"EdenBlue" );
define( "URL_SITE_DEFAULT", 	"http://www.edenblue.fr/" );
define( "FACEBOOK_LINK", 		"https://www.facebook.com/edenbluepiscine" );

// Mail d'envoi
define( "MAIL_CONTACT", "contact@lessecretsdelouise.com" );
define( "MAIL_BCC", 	"xav335@hotmail.com,fjavi.gonzalez@gmail.com,jav_gonz@yahoo.com" );