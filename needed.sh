
#!/bin/sh

# Run Laravel Pint
./vendor/bin/pint

# Run PHPStan static analysis
./vendor/bin/phpstan analyse

# run passport client
php artisan passport:client --no-interaction --personal