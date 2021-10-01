<?php


namespace WP28\Core;


/**
 * Class Loader
 * @package WP28\Core\
 */
class Loader
{
	/**
	 * @var ?Loader
	 */
	private static ?Loader $instance = null;


	/**
	 * @return Loader
	 */
	public static function get_instance(): Loader
	{
		if (null == self::$instance) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * @param $hook
	 * @param $component
	 * @param $callback
	 * @param int $priority
	 * @param int $accepted_args
	 *
	 * @throws Exception
	 */
	public function add_action($hook, $component, $callback, int $priority = 10, int $accepted_args = 1)
	{
		//$this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);
		if (!method_exists($component, $callback)) {
			throw new Exception("Can't add action. Method " . $callback . " doesn't exist.");
		}
		add_action($hook, ($component === null ? $callback : array($component, $callback)), $priority, $accepted_args);
	}


	/**
	 * @param $hook
	 * @param $component
	 * @param $callback
	 * @param int $priority
	 * @param int $accepted_args
	 *
	 * @throws Exception
	 */
	public function add_filter($hook, $component, $callback, int $priority = 10, int $accepted_args = 1)
	{
		//$this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);
		if (!method_exists($component, $callback)) {
			throw new Exception("Can't add filter. Method " . $callback . " doesn't exist.");
		}
		add_filter($hook, ($component === null ? $callback : array($component, $callback)), $priority, $accepted_args);
	}

}