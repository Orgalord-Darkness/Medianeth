# Medianeth-que
Medianeth
Medianeth est une application de gestion de médiathèque développée en PHP pur, reposant sur une architecture MVC personnalisée. Elle permet aux utilisateurs de consulter, rechercher et administrer des contenus multimédias tels que des livres, des films et des albums musicaux.

🧠 Présentation générale
- Technologies : PHP, HTML, CSS, JavaScript, Bootstrap
- Environnement local : WAMP (Apache, MySQL, PHP)
- Architecture : MVC from scratch (Modèle / Vue / Contrôleur)
- Frameworks : Aucun — tout est codé manuellement

🧱 Architecture
- Modèles : seules les classes du dossier models/ sont documentées
- Vues : HTML/CSS avec Bootstrap
- Contrôleurs : gèrent la logique métier et les interactions
- Pas de table SQL pour l'entité abstraite Media

🧩 Entités principales
|  |  | 
| User |  | 
| Media | BookMovieAlbum | 
| Album | Song | 
| Illustration |  | 



🔐 Espace public
- Page d’accueil
- Formulaire de connexion
- Formulaire d’inscription

🔓 Espace connecté
Library
- Affichage des médias par type (Book, Movie, Album)
- Tri alphabétique sur les titres (ASC / DESC)
- Filtrage par disponibilité
- Recherche par titre approximatif (algorithme de Levenshtein)
Dashboard
- Vue complète de tous les médias
- Accès aux fonctions d’administration

⚙️ Administration
- Gestion des entités :
- Book, Movie, Album
- Illustration
- Song
- Suppression sécurisée :
- Vérification des clés étrangères
- Empêche la suppression d’illustrations ou d’albums encore utilisés

👤 Utilisateur
- Chaque utilisateur possède une illustration (avatar via URL)
- Peut supprimer son compte
- Les illustrations ne sont jamais stockées localement

📦 Fonctionnalités métier
- Chaque média peut être emprunté ou rendu
- Ces actions sont gérées par des méthodes spécifiques dans les modèle
