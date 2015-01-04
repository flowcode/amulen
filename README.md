# AMULEN *(in development, not yet in alpha)*

Amulen is a small proyect, who contain the more common and used features.
The key idea of this proyect is give to you a complete proyect to start work really fast and with the minimum effort.
Some features are:

  - Backoffice dashboard,with nice layout.
  - Users, with login/logout and two levels of security.
  - ManageMedia files.
  - Shop.
  - Post.
  - Bootstrap skeleton.

1) Installing
----------------------------------

```sh
$ git clone https://github.com/flowcode/amulen.git  [path/to/install/if/you/want]
$ composer install
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:update --force
$ php app/console doctrine:fixtures:load
$ chmod 777 web/uploads
$ chmod -R 777 web/media/cache/

```
After run all this commands, you will have a complete web with an e-commerce with three users: user1 and user2, regular users, and admin1 as an admin user. All this users have his username as password.


You can create new user by terminal with this command:

```sh
$ php app/console fos:user:create testuser test@example.com p@ssword --super-admin
```


License
----

MIT


##Provided by [Flowcode]

[Flowcode]:http://flowcode.com.ar/


