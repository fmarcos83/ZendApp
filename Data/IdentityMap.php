<?php

declare(encoding='UTF-8');

namespace ZendApp\Data;
use ZendApp\Data\DomainObject as DomainObject;
use ZendApp\Data\Identity\IdentityMapInterface    as IdentityMapInterface;

class IdentityMap
implements IdentityMapInterface
{
    private $register = array();

    public function add(DomainObject $domainObject)
    {
        $this->register[$domainObject->id] = $domainObject;
    }

    public function get($id)
    {
        return $this->register[$id];
    }

    public function exists($id)
    {
        return isset($this->register[$id]);
    }

    public function delete($id)
    {
        unset($this->register[$id]);
    }
}
