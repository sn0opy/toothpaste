## toothpaste

toothpaste is a lightweight pastebin written in PHP.

### Setup

- Clone the repo / download the .zip file from Github
- If you rename the folder, also change `RewriteBase` in `.htaccess`
- Check write permissions on `tmp/` and `data/` folder
- Done

toothpaste supports MongoDB, PostgreSQL, MySQL, SQLite and JIG

JIG is a file based DB engine and enabled by default. It's recommended you change to a proper DB engine in `app/data/config.json`. Tables will be automatically created.

Powered by [Fat-Free Framework](https://github.com/bcosca/fatfree)
