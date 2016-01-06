#!/bin/bash

php app/console doctrine:schema:update -f
php app/console assets:install
php app/console cache:clear -e=dev
php app/console cache:clear -e=prod
php app/console assetic:dump

