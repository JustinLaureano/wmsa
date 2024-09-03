#!/bin/bash

nice -n 10 php /var/www/html/artisan reverb:start --debug --verbose --no-interaction
