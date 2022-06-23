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
symfony serve:start -d
sleep 1
yarn install
sleep 1
yarn encore dev --watch
echo "all is running bo + api"