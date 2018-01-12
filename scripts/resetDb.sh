#!/bin/bash
docker exec -i agora_db sh -c 'exec mysql -u agora -ppassword -Nse "show tables" agora_api | while read table; do mysql -u agora -ppassword -e "SET FOREIGN_KEY_CHECKS=0; drop table $table; SET FOREIGN_KEY_CHECKS=1;" agora_api; done'
docker exec -i agora_web php artisan migrate:install
docker exec -i agora_web php artisan migrate

docker exec -i agora_web php artisan db:seed
