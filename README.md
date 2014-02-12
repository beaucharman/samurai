_progress on lt3 :)_

> A slightly powerful, intelligent and simple WordPress theme.

**Mininum WordPress Version Requirment is 3.8**

### Features

- **Modulated file structure**
- **Security measures**
- Semantic HTML5 markup
- Extendable and immediately useful wp-config-sample.php and .htaccess
- Thoughtful, WordPress project specific helper functions
- Clean and thought out template files, including template partials
- Powerful Custom Post Type and Taxonomy class - Collectively 'Katana'
- Clean functions.php reserved for use constant declarations and modular, project specific file includes
- modernizr.js, respond.js and jquery.js libraries / scripts ready to go if needed


### Installation
1. Add the `samurai` folder to your theme's directory.
2. add the `.htaccess` and `.gitignore` files to your WordPress root.
3. With the `wp-config-sample.php` file:
  1. Rename to `wp-config.php` and add it to your WordPress root.
  2. Go to https://api.wordpress.org/secret-key/1.1/salt/ and copy the unique, newly generated salts and replace the place holder salts.
  3. Fill out the Database environment credentials.
  4. Change the `wp_` database prefix to something better.
4. got to *wp-admin*, follow the remainding WordPress install, and activate the theme via **Apparence > Themes**.
5. If you have installed WordPress in a sub directory (which you should) make sure to update related paths in .gitignore file and such

### Documentation

https://github.com/beaucharman/samurai/wiki/_pages



### Todo and issues

https://github.com/beaucharman/samurai/issues

- Adding a controller style system and further dividing models (pre query alterations and cleaner loop calls), controllers (snippets and functions to render abstracted segments) and views (templates files and template partials).
- Remove unnecessary files and functions - general clean up.



### Testing

Run http://codex.wordpress.org/Theme_Unit_Test thoroughly :)



### Notes for Production and Security

**Remove unnecessary files**

**readme.html** found in the root directory and **install.php** (located in the /wp-admin folder) are not required, and although **readme.html** is recreated after an update of WordPress, it should be removed - .gitingnore ;) - as it contains sensitive information such as the current version on WordPress.

**Please don't use 'admin' as a user**

Anything else... at all.. even `hackmeplease` is better than `admin`

**Strong passwords, people.**

This goes for FTP, database and WordPress credentials

**Complex database prefix**

None of this wp_ stuff.

**Alter the `.htaccess` file currently in this directory**

It is inspired by the .htaccess file found in http://html5boilerplate.com/, with a few other goodies, bu not all of it is needed for every project.

**Use elements from the `wp-config-sample.php` in this directory as needed... or just the whole thing**

Some nice deployment configurations, house cleaning and security stuff in there.

**.htaccess for the wp-content folder**

Which should contain:

```
# Prevent directory browsing
Options All -Indexes

# Protect all sever side files
Order deny,allow
Deny from all
<Files ~ “.(css|js|pdf|doc|xml|jpe?g|png|gif|svg|ttf|woff|eot)$”>
Allow from all
</Files>
```

**Enforce SSL Usage**

If it is necessary, within the wp-config.php file, place the following code:

```
  /* Enable SSL Encryption */
  define(‘FORCE_SSL_LOGIN’, true);
  define(‘FORCE_SSL_ADMIN’, true);
```

**Files Permissions**

- wp-config.php - 400 or 440.
- .htaccess - 644. Set yo 664 if you want WordPress to be able to edit this file for you.
- /wp-content/ - 777 according to WordPress Codex. It’s better to set it 755 and change to 777 temporary if some plugins require that level of access.
- /wp-content/themes/ - 755.
- /wp-content/plugins/ - 755.
- /wp-admin/ - 755.
- /wp-includes/ - 755.

For more information on WordPress suggested file permissions, and other awesome ways to 'harden WordPress': http://codex.wordpress.org/Hardening_WordPress#File_Permissions

**Keep. WordPress. Updated**

This includes keeping Plugins updated and maintaining the database - removing spam, unneeded revisions and such. Furthermore, having an intelligent .gitignore file (assuming version control is in play, *nudge) in the repo can keep unnecessary files out of production (like the nasty readme.html).
