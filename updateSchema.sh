#!/bin/bash

php app/console doctrine:generate:entities AppBundle --no-backup
php app/console doctrine:schema:update -f
php app/console cache:clear -e=dev
php app/console cache:clear -e=prod
