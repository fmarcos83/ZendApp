Scribe client
=============

A client for scribe it uses namespaces
for autoloading porpouses.

For further info about https://github.com/facebook/scribe

Dependencies
------------

- PHP Thrift library in your
    include_path

- thrift scribe PHP compiled classes
    - FacebookService
    - scribe
    for clarity porposes Thrift generated
    packages should be stored in the proposed
    folder layout

    {ProjectLibrary}/{Thrift}/{Service}/{GeneratedClasses}

See
---

- ZendApp\Log\Writer\Scribe
  allows using a Scribe client instance
  as a Zend_Log writer
