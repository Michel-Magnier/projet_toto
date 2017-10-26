<?php
require_once __DIR__.'/../inc/config.php';

// code de public/student.php
print_r($_GET);
$student_Id = $_GET['student'];
echo "<br><br><br><br><br><br>{$_GET['student']}<br>";


// Je recupére les détails d'un étudiant

$selectStudent="
    SELECT student.stu_id,
        student.stu_lastname,
        student.stu_firstname,
        student.stu_email,
        student.stu_birthdate
    FROM student
";
//debug echo $selectStudents;
$pdoStatement = $pdo->query($selectStudent);
if($pdoStatement === false){
    print_r($pdo->errorInfo());
}
// Récupération des résultats
$resultatStudents = $pdoStatement->fetch(PDO::FETCH_ASSOC);
//debug echo "<pre>";
//debug print_r($resultatStudents);
//debug echo "</pre>";




require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/student.php';
require_once __DIR__.'/../view/footer.php';
?>
