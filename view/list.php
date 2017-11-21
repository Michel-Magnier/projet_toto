<h3>Liste des étudiants</h3>
<h2><?= $resultatRecherche ?></h2>
<?php if ($page == 1){
    echo "[Précedent]";
}else{
    echo "<a href='list.php?page=".($page-1)."&recherche=".$recherche."'>[Précedent]</a>";
} ?>


&nbsp;[Page <?= $page ?>]&nbsp;
<a href="list.php?page=<?= $page+1 ?>&recherche=<?= $recherche ?>">[Suivant]</a>
<br><br>
<div id="popupStudent">
    <div id="afficherDetailEtudiant">
    </div>
    <a href="" id="fermerEtudiant">[Fermer]</a>
</div>
<table border="1">
    <tr>
        <th>
            ID
        </th>
        <th>
            Nom
        </th>
        <th>
            Prénom
        </th>
        <th>
            Email
        </th>
        <th>
            Date de naissance
        </th>
        <th>
            Plus d'infos
        </th>
    </tr>
    <?php foreach ($resultatStudents as $key => $value)  : ?>
        <tr>
            <td>
                <?= $resultatStudents[$key]['stu_id']; ?>
            </td>
            <td>
                <?= $resultatStudents[$key]['stu_lastname']; ?>
            </td>
            <td>
                <?= $resultatStudents[$key]['stu_firstname']; ?>
            </td>
            <td>
                <?= $resultatStudents[$key]['stu_email']; ?>
            </td>
            <td>
                <?= $resultatStudents[$key]['stu_birthdate']; ?>
            </td>
            <td>
                <a class="lienStudent" href="student.php?student=<?= $resultatStudents[$key]['stu_id']; ?>" data-id ="<?= $resultatStudents[$key]['stu_id']; ?>">Plus d'infos</a>
            </td>
        </tr>
    <?php endforeach ?> <!-- fin d'une ligne de la liste des étudiants -->
</table>
