

#!/usr/bin/env bash

#into the code directory
cd /var/www/tasks-tasks
#enter a mantainece mode
php artisan down
#get the latest code 
get pull
#install the app's dependencies
composer install --no-dev
#migrate the database
php artisan migrate --force 
#cache the app's config for speed boosting
php artisan config:cach
#compile js assets
npm run build 
#run onther necessary commands for yr specif application
#and when you are done with the deployment process 
#you should exit the maintenance mode 
php artisan up
