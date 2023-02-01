//Fonction qui va récupérer les mots entrés dans la barre de recherche
// et les poster pour que ArticleManager puisse les récupérer
// cette fonction appelle une route en méthode "post"
function rechercheArticlesParMotsClefs(recherche) {
    $.post('/article/searchByWords/', {
        recherche: recherche.trim()
    }).done(function( data ) {
        if (data != null) {
            $('.resultByWords').html(data);
        }
        else {
            this.style.borderRadius = '15px';
            $('.resultByWords').html('');
        }
    });
}


//Création de l'évènement keyup pour la barre de recherche par mots clefs
$('#searchByWords').on('keyup', (evt) => {
    let value = $('#searchByWords').val();
    if (value.length >= 2){
        rechercheArticlesParMotsClefs(value);
    }
    else {
        $('.error').text('champ vide');
    }
});



function recherchePseudoParMotsClefs(recherche) {
    $.post('/article/searchByPseudo/', {
        recherche: recherche.trim()
    }).done(function( data ) {
        if (data != null) {
            $('.resultByPseudo').html(data);
        }
        else {
            this.style.borderRadius = '15px';
            $('.resultByPseudo').html('');
        }
    });


    $('#searchByPseudo').on('keyup', (evt) => {
        let value = $('#searchByPseudo').val();
        if (value.length >= 2){
            recherchePseudoParMotsClefs(value);
        }
        else {
            $('.error').text('champ vide');
        }
    });
}