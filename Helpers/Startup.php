<?php

namespace WP28\REPLACE\Lib\Core\Helpers;

use Exception;
use WP28\REPLACE\Lib\Core\Exceptions\InvalidPhpVersion;
use WP28\REPLACE\Lib\Core\Exceptions\WP28Exception;
use WP28\REPLACE\Lib\Core\Exceptions\WP28ExceptionFactory;


final class Startup {

	/**
	 * @param array $dependencies
	 *
	 * @return bool
	 */
	public static function hasEnvironmentRequirements( array $dependencies = [] ) : bool
	{
		try
		{
			if(version_compare(phpversion(), Plugin::getPhpVersion(), '<'))
			{
				throw new InvalidPhpVersion(
					sprintf(__('Este plugin requer ao menos a versão %s do PHP para funcionar.', Plugin::getTextDomain()), Plugin::getPhpVersion())
				);
			}
			if (!empty($dependencies))
			{
				require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
				foreach ($dependencies as $dependency) {
					if ( ! is_plugin_active( $dependency ) && ! is_plugin_active_for_network( $dependency ) ) {
						throw WP28ExceptionFactory::getException( $dependency );
					}
				}
			}
			return true;
		}
		catch (WP28Exception $exception)
		{
			add_action(
				'admin_notices',
				function () use ($exception) {
					?>
					<div class="notice notice-error">
                        <?php echo $exception->render(); ?>
					</div>
					<?php
					if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
					deactivate_plugins( plugin_basename( __FILE__ ) );
				}
			);
			return false;
		}
	}

	public static function run( string $class )
    {
        Loader::add_action( 'plugins_loaded', $class, 'init' );
	    register_activation_hook(Plugin::getPluginBase(), array($class, 'activate'));

	}
}