<?php

namespace WP28\SKUMANAGER\Lib\WP28Core;

use Exception;
use WP28\SKUMANAGER\SkuManager;

/**
 *  Check requirements before plugin initialization
 * @package \WP28\SKUMANAGER\Lib\WP28Core\WP28\SKUMANAGER\Lib\WP28CoreCore
 * @version 1.0.0
 * @since 1.0.0
 * @author WP28\SKUMANAGER\Lib\WP28Core <WP28\SKUMANAGER\Lib\WP28Coredev@gmail.com>
 */
final class Startup {

	/**
	 * @param string $phpVersion
	 * @param array $dependencies
	 *
	 * @return bool
	 */
	public static function hasEnvironmentRequirements( string $phpVersion, array $dependencies = [] ) : bool
	{
		try
		{
			//check minimum PHP version
			if(version_compare(phpversion(), $phpVersion, '<'))
			{
				throw new Exception(
					sprintf(__('Este plugin requer ao menos a versão %s do PHP para funcionar.', Plugin::getTextDomain()),$phpVersion)
				);
			}

			//check if dependencies are loaded
			if (!empty($dependencies))
			{
				require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
				foreach ($dependencies as $dependency)
					if ( !is_plugin_active($dependency) && !is_plugin_active_for_network($dependency) )
					{
						throw new Exception('Plugin não ativado');
					}
			}
			return true;
		}
		catch (Exception $exception)
		{
			add_action(
				'admin_notices',
				function () use ($exception) {
					?>
					<div class="notice notice-error">
						<p>Não é possível habilitar o plugin <strong>Sku Manager</strong> no momento, certifique-se de atender os seguintes requisitos:</p>
						<p><?=$exception->getMessage();?>.</p>
					</div>
					<?php

					// In case this is on plugin activation.
					if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
					// Desactivate plugin
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