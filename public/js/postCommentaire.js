/** On attend le chargement du document*/
$(document).ready(function () {
    // On  met un écouteur sur l'évènementt click du bouton pour poster le commentaire
    $(".postCommentaire").click(function () {
        ajoutCommentaire(this);
    });
});


/** Cette fonction envoie le commentaire et l'id de l'article sous forme de données JSON
 * à l'ArticleController qui va le transformer en objet PHP et passer les information
 * à l'ArticleManager qui va insérer les données dans la bdd */
function ajoutCommentaire(caller) {
    //on récupère l'id de l'article qui vient d'être commenté
    let IdArticleCommente = caller.parentElement.getAttribute('postid');
    // On désigne le textarea qui contient le commentaire en se servant de l'id article
    let texteCommentaire = "#texteCommentaire"+IdArticleCommente
    // On récupère le commentaire
    let commentaire = document.querySelector(texteCommentaire).value
    // On vérifie si le commentaire n'est pas vide
    if (commentaire != "") {
        // On crée un objet JS
        let donnees = {}
        donnees["commentaire"] = commentaire
        donnees["IdArticleCommente"] = IdArticleCommente

        // On convertit les données en JSON
        let donneesJson = JSON.stringify(donnees)

        // On envoie les données en POST en Ajax
        // On instancie XMLHttpRequest
        let xmlhttp = new XMLHttpRequest()
        // On gère la réponse
        xmlhttp.onreadystatechange = function () {
            // On vérifie si la requête est terminée
            if (this.readyState == 4) {
                // On vérifie qu'on reçoit un code 200
                if (this.status == 200) {
                    // L'enregistrement a fonctionné
                    // On efface le champ texte
                    document.querySelector(texteCommentaire).value = "";

                    // On désigne la div où va apparaite le commentaire en se servant de l'id article
                    let divNouveauComment = "#divNouveauComment"+IdArticleCommente
                    divNouveauComment = document.querySelector(divNouveauComment)
                    // On ajoute le nouveau commentaire dans la div appropriée
                    let newElement = document.createElement("div");
                    newElement.innerHTML = this.response;
                    divNouveauComment.appendChild(newElement);
                } else {
                    // On gère les erreurs
                    let erreur = JSON.parse(this.response)
                    alert(erreur.message)
                }
            }
        }

        // On ouvre la requête
        xmlhttp.open("POST", "/postCommentaire/")
        // On envoie la requête en incluant les données
        xmlhttp.send(donneesJson)
    }
}