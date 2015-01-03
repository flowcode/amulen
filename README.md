# AMULEN

Amulen is a small proyect, who contain the more common and used features.
The key idea of this proyect is give to you a complete proyect to start to work really fast and with the minimum effort.
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
$ git clone https://github.com/flowcode/amulen.git
$ composer install
$ php app/console doctrine:database:create
$ php app/console doctrine:schema:update --force
$ php app/console fos:user:create testuser test@example.com p@ssword --super-admin
```


License
----

MIT


##Provided by [Flowcode]

[Flowcode]:http://flowcode.com.ar/


