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

### NEW: MySQL? Of course:

    public function __construct() {
        $this->set('DB', new DB('mysql:dbname=toothpaste', 'root', ''));
        $this->get('DB')->sql('CREATE TABLE IF NOT EXISTS  `tp_pastes` (
                                `pasteID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                                `pasteSource` TEXT NOT NULL ,
                                `pastePublicID` VARCHAR(8) NOT NULL ,
                                `pasteHits` INT NOT NULL ,
                                `pastePass` VARCHAR(12) NOT NULL ,
                                `pasteDate` INT NOT NULL
                                );');
    }
    
Replace the __construct() function in `lib/tp.php` with the above snippet. Didn't test it well, but seems to 
work for me. It's not very elegant, but it was requested and will follow as a 'real' feature later.

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
