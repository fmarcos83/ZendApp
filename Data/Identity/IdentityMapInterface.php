<?php

declare(encoding='UTF-8');

namespace ZendApp\Data\Identity;
use ZendApp\Data\DomainObject as DomainObject;

interface IdentityMapInterface
{
    public function add(DomainObject $object);
    public function get($id);
    public function exists($id);
    public function delete($id);
}
