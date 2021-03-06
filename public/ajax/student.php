<?php
require_once __DIR__.'/../../inc/config.php';

// code de public/student.php
$student_Id = $_POST['student'];

// Je recupére les détails d'un étudiant
$selectStudent="
    SELECT student.stu_id,
        student.stu_lastname,
        student.stu_firstname,
        student.stu_email,
        student.stu_birthdate,
        city.cit_name,
        student.stu_friendliness,
        session.ses_number,
        training.tra_name
    FROM student
    INNER JOIN city ON student.city_cit_id = city.cit_id
    INNER JOIN session ON student.session_ses_id = session.ses_id
    INNER JOIN training on session.training_tra_id = training.tra_id
    WHERE student.stu_id = {$student_Id}
    LIMIT 1;
";

$pdoStatement = $pdo->query($selectStudent);
if($pdoStatement === false){
    print_r($pdo->errorInfo());
}
// Récupération des résultats
$resultatStudent = $pdoStatement->fetch(PDO::FETCH_ASSOC);

require_once __DIR__.'/../../view/student.php';
?>
