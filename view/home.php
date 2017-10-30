<h1>
    Home
</h1>
<p>
    présentation sommaire
</p>
<table border="1">
    <?php foreach ($tableauFinal as $index => $value) : ?>
        <tr>
            <th colspan="3">
                <?= $index ?>
            </th>
        </tr>
        <?php foreach ($value as $key2 => $value2): ?>
            <tr>
                <td>
                    Session <?= $value2['ses_number'] ?>
                </td>
                <td>
                    <?= $value2['ses_start_date'] ?>
                </td>
                <td>
                    <?= $value2['ses_end_date'] ?>
                </td>
            </tr>
        <?php endforeach; ?> <!-- fin de la boucle listant les sessions à l'intérieur d'un training -->
    <?php endforeach ?> <!-- fin de la boucle listant les trainings -->
</table>
