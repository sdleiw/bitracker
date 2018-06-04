bitTracker
===

for those who want to track their own coin portfolio

how to use
---

### install

```bash
laravel new newproject
cd newproject
composer require sdleiw/bitracker
php artisan vendor:publish --tag=config
php artisan vendor:publish --tag=public
# config .env api keys // @todo
```

### config

add api credentials in the `.env` file, supported platforms are

- binance
- bitfinex
- hitbtc

### start server

```
php artisan serve
goto http://127.0.0.1:8000
```

### cache

results from all calls will be cached for 5 minutes

extend for more exchanges
---
adapters for other platforms consists at least 3 parts: an api client, a transformer and a struct object
if needed a price mapper to adjust coin labels 

- api client should implement `ApiClientInterface`
- transformer should implement `TransformerInterface` and registered in the `bitracker` config
- price mapper should implement `MapperInterface`
- add the config will be published and could be found in `config/bitracker.php` 
and api credentials should be added in `.env`
    