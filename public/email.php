<?php

require_once __DIR__.'/../inc/config.php';

$to = 'michelmagnier@free.fr';
$subject = 'Titre de l email';
$htmlContent = 'Corps du mail en <b>HTML</b>.';
$textContent = 'Corps du mail en texte pur.';
sendEmail($to, $subject, $htmlContent, $textContent='');

require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/email.php';
require_once __DIR__.'/../view/footer.php';
?>
