# DigitalMenu - A complete solution for food ordering and managing

This project is an example of a interactive menu, with orders, dish management, and role-specific feature management. It also aims to teach the power and simplicity of **Symfony** framework.


# Setup

Since this application also demonstrates the power of **cloud technologies** such as **Docker**, **Docker-Compose** with the aid of linux utilities like **MakeFile**
So, in order to properly install the application after cloning it, you need to do the following: (having **docker** and **docker-compose** [At least the version *1.29.2*] installed is a must)

- create a .env file in the app/ folder with the following contents:
```
APP_ENV=dev  
APP_SECRET=cf31521ae83c7c121c5122e44d90e534
DATABASE_URL="mysql://digitalmenu:digitalM3n12022@database:3306/digitalmenu?serverVersion=8.0&charset=utf8mb4"
```
- and then, execute the commands in the following order:
```
make docker-up
make dci
make access-php
```
- after this last command, you will be in a shell inside the **php** container, then, do:
```
php bin/console doctrine:schema:update --force
chmod 755 -R public
```
- This will create the schema in the **database** container, and the last command will set the permissions for the *public/* folder, so that you will be able to create files there.