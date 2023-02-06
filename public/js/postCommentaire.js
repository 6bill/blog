// On attend le chargement du document
window.onload = () => {
    // On met un écouteur sur l'évènement click du bouton pour poster le commentaire
    let valid = document.querySelector("#postCommentaire");
    valid.addEventListener("click", ajoutCommentaire);
}

/**
 * Cette fonction envoie le commentaire et l'id de l'article sous forme de données JSON
 * à l'ArticleController qui va le transformer en objet PHP et passer les informations
 * à l'ArticleManager qui va insérer les données dans la bdd. */
function ajoutCommentaire() {
    // On récupère le commentaire
    let commentaire = document.querySelector("#texteCommentaire").value
    let IdArticleCommente = document.querySelector("#IdArticleCommente").value

    alert(commentaire);    alert(IdArticleCommente);
    // On vérifie si le commentaire n'est pas vide
    if (commentaire !== "") {
        // On crée un objet JS
        let donnees = {}
        donnees["commentaire"] = commentaire
        donnees["IdArticleCommente"] = IdArticleCommente



        // On convertit les données en JSON
        let donneesJson = JSON.stringify(donnees);

        // On envoie les données en POST en Ajax
        // On instancie XMLHttpRequest
        let xmlHttp = new XMLHttpRequest()
        // On gère la réponse
        xmlHttp.onreadystatechange = function () {
            // On vérifie si la requête est terminée
            if (this.readyState === 4) {
                // On vérifie qu'on reçoit un code 200
                if (this.status === 200) {
                    // L'enregistrement a fonctionné
                    // On efface le champ texte
                   document.querySelector("#texteCommentaire").value = ""
                    let divCommentaires = document.querySelector("#divCommentaires");
                    // On ajoute le contenu avant le contenu actuel de discussion
                    divCommentaires.innerHTML = this.response
                } else {
                    // On gère les erreurs
                    let erreur = JSON.parse(this.response);
                    alert(erreur.message);
                }
            }
        }

        // On ouvre la requête
        xmlHttp.open("POST", "/postCommentaire/");
        // On envoie la requête en incluant les données
        xmlHttp.send(donneesJson);
    }
}