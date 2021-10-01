<?php


namespace WP28\Core;


class PluginConstants {

	private static string $version;
	private static string $url;
	private static string $dir;
	private static string $template_dir;
	private static string $assets_url;
	private static string $slug;
	private static string $plugin_base;
	private static string $text_domain;
	private static string $name;

	public function __construct($version, $dir, $url, $plugin_base, $text_domain, $name) {
		self::$version          = $version;
		self::$url              = $url;
		self::$dir              = $dir;
		self::$template_dir     = $dir . 'src/Templates/';
		self::$assets_url       = $url . 'src/Assets/';
		self::$plugin_base      = $plugin_base;
		self::$slug             = trim(dirname($plugin_base), '/');
		self::$text_domain      = $text_domain;
		self::$name             = $name;
	}

	/**
	 * @return string
	 */
	public static function getVersion(): string
	{
		return self::$version;
	}

	/**
	 * @return string
	 */
	public static function getUrl(): string
	{
		return self::$url;
	}

	/**
	 * @return string
	 */
	public static function getDir(): string
	{
		return self::$dir;
	}

	/**
	 * @return string
	 */
	public static function getAssetsUrl(): string
	{
		return self::$assets_url;
	}

	/**
	 * @return string
	 */
	public static function getSlug(): string
	{
		return self::$slug;
	}

	/**
	 * @return string
	 */
	public static function getPluginBase(): string
	{
		return self::$plugin_base;
	}

	/**
	 * @return string
	 */
	public static function getTextDomain(): string
	{
		return self::$text_domain;
	}

	/**
	 * @return string
	 */
	public static function getName(): string
	{
		return self::$name;
	}

	/**
	 * @return string
	 */
	public static function getTemplateDir(): string
	{
		return self::$template_dir;
	}

}