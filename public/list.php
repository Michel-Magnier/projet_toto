<?php
require_once __DIR__.'/../inc/config.php';
// Ceci est le code de public/list.php

// Vérification autorisation
if (isset($_SESSION['role'])){
    if (!(($_SESSION['role'] == 'user') || ($_SESSION['role'] == 'admin'))){
        header("Location : forbidden.php");
    }
}else{
    header("Location: signin.php");
} // fin de la vérification de l'autorisation

// Je résupére la recherche
$recherche = isset($_GET['recherche']) ? trim($_GET['recherche']) : '';
$selectCompteRecherche = "
    SELECT count(*) AS countRecherche
    FROM student
    INNER JOIN city ON student.city_cit_id = city.cit_id
    WHERE student.stu_lastname LIKE '%{$recherche}%'
    OR student.stu_firstname LIKE '%{$recherche}%'
    OR student.stu_email LIKE '%{$recherche}%'
    OR city.cit_name LIKE '%{$recherche}%'
";
$pdoStatement = $pdo->query($selectCompteRecherche);
if($pdoStatement === false){
    print_r($pdo->errorInfo());
}

// Récupération des résultats
$resultatCompteRecherche = $pdoStatement->fetch(PDO::FETCH_ASSOC);
$compteRecherche = $resultatCompteRecherche['countRecherche'];

// Je prépare l'affichage du résultat de la recherche
if(!empty($recherche)){
    $resultatRecherche = "{$compteRecherche} résultat(s) pour le mot \"{$recherche}\"";
}else{
    $resultatRecherche = "";
}

// Je récupére le numéro de page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1 ;
if ($page < 1){
    $page = 1;
}
$offset = ($page - 1) * 5;
if($offset < 0){
	$offset = 0;
};

// Je recupére la liste des étudiants, par tranche de 5 étudiants
$selectStudents="
    SELECT student.stu_id,
        student.stu_lastname,
        student.stu_firstname,
        student.stu_email,
        student.stu_birthdate,
        city.cit_name
    FROM student
    INNER JOIN city ON student.city_cit_id = city.cit_id
    WHERE student.stu_lastname LIKE '%{$recherche}%'
    OR student.stu_firstname LIKE '%{$recherche}%'
    OR student.stu_email LIKE '%{$recherche}%'
    OR city.cit_name LIKE '%{$recherche}%'
    LIMIT 5 OFFSET {$offset};
";
$pdoStatement = $pdo->query($selectStudents);
if($pdoStatement === false){
    print_r($pdo->errorInfo());
}
// Récupération des résultats
$resultatStudents = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/list.php';
require_once __DIR__.'/../view/footer.php';
?>
