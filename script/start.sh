#!/bin/bash
echo "install depency"
composer install
sleep 2
docker compose up -d
echo "init docker"
sleep 10
symfony console make:migration
sleep 2
symfony console doctrine:migrations:migrate
sleep 2
symfony console doctrine:fixtures:load
symfony serve:start