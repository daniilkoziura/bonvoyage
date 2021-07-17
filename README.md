# bonvoyage

Simple SPA with Laravel, React, Docker

## How to setup laravel + react in kuber:
### create 2 images in docker registry:
<i> in folder with app need to run this command:</i> 

  * docker build -f Dockerfile -t daniilkoziura/bonvoyage-frontend-kubernetes:latest .
  * docker build -f Dockerfile -t daniilkoziura/bonvoyage-backend-kubernetes:latest . 
  * docker login -u daniilkoziura 
  * docker push daniilkoziura/bonvoyage-backend-kubernetes:latest
  * docker push daniilkoziura/bonvoyage-frontend-kubernetes:latest


    Interact with db using docker cli
     docker-compose exec <service-name>[backend] php artisan migrate
     DB_ROOT_PASSWORD=**** DB_DATABASE=**** DB_USERNAME=**** DB_PASSWORD=**** docker-compose up 