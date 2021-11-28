# SitePourCours

ce repos est utilisé pour sauvegarder un cours d'enseignement pratique

# mettre en place un environnement de test :

tout d'abord, mon serveur de test utilise Nginx, MySQL et phpmyadmin, et le tuto n'est prévu que pour Debian et ses variantes

d'abord il faut installer nginx puis l'activer :

```
sudo apt update
sudo apt install nginx
sudo systemctl start nginx && sudo systemctl enable nginx
```

ensuite, il faut installer MySQL et l'activer : 

```
sudo apt install mysql-server mysql-client
sudo systemctl start mysql && sudo systemctl enable mysql
```

il faut ensuite executer la commande `mysql_secure_installation` afin de créer une base de donnée

après celà, il faut installer php-fpm ainsi que des dépendances requises par PHPMyAdmin :
il faudra également l'activer
```
sudo apt install php-fpm php-cli php-curl php-mysql php-curl php-gd php-mbstring php-pear -y

sudo systemctl start php7.4-fpm && sudo systemctl enable php7.4-fpm
```

a présent, il faut ajouter les lignes suivantes dans le fichier `/etc/nginx/sites-enabled/default`, après le premier `location /{}`, dans le bracket `server{}` :

```
location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/run/php/php7.4-fpm.sock;
        }
```

Maintenant il faut relancer nginx avec la commande suivante :
`sudo systemctl restart nginx`

ceci fait, nous allons installer PHPMyAdmin avec cette commande :
`sudo apt install phpmyadmin`

lors de l'installation, une fenetre apparaitra pour vous proposer une configuration automatique. Refusez la en appuyant sur entré (sans selectionner l'une des options).

Lorsque l'installation demandera si vous voulez configurer une base de donnée, faites oui. rentrez un mot de passe et confirmez le pour valider l'installation.

une fois l'installation de PHPMyAdmin finalisée, retournez dans `/etc/nginx/site-enabled/default` et ajoutez ces lignes au même endroit que précédement :

```
    location /phpmyadmin {
        root /usr/share/;
        index index.php;
        try_files $uri $uri/ =404;

    location ~ ^/phpmyadmin/(doc|sql|setup)/ {
        deny all;
        }

    location ~ /phpmyadmin/(.+\.php)$ {
        fastcgi_pass unix:/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
        include snippets/fastcgi-php.conf;
        }
    }
```

redémarrez encore une fois nginx avec la commande `systemctl reload nginx`.

maintenant, dans un terminal en tant que root (`sudo -s`), rentrez dans la base de donnée avec cette commande : 

`mysql -u root -p`

le mot de passe par défaut est vide.

a la suite, écrivez ces commandes en remplaçant USERNAME par le nom d'utilisateur du compte admin :

```

create user USERNAME@'localhost' identified by 'MOT DE PASSE';
grant all privileges on *.* to USERNAME@'localhost';
flush privileges;
```

il suffit maintenant d'importer la base de donnée présente dans /template/[A REMPLIR]
