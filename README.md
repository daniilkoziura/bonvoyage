# bonvoyage

Simple SPA with Laravel, React, Docker

## How to setup laravel + react in kuber:
### create 2 images in docker registry:
<i> in folder with app need to run this command:</i> 

  * docker build -f Dockerfile -t daniilkoziura/bonvoyage-frontend-kubernetes:latest .
  * docker build -f Dockerfile -t daniilkoziura/bonvoyage-backend-kubernetes:latest . 



    Interact with db using docker cli
     docker-compose exec <service-name>[backend] php artisan migrate
     