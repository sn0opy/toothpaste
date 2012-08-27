toothPaste-f3 by Sascha Ohms
============================

INFO
----

toothPaste is a lightweight open source pastebin written in PHP. It supports syntax highlighting
and file upload. Links will be made completely random, to prevent link-guessing.

INSTALLATION
------------

Simply edit the .htacces to fit your RewriteBase (Apache)

Note: you **SHOULD** change the filename of your db on line 7 of the index.php!

### Lighttpd User?
Use the following snippet instead of .htaccess

    url.rewrite-once = ("^/([^.]+)$" => "/index.php?$1")

REQUIREMENTS
------------

You need the following to run ToothPaste

* PHP 5.3
* SQLite
* SQLite (PDO)

(Be nice and keep my credits in the footer comment)
