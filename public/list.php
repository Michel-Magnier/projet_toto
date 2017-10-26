<?php
require_once __DIR__.'/../inc/config.php';
// Ceci est le code de public/list.php
// Je recupére la liste des étudiants

$selectStudents="
    SELECT student.stu_id,
        student.stu_lastname,
        student.stu_firstname,
        student.stu_email,
        student.stu_birthdate
    FROM student
";
//debug echo $selectStudents;
$pdoStatement = $pdo->query($selectStudents);
if($pdoStatement === false){
    print_r($pdo->errorInfo());
}
// Récupération des résultats
$resultatStudents = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
//debug echo "<pre>";
//debug print_r($resultatStudents);
//debug echo "</pre>";

require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/list.php';
require_once __DIR__.'/../view/footer.php';
?>
