
The application is using CodeIgniter 3 as a basic MVC framework. It can be
downloaded here: https://codeigniter.com/en/download

Unzip all of the files into your project directory making sure not to move any of the files.
Add the application and public directories at the top level.

Point your Apache web root at the /public directory.

As is standard with the framework, set the apache config to route all requests through the index.php.

## Apache vhost config
=================
Require all granted

RewriteEngine On

# Handle Front Controller...
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [L]
=================