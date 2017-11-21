console.log("On est dans js/script.js");
$(function(){
    console.log("JQuery chargé.");

    $('.lienStudent').on('click', function(monEvent) {
        monEvent.preventDefault();
        console.log('On a cliqué sur le lien de détail d un étudiant');
        var studentId = $(this).data('id'); // attribut data-id
        console.log(studentId);

        jQuery.ajax({
			url : 'ajax/student.php',
			method : 'POST',
            data : {
                student : $(this).data('id'),
            }
		}).always(function() {
			alert( "AJAX request completed on student.php" );
		}).fail(function() {
    		alert( "AJAX request completed and failed on student.php" );
		}).done(function(htmlToto) {
			alert('AJAX request completed and OK on student.php');
			console.log(htmlToto);
			$('#afficherDetailEtudiant').html(htmlToto);
            $('#popupStudent').show();
		}); // fin de la requête ajax

    }) // fin du click sur l'anchor de classe .lienStudent


    $('#fermerEtudiant').on('click', function(monEvent) {
        monEvent.preventDefault();
        console.log('On a fermé la popup du détail d un étudiant');
        $('#popupStudent').hide();
    }) // fin du click sur l'anchor qui a id #fermerEtudiant


    $('#formulaireAjoutEtudiant').on('submit', function(e) {
        e.preventDefault();
        alert('On a cliqué sur le bouton Ajout Etudiant');
        // Get all the forms inputs and their values in one step
        var mesValeurs = $(formulaireAjoutEtudiant).serialize(); // la chaine de caracteres mesValeurs contient "lnameToto=abc&fnameToto=def..."
        console.log(mesValeurs);

        jQuery.ajax({
            url : 'ajax/add.php',
            method : 'POST',
            dataType : 'text',
            data : $(formulaireAjoutEtudiant).serialize() // J'envoie ma chaine de caracteres qui ressemble à une query string qu'on met d'habitude dans l'url pour la récupérer en GET de l'autre côté.
        }).always(function() {
            alert( "AJAX request completed on add.php" );
        }).fail(function() {
            alert( "AJAX request completed and failed on add.php" );
        }).done(function(htmlToto) {
            alert('AJAX request completed and OK on add.php');
            console.log(htmlToto); // C'est ce qui est affiché dans signup.php
            $('div#retourAjoutEtudiant').html(htmlToto);
            if(htmlToto == 'retourEtudiantOK'){
                alert("L'étudiant a bien été ajouté.");
            }else{
                alert("L'étudiant n'a pas été ajouté.");
            }
        }); // fin de Jquery.ajax

    }); // fin de l'event submit du formulaire pour ajouter un étudiant


}); // fin de ma JQuery
