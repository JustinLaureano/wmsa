#!/bin/bash

nice -n 10 php /var/www/html/artisan schedule:run --verbose --no-interaction
