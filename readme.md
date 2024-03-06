# Flink - API de clone de Linktree

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

3. Installez les dépendances avec Composer
```sh
docker-compose run --rm backend composer install
```

4. Installez les dépendances avec Composer
```sh
cp .env.example .env
```

5. Installez les dépendances avec Composer
```sh
docker-compose up -d
```