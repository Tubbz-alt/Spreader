## Spreader Web Project

### requirements
* redis
* mysql
* supervisor
* hhvm [selectable]

### components

* laravel 5.1
* react
* bootstrap
* highchart
* at.js

### queue [supervisor]

> sudo apt-get install supervisor
> touch /etc/supervisor/conf.d/spreader.conf
> supervisorctl reread
> supervisorctl update
> supervisorctl start spreader-worker:*


