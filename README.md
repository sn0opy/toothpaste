## toothpaste

toothpaste is a lightweight pastebin written in PHP using the Fat-Free Framework.

### Setup

- `git clone https://github.com/sn0opy/toothpaste.git`
- `composer install`
- if you rename the folder, also change `RewriteBase` in `.htaccess`
- make sure your httpd user is allowed to create and write to `tmp` and `data`

toothpaste supports MongoDB, PostgreSQL, MySQL, SQLite and JIG

JIG is a file based DB engine and enabled by default. It's recommended you change to a proper DB engine in `app/data/config.json`. Tables will be automatically created.
