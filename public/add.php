<?php

require_once __DIR__.'/../inc/config.php';

// Verification autorisation
if ($_SESSION['role'] !== 'admin'){
    header("Location: forbidden.php");
} // fin de la verification de l'autorisation

// code de public/add.php

$lastName="";
$firstName="";
$birthDate="";
$email="";
$sympathie="";
$session="";
$ville="";

// Je vais chercher la liste des sessions possibles
$sqlSessions = "
    SELECT DISTINCT session.ses_number
    FROM session
    ORDER BY session.ses_number ASC;
";
$pdoStatement = $pdo->query($sqlSessions);
if($pdoStatement === false){
    print_r($pdo->errorInfo());
}
// Récupération des résultats des sessions existantes
$resultatSessions = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

// Je vais chercher la liste des noms de villes
$sqlVilles = "
    SELECT DISTINCT city.cit_id, city.cit_name
    FROM city
    ORDER BY city.cit_name ASC;
";
$pdoStatement = $pdo->query($sqlVilles);
if($pdoStatement === false){
    print_r($pdo->errorInfo());
}
// Récupération des résultats des noms de villes
$resultatVilles = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/add.php';
require_once __DIR__.'/../view/footer.php';
?>
