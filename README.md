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
First let's setup database. To do this you should be in a root of the project and 
run next commands: <br>

        kubectl apply -f k-mysql/deployment-db.yaml
        kubectl apply -f k-mysql/service-db.yaml 

Next step is setup laravel. end make migration by providing an interactive bash to the Pod: <br>

        kubectl apply -f k-laravel/configmap-laravel.yaml
        kubectl apply -f k-laravel/deployment-laravel.yaml
        kubectl apply -f k-laravel/service.laravel.yaml 
        kubectl describe pods
        kubectl exec <pod_name> --it - bash 
        cd ../
        php artisan migrate
        php artisan db:seed

This step is about react setup. In Dockerfile I created a production build which will run the
app on express through `server.js` file. <br>

            kubectl apply -f k-react/deployment-front.yaml
            kubectl apply -f k-react/service-react.yaml 
<br>

You can use `minikube dashboard` to see the whole structure of the cluster, so only one thing
left is ingress controller, gratefully if you use minikube for your studying, it has a special
addon which provides you a setup for your ingress, only need to write a yaml file with rules. 

First of all let's turn on ingress addon:

        minikube addons enable ingress

I recomended you this article to learn more about this addon:
https://kubernetes.io/docs/tasks/access-application-cluster/ingress-minikube/

Once addon has enabled we can apply our ingress rules for application by using same command
as we used before: <br>

        kubectl apply -f networking/ingress.yaml  

Once ingress has started his work you should get an ip adress which will appear after couple of
minutes. To see this IP just type this coomand:

        kubectl get ingress

Then provide this IP and the hostname in `/etc/hosts` file.  <br>
My example has `bonvoyage.com` host so I should go to /etc/hosts and type something like:
example of my /etc/hosts file: 

        Host Database
        localhost is used to configure the loopback interface
        when the system is booting.  Do not change this entry.
        
        127.0.0.1	localhost
        255.255.255.255	broadcasthost
        ::1             localhost
        
        192.168.64.12   bonvoyage.com

To delete everything and start again I always use this commands:

        minikube stop && minikube delete && minikube start --vm=true --driver=hyperkit