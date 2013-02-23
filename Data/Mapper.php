<?php

declare(encoding='UTF-8');

namespace ZendApp\Data;

use ZendApp\Data\AbstractMapper as AbstractMapper;
use ZendApp\Data\DomainObject   as DomainObject;
use ZendApp\Data\Identity\IdentityMapInterface    as IdentityMapInterface;
use ZendApp\Data\IdentityMap    as IdentityMap;

class Mapper extends AbstractMapper
{
    protected $identityMap;

    public function init()
    {
        $this->setIdentityMap(new IdentityMap);
    }

    public function setIdentityMap(IdentityMapInterface $identity)
    {
        $this->identityMap = $identity;
    }

    public function find(array $where = null)
    {
        $result = $this->dataGateway->find($where);
        return $this->getCollection()->setData($result);
    }

    //TODO:check if it's a good idea findById
    public function insert(DomainObject $domainObject)
    {
        //db interaction
        $id = $this->dataGateway->insert($domainObject->toArray());
        $domainObject->id = $id;
        //storing in identitymap
        $this->identityMap->add($domainObject);
        return $id;
    }

    public function update(DomainObject $domainObject)
    {
        $where = array('id=?'=>$popo->id);
        return $this->dataGateway->update($domainObject->toArray(), $where);
        //storing the new identitymap
        $this->identityMap->add($domainObject);
    }

    public function delete(array $where = null)
    {
        return $this->dataGateway->delete($where);
    }

    public function createObject(array $data)
    {
        $id = $data['id'];
        $object = null;
        if ($this->identityMap->exists($id)) {
            $object = $this->identityMap->get($id);
        } else {
            $object = $this->getDao()->setData($data);
        }
        return $object;
    }
}
