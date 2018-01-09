#!/bin/bash
docker exec -i agora_web php artisan migrate:install
docker exec -i agora_web php artisan migrate
