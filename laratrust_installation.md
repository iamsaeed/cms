php artisan vendor:publish --tag="laratrust"
php artisan vendor:publish --tag="laratrust"
php artisan optimize:clear

#check 
config/laratrust.php => 'user_models' => [
    'users' => 'App\User',
],

php artisan laratrust:setup

#create seeder
php artisan laratrust:seeder

composer dump-autoload
php artisan optimize:clear

#make modifications in laratrust seeder
