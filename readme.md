# OW Interactive - Eventos

## Introdução

O projeto está em php ^7.0, o sistema de autenticação foi bolado utilizando os recursos nativos na aplicação *auth-token*.

O intuito do projeto é gerenciar eventos, compartilha-lo entre usuários e filtra-los de por periodo.

## Recursos utilizados

- nginx
- redis
- mailhog 
- queue (database)

## Iniciando

1. Fork the [laravel-challenge][laravel-challenge] repository on GitHub
2. Run `composer install`
4. Perform the configuration for a [fresh install of Laravel](https://laravel.com/docs/5.5/#installation)
5. php artisan migrate
6. Run `php artisan serve`
7. Browse to [http://ow-interactive.local](http://ow-interactive.local)

## Nginx
```
server {
    listen 80;
    server_name ow-interactive.local;
    root {folder};

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Adicione a linha em `/etc/hosts`
> 127.0.0.1 ow-interactive.local

Reinicie o servidor:
> sudo service nginx restart

## Docker
Para facilitar a revisão, foi criado um docker-compose contendo os *containers* minimamente configurados.

0. docker-composer up -d
1. mailhog [open](http://localhost:8025) esse será nosso servidor smtp de teste.
2. redis `127.0.0.1:6379`

## Frontend

Foi construido utilizando as tecnologias: vue, nuxt.

[repositorio]: https://github.com/preetender/ow-interactive-app

## Mais informações

[composer]: https://getcomposer.org
[npm]: https://www.npmjs.com/
[nuxt]: https://nuxtjs.org/
[git]: http://git-scm.com/
[fork]: http://lmgtfy.com/?q=how+to+fork+a+repo+in+github
[php]: http://php.net
[laravel-challenge]: https://github.com/owinteractive/laravel-challenge
[Laravel]: http://www.laravel.com/docs/5.5
