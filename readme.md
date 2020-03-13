# OW Interactive - Eventos

## Banco de dados

O teste foi feito utilizando o sqlite, para configura-lo é simples:

1. touch database/database.sqlite
2. sudo chmod 777 database/database.sqlite

## Iniciando

1. Fork the [laravel-challenge][laravel-challenge] repository on GitHub
2. Run `composer install`
3. Run `npm install` (or `yarn install`)
4. Perform the configuration for a [fresh install of Laravel](https://laravel.com/docs/5.5/#installation)
5. php artisan migrate
6. Run `php artisan serve`
7. Browse to [http://localhost:8000](http://localhost:8000)

## Adicionais

- redis
- mailhog 

Para facilitar a revisão, foi criado um docker-compose contendo os *containers* minimamente configurados.

0. sudo docker-composer up -d
1. abrir link [http://localhost:8025] esse será nosso servidor smtp de teste.

## Introdução

O projeto está em php ^7.0, o sistema de autenticação foi bolado utilizando os recursos nativos na aplicação *auth-token*.

O intuito do projeto é gerenciar eventos, compartilha-lo entre usuários e filtra-los de por periodo.

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
