#H1 Question 7
crier le projet avec les depandances

> symfony new project-name
> composer require symfony/orm-pack

create the sqlite database
> php bin/console doctrine:database:create
crier l'entite annonce
> php bin/console make:entity
generer une migration pour crier la table annonce
> php bin/console make:migration
lancer la migration
> php bin/console doctrine:migrations:migrate

#H1 Question 9
> crier une entite avec une relation OneToMany avec l'entite Annonce
> 
> modifer lees methodes de CRUD de l'annonce
generer une migration pour crier la table categoy
> php bin/console make:migration
lancer la migration
> php bin/console doctrine:migrations:migrate

#H1 les endpoints
list tout les annonces
> http://127.0.0.1:8000/annonce/annonces  POST

ajouter une annonce
> http://127.0.0.1:8000/annonce/add    POST

supprimer une annonce en specifiant l'id de l'annonce
> http://127.0.0.1:8000/annonce/delete/id     DELETE

modifier une annonce en specifiant l'id de l'annonce
> http://127.0.0.1:8000/annonce/update/6   PUT

list tout des categories
> http://127.0.0.1:8000/category/categories   GET

ajouter une category
> http://127.0.0.1:8000/category/add    POST

list tout les annonces d'une category en specifinat l'id de la category
> http://127.0.0.1:8000/annonce/annoncebycategory/2    GET

se connecter 
> http://127.0.0.1:8000/user/login    POST

crier un compte 
> http://127.0.0.1:8000/user/add    POST