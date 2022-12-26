# Projet_technologique
Projet technologique Licence 3, réalisé par : Diallo Gabalan, Djeeva Souprayenmestry, Sidali Zitouni Terki, Thomas Guesdon.

Le but de ce projet est de proposer un forum pouvant être utilisés par des enfants d'une école.

Nous proposons les fonctionnalités suivantes :

- Possibilité pour l'administrateur d'ajouter un enfant à la base de données et de le lier à un code.
- Possibilité pour chaque enfant de créer un compte à l'aide du code fournit par l'administrateur.
- Les enfants peuvent créer des sujets.
- Les enfants peuvent discuter d'un sujet en ajoutant des messages à ce sujet.
- Les enfants peuvent citer un message afin d'y répondre.
- Les enfants peuvent signaler un sujet ou un message qu'ils jugent vulgaire.
- L'administrateur à accès à une page "signalement" dans lequel il peut observer les messages signalés, et choisir une action à effectuer entre supprimer le message, le censurer ou bien le laisser tel quel si le signalement était injustifié.
- Les enfants peuvent modifier leur mot de passe dans la page "paramètre".
- Les enfants peuvent ajouter un sujet à leurs favoris afin de le retrouver plus facilement.
- Les enfants peuvent accèder à un onglet pour visualiser uniquement les sujets qu'ils ont crées.
- Lors de l'écriture d'un message ou d'un sujet, le texte est confronté à une liste noire, c'est à dire que les mots vulgaires ne sont pas acceptés. 
- Il est possible d'activer une liste blanche, de telle sorte à ce que seuls les mots contenus dans cette liste sont accepté lors de l'ajout d'un message ou d'un sujet. Par défaut celle-ci est désactivée puisqu'elle est très restrictive et demande une orthographe parfaite.

Installation :

La version 1.0 de notre site ne propose pas d'installation automatisée, une archive est fournie comprenant les fichiers sources.

Pour installer le site il faut le placer dans un serveur apache, et importer le fichier sql_etCdc/hollow_base.sql (base vide) ou sql_etCdc/full_base.sql (base pré-remplie) dans une base de données.
Il faut ensuite modifier la ligne 16 du fichier model/model.php et y placer les identifiants de votre base.
Par défaut les identifiants du compte admin sont :  Identifiant = admin; Mot de passe = administrateur.
Il est recommandé de les changer dès la première connection.

Livraison :

Nous fournissons à la personne en charge du site les identifiants du compte administrateur ("admin", "administrateur" lors de la présentation).
Nous pouvons activer la liste blanche à la demande de l'établissement, seulement celle-ci est très restrictive.

Explications :

Pour ajouter des comptes pour les enfants, l'administrateur doit se rendre dans la page paramètre et remplir le formulaire pour ajouter un compte. L'administrateur devra ensuite donner le code qu'il a utilisé à l'enfant pour qu'il se crée un compte depuis la page d'accueil ou le code lui sera demandé.

