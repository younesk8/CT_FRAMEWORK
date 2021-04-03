> projet réalisrer par : </br>
    <u> KHALFI Younes (MAIGE) </br>
     AFEILAL Hicham (MAIGE) </br>
    MOULOUDE Amine (MAIGE) </br>
     BELKADI Imed  (INGÉ) </u>


# Question 7
#####créer le projet avec les dépandances

> symfony new project-name </br>
> composer require symfony/orm-pack

####créer la base de donnée
> php bin/console doctrine:database:create </br>
créer l'entite annonce</br>
> php bin/console make:entity</br>
generer une migration pour créer la table annonce</br>
> php bin/console make:migration</br>
#####lancer la migration
> php bin/console doctrine:migrations:migrate

# Question 9
> créer une entite avec une relation OneToMany avec l'entite Annonce

> modifer lees methodes de CRUD de l'annonce
####generer une migration pour créer la table categoy
> php bin/console make:migration
####lancer la migration
> php bin/console doctrine:migrations:migrate

#les endpoints
####list tout les annonces
> http://127.0.0.1:8000/annonce/annonces  POST

####ajouter une annonce
> http://127.0.0.1:8000/annonce/add    POST

####supprimer une annonce en specifiant l'id de l'annonce
> http://127.0.0.1:8000/annonce/delete/id     DELETE

####modifier une annonce en specifiant l'id de l'annonce
> http://127.0.0.1:8000/annonce/update/6   PUT

####list tout des categories
> http://127.0.0.1:8000/category/categories   GET

####ajouter une categorie
> http://127.0.0.1:8000/category/add    POST

####list tout les annonces d'une category en specifinat l'id de la category
> http://127.0.0.1:8000/annonce/annoncebycategory/2    GET

####se connecter 
> http://127.0.0.1:8000/user/login    POST

####créer un compte 
> http://127.0.0.1:8000/user/add    POST