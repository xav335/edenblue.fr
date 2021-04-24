<?php require_once '../inc/inc.config.php';?>
<?php

require '../admin/classes/Goldbook.php';
require '../admin/classes/Contact.php';
require '../admin/classes/utils.php';
session_start();

$goldbook = new Goldbook();
$contact = new Contact();

error_log(date("Y-m-d H:i:s") . " : ----GOLDBOOK---- \n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") . " : " . $_POST['datepicker'] . "\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") . " : " . $_POST['nom'] . "\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") . " : " . $_POST['prenom'] . "\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") . " : " . $_POST['email'] . "\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") . " : " . $_POST['message'] . "\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") . " : " . $_POST['action'] . "\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") . " : " . $_POST['newsletter'] . "\n", 3, "../log/spy.log");


if ($_POST[ "action" ] == "sendMail") {
    try {
        $_POST['name'] = $_POST['prenom'].' '.$_POST['nom'] ;
        $result = $goldbook->goldbookAdd($_POST);
        $goldbook = null;
        // Ajout dans contact pour la newsletter
        $result1 = $contact->contactGetByEmail($_POST['email']);
        // si l'email existe en base on y touche pas ...
        // TODO: mettre à jour l'inscription a newsletter
        $_POST['name'] = $_POST['nom'] ;
        $_POST['firstname'] = $_POST['prenom'] ;
        if (empty($result1)) {
            $_POST['fromgoldbook'] = 'on';
            $contact->contactAdd($_POST);
            $contact = null;
        }
    } catch (Exception $e) {
        error_log(date("Y-m-d H:i:s") . " Erreur: " . $e->getMessage() . "\n", 3, "../log/spy.log");
        exit();
    }
    
    $_to = ( MAIL_TEST != '' )
    	? MAIL_TEST
    	: MAIL_CONTACT;
    $sujet = MAIL_NAME_CUSTOMER . " - Nv message Livre d'or ";
    // echo "Envoi du message à " . $_to . "<br>";
    
    $entete = "From:" . MAIL_NAME_CUSTOMER . " <" . MAIL_CUSTOMER . ">\n";
    $entete .= "MIME-version: 1.0\n";
    $entete .= "Content-type: text/html; charset= utf-8\n";
    $entete .= "Bcc: " . MAIL_BCC . "\n";
    
    $corps = "";
    $corps .= "Bonjour,<br><br>";
    $corps .= "Nv message pour le livre d'or de :<br><b>" . utf8_decode( $_POST[ "name" ] ) . " " . "</b> (" . $_POST[ "email" ] . ")<br><br>";
    $corps .= "<b>Message :</b><br>";
    $corps .= utf8_decode( $_POST[ "message" ] ) . "<br><br>";
    $corps = utf8_encode( $corps );
    // echo $corps . "<br>";
    
    // Envoi des identifiants par mail
    mail($_to, $sujet, stripslashes($corps), $entete);
    
    error_log(date("Y-m-d H:i:s") . " : Message envoyé ! \n", 3, "../log/spy.log");
} else {
    error_log(date("Y-m-d H:i:s") . " : Message NON envoyé ! \n", 3, "../log/spy.log");
}
error_log(date("Y-m-d H:i:s") . " xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx  \n", 3, "../log/spy.log");
?>