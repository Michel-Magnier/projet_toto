<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $htmlContent, $textContent=''){
    global $config; // Je récupère les infos qui ont été définies dans config.php
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $config['EMAIL_HOST'];  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $config['EMAIL_USERNAME'];                 // SMTP username
        $mail->Password = $config['EMAIL_PASSWORD'];                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Add this if you SMTP to gmail
        $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
        );

        //Recipients
        $mail->setFrom('michel.r.magnier@gmail.com', 'Michel Magnier');
        $mail->addAddress($to, $to);     // Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $htmlContent;
        $mail->AltBody = $textContent;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } // fin du catch de la fonction sendEmail($to, $subjet, $htmlContent, $textContent='')
} // fin de la fonction sendEmail($to, $subjet, $htmlContent, $textContent='')



/*
// L'email saisi existe-t-il déjà dans la table user ?
$sqlSelect = "
    SELECT user.usr_email
    FROM user
    WHERE user.usr_email = '{$email}';
";
echo "<br>Requête SELECT pour voir si l'email existe déjà dans la table user<br>{$sqlSelect}<br>";
$pdoStatement = $pdo->query($sqlSelect);
if($pdoStatement === false){
    print_r($pdo->errorInfo());
}
// Récupération des résultats
$resultatUniciteEmail = $pdoStatement->fetch(PDO::FETCH_ASSOC);
echo "Voici le résultat de la verification de l'unicité de l'email :<pre>";
print_r($resultatUniciteEmail);
echo "</pre>";
if(!empty($resultatUniciteEmail)){
    $messageErreur .= "<br>Cet email est déjà utilisé.<br>";
    $formOk = false;
} // fin de la vérification si l'email existe déjà
*/

function getIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}



?>
