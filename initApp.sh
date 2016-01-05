#!/bin/sh
php app/console doctrine:database:create
php app/console doctrine:schema:create
php app/console hautelook_alice:doctrine:fixtures:load -n
php app/console doctrine:fixtures:load --append
php app/console assetic:dump
php app/console assets:install
php app/console cache:clear -e=prod
php app/console cache:clear -e=prod
chmod 777 -R app/logs/ 
chmod 777 -R app/cache/ 
