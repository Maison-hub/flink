docker-compose run --rm backend bash -c "composer install && php artisan key:generate"# Flink - API de clone de Linktree

Flink est une API qui permet de créer un clone de Linktree. Il est construit avec Laravel et Docker.

## Prérequis

- Docker
- Composer

## Installation

1. Clonez le dépôt
```sh
git clone https://github.com/maison-hub/flink.git
```

2. Naviguez vers le répertoire du projet
```sh
cd flink/flink-backend
```

3. Copiez le fichier .env.example en .env et modifiez les variables d'environnement si nécessaire
```sh
cp .env.example .env
```

4. Dans le fichier '.env' modifiez la partie db pour correspondre a la configuration
```sh
DB_CONNECTION=mysql
DB_HOST=db #chnager cette ligne
DB_PORT=3306
DB_DATABASE=flink # cette ligne aussi
DB_USERNAME=root
DB_PASSWORD=admin #et celle là
```
> noubliez pas d'enregister 'ctrl + s'

5. Revenez en arrière et installez les dépendances avec Composer, generez la clé de l'application et effectuez les migration
```sh
cd ..
docker-compose up -d db 
docker-compose run --rm backend bash -c "composer install && php artisan key:generate && php artisan migrate"
```

6. Lancez les services avec Docker
```sh
docker-compose up -d
```

7. Testez la configuration

Pour tester la configuration vous pouvez vous rendre sur l'url http://localhost:8080/
Et sur http://localhost:8080/api/test pour tester l'api

