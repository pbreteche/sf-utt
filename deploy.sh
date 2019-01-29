#!/usr/bin/env bash

git clone --depth 1 --branch master git@monserver.fr:monprojet.git

cd monprojet

composer install

php bin/console doctrine:database:create
php bin/console doctrine:schema:create
php bin/console doctrine:fixture:load --no-interaction

