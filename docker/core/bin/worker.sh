#!/bin/bash

nice -10 php /var/www/html/artisan queue:work --queue=default --tries=3 --verbose --timeout=30 --sleep=3 --max-jobs=1000 --max-time=3600
