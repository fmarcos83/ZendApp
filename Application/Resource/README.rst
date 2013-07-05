CUSTOM RESOURCE LOADERS
=======================

A brief description about custom resource
loaders their dependencies and how to configure them
via application.ini

Cli
---

Adapts the web application so it can be used in console

- requires

    - ZendApp\\Console\\Console
    - ZendApp\\Controller\\Request\\Cli
    - ZendApp\\Console\\Strategy\\AbstractStrategy

- configuration

    - resources.cli =                   ; initializes and injects simple default strategy
    - resources.cli.strategy = className; initializes and injects custom cli strategy

Cliviewrenderer

Loads the controller action helper ZendApp\\Controller\\Action\\Helper\\CliViewRenderer into the Action_Helper_Broker

- requires

    - ZendApp\\Controller\\Action\\Helper\\CliViewRenderer

- configuration
    !!! TAKE into account that is necesary to add the library action helper path so it can work !!!!
    - resources.frontcontroller.actionhelperpaths.ZendApp\Controller\Action\Helper = {path}
