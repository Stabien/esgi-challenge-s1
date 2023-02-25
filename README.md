# Notre projet Symfony de paris e-sportifs sur le jeu League of Legends

Ce projet est un site de paris en ligne pour les matchs de League of Legends. Les utilisateurs peuvent créer un compte, déposer de l'argent et parier sur les résultats des matchs.
## Installation

### Cloner le dépôt sur votre ordinateur.

```bash
git clone https://github.com/votre-nom/votre-projet.git
```

### Installer les dépendances avec composer install.

```bash
composer install
```
Copier le fichier .env.example en .env et le configurer avec votre base de données et vos informations de connexion pour l'API League of Legends.

### Créer la base de données avec php bin/console doctrine:database:create.


```bash
php bin/console doctrine:database:create
```

### Exécuter les migrations avec php bin/console doctrine:migrations:migrate.


```bash
php bin/console doctrine:migrations:migrate
```

### Exécuter les fixtures avec php bin/console doctrine:fixtures:load.


```bash
php bin/console doctrine:fixtures:load
```

## Utilisation

Pour lancer le serveur, exécutez la commande php bin/console server:run. Le site sera accessible à l'adresse http://localhost:8000.

Vous pouvez vous inscrire en créant un compte et déposer de l'argent en utilisant une carte de crédit. Une fois que vous avez de l'argent sur votre compte, vous pouvez parier sur les matchs disponibles.

Les résultats des matchs sont récupérés en temps réel depuis l'API League of Legends.
Contribuer

Si vous souhaitez contribuer au projet, vous pouvez créer une pull request sur GitHub

## Les principaux acteurs de ce projets sont : 
#### - Melvin Redureau
#### - Bastien Piedallu 
#### - Raphaël Selwa 
#### - Hervé Cousin