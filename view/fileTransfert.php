<h1>Import d'un fichier <small>de type CSV sans entête</small></h1>
<form action="" method="POST" enctype="multipart/form-data">
	<fieldset>
		<input type="hidden" name="submitFile" value="import" />
		<label for="fileForm">Fichier</label>
		<input type="file" name="fileForm" id="fileForm" />
		<p>
			Uploader un fichier des étudiants au format CSV sans entête<br>Séparateur = ;
		</p>
		<br />
		<input type="submit" value="Importer sans entête" />
	</fieldset>
</form>

<h1>Import d'un fichier <small>de type CSV avec entête</small></h1>
<form action="" method="POST" enctype="multipart/form-data">
	<fieldset>
		<input type="hidden" name="submitFile" value="importheader" />
		<label for="fileForm">Fichier</label>
		<input type="file" name="fileForm" id="fileForm" />
		<p>
			Uploader un fichier des étudiants au format CSV avec entête<br>Séparateur = ;
		</p>
		<br />
		<input type="submit" value="Importer avec entête" />
	</fieldset>
</form>

<h1>Export de la liste des étudiants <small>vers le fichier export-20171106.csv</small></h1>
<form action="" method="POST" enctype="multipart/form-data">
	<fieldset>
		<input type="hidden" name="submitFile" value="export" />
		<p>
			Exporter la liste des étudiants vers le fichier export-20171106.csv au format CSV sans entête<br>Séparateur = ;
		</p>
		<br />
		<input type="submit" value="Exporter" />
	</fieldset>
</form>
