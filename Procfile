web: vendor/bin/heroku-php-apache2 public/
heroku ps:scale web=0
queue: php artisan queue:work --tries=2