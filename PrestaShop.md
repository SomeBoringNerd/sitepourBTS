Cette documentation a été faite pour un serveur sous PopOS (ou Ubuntu) avec un accès root sans aucun autre logiciel ou service activé dessus.

```bash
sudo apt install nginx git

sudo systemctl start nginx && sudo systemctl enable nginx

sudo apt install mysql-server mysql-client

sudo systemctl start mysql && sudo systemctl enable mysql

mysql_secure_installation

sudo apt install php-fpm php-cli php-curl php-mysql php-curl php-gd php-mbstring php-pear php-intl -y

sudo systemctl start php7.4-fpm && sudo systemctl enable php7.4-fpm

```

a présent, il faut ajouter les lignes suivantes dans le fichier /etc/nginx/sites-enabled/default, après le premier location /{}, dans le bracket server{} :
```
location ~ \.php$
{
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/run/php/php7.4-fpm.sock;
}
```
puis redémarrer Nginx :
`sudo systemctl restart nginx`

a présent; il faut télécharger Phpmyadmin
```
sudo apt install phpmyadmin
```

une fois l'installation de PHPMyAdmin finalisée, retournez dans /etc/nginx/site-enabled/default et ajoutez ces lignes au même endroit que précédement :
```
location /phpmyadmin 
{
    root /usr/share/;
    index index.php;
    try_files $uri $uri/ =404;

    location ~ ^/phpmyadmin/(doc|sql|setup)/ 
    {
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

maintenant, dans un terminal en tant que root (sudo -s), rentrez dans la base de donnée avec cette commande :
```
mysql -u root -p
```
le mot de passe par défaut est vide.

a la suite, écrivez ces commandes en remplaçant USERNAME par le nom d'utilisateur du compte admin et MOT DE PASSE par votre mot de passe:
```
create user USERNAME@'localhost' identified by 'MOT DE PASSE';
grant all privileges on *.* to USERNAME@'localhost';
flush privileges;
```

maintenant faut télécharger prestashop et le dézipper
```

cd /var/www/html
mkdir shop && cd shop

wget https://www.prestashop.com/fr/system/files/ps_releases/prestashop_1.7.8.3.zip

unzip https://www.prestashop.com/fr/system/files/ps_releases/prestashop_1.7.8.3.zip
```

aller dans le navigateur, {ip}/shop

si l'erreur de permission apparait dans la fenetre, entrer la commande 

`sudo chown -R www-data /var/www/html/`

a présent, il suffit de suivre les étapes. au moment où l'installateur demande une base de donnée, mettez le nom d'utilisateur et mot de passe configuré plus tôt.

L'installation échouera en disant que la base de donnée "prestashop" n'existe pas, mais un bouton pour la créer est disponible. Ceci fait, l'installation se concluera.
