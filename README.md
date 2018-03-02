## Instalação

Para instalar, adicione o seguinte trecho de código ems eu composer.json:

```javascript
"repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/Webeleven/rateable"
    }
  ],
  "require": {
    ...
    "webeleven/rateable": "v1.0"
  },
```

Depois de alterar seu composer.json, adiocione o ServiceProvider do pacote no seu config/app.php conforme a linha abaixo:

```php
Webeleven\Rateable\RateableServiceProvider::class,
```

## Vendor Publish
Execute o comando abaixo para transferir as configs e migrations do pacote para seu projeto:

```shell
php artisan vendor:publish --provider="Webeleven\Rateable\RateableServiceProvider"
```

## Migrations
Para executar as *migrations* do pacote é necessário executar manualmente no seu console o comando abaixo:

```shell
php artisan migrate --path=./vendor/webeleven/rateable/src/migrations
```

## Middleware e Provider

O pacote fornece uma implementação padrão para as middlwares de autenticação e provedor de usuário autenticado do site.

Caso haja necessidade, é possível alterar as implementações das interfaces para uma já criada pelo desenvolvedor do site pelo arquivo config/rateable.php:

```php
return [
    'auth_middleware' => \Webeleven\Rateable\Middleware\DefaultRateableAuth::class,
    'user_provider' => \Webeleven\Rateable\Services\DefaultUserProvider::class
];
```

## Path da interface Middleware:
```php
Webeleven\Rateable\MiddlewareRateableAuth.php
```
## Path da interface de Provedor de usuário:
```php
Webeleven\Rateable\Interfaces\UserProvider.php
```
