<?php

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
