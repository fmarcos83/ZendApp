CUSTOM RESOURCE LOADERS
=======================

A brief description about custom resource
loaders their dependencies and how to configure them
via application.ini

Cli
---

- requires

    - ZendApp\Console\Console
    - ZendApp\Controller\Request\Cli
    - ZendApp\Console\Strategy\AbstractStrategy

Adapts the web application so it can be used in console

- configuration

    - resources.cli =                   ; initializes and injects simple default strategy
    - resources.cli.strategy = className; initializes and injects custom cli strategy
