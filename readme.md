# symfony5_API
symfony5-API est un projet d'API sous Symfony 5 et Docker.

## Installation
Installation du projet dans un environnement Linux Ubuntu 20.04.3 LTS (Focal Fossa)

sudo apt-get update && sudo apt-get upgrade -y

Installation de Docker v. 20.10.12:
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh get-docker.sh

Vérifiez si vous devez mettre à jour Docker via votre gestionnaire de paquets.

Installation de Sf :
symfony new symfony5_API –version=5.4
La version 5.4.2 est installée pour ce projet.
composer require --dev symfony/var-dumper 
composer require debug