#!/bin/sh

cd "$(dirname "$0")"

php mailcheck.php > mail.txt
php btc.php > bottom.txt
