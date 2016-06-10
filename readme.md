## Macros

Extends Laravel with some helpful macros.

### Installation

Require it with Composer:

```shell
    composer require laugharn/macros
```

Macros comes with a handful of service providers you can add to the `config/app.php` providers array:

For Builder macros:

```php
    Laugharn\Macros\BuilderServiceProvider::class
```

For Collection macros:

```php
    Laugharn\Macros\CollectionServiceProvider::class
```

For Request macros:

```php
    Laugharn\Macros\RequestServiceProvider::class
```

No need for additional configuration, you're good to go.
