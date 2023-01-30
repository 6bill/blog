//Fonction qui va récupérer les mots entrés dans la barre de recherche
// et les poster pour que ArticleManager puisse les récupérer
// cette fonction appelle une route en méthode "post"
function rechercheArticlesParMotsClefs(recherche) {
    $.post('/article/searchByWordsArticle/', {
        recherche: recherche.trim()
    }).done(function( data ) {
        if (data != null) {
            $('.resultByWordsArticle').html(data);
        }
        else {
            this.style.borderRadius = '15px';
            $('.resultByWordsArticle').html('');
        }
    });
}


//Création de l'évènement keyup pour la barre de recherche par mots clefs
$('#searchByWordsPseudo').on('keyup', (evt) => {
    let value = $('#searchByWordsPseudo').val();
    if (value.length >= 2){
        recherchePseudoParMotsClefs(value);
    }
    else {
        $('.error').text('champ vide');
    }
});
function recherchePseudoParMotsClefs(recherche) {
    $.post('/article/searchByWordsPseudo/', {
        recherche: recherche.trim()
    }).done(function( data ) {
        if (data != null) {
            $('.resultByWordsPseudo').html(data);
        }
        else {
            this.style.borderRadius = '15px';
            $('.resultByWordsPseudo').html('');
        }
    });
}


//Création de l'évènement keyup pour la barre de recherche par mots clefs
$('#searchByWordsArticle').on('keyup', (evt) => {
    let value = $('#searchByWordsArticle').val();
    if (value.length >= 2){
        rechercheArticlesParMotsClefs(value);
    }
    else {
        $('.error').text('champ vide');
    }
});

