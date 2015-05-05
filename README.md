# README


## Dev Environment

We follow the client prod environment here : 

- Php 5.4
- Ubuntu
- Mysql (no MariaDB)
- https only 

**Or** you can use our [vagrant](http://vagrantup.com) box available through this repository. You'll need :

- [VirtualBox](http://www.virtualbox.org)
- [Vagrant](http://vagrantup.com)
   

## Start


### Using Vagrant

1. `vagrant up` (at this point, go grabbing a cofee. It can take a while.)
2. `vagrant ssh`
3. Navigate to the root of this project `cd /var/www/ucb/` and run `composer install`
4. We'd already populate the db with fixture for you. To make sure that your BD structure is synched with the Model structure run `php app/console doctrine:schema:update --force`
5. Clear the Symphony cache `app/console cache:clear`
6. [Access the project](https://ucb.dev) . You may have a security alert. That's because we use our own autosigned certificate for testing the app in https mode.

### Without Vagrant

1. [Get composer](https://getcomposer.org/)
2. If you are using linux or OS X  make sure that your www-data group or user have right permission to write in cache and log directory `app/cache` and `app/logs`
3. Configure your host as you want, vHost or just a symlink to `var/www`  or `htdoc`
4. You can use the `/server.key` and `server.crt` for configuring your vhost
4. Import the fixtures from `/dandelion.sql` into your Database
5. Run `composer install` to get dependencies
6. To make sure that your BD structure is synched with the Model structure run `php app/console doctrine:schema:update --force`
7. Clear the Symphony cache `php app/console cache:clear`
8. Access the project following the url you define. Pay attention that it's **must** be https


### Development

The root directory is `web/` if you want to use a dev environnement the index is `app_dev.php`, and `app.php` for production. 


**NB:** if you are in production env you must run at each update of source code this command line : 

```bash
php app/console cache:clear --env=prod
```
