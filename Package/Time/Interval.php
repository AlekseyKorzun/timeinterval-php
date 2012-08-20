<?php
namespace Time;

use \DateTime;
use \DateInterval;

/**
 * Provides ability to interval a fluid time stamp.
 *
 * @package Time
 * @license MIT
 * @author Aleksey Korzun <al.ko@webfoundation.net>
 * @link http://alekseykorzun.com/post/7856565665/high-scalability-and-mysqls-now-dont-mix
 * @link http://www.alekseykorzun.com
 */
class Interval
{
	/**
	 * Instance of DateTime
	 *
	 * @var DateTime
	 */
	protected static $date;

	/**
	 * Format used for output, defaults to Y-m-d H:i:s via initialize
	 *
	 * @var string
	 */
	protected static $format;

	/**
	 * Initialize class if it was not previously initialized
	 *
	 * @return void
	 */
	protected static function initialize()
	{
		// Generally we want to base our intervals on a single time stamp
		// per execution. If you have a script that requires a new time stamp
		// for intervals simply remove if wrapper around this code
		if (!self::$date) {
			self::$date = new DateTime();
		}

		if (!self::$format) {
			self::$format = 'Y-m-d H:i:s';
		}
	}

	/**
	 * Switch current time stamp to intervalled version
	 *
	 * @param DateInterval $interval intervals (in minutes) that you wish to break the date out to
	 * @return string processed time stamp
	 */
	public static function minutes(DateInterval $interval)
	{
		self::initialize();

		// Make sure current format supports minutes and interval is valid
		if (!self::hasMinutes() && $interval->i) {
			return false;
		}

		$minutes = (int) (self::$date->format('i') - (self::$date->format('i') % $interval->i));
		if (strlen($minutes) == 1) {
			$minutes = 0 . $minutes;
		}

		// Notice that 's' is converted to 00 within getFormat() method
		return self::$date->format(str_replace('i', $minutes, self::getFormat('s')));
	}

	/**
	 * Return processed version of current time stamp
	 *
	 * @param DateInterval $interval intervals (in seconds) that you wish to break the date out to
	 * @return string processed time stamp
	 */
	public static function seconds(DateInterval $interval)
	{
		self::initialize();

		// Make sure current format supports minutes and interval is valid
		if (!self::hasSeconds() && $interval->s) {
			return false;
		}

		$seconds = (int) (self::$date->format('s') - (self::$date->format('s') % (int) $interval->s));
		if (strlen($seconds) == 1) {
			$seconds = 0 . $seconds;
		}

		return self::$date->format(str_replace('s', $seconds, self::getFormat()));
	}

	/**
	 * Sets new date format
	 *
	 * @see http://www.php.net/manual/en/function.date.php
	 * @param string $format new date format to use
	 * @return void
	 */
	public static function setFormat($format)
	{
		self::$format = (string) $format;
	}

	/**
	 * Retrieves currently set date format with ability to overwrite certain
	 * parts of the date with a static number.
	 *
	 * @param string $swap convert specific format characters to a static '00'
	 * @return string format
	 */
	protected static function getFormat($swap = null)
	{
		if (!is_null($swap)) {
			return str_replace((array) $swap, '00', self::$format);
		}

		return self::$format;
	}

	/**
	 * Checks if current format supports minutes
	 *
	 * @return bool returns true if support is present
	 */
	protected static function hasMinutes()
	{
		return (strpos(self::$format, 'i') !== false);
	}

	/**
	 * Checks if current format supports seconds
	 *
	 * @return bool returns true if seconds are supported
	 */
	protected static function hasSeconds()
	{
		return (bool) (strpos(self::$format, 's') !== false);
	}
}

