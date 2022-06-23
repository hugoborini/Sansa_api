#!/bin/bash
echo "install depency"
composer install
sleep 1
docker compose up -d
echo "init docker"
sleep 1
symfony console make:migration
sleep 1
symfony console doctrine:migrations:migrate
sleep 1
symfony console doctrine:fixtures:load
symfony serve:start