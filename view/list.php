<p>Je suis dans la page view/list.php</p>
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
            Détails
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
                <a href="student.php?student=<?= $resultatStudents[$key]['stu_id']; ?>">Détails</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>
