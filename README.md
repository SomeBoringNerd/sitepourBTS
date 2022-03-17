# SitePourCours

ce repository est celui de mon site, http://someboringnerd.xyz:32768 (le port est important, a cause de limitations de mon hebergeur)

Le code source de ce site est a des fins de transparence uniquement. Je n'offre aucun support concernant le code de ce repos.

# mettre en place un environnement de test :

tout d'abord, mon serveur de test utilise Nginx, MySQL et phpmyadmin, et le tuto n'est prévu que pour Debian et ses variantes (Pop_!Os dans mon cas)

d'abord il faut installer git si ce n'est pas déjà fait puis on clone le repository

```
sudo apt install git
# a noter qu'il faut remplacer USERNAME par votre nom d'utilisateur (obtenable avec la commande `whoami`)
mkdir /home/USERNAME/Documents/GitHub && cd /home/USERNAME/Documents/GitHub/
git clone https://github.com/SomeBoringNerd/sitepourBTS.git
```

Pour commencer, installez nginx et activez le :

```
sudo apt update
sudo apt install nginx git
sudo systemctl start nginx && sudo systemctl enable nginx
```

après celà, il faut installer php-fpm ainsi que des dépendances :
il faudra également l'activer :
```
sudo apt install php-fpm php-cli php-curl php-mysql php-curl php-gd php-mbstring php-pear -y

sudo systemctl start php7.4-fpm && sudo systemctl enable php7.4-fpm
```

a présent, il faut ajouter les lignes suivantes dans le fichier `/etc/nginx/sites-enabled/default`, après le premier `location /{}`, dans le bracket `server{}` :

```
location ~ \.php$
{
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/run/php/php7.4-fpm.sock;
}
```

Maintenant il faut relancer nginx avec la commande suivante :
`sudo systemctl restart nginx`
