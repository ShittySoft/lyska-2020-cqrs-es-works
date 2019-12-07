#!/usr/bin/env bash

php vendor/bin/psalm --show-info=false
php -S localhost:8080 -t public
