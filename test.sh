#!/bin/bash
docker-compose up -d
until docker-compose exec laravel.test php artisan migrate
do
  echo "HemulenTest DB is not up yet. Waiting..."
  sleep 5
done
until nc -z localhost 8484
do
  echo "HemulenTest web is not up yet. Waiting..."
  sleep 5
done
docker-compose exec laravel.test php artisan key:generate
docker-compose exec laravel.test php artisan migrate
docker-compose exec laravel.test php artisan db:seed --force
