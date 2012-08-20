<?php
/**
 * Sample code for testing time interval concept
 *
 * @package Time
 * @subpackage Time\Examples
 * @license MIT
 * @author Aleksey Korzun <al.ko@webfoundation.net>
 * @link http://alekseykorzun.com/post/7856565665/high-scalability-and-mysqls-now-dont-mix
 * @link http://www.alekseykorzun.com
 */

/**
 * You must run `composer install` in order to generate autoloader for this example
 */
require __DIR__ . '/../vendor/autoload.php';

use \DateInterval;
use Time\Interval;

print "Current time: " . date('Y-m-d H:i:s') . "\n";
print "Interval 5 seconds: " . Interval::seconds(new DateInterval('PT5S')) . "\n";
print "Interval 5 minutes: " . Interval::minutes(new DateInterval('PT5M')) . "\n";