# WP28 Core

This is a library project to support plugins developed by [WP28](https://wp28.dev), providing basic settings and functionality for a WordPress plugin. 

### Usage

Clone this repository into a **"\lib\Core"** directory at plugin's root folder on WordPress. Execute replace.php script to update namespace, passing the value as -n parameter.

### Conventions

- Templates files must be placed in a folder named *templates* on plugin root directory.

### Versioning

##### v0.1.4

- Updated Plugin.php, adding get_plugin_data() function to get plugin info. Constructor now gets only one parameter. 
