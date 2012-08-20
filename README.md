TimeInterval for PHP 5
==========================

When developers optimize their applications, the usage of NOW() and other dynamic MySQL methods is often overlooked. 

The problem with using NOW() (and other identical methods) that the query will always be dynamic, which means that there will be no cache record within the database.

This class allows you to create a static time intervals so you can perform same NOW() based look-ups per multiple requests.

Usage
-----

If you have your own autoloader, simply update namespaces and drop the files
into your frameworks library.

For people that do not have that setup, you can visit http://getcomposer.org to install
composer on your system. After installation simply run `composer install` in parent
directory of this distribution to generate vendor/ directory with a cross system autoloader.

Please see Examples directory for a simple run down of functionality.


About
-----

See: http://alekseykorzun.com/post/7856565665/high-scalability-and-mysqls-now-dont-mix
