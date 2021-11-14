<?php

namespace WP28\REPLACE\Lib\Core\Helpers;

abstract class Plugin {

	private static array $args;
	private static string $url;
	private static string $dir;
	private static string $template_dir;
	private static string $assets_url;
	private static string $slug;
	private static string $options_name;
	private static string $plugin_base;
	private static array $plugin_data;
	private static string $text_domain;

	public function __construct($args)
	{
		self::$args = $args;
	}

	abstract function init();

	public function setup( $root ): void {
		self::$url          = plugin_dir_url( $root );
		self::$dir          = plugin_dir_path( $root );
		self::$plugin_base  = plugin_basename( $root );
		self::$template_dir = self::$dir . 'templates/';
		self::$assets_url   = self::$url . 'assets/';
		self::$slug         = trim( dirname( self::$plugin_base ), '/' );
		self::$options_name = self::$slug . '_options';
		self::$text_domain  = self::$slug;
		self::$plugin_data  = get_plugin_data($root);
	}

	public static function activate()
	{
		if(!get_option(self::getOptionsName())) {
			self::addOptions();
		}
	}

	public static function getPrefix() : string
	{
		return substr(preg_replace('#[aeiou\-\s]+#i', '', self::$slug), 0, 10);
	}

	public static function getOptions()
	{
		if(!get_option(self::getOptionsName())) {
			self::addOptions();
		}
		return get_option(self::getOptionsName());
	}

	private static function addOptions(): void
	{
		add_option( self::getOptionsName(), self::$args );
	}

	/**
	 * @return string
	 */
	public static function getVersion(): string
	{
		return self::$plugin_data['Version'];
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
	public static function getOptionsName(): string {
		return self::$options_name;
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
		return self::$plugin_data['Name'];
	}

	/**
	 * @return string
	 */
	public static function getTemplateDir(): string
	{
		return self::$template_dir;
	}

	/**
	 * @return string
	 */
	public static function getPhpVersion(): string
	{
		return self::$plugin_data['RequiresPHP'];
	}

}