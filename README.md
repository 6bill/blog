# Création d'un Blog PHPGeek


## Etape 1 - La structure de fichiers

Notre application aura la stucture suivante

```

    public/
        index.php
        css/
        image/
        js/
    src/
        controllers/
            ArticleController.php
            UserController.php           
        models/
            User.php
            Article.php
            UserManager.php
            ArticleManager.php
        views/
            Article/
                index.php
                homepage.php
                create.php
            Auth/
                login.php
                register.php          
        Router.php
        
```

## Etape 2 - Composer et l'autoloading

- Initialiser le dossier comme étant un projet composer

```shell
$ composer init  # crée le fichier composer.json
$ composer install # install l'autoloader
```

- Remplir le fichier composer avec la règle d'autoloading

```json
"autoload": {
    "psr-4": {
        "Blog\\": "src/"
    }
}
```

- Réinitialiser l'autoloader

```shell
$ composer dump-autoload
```
//créer la base blog qui se trouve dans le fichier src/config/blog.sql
//executez  cd public
//lancer php -S localhost:8000

## Etape 3 - Le router
Voici la liste des routes qui seront implémentées:

ROUTES EN GET
- "/", GET => Accueil du blog
- "/login, GET => page de connexion
- "/logout, GET => déconnexion
- "/register, GET => page d'inscription
- "/dashboard, GET => dashboard qui montre tous les articles 
- "/dashboard/nouveau, GET => montre le formulaire de création d'un article

ROUTES EN POST
- "/dashboard/nouveau, POST => crée l'article en base de données
- "/login, POST =>  vérifie la connexion
- "/register, POST =>  crée le nouveau user
- "/dashboard/{article}/delete POST => supprime l'article
