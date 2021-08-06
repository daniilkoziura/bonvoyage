# bonvoyage

Simple SPA with Laravel, React, Docker

## How to setup laravel + react in kuber:
There is 2 ways of setuping this project:
* using docker-compose
* using kubernetes


  Common commands which might help you to push your images on Docker Hub: 
  * docker build -f Dockerfile -t daniilkoziura/bonvoyage-frontend-kubernetes:version .
  * docker build -f Dockerfile -t daniilkoziura/bonvoyage-backend-kubernetes:version . 
  * docker login -u daniilkoziura 
  * docker push daniilkoziura/bonvoyage-backend-kubernetes:latest
  * docker push daniilkoziura/bonvoyage-frontend-kubernetes:latest

# Kubernetes setup
In this example I will use <i>Minikube</i>. You can install it here <br> 
https://minikube.sigs.k8s.io/docs/start/

 * ###Start minikube using virtual machine with hyperkit driver: <br> 
   `minikube start --vm=true --driver=hyperkit` <br>
    it will setup you a fresh minikube on virtual machine and it helps you to emulate some 
    networks features in future. <br>
    after successful instalation you should see something like this:
    <br><br>
    🏄  Done! kubectl is now configured to use "minikube" cluster and "default" namespace by default
    <br><br>
 
*   ### Folders and Files
        For Kubernetes I created 4 folders:
             k-laravel 
             k-react
             k-mysql
             k-networking
Each folder contains deployment and service. <br>
Deployment - is a special object where you describe a desired state of Pod <br>
Service - is a way to expose an application running on a set of Pods as a network service.
####k-laravel contains:
configmap - configuration file for the web server.
It used to store non-confidential data in key-value pairs
####k-mysql contains:
some files and folders which are responsible for successful installation 
of initial configurations of MYSQL 
####networking folder contains:
Ingress - An API object that manages external access to the services in a cluster, typically HTTP.
Ingress may provide load balancing, SSL termination and name-based virtual hosting.

*   ### Deployments and Services
First let's setup database. To do this you should be in a root of the projet and 
run next commands: <br>

        kubectl apply -f k-mysql/deployment-db.yaml
        kubectl apply -f k-mysql/service-db.yaml 





