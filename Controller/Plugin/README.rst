ZENDAPP CONTROLLER PLUGINS
==========================

Considerations about configuration
----------------------------------
In order to load custom controller plugins and application resources
from configuration files it's necesary to set the correct pluginpaths

- application.ini

  **Resources**
  - pluginpaths.ZendApp\Application\Resource\ = ZendApp/Application/Resource
  **Plugins**
  - pluginpaths.ZendApp\Controller\Plugin\ = ZendApp/Controller/Plugin

ModuleErrorController
---------------------

Allows having an errorController per module

- configuration

  - resource.frontcontroller.plugins.errormodule.stackIndex = 99

  - resource.frontcontroller.plugins.errormodule.class = ZendApp\Controller\Plugin\ModuleErrorController

