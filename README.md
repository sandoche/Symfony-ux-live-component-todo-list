# Symfony UX Live Component - Todo list sample app

> A simple todo app made with [Symfony UX Live Component](https://github.com/symfony/ux-live-component)

## Installation
```sh
# set up .env
composer install
yarn install
php bin/console doctrine:migrations:migrate
```

## Development
```sh
symfony server:start
yarn encore dev-server
```