Após:
```
git clone https://github.com/timoteo7/laravel-challenge.git
```

## Install

```sh
composer install
```

por padrão usa o "sqlite" (necessita do "php-sqlite")

## Usage

```sh
php artisan serve
```

Ou se não quiser usar o Servidor web embutido do PHP e abrir direto no teu próprio servidor (http://localhost/laravel-challenge/)

```
sudo chmod -R 777 storage/framework storage/logs
sudo chmod 777 database database/database.sqlite
```

## Teste

email:teste@teste.com

password:12345678

se quiser recriar eventos e convites com datas mais atuais use:

```
php artisan migrate:fresh --seed
```
